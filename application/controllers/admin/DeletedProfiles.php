<?php

class DeletedProfiles extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'deleted_profiles';
	}

	public function index()
	{
		echo 'deleted_profiles';
	}
	
	public function viewprofile($id)
	{

        $this->load->model('model_deleted_profiles');
        		
		// echo 'hello world';
		$id = $this->model_deleted_profiles->getidbyuniqueid($id)[0]['id'];

		if (sizeof($this->model_deleted_profiles->getprofilebyid($id)) == 0) {
			redirect('my404', 'refresh');
		} else {
			$data['title'] = $this->lang->line("profdetail_title");
			$data['description'] = $this->lang->line("profdetaildescription_title");
			$data['og_image'] = $this->lang->line("profile_og_image");
// 			$this->model_deleted_profiles->IncreaseProfileViewcount($id);

			$data['profiles'] = $this->model_deleted_profiles->getDeletedProfilebyid($id);
			$data['profile_edu'] = $this->model_deleted_profiles->getDeletedProfileEdu($id);
			$data['profile_exp'] = $this->model_deleted_profiles->getDeletedProfileExp($id);
			$data['profile_pro'] = $this->model_deleted_profiles->getDeletedProfilePro($id);
			$data['profile_cert'] = $this->model_deleted_profiles->getDeletedProfileCert($id);
			$data['profile_skills'] = $this->model_deleted_profiles->getDeletedProfileSkills($id);

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

				$data['body_view'] = 'profiledetails';
				// $this->load->view('template/layout_manager', $data);
				$this->load->view('admin/vendor/profile_information', $data);
			} else {
				redirect('my404', 'refresh');
			}
		}
	}

	public function fetchDeletedProfiles()
	{
		$this->load->model('model_deleted_profiles');

		$data = $this->model_deleted_profiles->getAllDeletedProfiles();

		$result = array('data' => array());

		foreach ($data as $key => $value) {

			$buttons = '';

// 			if ($value['approval'] != 1) {
				$profile_url = base_url('admin/deletedProfiles/viewprofile/' . strtolower($value['unique_id']));
// 			} else {
// 				$profile_url = base_url('profile/' . strtolower($value['profile_url']) . '/' . strtolower($value['unique_id']));
// 			}

				$buttons .= '<a href="' . $profile_url . '" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="view profile" style="margin-right: 10px;" target="_blank"><i class="fa fa-eye"></i></a>';

// 			if (in_array('deleteProfile', $this->permission) || $value['active'] === '2') {
// 				if ($value['active'] === '0' || $value['active'] === '2') {
					$buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="delete profile" style="margin-right: 10px;" onclick="openCustomModal(\'Remove\', \'Do you really want to delete(This is irreversible)?\', \'\', \'closeButton\', \'\', \'deleteButton\', \'\', \'' . base_url("admin/deletedProfiles/deleteuser") . '/' . $value['id'] . '\')"><i class="fa fa-trash"></i></button>';
				// } else {
				// 	$buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="delete profile" style="margin-right: 10px;" onclick="openCustomModal(\'Delete User\', \'This profile cannot be deleted, please update the status of the profile to Inactive and only then you can delete the profile\', \'okButton\')"><i class="fa fa-trash"></i></button>';
// 				}
// 			}

			$result['data'][$key] = array(
				$value['unique_id'],
				$value['first_name'] . " " . $value['last_name'],
				$value['country'],
				$value['city'],
				$value['username'],
				// 'username',
				$value['primary_title'],
				($value['experience'] < 1) ? "< 1" : $value['experience'],
				$value['currency'] . " " . $value['ppm_max'],
				$value['job_status'],
				$value['notice_period'],
				// $value['active'] === '1' ? '<span class="text-green">Active</span>' : ($value['active'] === '0' ? '<span class="text-red">Inactive</span>' : '<span class="text-red">Draft</span>'),
				// $value['approval'] === '1' ? '<span class="text-green">Approved</span>' :
				// ($value['approval'] === '0' ? '<span class="text-blue">Pending</span>' :
				// 	($value['approval'] === '2' ? '<span class="text-red">Awaiting changes</span>' :
				// 		($value['approval'] === '3' ? '<span class="text-red">Rejected</span>' : ''))),
				$buttons
			);
		}

		echo json_encode($result);
	}
	
    public function deleteuser($userid = null)
    {
        if(in_array('modifyProfile', $this->permission)){
            $id = (int) $userid;
            $message = null;
            
            $this->load->model('Model_deleted_profiles');
            
            if ($id != null) {
                $this->Model_deleted_profiles->delete_profile_edu($id);
                $this->Model_deleted_profiles->delete_profile_exp($id);
                $this->Model_deleted_profiles->delete_profile_pro($id);
                $this->Model_deleted_profiles->delete_profile_cert($id);
                $this->Model_deleted_profiles->delete_profile_skills($id);
                $result = $this->Model_deleted_profiles->delete_profile($id);
                if($result == true){
                    $message = "User Deleted";
                }
            }
            else {
                $message = "Cannot delete users";
            }
            redirect('admin/vendor/deleted_profiles', 'refresh');
        }
        else{
            echo "Delete only allowed for admin user";
        }

    }
}
