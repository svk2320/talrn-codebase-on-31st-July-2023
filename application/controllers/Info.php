<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Info extends Frontend_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		$data['title'] = $this->lang->line("home_title");
		$data['description'] = $this->lang->line("description_title");
		$data['og'] = $this->lang->line("home_title");
		$data['og_image'] = $this->lang->line("og_image");

		$data['body_view'] = 'on-demand-talent';
		$this->load->view('template/layout_manager', $data);
	}

    public function odt2()
	{
		
		$data['title'] = $this->lang->line("home_title");
		$data['description'] = $this->lang->line("description_title");
		$data['og'] = $this->lang->line("home_title");
		$data['og_image'] = $this->lang->line("og_image");

		$data['body_view'] = 'on-demand-talent-2';
		$this->load->view('template/layout_manager', $data);
	}

    public function pricing()
	{
		
		$data['title'] = $this->lang->line("home_title");
		$data['description'] = $this->lang->line("description_title");
		$data['og'] = $this->lang->line("home_title");
		$data['og_image'] = $this->lang->line("og_image");

		$data['body_view'] = 'pricing';
		$this->load->view('template/layout_manager', $data);
	}

    public function press()
	{
		
		$data['title'] = 'Talrn Logo, Our Brand & Other Resources ';
		$data['description'] = 'Download Talrn logo, assets, and Talrn Brand Guidelines — and learn how to embed Talrn on your applications ';
		$data['og'] = 'Talrn Logo, Our Brand & Other Resources ';
		$data['og_image'] = $this->lang->line("og_image");

		$data['body_view'] = 'press';
		$this->load->view('template/layout_manager', $data);
	}

	public function success()
	{
		
		$data['title'] = 'Payment is Successful | Talrn Verified ';
		$data['description'] = 'Your payment to Talrn Verified is successful';
		$data['og'] = 'Payment is Successful | Talrn Verified ';
		$data['og_image'] = $this->lang->line("og_image");

		$data['body_view'] = 'payment-success';
		$this->load->view('template/layout_manager', $data);
	}
}
