<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_home');
    }

    public function index()
    {
        $data['meessage'] = 'index working';
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }


    public function profile($unique_id)
    {
        $this->load->model('model_home');
        $id = $this->model_home->getidbyuniqueid($unique_id)[0]['id'];
        $data['profile_info'] = $this->model_home->getprofilebyid($id)[0];
        $data['education'] = $this->model_home->profile_edu($id);
        $data['projects'] = $this->model_home->profile_pro($id);
        $data['skills'] = $this->model_home->profile_skills($id);
        $data['experience'] = $this->model_home->profile_exp($id);
        $data['certifications'] = $this->model_home->profile_cert($id);
        if ($data['certifications'][0]['name'] == '') {
            $data['certifications'] = null;
        }
        if ($data['experience'][0]['company_name'] == '') {
            $data['experience'] = null;
        }

        $this->output
            ->set_status_header(200)
            ->set_header('Access-Control-Allow-Origin: *')
            ->set_header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE')
            ->set_header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept')
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function profile_list()
    {
        $limit = $this->input->get('limit');
        if (!isset($limit)) {
            $limit = 20;
        } else {
            $limit = (int) $limit;
        }


        $profile_id_list = $this->model_home->getProfileID($limit);
        $profile_list = array();
        foreach ($profile_id_list as $profile_id) {
            $profile = $this->model_home->getprofilebyid($profile_id['profile_id']);
            if ($profile[0]['userPhoto'] == 'uploads/') {
                $userphoto = base_url('/assets/img/noimage.jpg');
            } else {
                $userphoto = $profile[0]['userPhoto'];
            }
            $profile_data = array(
                'unique_id' => $profile[0]['unique_id'],
                'id' => $profile[0]['id'],
                'first_name' => $profile[0]['first_name'],
                'last_name' => $profile[0]['last_name'],
                'profile_url' => $profile[0]['profile_url'],
                'city' => $profile[0]['city'],
                'bio' => $profile[0]['bio'],
                'experience' => $profile[0]['experience'],
                'country' => $profile[0]['country'],
                'country_code' => $profile[0]['country_code'],
                'primary_title' => $profile[0]['primary_title'],
                'userPhoto' => $userphoto,
            );


            $profile_industries = $this->model_home->getIndustriesByProfileId($profile_id['profile_id']);
            $industry_pro_list = array();
            foreach ($profile_industries as $industry) {
                if ($industry['industry'] == '') {
                    continue;
                }
                array_push($industry_pro_list, $industry['industry']);
            }
            $profile_data['profile_industries'] = $industry_pro_list;



            $skills = $this->model_home->profile_skills($profile_id['profile_id']);
            $skills_list = array();
            for ($j = 0; $j < sizeof($skills); $j++) {
                array_push($skills_list, $skills[$j]['name']);
            }
            $profile_data['skills'] = $skills_list;


            array_push($profile_list, $profile_data);
        }

        $this->output
            ->set_status_header(200)
            ->set_header('Access-Control-Allow-Origin: *')
            ->set_header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE')
            ->set_header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept')
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($profile_list, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
        exit;
    }

    public function profile2pdf($unique_id)
  {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $this->load->helper('url');
    

    $id = $this->model_home->getidbyuniqueid($unique_id)[0]['id'];
    $company_name = $this->input->get('company_name');
    $website = $this->input->get('website');
    $profile_url = $this->input->get('profile_url');

    $profiles = $this->model_home->getprofilebyid($id);
    $profile_edu = $this->model_home->profile_edu_pdf($id);
    $profile_exp = $this->model_home->profile_exp_pdf($id);
    $profile_pro = $this->model_home->profile_pro_pdf($id);
    $profile_cert = $this->model_home->profile_cert_pdf($id);
    $profile_skills = $this->model_home->profile_skills($id);
    $this->model_home->IncreasePdfcount($id);
    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'pdf',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);

    $fullname = $profiles[0]['last_name'] . ' ' . mb_substr($profiles[0]['first_name'], 0, 1);
    $primary_title = $profiles[0]['primary_title'];
    $bio = $profiles[0]['bio'];
    $city = $profiles[0]['city'];
    $country = $profiles[0]['country'];
    $experience = (int) $profiles[0]['experience'];
    $softskills = str_replace(",", ", ", $profiles[0]['soft_skill']);
    $uniqueID = $profiles[0]['unique_id'];
    //$profile_url = base_url('profile/' . strtolower($profiles[0]['profile_url']) . '/' . strtolower($profiles[0]['unique_id']));
    $profile_url_short = base_url('profile/' . strtolower($profiles[0]['unique_id']));
    $industry_array = array();
    for ($i = 0; $i < sizeof($profile_pro); $i++) {
      array_push($industry_array, $profile_pro[$i]['industry']);
    }
    $industries = array_unique($industry_array);
    $industries = array_values($industries);
    $industries = implode(", ", $industries);
    $options = array(
      'keep_table_together' => true,
      'keep_relative_together' => true,
      'keep_text_together' => true,
      'default_font' => 'poppins'
    );
    $mpdf = new \Mpdf\Mpdf($options);
    

    $footer = '<table style="width:100%">
    <tr>
        <td style="width:33%">' . $website . '</td>
        <td style="width:33%" align="center">' . $company_name . '</td>
        <td style="width:33%" style="text-align: right;" >' . $uniqueID . '</td>
    </tr>
</table>';
    $mpdf->SetHTMLFooter($footer);

    $html = '<table style="width:100%">
    <tr>
        <td style="width:40%">
            <h2 style="color:blue;">' . $fullname . '</h2>
        </td>
        <td style="width:60%;text-align:right">
            <h2>' . $company_name . '</h2>
        </td>
    </tr>    
</table>
<p style="margin:0">' . $primary_title;
if($experience > 0){
  $html  .= ', ' . $experience . '+ years experience ';
}
$html  .= '</p>
<p style="margin:0">' . $city . ', ' . $country . '</p>';
    $html .= '<p style="font-size:14px">' . $bio . '</p>
<p style="font-size:14px"><b>INDUSTRIES:</b> '.$industries.'</p>';
    if (sizeof($profile_skills) > 0) {
      $skill_list_html = '<pre style="font-size:14px"><b>TECHNICAL SKILLS </b>
  <hr style="color:black;margin:0"></pre><table width="100%" style="font-size:14px">';
      for ($j = 0; $j < sizeof($profile_skills); $j++) {
        $skill_list_html .= '<tr><td width="50%"><ul><li>' . $profile_skills[$j]['name'] . '</li></ul></td><td width="50%">';
        if ($profile_skills[$j]['year'] != 0) {
          $skill_list_html .= $profile_skills[$j]['year'] . ' years ';
        }
        if ($profile_skills[$j]['month'] != 0) {
          if ($profile_skills[$j]['year'] != 0) {
            $skill_list_html .= ' & ';
          }
          $skill_list_html .= $profile_skills[$j]['month'] . ' months';
        }
        $skill_list_html .= '</td></tr>';
      }
      $skill_list_html .= "</table>";
    }
    $html .= $skill_list_html;
    if ($softskills) {
      $softskills_html = "<pre style='font-size:14px'><b>SOFT SKILLS </b>
      <hr style='color:black;margin:0'></pre><p style='font-size:14px'>$softskills</p>";
      $html .= $softskills_html;
    }

    if (sizeof($profile_pro) > 0) {
      $project_html = "<pre style='font-size:14px'><b>PROJECT DETAILS </b>
      <hr style='color:black;margin:0'></pre>";
      for ($i = 0; $i < sizeof($profile_pro); $i++) {
        $project_html .= '<div style="page-break-inside: avoid;margin-bottom:5px" ><table style="width:100%">
    <tr>
        <td style="width:65%"><p style="font-size:14px"><span  style="font-size:14px"> • </span>' . $profile_pro[$i]['title'] . '</p></td>';
        if ($profile_pro[$i]['pro_start'] != "" && $profile_pro[$i]['pro_end'] != "") {
          $project_html .= '<td style="width:35%;text-align:right"><p>' . $profile_pro[$i]['pro_start'] . ' - ' . $profile_pro[$i]['pro_end'] . '</p></td>';
        } else {
          $project_html .= '<td style="width:30%"></td>';
        }
        $project_html .= '</tr>
    </table>';
        $project_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Project Description: </span> ' . $profile_pro[$i]['description'] . '</p>';
        $project_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Responsibilities: </span> ' . $profile_pro[$i]['responsibilities'] . '</p>';
        $project_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Technologies: </span> ' . $profile_pro[$i]['technologies'] . '</p>';

        if (!($profile_pro[$i]['url'] == "")) {
          $project_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Industry: </span> ' . $profile_pro[$i]['industry'] . '</p>';
          $project_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Link: </span> ' . $profile_pro[$i]['url'] . '</p>';
        } else {
          $project_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Industry: </span> ' . $profile_pro[$i]['industry'] . '</p>';
        }
        $project_html .= '</div>';
      }
      $html .= $project_html;
    }


    if (sizeof($profile_exp) > 0) {
      if (!$profile_exp[0]['title'] == "") {
        $employment_html = "<pre style='font-size:14px'><b>EMPLOYMENT HISTORY</b>
        <hr style='color:black;margin:0'></pre>";
        
          $employment_html .= '<div style="page-break-inside: avoid;margin-bottom:5px" ><table style="width:100%">
    <tr>
        <td style="width:65%"><p style="font-size:14px"><span style="font-size:14px"> • </span>' . $profile_exp[0]['title'] . '</p></td>';
          if ($profile_exp[0]['start'] != "" && $profile_exp[0]['end'] != "") {
            $employment_html .= '<td style="width:35%;text-align:right"><p>' . $profile_exp[0]['start'] . ' - ' . $profile_exp[0]['end'] . '</p></td>';
          } else {
            $employment_html .= '<td style="width:30%"></td>';
          }
          $employment_html .= '</tr>
    </table>';
          if (!($profile_exp[0]['description'] == "")) {
            $employment_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Description: </span> ' . $profile_exp[0]['description'] . '</p>';
          }
          $employment_html .= '</div>';
        
        
        for ($i = 1; $i < sizeof($profile_exp); $i++) {
          $employment_html .= '<div style="page-break-inside: avoid;margin-bottom:5px" ><table style="width:100%">
    <tr>
        <td style="width:65%"><p style="font-size:14px"><span style="font-size:14px"> • </span>' . $profile_exp[$i]['title'] . '</p></td>';
          if ($profile_exp[$i]['start'] != "" && $profile_exp[$i]['end'] != "") {
            $employment_html .= '<td style="width:35%;text-align:right"><p>' . $profile_exp[$i]['start'] . ' - ' . $profile_exp[$i]['end'] . '</p></td>';
          } else {
            $employment_html .= '<td style="width:30%"></td>';
          }
          $employment_html .= '</tr>
    </table>';
          if (!($profile_exp[$i]['company_name'] == "")) {
            $employment_html .= '<p style="margin:1px;font-size:14px">' . $profile_exp[$i]['company_name'] . '</p>';
          }
          if (!($profile_exp[$i]['description'] == "")) {
            $employment_html .= '<p style="margin:1px;font-size:14px"><span style="color:grey;">Description: </span> ' . $profile_exp[$i]['description'] . '</p>';
          }
          $employment_html .= '</div>';
        }
      }
      $html .= $employment_html;
    }

    if (sizeof($profile_cert) > 0 && $profile_cert[0]['name'] != '') {
      $cert_html = '<pre style="font-size:14px"><b>CERTIFICATION</b>
      <hr style="color:black;margin:0"></pre><table style="width:100%">';
      for ($i = 0; $i < sizeof($profile_cert); $i++) {
        $cert_html .= '<tr>';
        $cert_html .= '<td style="width:50%"><span  style="font-size:14px"> • </span>' . $profile_cert[$i]['name'] . ' by ' . $profile_cert[$i]['issuer'] . '</td>';
        $cert_html .= '<td style="width:20%;text-align:right">' . $profile_cert[$i]['year'] . "</td>";
        $cert_html .= '</tr>';
      }
      $cert_html .= '</table>';
      $html .= $cert_html;
    }

    if (sizeof($profile_edu) > 0) {
      $edu_html = '<pre style="font-size:14px"><b>EDUCATION</b>
      <hr style="color:black;margin:0"></pre><table style="width:100%">';
      for ($i = 0; $i < sizeof($profile_edu); $i++) {
        $edu_html .= '<tr>';
        $edu_html .= '<td style="width:80%"><span  style="font-size:14px"> • </span>' . $profile_edu[$i]['degree'] . " degree in " . $profile_edu[$i]['major'] . ' from ' . $profile_edu[$i]['univ'] . "</td>";
        $edu_html .= '<td style="width:20%;text-align:right">' . $profile_edu[$i]['edu_start'] . ' - ' . $profile_edu[$i]['edu_end'] . "</td>";
        $edu_html .= '</tr>';
      }
      $edu_html .= '</table>';
      $html .= $edu_html;
    }

    $html .= '
<pre style="font-size:14px"><b>LANGUAGES</b>
<hr style="color:black;margin:0"></pre>
<p><span style="font-size:14px"> • </span>  English - ' . $profiles[0]['english'] . '</p>
<p style="text-align:center;color:#bdbfbf;">END OF DOCUMENT<br>This PDF is automatically generated by ' . $company_name . ' on ' . date('d M Y') . 'Profile URL:<a href="' . $profile_url . '"
        style="color:#bdbfbf;">' . $profile_url . '</a></p>
';

    $mpdf->WriteHTML($html);
    $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . ' - ' . $company_name . '.pdf', 'D');
  }


    // public function profile2pdf($unique_id)
    // {
    //     require_once __DIR__ . '/../../vendor/autoload.php';
    //     $this->load->helper('url');
    //     $this->model_home->IncreasePdfcount($id);

    //     $id = $this->model_home->getidbyuniqueid($unique_id)[0]['id'];
    //     $company_name = $this->input->get('company_name');
    //     $website = $this->input->get('website');
    //     $profile_url = $this->input->get('profile_url');

    //     $profiles = $this->model_home->getprofilebyid($id);
    //     $profile_edu = $this->model_home->profile_edu($id);
    //     $profile_exp = $this->model_home->profile_exp($id);
    //     $profile_pro = $this->model_home->profile_pro($id);
    //     $profile_cert = $this->model_home->profile_cert($id);
    //     $profile_skills = $this->model_home->profile_skills($id);

    //     $action_logs = [
    //         "IP" => $this->input->ip_address(),
    //         "action" => 'pdf',
    //         "profile_id" => $profiles[0]['unique_id'],
    //     ];
    //     $this->model_home->create_action_log($action_logs);

    //     $fullname = $profiles[0]['last_name'] . ' ' . mb_substr($profiles[0]['first_name'], 0, 1);
    //     $primary_title = $profiles[0]['primary_title'];
    //     $bio = $profiles[0]['bio'];
    //     $experience = (int) $profiles[0]['experience'];
    //     $softskills = $profiles[0]['soft_skill'];
    //     $uniqueID = $profiles[0]['unique_id'];
    //     $mpdf = new \Mpdf\Mpdf([
    //         'default_font' => 'poppins'
    //     ]);

    //     $header = "<table><tr><td>$company_name</td><td></td></tr></table>";
    //     $mpdf->WriteHTML($header);
    //     $footer = "<table width='100%'><tr><td width='33%'>$website</td><td width='33%' align='center'></td>
    // <td width='33%' style='text-align: right;'>" . $uniqueID . "</td></tr></table>";
    //     $mpdf->SetHTMLFooter($footer);
    //     $name_html = "<h1>$fullname</h1><h2 style='margin:0'>" . $primary_title;
    //     if ($experience > 0) {
    //         $name_html .= " (" . $experience . " years)";
    //     }
    //     $name_html .= "</h2>";
    //     $mpdf->WriteHTML($name_html);
    //     if ($bio) {
    //         $mpdf->writeHTML("<hr style='margin:0' /><p>$bio</p><br>");
    //     }
    //     if (sizeof($profile_skills) > 0) {
    //         $skill_list_html = "<h4 style='margin:0' >Skills</h4><hr style='margin:0' /><table width='100%'>";
    //         for ($j = 0; $j < sizeof($profile_skills); $j++) {
    //             //$skill_list_html .= '<li>' . $profile_skills[$j]['name'] . '</li>';
    //             $skill_list_html .= '<tr><td width="50%"><ul><li>' . $profile_skills[$j]['name'] . '</li></ul></td><td width="50%">';
    //             if ($profile_skills[$j]['year'] != 0) {
    //                 $skill_list_html .= $profile_skills[$j]['year'] . ' years ';
    //             }
    //             if ($profile_skills[$j]['month'] != 0) {
    //                 $skill_list_html .= $profile_skills[$j]['month'] . ' months';
    //             }
    //             $skill_list_html .= '</td></tr>';
    //         }
    //         $skill_list_html .= "</table>";
    //         $skill_list_html .= "<br>";
    //         $mpdf->WriteHTML($skill_list_html);
    //     }
    //     if ($softskills) {
    //         $softskills_html = "<h4 style='margin:0'>Soft skills</h4><hr style='margin:0' /><br><p>$softskills</p>";
    //         $mpdf->WriteHTML($softskills_html);
    //     }
    //     if (sizeof($profile_pro) > 0) {
    //         $project_html = "<h4 style='margin:0'>Project details</h4><hr style='margin:0' /><br><ul>";
    //         for ($i = 0; $i < sizeof($profile_pro); $i++) {
    //             $project_html .= "<li><p style='margin:0'><b>" . $profile_pro[$i]['title'] . " </b> ";
    //             if ($profile_pro[$i]['pro_start'] != "" && $profile_pro[$i]['pro_end'] != "") {
    //                 $project_html .= "(" . $profile_pro[$i]['pro_start'] . ' - ' . $profile_pro[$i]['pro_end'] . ")";
    //             }
    //             $project_html .= "</p></br>";
    //             $project_html .= "<p style='margin:0'><b>Description </b> : " . $profile_pro[$i]['description'] . "</p>";
    //             $project_html .= "<p style='margin:0'><b>Roles & Responsibilities </b>: " . $profile_pro[$i]['responsibilities'] . "</p>";
    //             $project_html .= "<p style='margin:0'><b>Technologies </b>: " . $profile_pro[$i]['technologies'] . "</p>";

    //             if (!($profile_pro[$i]['url'] == "")) {
    //                 $project_html .= "<p style='margin:0'><b>Industry </b>: " . $profile_pro[$i]['industry'] . "</p>";
    //                 $project_html .= "<p style='margin-top:0'><b>link </b>:<a>" . $profile_pro[$i]['url'] . "</a></p>";
    //             } else {
    //                 $project_html .= "<p style='margin-top:0'><b>Industry </b>: " . $profile_pro[$i]['industry'] . "</p>";
    //             }
    //             $project_html .= "</li>";
    //         }
    //         $project_html .= '</ul>';
    //         $mpdf->WriteHTML($project_html);
    //     }
    //     if (sizeof($profile_exp) > 0) {
    //         if (!$profile_exp[0]['title'] == "") {
    //             $emp_html = "<h4 style='margin:0'>Employment</h4><hr style='margin:0' /><br><ul>";
    //             for ($i = 0; $i < sizeof($profile_exp); $i++) {
    //                 $emp_html .= "<li><p style='margin:0'><b>" . $profile_exp[$i]['title'] . " </b>(" . $profile_exp[$i]['start'] . " to " . $profile_exp[$i]['end'] . ")</p></br>";
    //                 if (!($profile_exp[$i]['description'] == "")) {
    //                     $emp_html .= "<p style='margin:0'>" . $profile_exp[$i]['company_name'] . "</p>";
    //                     $emp_html .= "<p style='margin-top:0'><b>Description </b> : " . $profile_exp[$i]['description'] . "</p>";
    //                 } else {
    //                     $emp_html .= "<p style='margin-top:0'>" . $profile_exp[$i]['company_name'] . "</p>";
    //                 }
    //                 $emp_html .= "</li>";
    //             }
    //             $emp_html .= '</ul>';
    //             $mpdf->WriteHTML($emp_html);
    //         }
    //     }
    //     if (sizeof($profile_edu) > 0) {
    //         $edu_html = "<h4 style='margin:0'>Education</h4><hr style='margin:0' /><br><ul>";
    //         for ($i = 0; $i < sizeof($profile_edu); $i++) {
    //             $edu_html .= "<li><p style='margin:0'><b> " . $profile_edu[$i]['degree'] . " degree </b>in <b>" . $profile_edu[$i]['major'] . "</b></p></br>";
    //             $edu_html .= "<p style='margin:0'>" . $profile_edu[$i]['univ'] . "</p>";
    //             $edu_html .= "<p style='margin-top:0'>" . $profile_edu[$i]['edu_start'] . ' to ' . $profile_edu[$i]['edu_end'] . "</p></li>";
    //         }
    //         $edu_html .= '</ul>';
    //         $mpdf->WriteHTML($edu_html);
    //     }
    //     if (sizeof($profile_cert) > 0 && $profile_cert[0]['name'] != '') {
    //         $cert_html = "<h4 style='margin:0'>Certifications</h4><hr style='margin:0' /><br><ul>";
    //         for ($i = 0; $i < sizeof($profile_cert); $i++) {
    //             $cert_html .= "<li><p style='margin:0'><b>" . $profile_cert[$i]['name'] . "</b></p></br>";
    //             $cert_html .= "<p style='margin-top:0'>" . $profile_cert[$i]['year'] . "</p></li>";
    //         }
    //         $cert_html .= '</ul>';
    //         $mpdf->WriteHTML($cert_html);
    //     }

    //     $end_footer_html = "<p style='text-align: center;color: gray;'>-End of Document-</p>
    // <p style='text-align: center;color: gray' >This PDF is automatically generated by talrn.com on: " . date('d M Y') . "</p>
    // <p style='text-align: center;color: gray' >Profile Url: " . $profile_url . "</p>";
    //     $mpdf->WriteHTML($end_footer_html);
    //     $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . ' - ' . $company_name . ' .pdf', 'D');
    // }
}
