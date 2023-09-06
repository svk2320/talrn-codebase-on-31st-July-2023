<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verified extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->lang->load("title", "english");
        $data['title'] = $this->lang->line("verified_title");
        $data['description'] = $this->lang->line("verified_description_title");
        $data['og'] = $this->lang->line("verified_title");
        $data['og_image'] = $this->lang->line("verified_og_image");
        $data['body_view'] = 'verified';
        $this->load->view('template/layout_manager', $data);
    }
}
