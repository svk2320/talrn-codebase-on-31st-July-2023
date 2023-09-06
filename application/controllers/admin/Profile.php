<?php

class Profile extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'profile';
	}

	public function index()
	{
		echo 'profile';
	}

	public function viewprofile($id)
	{

		// echo 'hello world';
		$id = $this->model_home->getidbyuniqueid($id)[0]['id'];

		if (sizeof($this->model_home->getprofilebyid($id)) == 0) {
			redirect('my404', 'refresh');
		} else {
			$data['title'] = $this->lang->line("profdetail_title");
			$data['description'] = $this->lang->line("profdetaildescription_title");
			$data['og_image'] = $this->lang->line("profile_og_image");
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

				$data['body_view'] = 'profiledetails';
				// $this->load->view('template/layout_manager', $data);
				$this->load->view('admin/vendor/profile_information', $data);
			} else {
				redirect('my404', 'refresh');
			}
		}
	}


	public function fetchProfilesData()
	{
		$this->load->model('model_stores');

		if (in_array('viewAdmin', $this->permission)) {
			$data = $this->model_stores->getAllProfilesByStoreid('admin');
		} else {
			$data = $this->model_stores->getAllProfilesByStoreid($_SESSION['id']);
		}

		$result = array('data' => array());

		foreach ($data as $key => $value) {

			$buttons = '';

// 			if ($value['approval'] != 1) {
				$profile_url = base_url('admin/profile/viewprofile/' . strtolower($value['unique_id']));
// 			} else {
// 				$profile_url = base_url('profile/' . strtolower($value['profile_url']) . '/' . strtolower($value['unique_id']));
// 			}

			if (in_array('viewProfile', $this->permission)) {
				$buttons .= '<a href="' . $profile_url . '" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="view profile" style="margin-right: 10px;" target="_blank"><i class="fa fa-eye"></i></a>';
			}

			if (in_array('modifyProfile', $this->permission)) {
				if ($value['active'] === '2' && !in_array('viewAdmin', $this->permission)) {
					$buttons .= '<a href="' . base_url("admin/vendor/") . '" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="edit profile" style="margin-right: 10px;"><i class="fa fa-edit"></i></a>';
				} else if ($value['active'] === '0' || $value['active'] === '1') {
					$buttons .= '<a href="' . base_url('admin/vendor/edit') . "/" . $value['id'] . '" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="edit profile" style="margin-right: 10px;"><i class="fa fa-edit"></i></a>';
				}
			}

			if (in_array('modifyProfile', $this->permission)) {
				if ($value['active'] === '0') {
					$buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="change status" style="margin-right: 10px;" onclick="openCustomModal(\'Update User\', \'Are you sure you want to change status to &quot;Active&quot;? This profile will now be visible in search results and profile list.\', \'okButton\', \'closeButton\', \'\', \'\', \'' . base_url("admin/vendor/deleteuser") . '/' . $value['id'] . '\')"><i class="fa fa-user"></i></button>';
				}
				if ($value['active'] === '1') {
					$buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="change status" style="margin-right: 10px;" onclick="openCustomModal(\'Update User\', \'Are you sure you want to change status to &quot;Inactive&quot;? This profile will not be visible in search results and profile list.\', \'okButton\', \'closeButton\', \'\', \'\', \'' . base_url("admin/vendor/deleteuser") . "/" . $value['id'] . '\')"><i class="fa fa-user-slash"></i></button>';
				}
			}

			if (in_array('deleteProfile', $this->permission) || $value['active'] === '2') {
				if ($value['active'] === '0' || $value['active'] === '2') {
					$buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="delete profile" style="margin-right: 10px;" onclick="openCustomModal(\'Remove\', \'Do you really want to delete(This is irreversible)?\', \'\', \'closeButton\', \'\', \'deleteButton\', \'\', \'' . base_url("admin/vendor/permdeleteuser") . '/' . $value['id'] . '\')"><i class="fa fa-trash"></i></button>';
				} else {
					$buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="delete profile" style="margin-right: 10px;" onclick="openCustomModal(\'Delete User\', \'This profile cannot be deleted, please update the status of the profile to Inactive and only then you can delete the profile\', \'okButton\')"><i class="fa fa-trash"></i></button>';
				}
			}


			$result['data'][$key] = array(
				$value['unique_id'],
				$value['first_name'] . " " . $value['last_name'],
				$value['country'],
				$value['city'],
				'<a href='. base_url('admin/users/profileinfo/'.$value['vendor_id']) .'>' .$value['username'] . '</a>',
				$value['primary_title'],
				($value['experience'] < 1) ? "< 1" : $value['experience'],
				$value['currency'] . " " . $value['ppm_max'],
				$value['job_status'],
				$value['notice_period'],
				$value['active'] === '1' ? '<span class="text-green">Active</span>' : ($value['active'] === '0' ? '<span class="text-red">Inactive</span>' : '<span class="text-red">Draft</span>'),
				$value['approval'] === '1' ? '<span class="text-green">Approved</span>' :
				($value['approval'] === '0' ? '<span class="text-blue">Pending</span>' :
					($value['approval'] === '2' ? '<span class="text-red">Awaiting changes</span>' :
						($value['approval'] === '3' ? '<span class="text-red">Rejected</span>' : ''))),
				$buttons
			);
		}

		echo json_encode($result);
	}
}
