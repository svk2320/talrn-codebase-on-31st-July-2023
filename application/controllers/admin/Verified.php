<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Verified extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Verified';

	}

	public function index()
	{
		$this->render_template('admin/verified/index', $this->data);
	}
	
    public function list()
    {
        $this->render_template("admin/verified/list", $this->data);
    }
    
    public function verified()
    {
        $this->render_template("admin/verified/verified_list", $this->data);
    }
    
    public function fetchProfilesData()
	{
		$this->load->model('model_stores');

        $data = $this->model_stores->getallProfilesforVerification();

		$result = array('data' => array());

		foreach ($data as $key => $value) {

			$buttons = '';
			
			$targetDate = new DateTime($value['verified_date']);
            $currentDate = new DateTime(); // Current date and time
            
            $interval = $currentDate->diff($targetDate);
            
            $daysDifference = $interval->format('%a');
            
			
			$profile_url = base_url('admin/profile/viewprofile/' . strtolower($value['unique_id']));

			if ($value['verified'] === '1') {
			    $buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Change Status" onclick="openCustomModal(\'Change User Verification Status\', \'Are you sure you want to change status to &quot;Unverified&quot;? \', \'okButton\', \'closeButton\', \'' . $value['id'] . '\')"><i class="fa fa-toggle-on"></i></button>';
			} 
			
			if ($value['verified'] === '0') { 
			    $buttons .= '<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Change Status" onclick="openCustomModal(\'Change User Verification Status\', \'Are you sure you want to change status to &quot;Verified&quot;? \', \'okButton\', \'closeButton\', \'' . $value['id'] . '\')"><i class="fa fa-toggle-off"></i></button>';
			}
			
			if (in_array('viewProfile', $this->permission)) {
				$buttons .= '<a href="' . $profile_url . '" class="btn btn-default" style="margin-left: 10px;" target="_blank"><i class="fa fa-eye"></i></a>';
			}

			$result['data'][$key] = array(
				$value['unique_id'],
				$value['first_name'] . " " . $value['last_name'],
				$value['username'],
				$value['verified'] === '1' ? '<span class="text-blue">Verified</span>' : '<span>Not verified</span>' ,
				$buttons,
				(!($value['verified_date'] === null)) ? (date('F jS Y', strtotime($value['verified_date']))) : ' ',
				($value['verified_date'] > 0) ? ((30 - $daysDifference) . ' days') : ' '
			);
		}

		echo json_encode($result);
	}
	
    public function fetchVerifiedProfilesData()
	{
		$this->load->model('model_stores');

        $data = $this->model_stores->getallVerifiedProfiles();

		$result = array('data' => array());

		foreach ($data as $key => $value) {
		    
		    $targetDate = new DateTime($value['verified_date']);
            $currentDate = new DateTime(); // Current date and time
            
            $interval = $currentDate->diff($targetDate);
            
            $daysDifference = $interval->format('%a');

			$buttons = '';
			
			$profile_url = base_url('admin/profile/viewprofile/' . strtolower($value['unique_id']));

			if (in_array('viewProfile', $this->permission)) {
				$buttons .= '<a href="' . $profile_url . '" class="btn btn-default" style="margin-left: 10px;" target="_blank"><i class="fa fa-eye"></i></a>';
			}
			

			$result['data'][$key] = array(
				$value['unique_id'],
				$value['first_name'] . " " . $value['last_name'],
				$value['username'],
				$value['verified'] === '1' ? '<span class="text-blue">Verified</span>' : '<span>Not verified</span>' ,
				$buttons,
				(!empty($value['verified_date'])) ? date('Y-m-d', strtotime(str_replace('/', '-', $value['verified_date']))) : ' ',
				($value['verified_date'] < 0) ? (30 - $daysDifference) . ' days' : ' '
			);
		}

		echo json_encode($result);
	}
	
	public function change_status($id)
    {
		$this->load->model('model_stores');

        if ($data = $this->model_stores->updateProfileVerificationStatus($id)){
            $this->data['message'] = "Profile verification status updated";
        }else {
        $this->data['message'] = "Cannot update profile verification status";}
        
        $this->render_template("admin/verified/list", $this->data);
    }
    
    
    public function customurl()
    {
        $this->load->model("model_users");
        $this->data['message'] = $this->input->get('message');
        $this->render_template("admin/verified/custom_url_list", $this->data);
    }
    
    public function fetchVerifiedProfilesDatabyVendor()
	{
		$this->load->model('model_stores');

        $data = $this->model_stores->getallVerifiedProfilesbyVendorId($_SESSION['id']);

		$result = array('data' => array());

		foreach ($data as $key => $value) {
		    
		    $custom_url = ($value['custom_url'] !== null)?'<a target="_blank" href="'.base_url('profile/'.$value['custom_url']).'">'.$value['custom_url'].'&nbsp <i class="bi bi-box-arrow-up-right"></i></a>':'-'; 

			$buttons = '';
			
			$profile_url = base_url('admin/profile/viewprofile/' . strtolower($value['unique_id']));

			if (in_array('viewProfile', $this->permission)) {
				$buttons .= '<a href="' . $profile_url . '" class="btn btn-default" style="margin-right: 10px;" target="_blank"><i class="fa fa-eye"></i></a>';
			}
			    $buttons .= '<a href="' . base_url('admin/verified/seturl/') . $value['id'].'" title="Set Custom URL" class="btn btn-default" style="margin-right: 10px;" ><i class="fas fa-link"></i></a>';
			

			$result['data'][$key] = array(
				$value['unique_id'],
				$value['first_name'] . " " . $value['last_name'],
				$value['username'],
				$value['verified'] === '1' ? '<span class="text-blue">Verified</span>' : '<span>Not verified</span>' ,
				$custom_url,
				$buttons
			);
		}
		


		echo json_encode($result);
	}
	
	public function seturl($id)
	{
	    $this->load->model('model_stores');
        $this->data['id'] = $id;
        $custom_url = $this->model_stores->getCustomURLbyId($id)[0]['custom_url'];
        $this->data['custom_url'] = $custom_url;
		$this->render_template('admin/verified/seturlform', $this->data);
	}
	
	public function updateurl($id)
    {
        $url = $this->input->post('url');
		$this->load->model('model_stores');

        $message = "?message=Custom URL set successfully!";
        
        $this->model_stores->setCustomURLtoNull($url);
        
        if ($this->model_stores->updateCustomURL($url,$id)){
            $message = "?message=Custom URL set successfully!";
        }else {
            $message = "?message=Cannot set Custom URL!";
        }
        
        
        redirect("admin/verified/customurl".$message, "refresh");
    }
    
    public function check_status()
    {
        $url = $this->input->get('url');
        $this->load->model('model_stores');
        
        echo $this->model_stores->getCustomURLStatus($url);
    }
}

?>
