<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Our_story extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = $this->lang->line("ourstory_title");
        $data['description'] = $this->lang->line("ourstory_description_title");
        $data['og'] = $this->lang->line("ourstory_title");
        $data['og_image'] = $this->lang->line("ourstory_og_image");
        $data['body_view'] = 'our_story';
        $this->load->view('template/layout_manager', $data);
    }
}
