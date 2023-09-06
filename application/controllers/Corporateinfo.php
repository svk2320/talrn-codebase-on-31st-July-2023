<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Corporateinfo extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->lang->load("title", "english");
        $data['title'] = $this->lang->line("corporate_info_title");
        $data['description'] = $this->lang->line("corporate_info_description_title");
        $data['og'] = $this->lang->line("corporate_info_title");
        $data['og_image'] = $this->lang->line("corporate_info_og_image");
        $data['body_view'] = 'corporate-information';
        $this->load->view('template/layout_manager', $data);
    }
}
