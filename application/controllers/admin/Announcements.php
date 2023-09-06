<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Announcements extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
    }

    public function index()
    {
        $this->load->model('Model_announcement');
        
        $this->data['list'] = $this->Model_announcement->getAnnouncementsData();
        
        $this->data['page_title'] = 'Announcement';
        
        $this->render_template("admin/announcements/index", $this->data);

    }
    
    // pop up
    
    public function pop_up()
    {
        $this->data['page_title'] = 'Pop up announcement';
        
        $this->load->model('Model_notification');
        $this->data['list'] = $this->Model_notification->getNotificationsData();
        $this->render_template("admin/announcements/pop_up/pop_up_announcement", $this->data);
    }

    public function create_pop_up()
    {
        $this->data['page_title'] = 'Create Pop up announcement';
        $this->load->model('Model_groups');
        
        $this->data['individual_count'] = $this->Model_groups->noOfIndividual();
        $this->data['organisation_count'] = $this->Model_groups->noOfOrganisation();
        $this->data['client_count'] = $this->Model_groups->noOfClients();
        $this->render_template("admin/announcements/pop_up/create_pop_up", $this->data);
    }
    
    public function pop_up_savedata()
    {
        $this->load->model('Model_notification');
        $this->data['page_title'] = 'Pop up announcement';

        $admin = $this->input->post('Admin') === '1';
        $website = $this->input->post('Website') === '1';
        $organisation = $this->input->post('Organization') === '1';
        $individual = $this->input->post('Individual') === '1';
        $client = $this->input->post('Client') === '1';
        
        // Get the current timestamp
        $currentDateTime = date('Y-m-d H:i:s');

        $data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'active' => 1,
            'expiration_date' => $this->input->post('text1'),
            'admin'=> $admin,
            'website'=> $website,
            'organisation'=> $organisation,
            'individual'=> $individual,
            'client'=> $client,
            'created_at'=> $currentDateTime
        );
        

        $response = $this->Model_notification->insertNotification($data);
        
        $lastId = $this->Model_notification->getlastId();
        
        $this->Model_notification->updateNotification(1, $lastId);
        
        $this->load->model('Model_notification');
        $this->data['list'] = $this->Model_notification->getNotificationsData();

        $this->data['message'] = "Pop up announcement created";

        $this->render_template("admin/announcements/pop_up/pop_up_announcement", $this->data);
    }


    public function update_pop_up($id)
    {
        $this->load->model('Model_notification');
        if ($id) {
            $returnvals = $this->Model_notification->getNotificationById($id);

            $activeStatus = $returnvals[0]['active'] === '1' ? 0 : 1;
            
            $this->data['page_title'] = 'Pop up announcement';

            if (!empty($returnvals)) {
                $this->load->model('Model_notification');
                // Get the current timestamp
                $currentDateTime = date('Y-m-d H:i:s');
                
                $this->Model_notification->updateNotification($activeStatus, $id, $currentDateTime);
                $this->data['message'] = "Pop up announcement Updated";
                
                $this->data['list'] = $this->Model_notification->getNotificationsData();
                $this->render_template("admin/announcements/pop_up/pop_up_announcement", $this->data);
            } else {
                $this->data['message'] = "Cannot update Pop up announcement";
                
                $this->render_template("admin/announcements/pop_up/pop_up_announcement", $this->data);
            }
        }
    }


    public function delete_pop_up($id)
    {
        $this->load->model('Model_notification');
        if ($id) {
            $this->Model_notification->deleteNotification($id);
        }
        
        // redirect('admin/announcements/pop_up_announcement', 'refresh');
        
            // Return a JSON response
        $response = array(
            'status' => 'success',
            'message' => 'Row deleted successfully.',
        );

    // Set the appropriate headers for JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    }


    public function edit_pop_up($id)
    {
        $this->load->model('Model_notification');
        $this->load->model('Model_groups');
        $this->data['page_title'] = 'Edit Pop up announcement';
            
        if ($id) {
            $this->data['notification'] = $this->Model_notification->getNotificationById($id);
            $this->data['individual_count'] = $this->Model_groups->noOfIndividual();
            $this->data['organisation_count'] = $this->Model_groups->noOfOrganisation();
            $this->data['client_count'] = $this->Model_groups->noOfClients();
            
            $this->render_template("admin/announcements/pop_up/edit_pop_up", $this->data);
        }
    }

    public function updatedata_pop_up($id)
    {
        $this->load->model('Model_notification');
        $this->data['page_title'] = 'Pop up announcement';

        $admin = $this->input->post('Admin') === '1';
        $website = $this->input->post('Website') === '1';
        $organisation = $this->input->post('Organization') === '1';
        $individual = $this->input->post('Individual') === '1';
        $client = $this->input->post('Client') === '1';
        
        // Get the current timestamp
        $currentDateTime = date('Y-m-d H:i:s');

        $data = array(
            'title' => $this->input->post('title'),
            'text' => $this->input->post('text'),
            'expiration_date' => $this->input->post('text1'),
            'active' => 1,
            'admin'=> $admin,
            'website'=> $website,
            'organisation'=> $organisation,
            'individual'=> $individual,
            'client'=> $client,
            'created_at' => $currentDateTime
        );

        $response = $this->Model_notification->EditNotification($data,$id);
        
        $this->Model_notification->updateNotification(1, $id);
        $this->data['list'] = $this->Model_notification->getNotificationsData();

        $this->data['message'] = "Pop up announcement updated";
            
        $this->render_template("admin/announcements/pop_up/pop_up_announcement", $this->data);
    }
    
    // sticky header
    
    public function sticky_header()
    {
        $this->data['page_title'] = 'Sticky header announcement';
        
        $this->load->model('Model_announcement');
        $this->data['list'] = $this->Model_announcement->getAnnouncementsData();
        $this->render_template("admin/announcements/sticky_header/sticky_header", $this->data);

    }
    
    public function create_sticky_header()
    {
        $this->data['page_title'] = 'Create sticky header announcement';
        
        $this->load->model('Model_groups');
        
        $this->data['individual_count'] = $this->Model_groups->noOfIndividual();
        $this->data['organisation_count'] = $this->Model_groups->noOfOrganisation();
        
        $this->render_template("admin/announcements/sticky_header/create_sticky_header", $this->data);
    }
    
    public function sticky_header_savedata()
    {
        $this->load->model('Model_announcement');
        
        $this->data['page_title'] = 'Sticky header announcement';
        
        $lastId = $this->Model_announcement->getlastId();
        
        $this->Model_announcement->updateAnnouncement(1, $lastId);

        $website = $this->input->post('Website') === '1';
        $organisation = $this->input->post('Organization') === '1';
        $individual = $this->input->post('Individual') === '1';

        $data = array(
            'text' => $this->input->post('text'),
            'expiration_date' => $this->input->post('text1'),
            'active' => 1,
            'website'=> $website,
            'organisation'=> $organisation,
            'individual'=> $individual
        );

        $response = $this->Model_announcement->insertAnnouncement($data);
        
        $lastId = $this->Model_announcement->getlastId();
        $this->Model_announcement->updateAnnouncement(1, $lastId);
        
        $this->data['message'] = "Sticky header created";
        
        $this->data['list'] = $this->Model_announcement->getAnnouncementsData();

        $this->render_template("admin/announcements/sticky_header/sticky_header", $this->data);
    }


    public function update_sticky_header($id)
    {
        $this->load->model('Model_announcement');
        if ($id) {
            $returnvals = $this->Model_announcement->getannouncementbyid($id);

            $activeStatus = $returnvals[0]['active'] === '1' ? 0 : 1;
            
            $this->data['page_title'] = 'Sticky header announcement';
            
            if (!empty($returnvals)) {
                $this->Model_announcement->UpdateAnnouncement($activeStatus, $id);
                $this->data['message'] = "Sticky header Updated";
                
                $this->data['list'] = $this->Model_announcement->getAnnouncementsData();
            } else {
                $this->data['message'] = "Cannot update Sticky header";
            }
        }
        $this->render_template("admin/announcements/sticky_header/sticky_header", $this->data);
    }


    public function delete_sticky_header($id)
    {
        $this->load->model('Model_announcement');
        if ($id) {
            $this->Model_announcement->deleteannouncement($id);
        }
        
        // redirect('admin/announcements/sticky_header', 'refresh');
        
        // Return a JSON response
        $response = array(
            'status' => 'success',
            'message' => 'Row deleted successfully.',
        );

        // Set the appropriate headers for JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    }


    public function edit_sticky_header($id)
    {
        $this->data['page_title'] = 'Sticky header announcement';
        
        $this->load->model('Model_announcement');
        $this->load->model('Model_groups');
        
        $this->data['individual_count'] = $this->Model_groups->noOfIndividual();
        $this->data['organisation_count'] = $this->Model_groups->noOfOrganisation();
        
        if ($id) {
            $this->data['announcement'] = $this->Model_announcement->getannouncementbyid($id);
            $this->render_template("admin/announcements/sticky_header/edit_sticky_header", $this->data);
        }
    }

    public function updatedata_sticky_header($id)
    {
        $this->load->model('Model_announcement');
        
        $this->data['page_title'] = 'Sticky header announcement';

        $website = $this->input->post('Website') === '1';
        $organisation = $this->input->post('Organization') === '1';
        $individual = $this->input->post('Individual') === '1';

        $data = array(
            'text' => $this->input->post('text'),
            'expiration_date' => $this->input->post('text1'),
            'active' => 1,
            'website'=> $website,
            'organisation'=> $organisation,
            'individual'=> $individual
        );
        

        $response = $this->Model_announcement->EditAnnouncement($data,$id);
        
        $lastId = $this->Model_announcement->getlastId();
        $this->Model_announcement->updateAnnouncement(1, $id);
        
        $this->data['list'] = $this->Model_announcement->getAnnouncementsData();
        
        $this->data['message'] = "Sticky header updated";
        
        $this->render_template("admin/announcements/sticky_header/sticky_header", $this->data);

    }
    
    public function show_all_popups(){
        $this->load->model('Model_notification');
        
        if(in_array('viewAdmin', $this->permission)){
            // $user_type = "admin";
            
            $this->data['list'] = $this->Model_notification->getAllNotificationsOfAdmin();
            
        } elseif ($_SESSION['registered_as'] == 2) {
            // $user_type = "individual";
            
            $this->data['list'] = $this->Model_notification->getAllNotificationsOfIndividual();
            
        } elseif($_SESSION['registered_as'] == 1) {
            // $user_type = 'organisation';
            
            $this->data['list'] = $this->Model_notification->getAllNotificationsOfOrganisation();
            
        }
        
        $this->data['page_title'] = 'All Popup Announcements';
        
        $this->render_template("admin/announcements/show_all_popups", $this->data);
    }

    public function show_all_popups_for_client()
    {
        $this->load->model('Model_notification');
            
        $this->data['client'] = $this->Model_notification->getAllNotificationsOfClients();
        
        $this->data['page_title'] = 'All Popup Announcements of client';
        
        $this->render_template("admin/announcements/show_all_popups_for_client", $this->data);
    }
    
    public function show_all_popups_for_individual()
    {
        $this->load->model('Model_notification');
        
        $this->data['individual'] = $this->Model_notification->getAllNotificationsOfIndividual();
        
        $this->data['page_title'] = 'All Popup Announcements of individual';
        
        $this->render_template("admin/announcements/show_all_popups_for_individual", $this->data);
    }
    
    public function show_all_popups_for_organisation()
    {
        $this->load->model('Model_notification');
            
        $this->data['organisation'] = $this->Model_notification->getAllNotificationsOfOrganisation();
        
        $this->data['page_title'] = 'All Popup Announcements of organisation';
        
        $this->render_template("admin/announcements/show_all_popups_for_organisation", $this->data);
    }
    
    }
?>
