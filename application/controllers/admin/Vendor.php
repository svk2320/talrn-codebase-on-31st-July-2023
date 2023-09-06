<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Vendor extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data["page_title"] = "Vendor";
        $this->load->model("model_stores");
        $this->load->model("model_users");
        $user_id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($user_id);
		$this->data['user_data'] = $user_data;
    }

   public function index()
    {
        $this->load->model("model_users");
        if($this->model_stores->get_draft_profile_count_by_vendor_id($_SESSION['id'])){
            $id = $this->model_stores->getDraftProfileId($_SESSION['id']);
            $this->load->model("model_home");
            
        
            $this->data['profile'] = $this->model_home->getprofilebyid($id);
            $this->data['profile_edu'] = $this->model_home->profile_edu($id);
            $this->data['profile_exp'] = $this->model_home->profile_exp($id);
            $this->data['profile_pro'] = $this->model_home->profile_pro($id);
            $this->data['profile_cert'] = $this->model_home->profile_cert($id);
            
            $profile = $this->model_home->getprofilebyid($id);
            $profile_edu = $this->model_home->profile_edu($id);
            $profile_exp = $this->model_home->profile_exp($id);
            $profile_pro = $this->model_home->profile_pro($id);
            $profile_cert = $this->model_home->profile_cert($id);
            
            $profile_skills = $this->model_home->profile_skills($id);
            
            
            for($i = 0;$i < sizeof($profile_skills);$i++){
                if($profile_skills[$i]['year']==0 && empty($profile_skills[$i]['name'])){$profile_skills[$i]['year']="";} 
                if($profile_skills[$i]['month']==0 && empty($profile_skills[$i]['name'])){$profile_skills[$i]['month']="";} 
            }
                
                
                
                
            $this->data['profile_skills'] = $profile_skills;
            
            $currentTab=0;
            
            if(empty($profile[0]['first_name'])) $currentTab = 0;
            else if (empty($profile[0]['primary_title'])) $currentTab = 1;
            else if (empty($profile_skills[0]['name'])) $currentTab = 2;
            else if (empty($profile_pro[0]['title'])) $currentTab = 3;
            else if (empty($profile_exp[0]['company_name']) && $profile_edu[0]['degree']=="None") $currentTab = 4;
            else if ($profile_edu[0]['degree']=="None") $currentTab = 5;
            else $currentTab = 6;
            
            
            
            
            
            $this->data['currentTab']=$currentTab;
            
            $this->render_template("admin/vendor/index", $this->data);
        }
        else if($_SESSION['username'] == 'Individual'){
            
            $user_data = $this->model_users->getUserData($_SESSION['id']);
            $this->data['firstname'] = $user_data['firstname'] ;
            $this->data['lastname'] = $user_data['lastname'];
            $this->data['city'] = $user_data['city'];
            $this->data['currentTab'] = 0;
            $this->render_template("admin/vendor/index", $this->data);
        }
        else{
            $user_data = $this->model_users->getUserData($_SESSION['id']);
            $this->data['city'] = $user_data['city'];
            $this->data['firstname'] = '';
            $this->data['lastname'] = '';
            $this->data['currentTab'] = 0;
            $this->render_template("admin/vendor/index", $this->data);
        }
        // $this->data['js'] = base_url('assets/js/upload-profile-draft.js');
        
    }

    public function reports()
    {   
        $this->load->model("model_home");
        // $this->data['industry_report'] = $this->model_stores->getIndustryReport();
        // $this->data['skill_report'] = $this->model_stores->getskillReport();
        // $this->data['primary_title_report'] = $this->model_stores->getPrimaryTitleReport();
        // $this->data['profile_views_report'] = $this->model_stores->getProfileViewsReport();
        // $this->data['search_reports'] = $this->model_home->getSearchReport();
        // $this->data['total_unique_visitors'] = $this->model_home->getTotalUniqueVisitors();
        $this->render_template("admin/vendor/reports", $this->data);
    }

    public function report_control()
    {
        $this->data['status'] =  'new';
        $this->render_template("admin/vendor/autocomplete_settings", $this->data);
    }

    public function edit($id)
    {
        $this->load->model("model_home");
        $this->data['profile'] = $this->model_home->getprofilebyid($id);
        $this->data['profile_edu'] = $this->model_home->profile_edu($id);
        $this->data['profile_exp'] = $this->model_home->profile_exp($id);
        $this->data['profile_pro'] = $this->model_home->profile_pro($id);
        $this->data['profile_cert'] = $this->model_home->profile_cert($id);
        $this->data['profile_skills'] = $this->model_home->profile_skills($id);
        $this->data['js'] = base_url('assets/js/upload-profile-edit-v2.js');
        $this->render_template("admin/vendor/edit", $this->data);
    }

    public function uploadProfileImg()
    {
        // Check if the cropped image file exists in the $_FILES array
        if (isset($_FILES['croppedImage']) && !empty($_FILES['croppedImage']['tmp_name'])) {
            
            $file = $_FILES['croppedImage'];
            $destination = './uploads/';
            
            // Retrieve the unique ID from the POST data
            $Id = $this->input->post('uniqueId');
            $userType = $this->input->post('userType');
            
            // Check if the unique ID is not empty
            if ($userType) {
                $profile = $this->model_home->getprofilebyid($Id);
            
                // Get the actual file name
                $filename = str_replace(' ', '_', ucfirst($profile[0]['last_name']) . ' ' . $profile[0]['unique_id'] . ' Talrn.webp');
                
                // storing the image to the database
                $results = $this->model_users->storeProfileImagePath($Id, sprintf('uploads/'. $filename));
            } else {
                // Retrieve the unique ID from the POST data
                $Id = $this->input->post('newUserId');
                
                $filename = str_replace(' ', '_', ucfirst($this->input->post('fileTitle')));
                
                // storing the image to the database
                $results = $this->model_users->storeProfileImagePath($Id, sprintf('uploads/'. $filename));
            }
            
            // Check if a file with the same name already exists
            if (file_exists($destination . $filename)) {
              // Delete the existing file
              unlink($destination . $filename);
            }
        
            // Save the cropped image to a directory
            move_uploaded_file($file['tmp_name'], $destination . $filename);
            
            // Return a response to the client indicating the success or any other relevant information
            $response = array('status' => 'success', 'message' => 'Cropped image saved successfully', 'fileName' => $filename, 'Database_status' => $results);
            echo json_encode($response);
            return;
        }
        
        // Return an error response if the cropped image file is not found
        $response = array('status' => 'error', 'message' => 'Cropped image file not found');
        echo json_encode($response);
    }

    public function deleteProfileImg()
    {
	
        if ($this->input->post('fileTitle') || $this->input->post('uniqueId')) {
            
            $destination = './uploads/';
            $filename = ucfirst($this->input->post('fileTitle'));
            
            // edit page
            $uniqueId = $this->input->post('uniqueId');
            // $uniqueId = $this->input->post('newUserId');
            
                if (file_exists($destination . $filename)) {
                  // Delete the existing file
                  unlink($destination . $filename);
                  
                  // storing the image to the database
                  $results = $this->model_users->deleteProfileImagePath($uniqueId);
                }
                
            // Return a response to the client indicating the success or any other relevant information
            $response = array('status' => 'success', 'message' => 'Deleted image file successfully', 'fileName' => $filename, 'Database_status' => $results);
            echo json_encode($response);
            return;
        }
        
        // Return an error response if the cropped image file is not found
        $response = array('status' => 'error', 'message' => 'Couldn\'t able to deleted image');
        echo json_encode($response);
    }

    public function findUniqueId() 
    {
        //find no of records from table and vendor_id and generate unique id
        $registered_as = $this->model_stores->get_type_by_id($_SESSION['id']);
        if($registered_as == '1'){
            $unique_id = 'TAL'.'O';
        }
        else{
            $unique_id = 'TAL'.'F';
        }
        
        $profile_count = $this->model_stores->no_of_profiles() + 1;
        $next_unique_id = $unique_id.$profile_count;
        
        $response = array('status' => 'success', 'unique_id' => $next_unique_id);
        echo json_encode($response);
    }
	
    public function editformttest($id){
        $job_status = $this->input->post("notice-period");
        echo $job_status;
    }
    
    public function editformdata($id)
    {
        $this->load->model("model_home");
        $profile = $this->model_home->getprofilebyid($id);
        
        $config["allowed_types"] = "*";
        $config["upload_path"] = "./uploads/";
        $config["max_size"] = "0";
        $this->load->library("upload", $config);
        $this->load->library("image_lib");
        $imgName = "";
        $profileName = "";
    
        $Imgdata = $this->upload->data('images');


        if ($this->upload->do_upload("image")) {
            $Imgdata = $this->upload->data();
            $imgName = $Imgdata["file_name"];
            $photo_url = "uploads/" . $imgName;

        } else {
            $photo_url = $profile[0]['userPhoto'];
            //print_r($this->upload->display_errors());
        }
        
        
        
        $profileName = "";

        $eduArr = $this->input->post("list");
        $expArr = $this->input->post("exp");
        $proArr = $this->input->post("project");



        $next_unique_id = $profile[0]['unique_id'];
        $activeStatus = 0;
        $ppm_min = (int)$this->input->post("pph_min");
        $ppm_max = (int)$this->input->post("pph_max");
        $ppm = bcdiv(($ppm_max + $ppm_min),2,2);
        $pph = bcdiv($ppm,160,2);

        $job_title =  preg_replace("/[^a-zA-Z0-9]+/", "-", $this->input->post("primary_title"));
        $profile_url = $job_title."-".$this->input->post("last_name")."-".$this->input->post("first_name")[0];

        $soft_skills = $this->input->post("soft_skills");
        if($soft_skills == null){
            $soft_skills_string = '';
        } else {
            $soft_skills_string = '';
            for ($i = 0; $i < sizeof($soft_skills); $i++) {
                if ($i == 0) {
                    $soft_skills_string .= $soft_skills[$i];
                } else {
                    $soft_skills_string .= ',' . $soft_skills[$i];
                }
            }
        }

        $country_and_code = explode(":",$this->input->post("country"));
        $country_code = $country_and_code[0];
        $country = $country_and_code[1];
        $work_location = serialize($this->input->post('remote_location'));
	    
        $primary_title = $this->input->post("primary_title");
        //trimming primary title for any spaces
        $primary_title = trim($primary_title);
        if($profile[0]['approval'] == 2 || $profile[0]['approval'] == 1 ){
            $approval = 0;
        }else{
            $approval = $profile[0]['approval'];
        }


        $job_status = $this->input->post("job_status");
        $job_status = ($job_status) ? $job_status : '';

        $notice_period = $this->input->post("notice-period");
        $notice_period = ($notice_period) ? $notice_period : '';
        
        $profileData = [
            "vendor_id" => $profile[0]['vendor_id'],
            "unique_id" => $next_unique_id,
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "experience" => $this->input->post("experience"),
            "city" => $this->input->post("city"),
            "country_code" => $country_code,
            "country" => $country,
            "citizenship" => $this->input->post("citizenship"),
            "primary_title" => $primary_title,
            "english" => $this->input->post("english"),
            "reason" => $this->input->post("reason"),
            "skills" => null,
            "comittment" => $this->input->post("comittment"),
            "linkedin" => $this->input->post("linkedin"),
            "github" => $this->input->post("github"),
            // "userPhoto" => $photo_url,
	    "userPhoto" => $this->input->post("imageFilePath"),
            "userResume" => $profile[0]['userResume'],
            "bio" => $this->input->post("bio"),
            "soft_skill" => $soft_skills_string,
            "active"=>$activeStatus,
            "pph" => $pph,
            "ppm" => $ppm,
            "ppm_max" => $ppm_max,
            "ppm_min" => $ppm_min,
            "currency" => $this->input->post("currency"),
            "views" => $profile[0]['views'],
            "pdf" => $profile[0]['pdf'],
            "hire" => $profile[0]['hire'],
            "share" => $profile[0]['share'],
            "date" => $profile[0]['date'],
            "profile_url" => $profile_url,
            "approval" => $approval,
            "work_location" => $work_location,
            "job_status" => $job_status,
            "notice_period" => $notice_period,
            "verified" => $profile[0]['verified'],
            "verified_date" => $profile[0]['verified_date'],
            "custom_url" => $profile[0]['custom_url']
        ];

        $statusOfInsertProfile = $this->model_stores->insertProfiles($profileData);

        // edu
        $eduArr = $this->input->post("list");
        for ($i = 0; $i < sizeof($eduArr); $i++) {
            $eduData[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "degree" => $eduArr[$i][0],
                "major" => $eduArr[$i][1],
                "univ" => $eduArr[$i][2],
                "edu_start" => $eduArr[$i][3],
                "edu_end" => $eduArr[$i][4],
            ];
            $this->model_stores->insertProfilesEdu($eduData[$i]);
        }
        // exp
        $expArr = $this->input->post("exp");
        for ($i = 0; $i < sizeof($expArr); $i++) {
            $expArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "company_name" => $expArr[$i][0],
                "title" => $expArr[$i][1],
                "location" => $expArr[$i][2],
                "emp_type" => $expArr[$i][3],
                "start" => $expArr[$i][4],
                "end" => $expArr[$i][5],
                "description" => $expArr[$i][6],
            ];
            $this->model_stores->insertProfilesExp($expArr[$i]);
        }
        // pro
        $proArr = $this->input->post("project_details");
	    
        //trimming industry name for any space at start and end
        for ($i = 0; $i < sizeof($proArr); $i++) {
            
             $proArr[$i][7] = trim($proArr[$i][7]);
        }

        for ($i = 0; $i < sizeof($proArr); $i++) {
            $proArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "title" => $proArr[$i][0],
                "technologies" => $proArr[$i][1],
                "pro_start" => $proArr[$i][2],
                "pro_end" => $proArr[$i][3],
                "description" => $proArr[$i][4],
                "responsibilities" => $proArr[$i][5],
                "url" => $proArr[$i][6],
                "industry" => $proArr[$i][7]

            ];
            $this->model_stores->insertProfilesPro($proArr[$i]);
        }

        //cert
        $certArr = $this->input->post("cert_details");
        for ($i = 0; $i < sizeof($certArr); $i++) {
            $certArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "name" => $certArr[$i][0],
                "issuer" => $certArr[$i][1],
                "year" => $certArr[$i][2]

            ];
            $this->model_stores->insertProfilesCert($certArr[$i]);
        }

        // profiles_skills
	    
        $skillsArr = $this->input->post("skill_details");
        
        //trimming skills name for any space at start and end
        for ($i = 0; $i < sizeof($skillsArr); $i++) {
            
            $skillsArr[$i][0] = trim($skillsArr[$i][0]);
        }
	    

        for ($i = 0; $i < sizeof($skillsArr); $i++) {
            $skillsArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "name" => $skillsArr[$i][0],
                "year" => $skillsArr[$i][1],
                "month" => $skillsArr[$i][2],
                "active" => 1
            ];
            $this->model_stores->insertProfilesSkills($skillsArr[$i]);
        }



        if ($statusOfInsertProfile) {
            $id = (int) $id;
            if ($id != null) {
                $this->model_stores->delete_profile_edu($id);
                $this->model_stores->delete_profile_exp($id);
                $this->model_stores->delete_profile_pro($id);
                $this->model_stores->delete_profile_cert($id);
                $this->model_stores->delete_profile_skills($id);
                $result = $this->model_stores->delete_profile($id);
                if($result == true){
                    if($profile[0]['approval'] == 0){
                        $message = "?message=Your profile has been sent for approval, We will notify you once your profile goes live!";
                        $this->send_approval_mail($next_unique_id);
                    }elseif($profile[0]['approval'] == 1){
                        $message = "?message=Your profile has been sent for approval, We will notify you once your profile goes live!";
                        $this->send_approval_mail($next_unique_id);
                    }elseif($profile[0]['approval'] == 2){
                        $message = "?message=Your profile has been sent for approval, We will notify you once your profile goes live!";
                        $this->send_approval_mail($next_unique_id);
                    }elseif($profile[0]['approval'] == 3){
                        $message = "?message=This profile is in rejected status, if you think this is an error please email us on vendor@talrn.com";
                    }
                    else{
                        $message = '';
                    }
                    redirect("admin/vendor/list".$message, "refresh");
                }
            }
        }
        redirect("admin/vendor/list", "refresh");
    }

    public function send_approval_mail($unique_id){

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
        $subject = $name .' Profile Pending Approval |'. $unique_id ;
        $message = $name. " has submitted thier profile ". $unique_id ." for review <br> <br>

Profile url: ". base_url('admin/approval/viewprofile/'). $unique_id. " <br>
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
    }

    public function editdraftformdata()
    {
        $step = $this->input->get('step');
        $id = $this->input->get('id');
        $this->load->model("model_home");
        $profile = $this->model_home->getprofilebyid($id);
        
        $config["allowed_types"] = "*";
        $config["upload_path"] = "./uploads/";
        $config["max_size"] = "0";
        $this->load->library("upload", $config);
        $this->load->library("image_lib");
        $imgName = "";
        $profileName = "";
    
        $Imgdata = $this->upload->data('images');


        if ($this->upload->do_upload("image")) {
            $Imgdata = $this->upload->data();
            $imgName = $Imgdata["file_name"];
            $photo_url = "uploads/" . $imgName;

        } else {
            $photo_url = $profile[0]['userPhoto'];
            //print_r($this->upload->display_errors());
        }
        
        
        
        $profileName = "";

        $eduArr = $this->input->post("list");
        $expArr = $this->input->post("exp");
        $proArr = $this->input->post("project");



        $next_unique_id = $profile[0]['unique_id'];
        $activeStatus = 2;
        $ppm_min = (int)$this->input->post("pph_min");
        $ppm_max = (int)$this->input->post("pph_max");

        $ppm = bcdiv(($ppm_max + $ppm_min),2,2);
        $pph = bcdiv($ppm,160,2);

        $job_title =  preg_replace("/[^a-zA-Z0-9]+/", "-", $this->input->post("primary_title"));
        $profile_url = $job_title ."-".$this->input->post("last_name")."-".$this->input->post("first_name")[0];


        $soft_skills = $this->input->post("soft_skills");
        if($soft_skills == null){
            $soft_skills_string = '';
        } else {
            $soft_skills_string = '';
            for ($i = 0; $i < sizeof($soft_skills); $i++) {
                if ($i == 0) {
                    $soft_skills_string .= $soft_skills[$i];
                } else {
                    $soft_skills_string .= ',' . $soft_skills[$i];
                }
            }
        }

        $country_and_code = explode(":",$this->input->post("country"));
        $country_code = $country_and_code[0];
        $country = $country_and_code[1];
        $work_location = serialize($this->input->post('remote_location'));

        $primary_title = $this->input->post("primary_title");
        //trimming primary title for any spaces
        $primary_title = trim($primary_title);

        $job_status = $this->input->post("job_status");
        $job_status = ($job_status) ? $job_status : '';

        $notice_period = $this->input->post("notice-period");
        $notice_period = ($notice_period) ? $notice_period : '';

        $profileData = [
            "vendor_id" => $profile[0]['vendor_id'],
            "unique_id" => $next_unique_id,
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "experience" => $this->input->post("experience"),
            "city" => $this->input->post("city"),
            "country_code" => $country_code,
            "country" => $country,
            "citizenship" => $this->input->post("citizenship"),
            "primary_title" => $primary_title,
            "english" => $this->input->post("english"),
            "reason" => $this->input->post("reason"),
            "skills" => null,
            "comittment" => $this->input->post("comittment"),
            "linkedin" => $this->input->post("linkedin"),
            "github" => $this->input->post("github"),
            // "userPhoto" => $photo_url,
	    "userPhoto" => $profile[0]['userPhoto'],
            "userResume" => $profile[0]['userResume'],
            "bio" => $this->input->post("bio"),
            "soft_skill" => $soft_skills_string,
            "active"=>$activeStatus,
            "pph" => $pph,
            "ppm" => $ppm,
            "ppm_max" => $ppm_max,
            "ppm_min" => $ppm_min,
            "currency" => $this->input->post("currency"),
            "views" => $profile[0]['views'],
            "pdf" => $profile[0]['pdf'],
            "hire" => $profile[0]['hire'],
            "share" => $profile[0]['share'],
            "date" => $profile[0]['date'],
            "profile_url" => $profile_url,
            "work_location" => $work_location,
            "job_status" => $job_status,
            "notice_period" => $notice_period,
            "verified" => $profile[0]['verified'],
            "verified_date" => $profile[0]['verified_date'],
            "custom_url" => $profile[0]['custom_url']
        ];

        $statusOfInsertProfile = $this->model_stores->insertProfiles($profileData);

        // edu
        $eduArr = $this->input->post("list");
        for ($i = 0; $i < sizeof($eduArr); $i++) {
            $eduData[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "degree" => $eduArr[$i][0],
                "major" => $eduArr[$i][1],
                "univ" => $eduArr[$i][2],
                "edu_start" => $eduArr[$i][3],
                "edu_end" => $eduArr[$i][4],
            ];
            $this->model_stores->insertProfilesEdu($eduData[$i]);
        }
        // exp
        $expArr = $this->input->post("exp");
        for ($i = 0; $i < sizeof($expArr); $i++) {
            $expArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "company_name" => $expArr[$i][0],
                "title" => $expArr[$i][1],
                "location" => $expArr[$i][2],
                "emp_type" => $expArr[$i][3],
                "start" => $expArr[$i][4],
                "end" => $expArr[$i][5],
                "description" => $expArr[$i][6],
            ];
            $this->model_stores->insertProfilesExp($expArr[$i]);
        }
        // pro
        $proArr = $this->input->post("project_details");

        //trimming industry name for any space at start and end
        for ($i = 0; $i < sizeof($proArr); $i++) {
            
             $proArr[$i][7] = trim($proArr[$i][7]);
        }

        for ($i = 0; $i < sizeof($proArr); $i++) {
            $proArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "title" => $proArr[$i][0],
                "technologies" => $proArr[$i][1],
                "pro_start" => $proArr[$i][2],
                "pro_end" => $proArr[$i][3],
                "description" => $proArr[$i][4],
                "responsibilities" => $proArr[$i][5],
                "url" => $proArr[$i][6],
                "industry" => $proArr[$i][7]

            ];
            $this->model_stores->insertProfilesPro($proArr[$i]);
        }

        //cert
        $certArr = $this->input->post("cert_details");
        for ($i = 0; $i < sizeof($certArr); $i++) {
            $certArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "name" => $certArr[$i][0],
                "issuer" => $certArr[$i][1],
                "year" => $certArr[$i][2]

            ];
            $this->model_stores->insertProfilesCert($certArr[$i]);
        }

        // profiles_skills
        $skillsArr = $this->input->post("skill_details");

        //trimming skills name for any space at start and end
        for ($i = 0; $i < sizeof($skillsArr); $i++) {
            
            $skillsArr[$i][0] = trim($skillsArr[$i][0]);
        }

        for ($i = 0; $i < sizeof($skillsArr); $i++) {
            $skillsArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "name" => $skillsArr[$i][0],
                "year" => $skillsArr[$i][1],
                "month" => $skillsArr[$i][2],
                "active" => 1
            ];
            $this->model_stores->insertProfilesSkills($skillsArr[$i]);
        }


        if($step == 'tab'){
            if ($statusOfInsertProfile) {
                $id = (int) $id;
                if ($id != null) {
                    $this->model_stores->delete_profile_edu($id);
                    $this->model_stores->delete_profile_exp($id);
                    $this->model_stores->delete_profile_pro($id);
                    $this->model_stores->delete_profile_cert($id);
                    $this->model_stores->delete_profile_skills($id);
                    $result = $this->model_stores->delete_profile($id);
                    if($result == true){
                                $profile_count = $this->model_stores->no_of_profiles() + 0;
                                echo json_encode($profile_count);
                    }
                }
            }
        }else{
            if ($statusOfInsertProfile) {
                $id = (int) $id;
                if ($id != null) {
                    $this->model_stores->delete_profile_edu($id);
                    $this->model_stores->delete_profile_exp($id);
                    $this->model_stores->delete_profile_pro($id);
                    $this->model_stores->delete_profile_cert($id);
                    $this->model_stores->delete_profile_skills($id);
                    $result = $this->model_stores->delete_profile($id);
                    if($result == true){
                                $profile_count = $this->model_stores->no_of_profiles() + 0;
                                redirect('admin/vendor/viewprofile/'.$profile_count);
                    }
                }
            }
        }
        

    }


    public function formdata()
    {
        // echo "<pre>";
        // print_r($_POST);
        // exit;

        $config["allowed_types"] = "*";
        $config["upload_path"] = "./uploads/";
        $config["max_size"] = "0";
        $this->load->library("upload", $config);
        $this->load->library("image_lib");
        $imgName = "";
        $profileName = "";

        $eduArr = $this->input->post("list");
        $expArr = $this->input->post("exp");
        $proArr = $this->input->post("project");
    
        $Imgdata = $this->upload->data('images');


        if ($this->upload->do_upload("image")) {
            $Imgdata = $this->upload->data();
            $imgName = $Imgdata["file_name"];

        } else {
            //print_r($this->upload->display_errors());
        }


        $seesionData = $this->session->userdata("logged_in_sess");

        //find no of records from table and vendor_id and generate unique id
        $registered_as = $this->model_stores->get_type_by_id($_SESSION['id']);
        if($registered_as == '1'){
            $unique_id = 'TAL'.'O';
        }
        else{
            $unique_id = 'TAL'.'F';
        }
        $profile_count = $this->model_stores->no_of_profiles() + 1;
        $next_unique_id = $unique_id.$profile_count;
        $activeStatus = 2;
        $ppm_min = (int)$this->input->post("pph_min");
        $ppm_max = (int)$this->input->post("pph_max");
        $ppm = bcdiv(($ppm_max + $ppm_min),2,2);
        $pph = bcdiv($ppm,160,2);
        $job_title =  preg_replace("/[^a-zA-Z0-9]+/", "-", $this->input->post("primary_title"));
        $profile_url = $job_title."-".$this->input->post("last_name")."-".$this->input->post("first_name")[0];

        $soft_skills = $this->input->post("soft_skills");
        if($soft_skills == null){
            $soft_skills_string = '';
        } else {
            $soft_skills_string = '';
            for ($i = 0; $i < sizeof($soft_skills); $i++) {
                if ($i == 0) {
                    $soft_skills_string .= $soft_skills[$i];
                } else {
                    $soft_skills_string .= ',' . $soft_skills[$i];
                }
            }
        }   
        $country_and_code = explode(":",$this->input->post("country"));
        $country_code = $country_and_code[0];
        $country = $country_and_code[1];
        $work_location = serialize($this->input->post('remote_location'));

        $primary_title = $this->input->post("primary_title");
        //trimming primary title for any spaces
        $primary_title = trim($primary_title);
        $job_status = $this->input->post("job_status");
        $job_status = ($job_status) ? $job_status : '';
        $notice_period = $this->input->post("notice-period");
        $notice_period = ($notice_period) ? $notice_period : '';

        $profileData = [
            "vendor_id" => $_SESSION["id"],
            "unique_id" => $next_unique_id,
            "first_name" => $this->input->post("first_name"),
            "last_name" => $this->input->post("last_name"),
            "experience" => $this->input->post("experience"),
            "city" => $this->input->post("city"),
            "country_code" => $country_code,
            "country" => $country,
            "citizenship" => $this->input->post("citizenship"),
            "primary_title" => $primary_title,
            "english" => $this->input->post("english"),
            "reason" => $this->input->post("reason"),
            "skills" => null,
            "comittment" => $this->input->post("comittment"),
            "linkedin" => $this->input->post("linkedin"),
            "github" => $this->input->post("github"),
            // "userPhoto" => "uploads/" . $imgName,
	    "userPhoto" => $this->input->post("imageFilePath"),
            "userResume" => "uploads/" . $profileName,
            "bio" => $this->input->post("bio"),
            "soft_skill" => $soft_skills_string,
            "active"=>$activeStatus,
            "pph" => $pph,
            "ppm" => $ppm,
            "ppm_max" => $ppm_max,
            "ppm_min" => $ppm_min,
            "currency" => $this->input->post("currency"),
            "profile_url" => $profile_url,
            "work_location" =>  $work_location,
            "job_status" => $job_status,
            "notice_period" => $notice_period
        ];
        //print_r(gettype($profileData['skills']));

        $statusOfInsertProfile = $this->model_stores->insertProfiles(
            $profileData
        );
        // edu
        $eduArr = $this->input->post("list");
        for ($i = 0; $i < sizeof($eduArr); $i++) {
            $eduData[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "degree" => $eduArr[$i][0],
                "major" => $eduArr[$i][1],
                "univ" => $eduArr[$i][2],
                "edu_start" => $eduArr[$i][3],
                "edu_end" => $eduArr[$i][4],
            ];
            $this->model_stores->insertProfilesEdu($eduData[$i]);
        }
        // exp
        $expArr = $this->input->post("exp");
        for ($i = 0; $i < sizeof($expArr); $i++) {
            $expArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "company_name" => $expArr[$i][0],
                "title" => $expArr[$i][1],
                "location" => $expArr[$i][2],
                "emp_type" => $expArr[$i][3],
                "start" => $expArr[$i][4],
                "end" => $expArr[$i][5],
                "description" => $expArr[$i][6],
            ];
            $this->model_stores->insertProfilesExp($expArr[$i]);
        }
        // pro
        $proArr = $this->input->post("project_details");

	    
        //trimming industry name for any space at start and end
        for ($i = 0; $i < sizeof($proArr); $i++) {
            
             $proArr[$i][7] = trim($proArr[$i][7]);
        }

        for ($i = 0; $i < sizeof($proArr); $i++) {
            $proArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "title" => $proArr[$i][0],
                "technologies" => $proArr[$i][1],
                "pro_start" => $proArr[$i][2],
                "pro_end" => $proArr[$i][3],
                "description" => $proArr[$i][4],
                "responsibilities" => $proArr[$i][5],
                "url" => $proArr[$i][6],
                "industry" => $proArr[$i][7]

            ];
            $this->model_stores->insertProfilesPro($proArr[$i]);
        }

        //cert
        $certArr = $this->input->post("cert_details");
        for ($i = 0; $i < sizeof($certArr); $i++) {
            $certArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "name" => $certArr[$i][0],
                "issuer" => $certArr[$i][1],
                "year" => $certArr[$i][2]

            ];
            $this->model_stores->insertProfilesCert($certArr[$i]);
        }

        // profiles_skills
        $skillsArr = $this->input->post("skill_details");

        //trimming skills name for any space at start and end
        for ($i = 0; $i < sizeof($skillsArr); $i++) {
            
            $skillsArr[$i][0] = trim($skillsArr[$i][0]);
        }
        for ($i = 0; $i < sizeof($skillsArr); $i++) {
            $skillsArr[$i] = [
                "profile_id" => $statusOfInsertProfile,
                "name" => $skillsArr[$i][0],
                "year" => $skillsArr[$i][1],
                "month" => $skillsArr[$i][2],
                "active" => 1
            ];
            $this->model_stores->insertProfilesSkills($skillsArr[$i]);
        }

        // resize 256X256 
        if (isset($Imgdata['is_image']) && $Imgdata["is_image"] == 1) {

            $w = $Imgdata["image_width"]; // original image's width
            $h = $Imgdata["image_height"]; // original images's height

            $n_w = 256; // destination image's width
            $n_h = 256; // destination image's height

            $source_ratio = $w / $h;
            $new_ratio = $n_w / $n_h;
            if ($source_ratio != $new_ratio) {
                $config["image_library"] = "gd2";
                $config["source_image"] = $Imgdata["full_path"];
                $config["maintain_ratio"] = false;
                if (
                    $new_ratio > $source_ratio ||
                    ($new_ratio == 1 && $source_ratio < 1)
                ) {
                    $config["width"] = $w;
                    $config["height"] = round($w / $new_ratio);
                    $config["y_axis"] = round(($h - $config["height"]) / 2);
                    $config["x_axis"] = 0;
                } else {
                    $config["width"] = round($h * $new_ratio);
                    $config["height"] = $h;
                    $size_config["x_axis"] = round(($w - $config["width"]) / 2);
                    $size_config["y_axis"] = 0;
                }

                $this->image_lib->initialize($config);
                $this->image_lib->crop();
                $this->image_lib->clear();
            }
            $config["image_library"] = "gd2";
            $config["source_image"] = $Imgdata["full_path"];
            $config["new_image"] = "profileimages/256X256/" . $statusOfInsertProfile . $Imgdata["file_ext"];
            $config["maintain_ratio"] = true;
            $config["width"] = $n_w;
            $config["height"] = $n_h;
            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
                //echo $this->image_lib->display_errors();
            } else {
                //echo "done";
            }
        }

        // resize 340X340
        if (isset($Imgdata['is_image']) && $Imgdata["is_image"] == 1) {
            $w = $Imgdata["image_width"]; // original image's width
            $h = $Imgdata["image_height"]; // original images's height

            $n_w = 340; // destination image's width
            $n_h = 340; // destination image's height

            $source_ratio = $w / $h;
            $new_ratio = $n_w / $n_h;
            if ($source_ratio != $new_ratio) {
                $config["image_library"] = "gd2";
                $config["source_image"] = $Imgdata["full_path"];
                $config["maintain_ratio"] = false;
                if (
                    $new_ratio > $source_ratio ||
                    ($new_ratio == 1 && $source_ratio < 1)
                ) {
                    $config["width"] = $w;
                    $config["height"] = round($w / $new_ratio);
                    $config["y_axis"] = round(($h - $config["height"]) / 2);
                    $config["x_axis"] = 0;
                } else {
                    $config["width"] = round($h * $new_ratio);
                    $config["height"] = $h;
                    $size_config["x_axis"] = round(($w - $config["width"]) / 2);
                    $size_config["y_axis"] = 0;
                }

                $this->image_lib->initialize($config);
                $this->image_lib->crop();
                $this->image_lib->clear();
            }
            $config["image_library"] = "gd2";
            $config["source_image"] = $Imgdata["full_path"];
            $config["new_image"] = "profileimages/340X340/" . $statusOfInsertProfile . $Imgdata["file_ext"];
            $config["maintain_ratio"] = true;
            $config["width"] = $n_w;
            $config["height"] = $n_h;
            $this->image_lib->initialize($config);

            if (!$this->image_lib->resize()) {
                //echo $this->image_lib->display_errors();
            } else {
                //echo "done";
            }
        }
        // exit();
	    $profile_count = $this->model_stores->no_of_profiles() + 0;
            echo json_encode($profile_count);
    }

    public function list()
    {   
        
        $this->data['message'] = $this->input->get('message');

        $this->render_template("admin/vendor/list", $this->data);
    }

    public function global_profile_list()
    {   
        if(in_array('viewPartner', $this->permission)){
            $getallrecords = $this->model_stores->getallprofilespartner();
        } else {
        $getallrecords = $this->model_stores->getallprofilesbyvendoridpartner($_SESSION['id'], 'donotsetlimit');
        }

        $this->data["list"] = $getallrecords;
        $store_data = $this->model_stores->getStoresData($_SESSION['store_id']);
        $user_id = $_SESSION['id'];
        $this->load->model("model_users");
        $user_data = $this->model_users->getUserData($user_id);
        $company_name = urlencode($store_data['name']);
        $company_website = $store_data['website'];
        $company_email = $_SESSION['email'];
        $company_phone = $user_data['phone'];
        $this->data['pdf_parameters'] = '?company_name='. $company_name .'&website='. $company_website.'&email='. $company_email.'&phone='. $company_phone;

        $this->render_template("admin/vendor/partner_list", $this->data);
    }

    public function deleteuser($userid = null)
    {
        $message = null;
        $userid = (int) $userid;
        if (!preg_match('/^\d+$/', $userid))
            redirect('admin/vendor/list');

        $returnvals = $this->model_stores->getallprofilesbyid($userid);

        $activeStatus = $returnvals[0]['active'] === '1' ? 0 : 1;

        if (!empty($returnvals)) {
            $updatedarray = array(
                "active" => $activeStatus
            );
            $where = array("id" => $userid);
            $result = $this->model_stores->insertOrUpdateUsers($updatedarray, 1, $where);
            if ($result == true) {
                $message = "User Deleted";
            }
        } else {
            $message = "Cannot delete users";
        }
        redirect('admin/vendor/list', 'refresh');
    }
    
    public function permdeleteuser($userid = null)
    {
        if(in_array('modifyProfile', $this->permission)){
            $id = (int) $userid;
            $message = null;
            
            $this->load->model('Model_deleted_profiles');
            
            $result = $this->Model_deleted_profiles->insertDeletedProfiles($id);
            
            if ($id != null) {
                $this->model_stores->delete_profile_edu($id);
                $this->model_stores->delete_profile_exp($id);
                $this->model_stores->delete_profile_pro($id);
                $this->model_stores->delete_profile_skills($id);
                $this->model_stores->delete_profile_cert($id);
                $result = $this->model_stores->delete_profile($id);
                if($result == true){
                    $message = "User Deleted";
                }
            }
            else {
                $message = "Cannot delete users";
            }
            redirect('admin/vendor/list', 'refresh');
        }
        else{
            echo "Delete only allowed for admin user";
        }

    }

    public function remove()
	{
		// if(!in_array('deleteVendor', $this->permission)) {
		// 	redirect('admin/vendor/list', 'refresh');
		// }
        $response = 0;
		$profile_id = $this->input->post('profile_id');
        $profile_status = $this->input->post('profile_status');

        // echo '<pre>';
        // print_r($profile_id);
        // echo '<br>';
        // print_r($profile_status);

		$response = array();
		if($profile_id) {
			$delete = $this->model_stores->remove_profile($profile_id, $profile_status);
            print_r($delete);
            exit;
			if($delete == true) {
                $response = 1;
                echo 1;
			}
			else {
                $response = 0;
                echo 0;
			}
		}
		else {
            $response = 0;
            echo 0;
		}
        echo json_encode($response); 
		//echo json_encode($response);
        //redirect('admin/vendor/list', 'refresh');
	}


    public function skill_replace()
    {
        $mergeArr = $this->input->post("skill_merge_list");
        $replace_string = $this->input->post("skill_replace");
        if($mergeArr == null){
            $this->data['status'] = 'failure';
            $this->data['message'] =  'Please select skills to merge';
        }
         else {
            $result = $this->model_stores->replaceSkills($mergeArr, $replace_string);
            if($result == true){
                $this->data['status'] =  'success';
                $this->data['message'] =  'Skills successfully updated';
            }
            else{
                $this->data['status'] =  'failure';
                $this->data['message'] =  'Could not update skills';
            }
        }
        $this->render_template("admin/vendor/autocomplete_settings", $this->data);
    }

    public function industry_replace()
    {
        $mergeArr = $this->input->post("industry_merge_list");
        $replace_string = $this->input->post("industry_replace");
        if($mergeArr == null){
            $this->data['status'] = 'failure';
            $this->data['message'] =  'Please select industries to merge';
        }
         else {
            $result = $this->model_stores->replaceIndustries($mergeArr, $replace_string);
            if($result == true){
                $this->data['status'] =  'success';
                $this->data['message'] =  'Industries successfully updated';
            }
            else{
                $this->data['status'] =  'failure';
                $this->data['message'] =  'Could not update industries';
            }
        }
        $this->render_template("admin/vendor/autocomplete_settings", $this->data);
    }

    public function job_title_replace()
    {
        $mergeArr = $this->input->post("job_title_merge_list");
        $replace_string = $this->input->post("job_title_replace");
        if($mergeArr == null){
            $this->data['status'] = 'failure';
            $this->data['message'] =  'Please select Job titles to merge';
        }
         else {
            $result = $this->model_stores->replaceJobTitle($mergeArr, $replace_string);
            if($result == true){
                $this->data['status'] =  'success';
                $this->data['message'] =  'Job titles successfully updated';
            }
            else{
                $this->data['status'] =  'failure';
                $this->data['message'] =  'Could not update Job titles';
            }
        }
        $this->render_template("admin/vendor/autocomplete_settings", $this->data);
    }
	
  public function viewprofile($id)
  {

		if (sizeof($this->model_home->getprofilebyid($id)) == 0) {
			redirect('my404', 'refresh');
		} else {
			$data['title'] = $this->lang->line("profdetail_title");
			$data['description'] = $this->lang->line("profdetaildescription_title");
			$this->model_home->IncreaseProfileViewcount($id);
			$data['profiles'] = $this->model_home->getprofilebyid($id);
			$data['profile_edu'] = $this->model_home->profile_edu($id);
			$data['profile_exp'] = $this->model_home->profile_exp($id);
			$data['profile_pro'] = $this->model_home->profile_pro($id);
			$data['profile_cert'] = $this->model_home->profile_cert($id);
			$data['profile_skills'] = $this->model_home->profile_skills($id);

			$skillNames = [];

			for ($j = 0; $j < sizeof($data['profile_skills']); $j++) {
				$skillNames[] = $data['profile_skills'][$j]['name'];
			}
			$string_version = implode(',', $skillNames);
			// print_r($string_version);

			// exit;

			$data['name'] = strtolower($data['profiles'][0]['last_name']) . ' ' . strtolower(mb_substr($data['profiles'][0]['first_name'], 0, 1));
			$data['profileURL'] = 'profile/' . $data['profiles'][0]['profile_url'] . '/' . $data['profiles'][0]['id'];

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
			$data['candidateURL'] = 'profile/' . $data['profiles'][0]['profile_url'] . '/' . $data['profiles'][0]['id'];
			$data['skills'] = $data['profiles'][0]['skills'];


			//  Profile details schema - End


			if (sizeof($data['profiles'])) {

				$data['og'] = $data['profiles'][0]['last_name'] . ' - ' . $data['profiles'][0]['primary_title'] . ' | Talrn.com';

				$data['title'] = $data['profiles'][0]['last_name'] . " - Top " . $data['profiles'][0]['primary_title'] . " in " . $data['profiles'][0]['city'] . ', ' . $data['profiles'][0]['country'] . ":  | Talrn";

				$data['description'] = $data['profiles'][0]['last_name'] . " is a " . $data['profiles'][0]['primary_title'] . ' based in ' . $data['profiles'][0]['city'] . ', ' . $data['profiles'][0]['country'] . ' with over ' . $data['profiles'][0]['experience'] . ' years of experience . Learn more about ' . $data['profiles'][0]['last_name'] . 's portfolio ';
				//$data['title'] = $data['profiles'][0]['last_name'] . ' is available ' . $data['profiles'][0]['comittment'] . ' based in ' . $data['profiles'][0]['citizenship'] . ', ' . $data['profiles'][0]['country'] . '. Learn more about ' . $data['profiles'][0]['last_name'] . '&#39;s portfolio.';
				;

				
				$this->load->view('admin/vendor/submit_profileview', $data);
			} else {
				redirect('my404', 'refresh');
			}
		}
	}

	public function changestatus($id)
	{   
	    $this->model_stores->changeProfileStatus($id);
	    $message = "?message=Your profile has been sent for approval, We will notify you once your profile goes live!";
	redirect("admin/vendor/list".$message, "refresh");	
	}

	public function changestatusToInactive($id)
	{   
	    $this->model_stores->changeProfileStatusToInactive($id);
	    $message = "?message=Your profile has been sent for approval, We will notify you once your profile goes live!";
	redirect("admin/vendor/list".$message, "refresh");
	}

   public function applied_jobs()
    {
        $this->render_template("admin/vendor/applied_jobs", $this->data);
    }
    
    public function fetchAppliedJobs()
	{
	    $vendorId = $this->session->userdata('id');
	    
	    $this->load->model('model_requirements');
	    
	   // get the applied jobs list from database
	    $data = $this->model_requirements->getAppliedJobs($vendorId);

		$result = array('data' => array());

		foreach ($data as $key => $value) {

			$buttons = '';

			$buttons .= '<a href="' . base_url('job/' . strtolower(str_replace(' ', '-', $value['job_title'])) . '-' . strtolower($value['jd_id'])) . '" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="view profile" style="margin-right: 10px;" target="_blank"><i class="fa fa-eye"></i></a>';

			$result['data'][$key] = array(
				$value['jd_id'],
				$value['date'],
				$value['job_title'],
				$value['unique_id'],
				$value['first_name'] . " " . $value['last_name'],
				$buttons
			);
		}

		echo json_encode($result);
	}
  	public function landing_page_profiles()
    {
        $this->render_template("admin/vendor/landing_page_profiles", $this->data);
    }
    
    public function fetchApprovedJobs()
    {
	    
	    $this->load->model('model_users');
	    
	   // get the applied jobs list from database
	    $data = $this->model_users->getApprovedProfiles();
	
		$result = array('data' => array());
	
		foreach ($data as $key => $value) {
	
			$buttons = '';
	    $projects = '';
	    $employer = '';
	
	    // Generate the HTML for the projects
	    foreach (explode(", ", $value['projects']) as $projectTitle) {
		$projects .= strlen($projectTitle) > 20 ? substr($projectTitle,0,20).'...' : $projectTitle;
		$projects .= '<br />';
	    }
	    
	    // Generate the HTML for the employers  
	    foreach (explode(", ", $value['employer']) as $employerName) {
	       $employer .= strlen($employerName) > 20 ? substr($employerName,0,20).'...' : $employerName;
	       $employer .= '<br />';
	    }
	    
	    if ($value['highlight'] === '1') {
			 //   $buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Change Status" onclick="openCustomModal(\'Change Highlight Status\', \'Are you sure you don\'t want to show your &quot;Highlight&quot;?\', \'okButton\', \'closeButton\', \'' . $value['id'] . '\', \'\')"><i class="fa fa-toggle-on"></i></button>';
			    $buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Change Status" onclick="openCustomModal(\'Change Highlight Status\', \'Do you really want to hide your Highlight? \', \'okButton\', \'closeButton\', \'' . $value['id'] . '\', \'\')"><i class="fa fa-toggle-on"></i></button>';
			}
			
			if ($value['highlight'] === '0') {
			    $buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Change Status" onclick="openCustomModal(\'Change Hightlight Status\', \'Are you sure you want to shows your Hightlight? \', \'okButton\', \'closeButton\', \'' . $value['id'] . '\', \'input\')"><i class="fa fa-toggle-off"></i></button>';
			}
	
	    // Add the row data to the result array
	    $result['data'][$key] = array(
		$value['unique_id'],
		$value['first_name'] . " " . $value['last_name'],
		// $value['primary_title'],
		strlen($value['primary_title']) > 23 ? substr($value['primary_title'],0,23).'...' : $value['primary_title'],
		$employer,
		$projects,
		$value['highlight'] === '1' ? '<span class="text-blue">Active</span>' : '<span class="text-red">Inactive</span>',
		$buttons,
	    );
		}
	
		echo json_encode($result);
	}

    public function change_highlight_status($id)
    {
        $highlightText = $this->input->post('highlightText');
		$this->load->model('model_users');

        if ($highlightText){
            
            $totalHightlights = $this->model_users->getTotalHightlights();
            
            $changeHighlightStatus = ($highlightText == "undefined" ? -1 : 1);
            
            $totalCardsAfterMadeChanges = $totalHightlights + $changeHighlightStatus;
            
            if((($totalCardsAfterMadeChanges > 4) && ($totalCardsAfterMadeChanges < 11)) || ($totalCardsAfterMadeChanges <= 4 && $changeHighlightStatus == 1)){
                $data = $this->model_users->updateProfileHighlightStatus($id, $highlightText);
                
                $data = $this->model_users->getTotalHightlights();
                
                $response = array('status' => 'success', 'userId' => $id, 'totalHightlights' => $totalHightlights, '$changeHighlightStatus' => $changeHighlightStatus, '$totalCardsAfterMadeChanges' => $totalCardsAfterMadeChanges, 'highlightCount' => true, 'totalHighlight' => ($totalHightlights + $changeHighlightStatus));
            } else {
                $response = array('status' => 'success', 'userId' => $id, 'totalHightlights' => $totalHightlights, 'highlightCount' => false, 'totalHighlight' => ($totalHightlights + $changeHighlightStatus));
            }
        }else {
            $this->data['message'] = "Cannot update profile highlight status";
        }
            echo json_encode($response);
    }
    
    public function change_highlight_status_below($id)
    {
		$this->load->model('model_users');

        if ($id){
                $data = $this->model_users->updateProfileHighlightStatus($id);
                
                $data = $this->model_users->getTotalHightlights();
                
                $response = array('status' => 'success', 'userId' => $id);
        }else {
            $response = array('status' => 'fail', 'userId' => $id);
        }
            echo json_encode($response);
    }

    public function deleted_profiles()
    {
        $this->render_template("admin/vendor/deleted_profiles", $this->data);
    }
}
