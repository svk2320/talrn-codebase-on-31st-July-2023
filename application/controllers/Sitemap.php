<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap extends CI_Controller {

    public function index()
    {
        // Load the sitemap view
        $this->load->view('sitemap');
    }
    
    public function staticPages()
    {
        // Load the sitemap view
        $this->load->view('static_pages');
    }
    
    public function profiles()
    {   
        $this->load->model('Model_sitemap');
        $data['result'] = $this->Model_sitemap->getApprovedProfileList();
        
        // Load the sitemap view
        $this->load->view('profiles_listings', $data);
    }
    
    public function skills()
    {
        $this->load->model('Model_sitemap');
        $data['result'] = $this->Model_sitemap->getSkillsets();
        
        // Load the sitemap view
        $this->load->view('skills_listings', $data);
    }
}
