<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requirements extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'JD';
        $this->load->model('model_requirements');
    }

    public function create()
    {
        $this->render_template("admin/requirements/create", $this->data);
    }


    public function applied($jd_id)
    {
        if (in_array('viewAdmin', $this->permission)) {
            $getallrecords = $this->model_requirements->getAllProfilesByJd_id($jd_id);
        } else {
            $getallrecords = $this->model_requirements->getAllProfilesByJd_id($jd_id);
        }

        $job_details = $this->model_requirements->getrequirementbyjdId($jd_id);

        foreach ($getallrecords as &$profile) {
            $skillTechnicalSkills = array_map('strtolower', array_map('trim', explode(',', $profile['skillsets'])));
            $matchCount = 0;

            $totalskills = array_map('strtolower', array_map('trim', explode(',', $job_details[0]['technical_skills'])));

            foreach (array_map('strtolower', array_map('trim', explode(',', $job_details[0]['technical_skills']))) as $job_skill) {
                if (in_array($job_skill, $skillTechnicalSkills)) {
                    $matchCount++;
                }
            }

            $matchPercentage = ($matchCount / count($totalskills)) * 100;
            $profile['match_percentage'] = number_format($matchPercentage, 0);
        }

        $this->data["list"] = $getallrecords;
        $this->data["jd_id"] = $jd_id;

        $this->render_template("admin/requirements/applied", $this->data);
    }


    public function approve($id)
    {
        $this->model_requirements->approveJob($id);
        $getallrecords = $this->model_requirements->getAllClientRequirements();

        $this->data["list"] = $getallrecords;
        
        $this->data['message'] = "JD Approved successfully";
        $this->data["list"] = $getallrecords;
        $this->render_template("admin/requirements/client", $this->data);
    }


    public function delete($id)
    {

        // if(!in_array('deleteUser', $this->permission)) {
        //     redirect('admin/dashboard', 'refresh');
        // }

        if ($id) {
            $returnvals = $this->model_requirements->getrequirementbyid($id);
            $delete = $this->model_requirements->delete($id);
            if ($delete == true) {
                //$this->session->set_flashdata('success', 'Successfully removed');
                $this->data['message'] = "JD deleted successfully";
                if ($returnvals[0]['type'] == 'admin') {
                    $getallrecords = $this->model_requirements->getAllRequirements();
                    $this->data["list"] = $getallrecords;
                    $this->render_template("admin/requirements/list", $this->data);
                } else {
                    $getallrecords = $this->model_requirements->getAllClientRequirements();
                    $this->data["list"] = $getallrecords;
                    $this->render_template("admin/requirements/client", $this->data);
                }
            } else {
                //$this->session->set_flashdata('error', 'Error occurred!!');
                if (in_array('viewAdmin', $this->permission)) {
                    $getallrecords = $this->model_requirements->getAllRequirements();
                } else {
                    $getallrecords = $this->model_requirements->getAllRequirements();
                }
                $this->data['message'] = "Delete Not successfull";
                $this->data["list"] = $getallrecords;
                $this->render_template("admin/requirements/list", $this->data);
            }
        }
    }
    public function index()
    {
        if (in_array('viewAdmin', $this->permission)) {
            $getallrecords = $this->model_requirements->getAllRequirements();
        } else {
            $getallrecords = $this->model_requirements->getAllRequirements();
        }

        $this->data["list"] = $getallrecords;
        $this->render_template("admin/requirements/list", $this->data);
    }

    public function client()
    {
        
        $getallrecords = $this->model_requirements->getAllClientRequirements();


        $this->data["list"] = $getallrecords;
        $this->render_template("admin/requirements/client", $this->data);
    }

    public function uploadProfileImg()
    {
        // Check if the cropped image file exists in the $_FILES array
        if (isset($_FILES['croppedImage']) && !empty($_FILES['croppedImage']['tmp_name'])) {

            $file = $_FILES['croppedImage'];
            $filename = ucfirst($this->input->post('fileTitle'));

            $destination = './uploads/company_logo/';

            // Check if a file with the same name already exists
            if (file_exists($destination . $filename)) {
                // Delete the existing file
                unlink($destination . $filename);
            }

            if ($file) {
                // Save the cropped image to a directory
                move_uploaded_file($file['tmp_name'], $destination . $filename);
            }

            // Optionally, you can return a response to the client indicating the success or any other relevant information
            $response = array('status' => 'success', 'message' => 'Cropped image saved successfully', 'fileName' => $filename);
            echo json_encode($response);
            return;
        }

        // Return an error response if the cropped image file is not found
        $response = array('status' => 'error', 'message' => 'Cropped image file not found');
        echo json_encode($response);
    }

    public function submit()
    {
        $job_title = $this->input->post('job-title');
        $technical_skills = $this->input->post('skill_list');
        $skills = isset($technical_skills) && is_array($technical_skills) ? $technical_skills : [];
        $skills = implode(', ', $skills);
        $experience = $this->input->post('experience');
        $job_description = $this->input->post('job-description');
        $employment_type = $this->input->post('employment-type');
        $job_location_type = $this->input->post('job-location-type');
        $location = $this->input->post('location');
        $interview_rounds = $this->input->post('interview-rounds');
        $budget_currency = $this->input->post('budget-currency');
        $budget_min = $this->input->post('budget-min');
        $budget_max = $this->input->post('budget-max');
        $budget_max = $this->input->post('budget-max');
        $valid_through = $this->input->post('valid-through');
        $hide_budget = $this->input->post('hide-budget') === '1';
        if ($this->input->post("imageFilePath") == 'uploads/company_logo/') {
            $company_logo = null;
        } else {
            $company_logo = $this->input->post("imageFilePath");
        }
        $requirement_data = array(
            'job_title' => $job_title,
            'technical_skills' => $skills,
            'experience' => $experience,
            'job_description' => $job_description,
            'employment_type' => $employment_type,
            'job_location_type' => $job_location_type,
            'location' => $location,
            'interview_rounds' => $interview_rounds,
            'budget_currency' => $budget_currency,
            'budget_min' => $budget_min,
            'budget_max' => $budget_max,
            'valid_through' => $valid_through,
            'hide_budget' => $hide_budget,
            'company_logo' => $company_logo
        );
        $this->model_requirements->create_requirement($requirement_data);

        if (in_array('viewAdmin', $this->permission)) {
            $getallrecords = $this->model_requirements->getAllRequirements();
        } else {
            $getallrecords = $this->model_requirements->getAllRequirements();
        }
        $this->data['message'] = "JD Created successfully";
        $this->data["list"] = $getallrecords;
        $this->render_template("admin/requirements/list", $this->data);
    }

    public function change_status($id)
    {

        // if(!in_array('deleteUser', $this->permission)) {
        //     redirect('admin/dashboard', 'refresh');
        // }

        if ($id) {
            $returnvals = $this->model_requirements->getrequirementbyid($id);

            $activeStatus = $returnvals[0]['status'] === '1' ? 0 : 1;

            if (!empty($returnvals)) {
                $updatedarray = array(
                    "status" => $activeStatus
                );
                $where = array("id" => $id);
                $result = $this->model_requirements->insertOrUpdateUsers($updatedarray, 1, $where);
                if ($result == true) {
                    $this->data['message'] = "JD Updated";
                }
            } else {
                $this->data['message'] = "Cannot update JD";
            }
        }
        if ($returnvals[0]['type'] == 'admin') {
            $getallrecords = $this->model_requirements->getAllRequirements();
            $this->data["list"] = $getallrecords;
            $this->render_template("admin/requirements/list", $this->data);
        } else {
            $getallrecords = $this->model_requirements->getAllClientRequirements();
            $this->data["list"] = $getallrecords;
            $this->render_template("admin/requirements/client", $this->data);
        }
        
    }

    public function change_applicant_status()
    {
        $status = $this->input->post('status');
        $id = $this->input->post('id');
        $jd_id = $this->input->post('jd_id');

        // Update the status in the table using the provided $status and $id
        $this->load->model('Model_requirements');
        $this->Model_requirements->updateStatus($status, $id, $jd_id);

        echo 'Status updated successfully';
    }

    public function edit($id)
    {
        $this->load->model('Model_requirements');
        if ($id) {
            $this->data['requirements'] = $this->Model_requirements->getrequirementbyid($id);
            $this->render_template("admin/requirements/edit", $this->data);
        }
    }

    public function update($id)
    {
        $this->load->model('Model_requirements');

        $config["allowed_types"] = "*";
        $config["upload_path"] = "./uploads/company_logo/";
        $config["max_size"] = "0";
        $this->load->library("upload", $config);
        $this->load->library("image_lib");

        if ($this->upload->do_upload("image")) {
            $Imgdata = $this->upload->data();
            $imgName = $Imgdata["file_name"];
            $company_logo_url = "uploads/company_logo/" . $imgName;

        } else {
            $company_logo_url = null;
        }

        $job_title = $this->input->post('job-title');
        $technical_skills = $this->input->post('skill_list');
        $skills = isset($technical_skills) && is_array($technical_skills) ? $technical_skills : [];
        $skills = implode(', ', $skills);
        $experience = $this->input->post('experience');
        $job_description = $this->input->post('job-description');
        $employment_type = $this->input->post('employment-type');
        $job_location_type = $this->input->post('job-location-type');
        $location = $this->input->post('location');
        $interview_rounds = $this->input->post('interview-rounds');
        $budget_currency = $this->input->post('budget-currency');
        $budget_min = $this->input->post('budget-min');
        $budget_max = $this->input->post('budget-max');
        $budget_max = $this->input->post('budget-max');
        $valid_through = $this->input->post('valid-through');
        $hide_budget = $this->input->post('hide-budget') === '1';

        if ($this->input->post("imageFilePath") == 'uploads/company_logo/') {
            $company_logo = null;
        } else {
            $company_logo = $this->input->post("imageFilePath");
        }

        $data = array(
            'job_title' => $job_title,
            'technical_skills' => $skills,
            'experience' => $experience,
            'job_description' => $job_description,
            'employment_type' => $employment_type,
            'job_location_type' => $job_location_type,
            'location' => $location,
            'interview_rounds' => $interview_rounds,
            'budget_currency' => $budget_currency,
            'budget_min' => $budget_min,
            'budget_max' => $budget_max,
            'valid_through' => $valid_through,
            'hide_budget' => $hide_budget,
            'company_logo' => $company_logo
        );

        $response = $this->Model_requirements->updateUsers($id, $data);

        $returnvals = $this->model_requirements->getrequirementbyid($id);
        if ($returnvals[0]['type'] == 'admin') {
            redirect('admin/requirements', 'refresh');
        } else {
            redirect('admin/requirements/client', 'refresh');
        }

        redirect('admin/requirements', 'refresh');
    }

}