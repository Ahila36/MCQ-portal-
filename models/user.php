<?php

class User extends CI_Model {

    function _construct() {
        parent::_construct();
        $this->load->database();
    }

    public function addUser($args) {
        $correct_User;
        $id;
        $getelement=[];
        $this->load->database();
        $this->db->select('id, name, password,isAdmin');
        $this->db->from('user');
        $this->db->where('name', $args['name']);
        $this->db->where('password', $args['password']);
        $this->db->limit(1);

        $userRow = $this->db->get()->row();//row  containing selected user
        
        return $userRow;
    }

}
