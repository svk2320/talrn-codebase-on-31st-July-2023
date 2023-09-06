<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Industries extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_home');
    }

    public function index()
    {    
        $data['title'] = $this->lang->line("industries_title");
        $data['description'] = $this->lang->line("industries_description_title");
        $data['og'] = $this->lang->line("industries_title");
        $data['og_image'] = $this->lang->line("industries_og_image");

        $data['body_view'] = 'industries';
        $this->load->view('template/layout_manager', $data);
    }

    public function industry_search(){
        $result = $this->model_home->getDistinctIndustries();
        $industries = array("Aerospace and Defense",
        "Automotive",
        "Banking",
        "Capital Markets",
        "Chemicals",
        "Communications and Media",
        "Consumer Goods and Services",
        "Energy",
        "Ecommerce",
        "Healthcare",
        "High Tech",
        "Industrial",
        "Insurance",
        "Life Sciences",
        "Natural Resources",
        "Public Service",
        "Retail",
        "Software and Platforms",
        "Travel",
        "Utilities");
        foreach ($result as $industry => $value){
            if(!(in_array($value['industry'],$industries)) && $value['industry'] != '' ){
               array_push($industries, $value['industry']); 
            }
        }
        $query = '/' . $this->input->get('q') . '/';
        $result = array();
        for ($i = 0;$i < sizeof($industries);$i++){
            if (preg_match(strtolower($query), strtolower($industries[$i]))){
                array_push($result, $industries[$i]);
            }
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function travel()
    {
        $data['title'] = $this->lang->line("travel_title");
        $data['description'] = $this->lang->line("travel_description_title");
        $data['og'] = $this->lang->line("travel_title");
        $data['og_image'] = $this->lang->line("travel_og_image");
        $data['body_view'] = 'travel';
        $data['profiles'] = $this->model_home->getprofilesbyindustry('Travel');
        $this->load->view('template/layout_manager', $data);
    }

    public function automotive()
    {
        $data['title'] = $this->lang->line("automotive_title");
        $data['description'] = $this->lang->line("automotive_description_title");
        $data['og'] = $this->lang->line("automotive_title");
        $data['og_image'] = $this->lang->line("automotive_og_image");
        $data['body_view'] = 'automotive';
        $data['profiles'] = $this->model_home->getprofilesbyindustry('Automobile');
        $this->load->view('template/layout_manager', $data);
    }

    public function banking()
    {
        $data['title'] = $this->lang->line("banking_title");
        $data['description'] = $this->lang->line("banking_description_title");
        $data['og'] = $this->lang->line("banking_title");
        $data['og_image'] = $this->lang->line("banking_og_image");
        $data['body_view'] = 'banking';
        $data['profiles'] = $this->model_home->getprofilesbyindustry('Banking and Finance');
        $this->load->view('template/layout_manager', $data);
    }

    public function ecommerce()
    {
        $data['title'] = $this->lang->line("ecommerce_title");
        $data['description'] = $this->lang->line("ecommerce_description_title");
        $data['og'] = $this->lang->line("ecommerce_title");
        $data['og_image'] = $this->lang->line("ecommerce_og_image");
        $data['body_view'] = 'ecommerce';
        $data['profiles'] = $this->model_home->getprofilesbyindustry('Ecommerce');
        $this->load->view('template/layout_manager', $data);
    }

    public function healthcare()
    {
        $data['title'] = $this->lang->line("healthcare_title");
        $data['description'] = $this->lang->line("healthcare_description_title");
        $data['og'] = $this->lang->line("healthcare_title");
        $data['og_image'] = $this->lang->line("healthcare_og_image");
        $data['body_view'] = 'healthcare';
        $data['profiles'] = $this->model_home->getprofilesbyindustry('Healthcare');
        $this->load->view('template/layout_manager', $data);
    }

    public function capital_markets()
    {
        $data['title'] = $this->lang->line("capitalmarkets_title");
        $data['description'] = $this->lang->line("capitalmarkets_description_title");
        $data['og'] = $this->lang->line("capitalmarkets_title");
        $data['og_image'] = $this->lang->line("capitalmarkets_og_image");
        $data['body_view'] = 'capital_markets';
        $data['profiles'] = $this->model_home->getprofilesbyindustry('Capital Markets');
        $this->load->view('template/layout_manager', $data);
    }

    public function industryList($industry){
        $profile_list = array();
        $data = $this->model_home->getprofilesbyindustry($industry);
        foreach($data as  $profile) {
            $profile_data = $profile;
            $profile_industries = $this->model_home->getIndustriesByProfileId($profile['id']);
            $industry_pro_list = array();
            foreach($profile_industries as $industry){
                if($industry['industry'] == ''){
                    continue;
                }
                array_push($industry_pro_list,$industry['industry']);
            }
            $profile_data['profile_industries'] = $industry_pro_list;
            $skills = $this->model_home->profile_skills($profile['id']);
            $skills_list = array();
            for ($j = 0; $j < sizeof($skills); $j++) {
                array_push($skills_list,$skills[$j]['name']);
            }
            $profile_data['skills'] = $skills_list;
            array_push($profile_list,$profile_data);
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($profile_list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
}
