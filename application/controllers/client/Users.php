<?php

class Users extends Client_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->load->model('model_clients');
		$this->data['page_title'] = 'Dashboard';
	}

	public function index()
	{
		$this->load->model('Model_groups');
		$this->data['no_of_profiles'] = $this->Model_groups->noOfProfiles();
		$latest_jobs = $this->model_home->getLatestJobsbyClient($_SESSION['id']);
		$this->data['latest_jobs'] = array_slice($latest_jobs, 0, 5);
		$this->render_template('client/dashboard/index', $this->data);
	}

	public function profile()
	{

		$client_id = $this->session->userdata('id');

		$client_data = $this->model_clients->getClientData($client_id);
		$this->data['client_data'] = $client_data;

		$this->render_template('client/users/profile', $this->data);
	}

	public function setting()
	{
		$id = $this->session->userdata('id');
		if ($id) {
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('name', 'Name', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				// true case
				if (empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
					$data = array(
						'email' => $this->input->post('email'),
						'name' => $this->input->post('name'),
						'phone' => $this->input->post('phone'),
						'job_title' => $this->input->post('job_title'),
						'company' => $this->input->post('company')
					);
					$update = $this->model_clients->edit($data, $id);
					if ($update == true) {
						$this->session->set_flashdata('success', 'Successfully updated');
						redirect('client/users/setting/', 'refresh');
					} else {
						$this->session->set_flashdata('errors', 'Error occurred!!');
						redirect('client/users/setting/', 'refresh');
					}
				} else {
					$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if ($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
							'password' => $password,
							'email' => $this->input->post('email'),
							'name' => $this->input->post('name'),
							'phone' => $this->input->post('phone'),
							'job_title' => $this->input->post('job_title'),
							'company' => $this->input->post('company')
						);


						$update = $this->model_clients->edit($data, $id);
						if ($update == true) {
							$this->session->set_flashdata('success', 'Successfully updated');
							redirect('client/users/setting/', 'refresh');
						} else {
							$this->session->set_flashdata('errors', 'Error occurred!!');
							redirect('client/users/setting/', 'refresh');
						}
					} else {
						// false case
						$user_data = $this->model_clients->getClientData($id);

						$this->data['user_data'] = $user_data;

						$this->render_template('client/users/setting', $this->data);
					}

				}
			} else {
				// false case
				$user_data = $this->model_clients->getClientData($id);

				$this->data['user_data'] = $user_data;

				$this->render_template('client/users/setting', $this->data);
			}
		}
	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}
}