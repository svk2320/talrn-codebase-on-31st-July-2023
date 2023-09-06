<?php

class Model_groups extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getGroupData($groupId = null)
  {
    if ($groupId) {
      $sql = "SELECT * FROM groups WHERE id = ?";
      $query = $this->db->query($sql, array($groupId));
      return $query->row_array();
    }

    $sql = "SELECT * FROM groups ORDER BY id DESC";
    $query = $this->db->query($sql, array(1));
    return $query->result_array();
  }

  public function noOfProjectsCount()
  {

    $sql = "SELECT COUNT(DISTINCT title) as projects_count FROM profiles_pro;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->projects_count; 
  }

 public function noOfCountries()
  {
    $sql = "SELECT COUNT(DISTINCT country) as countries_count from profiles;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->countries_count; 
  }

  public function noOfIndividual()
  {
    $sql = "SELECT COUNT(*) as individual_count FROM users WHERE registered_as = 2";
    $query = $this->db->query($sql);
    $result = $query->result();
    if($result[0]->individual_count == null){
      return 0;
    }
    return $result[0]->individual_count;
  }

  public function noOfOrganisation()
  {
    $sql = "SELECT COUNT(*) as organisation_count FROM users WHERE registered_as = 1";
    $query = $this->db->query($sql);
    $result = $query->result();
    if($result[0]->organisation_count == null){
      return 0;
    }
    return $result[0]->organisation_count;
  }

  public function noOfClients()
  {
    $sql = "SELECT COUNT(*) as client_count FROM clients";
    $query = $this->db->query($sql);
    $result = $query->result();
    if($result[0]->client_count == null){
      return 0;
    }
    return $result[0]->client_count;
  }

  public function create($data = '')
  {
    $create = $this->db->insert('groups', $data);
    return ($create == true) ? true : false;
  }

  public function edit($data, $id)
  {
    $this->db->where('id', $id);
    $update = $this->db->update('groups', $data);
    return ($update == true) ? true : false;
  }

  public function delete($id)
  {
    $this->db->where('id', $id);
    $delete = $this->db->delete('groups');
    return ($delete == true) ? true : false;
  }

  public function existInUserGroup($id)
  {
    $sql = "SELECT * FROM user_group WHERE group_id = ?";
    $query = $this->db->query($sql, array($id));
    //echo $this->db->last_query();
    return ($query->num_rows() == 1) ? true : false;
  }

  public function getUserGroupByUserId($user_id)
  {
    $sql = "SELECT * FROM user_group 
		INNER JOIN groups ON groups.id = user_group.group_id 
		WHERE user_group.user_id = ?";
    $query = $this->db->query($sql, array($user_id));
    $result = $query->row_array();

    return $result;

  }

  public function noOfProfiles()
  {

    $sql = "SELECT COUNT(*) as profile_count FROM profiles Where approval =1;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->profile_count;
  }
  

  public function noOfPending()
{
    $sql = "SELECT COUNT(*) as pending_count FROM profiles WHERE (active != 2 AND approval = 0) ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->pending_count;
}  
public function noOfPendingClientJobs()
{
    $sql = "SELECT COUNT(*) as pending_count FROM requirements WHERE (type = 'client' AND approval = 0) ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->pending_count;
} 

public function noOfApprovedClientJobs()
{
    $sql = "SELECT COUNT(*) as pending_count FROM requirements WHERE (type = 'client' AND approval = 1) ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->pending_count;
}


  public function noOfAwaiting()
{
    $sql = "SELECT COUNT(*) as awaiting_count FROM profiles WHERE approval = 2";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->awaiting_count;
} 

  public function s()
  {

    $sql = "SELECT COUNT(*) as profile_count FROM profiles";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->profile_count;
  }

  public function noOfProfileViews()
  {

    $sql = "SELECT SUM(views) as profile_view_count FROM profiles WHERE profiles.approval = 1";
    $query = $this->db->query($sql);
    $result = $query->result();
    if($result[0]->profile_view_count == null){
      return 0;
    }
    return $result[0]->profile_view_count;
  }
  
  
  public function noOfActiveProfileViews()
  {

    $sql = "SELECT SUM(views) as active_profile_view_count FROM profiles WHERE profiles.approval = 1 && profiles.active = 1";
    $query = $this->db->query($sql);
    $result = $query->result();
    if($result[0]->active_profile_view_count == null){
      return 0;
    }
    return $result[0]->active_profile_view_count;
  }
  
  
  public function noOfInActivefProfileViews()
  {

    $sql = "SELECT SUM(views) as inactive_profile_view_count FROM profiles  WHERE profiles.approval = 1 && profiles.active = 0 ";
    $query = $this->db->query($sql);
    $result = $query->result();
    if($result[0]->inactive_profile_view_count == null){
      return 0;
    }
    return $result[0]->inactive_profile_view_count;
  }

  public function noOfSkills()
  {

    $sql = "SELECT distinct COUNT(DISTINCT name) as skills_count FROM profiles_skills WHERE profile_id IN ( SELECT id FROM profiles WHERE approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->skills_count;
  }
  
  public function noOfActiveSkills()
  {

    $sql = "SELECT COUNT(DISTINCT name) AS active_skills_count FROM profiles_skills  WHERE profile_id IN ( SELECT id FROM profiles WHERE active = 1 AND approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->row();

    if (isset($result->active_skills_count)) {
        return $result->active_skills_count;
    }

    return 0;
    
  }
  
  public function noOfInActiveSkills()
  {

    $sql = "SELECT COUNT(DISTINCT name) AS inactive_skills_count FROM profiles_skills  WHERE profile_id IN ( SELECT id FROM profiles WHERE active = 0 AND approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->row();
    if (isset($result->inactive_skills_count)) {
        return $result->inactive_skills_count;
    }
    return 0; // No inactive skills found
    
  }

  public function noOfIndustries()
  {

    $sql = "SELECT COUNT(DISTINCT industry) as industry_count FROM profiles_pro WHERE profile_id IN ( SELECT id FROM profiles WHERE approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->industry_count;
  }
  
  public function noOfActiveIndustries()
  {

    $sql = "SELECT COUNT(DISTINCT industry) AS active_industry_count FROM profiles_pro  WHERE profile_id IN ( SELECT id FROM profiles WHERE active = 1 AND approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->row();
    if (isset($result->active_industry_count)) {
        return $result->active_industry_count;
    }
    return 0; // No active industries found
    
  }
  
  public function noOfInActiveIndustries()
  {

    $sql = "SELECT COUNT(DISTINCT industry) AS inactive_industry_count FROM profiles_pro  WHERE profile_id IN ( SELECT id FROM profiles WHERE active = 0 AND approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->row();
    if (isset($result->inactive_industry_count)) {
        return $result->inactive_industry_count;
    }
    return 0; // No inactive industries found
    
  }
  
  public function noOfProjects()
  {

    $sql = "SELECT COUNT(title) as projects_count FROM profiles_pro WHERE profile_id IN ( SELECT id FROM profiles WHERE approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->projects_count; 
  }
  
  public function noOfActiveProjects()
  {

    $sql = "SELECT COUNT(title) AS active_projects_count FROM profiles_pro  WHERE profile_id IN ( SELECT id FROM profiles WHERE active = 1 AND approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->row();
    if (isset($result->active_projects_count)) {
        return $result->active_projects_count;
    } else {
        return 0; // No active projects found
    }
  }
  
  public function noOfInActiveProjects()
  {

    $sql = "SELECT COUNT(title) AS inactive_projects_count FROM profiles_pro  WHERE profile_id IN ( SELECT id FROM profiles WHERE active = 0 AND approval = 1 );";
    $query = $this->db->query($sql);
    $result = $query->row();
    if (isset($result->inactive_projects_count)) {
        return $result->inactive_projects_count;
    } else {
        return 0; // No inactive projects found
    } 
  }
  public function noOfUsers()
  {

    $sql = "SELECT COUNT(*) as user_count FROM users";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->user_count;
  }

  public function noOfProfilesOrg()
  {

    $sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE vendor_id IN (SELECT id FROM users WHERE registered_as = 1)";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->profile_count;
  }
  public function noOfProfilesInd()
  {

    $sql = "SELECT COUNT(*) as profile_count FROM profiles WHERE vendor_id IN (SELECT id FROM users WHERE registered_as = 2)";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->profile_count;
  }

  public function noOfAgencies()
  {

    $sql = "SELECT COUNT(*) AS agency_count
            FROM profiles
            JOIN users ON profiles.vendor_id = users.id
            WHERE profiles.active != 2 AND approval =1 AND users.registered_as = 1;
            ";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->agency_count;
  }

  public function noOfFreelancers()
  {

    $sql = "SELECT COUNT(*) AS freelance_count
            FROM profiles
            JOIN users ON profiles.vendor_id = users.id
            WHERE profiles.active != 2 AND approval =1 AND users.registered_as = 2;"
            ;
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->freelance_count;
  }

  public function noOfActives()
  {

    $sql = "SELECT COUNT(*) as active_count FROM profiles WHERE active = 1 AND approval =1";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->active_count;
  }

  public function noOfActivesOrg()
  {

    $sql = "SELECT COUNT(*) AS active_org
            FROM profiles
            JOIN users ON profiles.vendor_id = users.id
            WHERE profiles.active = 1 AND approval =1 AND users.registered_as = 1;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->active_org;
  }

  public function noOfActivesInd()
  {

    $sql = "SELECT COUNT(*) AS active_ind
            FROM profiles
            JOIN users ON profiles.vendor_id = users.id
            WHERE profiles.active = 1 AND approval =1 AND users.registered_as = 2;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->active_ind;
  }

  public function noOfInactives()
  {

    $sql = "SELECT COUNT(*) as inactive_count FROM profiles WHERE active = 0 AND approval = 1";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->inactive_count;
  }

  public function noOfInactivesOrg()
  {

    $sql = "SELECT COUNT(*) AS inactive_org
            FROM profiles
            JOIN users ON profiles.vendor_id = users.id
            WHERE profiles.active = 0 AND approval =1 AND users.registered_as = 1;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->inactive_org;
  }

  public function noOfInactivesInd()
  {

    $sql = "SELECT COUNT(*) AS inactive_ind
            FROM profiles
            JOIN users ON profiles.vendor_id = users.id
            WHERE profiles.active = 0 AND approval =1 AND users.registered_as = 2;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->inactive_ind;
  }

  public function noOfUploadUsers()
  {
    $sql = "SELECT COUNT(*) as user_count FROM users WHERE id IN (SELECT distinct vendor_id FROM profiles)";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->user_count;
  }

  public function topTwoSkills()
  {
    $sql = "SELECT name,COUNT(*) as 'num' FROM profiles_skills WHERE profile_id in (SELECT id FROM profiles WHERE approval = 1) GROUP BY name ORDER BY num DESC LIMIT 2";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function topTwoIndustries()
  {
    $sql = "SELECT industry,COUNT(*) as 'num' FROM profiles_pro WHERE profile_id in (SELECT id FROM profiles WHERE approval = 1) GROUP BY industry ORDER BY num DESC LIMIT 2";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function vendorSignups()
  {
    $sql = "SELECT date,COUNT(*) AS 'signups' FROM stores GROUP BY date ORDER BY str_to_date(date,'%d/%m/%Y') DESC;";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function profilesUpload()
  {
    $sql = "SELECT date,COUNT(*) AS 'uploads' FROM profiles GROUP BY date ORDER BY date DESC;";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function ActiveUsers()
  {
    $sql = "SELECT 
        DATE(date) AS date,
        SUM(CASE WHEN first_visit = date THEN 1 ELSE 0 END) AS new_logged_users,
        SUM(CASE WHEN first_visit < date THEN 1 ELSE 0 END) AS returning_logged_users
      FROM 
        (SELECT 
           user_id,
           DATE(date) AS date,
           MIN(DATE(date)) OVER (PARTITION BY user_id ORDER BY DATE(date)) AS first_visit
         FROM (
           SELECT 
             user_id,
             DATE(date) AS date
           FROM 
             request_logs
           WHERE 
             status = 'logged'
           GROUP BY 
             user_id, 
             DATE(date)
         ) AS unique_logs
        ) AS visitor_data
      GROUP BY 
        DATE(date)
        ORDER BY
       DATE(date)
       DESC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function TotalVisitors()
  {
    $sql = "SELECT 
        DATE(date) AS date,
        SUM(CASE WHEN first_visit = date THEN 1 ELSE 0 END) AS new_visitors,
        SUM(CASE WHEN first_visit < date THEN 1 ELSE 0 END) AS returning_visitors
      FROM 
        (SELECT 
           IP,
           DATE(date) AS date,
           MIN(DATE(date)) OVER (PARTITION BY IP ORDER BY DATE(date)) AS first_visit
         FROM (
           SELECT 
             IP,
             DATE(date) AS date
           FROM 
             request_logs
           GROUP BY 
             IP, 
             DATE(date)
         ) AS unique_logs
        ) AS visitor_data
      GROUP BY 
        DATE(date)
       ORDER BY
       DATE(date)
       DESC";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function profilesActions()
  {
    $sql = "SELECT DATE(`date`) AS `day`, 
    COUNT(CASE WHEN `action` = 'view' THEN 1 END) AS `views`,
    COUNT(CASE WHEN `action` = 'hire' THEN 1 END) AS `hires`,
    COUNT(CASE WHEN `action` = 'share' THEN 1 END) AS `shares`,
    COUNT(CASE WHEN `action` = 'pdf' THEN 1 END) AS `pdfs`
FROM `actions_log`
GROUP BY `day`
ORDER BY `day` DESC;";
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function profilesUploadsLocation()
  {
    $sql = "SELECT country_code, COUNT(*) AS num_rows
    FROM profiles
    GROUP BY country_code;
    ";
    $query = $this->db->query($sql);
    return $query->result_array();
  }


  public function ProfileViewsByUser($id)
  {

    $sql = "SELECT COALESCE(SUM(views), 0) as 'num' FROM profiles WHERE vendor_id = ?;";
    $query = $this->db->query($sql, array($id));
    $result = $query->result();
    return $result[0]->num;
  }

  public function awaitingChangesCount($id)
  {
    $sql = "SELECT COUNT(*) as 'num' FROM profiles WHERE vendor_id = ? AND approval = 2;";
    $query = $this->db->query($sql, array($id));
    $result = $query->result();
    return $result[0]->num;
  }

  public function pendingApplicationCount()
  {
    $sql = "SELECT COUNT(*) as 'num' FROM job_profile_list WHERE status = 'Pending Review';";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->num;
  }

  public function jobApplicationCount()
  {
    $sql = "SELECT COUNT(*) as 'num' FROM job_profile_list;";
    $query = $this->db->query($sql);
    $result = $query->result();
    return $result[0]->num;
  }

  public function PdfsDownloadsByUser($id)
  {

    $sql = "SELECT COALESCE(SUM(pdf), 0) as 'num' FROM profiles WHERE vendor_id = ?;";
    $query = $this->db->query($sql, array($id));
    $result = $query->result();
    return $result[0]->num;
  }

  public function ProfileSharesByUser($id)
  {

    $sql = "SELECT COALESCE(SUM(share), 0) as 'num' FROM profiles WHERE vendor_id = ?;";
    $query = $this->db->query($sql, array($id));
    $result = $query->result();
    return $result[0]->num;
  }

  public function ProfileHiredByUser($id)
  {

    $sql = "SELECT COALESCE(SUM(hire), 0) as 'num' FROM profiles WHERE vendor_id = ?;";
    $query = $this->db->query($sql, array($id));
    $result = $query->result();
    return $result[0]->num;
  }
}
