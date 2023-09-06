<?php

class Model_stores extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getStoresData($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM stores WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM stores ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getStoresDataExtra($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM stores WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT stores.*,users.city,users.email,users.phone,users.id AS uid FROM stores,users WHERE stores.id = users.store_id ORDER BY stores.id DESC;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data = array())
	{
		if ($data) {
			$create = $this->db->insert('stores', $data);
			return ($create == true) ? true : false;
		}
	}

	public function update($id = null, $data = array())
	{
		if ($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('stores', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id = null)
	{
		if ($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('stores');
			return ($delete == true) ? true : false;
		}

		return false;
	}

	public function getStoresDataByUserID($userId)
	{
		if ($userId) {
			$sql = "SELECT * FROM stores WHERE id = (SELECT store_id from users WHERE id = ? limit 1)";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}
	}

	public function get_type_by_id($id)
	{
		$sql = "SELECT registered_as FROM users WHERE id = ?";
		$query = $this->db->query($sql, $id);
		$result = $query->result();
		return $result[0]->registered_as;
	}

	public function getActiveStore()
	{
		$sql = "SELECT * FROM stores WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function countTotalStores()
	{
		$sql = "SELECT * FROM stores WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function insertProfiles($data = array())
	{
		if ($data) {
			$create = $this->db->insert('profiles', $data);
			return $this->db->insert_id();
		}
	}

	public function insertProfilesEdu($data = array())
	{
		if ($data) {
			$create = $this->db->insert('profiles_edu', $data);
			return ($create == true) ? true : false;
		}
	}
	public function insertProfilesExp($data = array())
	{
		if ($data) {
			$create = $this->db->insert('profiles_exp', $data);
			return ($create == true) ? true : false;
		}
	}

	public function insertProfilesPro($data = array())
	{
		if ($data) {
			$create = $this->db->insert('profiles_pro', $data);
			return ($create == true) ? true : false;
		}
	}

	public function insertProfilesCert($data = array())
	{
		if ($data) {
			$create = $this->db->insert('profiles_cert', $data);
			return ($create == true) ? true : false;
		}
	}

	public function insertProfilesSkills($data = array())
	{
		if ($data) {
			$create = $this->db->insert('profiles_skills', $data);
			return ($create == true) ? true : false;
		}
	}

	public function getallprofiles($id)
	{
		$id = (int) $id;
		$sql = "SELECT * FROM profiles where vendor_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		// echo '<pre>';
		// print_r($query->result_array());
		// exit;
		return $query->result_array();
	}

	public function getallprofilesbyid($id)
	{
		$id = (int) $id;
		$sql = "SELECT * FROM profiles where id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		// echo '<pre>';
		// print_r($query->result_array());
		// exit;
		return $query->result_array();
	}

	public function getallprofilespartner()
	{
		$sql = "SELECT profiles.id,profiles.unique_id,profiles.first_name,profiles.last_name,profiles.experience,profiles.country,profiles.city,profiles.primary_title,profiles.currency,profiles.ppm_max,profiles.profile_url,users.registered_as,users.username FROM profiles 
		LEFT JOIN users ON profiles.vendor_id = users.id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getAllProfilesByStoreid($vendor_id)
	{
		if ($vendor_id == 'admin') {
			$sql = "SELECT profiles.id,profiles.vendor_id,profiles.unique_id,profiles.first_name,profiles.last_name,profiles.experience,profiles.country,profiles.city,profiles.primary_title,profiles.currency,profiles.ppm_max,profiles.profile_url,profiles.job_status,profiles.notice_period,profiles.active,profiles.approval,users.registered_as,users.username FROM profiles 
				LEFT JOIN users ON profiles.vendor_id = users.id ORDER BY profiles.id DESC;";
			$query = $this->db->query($sql);
		} else {
			$sql = "SELECT profiles.id,profiles.vendor_id,profiles.unique_id,profiles.first_name,profiles.last_name,profiles.experience,profiles.country,profiles.city,profiles.primary_title,profiles.currency,profiles.ppm_max,profiles.profile_url,profiles.job_status,profiles.notice_period,profiles.active,profiles.approval,users.registered_as,users.username FROM profiles 
			LEFT JOIN users ON profiles.vendor_id = users.id  WHERE users.id = ?";
			$query = $this->db->query($sql,array($vendor_id));
		}
		return $query->result_array();
	}

	public function getallprofilesbyvendoridpartner($vendor_id, $limit, $start = null)
	{
		// echo '<pre>' . $vendor_id . ' limit: ' . $limit . ' start: ' . $start . '<br>';
		// $vendor_id = (int)$vendor_id;
		$data = array();
		$num_rows = 0;
		$this->db->select('*');
		$this->db->from('profiles');
		if ($vendor_id !== 'admin')
			$this->db->where('vendor_id', (int) $vendor_id);
		// this->db->where('vendor_id', (int) $vendor_id);
		$this->db->where('active = 1');
		$this->db->where('approval = 1');
		$this->db->order_by("id", "DESC");
		if ($limit !== 'donotsetlimit')
			$this->db->limit($limit, $start);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		$num_rows = count($data);
		$query->free_result();
		return array('data' => $data, 'count' => $num_rows);
	}

	public function getallprofilesbyvendorid($vendor_id, $limit, $start = null)
	{
		// echo '<pre>' . $vendor_id . ' limit: ' . $limit . ' start: ' . $start . '<br>';
		// $vendor_id = (int)$vendor_id;
		$data = array();
		$num_rows = 0;
		$this->db->select('profiles.*,users.username');
		$this->db->from('users,profiles');
		if ($vendor_id !== 'admin') {
			$this->db->where('users.id = profiles.vendor_id AND profiles.vendor_id = ' . $vendor_id);
		} else {
			$this->db->where('users.id = profiles.vendor_id');
		}
		$this->db->order_by("id", "DESC");
		if ($limit !== 'donotsetlimit')
			$this->db->limit($limit, $start);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		$num_rows = count($data);
		$query->free_result();
		return array('data' => $data, 'count' => $num_rows);
	}

	public function insertOrUpdateUsers($updatedarray, $condition = 0, $where = null)
	{
		if ($condition == 0) {
			$return = true;
			if (!$this->db->insert('profiles', $updatedarray))
				$return = false;
			else
				$return = $this->getlast_insert_id();
			return $return;
		} elseif ($condition == 1 && $where != null) {
			$return = true;
			if (!$this->db->update('profiles', $updatedarray, $where))
				$return = false;
			return $return;
		}
	}

	public function noofrecordsbyvendorid1($vendor_id)
	{
		$query = $this->db->query("SELECT unique_id, COUNT(*) FROM profiles WHERE vendor_id = ?");
		//return $query->num_rows();
		$query = $this->db->query($query, array($vendor_id));
		return $query->result_array();
	}

	public function noofrecordsbyvendorid($vendor_id)
	{
		$this->db->select('unique_id, COUNT(*) AS count');
		$this->db->from('profiles');
		$this->db->where('vendor_id', $vendor_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function remove_profile($id = null, $profile_status = null)
	{
		if ($id) {
			$profile_status = $profile_status ? 0 : 1;
			$updateData = array(
				'active' => $profile_status
			);
			$this->db->where('id', $id);
			$update = $this->db->update('profiles', $updateData);
			return ($update == true) ? true : false;
		}
		return false;
	}

	public function delete_profile($id)
	{
		$sql = "DELETE FROM profiles WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_edu($id)
	{
		$sql = "DELETE FROM profiles_edu WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_exp($id)
	{
		$sql = "DELETE FROM profiles_exp WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_pro($id)
	{
		$sql = "DELETE FROM profiles_pro WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function no_of_profiles()
	{
		$sql = "SELECT * FROM profiles  ORDER BY id DESC LIMIT 2;";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result[0]->id;
	}

	public function delete_profile_cert($id)
	{
		$sql = "DELETE FROM profiles_cert WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function delete_profile_skills($id)
	{
		$sql = "DELETE FROM profiles_skills WHERE profile_id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}

	public function get_profile_count($user_id)
	{
		$sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE vendor_id = ?";
		$query = $this->db->query($sql, $user_id);
		$result = $query->result();
		return $result[0]->profile_count;
	}

	public function get_profile_count_by_store_id($store_id)
	{
		$sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE vendor_id = (SELECT id FROM users WHERE store_id = ?)";
		$query = $this->db->query($sql, $store_id);
		$result = $query->result();
		return $result[0]->profile_count;
	}

	public function get_draft_profile_count_by_vendor_id($vendor_id)
	{
		$sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE vendor_id = ? AND active = 2";
		$query = $this->db->query($sql, $vendor_id);
		$result = $query->result();
		return $result[0]->profile_count;
	}

	public function getDraftProfileId($vendor_id)
	{
		$sql = "SELECT id as Id FROM profiles WHERE vendor_id = ? AND active = 2";
		$query = $this->db->query($sql, $vendor_id);
		$result = $query->result();
		return $result[0]->Id;
	}

	public function getIndustryReport()
	{
		$query = $this->db->query("SELECT profiles.first_name,profiles.last_name,profiles.approval,profiles_pro.profile_id,users.username,profiles_pro.industry,COUNT(*) AS `num` 
            FROM profiles_pro,profiles,users 
            WHERE profiles_pro.profile_id = profiles.id AND profiles.vendor_id = users.id AND profiles.active != 2 AND profiles.approval = 1
            GROUP BY industry 
            ORDER BY num DESC
        ");
		return $query->result_array();
	}



	public function getskillReport()
	{
		$query = $this->db->query("SELECT profiles.first_name,profiles.last_name,profiles.approval,profiles_skills.profile_id,users.username,profiles_skills.name,COUNT(*) AS `num` 
            FROM profiles_skills,profiles,users  
            WHERE profiles_skills.profile_id = profiles.id AND profiles.vendor_id = users.id AND profiles.active != 2 AND profiles.approval = 1
            GROUP BY name 
            ORDER BY num DESC
        ");
		return $query->result_array();
	}


public function getOrganisationReport()
	{
	    $query = $this->db->query("SELECT users.username,users.firstname, users.lastname, profiles_exp.company_name, COUNT(profiles.vendor_id) as `num`
	    FROM users
	    JOIN profiles ON users.id = profiles.vendor_id 
	    JOIN profiles_exp ON profiles.id = profiles_exp.profile_id 
	    WHERE profiles.active != 2 and profiles.approval = 1
	    GROUP BY company_name
            ORDER BY num DESC;"
	    );
	    return $query->result_array();
	}
	
	
	public function getProjectReport()
	{
	       $query = $this->db->query("SELECT profiles.unique_id, users.username,profiles.first_name, profiles.last_name, profiles_pro.title,profiles_pro.industry, profiles_pro.url, COUNT(*) AS num 
	       FROM profiles_pro 
	       INNER JOIN profiles ON profiles_pro.profile_id = profiles.id 
	       INNER JOIN users ON profiles.vendor_id = users.id 
	       WHERE profiles.active != 2 and profiles.approval = 1
	       GROUP BY profiles_pro.title, profiles.unique_id 
	       ORDER BY num DESC;");
           return $query->result_array();
	}

	

	public function getPrimaryTitleReport()
	{
		$query = $this->db->query("SELECT profiles.id,profiles.first_name,profiles.last_name,profiles.approval,profiles.primary_title,users.username,COUNT(*) AS `num` 
            FROM profiles,users
            WHERE users.id = profiles.vendor_id AND profiles.active != 2 AND profiles.approval = 1
            GROUP BY primary_title 
            ORDER BY num DESC
        ");
		return $query->result_array();
	}

	public function getProfileNameById($id)
	{
		$sql = "SELECT first_name,last_name FROM profiles WHERE id = ? LIMIT 1";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}

	public function getProfileVendorById($id)
	{
		$sql = "SELECT vendor_id FROM profiles WHERE id = ? LIMIT 1";
		$query = $this->db->query($sql, $id);
		return $query->result_array()[0]['vendor_id'];
	}

	public function getProfileViewsReport()
	{
		$query = $this->db->query("SELECT profiles.unique_id,profiles.first_name,profiles.last_name,profiles.primary_title,profiles.views,profiles.hire,profiles.pdf,profiles.share,users.username FROM profiles,users WHERE profiles.vendor_id = users.id && profiles.approval = 1 ORDER BY profiles.views DESC");
		return $query->result_array();
	}

	public function replaceSkills($mergeArr, $replace_string)
	{
		$sql = "UPDATE profiles_skills SET name = ? WHERE name IN ?";
		$query = $this->db->query($sql, array($replace_string, $mergeArr));
		return $query;
	}

	public function replaceIndustries($mergeArr, $replace_string)
	{
		$sql = "UPDATE profiles_pro SET industry = ? WHERE industry IN ?";
		$query = $this->db->query($sql, array($replace_string, $mergeArr));
		return $query;
	}

	public function replaceJobTitle($mergeArr, $replace_string)
	{
		$sql = "UPDATE profiles SET primary_title = ? WHERE primary_title IN ?";
		$query = $this->db->query($sql, array($replace_string, $mergeArr));
		return $query;
	}
	
	
	public function changeProfileStatus($id)
	{
		$sql = "UPDATE profiles SET active = 1  WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}
	
	public function changeProfileStatusToInactive($id)
	{
		$sql = "UPDATE profiles SET active = 0  WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
	}

	public function getallProfilesforVerification()
	{
		$sql = "SELECT profiles.*,users.username FROM profiles,users WHERE profiles.vendor_id = users.id AND approval = 1 ORDER BY profiles.id DESC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getallVerifiedProfiles()
	{
		$sql = "SELECT profiles.*,users.username FROM profiles,users WHERE profiles.vendor_id = users.id AND verified = 1 ORDER BY profiles.id DESC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function updateProfileVerificationStatus($id)
	{
		$sql = "UPDATE profiles SET verified = CASE WHEN verified = 1 THEN 0 WHEN verified = 0 THEN 1 END, verified_date = CASE WHEN verified = 1 THEN CURRENT_DATE() ELSE NULL END WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query;
	}
	
	public function getVendorInfobyProfileID($id)
	{
		$sql = "SELECT users.* FROM profiles,users WHERE profiles.id = ?  AND profiles.vendor_id = users.id";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}

	public function getallVerifiedProfilesbyVendorId($id)
	{
		$sql = "SELECT profiles.*,users.username FROM profiles,users WHERE profiles.vendor_id = ? AND profiles.vendor_id=users.id AND profiles.verified = 1 AND profiles.verified_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) ORDER BY profiles.id DESC ";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}

	public function updateCustomURL($url,$id)
	{
		$sql = "UPDATE profiles SET custom_url = ?  WHERE id = ? ";
		$query = $this->db->query($sql, array($url,$id));
		return $query;
	}
	
	public function getCustomURLbyId($id)
	{
		$sql = "SELECT custom_url FROM profiles WHERE id = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	
    	public function getCustomURLStatus($url) {
	        $sql = "SELECT COUNT(*) AS num_profiles FROM profiles WHERE verified = 1 AND verified_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND  custom_url = ?;";
	        $query = $this->db->query($sql, array($url));
	        $result = $query->row_array();
	        $count = $result['num_profiles'];
	        return $count > 0;
   	 }
    
	public function setCustomURLtoNull($url)
	{
		$sql = "UPDATE profiles SET custom_url = NULL WHERE custom_url=?";
		$query = $this->db->query($sql, $url);
		return $query;
	}
	

}
