
<?php

class Question extends CI_Model {

    function getQuestion($args) {
        $this->load->database(); //to connect to the database.
        $result = $this->db->get_where('questions', array('quizId' => $args['quizId']));
        // return the results as an array - in which each selected row appears as an array
        return $result->result_array();
    }

    function getQuestionByQuestionIds($questionIds) { //the questions are retrieved to find if the answer_Id matches user answer
        $this->load->database(); //to connect to the database.
        $getQuestions = [];
        $htbl = $this->db->get('questions'); //table name 
        foreach ($questionIds as $questionId) {
            foreach ($htbl->result() as $question) {
                if ($question->id == $questionId) {
                    array_push($getQuestions, $question);
                }
            }
        }
        return $getQuestions;
    }

    function addQuestion($removeEncode, $quizId) {
        $this->load->database();
        $data = array(
            'quizId' => $quizId,
            'question' => $removeEncode
        );
        if ($this->db->insert('questions', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
    }

    function updateTable($getCorrectAnserId, $getQuestionId) {
        $this->load->database();
        $data = array(
            'answer_Id' => $getCorrectAnserId
        );
        $this->db->where('id', $getQuestionId);
        if ($this->db->update('questions', $data) == TRUE) {
            return true;
        }
    }

    function updateQuestionById($question, $id) {
        $this->load->database();
        $data = array(
            'question' => $question
        );
        $this->db->where('id', $id);
        if ($this->db->update('questions', $data) == TRUE) {
            return true;
        }
    }

    function deleteQuestion($args) {
        $this->load->database();
        $this->db->where('id', $args['id']);
        $this->db->delete('questions');
        return true;
    }

}
