<?php

class Model_home extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create_search_report($data = array())
	{
		if ($data) {
			$create = $this->db->insert('search_reports', $data);
			return ($create == true) ? true : false;
		}
	}

	public function DeleteSearchReportItems($skill)
	{
	    if($skill){
    	    $sql = "UPDATE search_reports SET show_searches = 0 WHERE skills = ?";
    	    $query = $this->db->query($sql, $skill);
    		return true;   
	    }
	    return false;
	}

	public function getProfileForLandingPage()
	{
		$sql = "SELECT id, unique_id, first_name, last_name, highlight_text, primary_title, userPhoto, highlight, profile_url FROM profiles WHERE highlight = 1";
		$query = $this->db->query($sql);
	        $result = $query->result_array();
	        return $result;
	}

	public function create_request_log($data = array())
	{
		if ($data) {
			$create = $this->db->insert('request_logs', $data);
			return ($create == true) ? true : false;
		}
	}

	public function create_action_log($data = array())
	{
		if ($data) {
			$create = $this->db->insert('actions_log', $data);
			return ($create == true) ? true : false;
		}
	}

	public function getSearchReport()
	{
		$query = $this->db->query("SELECT * from search_reports");
		return $query->result_array();
	}


	public function getLatestJobs($user_id=null){

		$sql = "SELECT * FROM requirements WHERE status = 1";
		$query = $this->db->query($sql, array($user_id,$user_id));
		return $query->result_array();
	}

	public function getLatestJobsbyClient($user_id=null){

		$sql = "SELECT * FROM requirements WHERE status = 1 and client_id = ?";
		$query = $this->db->query($sql, array($user_id));
		return $query->result_array();
	}

	public function getProfileSkills($user_id)
	{
	    $sql = 'SELECT name FROM profiles_skills WHERE profile_id = (SELECT id FROM profiles WHERE approval = 1 AND vendor_id = ? LIMIT 1)';
	    $query = $this->db->query($sql, $user_id);
		return $query->result_array();
	}
	
	   public function checkIndividualOrOrganization($id)
	    {
	        if ($id) {
	            $sql = "SELECT registered_as as typeOfUser FROM stores WHERE id = ?";
	            $query = $this->db->query($sql, array($id));
	            $result = $query->row();
	            
	            if ($result) {
	                return $result->typeOfUser;
	            }
	        }
	        
	        return null;
	    }
	    
	public function getOrgProfileSkillsets($id){
	 {
		        $sql = "
		                SELECT 
		                    profiles.id,
		                    profiles.unique_id,
		                    profiles.first_name,
		                    profiles.last_name,
		                    profiles.profile_url,
		                    profiles.approval,
		                    profiles.vendor_id,
		                    (
	                            SELECT  GROUP_CONCAT(DISTINCT profiles_skills.name SEPARATOR ', ')
	                            FROM profiles_skills 
	                            WHERE profiles.id = profiles_skills.profile_id
	                        ) AS skillsets
		                FROM profiles
		                WHERE profiles.approval = 1 AND profiles.vendor_id = ?
		                ";
		        $query = $this->db->query($sql, $id);
		        $result = $query->result_array();
		        return $result;
		    }
	    }

        public function getSearchReportDashboard()
	    {
	        $query = $this->db->query("SELECT sr.skills 
	            FROM search_reports sr
	            INNER JOIN (
	                SELECT skills, MAX(date_added) AS latest_date
	                FROM search_reports
	                GROUP BY skills
	            ) updated_sr ON sr.skills = updated_sr.skills AND sr.date_added = updated_sr.latest_date
	            WHERE sr.skills IS NOT NULL AND sr.skills != '' AND sr.show_searches = 1
	            ORDER BY updated_sr.latest_date DESC
	            LIMIT 50;");
	        return $query->result_array();
	    }
	    
	    public function getSearchReportDashboardForVendors()
	    {
	        $query = $this->db->query("SELECT sr.skills 
	            FROM search_reports sr
	            INNER JOIN (
	                SELECT skills, MAX(date_added) AS latest_date
	                FROM search_reports
	                GROUP BY skills
	            ) updated_sr ON sr.skills = updated_sr.skills AND sr.date_added = updated_sr.latest_date
	            WHERE sr.skills IS NOT NULL AND sr.skills != '' AND sr.show_searches = 1
	            ORDER BY updated_sr.latest_date DESC
	            LIMIT 10;");
	        return $query->result_array();
	    }
	
        public function hideSearchItems($skill)
	{
	    if($skill){
    	    $sql = "UPDATE search_reports SET show_searches = 0 WHERE skills = ?";
    	    $query = $this->db->query($sql, $skill);
    		return true;   
	    }
	    return false;
	}

	public function getTotalUniqueVisitors()
	{
		$query = $this->db->query("SELECT users.email,users.firstname,users.username,users.lastname,users.email,today_vistors.* FROM
		(SELECT requests.IP,date as datetime, DATE(date) as date, url, status, user_id,first_date
		FROM
		(SELECT IP, MAX(status) AS status,date,url,MAX(user_id) as user_id FROM request_logs WHERE DATE(date) = CURDATE() GROUP BY IP)as requests
		LEFT JOIN
		( SELECT IP,date as first_datetime,DATE(date) as first_date FROM request_logs GROUP BY IP) as first_date_index
		ON requests.IP = first_date_index.IP
		GROUP BY requests.IP ) as today_vistors
		LEFT JOIN users
		ON today_vistors.user_id = users.id");
		return $query->result_array();
	}

	public function getTotalUniqueVisitorsByDate($start_date,$end_date)
	{
		$sql = "SELECT users.email,users.firstname,users.username,users.lastname,users.email,today_vistors.* FROM
		(SELECT requests.IP,date as datetime, DATE(date) as date, url, status, user_id,first_date
		FROM
		(SELECT IP, MAX(status) AS status,date,url,MAX(user_id) as user_id FROM request_logs WHERE DATE(date) >= '".$start_date."' AND DATE(date) <= '".$end_date."' GROUP BY IP)as requests
		LEFT JOIN
		( SELECT IP,date as first_datetime,DATE(date) as first_date FROM request_logs GROUP BY IP) as first_date_index
		ON requests.IP = first_date_index.IP
		GROUP BY requests.IP ) as today_vistors
		LEFT JOIN users
		ON today_vistors.user_id = users.id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getAllProfiles($userId = null)
	{
		if ($userId) {
			$sql = "SELECT * FROM profiles WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}
		$sql = "SELECT * FROM profiles WHERE id != ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function listallprofiles_bk()
	{
		$sql = "SELECT * FROM profiles ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

   	public function getprofilesbyindustry($industry)
    {
        $sql = "SELECT profiles.id,profiles.first_name,profiles.unique_id,profiles.vendor_id,profiles.profile_url,profiles.experience, profiles.verified, profiles.last_login, profiles.verified_date ,profiles.last_name,profiles.city,profiles.country,profiles.primary_title,profiles.userPhoto,profiles.bio FROM profiles,profiles_pro WHERE profiles.id = profiles_pro.profile_id AND profiles.approval = 1 AND profiles_pro.industry = ? AND profiles.active=1 GROUP BY profiles.id ORDER BY profiles.verified DESC LIMIT 5";
        $query = $this->db->query($sql, $industry);
        $result = $query->result_array();
        $result_length = sizeof($result);
        
        if ($result_length < 5) {
            $sql = "SELECT id,first_name,last_name,city,country,unique_id,vendor_id,profile_url,experience,verified,verified_date,bio,primary_title,userPhoto,last_login FROM profiles WHERE active = 1 AND approval = 1 AND id NOT IN (SELECT profiles.id FROM profiles,profiles_pro WHERE profiles.id = profiles_pro.profile_id AND profiles.approval = 1 AND profiles.active = 1 AND profiles_pro.industry = ?) ORDER BY profiles.verified DESC, id DESC LIMIT ?";
            $query = $this->db->query($sql, array($industry, 10 - $result_length));
            $result = array_merge($result, $query->result_array());
        }
        
        usort($result, function($a, $b) {
            if ($a['verified'] === "1" && $b['verified'] !== "1") {
                return -1; // "a" comes before "b"
            } elseif ($a['verified'] !== "1" && $b['verified'] === "1") {
                return 1; // "b" comes before "a"
            } else {
                // If both have the same "verified" value, sort by "last_login" descending
                $dateA = strtotime($a['last_login']);
                $dateB = strtotime($b['last_login']);
        
                // Compare the timestamps to determine the order
                if ($dateA === $dateB) {
                    return 0;
                }
                return ($dateA > $dateB) ? -1 : 1;
            }
        });


        
        $result = array_slice($result, 0, 5);
        return $result;
    }
    
	public function listallprofiles($limit, $start = null)
	{
		$data = array();
		$num_rows = 0;
		$query = $this->db->query("select * from profiles");
		$this->db->select('*');
		$this->db->from('profiles');
		$this->db->where('active', 1);
		$this->db->where('approval', 1);
		$this->db->order_by("verified", "DESC");
		$this->db->order_by("last_login", "DESC");
		$this->db->order_by("id", "DESC");
		$this->db->order_by("last_login", "DESC");
		// if($keyword!=='nokeyword') {
		// 	$this->db->like('skills', rawurldecode($keyword), 'both'); 
		// 	$this->db->or_like('last_name', rawurldecode($keyword), 'both');
		// }
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

	public function listallprofiles_nov25($limit, $start = null)
	{
		$data = array();
		$num_rows = 0;
		$keyword = null;
		$query = $this->db->query("select * from profiles");
		$this->db->select('*');
		$this->db->from('profiles');
		if ($keyword !== 'nokeyword') {
			$this->db->like('skills', rawurldecode($keyword), 'both');
			$this->db->or_like('last_name', rawurldecode($keyword), 'both');
		}
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

	public function getprofilesbyids($userId)
	{
		// $mysqlquery = "SELECT * from admin_user where role_id = (select role_id from role where name = 'Admin') and username = ? and password = ? and user_status = ?";
		// $results = $this->db->query($mysqlquery,array($username,$this->encrypt($password,$encryptionkey),"active"));
		// return $results->result();
		$id = (int) $userId;
		$mysqlquery = "SELECT p.*, edu.*, expp.* FROM profiles p join profiles_exp expp on p.id = expp.profile_id join profiles_edu edu on p.id = edu.profile_id WHERE p.id = " . $id;
		//echo $mysqlquery; exit;
		$query = $this->db->query($mysqlquery, array($id));
		echo "Rows: " . $query->num_rows() . "<br>";
		print_r($query->result_array());
		exit;
		return $query->result_array();
	}

	public function getProfileID($limit)
	{
		$sql = "SELECT id as profile_id FROM profiles WHERE approval = 1 ORDER BY id DESC LIMIT ?";
		$query = $this->db->query($sql, array($limit));
		// $query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getprofilebyid($id)
    {
        $this->db->cache_delete('profiles', $id); // Clear cache for the specific profile ID
        
        $sql = "SELECT * FROM profiles WHERE id = ? ORDER BY id DESC";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();
    }
	

	public function getidbyuniqueid($id)
	{
		$sql = "SELECT id FROM profiles where unique_id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function profile_edu($id)
	{
		$sql = "SELECT * FROM profiles_edu where profile_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function profile_edu_pdf($id)
	{
		$sql = "SELECT * FROM profiles_edu where profile_id = ? ORDER BY edu_end DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function profile_exp($id)
	{
		$sql = "SELECT * FROM profiles_exp where profile_id = ? ORDER BY IF(end = '', 1, 0) DESC, STR_TO_DATE(CONCAT('01-', end), '%d-%M-%Y') DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function profile_exp_pdf($id)
	{
		$sql = "SELECT * FROM profiles_exp where profile_id = ? ORDER BY IF(end = '', 1, 0) DESC, STR_TO_DATE(CONCAT('01-', end), '%d-%M-%Y') DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function profile_pro($id)
	{
		$sql = "SELECT * FROM profiles_pro where profile_id = ? ORDER BY id ASC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function profile_pro_pdf($id)
	{
		$sql = "SELECT * FROM profiles_pro where profile_id = ? ORDER BY IF(pro_end IS NULL, 1, 0), pro_end DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function profile_cert($id)
	{
		$sql = "SELECT * FROM profiles_cert where profile_id = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}
	
	public function profile_cert_pdf($id)
	{
		$sql = "SELECT * FROM profiles_cert where profile_id = ? ORDER BY year DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

	public function profile_skills($id)
	{
		$sql = "SELECT * FROM profiles_skills where profile_id = ? ORDER BY year DESC";
		$query = $this->db->query($sql, array($id));
		return $query->result_array();
	}

    public function getDistinctIndustries()
	{
		$sql = "SELECT industry FROM profiles_pro WHERE profile_id in (SELECT id FROM profiles WHERE approval = 1) GROUP BY industry";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getSkillNameBySkill($skill)
	{
		$sql = "SELECT name FROM profiles_skills WHERE name = ? LIMIT 1";
		$query = $this->db->query($sql, array($skill));
		$result = $query->result();
        return $result[0]->name;
	}

	public function getProfilesBySkill($skill)
	{
		$sql = "SELECT * FROM profiles WHERE id IN (SELECT DISTINCT profile_id FROM profiles_skills WHERE name = ?) AND active = 1 AND approval = 1 ORDER BY verified DESC, last_login DESC, id DESC LIMIT 20";
		$query = $this->db->query($sql, array($skill));
		return $query->result_array();
	}
	
	public function getDistinctSkills()
	{
		$sql = "SELECT name FROM profiles_skills WHERE profile_id in (SELECT id FROM profiles WHERE approval = 1) GROUP BY name";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	public function getDistinctJobTitles()
	{
		$sql = "SELECT primary_title FROM profiles WHERE approval = 1 GROUP BY primary_title";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDistinctCountry()
	{
		$sql = "SELECT country FROM profiles GROUP BY country";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function getprofilesbyid($id)
	{
		// SELECT * FROM `product` WHERE `created_at` >= DATE(NOW()-INTERVAL 15 DAY)
		//$this->db->where('DATE_ADD(attempt_date,INTERVAL 30 MINUTE) >','NOW()', FALSE);
		$id = (int) $id;
		$data = array();
		$this->db->select('p.*, edu.*, expp.*');
		$this->db->from('profiles p');
		$this->db->join('profiles_exp expp', 'expp.profile_id = p.id');
		$this->db->join('profiles_edu edu', 'edu.profile_id = p.id');
		$this->db->order_by('p.id', 'DESC');
		$this->db->where('p.id', $id);
		$this->db->distinct();
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$data[] = $row;
			}
		}
		// var_dump($data); exit();
		return $data;
	}

	public function getProfilesBySkills($skill_list)
	{
	    //SELECT id,first_name,last_name,city,unique_id,bio,experience,country,primary_title,userPhoto
		$sql = "SELECT profiles.verified, profiles.verified_date, profiles.last_login, profiles_skills.profile_id, COUNT(*) AS num FROM profiles JOIN profiles_skills ON profiles_skills.profile_id = profiles.id WHERE profiles_skills.name IN ? GROUP BY  profiles_skills.profile_id ORDER BY num DESC, profiles.verified DESC, profiles.last_login DESC";
		$query = $this->db->query($sql, array($skill_list));
		return $query->result_array();
	}
	
	public function getIndustriesByProfileId($id)
	{
	    //SELECT id,first_name,last_name,city,unique_id,bio,experience,country,primary_title,userPhoto
		$sql = "SELECT industry FROM profiles_pro WHERE profile_id = ? GROUP BY industry";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	
	public function IncreaseProfileViewcount($id)
	{
		$sql = "UPDATE profiles SET views = views + 1 WHERE id = ?";
		$query = $this->db->query($sql, $id);
	}
	
	public function IncreasePdfcount($id)
	{
		$sql = "UPDATE profiles SET pdf = pdf + 1 WHERE id = ?";
		$query = $this->db->query($sql, $id);
	}
	
	public function Increasehirecount($id)
	{
		$sql = "UPDATE profiles SET hire = hire + 1 WHERE id = ?";
		$query = $this->db->query($sql, $id);
	}

	public function increaseShareCount($id)
	{
		$sql = "UPDATE profiles SET share = share + 1 WHERE id = ?";
		$query = $this->db->query($sql, $id);
	}

	public function get_profile_count_by_vendor_id($store_id){
	        $sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE vendor_id = ?";
	        $query = $this->db->query($sql, $store_id);
	        $result = $query->result();
	        return $result[0]->profile_count;
        }

	public function getidbycustomurl($custom_url)
	{
		$sql = "SELECT id FROM profiles WHERE verified = 1 AND verified_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND  custom_url = ?";
		$query = $this->db->query($sql, array($custom_url));
		return $query->result_array();
	}
}
