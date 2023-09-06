<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Why extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = $this->lang->line("why_title");
        $data['description'] = $this->lang->line("why_description_title");
        $data['og'] = $this->lang->line("why_title");
        $data['og_image'] = $this->lang->line("why_og_image");
        $data['body_view'] = 'why';
        $this->load->view('template/layout_manager', $data);
    }
}
