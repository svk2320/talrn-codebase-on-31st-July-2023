<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Action extends Admin_Controller
{
	public function __construct()
	{
        parent::__construct();
        $this->not_logged_in();
		$this->data['page_title'] = 'Vendor Action';
    }

    public function index()
    {
        $this->render_template('admin/vendor/action', $this->data);
    }

}
