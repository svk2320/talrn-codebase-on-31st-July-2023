<?php

class Model_requirements extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}


    public function create_requirement($data = array())
    {
        if ($data) {
            // Insert the row without the jd_id value
            $create = $this->db->insert('requirements', $data);
            if ($create) {
                // Get the ID of the inserted row
                $id = $this->db->insert_id();

                // Generate the jd_id value
                $jd_id = 'TJD' . $id;

                // Generate the url value
                $job_title = $data['job_title'];
                $url_jd_id = strtolower($jd_id);
                $url_job_title = strtolower($job_title);
                $url = preg_replace('/-+/', '-', str_replace(' ', '-', $url_job_title)) . '-' . $url_jd_id;

                // Update the row with the generated jd_id and url values
                $this->db->where('id', $id);
                $this->db->update('requirements', array('jd_id' => $jd_id, 'url' => $url));

                // Return true to indicate successful creation
                return true;
            } else {
                // Return false to indicate failed creation
                return false;
            }
        } else {
            // Return false to indicate failed creation
            return false;
        }
    }

    public function create_requirement_client($unique_id,$data = array())
    {
        if ($data) {
            // Insert the row without the jd_id value
            $create = $this->db->insert('requirements', $data);
            if ($create) {
                // Get the ID of the inserted row
                $id = $this->db->insert_id();

                // Generate the jd_id value
                $jd_id = $unique_id .'J'. $id;

                // Generate the url value
                $job_title = $data['job_title'];
                $url_jd_id = strtolower($jd_id);
                $url_job_title = strtolower($job_title);
                $url = preg_replace('/-+/', '-', str_replace(' ', '-', $url_job_title)) . '-' . $url_jd_id;

                // Update the row with the generated jd_id and url values
                $this->db->where('id', $id);
                $this->db->update('requirements', array('jd_id' => $jd_id, 'url' => $url));

                // Return true to indicate successful creation
                return true;
            } else {
                // Return false to indicate failed creation
                return false;
            }
        } else {
            // Return false to indicate failed creation
            return false;
        }
    }

    public function getUniqueId($id)
    {
        if ($id) {
            $sql = "SELECT unique_id as unique_id FROM profiles WHERE vendor_id = ? AND approval = 1 LIMIT 1";
            $query = $this->db->query($sql, $id);
            $result = $query->row();
            
            if ($result) {
                return $result->unique_id;
            }
        }
        
        return null;
    }

    public function getAppliedJobs($vendor_id)
    {
        if ($vendor_id) {
            $sql = "
                    SELECT profiles.vendor_id, profiles.unique_id, profiles.first_name, profiles.last_name, job_profile_list.date, requirements.job_title, job_profile_list.jd_id
                    FROM profiles
                    INNER JOIN job_profile_list ON profiles.unique_id = job_profile_list.unique_id
                    INNER JOIN requirements ON job_profile_list.jd_id = requirements.jd_id
                    WHERE profiles.vendor_id = ?;
                    ";
            $query = $this->db->query($sql, $vendor_id);
            return $query->result_array();
        }
        return null;
    }

       public function getListOfUnapprovalProfiles($id,$jd_id)
    {
        if ($id) {

            $sql = "
                SELECT 
                    profiles.id,
                    profiles.unique_id,
                    profiles.first_name,
                    profiles.last_name,
                    profiles.vendor_id,
                    profiles.approval,
                    (
                        SELECT  GROUP_CONCAT(DISTINCT profiles_skills.name SEPARATOR ', ')
                        FROM profiles_skills 
                        WHERE profiles.id = profiles_skills.profile_id
                    ) AS skillsets,
                    CASE WHEN job_profile_list.jd_id IS NULL THEN FALSE ELSE TRUE END AS applied
                FROM profiles
                LEFT JOIN job_profile_list ON profiles.unique_id = job_profile_list.unique_id AND job_profile_list.jd_id = ?
                WHERE profiles.vendor_id = ? ORDER BY applied ASC;
            ";
            
            $query = $this->db->query($sql, array($jd_id, $id));

            // $sql = "SELECT id, unique_id, first_name, last_name  FROM profiles WHERE vendor_id = ? AND approval = 1";
            // $query = $this->db->query($sql, $id);
            return $query->result_array();
        }
        
        return null;
    }
    
    public function getListOfProfiles($id,$jd_id)
    {
        if ($id) {

            $sql = "
                SELECT profiles.unique_id,profiles.unique_id,profiles.first_name,profiles.last_name, 
                    CASE WHEN job_profile_list.jd_id IS NULL THEN FALSE ELSE TRUE END AS applied
                FROM profiles
                LEFT JOIN job_profile_list ON profiles.unique_id = job_profile_list.unique_id
                                        AND job_profile_list.jd_id = ?
                WHERE profiles.approval = 1 AND profiles.vendor_id = ? ORDER BY applied ASC;
            ";
            
            $query = $this->db->query($sql, array($jd_id, $id));

            // $sql = "SELECT id, unique_id, first_name, last_name  FROM profiles WHERE vendor_id = ? AND approval = 1";
            // $query = $this->db->query($sql, $id);
            return $query->result_array();
        }
        
        return null;
    }

    public function getrequirementbyjdId($jd_id){
	$sql = "SELECT * FROM requirements WHERE jd_id = ?";
	$query = $this->db->query($sql,array($jd_id));
	return $query->result_array();
    }

    public function addToJobProfileList($data = null)
    {
        if ($data) {
            $this->db->insert('job_profile_list', $data);
            return 'saved';
        }
        
        return null;
    }
    

    public function approveJob($id){
        $sql = "UPDATE requirements SET approval = 1  WHERE id = ?";
		$query = $this->db->query($sql, array($id));
		return $query;
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

   public function profileAlreadyInJob($unique_id,$jd_id){
        $query = $this->db->get_where('job_profile_list', array('unique_id' => $unique_id, 'jd_id' => $jd_id));
        $isPresent = $query->num_rows() > 0;
        return $isPresent;
    }


    public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('requirements');
		return ($delete == true) ? true : false;
	}

	public function updateUsers($id, $data)
	{
	   if ($id && $data) {
			$this->db->where('id', $id);
			$update = $this->db->update('requirements', $data);
			return ($update == true) ? true : false;
		}
	}

    public function getAllRequirements(){
		$sql = "SELECT r.*, (SELECT COUNT(*) FROM job_profile_list j WHERE j.jd_id = r.jd_id) AS total_count,(SELECT COUNT(*) FROM job_profile_list j WHERE j.jd_id = r.jd_id AND j.status = 'Pending Review') AS pending_count FROM requirements r WHERE type = 'admin';";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    public function getAllClientRequirements(){
		$sql = "SELECT r.*,
        c.unique_id,
        c.name,
        (SELECT COUNT(*) FROM job_profile_list j WHERE j.jd_id = r.jd_id) AS total_count,
        (SELECT COUNT(*) FROM job_profile_list j WHERE j.jd_id = r.jd_id AND j.status = 'Pending Review') AS pending_count
 FROM requirements r
 JOIN clients c ON r.client_id = c.id
 WHERE r.type = 'client';
 ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    public function getRequirementsByClientId($client_id){
		$sql = "SELECT r.*, (SELECT COUNT(*) FROM job_profile_list j WHERE j.jd_id = r.jd_id) AS total_count,(SELECT COUNT(*) FROM job_profile_list j WHERE j.jd_id = r.jd_id AND j.status = 'Pending Review') AS pending_count FROM requirements r WHERE client_id = ?;";
		$query = $this->db->query($sql,array($client_id));
		return $query->result_array();
	}

    public function getAllProfilesByJd_id($jd_id)
    {
	$sql = "
 		SELECT
		        profiles.id,
		        profiles.unique_id,
		        profiles.last_name,
		        profiles.first_name,
		        profiles.primary_title,
		        profiles.currency,
		        profiles.experience,
		        profiles.ppm_max,
		        profiles.ppm_min,
		        job_profile_list.date,
	        (
		    SELECT  GROUP_CONCAT(DISTINCT profiles_skills.name SEPARATOR ', ')
		    FROM profiles_skills 
		    WHERE profiles.id = profiles_skills.profile_id
		) AS skillsets,
	        job_profile_list.status
	    FROM
	        profiles
	    INNER JOIN
	        job_profile_list ON profiles.unique_id = job_profile_list.unique_id
	    WHERE
	        job_profile_list.jd_id = ?
	    ORDER BY
	        CASE job_profile_list.status
	            WHEN 'Pending Review' THEN 1
	            WHEN 'Reviewed' THEN 2
	            WHEN 'Shortlisted' THEN 3
	            WHEN 'Interview Scheduled' THEN 4
	            WHEN 'Rejected' THEN 5
	            WHEN 'Selected' THEN 6
	            ELSE 7 -- Place any other status at the end
	        END;
	    ";
		$query = $this->db->query($sql,array($jd_id));
		return $query->result_array();
	}

	// public function getLiveRequirements(){
	// 	$sql = "SELECT * FROM requirements WHERE status = 1 ";
	// 	$query = $this->db->query($sql);
	// 	return $query->result_array();
	// }

	public function getLiveRequirements($limit = NULL,$offset = 0){
		$this->db->where('status', 1);
        $this->db->where('approval', 1);
		if (!is_null($limit)) {
			$this->db->limit($limit, $offset);
		}
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('requirements');
		return $query->result_array();
	}
	
	public function getLiveRequirementsCount(){
		$this->db->where('status', 1);
        $this->db->where('approval', 1);
		return $this->db->count_all_results('requirements');
	}

    public function updateStatus($status, $id, $jd_id)
    {
	$sql = "UPDATE job_profile_list SET status = ? WHERE unique_id = ? AND jd_id = ?";
	$query = $this->db->query($sql,array($status, $id, $jd_id));
	return $query;
    }

	

    public function getrequirementbyid($id){
		$sql = "SELECT * FROM requirements WHERE id = ?";
		$query = $this->db->query($sql,array($id));
		return $query->result_array();
	}

    public function getrequirementbyjd_id($id){
		$sql = "SELECT * FROM requirements WHERE jd_id = ?";
		$query = $this->db->query($sql,array($id));
		return $query->result_array();
	}

	public function getrequirementbyurl($url){
		$sql = "SELECT * FROM requirements WHERE url = ?";
		$query = $this->db->query($sql,array($url));
		return $query->result_array();
	}

    public function insertOrUpdateUsers($updatedarray, $condition = 0, $where = null)
	{
		if ($condition == 0) {
			$return = true;
			if (!$this->db->insert('requirements', $updatedarray))
				$return = false;
			else
				$return = true;
			return $return;
		} elseif ($condition == 1 && $where != null) {
			$return = true;
			if (!$this->db->update('requirements', $updatedarray, $where))
				$return = false;
			return $return;
		}
	}

}
