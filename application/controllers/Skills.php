<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skills extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->lang->load("title", "english");
    }

    public function index()
    {
        $skill = $this->uri->segment(2);
        if ($skill) {
            $skill = str_replace('-and-', '/', $skill);
            $skill = str_replace('-', ' ', $skill);
            $data['profiles'] = $this->model_home->getProfilesBySkill($skill);
            if (sizeof($data['profiles']) > 0) {
                $data['skill'] = $this->model_home->getSkillNameBySkill($skill);
                $data['title'] =  count($data['profiles']) . " Best ". $data['skill'] ." Developers  | Talrn";
                $data['description'] = "Talrn offers top ". $data['skill'] ." developers, programmers, and software engineers on an hourly, part-time, or full-time contract basis";
                $data['og'] = $data['title'];
                $data['og_image'] = $this->lang->line("skills_og_image");
                $data['body_view'] = 'skills_landing';
                $this->load->view('template/layout_manager', $data);
            } else {
                redirect('my404', 'refresh');
            }

        } else {
            $data['title'] = $this->lang->line("home_title");
            $data['description'] = $this->lang->line("description_title");
            $data['og'] = $this->lang->line("home_title");
            $data['og_image'] = $this->lang->line("og_image");
            $data['body_view'] = 'skills';
            $this->load->view('template/layout_manager', $data);
        }
    }

    public function url_decode_custom($input){
        $output = str_replace('_', ' ', $input);
        $output = str_replace('-and-', '/', $output);
        return $output;
    } 
}
