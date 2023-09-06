<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Announcements extends Client_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();
    }

    public function index()
    {
        echo 'client';
    }
    
    public function show_all_popups(){
        $this->load->model('Model_notification');

        $this->data['list'] = $this->Model_notification->getAllNotificationsOfClients();
        
        $this->data['page_title'] = 'All Popup Announcements';
        
        $this->render_template("client/announcements/show_all_popups", $this->data);
    }
    
    }
?>
