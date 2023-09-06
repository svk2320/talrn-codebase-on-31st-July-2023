<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_auth');
	}

	/*
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
	public function login()
	{

		$data['title'] = $this->lang->line("login_title");
		$data['description'] = $this->lang->line("login_description_title");
		$data['og'] = $this->lang->line("login_title");
		$data['og_image'] = $this->lang->line("login_og_image");

		$this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');


        if ($this->form_validation->run() == TRUE) {

            // true case
           	$email_exists = $this->model_auth->check_email($this->input->post('email'));

           	if($email_exists === TRUE) {
           		$login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));


           		if($login) {
					$user_id = $login['id'];
					$this->load->model("model_users");
					$user_data = $this->model_users->getUserData($user_id);
					$name = $user_data['firstname'] . ' ' . $user_data['lastname'];
					$verified = $this->model_users->getVerifiedStatus($user_id);
           			$logged_in_sess = array(
           				'id' => $login['id'],
						'name' =>$name,
				        'username'  => $login['username'],
				        'email'     => $login['email'],
						'store_id' =>  $login['store_id'],
				        'logged_in' => TRUE,
						'registered_as' => $user_data['registered_as'],
						'verified' => $verified,
						'type' => 'admin'
					);

					$this->model_users->last_login($user_id);

					$this->load->model('model_home');
					$this->load->model('model_groups');

					$action_logs = [
						"IP" => $this->input->ip_address(),
						"action" => 'login',
						"user_id" => $login['id'],
					];
					$this->model_home->create_action_log($action_logs);
					$profile_count = $this->model_home->get_profile_count_by_vendor_id($login['id']);
					$group_id = $this->model_groups->getUserGroupByUserId($login['id'])['group_id'];

					$this->data['group_data'] = $group_data = $this->model_groups->getUserGroupByUserId($login['id']);

					$this->data['user_permission'] = unserialize($group_data['permission']);

					$this->permission = unserialize($group_data['permission']);

					$is_admin = (in_array('viewAdmin', $this->permission)) ? true :false;

					$this->session->set_userdata($logged_in_sess);
					$this->session->set_userdata('logged_in', $logged_in_sess);
					
					$this->session->set_userdata('showPopup', true);
					
					if($profile_count > 0 || $is_admin){
						redirect(base_url('admin/dashboard'), 'refresh');
					}else{
						redirect(base_url('admin/vendor'), 'refresh');
					}

           		}
           		else {

           			$data['errors'] = '<div class="alert alert-danger" role="alert">Incorrect email/password </div>';
           			$data['body_view'] = 'login';
        			$this->load->view('template/layout_manager', $data);

           		}
           	}
			// Check for Client login
			else if($this->model_auth->check_email_client($this->input->post('email'))){ 
				$login = $this->model_auth->login_client($this->input->post('email'), $this->input->post('password'));

				if($login) {					
					$client_id = $login['id'];
					$this->load->model("model_clients");
					$client_data = $this->model_clients->getClientData($client_id);
					
           			$logged_in_sess = array(
           				'id' => $login['id'],
						'unique_id' => $login['unique_id'],
						'name' => $login['name'],
				        'email'     => $login['email'],
				        'logged_in' => TRUE,
						'type' => 'client'
					);

					$this->session->set_userdata($logged_in_sess);
					$this->session->set_userdata('logged_in', $logged_in_sess);

					$this->session->set_userdata('showPopup', true);
					
					redirect(base_url('client/dashboard'), 'refresh');
					
           		}
           		else {

           			$data['errors'] = '<div class="alert alert-danger" role="alert">Incorrect email/password </div>';
           			$data['body_view'] = 'login';
        			$this->load->view('template/layout_manager', $data);

           		}
			}
           	else {
           		$data['errors'] = '<div class="alert alert-danger" role="alert">Email does not exists</div>';

           		$data['body_view'] = 'login';
        		$this->load->view('template/layout_manager', $data);

           	}
        }
        else {
			$data['body_view'] = 'login';
        	$this->load->view('template/layout_manager', $data);
        }
	}

    public function login_join()
    {
        $login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));

        if($login) {
			$this->load->model("model_users");
			$user_data = $this->model_users->getUserData($login['id']);
			$name = $user_data['firstname'] . ' ' . $user_data['lastname'];
            $logged_in_sess = array(
                'id' => $login['id'],
				'name' =>$name,
                'username'  => $login['username'],
                'email'     => $login['email'],
                'store_id' =>  $login['store_id'],
                'logged_in' => TRUE,
				'registered_as' => $user_data['registered_as'],
				'type' => 'admin' 
            );

			$this->model_users->last_login($login['id']);
			$this->load->model('model_home');
			$action_logs = [
				"IP" => $this->input->ip_address(),
				"action" => 'login',
				"user_id" => $login['id'],
			];
			$this->model_home->create_action_log($action_logs);
            $this->session->set_userdata($logged_in_sess);
            $this->session->set_userdata('logged_in', $logged_in_sess);
            
            $this->session->set_userdata('showPopup', true);


            redirect(base_url('admin/vendor'), 'refresh');

        }
		// Check for Client login
		else if($this->model_auth->check_email_client($this->input->post('email'))){ 
			$login = $this->model_auth->login_client($this->input->post('email'), $this->input->post('password'));

			if($login) {					
				$client_id = $login['id'];
				$this->load->model("model_clients");
				$client_data = $this->model_clients->getClientData($client_id);
				
				$logged_in_sess = array(
					'id' => $login['id'],
					'unique_id' => $login['unique_id'],
					'name' => $login['name'],
					'email'     => $login['email'],
					'logged_in' => TRUE,
					'type' => 'client'
				);

				$this->session->set_userdata($logged_in_sess);
				$this->session->set_userdata('logged_in', $logged_in_sess);
				$this->session->set_userdata('showPopup', true);
				
				redirect(base_url('client/dashboard'), 'refresh');
				
			   }
			   else {

				   $data['errors'] = '<div class="alert alert-danger" role="alert">Incorrect email/password </div>';
				   $data['body_view'] = 'login';
				$this->load->view('template/layout_manager', $data);

			   }
		}
        else {

            $data['errors'] = '<div class="alert alert-danger" role="alert">Incorrect username/password </div>';
            $data['body_view'] = 'login';
        	$this->load->view('template/layout_manager', $data);

        }
    }

	/*
		clears the session and redirects to login page
	*/

    public function logout()
    {
        $this->session->sess_destroy();

        // Redirect to the login page
        redirect('admin/auth/login');
        exit();
    }

	 public function switch_account($id)
	{
			
			
		$this->load->model("model_users");
		$login = $this->model_users->getUserData($id);

		$user_id = $id;
		$verified = $this->model_users->getVerifiedStatus($user_id);
		$user_data = $this->model_users->getUserData($user_id);
		$name = $user_data['firstname'] . ' ' . $user_data['lastname'];
		$logged_in_sess = array(
			'id' => $id,
			'name' =>$name,
			'username' => $login['username'],
			'email' => $login['email'],
			'store_id' =>  $login['store_id'],
			'logged_in' => TRUE,
			'verified' => $verified,
			'type' => 'admin'
		);

		$this->model_users->last_login($user_id);
	
		$this->load->model('model_home');
		$this->load->model('model_groups');
		
		$this->session->set_userdata('showPopup', true);
	
		$action_logs = [
			"IP" => $this->input->ip_address(),
			"action" => 'login',
			"user_id" => $id,
		];
		$this->model_home->create_action_log($action_logs);
		$profile_count = $this->model_home->get_profile_count_by_vendor_id($id);
		$group_id = $this->model_groups->getUserGroupByUserId($id)['group_id'];
	
		$this->data['group_data'] = $group_data = $this->model_groups->getUserGroupByUserId($id);
	
		$this->data['user_permission'] = unserialize($group_data['permission']);
	
		$this->permission = unserialize($group_data['permission']);
	
		$is_admin = (in_array('viewAdmin', $this->permission)) ? true :false;
	
		$this->session->set_userdata($logged_in_sess);
		$this->session->set_userdata('logged_in', $logged_in_sess);
		if($profile_count > 0 || $is_admin){
			redirect(base_url('admin/dashboard'), 'refresh');
		}else{
			redirect(base_url('admin/vendor'), 'refresh');
		}
	}

}
