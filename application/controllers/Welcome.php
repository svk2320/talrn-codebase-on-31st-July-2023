<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function home()
	{
		$data['title'] = $this->lang->line("home_title");
		$data['description'] = $this->lang->line("description_title");
		$data['og'] = $this->lang->line("home_title");
		$data['og_image'] = $this->lang->line("og_image");
		$data['body_view'] = 'home';
		$this->load->view('template/layout_manager', $data);
	}
}
