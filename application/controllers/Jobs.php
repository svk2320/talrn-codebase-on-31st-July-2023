<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobs extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_requirements');
    }

    public function index()
    {   
        $data['title'] = $this->lang->line("remotejobs_title");
        $data['description'] = $this->lang->line("remotejobs_description_title");
        $data['og'] = $this->lang->line("remotejobs_title");
        $data['og_image'] = $this->lang->line("remotejobs_og_image");

        $this->load->library('pagination');
        $this->load->helper('url');

        $config["base_url"] = base_url() . 'remote-ios-jobs';
        $config['total_rows'] = (int)$this->model_requirements->getLiveRequirementsCount();
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
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;


        $this->pagination->initialize($config);

        $latest_jobs = $this->model_requirements->getLiveRequirements($config["per_page"], $page);
        
        $userType = $this->model_home->checkIndividualOrOrganization($_SESSION['id'] ?? null);
        
        if ($userType == 1){
            $profile_skills = $this->model_home->getOrgProfileSkillsets($_SESSION['id']);
            
            function calculateMatchPercentage($jd, $org) {
                if (!is_array($jd) || !is_array($org) || !isset($jd['technical_skills']) || !isset($org['skillsets'])) {
                    // Handle the error condition appropriately
                    return 0;
                }
            
                $jd_skillsets = array_map('strtolower', array_map('trim', explode(',', $jd['technical_skills'])));
                $org_skillsets = array_map('strtolower', array_map('trim', explode(',', $org['skillsets'])));
                $match_count = count(array_intersect($jd_skillsets, $org_skillsets));
                $match_percentage = ($match_count / count($jd_skillsets)) * 100;
                return $match_percentage;
            }
            
            foreach ($latest_jobs as $key => &$job) {
                $max_match_percentage = 0;
                $best_matched_profile = null;
            
                if ($profile_skills){
                    foreach ($profile_skills as &$profile) {
                        $match_percentage = calculateMatchPercentage($job, $profile);
                        if ($match_percentage > $max_match_percentage) {
                            $max_match_percentage = $match_percentage;
                            $best_matched_profile = $profile;
                        }
                    }
                
                    if ($best_matched_profile != null && $best_matched_profile['approval'] != 1) {
        				$profile_url = base_url('admin/profile/viewprofile/' . strtolower($best_matched_profile['unique_id']));
        			} else if ($best_matched_profile != null) {
        				$profile_url = base_url('profile/' . strtolower($best_matched_profile['profile_url']) . '/' . strtolower($best_matched_profile['unique_id']));
        			} else {
        			    $profile_url = null;
        			}
                
                    $latest_jobs[$key]['best_org_unique_id'] = $best_matched_profile == null ? 'none' : $best_matched_profile['unique_id'];
                    $latest_jobs[$key]['best_org_profile_url'] = $profile_url;
                    $latest_jobs[$key]['match_percentage'] = $max_match_percentage;
                    $latest_jobs[$key]['no_profiles'] = false;
                } else {
                    $latest_jobs[$key]['best_org_unique_id'] = 'none';
                    $latest_jobs[$key]['best_org_profile_url'] = 0;
                    $latest_jobs[$key]['match_percentage'] = 0;
                    $latest_jobs[$key]['no_profiles'] = true;
                }
            }
        } else if ($userType == 2) {
            $profile_skills = $this->model_home->getProfileSkills($_SESSION['id']);
            
    		foreach ($latest_jobs as &$job_skill) {
                $skillTechnicalSkills = array_map('strtolower', array_map('trim', explode(',', $job_skill['technical_skills'])));
                $matchCount = 0;
                
                if ($profile_skills) {
                    foreach ($profile_skills as $profile_skill) {
                        $skillName = strtolower(trim($profile_skill['name']));
                        if (in_array($skillName, $skillTechnicalSkills)) {
                            $matchCount++;
                        }
                    }
                    
                    $matchPercentage = ($matchCount / count($skillTechnicalSkills)) * 100;
                    $job_skill['match_percentage'] = number_format($matchPercentage, 0);
                    $job_skill['no_profiles'] = false;
                } else {
                    $job_skill['match_percentage'] = 0;
                    $job_skill['no_profiles'] = true;
                }
                
            }
        } else {
            $userType = 0;
        }
        
        $data['job_list'] = $latest_jobs;
        $data['userType'] = $userType;
        $data["links"] = $this->pagination->create_links();
        $data['body_view'] = 'jobs';
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('template/layout_manager', $data);
    }

    public function job($url)
    {   
        $url = urldecode($url);
        $data['job_details'] = $this->model_requirements->getrequirementbyurl($url);
        
        if (empty($data['job_details'])) {
                $data['title'] = 'Job Not Found | Talrn';
                $data['description'] = 'The requested job could not be found.';
                $data['og'] = 'Job Not Found | Talrn';
                $data['og_image'] = $this->lang->line("job_og_image");
                $data['body_view'] = 'error_jobnotfound_view';
                $this->load->view('template/layout_manager', $data);
            return;
        }
        
        $job_details = $this->model_requirements->getrequirementbyurl($url);
        
        $userType = $this->model_home->checkIndividualOrOrganization($_SESSION['id'] ?? null);
        
        $data['userType'] = $userType;
        
        if ($userType == 1){
            $profile_skills = $this->model_home->getOrgProfileSkillsets($_SESSION['id']);
            
            function calculateMatchPercentage($jd, $org) {
                if (!is_array($jd) || !is_array($org) || !isset($jd['technical_skills']) || !isset($org['skillsets'])) {
                    // Handle the error condition appropriately
                    return 0;
                }
            
                $jd_skillsets = array_map('strtolower', array_map('trim', explode(',', $jd['technical_skills'])));
                $org_skillsets = array_map('strtolower', array_map('trim', explode(',', $org['skillsets'])));
                $match_count = count(array_intersect($jd_skillsets, $org_skillsets));
                $match_percentage = ($match_count / count($jd_skillsets)) * 100;
                return $match_percentage;
            }
            
            foreach ($job_details as $key => &$job) {
                $max_match_percentage = 0;
                $best_matched_profile = null;
            
                if($profile_skills){
                    foreach ($profile_skills as &$profile) {
                        $match_percentage = calculateMatchPercentage($job, $profile);
                        if ($match_percentage > $max_match_percentage) {
                            $max_match_percentage = $match_percentage;
                            $best_matched_profile = $profile;
                        }
                    }
                
                    if ($best_matched_profile != null && $best_matched_profile['approval'] != 1) {
        				$profile_url = base_url('admin/profile/viewprofile/' . strtolower($best_matched_profile['unique_id']));
        			} else if ($best_matched_profile != null) {
        				$profile_url = base_url('profile/' . strtolower($best_matched_profile['profile_url']) . '/' . strtolower($best_matched_profile['unique_id']));
        			} else {
        			    $profile_url = null;
        			}
                
                    $job_details[$key]['best_org_unique_id'] = $best_matched_profile == null ? 'none' : $best_matched_profile['unique_id'];
                    $job_details[$key]['best_org_profile_url'] = $profile_url;
                    $job_details[$key]['match_percentage'] = $max_match_percentage;
                    $job_details[$key]['no_profiles'] = false;
                } else {
                    $job_details[$key]['best_org_unique_id'] = 'none';
                    $job_details[$key]['best_org_profile_url'] = 0;
                    $job_details[$key]['match_percentage'] = 0;
                    $job_details[$key]['no_profiles'] = true;
                }
            }
            } else if ($userType == 2) {
                $profile_skills = $this->model_home->getProfileSkills($_SESSION['id']);
                
                foreach ($job_details as &$job_skill) {
                    $skillTechnicalSkills = array_map('strtolower', array_map('trim', explode(',', $job_skill['technical_skills'])));
                    $matchCount = 0;
                    
                    if ($profile_skills) {
                        foreach ($profile_skills as $profile_skill) {
                            $skillName = strtolower(trim($profile_skill['name']));
                            if (in_array($skillName, $skillTechnicalSkills)) {
                                $matchCount++;
                            }
                        }
                        
                        $matchPercentage = ($matchCount / count($skillTechnicalSkills)) * 100;
                        $job_skill['match_percentage'] = number_format($matchPercentage, 0);
                        $job_skill['no_profiles'] = 0;
                    } else {
                        $job_skill['match_percentage'] = 0;
                        $job_skill['no_profiles'] = 1;
                    }
                }
            } else {
                $userType = 0;
            }
        
        $data['job_details'] = $job_details;
        $data['title'] = ($data['job_details'][0]['job_location_type'] == 'TELECOMMUTE')
            ? ('Remote ' . $data['job_details'][0]['job_title'] . ' Jobs | Talrn')
            : ($data['job_details'][0]['job_title'] . ' Job in ' . $data['job_details'][0]['location'] . ' | Talrn');
        $data['description'] = 'Become a '.$data['job_details'][0]['job_title'].' and connect with the top companies hiring '.$data['job_details'][0]['job_title'].'. Apply now at Talrn Jobs';   
        $data['og'] = ($data['job_details'][0]['job_location_type'] == 'TELECOMMUTE')
                    ? ('Remote ' . $data['job_details'][0]['job_title'] . ' Jobs | Talrn')
                    : ($data['job_details'][0]['job_title'] . ' Job in ' . $data['job_details'][0]['location'] . ' | Talrn');
        $data['og_image'] = $this->lang->line("job_og_image");
        $data['body_view'] = 'job';
        
        if ($this->session->userdata('logged_in')) {
            $userId = $this->session->userdata('id');
            $userType = $this->session->userdata('registered_as');
            if($userType == 2){
                $unique_id = $this->model_requirements->getUniqueId($userId);

                if ($unique_id != null){
                    $data['already_applied'] = $this->model_requirements->profileAlreadyInJob($unique_id,$data['job_details'][0]['jd_id']);
                }
                else{
                    $data['already_applied'] = false;
                }
            }
            else{
                $data['already_applied'] = false;
            }
        }else{
            $data['already_applied'] = false;
        }
        // $data['already_applied'] = false;
        $this->load->view('template/layout_manager', $data);
    }
    
    public function applyJob() {
        if ($this->session->userdata('logged_in')) {
            // User is logged in
            
            $userId = $this->session->userdata('id');
            $jd_id = $this->input->post('jobId');
            $unique_id = $this->input->post('unique_id');
            
            // get the registered_as from stores to check whether account is belongs to individual or organisation
            // $userType = $this->model_requirements->checkIndividualOrOrganization($userId);

            $userType = $this->session->userdata('registered_as');
            if($this->session->userdata('type') == 'client'){
                $response = array('login_status' => 'not logged in','type' => 'client');
            }
            else if ($userType == 1 && strcmp($unique_id, "null") === 0) {
                
                $list = $this->model_requirements->getListOfUnapprovalProfiles($userId, $jd_id); // 4 array
                $job_details = $this->model_requirements->getrequirementbyjdId($jd_id); // 1 array
                
                foreach ($list as &$profile) {
                    $skillTechnicalSkills = array_map('strtolower', array_map('trim', explode(',', $profile['skillsets'])));
                    $matchCount = 0;
                    
                    $totalskills = array_map('strtolower', array_map('trim', explode(',', $job_details[0]['technical_skills'])));
                    
                    foreach (array_map('strtolower', array_map('trim', explode(',', $job_details[0]['technical_skills']))) as $job_skill) {
                        if (in_array($job_skill, $skillTechnicalSkills)) {
                            $matchCount++;
                        }
                    }
                    
                    $matchPercentage = ($matchCount / count($totalskills)) * 100;
                    $profile['match_percentage'] = number_format($matchPercentage, 0);
                }
                
                usort($list, function($a, $b) {
                    return $b['match_percentage'] - $a['match_percentage'];
                });

                
                $response = array('login_status' => 'logged in', 'userId' => $userId, 'jobId' => $jd_id, 'userType' => $userType, 'unique_id' => $unique_id,'list' => $list, 'jd' => $job_details);
            } elseif($userType == 2) {
                $unique_id = $this->model_requirements->getUniqueId($userId);

                if ($unique_id == null){

                    $data = array(
                        'jd_id' => $jd_id,
                        'unique_id' => $unique_id
                    );

                    $response = array('login_status' => 'logged in', 'userId' => $userId, 'jobId' => $jd_id, 'userType' => $userType, 'unique_id' => $unique_id, 'data' => $data);
                }else{
                
                    $data = array(
                        'jd_id' => $jd_id,
                        'unique_id' => $unique_id
                    );
                    
                    $this->model_requirements->addToJobProfileList($data);
                    $this->send_job_apply_email($jd_id,$unique_id);
                    // Return a response to the client indicating the success 
                    $response = array('login_status' => 'logged in', 'userId' => $userId, 'jobId' => $jd_id, 'userType' => $userType, 'unique_id' => $unique_id, 'data' => $data);
                }
            } else {
                $data = array(
                    'jd_id' => $jd_id,
                    'unique_id' => $unique_id
                );
                
                $this->model_requirements->addToJobProfileList($data);
                $this->send_job_apply_email($jd_id,$unique_id);
                // Return a response to the client indicating the success 
                $response = array('login_status' => 'logged in', 'userId' => $userId, 'jobId' => $jd_id, 'userType' => 'subprofiles', 'unique_id' => $unique_id, 'data' => $data);
            }
            
            echo json_encode($response);
            return;
            
        } else {
            // User is not logged in
            
            // Return a response to the client indicating the fail
            $response = array('login_status' => 'not logged in');
            echo json_encode($response);
            return;
        }
    }

    public function send_job_apply_email($jd_id,$unique_id){
        $job_details = $this->model_requirements->getrequirementbyjd_id($jd_id);
        $result =  $this->model_home->getidbyuniqueid($unique_id); 
        $id = $result[0]['id'];
        
        $profile =  $this->model_home->getprofilebyid($id);
        
        $name = $profile[0]['first_name']. ' ' . $profile[0]['last_name'];

        $now = time();
        $formattedDate = date('jS F Y g:i a', $now);

        $type = $_SESSION['registered_as'];
        if ($type == 1){
            $vendor_type = 'Organisation';
        }else{
            $vendor_type = 'Individual';
        }
        $from = 'vendor-status@talrn.com';
        $to = 'notify@talrn.com';
        $subject = $name .' has applied for '. $job_details[0]['job_title']. ' | '. $jd_id ;
        $message = $name. " has submitted his profile ". $unique_id ." for ". $job_details[0]['job_title']. " job <br><br>

Job url: ". base_url('admin/requirements/applied/').$jd_id. " <br>
Profile url: ". base_url('profile/'). $unique_id. " <br>
Application date and time: " . $formattedDate ." <br>
Vendor Type: " .$vendor_type ."n <br>

please review the profile
        ";

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'mail.talrn.com',
            'smtp_port' => 25,
            'smtp_user' => 'vendor-status@talrn.com',
            'smtp_pass' => 'ILFjvJp@gC4P',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => 'TRUE'
        );
        $this->email->initialize($config);
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
        //echo $message;
    }
}
