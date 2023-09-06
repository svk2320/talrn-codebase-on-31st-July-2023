<?php 

class Model_deleted_profiles extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getAllDeletedProfiles() 
	{
		$sql = 'SELECT * FROM deleted_profiles';
		$sql = 'SELECT deleted_profiles.id, deleted_profiles.unique_id, deleted_profiles.first_name, deleted_profiles.last_name, deleted_profiles.experience, deleted_profiles.country,
		        deleted_profiles.city, deleted_profiles.primary_title, deleted_profiles.currency, deleted_profiles.ppm_max, deleted_profiles.profile_url, deleted_profiles.job_status,
		        deleted_profiles.notice_period, deleted_profiles.active, deleted_profiles.approval, deleted_users.registered_as, deleted_users.username FROM deleted_profiles 
			    LEFT JOIN deleted_users ON deleted_profiles.vendor_id = deleted_users.id';
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getprofilebyid($id)
    {
        $this->db->cache_delete('deleted_profiles', $id); // Clear cache for the specific profile ID
        
        $sql = "SELECT * FROM deleted_profiles WHERE id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }

	public function getidbyuniqueid($id)
	{
		$sql = "SELECT id FROM deleted_profiles where unique_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function getDeletedProfilebyid($id)
    {
        $this->db->cache_delete('deleted_profiles', $id); // Clear cache for the specific profile ID
        
        $sql = "SELECT * FROM deleted_profiles WHERE id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
    
    public function getDeletedProfileEdu($id)
	{
		$sql = "SELECT * FROM deleted_profiles_edu where profile_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function getDeletedProfileExp($id)
	{
		$sql = "SELECT * FROM deleted_profiles_exp where profile_id = ? ORDER BY IF(end = '', 1, 0) DESC, STR_TO_DATE(CONCAT('01-', end), '%d-%M-%Y') DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function getDeletedProfilePro($id)
	{
		$sql = "SELECT * FROM deleted_profiles_pro where profile_id = ? ORDER BY id ASC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function getDeletedProfileCert($id)
	{
		$sql = "SELECT * FROM deleted_profiles_cert where profile_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function getDeletedProfileSkills($id)
	{
		$sql = "SELECT * FROM deleted_profiles_skills where profile_id = ? ORDER BY year DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
    public function insertDeletedProfiles($id)
    {
        if ($id) {
            $sqlProfiles = "INSERT INTO deleted_profiles
                            SELECT *
                            FROM profiles
                            WHERE id = ?";
                            
            $sqlProfilesCert = "INSERT INTO deleted_profiles_cert
                                SELECT *
                                FROM profiles_cert
                                WHERE profile_id = ?";
                                
            $sqlProfilesEdu = "INSERT INTO deleted_profiles_edu
                                SELECT *
                                FROM profiles_edu 
                                WHERE profile_id = ?";
                                
            $sqlProfilesExp = "INSERT INTO deleted_profiles_exp
                                SELECT *
                                FROM profiles_exp
                                WHERE profile_id = ?";
                                
            $sqlProfilesPro = "INSERT INTO deleted_profiles_pro
                                SELECT *
                                FROM profiles_pro
                                WHERE profile_id = ?";
                                
            $sqlProfilesSkills = "INSERT INTO deleted_profiles_skills
                                SELECT *
                                FROM profiles_skills
                                WHERE profile_id = ?";
                                
            $sqlUser = "INSERT INTO deleted_users
                                SELECT *
                                FROM users
                                WHERE id = (SELECT vendor_id FROM profiles WHERE id = ?)
                                AND NOT EXISTS (SELECT 1 FROM deleted_users WHERE id = (SELECT vendor_id FROM profiles WHERE id = ?))";
                                
            $sqlStore = "INSERT INTO deleted_stores
                         SELECT *
                         FROM stores
                         WHERE id = (SELECT vendor_id FROM profiles WHERE id = ?)
                         AND NOT EXISTS (SELECT 1 FROM deleted_stores WHERE id = (SELECT vendor_id FROM profiles WHERE id = ?))";

            
            $this->db->query($sqlProfiles, array($id));
            $this->db->query($sqlProfilesCert, array($id));
            $this->db->query($sqlProfilesEdu, array($id));
            $this->db->query($sqlProfilesExp, array($id));
            $this->db->query($sqlProfilesPro, array($id));
            $this->db->query($sqlProfilesSkills, array($id));
            $this->db->query($sqlUser, array($id, $id));
            $this->db->query($sqlStore, array($id, $id));
            
            return true;
        }
        
        return false;
    }
    
    public function delete_profile_edu($id)
	{
		$sql = "DELETE FROM deleted_profiles_edu WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_exp($id)
	{
		$sql = "DELETE FROM deleted_profiles_exp WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_pro($id)
	{
		$sql = "DELETE FROM deleted_profiles_pro WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}
	
	public function delete_profile_cert($id)
	{
		$sql = "DELETE FROM deleted_profiles_cert WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_skills($id)
	{
		$sql = "DELETE FROM deleted_profiles_skills WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}
	
	public function delete_profile($id)
	{
		$sql = "DELETE FROM deleted_profiles WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}
}

?>
