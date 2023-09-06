<?php

class Model_announcement extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database library
    }

    public function insertAnnouncement($data)
    {
        $result = $this->db->insert('announcements', $data);
        return $result;
    }
    
    public function getlastId(){
        $sql = "SELECT id as last_id FROM announcements ORDER BY id DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        
        if($result[0]->last_id == null){
          return 0;
        }
        
        return $result[0]->last_id;
    }



    public function EditAnnouncement($data,$id)
    {
        if ($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('announcements', $data);
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
    public function getAnnouncementsData($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM announcements WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }
        $sql = "SELECT * FROM announcements ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getActiveAnnouncement()
    {
        $query = $this->db->query("SELECT *
        FROM announcements
        WHERE active = 1 AND (expiration_date = '' OR expiration_date >= CURDATE())
        LIMIT 1;
        ");
        return $query->result_array();
    }

    public function getannouncementbyid($id){
		$sql = "SELECT * FROM announcements WHERE id = ?";
		$query = $this->db->query($sql,array($id));
		return $query->result_array();
	}

    public function UpdateAnnouncement($updatedarray, $id = null)
    {
        if ($id != null) {
            $sql1 = "UPDATE `announcements` SET active = 0 WHERE 1";
            $sql2 = "UPDATE `announcements` SET active = ? WHERE id = ?";
            
            $this->db->query($sql1);
            $this->db->query($sql2, array($updatedarray,$id));
        }
    }


    public function deleteannouncement($id = null){
        if ($id != null) {
            $this->db->where('id', $id);
		    $delete = $this->db->delete('announcements');
		    return ($delete == true) ? true : false;
        }
    }
}
?>
