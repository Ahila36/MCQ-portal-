
<?php

class Quiz extends CI_Model {

    function getQuizes() {
        $quizList = array();
        $this->load->database(); //to connect to the database.
        $htbl = $this->db->get('quiz'); //table name , case sensitive
        // use array keys as column names for db lookup
        $result = $this->db->get('quiz');
        //$result = $this->db->get('quiz');
        // return the results as an array - in which each selected row appears as an array
        return $result->result_array();
    }

    function deleteQuizes($args) {
        $this->load->database();
        $this->db->where('id', $args['id']);
        $this->db->delete('quiz');
        return true;
    }

    function addQuiz($quizName) {
        $this->load->database();
        $data = array(
            'name' => $quizName,
            'createdDate' => date("Y/m/d")
        );
        if ($this->db->insert('quiz', $data)) {
            return true;   // to the controller
        }
    }

}
