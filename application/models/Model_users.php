<?php 

class Model_users extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function last_login($user_id){
	    if($user_id){
    	    $sql = "UPDATE profiles SET last_login = NOW() WHERE id in (SELECT * FROM (SELECT id FROM profiles WHERE vendor_id = ? AND approval = 1 ORDER BY id DESC LIMIT 1) temp_tab);";
    	    $query = $this->db->query($sql, $user_id);
	    }
	}

    	public function getApprovedProfiles() 
	{
	        $sql = "
	                SELECT 
	                    profiles.id,
	                    profiles.unique_id,
	                    profiles.first_name,
	                    profiles.last_name,
	                    profiles.primary_title,
	                    profiles.highlight, 
	                    profiles.highlight_text,
	                    (
	                        SELECT  GROUP_CONCAT(DISTINCT profiles_pro.title SEPARATOR ', ')
	                        FROM profiles_pro 
	                        WHERE profiles_pro.profile_id = profiles.id
	                    ) AS projects,
	                    (
	                        SELECT GROUP_CONCAT(DISTINCT profiles_exp.company_name SEPARATOR ', ')
	                        FROM profiles_exp 
	                        WHERE profiles_exp.profile_id = profiles.id
	                    ) AS employer
	                FROM `profiles`
	                WHERE profiles.approval = 1
	                ";
	        $query = $this->db->query($sql);
	        $result = $query->result_array();
	        return $result;
	    }

    public function updateProfileHighlightStatus($id, $highlightText = null)
    {
        $sql = "UPDATE profiles SET highlight = CASE WHEN highlight = 1 THEN 0 ELSE 1 END, highlight_text = ? WHERE id = ?";
        $query = $this->db->query($sql, array($highlightText, $id));
        return $query;
    }
    
    public function getTotalHightlights(){
        $sql = "SELECT COUNT(*) as hightlightCount FROM `profiles` WHERE highlight = 1 AND approval = 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result[0]->hightlightCount; 
    }

	public function getUserData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM users WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users  ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getUserGroup($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM user_group WHERE user_id = ?";
			$query = $this->db->query($sql, array($userId));
			$result = $query->row_array();

			$group_id = $result['group_id'];
			$g_sql = "SELECT * FROM groups WHERE id = ?";
			$g_query = $this->db->query($g_sql, array($group_id));
			$q_result = $g_query->row_array();
			return $q_result;
		}
	}

	public function storeProfileImagePath($Id = null, $userPhotoPath = null) 
	{
		if ($Id && $userPhotoPath) {
		    $sql = "UPDATE profiles SET userPhoto = ? WHERE id = ?";
		    $query = $this->db->query($sql, array($userPhotoPath, $Id));
		    
		    return 'Image path stored in the database';
		}
	        
	        return 'There is no user id or user photo path for storing the image path in the database';  
	    }
    
	public function deleteProfileImagePath($Id = null) {
	        if ($Id) {
	            $sql = "UPDATE profiles SET userPhoto = ? WHERE id = ?";
	            $query = $this->db->query($sql, array('uploads/', $Id));
	            
	            return 'Image path deleted in the database';
	        }
	        
	        return 'There is no user id for deleting the image path';
	    }

	public function create($data = '', $group_id = null)
	{

		if($data && $group_id) {
			$create = $this->db->insert('users', $data);

			$user_id = $this->db->insert_id();

			$group_data = array(
				'user_id' => $user_id,
				'group_id' => $group_id
			);

			$group_data = $this->db->insert('user_group', $group_data);

			return ($create == true && $group_data) ? true : false;
		}
	}

	public function edit($data = array(), $id = null, $group_id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('users', $data);

		if($group_id) {
			// user group
			$update_user_group = array('group_id' => $group_id);
			$this->db->where('user_id', $id);
			$user_group = $this->db->update('user_group', $update_user_group);
			return ($update == true && $user_group == true) ? true : false;	
		}
			
		return ($update == true) ? true : false;	
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('users');
		return ($delete == true) ? true : false;
	}

	public function countTotalUsers()
	{
		$sql = "SELECT * FROM users WHERE id != ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function createorg($org = '', $url = '',$type = '',$date = '') {
		if($org) {
			$add_data = array (
				'name' => $org,
				'website' => $url,
                'registered_as' => $type,
				'active' => 1,
                'date' => $date
			);
			$this->db->insert('stores', $add_data);
			return $org_id = $this->db->insert_id();
		}
	}


	// skill sets 

	public function getNoProfileUsers() 
	{
		$sql = "SELECT * FROM `users` WHERE id NOT IN (SELECT vendor_id FROM profiles GROUP BY vendor_id) AND reminder = 1";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSkillSetData() 
	{
		$sql = "SELECT * FROM skilsets ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createReminder($data)
	{
		if($data) {
			$create = $this->db->insert('email_reminders', $data);
			return ($create == true) ? true : false;
		}
	}

	public function toggleReminder($id)
	{
		if($id) {
			$sql = "UPDATE users SET reminder = (CASE WHEN reminder = 1 THEN 0 ELSE 1 END) WHERE id = ". $id;
			$query = $this->db->query($sql);
		}
	}
	
	
	public function getUserWebsite($userId = null) 
	{
		if($userId) {
			$sql = "SELECT name,website FROM stores WHERE id = (SELECT store_id from users WHERE id = ? limit 1)";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
	public function getUserProfileId($userId = null) 
	{
		if($userId) {
			$sql = "SELECT LOWER(unique_id) as unique_id FROM profiles Where vendor_id = ? LIMIT 1";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM users WHERE id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
	public function getNoOfProfilesByUserId($userId = null) 
	{
		if($userId) {
			$sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE profiles.active != 2 && vendor_id = ?";
            $query = $this->db->query($sql,array($userId));
            $result = $query->result();
            return $result[0]->profile_count;
		}
	}
	
	public function getUserProfileEmail($email = null) 
	{
		if($email) {
			$sql = "SELECT id,firstname,lastname,email,password FROM users Where email = ? LIMIT 1";
			$query = $this->db->query($sql ,array($email));
			return $query->row_array();
		}
	}
	
	public function getLatestEmailUsers($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM `email_reminders` WHERE user_id=? ORDER BY date DESC LIMIT 1;";
            $query = $this->db->query($sql,array($userId));
            $result = $query->result();
			if (sizeof($result) > 0){
				return $result[0]->date;
			}
			else{
				return null;
			}
		}
	}
	
	public function getEmailLogs(){
		$sql = "SELECT * FROM email_reminders ORDER BY date DESC;";
	        $query = $this->db->query($sql);
	        return $query->result_array();
	}

    	public function getVerifiedStatus($userId) {
	        $sql = "SELECT COUNT(*) AS num_profiles FROM profiles WHERE verified = 1 AND verified_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND vendor_id = ?;";
	        $query = $this->db->query($sql, array($userId));
	        $result = $query->row_array();
	        $count = $result['num_profiles'];
	        return $count > 0;
    	}
}
