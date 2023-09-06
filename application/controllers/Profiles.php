<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profiles extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_users');
        $this->load->model('model_home');
        $this->load->model('model_stores');
        $this->lang->load("title", "english");
    }

    public function index()
    {
        $this->load->library("pagination");
        $skills = $this->input->get('skills');
        $exp = $this->input->get('exp');
        $ind = $this->input->get('ind');
        
        if (isset($exp)) {
            $exp_data = explode(',', $exp);
            $data['exp_data'] = $exp_data;
        }
        if (isset($ind)) {
            $ind_list = explode(',', $ind);
            $data['ind_list'] = $ind_list;
        }

        $data['title'] = $this->lang->line("find_IOS_Dev_title");
        $data['description'] = $this->lang->line("find_IOS_Dev_description");
        $data['og'] = $this->lang->line("find_IOS_Dev_title");
        $data['og_image'] = $this->lang->line("find_IOS_Dev_og_image");

        $data['url'] = base_url() . uri_string();
        $config["base_url"] = base_url() . 'profiles/';
        $getallrecords = $this->model_home->listallprofiles('donotsetlimit');
        $data['industry_report'] = $this->model_stores->getIndustryReport();
        if (isset($skills)) {
            $config["total_rows"] = 10;
        }
        else{
        $config["total_rows"] = $getallrecords["count"];
        }
        $config["per_page"] = 9;
        $config["uri_segment"] = 2;
        $config['full_tag_open'] = '<nav class="d-flex justify-content-center" aria-label="pagination" ><ul class="pagination" id="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $getallrecords = $this->model_home->listallprofiles($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        if (isset($skills)) {
            $skill_list = explode(',', $skills);
            $data['skill_list'] = $skill_list;
            $data['profiles'] = array();
        }else{
            $data['profiles'] = $getallrecords['data'];
        }
        $data['body_view'] = 'profiles';
        $this->load->view('template/layout_manager', $data);



    }
}