<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Approval';

		$this->load->model('model_search');
	}


	public function index()
	{
		$this->data['list'] = $this->model_search->getPendingProfiles();
		$this->render_template("admin/approval/partner_list", $this->data);
	}

	public function approved()
	{
		$this->data['list'] = $this->model_search->getApprovedProfiles();
		$this->render_template("admin/approval/approved_list", $this->data);
	}

	public function approve($unique_id)
	{
		$this->load->model('model_stores');
		$this->load->model('model_users');
		$id = $this->model_home->getidbyuniqueid($unique_id)[0]['id'];
		$user_id = $this->model_stores->changeProfileStatus($id);
		$user_id = $this->model_stores->getProfileVendorById($id);
		$user_data = $this->model_users->getUserData($user_id);

		$updatedarray = array(
			"approval" => 1
		);
		$where = array("id" => $id);
		$result = $this->model_stores->insertOrUpdateUsers($updatedarray, 1, $where);
		if ($result == true) {
			$this->data['message'] = "Profile " . $unique_id . " Approved";

			$from = 'vendor-status@talrn.com';
			$to = $user_data['email'];
			$name = $user_data['firstname'] . " " . $user_data['lastname'];
			$profile_url = base_url('profile/' . strtolower($unique_id));
			$subject = 'Congratulations ' . $name . '! Your profile has been approved and is now live on Talrn!';
			$message = "
			Dear " . $name . ",<br><br>
			We're delighted to inform you that your profile " . $unique_id . " has been successfully vetted and approved for publication on " . $profile_url . "<br><br>  
			
			Congratulations on making it through the selection process!<br><br>
			
			We would like to take this opportunity to thank you for your interest in talrn.com and for sharing your skills and experience with us. We are excited to have you on board.<br><br>
			
			Your profile is now visible to our clients and potential employers. We are confident that your skills and experience will be matched with the right project. <br><br>
			We encourage you to keep your profile up-to-date with any new skills or experience that you may acquire. This will help you stay relevant and attractive to potential employers.<br><br>
			
			Your dashboard allows you to track profile visits and other key stats all from your dashboard. We are continously updating and improving the product to assist in landing you for the best projects. <br><br>
			
			For any questions, suggestions and inquires reach out to us on vendor@talrn.com  <br><br>
			
			Best regards,<br>
			Vendor Team <br>
			Talrn.com<br>
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
			$this->email->cc('vendor-status@talrn.com');
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);
			$this->email->send();
			//echo $message;
		}
		$this->data['list'] = $this->model_search->getPendingProfiles();
		$this->render_template("admin/approval/partner_list", $this->data);
	}


	public function reject($unique_id)
	{
		$this->load->model('model_stores');
		$this->load->model('model_users');
		$id = $this->model_home->getidbyuniqueid($unique_id)[0]['id'];
		$user_id = $this->model_stores->getProfileVendorById($id);
		$user_data = $this->model_users->getUserData($user_id);
		$profile_name = $this->model_stores->getProfileNameById($id);
		$permanent_reject = $this->input->post('permanent_reject');
		if ($permanent_reject) {
			$updatedarray = array(
				"approval" => 3
			);
			$where = array("id" => $id);
			$result = $this->model_stores->insertOrUpdateUsers($updatedarray, 1, $where);
			if ($result == true) {
				$this->data['message'] = "Profile " . $unique_id . " Rejected";
				$from = 'vendor-status@talrn.com';
				$to = $user_data['email'];
				$name = $user_data['firstname'] . " " . $user_data['lastname'];
				$subject = 'Regretful News ' . $name . ': Profile not approved for publication';
				$message = "Dear " . $name . ",<br><br>
				
				Thank you for submitting your profile " . $unique_id . " on Talrn. We appreciate the time and effort you put into your application. <br><br>
				
				We are currently accepting iOS devs only as Talrn is an exclusive community worldwide for iOS developers, as your technology stack doesn't match that we'll currently be unable to accept your profile on Talrn. <br><br>

				However we will get in touch with you in the future if we are able to match your profile for something relevant. <br><br>

				If you still think there's been a mistake in rejecting your profile, please email us on vendor@talrn.com <br><br>

				Thank you for taking the time to apply. <br><br>
				Best regards,<br>
				Vendor Team <br>
				Talrn.com <br>
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
				$this->email->cc('vendor-status@talrn.com');
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
				//echo $message;
			}
		} else {
			$updatedarray = array(
				"approval" => 2
			);
			$comment = "Profile ID: " . $unique_id . "<br>
			Name: " . $profile_name[0]['first_name'] . " " . $profile_name[0]['last_name'] . "<br>
			Comment:<br> " . nl2br($this->input->post('comment'));
			$where = array("id" => $id);
			$result = $this->model_stores->insertOrUpdateUsers($updatedarray, 1, $where);
			if ($result == true) {
				$this->data['message'] = "Profile " . $unique_id . " Rejected";
				$from = 'vendor-status@talrn.com';
				$to = $user_data['email'];
				$name = $user_data['firstname'] . " " . $user_data['lastname'];
				$subject = 'Regretful News ' . $name . ': Profile not approved for publication';
				$message = "Dear " . $name . ",<br><br>
				
				Thank you for submitting your profile on Talrn. We appreciate the time and effort you put into your application. <br><br>
				
				we would like to offer some specific feedback on how you can improve your profile for future consideration.<br><br>
				
				" . $comment . "<br><br>
				
				We encourage you to take our feedback into consideration and revise your profile accordingly. Once you have made the necessary updates, please feel free to re-submit your profile for review.<br><br>
				
				Best regards,<br>
				Vendor Team <br>
				Talrn.com <br>
				
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
				$this->email->cc('vendor-status@talrn.com');
				$this->email->to($to);
				$this->email->subject($subject);
				$this->email->message($message);
				$this->email->send();
				//echo $message;
			}
		}

		$this->data['list'] = $this->model_search->getPendingProfiles();
		$this->render_template("admin/approval/partner_list", $this->data);
	}

	public function viewprofile($id)
	{
		$id = $this->model_home->getidbyuniqueid($id)[0]['id'];

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

				$data['body_view'] = 'profiledetails';
				$this->load->view('admin/approval/profileview', $data);
			} else {
				redirect('my404', 'refresh');
			}
		}
	}

}
