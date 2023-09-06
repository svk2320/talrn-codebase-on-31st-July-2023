<?php

class Groups extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Groups';


		$this->load->model('model_groups');
	}

	public function index()
	{
		if(!in_array('viewGroup', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		$groups_data = $this->model_groups->getGroupData();
		$this->data['groups_data'] = $groups_data;

		$this->render_template('admin/groups/index', $this->data);
	}

	public function create()
	{
		// if(!in_array('modifyGroup', $this->permission)) {
        //     redirect('admin/dashboard', 'refresh');
        // }

		$this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));

        	$data = array(
        		'group_name' => $this->input->post('group_name'),
        		'permission' => $permission
        	);

        	$create = $this->model_groups->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('admin/groups/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/groups/create', 'refresh');
        	}
        }
        else {
            // false case
            $this->render_template('admin/groups/create', $this->data);
        }


	}

	public function edit($id = null)
	{
		if(!in_array('modifyGroup', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		$group_data = $this->model_groups->getGroupData($id);

		// echo '<pre>';
		// print_r($group_data);
		// exit;

		$this->data['group_data'] = $group_data;

		if($id) {

			$this->form_validation->set_rules('group_name', 'Group name', 'required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
	            $permission = serialize($this->input->post('permission'));

	        	$data = array(
	        		'group_name' => $this->input->post('group_name'),
	        		'permission' => $permission
	        	);

	        	$update = $this->model_groups->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
	        		redirect('admin/groups/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('admin/groups/edit/'.$id, 'refresh');
	        	}
	        }
	        else {
	            // false case
	            $group_data = $this->model_groups->getGroupData($id);
				$this->data['group_data'] = $group_data;
				$this->render_template('admin/groups/edit', $this->data);
	        }
		}


	}

	public function delete($id)
	{
		if(!in_array('deleteGroup', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }

		if($id) {
			if($this->input->post('confirm')) {
				$id = $this->atri->de($id);
				 $check = $this->model_groups->existInUserGroup($id);
				if($check == true) {
					$this->session->set_flashdata('error', 'Group exists in the users');
	        		redirect('admin/groups/', 'refresh');
				}
				else {
					$delete = $this->model_groups->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('admin/groups/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('admin/groups/delete/'.$id, 'refresh');
		        	}
				}
			}
			else {
				$this->data['id'] = $id;
				$this->render_template('admin/groups/delete', $this->data);
			}
		}
	}


}
