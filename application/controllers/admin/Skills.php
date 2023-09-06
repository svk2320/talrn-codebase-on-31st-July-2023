<?php

class Skills extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->not_logged_in();
        $this->data['page_title'] = 'Skills';
        $this->load->model('model_users');
        $this->load->model('model_groups');
        $this->load->model('model_stores');
    }
    public function index()
    {
        redirect('admin/skills/list', 'refresh');
    }

    public function list() {
        $this->data['list'] = $this->model_users->getSkillSetData();
        $this->render_template('admin/skills/list', $this->data);
    }

    public function create()
    {
        $this->form_validation->set_rules('skillname', 'Skill name', 'trim|required|is_unique[skilsets.name]|min_length[2]');
		$this->form_validation->set_rules('skilldes', 'skilldes', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            $now = new DateTime();
        	$data = array(
        		'name' => $this->input->post('skillname'),
        		'description' => $this->input->post('skilldes'),
                'active' => 1,
        		'created_on' => $now->format('Y-m-d H:i:s'),
        		'modified_on' => $now->format('Y-m-d H:i:s')
        	);

        	$create = $this->model_users->createskillsets($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('admin/skills/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/skills/create', 'refresh');
        	}

        } else {
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $this->session->set_flashdata('errors', 'Error occurred!!');
            }
        }

        $this->data[] = [];
        $this->render_template('admin/skills/create', $this->data);
    }

}