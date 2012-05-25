<?php
class Home extends Controller {
    public function __construct() {
        parent::Controller();
        $this->load->helper('url');
    }
    
    public function index() {
        $this->load->view('header');
        $this->load->view('navigation');
        $this->load->view('home/index');
        $this->load->view('footer');
    }
}