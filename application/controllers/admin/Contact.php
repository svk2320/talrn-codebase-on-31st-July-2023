<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends Admin_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->not_logged_in();
		$this->data['page_title'] = 'Contact';
    }

    public function index()
    {
        $data = array(
        	'full_name' => $this->input->post('full_name'),
            'reason' => 'Others',
            'message' => ''
        );
        $this->data['contact_data'] = $data;
        $this->data['reason'] = $this->contact_reason();
        $this->render_template('admin/contact/index', $this->data);
    }
}
