<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autocomplete extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct(); 
        $this->load->model('model_home');
    }
    
    public function search()
    {
        $json = json_decode($this->security->xss_clean($this->input->raw_input_stream),true);
        $skill_list = $json['skills'];
        if(sizeof($skill_list) == 0){
            $fail = [];
            echo  json_encode($fail);
        }else{
            $industry_list = $json['industries'];
            $profile_id_list = $this->model_home->getProfilesBySkills($skill_list);
            
            $exact_list = array();
            $partial_list = array();
            foreach($profile_id_list as $profile_id){
                $skill_count = (int)$profile_id['num'];
                $profile = $this->model_home->getprofilebyid($profile_id['profile_id']);
                
                $exp = (int)$profile[0]['experience'];
                $bio = (strlen($profile[0]['bio']) > 160) ? substr($profile[0]['bio'],0,160).'...' : $profile[0]['bio'];
                $profile_data = array(
                  'id' => $profile[0]['id'],
                  'vendor_id'=>$profile[0]['vendor_id'],
                  'first_name' => $profile[0]['first_name'],
                  'last_name'=> $profile[0]['last_name'],
                  'profile_url'=> $profile[0]['profile_url'],
                  'verified'=> $profile[0]['verified'],
                  'verified_date'=> $profile[0]['verified_date'],
                  'city'=> $profile[0]['city'],
                  'unique_id'=> $profile[0]['unique_id'],
                  'bio' => $bio,
                  'experience' => $profile[0]['experience'],
                  'country'=> $profile[0]['country'],
                  'primary_title' => $profile[0]['primary_title'],
                  'userPhoto' => $profile[0]['userPhoto'],
                  'count' => $skill_count
                );
                
                
                if(!($json['experience'][0] <= $exp  &&  $json['experience'][1] >= $exp)){
                     continue;
                }
                
                if($profile[0]['active']!=1){
                     continue;
                }

                if($profile[0]['approval']!= 1){
                    continue;
                }
                
                $profile_industries = $this->model_home->getIndustriesByProfileId($profile_id['profile_id']);
                $industry_pro_list = array();
                foreach($profile_industries as $industry){
                    if($industry['industry'] == ''){
                        continue;
                    }
                    array_push($industry_pro_list,$industry['industry']);
                }
                if (!array_intersect($industry_pro_list, $industry_list) == $industry_list) {
                    // $array1 is a subset of $array2
                    continue;
                }
                $profile_data['profile_industries'] = $industry_pro_list;
                $skills = $this->model_home->profile_skills($profile_id['profile_id']);
                $skills_list = array();
                for ($j = 0; $j < sizeof($skills); $j++) {
                  array_push($skills_list,$skills[$j]['name']);
                }
                $profile_data['skills'] = $skills_list;
                if($skill_count >= sizeof($skill_list)){
                    array_push($exact_list,$profile_data);
                }
                else{
                    array_push($partial_list,$profile_data);
                }
            }
            $exact_list = array_slice($exact_list,0,20);
            $partial_list = array_slice($partial_list,0,20);
            $profile_list = array($exact_list, $partial_list);


            //search report
            $separator = ",";
            $report_skills = implode($separator, $skill_list);
            $report_industries = implode($separator, $industry_list);
            $report_experience = implode($separator, $json['experience']);
            $search_report = [
                "IP" => $this->input->ip_address(),
                "skills" => $report_skills,
                "experience" => $report_experience,
                "industries" => $report_industries,
                "exact_results" => sizeof($exact_list),
                "partial_results" => sizeof($partial_list)
            ];
            $result = $this->model_home->create_search_report($search_report);
            
            echo  json_encode($profile_list);
        }
    }
    
    
    public function index(){
        $result = $this->model_home->getDistinctIndustries();
        $industries = array("Aerospace and Defense",
        "Automotive",
        "Banking",
        "Capital Markets",
        "Chemicals",
        "Communications and Media",
        "Consumer Goods and Services",
        "Energy",
        "Ecommerce",
        "Healthcare",
        "High Tech",
        "Industrial",
        "Insurance",
        "Life Sciences",
        "Natural Resources",
        "Public Service",
        "Retail",
        "Software and Platforms",
        "Travel",
        "Utilities");
        foreach ($result as $industry => $value){
            if(!(in_array($value['industry'],$industries)) && $value['industry'] != '' ){
               array_push($industries, $value['industry']); 
            }
        }
        $query = '/' . $this->input->get('q') . '/';
        $result = array();
        for ($i = 0;$i < sizeof($industries);$i++){
            if (preg_match(strtolower($query), strtolower($industries[$i]))){
                array_push($result, $industries[$i]);
            }
        }
        if(sizeof($result) == 0){
            array_push($result, $this->input->get('q'));
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function industry_search()
    {
        $result = $this->model_home->getDistinctIndustries();
        $industries = array(
            "Aerospace and Defense",
            "Automotive",
            "Banking",
            "Capital Markets",
            "Chemicals",
            "Communications and Media",
            "Consumer Goods and Services",
            "Energy",
            "Ecommerce",
            "Healthcare",
            "High Tech",
            "Industrial",
            "Insurance",
            "Life Sciences",
            "Natural Resources",
            "Public Service",
            "Retail",
            "Software and Platforms",
            "Travel",
            "Utilities"
        );
        
        foreach ($result as $value) {
            if (!(in_array($value['industry'], $industries)) && $value['industry'] != '') {
                array_push($industries, $value['industry']);
            }
        }
        
        $query = strtolower($this->input->get('search')); // Modify to match the query parameter name
        
        $matchedResults = array_filter($industries, function ($industry) use ($query) {
            return preg_match('/^' . preg_quote($query, '/') . '/i', $industry);
        });
        
        // Convert all elements to lowercase for case-insensitive comparison
        $arrayLower = array_map('strtolower', $matchedResults);
        
        // Remove duplicates while preserving the original case
        $matchedResults = array_intersect_key($matchedResults, array_unique($arrayLower));
        
        if (empty($matchedResults)) {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        }
        
        $matchedResults = array_slice($matchedResults, 0, 7);
        sort($matchedResults); // Sort the array in ascending order
        
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($matchedResults, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    
    
    public function skill_search()
    {
        $result = $this->model_home->getDistinctSkills();
        $industries = array();
        
        foreach ($result as $value) {
            if (!(in_array($value['name'], $industries)) && $value['name'] != '') {
                array_push($industries, $value['name']);
            }
        }
        
        $query = strtolower($this->input->get('search')); // Modify to match the query parameter name
    
        $matchedResults = array_filter($industries, function ($industry) use ($query) {
            return preg_match('/^' . preg_quote($query, '/') . '/i', $industry);
        });
        
        // Convert all elements to lowercase for case-insensitive comparison
        $arrayLower = array_map('strtolower', $matchedResults);
        
        // Remove duplicates while preserving the original case
        $matchedResults = array_intersect_key($matchedResults, array_unique($arrayLower));
        
        if (empty($matchedResults)) {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        }
    
        $matchedResults = array_slice($matchedResults, 0, 7);
        sort($matchedResults); // Sort the array in ascending order
    
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($matchedResults, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    
    
    public function job_title_search()
    {
        $query = strtolower($this->input->get('search')); // Modify to match the query parameter name
    
        $result = $this->model_home->getDistinctJobTitles();
        $industries = array();
    
        foreach ($result as $value) {
            if (!(in_array($value['primary_title'], $industries)) && $value['primary_title'] != '') {
                array_push($industries, $value['primary_title']);
            }
        }
    
        $matchedResults = array_filter($industries, function ($industry) use ($query) {
            return preg_match('/^' . preg_quote($query, '/') . '/i', $industry);
        });
        
        // Convert all elements to lowercase for case-insensitive comparison
        $arrayLower = array_map('strtolower', $matchedResults);
        
        // Remove duplicates while preserving the original case
        $matchedResults = array_intersect_key($matchedResults, array_unique($arrayLower));
    
        if (empty($matchedResults)) {
            $this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
            exit;
        }
    
        $matchedResults = array_slice($matchedResults, 0, 7);
        sort($matchedResults); // Sort the array in ascending order
    
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($matchedResults, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function industry_distinct_search(){
        $result = $this->model_home->getDistinctIndustries();
        $industries = array();
        foreach ($result as $value){
            if(!(in_array($value['industry'],$industries)) && $value['industry'] != '' ){
               array_push($industries, $value['industry']); 
            }
        }
        $query = '/' . $this->input->get('q') . '/';
        $result = array();
        for ($i = 0;$i < sizeof($industries);$i++){
            if (preg_match(strtolower($query), strtolower($industries[$i]))){
                array_push($result, $industries[$i]);
            }
        }
        if(sizeof($result) == 0){
            array_push($result, $this->input->get('q'));
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function country_search(){
        $result = $this->model_home->getDistinctCountry();
        $industries = array();
        foreach ($result as $value){
            if(!(in_array($value['country'],$industries)) && $value['country'] != '' ){
               array_push($industries, $value['country']); 
            }
        }
        $query = '/' . $this->input->get('q') . '/';
        $result = array();
        for ($i = 0;$i < sizeof($industries);$i++){
            if (preg_match(strtolower($query), strtolower($industries[$i]))){
                array_push($result, $industries[$i]);
            }
        }
        if(sizeof($result) == 0){
            array_push($result, $this->input->get('q'));
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function skill_search_all(){
        $result = $this->model_home->getDistinctSkills();
        $industries = array();
        foreach ($result as $value){
            if(!(in_array($value['name'],$industries)) && $value['name'] != '' ){
               array_push($industries, $value['name']); 
            }
        }
        $query = '/' . $this->input->get('q') . '/';
        $result = array();
        for ($i = 0;$i < sizeof($industries);$i++){
            if (preg_match(strtolower($query), strtolower($industries[$i]))){
                array_push($result, $industries[$i]);
            }
        }
        if(sizeof($result) == 0){
            array_push($result, $this->input->get('q'));
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function job_title_search_all(){
        $result = $this->model_home->getDistinctJobTitles();
        $industries = array();
        foreach ($result as $value){
            if(!(in_array($value['primary_title'],$industries)) && $value['primary_title'] != '' ){
               array_push($industries, $value['primary_title']); 
            }
        }
        $query = strtolower($this->input->get('q'));
        $result = array();
        $count = 0;
        for ($i = 0; $i < sizeof($industries); $i++){
            if (preg_match('/' . $query . '/', strtolower($industries[$i]))){
                array_push($result, $industries[$i]);
                $count++;
            }
        }
        if(sizeof($result) == 0){
            array_push($result, $this->input->get('q'));
        }
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }
}
