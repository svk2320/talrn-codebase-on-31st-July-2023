<?php

class Dashboard extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Dashboard';
	}

	public function index_admin()
	{
		$group_id = $this->data['group_data']['group_id'];
		$is_admin = (in_array('viewAdmin', $this->permission)) ? true : false;
		$this->load->model('Model_groups');
		$this->data['is_admin'] = $is_admin;
		$this->data['profile_count'] = $this->Model_groups->noOfProfiles();
		$this->data['active'] = $this->Model_groups->noOfActives();
		$this->data['inactive'] = $this->Model_groups->noOfInactives();
		$this->data['active_org'] = $this->Model_groups->noOfActivesOrg();
		$this->data['total_individual_count'] = $this->Model_groups->noOfIndividual();
        $this->data['total_organisation_count'] = $this->Model_groups->noOfOrganisation();
		$this->data['organisation_count'] = $this->Model_groups->noOfAgencies();
		$this->data['inactive_org'] = $this->Model_groups->noOfInactivesOrg();
		$this->data['active_ind'] = $this->Model_groups->noOfActivesInd();
		$this->data['individual_count'] = $this->Model_groups->noOfFreelancers();
		$this->data['inactive_ind'] = $this->Model_groups->noOfInactivesInd();
		$this->data['users_count'] = $this->Model_groups->noOfUsers();
		$this->data['upload_profile_users'] = $this->Model_groups->noOfUploadUsers();
		$this->data['no_upload_profile_users'] = $this->data['users_count'] - $this->data['upload_profile_users'];
		$this->data['active_profile_view_count'] = $this->Model_groups->noOfActiveProfileViews();
		$this->data['profile_view_count'] = $this->Model_groups->noOfProfileViews();
		$this->data['inactive_profile_view_count'] = $this->Model_groups->noOfInActivefProfileViews();
		$this->data['active_skills_count'] = $this->Model_groups->noOfActiveSkills();
		$this->data['skills_count'] = $this->Model_groups->noOfSkills();
		$this->data['inactive_skills_count'] = $this->Model_groups->noOfInActiveSkills();
		$this->data['active_industries_count'] = $this->Model_groups->noOfActiveIndustries();
		$this->data['industries_count'] = $this->Model_groups->noOfIndustries();
		$this->data['inactive_industries_count'] = $this->Model_groups->noOfInActiveIndustries();
		$this->data['active_projects_count'] = $this->Model_groups->noOfActiveProjects();
		$this->data['projects_count'] = $this->Model_groups->noOfProjects();
		$this->data['inactive_projects_count'] = $this->Model_groups->noOfInActiveProjects();
		$this->data['pending_application_count'] = $this->Model_groups->pendingApplicationCount();
		$this->data['total_application_count'] = $this->Model_groups->jobApplicationCount();
		$this->data['search_reports'] = $this->model_home->getSearchReportDashboard();
		$this->data['pending_count'] = $this->Model_groups->noOfPending();
		$this->data['awaiting_count'] = $this->Model_groups->noOfAwaiting();
		$this->data['client_pending_count'] = $this->Model_groups->noOfPendingClientJobs();
		$this->data['client_approved_count'] = $this->Model_groups->noOfApprovedClientJobs();
		$this->data['total_clients_count'] = $this->Model_groups->noOfClients();
		if ($is_admin) {
			$this->render_template('admin/dashboard/admin_dashboard', $this->data);
		}
	}

	public function index_vendor()
	{
		$group_id = $this->data['group_data']['group_id'];
		$is_admin = (in_array('viewAdmin', $this->permission)) ? true : false;
		$this->load->model('Model_groups');

		$this->data['search_reports'] = $this->model_home->getSearchReportDashboardForVendors();

		$this->data['profile_view_count_vendor'] = $this->Model_groups->ProfileViewsByUser($_SESSION['id']);
		$this->data['profile_pdf_count_vendor'] = $this->Model_groups->PdfsDownloadsByUser($_SESSION['id']);
		$this->data['profile_share_count_vendor'] = $this->Model_groups->ProfileSharesByUser($_SESSION['id']);
		$this->data['profile_hire_count_vendor'] = $this->Model_groups->ProfileHiredByUser($_SESSION['id']);
		$this->data['awaiting_changes_count'] = $this->Model_groups->awaitingChangesCount($_SESSION['id']);

		$profile_count = $this->model_home->get_profile_count_by_vendor_id($_SESSION['id']);


		$latest_jobs = $this->model_home->getLatestJobs($_SESSION['id']);

		// get the registered_as from stores to check whether account is belongs to individual or organisation
		$userType = $this->model_home->checkIndividualOrOrganization($_SESSION['id']);

		if ($userType == 1) {
			$profile_skills = $this->model_home->getOrgProfileSkillsets($_SESSION['id']);

			function calculateMatchPercentage($jd, $org)
			{
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
    				$latest_jobs[$key]['no_profiles'] = 1;
			    }
		    }


		} else {
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
    				$job_skill['match_percentage'] = number_format($matchPercentage, 2);
    				$job_skill['no_profiles'] = false; 
    			} else {
    			    $job_skill['match_percentage'] = 0;
                    $job_skill['no_profiles'] = true; 
    			}
			    }
		}

		usort($latest_jobs, function ($a, $b) {
			return $b['match_percentage'] - $a['match_percentage'];
		});

		$this->data['profile_skills'] = $profile_skills;
		$this->data['latest_jobs'] = array_slice($latest_jobs,0,5);
		$this->data['userType'] = $userType;


		if ($profile_count > 0) {
			$this->render_template('admin/dashboard/vendor_dashboard', $this->data);
		} else {
			$this->render_template('admin/dashboard/No_profile', $this->data);
		}
	}

	public function hideSearchItemsForVendors() 
	{
	        // Make sure it's an AJAX request
	        if (!$this->input->is_ajax_request()) {
	          show_404(); // Return a 404 response if it's not an AJAX request
	        }
	        
	        // Get the JSON data from the AJAX request
	        $jsonData = $this->input->post('selectedValues');
	    
	        // Decode the JSON data into a PHP object
	        $selectedValuesObj = json_decode($jsonData, true)['selectedValues'];
	
	        $this->load->model('model_home');
	        
	        for ($x = 0; $x < count($selectedValuesObj); $x++) {
	            $this->model_home->DeleteSearchReportItems($selectedValuesObj[$x]);
	        }
	
	    
	        // Return a response (optional)
	        $response = array('status' => 'success', 'message' => 'Data received successfully.');
	        header('Content-Type: application/json');
	        echo json_encode($response);
	   }

	public function index()
	{
		$group_id = $this->data['group_data']['group_id'];
		$is_admin = (in_array('viewAdmin', $this->permission)) ? true : false;
		$this->load->model('Model_groups');
		$profile_count = $this->model_home->get_profile_count_by_vendor_id($_SESSION['id']);

		if ($is_admin) {
			$this->index_admin();
		} else if ($profile_count > 0 && !$is_admin) {
			$this->index_vendor();
		} else {
			$this->render_template('admin/dashboard/No_profile', $this->data);
		}
	}

	public function verify()
	{
		$this->load->model('model_users');
		$id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($id);
		$groups = $this->model_users->getUserGroup($id);

		$this->data['user_data'] = $user_data;
		$this->data['user_group'] = $groups;

		// $group_data = $this->model_groups->getGroupData();
		// $this->data['group_data'] = $group_data;
		//$this->render_template('admin/dashboard/verify', $this->data);

		$profile_count = $this->model_home->get_profile_count_by_vendor_id($id);
		$group_id = $this->data['group_data']['group_id'];
		$is_admin = (in_array('viewAdmin', $this->permission)) ? true : false;

		if ($profile_count > 0 || $is_admin) {
			$this->render_template('admin/dashboard/verify', $this->data);
		} else {
			$this->render_template('admin/dashboard/no_profile_verify', $this->data);
		}
	}

	public function verifyform()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('number');

		$from = 'hello@talrn.com';
		$to = $this->input->post('email');
		$subject = 'Profile verification Request from ' . $this->input->post('name');
		$reg_email = $_SESSION['email'];
		$message = '
                Name: ' . $name . '<br>
                Email: ' . $email . '<br>
				Registered Email: ' . $reg_email . '<br>
                Phone: ' . $phone . '<br>
                We' . "'" . 've received your request for profile verification and our team will get back to you within 1 to 2 business days.<br><br>
		In the meantime please ensure your profile is updated with the latest information. Verified profiles have a higher chance of getting placed 10x faster.<br><br>
		Regards<br>
		Talrn Verification Team""
                ';

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.talrn.com',
			'smtp_port' => 25,
			'smtp_user' => 'hello@talrn.com',
			'smtp_pass' => 'llcQ,vS!!dy@',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => 'TRUE'
		);

		$this->email->initialize($config);
		$this->email->from($from);
		$this->email->to($to);
		$this->email->cc('hello@talrn.com');
		$this->email->subject($subject);
		$this->email->message($message);
		if ($this->email->send()) {
			$this->data['verify_msg'] = "Your request for profile verification has been sent";
		} else {
			$this->data['verify_msg'] = "something went wrong..";
		}

		$this->load->model('model_users');
		$id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($id);
		$groups = $this->model_users->getUserGroup($id);

		$this->data['user_data'] = $user_data;
		$this->data['user_group'] = $groups;
		//$this->data['verify_msg'] = "Your request for profile verification has been sent!";
		$this->render_template('admin/dashboard/verify', $this->data);
	}

	public function bussiness()
	{
		$this->load->model('model_users');
		$id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($id);
		$groups = $this->model_users->getUserGroup($id);

		$this->data['user_data'] = $user_data;
		$this->data['user_group'] = $groups;

		$group_data = $this->model_groups->getGroupData();
		$this->data['group_data'] = $group_data;
		$this->render_template('admin/dashboard/bussiness', $this->data);
	}

	public function bussinessform()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone = $this->input->post('number');

		$from = 'hello@talrn.com';
		$to = $this->input->post('email');
		$subject = 'Talrn bussiness Request from ' . $this->input->post('name');
		$reg_email = $_SESSION['email'];
		$message = '
                Name: ' . $name . '<br>
                Email: ' . $email . '<br>
				Registered Email: ' . $reg_email . '<br>
                Phone: ' . $phone . '<br>
                We' . "'" . 've received your request for talrn bussiness and our team will get back to you within 1 to 2 business days. <br><br>
                In the meantime you can quickly find profiles on Talrn by visiting www.talrn.com/profiles <br><br>
                Regards<br>
                Talrn Sales Team
                ';

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.talrn.com',
			'smtp_port' => 25,
			'smtp_user' => 'hello@talrn.com',
			'smtp_pass' => 'llcQ,vS!!dy@',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => 'TRUE'
		);

		$this->email->initialize($config);
		$this->email->from($from);
		$this->email->to($to);
		$this->email->cc('hello@talrn.com');
		$this->email->subject($subject);
		$this->email->message($message);
		if ($this->email->send()) {
			$this->data['verify_msg'] = "Your request for talrn bussiness has been sent";
		} else {
			$this->data['verify_msg'] = "something went wrong";
		}

		$this->load->model('model_users');
		$id = $this->session->userdata('id');
		$user_data = $this->model_users->getUserData($id);
		$groups = $this->model_users->getUserGroup($id);

		$this->data['user_data'] = $user_data;
		$this->data['user_group'] = $groups;
		//$this->data['verify_msg'] = "Your request for profile verification has been sent!";
		$this->render_template('admin/dashboard/bussiness', $this->data);
	}


}
