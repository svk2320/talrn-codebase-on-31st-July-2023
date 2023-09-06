<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Client_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_auth');
	}


    public function logout()
    {
        $this->session->sess_destroy();

        // Redirect to the login page
        redirect('admin/auth/login');
        exit();
    }
}