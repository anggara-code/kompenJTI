<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
        parent::__construct();
        
		$this->load->model('login_model');
		$this->login_model->ifNotLogged();
	}

	public function index()
	{
        $data['profile']	= $this->session->userdata('logged_in');
        $data['content']	= 'home/home_view';
        $data['active']		= 'home';

		$this->load->view('index',$data);
	}

}