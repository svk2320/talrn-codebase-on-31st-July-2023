<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contactus extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
         $this->lang->load("title", "english");
        $data['title'] = $this->lang->line("contactus_title");
        $data['description'] = $this->lang->line("contactus_description_title");
        $data['og'] = $this->lang->line("contactus_title");
        $data['og_image'] = $this->lang->line("contactus_og_image");
        $data['body_view'] = 'contact-us';
        $this->load->view('template/layout_manager', $data);
    }
}
