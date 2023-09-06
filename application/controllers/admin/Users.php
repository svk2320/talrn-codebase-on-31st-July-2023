<?php

class Users extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Users';


		$this->load->model('model_users');
		$this->load->model('model_groups');
		$this->load->model('model_stores');
	}
	public function index(){
		redirect('admin/users/manage', 'refresh');
	}
	public function manage()
	{

		if(!in_array('viewUser', $this->permission)) {
	            redirect('admin/dashboard', 'refresh');
	        }

		$this->render_template('admin/users/index', $this->data);
	}

	public function fetchManageUsers()
	{
	    
		$user_data = $this->model_users->getUserData();

		$results = array();
		foreach ($user_data as $k => $v) {

			$results[$k]['user_info'] = $v;

			$group = $this->model_users->getUserGroup($v['id']);
			$results[$k]['user_group'] = $group;
		}

		$result = array('data' => array());

		foreach ($results as $key => $value) {

			$buttons = '';
			
            if (in_array('modifyUser', $this->permission) || in_array('deleteUser', $this->permission)) {
            
                if (in_array('modifyUser', $this->permission)) {
                    $buttons .= '<a href="' . base_url('admin/users/edit/' . $value['user_info']['id']) . '" class="btn btn-default"><i class="fa fa-edit"></i></a>';
                }
            
                if (in_array('deleteUser', $this->permission) && false) {
                    $buttons .= '<a href="' . base_url('admin/users/delete/' . $this->atri->en($value['user_info']['id'])) . '" class="btn btn-default"><i class="fa fa-trash"></i></a>';
                }
            }

			$result['data'][$key] = array(
				$value['user_info']['username'],
				$value['user_info']['email'],
				$value['user_info']['firstname'] . ' ' . $value['user_info']['lastname'],
				$value['user_info']['phone'],
				isset($value['user_group']['group_name']) ? $value['user_group']['group_name'] : ' - ',
				$buttons
			);
		}

		echo json_encode($result);
	}

	public function create()
	{

		if(!in_array('modifyUser', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		$this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('store', 'Store', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            // true case
            $password = $this->password_hash($this->input->post('password'));
        	$data = array(
        		'username' => $this->input->post('username'),
        		'password' => $password,
        		'email' => $this->input->post('email'),
        		'firstname' => $this->input->post('fname'),
        		'lastname' => $this->input->post('lname'),
        		'phone' => $this->input->post('phone'),
        		'gender' => $this->input->post('gender'),
        		'store_id' => $this->input->post('store'),
        	);

        	$create = $this->model_users->create($data, $this->input->post('groups'));
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('admin/users/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/users/create', 'refresh');
        	}
        }
        else {
            // false case
			if($_SERVER['REQUEST_METHOD']=='POST'){
			  $this->session->set_flashdata('errors', 'Error occurred!!');
			}
            $this->data['store_data'] = $this->model_stores->getStoresData();
        	$group_data = $this->model_groups->getGroupData();
        	$this->data['group_data'] = $group_data;
            $this->render_template('admin/users/create', $this->data);
        }


	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function edit($id = null)
	{

		if(!in_array('modifyUser', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		if($id) {
			$store_data = $this->model_stores->getStoresDataByUserID($id);
			$store_id = $store_data['id'];

			$this->form_validation->set_rules('groups', 'Group', 'required');
			$this->form_validation->set_rules('store', 'Store', 'trim|required');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'username' => $this->input->post('username'),
		        		'email' => $this->input->post('email'),
		        		'firstname' => $this->input->post('fname'),
		        		'lastname' => $this->input->post('lname'),
		        		'phone' => $this->input->post('phone'),
		        		'gender' => $this->input->post('gender'),
		        		'store_id' => $this->input->post('store'),
						'city' => $this->input->post('city'),
                        'job_title' => $this->input->post('job_title'),
                        'cin/gst' => $this->input->post('cin/gst'),
		        	);
		        	
		        	$store_info = array(
                        'website' => $this->input->post('website'),
		        	    'name' => $this->input->post('name'), 
		        	);

		        	$update = $this->model_stores->update($store_id, $store_info);
		        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully created');
		        		redirect('admin/users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('admin/users/edit/'.$id, 'refresh');
		        	}
		        }
		        else {
		        	//$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					//$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'username' => $this->input->post('username'),
			        		'password' => $password,
			        		'email' => $this->input->post('email'),
			        		'firstname' => $this->input->post('fname'),
			        		'lastname' => $this->input->post('lname'),
			        		'phone' => $this->input->post('phone'),
			        		'gender' => $this->input->post('gender'),
			        		'store_id' => $this->input->post('store'),
							'city' => $this->input->post('city'),
							'job_title' => $this->input->post('job_title'),
							'cin/gst' => $this->input->post('cin/gst'),
			        	);
			        	
			        	$store_info = array(
                        'website' => $this->input->post('website'),
		        	    'name' => $this->input->post('name'), 
		        		);

		        	    $update = $this->model_stores->update($store_id, $store_info);
			        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('admin/users/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('admin/users/edit/'.$id, 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getUserData($id);
			        	$groups = $this->model_users->getUserGroup($id);
			        	$store_info = $this->model_stores->getStoresData($store_id);
                        
                        $this->data['store_info'] = $store_info;
			        	$this->data['user_data'] = $user_data;
			        	$this->data['user_group'] = $groups;

			            $group_data = $this->model_groups->getGroupData();
			        	$this->data['group_data'] = $group_data;

						$this->render_template('admin/users/edit', $this->data);
			        }

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->model_users->getUserData($id);
	        	$groups = $this->model_users->getUserGroup($id);
	        	$store_info = $this->model_stores->getStoresData($store_id);

	        	$this->data['store_data'] = $this->model_stores->getStoresData();
                        
                $this->data['store_info'] = $store_info;
	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;

	            $group_data = $this->model_groups->getGroupData();
	        	$this->data['group_data'] = $group_data;

				$this->render_template('admin/users/edit', $this->data);
	        }
		}
	}

	public function delete($id)
	{

		if(!in_array('deleteUser', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		if($id) {
			if($this->input->post('confirm')) {


					$delete = $this->model_users->delete($this->atri->de($id));
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('admin/users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('admin/users/delete/'.$id, 'refresh');
		        	}

			}
			else {
				$this->data['id'] = $id;
				$this->render_template('admin/users/delete', $this->data);
			}
		}
	}

	public function profile()
	{

		if(!in_array('viewProfile', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		$user_id = $this->session->userdata('id');

		$user_data = $this->model_users->getUserData($user_id);
		$this->data['user_data'] = $user_data;
		
		$this->data['website'] = $this->model_users->getUserWebsite($user_id)['website'];
		$this->data['name'] = $this->model_users->getUserWebsite($user_id)['name'];
		
// 		$store_data = $this->model_stores->getStoresData($id);
// 		$this->data['store_data'] = $store_data;
		
        $profile_id = $this->model_users->getUserProfileId($user_id);
	    if($profile_id != null){
	        $this->data['profile_link'] = base_url('profile/'.$profile_id['unique_id']);
	    }else{
	        $this->data['profile_link']='#';
	    }
	    $this->data['no_of_profiles'] = $this->model_users->getNoOfProfilesByUserId($user_id);
        
		$user_group = $this->model_users->getUserGroup($user_id);
		$this->data['user_group'] = $user_group;

        $this->render_template('admin/users/profile', $this->data);
	}
	
		public function profileinfo($id)
	{

		if(!in_array('viewProfile', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		$user_id = $id;

		$user_data = $this->model_users->getUserData($user_id);
		$this->data['user_data'] = $user_data;
		
		$this->data['website'] = $this->model_users->getUserWebsite($user_id)['website'];
		$this->data['name'] = $this->model_users->getUserWebsite($user_id)['name'];
		
		$profile_id = $this->model_users->getUserProfileId($user_id);
	    if($profile_id != null){
	        $this->data['profile_link'] = base_url('profile/'.$profile_id['unique_id']);
	    }else{
	        $this->data['profile_link']='#';
	    }
		$user_group = $this->model_users->getUserGroup($user_id);
		$this->data['user_group'] = $user_group;
		$this->data['no_of_profiles'] = $this->model_users->getNoOfProfilesByUserId($user_id);

        $this->render_template('admin/users/profileinfo', $this->data);
	}

	public function setting()
	{
		if(!in_array('modifyUser', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		$id = $this->session->userdata('id');
		$store_id = $_SESSION['store_id'];

		if($id) {
//			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('fname', 'First name', 'trim|required');


			if ($this->form_validation->run() == TRUE) {
	            // true case
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'email' => $this->input->post('email'),
		        		'firstname' => $this->input->post('fname'),
		        		'lastname' => $this->input->post('lname'),
		        		'phone' => $this->input->post('phone'),
		        		'gender' => $this->input->post('gender'),
		        		'city' => $this->input->post('city'),
                        'job_title' => $this->input->post('job_title'),
                        'cin/gst' => $this->input->post('cin/gst'),
						'referral_code' => $this->input->post('referral_code'),
		        	);
		        	
		        	$store_info = array(
                        'website' => $this->input->post('website'),
		        	    'name' => $this->input->post('name'), 
		        	);

		        	$update = $this->model_stores->update($store_id, $store_info);
		        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('admin/users/setting/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('admin/users/setting/', 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'password' => $password,
			        		'email' => $this->input->post('email'),
			        		'firstname' => $this->input->post('fname'),
			        		'lastname' => $this->input->post('lname'),
			        		'phone' => $this->input->post('phone'),
			        		'gender' => $this->input->post('gender'),
			        		'city' => $this->input->post('city'),
                            'job_title' => $this->input->post('job_title'),
                            'cin/gst' => $this->input->post('cin/gst'),
							'referral_code' => $this->input->post('referral_code'),
			        	);
			        	
			        	$store_info = array(
                            'website' => $this->input->post('website'),
    		        	    'name' => $this->input->post('name'), 
		        	    );

		        	    $update = $this->model_stores->update($store_id, $store_info);
			        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('admin/users/setting/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('admin/users/setting/', 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getUserData($id);
			        	$groups = $this->model_users->getUserGroup($id);
			        	$store_info = $this->model_stores->getStoresData($store_id);
                        
                        $this->data['store_info'] = $store_info;
			        	$this->data['user_data'] = $user_data;
			        	$this->data['user_group'] = $groups;

			            $group_data = $this->model_groups->getGroupData();
			        	$this->data['group_data'] = $group_data;

						$this->render_template('admin/users/setting', $this->data);
			        }

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->model_users->getUserData($id);
	        	$groups = $this->model_users->getUserGroup($id);
                $store_info = $this->model_stores->getStoresData($store_id);
                        
                $this->data['store_info'] = $store_info;
	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;

	            $group_data = $this->model_groups->getGroupData();
	        	$this->data['group_data'] = $group_data;

				$this->render_template('admin/users/setting', $this->data);
	        }
		}
	}


	public function toggle_reminder($user_id){
		$this->model_users->toggleReminder($user_id);
	}
}
