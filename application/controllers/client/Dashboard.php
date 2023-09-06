<?php

class Dashboard extends Client_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Dashboard';
	}

    public function index()
	{
		$this->load->model('Model_groups');
		$this->data['no_of_profiles'] = $this->Model_groups->noOfProfiles();
	    $latest_jobs = $this->model_home->getLatestJobsbyClient($_SESSION['id']);
	    $this->data['latest_jobs'] = array_slice($latest_jobs,0,5);
		$this->render_template('client/dashboard/index', $this->data);
	}
}
