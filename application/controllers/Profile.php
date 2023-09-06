<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_users');
        $this->load->model('model_home');
        $this->load->model('model_stores');
        $this->lang->load("title", "english");
    }

public function index($profile_url = null,$unique_id = null)
    {   
        if ($unique_id) {
            $id = $this->uri->segment(3);
            $result = $this->model_home->getidbyuniqueid($id);
        } else {
            $id = $this->uri->segment(2);
            $result = $this->model_home->getidbyuniqueid($id);
            if(sizeof($result) == 0){
                $result=$this->model_home->getidbycustomurl($id);
            }
        }

        if (sizeof($result) == 0) {
            redirect('my404', 'refresh');
        } else {
            $id = $result[0]['id'];
            $data['title'] = $this->lang->line("profile_details_title");
            $data['description'] = $this->lang->line("profile_details_description");
            $data['og_image'] = $this->lang->line("profile_details_og_image");
            $this->model_home->IncreaseProfileViewcount($id);
            $data['profiles'] = $this->model_home->getprofilebyid($id);
            if($data['profiles'][0]['approval'] != 1){
                redirect('my404', 'refresh');
            }

            $data['profile_edu'] = $this->model_home->profile_edu($id);
            $data['profile_exp'] = $this->model_home->profile_exp($id);
            $data['profile_pro'] = $this->model_home->profile_pro($id);
            $data['profile_cert'] = $this->model_home->profile_cert($id);
            $data['profile_skills'] = $this->model_home->profile_skills($id);

            $action_logs = [
                "IP" => $this->input->ip_address(),
                "action" => 'view',
                "profile_id" => $data['profiles'][0]['unique_id'],
            ];
            $this->model_home->create_action_log($action_logs);
            
            
            // echo '<pre>';
            // print_r($data['profile_skills']);
            $skillNames = [];

            for ($j = 0; $j < sizeof($data['profile_skills']); $j++) {
                $skillNames[] = $data['profile_skills'][$j]['name'];
            }
            $string_version = implode(',', $skillNames);
            // print_r($string_version);

            // exit;

            $data['name'] = strtolower($data['profiles'][0]['last_name']) . ' ' . strtolower(mb_substr($data['profiles'][0]['first_name'], 0, 1));
            $data['profileURL'] = 'profile/'.$data['profiles'][0]['profile_url'].'/'.$data['profiles'][0]['id'];

            $profileID = $data['profiles'][0]['id'];
            $profileImg = '';

            if (file_exists('./profileimages/256X256/' . $profileID . '.jpg')) {
                $profileImg = base_url() . $this->config->item('product_image_medium') . $profileID . '.jpg';
            } else if (file_exists('./profileimages/256X256/' . $profileID . '.png')) {
                $profileImg = base_url() . $this->config->item('product_image_medium') . $profileID . '.png';
            } else {
                $profileImg = base_url() . $this->config->item('product_noimage_thumb') . 'noimage.jpg';
            }

            //  Profile details schema - Start

            $data['profileImg'] = $profileImg;
            $data['profileskills'] = $string_version;

            $data['candidateName'] = $data['profiles'][0]['last_name'];
            $data['candidateURL'] = 'profile/'.$data['profiles'][0]['profile_url'].'/'.$data['profiles'][0]['id'];
            $data['skills'] = $data['profiles'][0]['skills'];


            //  Profile details schema - End


            if (sizeof($data['profiles'])) {

                $data['og'] = $data['profiles'][0]['last_name'] . ' - ' . $data['profiles'][0]['primary_title'] . ' | Talrn.com';

                $data['title'] = $data['profiles'][0]['last_name'] ." - Top " . $data['profiles'][0]['primary_title'] . " in " . $data['profiles'][0]['city'] . ', ' . $data['profiles'][0]['country'] . ":  | Talrn";

                $data['description'] = $data['profiles'][0]['last_name'] . " is a " . $data['profiles'][0]['primary_title'] . ' based in ' . $data['profiles'][0]['city'] . ', ' . $data['profiles'][0]['country'] . ' with over ' . $data['profiles'][0]['experience'] . ' years of experience . Learn more about ' . $data['profiles'][0]['last_name'] . 's portfolio ';
                //$data['title'] = $data['profiles'][0]['last_name'] . ' is available ' . $data['profiles'][0]['comittment'] . ' based in ' . $data['profiles'][0]['citizenship'] . ', ' . $data['profiles'][0]['country'] . '. Learn more about ' . $data['profiles'][0]['last_name'] . '&#39;s portfolio.';
                ;
                $data['og_image'] = $this->lang->line("profile_og_image");
                $data['body_view'] = 'profiledetails';
                $this->load->view('template/layout_manager', $data);
            } else {
                redirect('my404', 'refresh');
            }
        }
    }
}
