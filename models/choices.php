<?php

class Choices extends CI_Model {

    function getChoices($getQuestionIdArray) {

        $this->load->database(); //to connect to the database.
        $this->db->order_by("id", "random"); //get randomly selected questions
        $getChoices = [];
        $htbl = $this->db->get('choices'); //table name 
        foreach ($getQuestionIdArray as $questionId) {
            foreach ($htbl->result() as $choice) {
                if ($choice->questionId == $questionId) {
                    $getChoices[] = ['id' => $choice->id,
                        'questionId' => $choice->questionId,
                        'choice' => $choice->choice];
                }
            }
        }
        // return the results as an array - in which each selected row appears as an array
        return $getChoices;
    }

    function getQuestionIdsByAnswerIds($answerArrays) {
        $this->load->database(); //to connect to the database.
        $getQuestionIds = [];
        $htbl = $this->db->get('choices'); //table name 
        foreach ($answerArrays as $answerId) {
            foreach ($htbl->result() as $choice) {
                if ($choice->id == $answerId) {
                    array_push($getQuestionIds, $choice->questionId);
                }
            }
        }
        return $getQuestionIds;
    }

    function addChoices($getQuestionId, $removeEncodeChoice1, $removeEncodeChoice2) {//insert two choices
        $this->load->database();
        $data = array(
            array(
                'questionId' => $getQuestionId,
                'choice' => $removeEncodeChoice1
            ),
            array(
                'questionId' => $getQuestionId,
                'choice' => $removeEncodeChoice2
            ),
        );
            if ($this->db->insert_batch('choices', $data)) {
            return true;
        }
    }

    function getCorrectAnswerId($getQuestionId, $removeEncodeCorrectAns) {
        $this->load->database();
        $data = array(
            'questionId' => $getQuestionId,
            'choice' => $removeEncodeCorrectAns
        );
        if ($this->db->insert('choices', $data)) {
            $id = $this->db->insert_id();
            return $id;
        }
    }

    function updateChoiceById($choice, $id) {
        $this->load->database();
        $data = array(
            'choice' => $choice
        );
        $this->db->where('id', $id);
        if ($this->db->update('choices', $data) == TRUE) {
            return true;
        }
    }

    function deleteChoicesByQuestionId($questionId) {
        $this->load->database();
        $this->db->where('questionId', $questionId);
        $this->db->delete('choices');
        return true;
    }

}
