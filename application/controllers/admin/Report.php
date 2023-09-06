<?php

class Report extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Reports';
	}

	public function index()
	{
		$this->load->model("model_home");
        $this->load->model("model_stores");
        $this->data['industry_report'] = $this->model_stores->getIndustryReport();
        $this->data['skill_report'] = $this->model_stores->getskillReport();
        $this->data['primary_title_report'] = $this->model_stores->getPrimaryTitleReport();
        $this->data['profile_views_report'] = $this->model_stores->getProfileViewsReport();
        $this->data['search_reports'] = $this->model_home->getSearchReport();
        $this->data['total_unique_visitors'] = $this->model_home->getTotalUniqueVisitors();
	$this->data['organisations_report'] = $this->model_stores->getOrganisationReport();
        $this->data['projects_report'] = $this->model_stores->getProjectReport();
        $this->render_template("admin/vendor/reports", $this->data);
	}


    public function activity_log_data(){

        $start_date = $this->input->get('start');
        $end_date = $this->input->get('end');

        $this->load->model("model_home");

        $data = $this->model_home->getTotalUniqueVisitorsByDate($start_date,$end_date);

        $result = array('data' => array());

        foreach ($data as $key => $value) {

            if ($value['date'] > $value['first_date']) {
                $user_type =  'Returning';
            } else {
                $user_type = 'New';
            }

            $ip = '<a href="//whatismyipaddress.com/ip/'.$value['IP'].'"target="_blank">'.$value['IP'].'</a>';

            if($value['status'] == 'guest'){
                $result['data'][$key] = array(
                    $ip,
                    $value['datetime'],
                    'guest',
                    'guest',
                    $user_type,
                    $value['status'],
                );
            }else{
                $result['data'][$key] = array(
                    $ip,
                    $value['datetime'],
                    $value['username'],
                    $value['email'],
                    $user_type,
                    $value['status'],
                );
            }
        }
        echo json_encode($result);
    }

    public function profile_view_data()
    {
        
        $this->load->model("model_stores");
        
        $data = $this->model_stores->getProfileViewsReport();

        $result = array('data' => array());

        foreach ($data as $key => $value) {
            $full_name = $value['first_name'] . ' ' . $value['last_name'];
            $result['data'][$key] = array(
                    $value['unique_id'],
                    $full_name,
                    $value['username'],
                    $value['primary_title'],
                    $value['views'],
                    $value['pdf'],
                    $value['hire'],
                    $value['share'],
                );
        }
        echo json_encode($result);
    }
    
    public function industries_table_data()
    {
        $this->load->model("model_stores");
        $data = $this->model_stores->getIndustryReport();
        $result = array('data' => array());
        foreach ($data as $key => $value) {
            $full_name = $value['first_name'] . ' ' . $value['last_name'];
            $result['data'][$key] = array(
                    $full_name,
                    $value['username'],
                    $value['industry'],
                    $value['num'],
                  
                );
        }
        echo json_encode($result);
        
    }
    
    public function skills_table_data()
    {
        $this->load->model("model_stores");
        $data = $this->model_stores->getskillReport();
        $result = array('data' => array());
        foreach ($data as $key => $value) {
            $full_name = $value['first_name'] . ' ' . $value['last_name'];
            $result['data'][$key] = array(
                    $full_name,
                    $value['username'],
                    $value['name'],
                    $value['num'],
                );
        }
        echo json_encode($result);
    }
    
    public function job_title_table_data()
    {
        $this->load->model("model_stores");
        $data = $this->model_stores->getPrimaryTitleReport();
        $result = array('data' => array());

        foreach ($data as $key => $value) {
            $full_name = $value['first_name'] . ' ' . $value['last_name'];
            $result['data'][$key] = array(
                    $full_name,
                    $value['username'],
                    $value['primary_title'],
                    $value['num'],
                );
        }
        echo json_encode($result);
    }
    
    public function search_report_table_data()
    {
        $this->load->model("model_home");
        $data = $this->model_home->getSearchReport();
        $result = array('data' => array());
        foreach ($data as $key => $value) {
             $ip = '<a href="//whatismyipaddress.com/ip/'.$value['IP'].'"target="_blank">'.$value['IP'].'</a>';
            $result['data'][$key] = array(
                    $ip,
                    $value['date_added'],
                    $value['skills'],
                    $value['experience'],
                    $value['industries'],
                    $value['exact_results'],
                    $value['partial_results'],
                );
        }
        echo json_encode($result);
    }
    
    public function total_unique_vistors_data()
    {
    $this->load->model("model_home");
    $data = $this->model_home->getTotalUniqueVisitors();
    $result = array('data' => array());

    foreach ($data as $key => $value) {
        // Check if the status is guest
        if ($value['status'] == 'guest') {
            $row = array(
                '<a href="//whatismyipaddress.com/ip/' . $value['IP'] . '" target="_blank">' . $value['IP'] . '</a>',
                $value['datetime'],
                'guest',
                'guest',
                ($value['date'] > $value['first_date']) ? 'Returning' : 'New',
                $value['status']
            );
        } else {
            $row = array(
                '<a href="//whatismyipaddress.com/ip/' . $value['IP'] . '" target="_blank">' . $value['IP'] . '</a>',
                $value['datetime'],
                $value['username'],
                $value['email'],
                ($value['date'] > $value['first_date']) ? 'Returning' : 'New',
                $value['status']
            );
        }

        $result['data'][] = $row;
    }

    echo json_encode($result);
}

public function organisations_table_data()
{
    $this->load->model("model_stores");
    $data = $this->model_stores->getOrganisationReport();
    $result = array('data' => array());

    foreach ($data as $key => $value) {
        $full_name = $value['firstname'] . ' ' . $value['lastname'];
         $display_name = ($value['username'] == 'Individual') ? $full_name : 'Org , ' . $value['username'];
        $result['data'][$key] = array(
            $display_name,
            $value['company_name'],
            $value['num']
        );
    }
    echo json_encode($result);
}

public function projects_table_data()
    {
        $this->load->model("model_stores");
        $data = $this->model_stores->getProjectReport();
        $result = array('data' => array());

        foreach ($data as $key => $value) {
            $full_name = $value['first_name'] . ' ' . $value['last_name'];
            $url = !empty($value['url']) ? '<div class="link-container"><a href="' . $value['url'] . '" target="_blank" style="color:#5271FF">Link</a><i class="fas fa-external-link-alt" style="color:#5271FF"></i></div>' : 'NA';  
	    // $title = strlen($value['title']) > 20 ? substr($value['title'], 0, 25) . '...' : $value['title'];
	     $title = $value['title'];
            $result['data'][$key] = array(
                    $value['unique_id'],
                    // ($value['username'] != 'individual' ) ? 'Business' : 'Individual',
                    // $value['username'],
                    $full_name,
                    $title,
                    $value['industry'],
                    $url,
                    $value['num'],
                );
        }
  
        echo json_encode($result);
    }



}
