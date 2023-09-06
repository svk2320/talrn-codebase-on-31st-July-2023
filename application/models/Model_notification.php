<?php

class Model_notification extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }
    
    public function getAllNotificationsOfAdmin(){
        $sql = "SELECT * FROM notification WHERE admin = 1 ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAllNotificationsOfOrganisation(){
        $sql = "SELECT * FROM notification WHERE organisation = 1 ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAllNotificationsOfIndividual(){
        $sql = "SELECT * FROM notification WHERE individual = 1 ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getAllNotificationsOfClients(){
        $sql = "SELECT * FROM notification WHERE client = 1 ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    
    public function getAllNotifications()
    {
        $sql = "SELECT * FROM notification";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function insertNotification($data)
    {
        $result = $this->db->insert('notification', $data);
        return $result;
    }

    public function getlastId(){
        $sql = "SELECT id as last_id FROM notification ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        
        if($result[0]->last_id == null){
          return 0;
        }
        
        return $result[0]->last_id;
    }
    
    public function getNotificationForWebsite(){
        $sql = "SELECT * FROM notification WHERE website = 1 AND active = 1 AND (expiration_date = '' OR expiration_date >= CURDATE()) ORDER BY created_at DESC LIMIT 1";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getLastThreeNotificationForAdmin(){
        $sql = "SELECT * FROM notification WHERE admin = 1 AND active = 1 ORDER BY CAST(active AS SIGNED) DESC, created_at DESC LIMIT 3";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getLastThreeNotificationForClient(){
        $sql = "SELECT * FROM notification WHERE client = 1 AND active = 1 ORDER BY CAST(active AS SIGNED) DESC, created_at DESC LIMIT 3";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getLastThreeNotificationForIndividual(){
        $sql = "SELECT * FROM notification WHERE individual = 1 AND active = 1 ORDER BY CAST(active AS SIGNED) DESC, created_at DESC LIMIT 3";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    
    public function getLastThreeNotificationForOrganisation(){
        $sql = "SELECT * FROM notification WHERE organisation = 1 AND active = 1 ORDER BY CAST(active AS SIGNED) DESC, created_at DESC LIMIT 3";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function editNotification($data,$id)
    {
        if ($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('notification', $data);
			return ($update == true) ? true : false;
		}
    }

    public function testConnection()
    {
        $query = $this->db->query("SELECT 1");
        if ($query) {
            echo "Database connection is working.";
        } else {
            echo "Database connection error.";
        }
    }
    public function getNotificationsData($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM notification WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }
        $sql = "SELECT * FROM notification ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getActiveNotification()
    {
        $query = $this->db->query("SELECT *
        FROM notification
        WHERE active = 1 AND (expiration_date = '' OR expiration_date >= CURDATE())
        LIMIT 1;
        ");
        return $query->result_array();
    }

    public function getNotificationById($id){
		$sql = "SELECT * FROM notification WHERE id = ?";
		$query = $this->db->query($sql,array($id));
		return $query->result_array();
	}

    public function updateNotification($updatedarray, $id = null, $currectDateTime = null)
    {
        if ($id != null) {
            // $sql1 = "UPDATE `notification` SET active = 0 WHERE 1";
            $sql2 = "UPDATE `notification` SET active = ? WHERE id = ?";
            $sql3 = "UPDATE `notification` SET created_at = ? WHERE id = ?";
            
            // $this->db->query($sql1);
            $this->db->query($sql2, array($updatedarray,$id));
            $this->db->query($sql3, array($currectDateTime,$id));
        }
    }


    public function deleteNotification($id = null){
        if ($id != null) {
            $this->db->where('id', $id);
		    $delete = $this->db->delete('notification');
		    return ($delete == true) ? true : false;
        }
    }
}
?>
