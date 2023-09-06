<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Careers extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = $this->lang->line("careers_title");
        $data['description'] = $this->lang->line("careers_description_title");
        $data['og'] = $this->lang->line("careers_title");
        $data['og_image'] = $this->lang->line("careers_og_image");
        $data['body_view'] = 'careers';
        $this->load->view('template/layout_manager', $data);
    }
    public function ios_developer()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'ios-developer';
        $this->load->view('template/layout_manager', $data);
    }
    public function senior_it_recruiter()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'senior-it-recruiter';
        $this->load->view('template/layout_manager', $data);
    }

    public function key_accounts_manager()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'kam';
        $this->load->view('template/layout_manager', $data);
    }

    public function front_end_developer()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'front_end_developer';
        $this->load->view('template/layout_manager', $data);
    }

    public function back_end_developer()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'back_end_developer';
        $this->load->view('template/layout_manager', $data);
    }

    public function hr_associate()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'hr_associate';
        $this->load->view('template/layout_manager', $data);
    }


}
