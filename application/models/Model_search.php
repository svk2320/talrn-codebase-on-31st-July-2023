<?php

class Model_search extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* sql query to search in the whole database */
	public function global_search($keyword, $find_whole)
	{
		if ($keyword) {
			$sql = "SELECT * FROM
			(SELECT id,	unique_id, vendor_id, first_name, last_name, active, pph, ppm, currency, approval, city, country, profile_url,primary_title, bio, soft_skill, date, experience, skills, project_details, education, employment,
			CONCAT(unique_id , ' ',vendor_id,' ' ,first_name , ' ' , last_name , ' ' , active , ' ' , pph , ' ' , ppm , ' ' , currency , ' ' , approval , ' ' , city , ' ' , country , ' ' , primary_title , ' ' , bio , ' ' , soft_skill , ' ' , date , ' ' , experience , ' ' , skills , ' ' , project_details , ' ' , education , ' ' , employment) as profile_data
			FROM (
			SELECT profiles.id, profiles.vendor_id, profiles.unique_id, profiles.first_name, profiles.last_name,profiles.active,profiles.pph, profiles.ppm, profiles.currency, profiles.approval,profiles.city, profiles.country, profiles.primary_title, profiles.profile_url, profiles.bio, profiles.soft_skill, profiles.date, profiles.experience,
			GROUP_CONCAT(DISTINCT profiles_skills.name SEPARATOR ', ') AS skills,
			GROUP_CONCAT(DISTINCT CONCAT(profiles_pro.title, ' ',profiles_pro.technologies, ' ', profiles_pro.description, ' ', profiles_pro.responsibilities, ' ', profiles_pro.industry) SEPARATOR '; ') AS project_details,
			GROUP_CONCAT(DISTINCT CONCAT(profiles_edu.degree, ' ', profiles_edu.major, ' ', profiles_edu.univ) SEPARATOR '; ') AS education,
			GROUP_CONCAT(DISTINCT CONCAT(profiles_exp.title, ' ', profiles_exp.company_name, ' ', profiles_exp.location, ' ', profiles_exp.emp_type, ' ', profiles_exp.description) SEPARATOR '; ') AS employment
			FROM profiles
			INNER JOIN profiles_skills ON profiles.id = profiles_skills.profile_id
			INNER JOIN profiles_pro ON profiles.id = profiles_pro.profile_id
			INNER JOIN profiles_edu ON profiles.id = profiles_edu.profile_id
			INNER JOIN profiles_exp ON profiles.id = profiles_exp.profile_id
			GROUP BY profiles.id
			) AS merger
			) AS result
			WHERE ";
			$keyword_list = $keyword;
			if ($find_whole) {
				foreach ($keyword_list as $key) {
					$sql .= "profile_data REGEXP '" . $key . "[;.?!," . '"' . ") ]' OR ";
				}
			}else{
				foreach ($keyword_list as $key) {
					$sql .= "profile_data REGEXP '" . $key . "' OR ";
				}
			}
			$sql = substr($sql, 0, -3);

			$query = $this->db->query($sql, array($keyword));
			return $query->result_array();
		}
	}

	public function getPendingProfiles(){
		$sql = "SELECT profiles.*, users.username
		FROM profiles
		JOIN users ON users.id = profiles.vendor_id
		WHERE profiles.approval != 1 AND profiles.active != '2'
		ORDER BY profiles.approval ASC, profiles.id DESC;
		";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getApprovedProfiles(){
		$sql = "SELECT * FROM profiles WHERE approval = 1 ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}
