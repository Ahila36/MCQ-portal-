<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin_views extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('quiz');
        $this->load->helper('url');
    }

    function admin_quizes() {
        $this->load->view('adminInterface/admin_quiz_portal');
    }

    function admin_question() {
        $this->load->view('adminInterface/admin_questions');
    }

    function maincall() {
        $this->load->view('adminInterface/main.html');
    }

    function admin_login() {
        $this->load->view('adminInterface/admin_login');
    }

    function admin_result() {
        $this->load->view('adminInterface/admin_result');
    }

    function user_quiz() {
        $this->load->view('user_quiz');
    }

    function user_question() {
        $this->load->view('user_question');
    }

    function user_results() {
        $this->load->view('user_results');
    }

}
