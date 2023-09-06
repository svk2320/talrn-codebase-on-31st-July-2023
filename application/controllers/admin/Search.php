<?php

class Search extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Search';
	}

	public function index()
	{
		$this->data['keyword'] = $this->input->get("keyword");

		$this->data['find_whole'] = $this->input->get("find_whole");

		$this->load->model("model_stores");
		$store_data = $this->model_stores->getStoresData($_SESSION['store_id']);
        $company_name = $store_data['name'];
        $company_website = $store_data['website'];
        $company_email = $_SESSION['email'];
        $this->data['pdf_parameters'] = '?company_name='. $company_name .'&website='. $company_website.'&email='. $company_email;

		if (isset($this->data['keyword'])) {
			$this->load->model('model_search');
			$find_whole = $this->input->get('find_whole');
			$keyword_string = $this->input->get("keyword");
			$keywords_array = explode(",", $keyword_string);

			// Trim spaces from start and end of each keyword
			foreach ($keywords_array as &$keyword) {
				$keyword = trim($keyword);
			}

			//$this->data['search_result'] = $this->model_search->global_search($this->input->get("keyword"));
			$search_results = $this->model_search->global_search($keywords_array, $find_whole);
			foreach ($search_results as &$row) {
				$profile_string = $row['profile_data'];
				$found = '';
				$count = 0;
				$keyword_list = explode(",", $keyword_string);

				foreach ($keyword_list as &$keyword) {
					$keyword = trim($keyword);
				}

				foreach ($keyword_list as $key) {
					$key_count = substr_count(strtolower($profile_string), strtolower($key));
					$count = $count + $key_count;
					$found_in = array();

					// if($find_whole){
					// 	$pattern =  '/'.$keyword.'[;.?!,") ]/i';
					// }else{
					// 	$pattern =  '/'.$keyword.'/i';
					// }

					

					if (stripos($row['first_name'], $key) !== false) {
						array_push($found_in, 'first_name');
					}
					if (stripos($row['last_name'], $key) !== false) {
						array_push($found_in, 'last_name');
					}
					if (stripos($row['bio'], $key) !== false) {
						array_push($found_in, 'Bio');
					}
					if (stripos($row['unique_id'], $key) !== false) {
						array_push($found_in, 'Unique ID');
					}
					if (stripos($row['city'], $key) !== false) {
						array_push($found_in, 'city');
					}
					if (stripos($row['country'], $key) !== false) {
						array_push($found_in, 'country');
					}
					if (stripos($row['primary_title'], $key) !== false) {
						array_push($found_in, 'Primary job title');
					}
					if (stripos($row['soft_skill'], $key) !== false) {
						array_push($found_in, 'Soft Skills');
					}
					if (stripos($row['skills'], $key) !== false) {
						array_push($found_in, 'Skills');
					}
					if (stripos($row['project_details'], $key) !== false) {
						array_push($found_in, 'Project');
					}
					if (stripos($row['education'], $key) !== false) {
						array_push($found_in, 'Education');
					}
					if (stripos($row['active'], $key) !== false) {
						array_push($found_in, 'Education');
					}
					if (stripos($row['pph'], $key) !== false) {
						array_push($found_in, 'Education');
					}
					if (stripos($row['ppm'], $key) !== false) {
						array_push($found_in, 'Education');
					}
					if (stripos($row['currency'], $key) !== false) {
						array_push($found_in, 'Education');
					}
					if (stripos($row['approval'], $key) !== false) {
						array_push($found_in, 'Education');
					}
					if (stripos($row['employment'], $key) !== false) {
						array_push($found_in, 'Employment');
					}
					$found .= $key . "(" . $key_count . "): " . implode(', ', $found_in) . "<br>";
					
				}
				$row['found_in'] = $found;
				$row['count'] = $count;

				// calculate exact match and partial match
				$all_keywords_present = true;
				foreach ($keywords_array as $keyword) {
					if($find_whole){
						$pattern =  '/'.$keyword.'[;.?!,") ]/i';
					}else{
						$pattern =  '/'.$keyword.'/i';
					}

					if (!preg_match($pattern, $profile_string)) {
						$all_keywords_present = false;
						break;
					}
				}

				if ($all_keywords_present) {
					$row['match_case'] = 'exact';
				} else {
					$row['match_case'] = 'partial';
				}
				
			}

			$exact_results = array();
			$partial_results = array();

			foreach($search_results as $profile){
				if($profile['match_case'] ==  'exact'){
					array_push($exact_results,$profile);
				}else{
					array_push($partial_results,$profile);
				}
			}

			$this->data['search_result'] = $search_results;
			$this->data['exact_results'] = $exact_results;
			$this->data['partial_results'] = $partial_results;
			$this->render_template('admin/search/search.php', $this->data);
		}
		else{
		$partial_results = array();
		$this->data['partial_results'] = $partial_results;
		$this->render_template('admin/search/search.php', $this->data);
		}
	}

}
