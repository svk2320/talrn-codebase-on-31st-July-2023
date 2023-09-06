<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discover extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    $data['title'] = $this->lang->line("discover_title");
    $data['description'] = $this->lang->line("discover_description_title");
    $data['og'] = $this->lang->line("discover_title");
    $data['og_image'] = $this->lang->line("discover_og_image");
    $data['body_view'] = 'discover';
    $this->load->view('template/layout_manager', $data);
    }

    public function camber()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'camber';
        $this->load->view('template/layout_manager', $data);
    }

    public function pingglesmsg()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'pingglesmsg';
        $this->load->view('template/layout_manager', $data);
    }

    public function yammi()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'yammi';
        $this->load->view('template/layout_manager', $data);
    }

    public function glovo()
    {
        $data['title'] = $this->lang->line("home_title");
        $data['description'] = $this->lang->line("description_title");
        $data['og'] = $this->lang->line("og_title");
        $data['og_image'] = $this->lang->line("og_image");
        $data['body_view'] = 'glovo';
        $this->load->view('template/layout_manager', $data);
    }
}
