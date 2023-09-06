<?php

class Stores extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Vendor';
		$this->load->model('model_stores');

	}

	public function index()
	{
		if(!in_array('viewVendor', $this->permission)) {
            redirect('admin/dashboard', 'refresh');
        }
        $this->data['js'] = 'application/views/admin/stores/index-js.php';
		$this->render_template('admin/stores/index', $this->data);
	}

	public function fetchCategoryData()
	{
		if(!in_array('viewVendor', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_stores->getStoresDataExtra();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';
            if($value['registered_as'] == 1){
                $type = 'Organisation';
            }
            else{
                $type = 'Individual';
            }
            $no_of_profiles = $this->model_stores->get_profile_count_by_store_id($value['id']);
// 			if(in_array('ModifyVendor', $this->permission)) {
// 				$buttons = '<button type="button" class="btn btn-default" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
// 			}

// 			if(in_array('deleteVendor', $this->permission)) {
// 				$buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
// 			}
            $buttons = '<button type="button" class="btn btn-default" onclick="window.open('."'".base_url('admin/users/profileinfo/'.$value['uid'])."','_blank'".');" ><i class="fa fa-eye"></i></button>';

            if(in_array('viewVendorLogin', $this->permission)) {
                $buttons .= '<a href="' . base_url('admin/auth/switch_account') . "/" . $value['uid'] . '" class="btn btn-default" style="margin-right: 10px;"><i class="nav-icon fas fa-sign-in-alt"></i></a>';
            }

// 			$status = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
			$date = (!empty($value['date'])) ? date('Y-m-d', strtotime(str_replace('/', '-', $value['date']))) : '';
			$result['data'][$key] = array(
				$date,
				$value['name'],
				$type,
                $value['phone'],
                $value['email'],
                $value['city'],
                $no_of_profiles,
                
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create()
	{
		// if(!in_array('modifyVendor', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('store_name', 'Store name', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('store_name'),
        		'active' => $this->input->post('active'),
        	);

        	$create = $this->model_stores->create($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}

	public function fetchStoresDataById($id = null)
	{
		if($id) {
			$data = $this->model_stores->getStoresData($id);
			echo json_encode($data);
		}

	}

	public function update($id)
	{
		// if(!in_array('modifyVendor', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_store_name', 'Store name', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'name' => $this->input->post('edit_store_name'),
        			'active' => $this->input->post('edit_active'),
	        	);

	        	$update = $this->model_stores->update($id, $data);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function remove()
	{
		if(!in_array('deleteVendor', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->model_stores->remove($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

}
