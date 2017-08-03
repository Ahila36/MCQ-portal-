<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class rest extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('question');
        $this->load->model('quiz');
        $this->load->model('choices');
        $this->load->model('result');
        $this->load->helper('url');
    }

    public function _remap() {
        // first work out which request method is being used
        $request_method = $this->input->server('REQUEST_METHOD');
        switch (strtolower($request_method)) {
            case 'get' : $this->get(); // redirect to get function in rest controller
                break;
            case 'post' : $this->post(); // redirect to post function in rest controller
                break;
            case 'delete' : $this->delete(); // redirect to delete function in rest controller
                break;
            case 'put' : $this->put(); // redirect to put function in rest controller
                break;
            default:
                show_error('Unsupported method', 404); // CI function 
                break;
        }
    }

    public function post() {
        $args = $this->uri->uri_to_assoc(2);
        switch ($args['resource']) {
            case 'login' :
                $res = $this->user->addUser($args);
                if ($res === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'isAdmin' => $res->isAdmin, 'id' => $res->id));
                }
                break;
            case 'saveScore' :
                $score = 0;
                $userId = $args['userId'];
                $quizId = $args['quizId'];
                $getAnswers = $this->input->get();
                $getAnswerArray;
                foreach ($getAnswers as $answer) {
                    $getAnswerArray = json_decode($answer);
                }
                $questionIds = $this->choices->getQuestionIdsByAnswerIds($getAnswerArray);
                $questions = $this->question->getQuestionByQuestionIds($questionIds);
                foreach ($questions as $question) {
                    foreach ($getAnswerArray as $userAnswer) {
                        if ($question->answer_Id == $userAnswer) {
                            $score++;
                        }
                    }
                }
                $res = $this->result->saveResult($userId, $score, $quizId);
                $getAverage = $this->result->getAverageScore($userId, $score);
                if ($res === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'score' => $score, 'average' => $getAverage->score));
                }
                break;
            case 'saveQuiz' :
                $check = $args['quizName'];
                $removeEncode = urldecode($check);
                $res = $this->quiz->addQuiz($removeEncode);
                if ($res === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    echo json_encode(array('status' => 0));
                }
                break;
            case 'saveQustionAndChoices' :
                //url decoding to remove unneccessary parameters passed via URL
                $check = $args['question'];
                $removeEncode = urldecode($check);
                $choice1 = $args['choice1'];
                $removeEncodeChoice1 = urldecode($choice1);
                $choice2 = $args['choice2'];
                $removeEncodeChoice2 = urldecode($choice2);
                $correctAns = $args['correctAnswer'];
                $removeEncodeCorrectAns = urldecode($correctAns);
                $quizId = $args['quizId'];
                $getQuestionId = $this->question->addQuestion($removeEncode, $quizId); //save question adn get the id to pass to choice
                $res = $this->choices->addChoices($getQuestionId, $removeEncodeChoice1, $removeEncodeChoice2); //add choices with question Id
                $getCorrectAnserId = $this->choices->getCorrectAnswerId($getQuestionId, $removeEncodeCorrectAns); //get correct answer Id
                $updateQuestionTableWithCorrectAnswer = $this->question->updateTable($getCorrectAnserId, $getQuestionId); //update answerId in questiontable
                if ($updateQuestionTableWithCorrectAnswer === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    echo json_encode(array('status' => 0));
                }
                break;
            default:
                show_error('Unsupported resource', 404);
        }
    }

    public function delete() {
        $args = $this->uri->uri_to_assoc(2);
        switch ($args['resource']) {
            case 'deleteQuiz' :
                $res = $this->quiz->deleteQuizes($args);
                if ($res === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    // assume we get back an array of data - now echo it as JSON
                    echo json_encode(array('status' => 0));
                }
                break;
            default:
                show_error('Unsupported resource', 404);
                break;
            case 'deleteQuestion' :
                $res = $this->question->deleteQuestion($args);
                $res1 = $this->choices->deleteChoicesByQuestionId($args['id']);
                if ($res1 === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    // assume we get back an array of data - now echo it as JSON
                    echo json_encode(array('status' => 0));
                }
                break;
            default:
                show_error('Unsupported resource', 404);
                break;
        }
    }

    public function get() {
        $args = $this->uri->uri_to_assoc(2);

        switch ($args['resource']) {
            case 'quiz' :
                $res = $this->quiz->getQuizes();
                if ($res === false) {
                    show_error('Unsupported request', 404);
                } else {
                    // assume we get back an array of data - now echo it as JSON
                    echo json_encode($res);
                }
                break;
            case 'question' :
                $res = $this->question->getQuestion($args);
                if ($res === false) {
                    show_error('Unsupported request', 404);
                } else {
                    // assume we get back an array of data - now echo it as JSON
                    echo json_encode($res);
                }
                break;
            case 'choice' :
                //$res = $this->question->getQuestion($args);
                $sample = $this->input->get();
                $getQuestionIdArray;
                $choicesArray = [];
                foreach ($sample as $id) {
                    $getQuestionIdArray = json_decode($id);
                }
                $res = $this->choices->getChoices($getQuestionIdArray);

                if ($res === false) {
                    show_error('Unsupported request', 404);
                } else {
                    // assume we get back an array of data - now echo it as JSON
                    echo json_encode($res);
                }
                break;
            default:
                show_error('Unsupported resource', 404);
                break;
        }
    }

    public function put() {
        $args = $this->uri->uri_to_assoc(2);
        switch ($args['resource']) {
            case 'updateQuestion' :
                $question = $args['question'];
                $removeEncode = urldecode($question);
                $res = $this->question->updateQuestionById($removeEncode, $args['questionId']);
                if ($res === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'id' => $res));
                }
                break;
            case 'updateChoice' :
                $choice = $args['choice'];
                $removeEncode = urldecode($choice);
                $res = $this->choices->updateChoiceById($removeEncode, $args['choiceId']);
                if ($res === false) {
                    echo json_encode(array('error' => 'unable to enroll', 'status' => 1));
                } else {
                    echo json_encode(array('status' => 0, 'id' => $res));
                }
                break;
            default:
                show_error('Unsupported resource', 404);
        }
    }

}
