<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = $this->lang->line("about_title");
        $data['description'] = $this->lang->line("about_description_title");
        $data['og'] = $this->lang->line("about_title");
        $data['og_image'] = $this->lang->line("about_og_image");

        $data['body_view'] = 'about';
        $this->load->view('template/layout_manager', $data);
    }
}
