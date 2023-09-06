<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apply_ios_dev extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_users');
        $this->load->model('model_home');
        $this->lang->load("title", "english");
    }

    public function index()
    {
        $data['title'] = $this->lang->line("apply_ios_dev_title");
        $data['description'] = $this->lang->line("apply_ios_dev_description");
        $data['og'] = $this->lang->line("apply_ios_dev_title");
        $data['og_image'] = $this->lang->line("apply_ios_dev_og_image");
        $this->form_validation->set_rules('org_first_name', 'First name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('org_last_name', 'Last name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('org_email', 'Work email', 'trim|required|is_unique[users.email]|xss_clean|valid_email', array('is_unique' => 'The {field} already registered'));
        $this->form_validation->set_rules('org_tel', 'Phone number', 'trim|required|is_unique[users.phone]|xss_clean|callback_validate_mobile_number', array('is_unique' => 'The {field} already registered'));
        $this->form_validation->set_rules('org_accept_terms', 'Accept terms &amp; conditions', 'callback_org_accept_terms');
        $this->form_validation->set_rules('org_city','City','trim|required|xss_clean');
        if($this->input->post('org_name') != 'Individual') {
            $this->form_validation->set_rules('org_email', 'Work email', 'trim|required|is_unique[users.email]|xss_clean|callback_validate_email_domain|valid_email', array('is_unique' => 'The {field} already registered'));
            $this->form_validation->set_rules('org_name', 'Organization name', 'trim|required|is_unique[users.username]|xss_clean', array('is_unique' => 'The {field} already registered'));
            $this->form_validation->set_rules('org_website', 'Website', 'trim|required|is_unique[stores.website]|xss_clean', array('is_unique' => 'The {field} already registered'));
            $this->form_validation->set_rules('org_cin','CIN/GST','trim|required|is_unique[users.cin/gst]|xss_clean', array('is_unique' => 'The {field} already registered'));
            $this->form_validation->set_rules('org_job_title','Job title','trim|required|xss_clean');
        }

        if($this->form_validation->run() == FALSE) {
            $data['message'] = null;
            $data['body_view'] = 'apply_ios_dev';
            if($this->input->post('org_name') == 'Individual'){
                $data['Individual'] = true;
            }
            else{
                $data['Individual'] = false;
            }
            $this->load->view('template/layout_manager', $data);
        } else {
            if($this->input->post('org_name') == 'Individual') {
                $registered_as = 2;
                $website = 'Individual';
                $name = $this->input->post('org_first_name').' '.$this->input->post('org_last_name');
            }
            else{
                $registered_as = 1;
                $website = $this->input->post('org_website');
                $name = $this->input->post('org_name');
            }
            $date = date('d/m/Y');
            $createorg = $this->model_users->createorg($name, $website, $registered_as,$date);
            $randomString=$this->generateRandomString();
            $passwd = $this->password_hash($randomString);
            if($registered_as == 1){
            $inputdata = array(
                'username' => $this->input->post('org_name'),
                'password' => $passwd,
                'email' => $this->input->post('org_email'),
                'firstname' => $this->input->post('org_first_name'),
                'lastname' => $this->input->post('org_last_name'),
                'phone' => $this->input->post('org_tel'),
                'gender' => '0',
                'store_id' => $createorg,
                'registered_as' => 1,
                'city' => $this->input->post('org_city'),
                'job_title' => $this->input->post('org_job_title'),
                'cin/gst' => $this->input->post('org_cin'),
                'referral_code' => $this->input->post('referral_code'),
            );
            }else{
                $inputdata = array(
                    'username' => 'Individual',
                    'password' => $passwd,
                    'email' => $this->input->post('org_email'),
                    'firstname' => $this->input->post('org_first_name'),
                    'lastname' => $this->input->post('org_last_name'),
                    'phone' => $this->input->post('org_tel'),
                    'gender' => '0',
                    'store_id' => $createorg,
                    'registered_as' => 2,
                    'city' => $this->input->post('org_city'),
                    'referral_code' => $this->input->post('referral_code'),
                );
            }


            $create = $this->model_users->create($inputdata, '3');

            $from = 'no-reply@talrn.com';
            $to = $this->input->post('org_email');
            
            $subject = 'Talrn - Vendor Account Information';
            $message = 'Welcome to Talrn Vendor Beta! <br>
            We are here to match you with the best projects across the globel. <br> <br>
            Please find your login information here <br><br>
            URL: '.base_url('/admin').' <br> 
            Email: '. $to .' <br>
            Password: '.$randomString.' <br><br>
            We recommend you reset the password from your account after your first time to anything that you find suitable. 
            '.base_url('admin/users/setting').' <br><br>
            Please start by uploading your profile(s) with the required information so we can start matching them with suitable projects. <br><br>
            If you require assistance with managing your account, uploading profiles or any general questions you may have for us, you may reach out to us at vendor@talrn.com or use the chat from your vendor dashboard. <br><br>
            
            Regards<br>
            Talrn Vendor Team<br><br>

            "Always deliver more than expected" <br><br>

            This is an automated email, please do not reply or send anything to this email. 

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
            $data['message'] = 'Thank you for signing up at Talrn - We have sent your account information to ' .$to;
            $data['body_view'] = 'success';
            $data['email'] = $to;
            $data['password'] = $randomString;
            $this->load->view('template/layout_manager', $data);
        }
    }

    public function password_hash($pass = '')
    {
        if ($pass) {
            $password = password_hash($pass, PASSWORD_DEFAULT);
            return $password;
        }
    }

    function generateRandomString($length = 9) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
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
            $domains = array('abc.com', 'xyz.com','gmail.com');
            $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";
            if (!preg_match($pattern, $email)) {
                //$emailArray = explode("@", $email);
                // if (checkdnsrr(array_pop($emailArray), "MX")) {
                //     return true;
                // } else {
                //     $this->form_validation->set_message('validate_email_domain', 'Please enter valid work email addres' );
                //     return false;
                // }
                return true;
            } else {
                $this->form_validation->set_message('validate_email_domain', 'Please enter valid work email address');
                return false;
            }
        }
    }

    function validate_mobile_number() {
        if ($_POST['org_tel']) {
            $mobile = $_POST['org_tel'];
            if (preg_match('/^[\d +]+$/', $mobile)) {
                if(strlen($mobile) < 16 && strlen($mobile) > 6){
                return true;
                }else{
                   $this->form_validation->set_message('validate_mobile_number', 'Please enter valid number');
                    return false; 
                }
            } else {
                $this->form_validation->set_message('validate_mobile_number', 'Please enter valid number');
                return false;
            }
        }
        $this->form_validation->set_message('validate_mobile_number', 'Please enter valid number');
        return false;
    }
}
