<?php

class Model_sitemap extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }

    public function getApprovedProfileList() {
        $sql = "SELECT unique_id, profile_url FROM profiles WHERE active = 1 AND approval = 1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getSkillsets(){
        $sql = "SELECT name FROM profiles_skills";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
?>
