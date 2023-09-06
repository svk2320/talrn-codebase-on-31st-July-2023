<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends Frontend_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('model_users');
    $this->load->model('model_home');
    $this->load->model('model_stores');
    $this->lang->load("title", "english");
  }

  public function index()
  {
    $data['title'] = $this->lang->line("home_title");
    $data['description'] = $this->lang->line("description_title");
    $data['og'] = $this->lang->line("home_title");
    $data['og_image'] = $this->lang->line("og_image");
    $this->load->model('Model_groups');
    $data['profiles_count'] = $this->Model_groups->noOfActives();
    $data['projects_count'] = $this->Model_groups->noOfProjectsCount();
    $data['countries_count'] = $this->Model_groups->noOfCountries();
    $data['landing_page_profiles'] = $this->model_home->getProfileForLandingPage();
    $data['skills_count'] = $this->Model_groups->noOfSkills();
    $data['industries_count'] = $this->Model_groups->noOfIndustries();
    $skills_name_list = $this->Model_groups->topTwoSkills();
    // if (sizeof($skills_name_list) > 3) {
    if (sizeof($skills_name_list) > 1) {
      $data['skills_name'] = $skills_name_list[0]['name'] . ", " . $skills_name_list[1]['name'];
    } else {
      $data['skills_name'] = '';
    }
    $industry_name_list = $this->Model_groups->topTwoIndustries();
    // if (sizeof($industry_name_list) > 0) {
    if (sizeof($industry_name_list) > 1) {
      //   $data['industries_name'] = $industry_name_list[1]['industry'] . ", " . $industry_name_list[2]['industry'];
      $data['industries_name'] = $industry_name_list[0]['industry'] . ", " . $industry_name_list[1]['industry'];
    } else {
      $data['industries_name'] = '';
    }
    
    if (count($this->model_home->getProfileForLandingPage()) < 5){
        $data['body_view'] = 'home2';
    } else {
        $data['body_view'] = 'home';
    }
    
    $this->load->view('template/layout_manager', $data);
  }


  function maskEmail($email, $minLength = 3, $maxLength = 10, $mask = "***")
  {
    $atPos = strrpos($email, "@");
    $name = substr($email, 0, $atPos);
    $len = strlen($name);
    $domain = substr($email, $atPos);

    if (($len / 2) < $maxLength)
      $maxLength = ($len / 2);

    $shortenedEmail = (($len > $minLength) ? substr($name, 0, $maxLength) : "");
    return "{$shortenedEmail}{$mask}{$domain}";
  }


  public function orgregsiter()
  {

    $data['title'] = $this->lang->line("business_title");
    $data['description'] = $this->lang->line("description_title");
    $data['og'] = $this->lang->line("business_title");

    $this->form_validation->set_rules('org_first_name', 'First name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('org_last_name', 'Last name', 'trim|required|xss_clean');
    $this->form_validation->set_rules('org_name', 'Organization name', 'trim|required|is_unique[users.username]|xss_clean');
    $this->form_validation->set_rules('org_email', 'Work email', 'trim|required|is_unique[users.email]|callback_validate_email_domain|xss_clean');
    $this->form_validation->set_rules('org_tel', 'Phone', 'trim|required|is_unique[users.phone]|xss_clean');
    $this->form_validation->set_rules('org_website', 'Website', 'trim|required|is_unique[stores.website]|xss_clean');
    $this->form_validation->set_rules('org_accept_terms', 'Accept terms &amp; conditions', 'callback_org_accept_terms');


    if ($this->form_validation->run() == FALSE) {
      $data['message'] = null;
      $data['body_view'] = 'orgregsiter';
      $this->load->view('template/layout_manager', $data);
    } else {
      // print_r($this->input->post()); exit;

      $createorg = $this->model_users->createorg($this->input->post('org_name'), $this->input->post('org_website'));

      $passwd = $this->password_hash($this->generateRandomString());

      $inputdata = array(
        'username' => $this->input->post('org_name'),
        'password' => $passwd,
        'email' => $this->input->post('org_email'),
        'firstname' => $this->input->post('org_first_name'),
        'lastname' => $this->input->post('org_last_name'),
        'phone' => $this->input->post('org_tel'),
        'gender' => '1',
        'store_id' => $createorg,
      );

      $create = $this->model_users->create($inputdata, '11');


      $from = 'testemail@candmglobal.com';
      $to = $this->input->post('org_email');

      $subject = 'Testing subject';
      $message = '<p>Your login details, email: ' . $to . ' and password: ' . $this->input->post('org_name') . '</p>';
      $message .= '<p>URL: ' . base_url('/admin') . '</p>';

      $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.candmglobal.com',
        'smtp_port' => 25,
        'smtp_user' => 'testemail@candmglobal.com',
        'smtp_pass' => SMTP_PASS,
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => 'TRUE'
      );

      $this->email->initialize($config);
      $this->email->from($from);
      $this->email->to($to);
      $this->email->cc('no-reply@talrn.com');
      $this->email->subject($subject);
      $this->email->message($message);

      if ($this->email->send()) {
        $data['message'] = 'We will send instructions to your email address ' . $this->maskEmail($to);
      } else {
        $data['message'] = 'Something went wrong!...';
      }

      $this->form_validation->resetpostdata();

      $data['body_view'] = 'orgregsiter';
      $this->load->view('template/layout_manager', $data);

    }
  }

  function generateRandomString($length = 17)
  {
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
  }

  function org_accept_terms()
  {
    if (isset($_POST['org_accept_terms']))
      return true;
    $this->form_validation->set_message('org_accept_terms', 'Please read and accept our terms and conditions.');
    return false;
  }

  function validate_email_domain()
  {
    if ($_POST['org_email']) {
      $email = isset($_POST['org_email']) ? trim($_POST['org_email']) : null;
      $domains = array('abc.com', 'xyz.com', 'gmail.com', 'hotmail.com', 'yahoo.com', 'yahoo.in', 'aol.com');
      $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";
      if (!preg_match($pattern, $email)) {
        $emailArray = explode("@", $email);
        if (checkdnsrr(array_pop($emailArray), "MX")) {
          return true;
        } else {
          $this->form_validation->set_message('validate_email_domain', 'Please enter work email address');
          return false;
        }
      } else {
        $this->form_validation->set_message('validate_email_domain', 'Please enter work email address');
        return false;
      }
    }
  }


  public function profiless($id = null)
  {
    $data['profiles'] = $this->model_home->getAllProfiles($id);
    if ($id) {
      $data['body_view'] = 'profiledetails';
    } else {
      $data['body_view'] = 'profiles';
    }
    $this->load->view('template/layout_manager', $data);
  }

  public function orgregsiter2()
  {
    print_r($this->input->post());
  }

  function send()
  {
    $this->load->config('email');
    $from = $this->config->item('smtp_user');
    $to = $this->input->post('sureshkutti@gmail.com');
    $subject = 'some subject';
    $message = 'some message';

    $this->email->set_newline("\r\n");
    $this->email->from($from);
    $this->email->to($to);
    $this->email->cc('burnwed@gmail.com');
    $this->email->subject($subject);
    $this->email->message($message);

    if ($this->email->send()) {
      echo 'Your Email has successfully been sent.';
    } else {
      show_error($this->email->print_debugger());
    }
  }

  public function addhirecount($id)
  {
    $this->model_home->Increasehirecount($id);

    $profiles = $this->model_home->getprofilebyid($id);
    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'hire',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);
  }

  public function addsharecount($id)
  {
    $this->model_home->increaseShareCount($id);

    $profiles = $this->model_home->getprofilebyid($id);
    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'share',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);
  }

  public function oldprofile2pdf($id)
  {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $this->load->helper('url');
    $this->model_home->IncreasePdfcount($id);

    $profiles = $this->model_home->getprofilebyid($id);
    $profile_edu = $this->model_home->profile_edu($id);
    $profile_exp = $this->model_home->profile_exp($id);
    $profile_pro = $this->model_home->profile_pro($id);
    $profile_cert = $this->model_home->profile_cert($id);
    $profile_skills = $this->model_home->profile_skills($id);

    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'pdf',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);

    $fullname = $profiles[0]['last_name'] . ' ' . mb_substr($profiles[0]['first_name'], 0, 1);
    $primary_title = $profiles[0]['primary_title'];
    $bio = $profiles[0]['bio'];
    $experience = (int) $profiles[0]['experience'];
    $softskills = $profiles[0]['soft_skill'];
    $uniqueID = $profiles[0]['unique_id'];
    $mpdf = new \Mpdf\Mpdf([
      'default_font' => 'poppins'
    ]);

    $header = "<table><tr><td><img src='assets/img/newlogo.png' style='width:20%'></td><td></td></tr></table>";

    $mpdf->WriteHTML($header);
    $footer = "<table width='100%'><tr><td width='33%'>www.talrn.com</td><td width='33%' align='center'>hr@talrn.com</td>
    <td width='33%' style='text-align: right;'>" . $uniqueID . "</td></tr></table>";
    $mpdf->SetHTMLFooter($footer);
    $name_html = "<h1>$fullname</h1><h2 style='margin:0'>" . $primary_title;
    if ($experience > 0) {
      $name_html .= " (" . $experience . " years)";
    }
    $name_html .= "</h2>";
    $mpdf->WriteHTML($name_html);
    if ($bio) {
      $mpdf->writeHTML("<hr style='margin:0' /><p>$bio</p><br>");
    }
    if (sizeof($profile_skills) > 0) {
      $skill_list_html = "<h4 style='margin:0' >Skills</h4><hr style='margin:0' /><table width='100%'>";
      for ($j = 0; $j < sizeof($profile_skills); $j++) {
        //$skill_list_html .= '<li>' . $profile_skills[$j]['name'] . '</li>';
        $skill_list_html .= '<tr><td width="50%"><ul><li>' . $profile_skills[$j]['name'] . '</li></ul></td><td width="50%">';
        if ($profile_skills[$j]['year'] != 0) {
          $skill_list_html .= $profile_skills[$j]['year'] . ' years ';
        }
        if ($profile_skills[$j]['month'] != 0) {
          $skill_list_html .= $profile_skills[$j]['month'] . ' months';
        }
        $skill_list_html .= '</td></tr>';
      }
      $skill_list_html .= "</table>";
      $skill_list_html .= "<br>";
      $mpdf->WriteHTML($skill_list_html);
    }
    if ($softskills) {
      $softskills_html = "<h4 style='margin:0'>Soft skills</h4><hr style='margin:0' /><br><p>$softskills</p>";
      $mpdf->WriteHTML($softskills_html);
    }
    if (sizeof($profile_pro) > 0) {
      $project_html = "<h4 style='margin:0'>Project details</h4><hr style='margin:0' /><br><ul>";
      for ($i = 0; $i < sizeof($profile_pro); $i++) {
        $project_html .= "<li><p style='margin:0'><b>" . $profile_pro[$i]['title'] . " </b> ";
        if ($profile_pro[$i]['pro_start'] != "" && $profile_pro[$i]['pro_end'] != "") {
          $project_html .= "(" . $profile_pro[$i]['pro_start'] . ' - ' . $profile_pro[$i]['pro_end'] . ")";
        }
        $project_html .= "</p></br>";
        $project_html .= "<p style='margin:0'><b>Description </b> : " . $profile_pro[$i]['description'] . "</p>";
        $project_html .= "<p style='margin:0'><b>Roles & Responsibilities </b>: " . $profile_pro[$i]['responsibilities'] . "</p>";
        $project_html .= "<p style='margin:0'><b>Technologies </b>: " . $profile_pro[$i]['technologies'] . "</p>";

        if (!($profile_pro[$i]['url'] == "")) {
          $project_html .= "<p style='margin:0'><b>Industry </b>: " . $profile_pro[$i]['industry'] . "</p>";
          $project_html .= "<p style='margin-top:0'><b>link </b>:<a>" . $profile_pro[$i]['url'] . "</a></p>";
        } else {
          $project_html .= "<p style='margin-top:0'><b>Industry </b>: " . $profile_pro[$i]['industry'] . "</p>";
        }
        $project_html .= "</li>";
      }
      $project_html .= '</ul>';
      $mpdf->WriteHTML($project_html);
    }
    if (sizeof($profile_exp) > 0) {
      if (!$profile_exp[0]['title'] == "") {
        $emp_html = "<h4 style='margin:0'>Employment</h4><hr style='margin:0' /><br><ul>";
        for ($i = 0; $i < sizeof($profile_exp); $i++) {
          $emp_html .= "<li><p style='margin:0'><b>" . $profile_exp[$i]['title'] . " </b>(" . $profile_exp[$i]['start'] . " to " . $profile_exp[$i]['end'] . ")</p></br>";
          if (!($profile_exp[$i]['description'] == "")) {
            $emp_html .= "<p style='margin:0'>" . $profile_exp[$i]['company_name'] . "</p>";
            $emp_html .= "<p style='margin-top:0'><b>Description </b> : " . $profile_exp[$i]['description'] . "</p>";
          } else {
            $emp_html .= "<p style='margin-top:0'>" . $profile_exp[$i]['company_name'] . "</p>";
          }
          $emp_html .= "</li>";
        }
        $emp_html .= '</ul>';
        $mpdf->WriteHTML($emp_html);
      }
    }
    if (sizeof($profile_edu) > 0) {
      $edu_html = "<h4 style='margin:0'>Education</h4><hr style='margin:0' /><br><ul>";
      for ($i = 0; $i < sizeof($profile_edu); $i++) {
        $edu_html .= "<li><p style='margin:0'><b> " . $profile_edu[$i]['degree'] . " degree </b>in <b>" . $profile_edu[$i]['major'] . "</b></p></br>";
        $edu_html .= "<p style='margin:0'>" . $profile_edu[$i]['univ'] . "</p>";
        $edu_html .= "<p style='margin-top:0'>" . $profile_edu[$i]['edu_start'] . ' to ' . $profile_edu[$i]['edu_end'] . "</p></li>";
      }
      $edu_html .= '</ul>';
      $mpdf->WriteHTML($edu_html);
    }
    if (sizeof($profile_cert) > 0 && $profile_cert[0]['name'] != '') {
      $cert_html = "<h4 style='margin:0'>Certifications</h4><hr style='margin:0' /><br><ul>";
      for ($i = 0; $i < sizeof($profile_cert); $i++) {
        $cert_html .= "<li><p style='margin:0'><b>" . $profile_cert[$i]['name'] . "</b></p></br>";
        $cert_html .= "<p style='margin-top:0'>" . $profile_cert[$i]['year'] . "</p></li>";
      }
      $cert_html .= '</ul>';
      $mpdf->WriteHTML($cert_html);
    }
    $profile_url = base_url('profile/' . strtolower($profiles[0]['profile_url']) . '/' . strtolower($profiles[0]['unique_id']));
    $end_footer_html = "<p style='text-align: center;color: gray;'>-End of Document-</p>
    <p style='text-align: center;color: gray' >This PDF is automatically generated by talrn.com on: " . date('d M Y') . "</p>
    <p style='text-align: center;color: gray' >Profile Url: " . $profile_url . "</p>";
    $mpdf->WriteHTML($end_footer_html);
    $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . ' - Talrn.pdf', 'D');
  }

  public function profile2pdf($id)
  {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $this->load->helper('url');
    $this->model_home->IncreasePdfcount($id);

    $profiles = $this->model_home->getprofilebyid($id);
    $profile_edu = $this->model_home->profile_edu_pdf($id);
    $profile_exp = $this->model_home->profile_exp_pdf($id);
    $profile_pro = $this->model_home->profile_pro_pdf($id);
    $profile_cert = $this->model_home->profile_cert_pdf($id);
    $profile_skills = $this->model_home->profile_skills($id);

    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'pdf',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);

    $fullname = $profiles[0]['last_name'] . ' ' . mb_substr($profiles[0]['first_name'], 0, 1);
    $verified = $profiles[0]['verified'];
    $verified_date = $profiles[0]['verified_date'];
    $primary_title = $profiles[0]['primary_title'];
    $bio = $profiles[0]['bio'];
    $city = $profiles[0]['city'];
    $country = $profiles[0]['country'];
    $experience = (int) $profiles[0]['experience'];
    $softskills = str_replace(",", ", ", $profiles[0]['soft_skill']);
    $uniqueID = $profiles[0]['unique_id'];
    $profile_url = base_url('profile/' . strtolower($profiles[0]['profile_url']) . '/' . strtolower($profiles[0]['unique_id']));
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
    
    
    if (!($verified_date === null)) {
        // adding verified icon
        $daysDifference = (new DateTime())->diff(new DateTime($verified_date))->format('%a');
    
        $imageSrc = ($verified && ($daysDifference <= 30)) ? 'assets/img/verified-icon.png' : '';
        $imageStyle = ($verified && ($daysDifference <= 30)) ? 'position: relative; width: 90px; margin-left: 25px;' : '';
        $verificationImg = ($verified && ($daysDifference <= 30)) ? '<img src="' . $imageSrc . '" style="' . $imageStyle . '">' : ' ';
    } else {
        $verificationImg = '';
    }


    $footer = '<table style="width:100%">
    <tr>
        <td style="width:33%">+91 982 004 5154</td>
        <td style="width:33%" align="center">Talrn- Labor Omnia Vincit</td>
        <td style="width:33%" style="text-align: right;" >hr@talrn.com</td>
    </tr>
</table>';
    $mpdf->SetHTMLFooter($footer);

    $html = '<table style="width: 100%;border-collapse: collapse;">
    <tr>
        <td style="width:40%">
            <h1 style="color:blue;font-size:100px;">' . $fullname . '</h1>'
            . $verificationImg .
            '<p style="font-size:70px;">'. $primary_title;
    if($experience > 0){
      $html  .= ', ' . $experience . '+ years experience ';
    }
    $html  .= '</p>
            <p style="font-size:70px;">' . $city . ', ' . $country . ' </p>
            <p style="font-size:70px;"><a href="' . $profile_url . '"
                style="color:black;">' . $profile_url . '</a></p>
        </td>
        <td style="width:20%"></td>
        <td style="width:40%;text-align:right">
            <img src="assets/img/newlogo.png">
            <p style="font-size:40px;">+91 9820045154 | hr@talrn.com </p>
        </td>
    </tr>
</table>
<p style="font-size:14px">' . $bio . '</p>
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
        $project_html .= '<div style="page-break-inside: avoid;margin-bottom:5px" >
        <table style="width:100%;border:1px">
    <tr>
        <td style="width:65%"><p style="font-size:14px"><span style="font-size:14px"> • </span>' . $profile_pro[$i]['title'] . '</p></td>';
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
        $cert_html .= '<td style="width:50%"><span style="font-size:14px"> • </span> ' . $profile_cert[$i]['name'] . ' by ' . $profile_cert[$i]['issuer'] . '</td>';
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
        $edu_html .= '<td style="width:80%"><span style="font-size:14px"> • </span> ' . $profile_edu[$i]['degree'] . " degree in " . $profile_edu[$i]['major'] . ' from ' . $profile_edu[$i]['univ'] . "</td>";
        $edu_html .= '<td style="width:20%;text-align:right">' . $profile_edu[$i]['edu_start'] . ' - ' . $profile_edu[$i]['edu_end'] . "</td>";
        $edu_html .= '</tr>';
      }
      $edu_html .= '</table>';
      $html .= $edu_html;
    }

    $html .= '
<pre style="font-size:14px"><b>LANGUAGES</b>
<hr style="color:black;margin:0"></pre>
<p><span style="font-size:14px"> • </span>English - ' . $profiles[0]['english'] . '</p>
<pre>
    </pre>';if($profiles[0]['verified']){
$html.='<p style="text-align:center;color:#808080;">'.$profiles[0]['last_name'] .'\'s identity has been verified to provide a trusted & reliable experience.<br>Talrn guarantees a seamless collaboration experience for you.</p>
<pre>
    </pre>';}
    
$html.='<p style="text-align:center;color:#bdbfbf;">END OF DOCUMENT<br>This PDF is automatically generated by Talrn on ' . date('d M Y') . ' <br>
Profile URL:<a href="' . $profile_url . '"
        style="color:#bdbfbf;">' . $profile_url . '</a></p>
';

    //echo $html;
    $mpdf->WriteHTML($html);
    //$mpdf->Output();
    $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . ' - Talrn.pdf', 'D');
  }
  
    public function profile2pdfVerified($id)
      {
        require_once __DIR__ . '/../../vendor/autoload.php';
        $this->load->helper('url');
    
    
        $profiles = $this->model_home->getprofilebyid($id);
        $profile_edu = $this->model_home->profile_edu_pdf($id);
        $profile_exp = $this->model_home->profile_exp_pdf($id);
        $profile_pro = $this->model_home->profile_pro_pdf($id);
        $profile_cert = $this->model_home->profile_cert_pdf($id);
        $profile_skills = $this->model_home->profile_skills($id);
        
        $vendor = $this->model_stores->getVendorInfobyProfileID($id);
    
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
        $profile_url = base_url('profile/' . strtolower($profiles[0]['profile_url']) . '/' . strtolower($profiles[0]['unique_id']));
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
            <td style="width:33%">'.$vendor[0]['phone'].'</td>
        
            <td style="width:33%" style="text-align: right;" >'.$vendor[0]['email'].'</td>
        </tr>
    </table>';
        $mpdf->SetHTMLFooter($footer);
    
        $html = '<table style="width: 100%;border-collapse: collapse;">
        <tr>
            <td style="width:40%">
                <h1 style="color:blue;font-size:40px;">' . $fullname . '</h1>
                <p style="font-size:15px;">' . $primary_title;
        if($experience > 0){
          $html  .= ', ' . $experience . '+ years experience ';
        }
        $html  .= '</p>
                <p style="font-size:15px;">' . $city . ', ' . $country . ' </p>
            </td>
            <td style="width:10%"></td>
            <td style="width:40%;text-align:right">
                <p style="font-size:15px;">'.$vendor[0]['phone'].' </p>
                <p style="font-size:15px;">'.$vendor[0]['email'].' </p>
            </td>
        </tr>
    </table>
    <p style="font-size:14px">' . $bio . '</p>
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
            $project_html .= '<div style="page-break-inside: avoid;margin-bottom:5px" >
            <table style="width:100%;border:1px">
        <tr>
            <td style="width:65%"><p style="font-size:14px"><span style="font-size:14px"> • </span>' . $profile_pro[$i]['title'] . '</p></td>';
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
            $cert_html .= '<td style="width:50%"><span style="font-size:14px"> • </span> ' . $profile_cert[$i]['name'] . ' by ' . $profile_cert[$i]['issuer'] . '</td>';
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
            $edu_html .= '<td style="width:80%"><span style="font-size:14px"> • </span> ' . $profile_edu[$i]['degree'] . " degree in " . $profile_edu[$i]['major'] . ' from ' . $profile_edu[$i]['univ'] . "</td>";
            $edu_html .= '<td style="width:20%;text-align:right">' . $profile_edu[$i]['edu_start'] . ' - ' . $profile_edu[$i]['edu_end'] . "</td>";
            $edu_html .= '</tr>';
          }
          $edu_html .= '</table>';
          $html .= $edu_html;
        }
    
        $html .= '
    <pre style="font-size:14px"><b>LANGUAGES</b>
    <hr style="color:black;margin:0"></pre>
    <p><span style="font-size:14px"> • </span>English - ' . $profiles[0]['english'] . '</p>
    <pre>
        </pre>';
    
    $html.='<p style="text-align:center;color:#bdbfbf;">END OF DOCUMENT<br>This PDF is automatically generated on ' . date('d M Y') .'</p>';
    
        //echo $html;
        $mpdf->WriteHTML($html);
        //$mpdf->Output();
        $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . '.pdf', 'D');
      }

  public function profile2pdfpartner($id)
  {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $this->load->helper('url');
    $this->model_home->IncreasePdfcount($id);

    $company_name = $this->input->get('company_name');
    $website = $this->input->get('website');
    $email = $this->input->get('email');
    $phone = $this->input->get('phone');

    $profiles = $this->model_home->getprofilebyid($id);
    $profile_edu = $this->model_home->profile_edu_pdf($id);
    $profile_exp = $this->model_home->profile_exp_pdf($id);
    $profile_pro = $this->model_home->profile_pro_pdf($id);
    $profile_cert = $this->model_home->profile_cert_pdf($id);
    $profile_skills = $this->model_home->profile_skills($id);

    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'pdf',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);

    $fullname = $profiles[0]['last_name'] . ' ' . mb_substr($profiles[0]['first_name'], 0, 1);
    $verified = $profiles[0]['verified'];
    $verified_date = $profiles[0]['verified_date'];
    $primary_title = $profiles[0]['primary_title'];
    $bio = $profiles[0]['bio'];
    $city = $profiles[0]['city'];
    $country = $profiles[0]['country'];
    $experience = (int) $profiles[0]['experience'];
    $softskills = str_replace(",", ", ", $profiles[0]['soft_skill']);
    $uniqueID = $profiles[0]['unique_id'];
    $profile_url = base_url('profile/' . strtolower($profiles[0]['profile_url']) . '/' . strtolower($profiles[0]['unique_id']));
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
    
    if (!($verified_date === null)) {
        // adding verified icon
        $daysDifference = (new DateTime())->diff(new DateTime($verified_date))->format('%a');
    
        $imageSrc = ($verified && ($daysDifference <= 30)) ? base_url('assets/img/verified-icon.png') : '';
        $imageStyle = ($verified && ($daysDifference <= 30)) ? 'position: relative; width: 90px; margin-left: 25px;' : '';
        $verificationImg = ($verified && ($daysDifference <= 30)) ? '<img src="' . $imageSrc . '" style="' . $imageStyle . '">' : ' ';
    } else {
        $verificationImg = '';
    }

    $footer = '<table style="width:100%">
    <tr>
        <td style="width:33%">' . $phone . '</td>
        <td style="width:33%" align="center">' . $website . '</td>
        <td style="width:33%" style="text-align: right;" >' . $email . '</td>
    </tr>
</table>';
    $mpdf->SetHTMLFooter($footer);

    $html = '<table style="width:100%">
    <tr>
        <td style="width:40%">
            <h2 style="color:blue;">' . $fullname . '</h2>'
            . $verificationImg .
        '</td>
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
<pre>
    </pre>';if($profiles[0]['verified']){
$html.='<p style="text-align:center;color:#808080;">'.$profiles[0]['last_name'] .'\'s identity has been verified to provide a trusted & reliable experience.<br>Talrn guarantees a seamless collaboration experience for you.</p>
<pre>
    </pre>';}
$html.='<p style="text-align:center;color:#bdbfbf;">END OF DOCUMENT<br>This PDF is automatically generated by ' . $company_name . ' on ' . date('d M Y') . '</p>
';

    $mpdf->WriteHTML($html);
    $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . ' - ' . $company_name . '.pdf', 'D');
  }

  public function oldprofile2pdfpartner($id)
  {
    require_once __DIR__ . '/../../vendor/autoload.php';
    $this->load->helper('url');
    $this->model_home->IncreasePdfcount($id);

    $company_name = $this->input->get('company_name');
    $website = $this->input->get('website');
    $email = $this->input->get('email');

    $profiles = $this->model_home->getprofilebyid($id);
    $profile_edu = $this->model_home->profile_edu($id);
    $profile_exp = $this->model_home->profile_exp($id);
    $profile_pro = $this->model_home->profile_pro($id);
    $profile_cert = $this->model_home->profile_cert($id);
    $profile_skills = $this->model_home->profile_skills($id);

    $action_logs = [
      "IP" => $this->input->ip_address(),
      "action" => 'pdf',
      "profile_id" => $profiles[0]['unique_id'],
    ];
    $this->model_home->create_action_log($action_logs);

    $fullname = $profiles[0]['last_name'] . ' ' . mb_substr($profiles[0]['first_name'], 0, 1);
    $verified = $profiles[0]['verified'];
    $verified_date = $profiles[0]['verified_date'];
    $primary_title = $profiles[0]['primary_title'];
    $bio = $profiles[0]['bio'];
    $experience = (int) $profiles[0]['experience'];
    $softskills = $profiles[0]['soft_skill'];
    $uniqueID = $profiles[0]['unique_id'];
    $mpdf = new \Mpdf\Mpdf([
      'default_font' => 'poppins'
    ]);

    $header = "<table><tr><td><p style='font-size: 2rem'>$company_name</p></td><td></td></tr></table>";
    $mpdf->WriteHTML($header);
    $footer = "<table width='100%'><tr><td width='33%'>$website</td><td width='33%' align='center'>" . $email . "</td>
    <td width='33%' style='text-align: right;'>" . $uniqueID . "</td></tr></table>";
    $mpdf->SetHTMLFooter($footer);
    $name_html = "<h1 style='font-size: 1.8rem'>$fullname</h1><h2 style='margin:0'>" . $primary_title;
    if ($experience > 0) {
      $name_html .= " (" . $experience . " years)";
    }
    $name_html .= "</h2>";
    $mpdf->WriteHTML($name_html);
    if ($bio) {
      $mpdf->writeHTML("<hr style='margin:0' /><p>$bio</p><br>");
    }
    if (sizeof($profile_skills) > 0) {
      $skill_list_html = "<h4 style='margin:0' >Skills</h4><hr style='margin:0' /><table width='100%'>";
      for ($j = 0; $j < sizeof($profile_skills); $j++) {
        //$skill_list_html .= '<li>' . $profile_skills[$j]['name'] . '</li>';
        $skill_list_html .= '<tr><td width="50%"><ul><li>' . $profile_skills[$j]['name'] . '</li></ul></td><td width="50%">';
        if ($profile_skills[$j]['year'] != 0) {
          $skill_list_html .= $profile_skills[$j]['year'] . ' years ';
        }
        if ($profile_skills[$j]['month'] != 0) {
          $skill_list_html .= $profile_skills[$j]['month'] . ' months';
        }
        $skill_list_html .= '</td></tr>';
      }
      $skill_list_html .= "</table>";
      $skill_list_html .= "<br>";
      $mpdf->WriteHTML($skill_list_html);
    }
    if ($softskills) {
      $softskills_html = "<h4 style='margin:0'>Soft skills</h4><hr style='margin:0' /><br><p>$softskills</p>";
      $mpdf->WriteHTML($softskills_html);
    }
    if (sizeof($profile_pro) > 0) {
      $project_html = "<h4 style='margin:0'>Project details</h4><hr style='margin:0' /><br><ul>";
      for ($i = 0; $i < sizeof($profile_pro); $i++) {
        $project_html .= "<li><p style='margin:0'><b>" . $profile_pro[$i]['title'] . " </b> ";
        if ($profile_pro[$i]['pro_start'] != "" && $profile_pro[$i]['pro_end'] != "") {
          $project_html .= "(" . $profile_pro[$i]['pro_start'] . ' - ' . $profile_pro[$i]['pro_end'] . ")";
        }
        $project_html .= "</p></br>";
        $project_html .= "<p style='margin:0'><b>Description </b> : " . $profile_pro[$i]['description'] . "</p>";
        $project_html .= "<p style='margin:0'><b>Roles & Responsibilities </b>: " . $profile_pro[$i]['responsibilities'] . "</p>";
        $project_html .= "<p style='margin:0'><b>Technologies </b>: " . $profile_pro[$i]['technologies'] . "</p>";

        if (!($profile_pro[$i]['url'] == "")) {
          $project_html .= "<p style='margin:0'><b>Industry </b>: " . $profile_pro[$i]['industry'] . "</p>";
          $project_html .= "<p style='margin-top:0'><b>link </b>:<a>" . $profile_pro[$i]['url'] . "</a></p>";
        } else {
          $project_html .= "<p style='margin-top:0'><b>Industry </b>: " . $profile_pro[$i]['industry'] . "</p>";
        }
        $project_html .= "</li>";
      }
      $project_html .= '</ul>';
      $mpdf->WriteHTML($project_html);
    }
    if (sizeof($profile_exp) > 0) {
      if (!$profile_exp[0]['title'] == "") {
        $emp_html = "<h4 style='margin:0'>Employment</h4><hr style='margin:0' /><br><ul>";
        for ($i = 0; $i < sizeof($profile_exp); $i++) {
          $emp_html .= "<li><p style='margin:0'><b>" . $profile_exp[$i]['title'] . " </b>(" . $profile_exp[$i]['start'] . " to " . $profile_exp[$i]['end'] . ")</p></br>";
          if (!($profile_exp[$i]['description'] == "")) {
            $emp_html .= "<p style='margin:0'>" . $profile_exp[$i]['company_name'] . "</p>";
            $emp_html .= "<p style='margin-top:0'><b>Description </b> : " . $profile_exp[$i]['description'] . "</p>";
          } else {
            $emp_html .= "<p style='margin-top:0'>" . $profile_exp[$i]['company_name'] . "</p>";
          }
          $emp_html .= "</li>";
        }
        $emp_html .= '</ul>';
        $mpdf->WriteHTML($emp_html);
      }
    }
    if (sizeof($profile_edu) > 0) {
      $edu_html = "<h4 style='margin:0'>Education</h4><hr style='margin:0' /><br><ul>";
      for ($i = 0; $i < sizeof($profile_edu); $i++) {
        $edu_html .= "<li><p style='margin:0'><b> " . $profile_edu[$i]['degree'] . " degree </b>in <b>" . $profile_edu[$i]['major'] . "</b></p></br>";
        $edu_html .= "<p style='margin:0'>" . $profile_edu[$i]['univ'] . "</p>";
        $edu_html .= "<p style='margin-top:0'>" . $profile_edu[$i]['edu_start'] . ' to ' . $profile_edu[$i]['edu_end'] . "</p></li>";
      }
      $edu_html .= '</ul>';
      $mpdf->WriteHTML($edu_html);
    }
    if (sizeof($profile_cert) > 0 && $profile_cert[0]['name'] != '') {
      $cert_html = "<h4 style='margin:0'>Certifications</h4><hr style='margin:0' /><br><ul>";
      for ($i = 0; $i < sizeof($profile_cert); $i++) {
        $cert_html .= "<li><p style='margin:0'><b>" . $profile_cert[$i]['name'] . "</b></p></br>";
        $cert_html .= "<p style='margin-top:0'>" . $profile_cert[$i]['year'] . "</p></li>";
      }
      $cert_html .= '</ul>';
      $mpdf->WriteHTML($cert_html);
    }

    $end_footer_html = "<p style='text-align: center;color: gray;'>-End of Document-</p>
    <p style='text-align: center;color: gray' >This PDF is automatically generated by " . $company_name . " on: " . date('d M Y') . "</p>";
    $mpdf->WriteHTML($end_footer_html);
    $mpdf->Output($primary_title . ' ' . $profiles[0]['experience'] . ' years ,' . $fullname . ' - ' . $uniqueID . ' - ' . $company_name . ' .pdf', 'D');
  }


  function sendmail()
  {
    $from = 'testemail@candmglobal.com';
    $to = 'sureshkutti@gmail.com';
    $subject = 'Testing subject';
    $message = 'testing your message';

    $this->load->library('email');



    $config = array(
      'protocol' => 'smtp',
      'smtp_host' => 'mail.candmglobal.com',
      'smtp_port' => 25,
      'smtp_user' => 'testemail@candmglobal.com',
      'smtp_pass' => 'R9RuIHhaU7lMLrFmYf',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => 'TRUE'
    );

    $this->email->initialize($config);
    $this->email->from($from);
    $this->email->to($to);
    $this->email->cc('burnwed@gmail.com');
    $this->email->subject($subject);
    $this->email->message($message);

    // Sending Email
    if ($this->email->send()) {
      echo 'Email sent.';
    } else {
      show_error($this->email->print_debugger());
    }



  }

  public function password_hash($pass = '')
  {
    if ($pass) {
      $password = password_hash($pass, PASSWORD_DEFAULT);
      return $password;
    }
  }


  public function getAllProfiles($id = null)
  {
    echo '<pre>';
    print_r($this->model_home->getAllProfiles($id));
  }

  public function profiles_bk()
  {
    $data['profiles'] = $this->model_home->listallprofiles();
    // print_r($data['profiles']); exit;
    $data['body_view'] = 'profiles';
    $this->load->view('template/layout_manager', $data);
  }

  public function profiles()
  {
    $this->load->library("pagination");
    $data['title'] = $this->lang->line("profiles_title");
    $data['description'] = $this->lang->line("description_title");
    $data['og'] = $this->lang->line("profiles_title");

    $data['url'] = base_url() . uri_string();
    $config["base_url"] = base_url() . 'profiles/';
    $getallrecords = $this->model_home->listallprofiles('donotsetlimit');
    $data['industry_report'] = $this->model_stores->getIndustryReport();
    $config["total_rows"] = $getallrecords["count"];
    $config["per_page"] = 9;
    $config["uri_segment"] = 3;
    $config['full_tag_open'] = '<nav class="d-flex justify-content-center" aria-label="pagination" ><ul class="pagination" id="pagination">';
    $config['full_tag_close'] = '</ul></nav>';
    $config['attributes'] = ['class' => 'page-link'];
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li class="page-item">';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="page-item">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li class="page-item">';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li class="page-item">';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
    $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
    $config['num_tag_open'] = '<li class="page-item">';
    $config['num_tag_close'] = '</li>';

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $getallrecords = $this->model_home->listallprofiles($config["per_page"], $page);
    $data["links"] = $this->pagination->create_links();
    $data['profiles'] = $getallrecords['data'];

    $data['body_view'] = 'profiles';
    $this->load->view('template/layout_manager', $data);
  }



  public function profiledetails($id)
  {
    if (sizeof($this->model_home->getprofilebyid($id)) == 0) {
      redirect('my404', 'refresh');
    } else {
      $data['title'] = $this->lang->line("profdetail_title");
      $data['description'] = $this->lang->line("profdetaildescription_title");
      $this->model_home->IncreaseProfileViewcount($id);
      $data['profiles'] = $this->model_home->getprofilebyid($id);
      $data['profile_edu'] = $this->model_home->profile_edu($id);
      $data['profile_exp'] = $this->model_home->profile_exp($id);
      $data['profile_pro'] = $this->model_home->profile_pro($id);
      $data['profile_cert'] = $this->model_home->profile_cert($id);
      $data['profile_skills'] = $this->model_home->profile_skills($id);

      // echo '<pre>';
      // print_r($data['profile_skills']);
      $skillNames = [];

      for ($j = 0; $j < sizeof($data['profile_skills']); $j++) {
        $skillNames[] = $data['profile_skills'][$j]['name'];
      }
      $string_version = implode(',', $skillNames);
      // print_r($string_version);

      // exit;

      $data['name'] = strtolower($data['profiles'][0]['last_name']) . ' ' . strtolower(mb_substr($data['profiles'][0]['first_name'], 0, 1));
      $data['profileURL'] = 'profile/' . $data['profiles'][0]['profile_url'] . '/' . $data['profiles'][0]['id'];

      $profileID = $data['profiles'][0]['id'];
      $profileImg = '';

      if (file_exists('./profileimages/256X256/' . $profileID . '.jpg')) {
        $profileImg = base_url() . $this->config->item('product_image_medium') . $profileID . '.jpg';
      } else if (file_exists('./profileimages/256X256/' . $profileID . '.png')) {
        $profileImg = base_url() . $this->config->item('product_image_medium') . $profileID . '.png';
      } else {
        $profileImg = base_url() . $this->config->item('product_noimage_thumb') . 'noimage.jpg';
      }

      //  Profile details schema - Start

      $data['profileImg'] = $profileImg;
      $data['profileskills'] = $string_version;

      $data['candidateName'] = $data['profiles'][0]['last_name'];
      $data['candidateURL'] = 'profile/' . $data['profiles'][0]['profile_url'] . '/' . $data['profiles'][0]['id'];
      $data['skills'] = $data['profiles'][0]['skills'];

      //  Profile details schema - End


      if (sizeof($data['profiles'])) {

        $data['og'] = $data['profiles'][0]['last_name'] . ' - ' . $data['profiles'][0]['primary_title'] . ' | Talrn.com';

        $data['title'] = "Top " . $data['profiles'][0]['primary_title'] . " in " . $data['profiles'][0]['city'] . ', ' . $data['profiles'][0]['country'] . ": " . $data['profiles'][0]['last_name'] . " | Talrn";

        $data['description'] = $data['profiles'][0]['last_name'] . " is a " . $data['profiles'][0]['primary_title'] . ' based in ' . $data['profiles'][0]['city'] . ', ' . $data['profiles'][0]['country'] . ' with over ' . $data['profiles'][0]['experience'] . ' years of experience . Learn more about ' . $data['profiles'][0]['last_name'] . 's portfolio ';
        //$data['title'] = $data['profiles'][0]['last_name'] . ' is available ' . $data['profiles'][0]['comittment'] . ' based in ' . $data['profiles'][0]['citizenship'] . ', ' . $data['profiles'][0]['country'] . '. Learn more about ' . $data['profiles'][0]['last_name'] . '&#39;s portfolio.';
        ;

        $data['body_view'] = 'profiledetails';
        $this->load->view('template/layout_manager', $data);
      } else {
        redirect('my404', 'refresh');
      }
    }
  }
  public function resources()
  {
    $data['body_view'] = 'resources';
    $data['og_image'] = $this->lang->line("resources_og_image");
    $this->load->view('template/layout_manager', $data);
  }


  public function industries()
  {
    $data['body_view'] = 'industries';
    $this->load->view('template/layout_manager', $data);
  }

  public function forgotpassword()
  {
    $data['message'] = '';
    $data['body_view'] = 'forgotpassword';
    $this->load->view('template/layout_manager', $data);
  }

  public function profile_details()
  {
    $data['message'] = '';
    $data['body_view'] = 'profile_details';
    $this->load->view('template/layout_manager', $data);
  }

  public function profile_details2()
  {
    $data['message'] = '';
    $data['body_view'] = 'profile_details2';
    $this->load->view('template/layout_manager', $data);
  }

  public function sendemail($email)
  {
    $user = $this->model_users->getUserProfileEmail($email);
    if ($user == null) {
      $data['message'] = '<label class="text-success mt-1" >If you have a Talrn account, you will receive instructions for resetting your password in your email</label>';
      $data['body_view'] = 'forgotpassword';
      $this->load->view('template/layout_manager', $data);
    } else {
      $from = 'no-reply@talrn.com';
      $to = $email;

      $subject = 'Password Change for your Talrn Vendor Account';
      $message = 'Talrn.com Password Reset Request <br> <br>
        Dear ' . $user['firstname'] . ' ' . $user['lastname'] . ',<br><br>
        To reset the password to your Talrn Vendor account, click the link below:<br><br>
        ' . "<a href=" . base_url('home') . '/resetpassword?id=' . $user['id'] . '&token=' . $user['password'] . ">link</a>" . '<br><br>
        if the above link does not work, copy and paste the following in a browser:<br><br>
        ' . base_url('home') . '/resetpassword?id=' . $user['id'] . '&token=' . $user['password'] . '<br><br>
        For your information:<br><br>
        Time of Request : ' . date("l") . ', ' . date("d M Y") . '<br><br>
        If you' . "'" . 've not made this request please ignore this email <br><br>
        If the above link is not clickable, please copy the whole link and paste it in your browser.<br><br>
        Should you have any questions or concerns, please contact us support@talrn.com <br><br>
        Sincerely,<br>
        Talrn Team<br>
        https://www.Talrn.com/<br><br>
        This is an automated email, please do not reply or send anything to this email. <br>
        ';

      $config = array(
        'protocol' => 'smtp',
        'smtp_host' => 'mail.talrn.com',
        'smtp_port' => 25,
        'smtp_user' => 'no-reply@talrn.com',
        'smtp_pass' => '4@FQOk^~GhcW',
        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => 'TRUE'
      );

      $this->email->initialize($config);
      $this->email->from($from);
      $this->email->cc('no-reply@talrn.com');
      $this->email->to($to);
      $this->email->subject($subject);
      $this->email->message($message);
      $this->email->send();
      $data['message'] = '<label class="text-success mt-1" >If you have a Talrn account, you will receive instructions for resetting your password in your email</label>';
      $data['body_view'] = 'forgotpassword';
      $this->load->view('template/layout_manager', $data);

    }
  }


  public function resetpass()
  {
    $id = $this->input->get('id');
    $token = $this->input->get('token');
    $user = $this->model_users->getUserData($id);
    if ($user == null) {
      $data['message'] = 'User does not exists';
      $data['body_view'] = 'resetpassword';
      $this->load->view('template/layout_manager', $data);
    } else if ($token != $user['password']) {
      $data['message'] = 'Wrong id or token';
      $data['body_view'] = 'resetpassword';
      $this->load->view('template/layout_manager', $data);
    } else {
      $pass = $this->input->get('pass');
      $password = $this->password_hash($pass);
      $data = array(
        'password' => $password,
      );
      $update = $this->model_users->edit($data, $id);
      if ($update == true) {
        $from = 'no-reply@talrn.com';
        $to = $user['email'];

        $subject = 'Password successfully updated for your Talrn Vendor Account';
        $message = 'Talrn.com Password Reset Successfult <br> <br>
        Dear ' . $user['firstname'] . ' ' . $user['lastname'] . ',<br><br>
        Youve successfully reset the password for your account!<br><br>
        For your information:<br><br>
        Time of Request : ' . date("l") . ', ' . date("d M Y") . '<br><br>
        Should you have any questions or concerns, please contact us support@talrn.com <br><br>
        Sincerely,<br>
        Talrn Team<br>
        https://www.Talrn.com/<br><br>
        This is an automated email, please do not reply or send anything to this email. <br>
        ';

        $config = array(
          'protocol' => 'smtp',
          'smtp_host' => 'mail.talrn.com',
          'smtp_port' => 25,
          'smtp_user' => 'no-reply@talrn.com',
          'smtp_pass' => '4@FQOk^~GhcW',
          'mailtype' => 'html',
          'charset' => 'iso-8859-1',
          'wordwrap' => 'TRUE'
        );

        $this->email->initialize($config);
        $this->email->from($from);
        $this->email->cc('no-reply@talrn.com');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
        $data['message'] = '<label class="text-success mt-1" >Password reset successful</label>';
        $data['body_view'] = 'resetpassword';
        $this->load->view('template/layout_manager', $data);
      } else {
        $data['message'] = 'Error: failure to update password';
        $data['body_view'] = 'resetpassword';
        $this->load->view('template/layout_manager', $data);
      }
    }
  }

  public function resetpassword()
  {
    $id = $this->input->get('id');
    $token = $this->input->get('token');
    $user = $this->model_users->getUserData($id);
    if ($user == null) {
      $data['message'] = 'User does not exists';
      $data['body_view'] = 'resetpassword';
      $this->load->view('template/layout_manager', $data);
    } else if ($token != $user['password']) {
      $data['message'] = 'Wrong id or token, please copy the whole link';
      $data['body_view'] = 'resetpassword';
      $this->load->view('template/layout_manager', $data);
    } else {
      $data['message'] = '';
      $data['user_id'] = $id;
      $data['pass'] = $user['password'];
      $data['body_view'] = 'resetpassword';
      $this->load->view('template/layout_manager', $data);
    }
  }
}
