<?php

class Result extends CI_Model {

    function _construct() {
        parent::_construct();
        $this->load->database();
    }

    function saveResult($userId, $score, $quizId) {
        $data = array(
            'quizId' => $quizId,
            'userId' => $userId,
            'score' => $score,
            'date' => date("Y/m/d")
        );
        if ($this->db->insert('result', $data)) {
            return true;   // to the controller
        }
    }

    function getAverageScore($userId, $score) {//get average score of each user
        $this->db->select_avg('score');
        $this->db->where('userId', $userId);
        $query = $this->db->get('result')->row();
        return $query;
    }

}
