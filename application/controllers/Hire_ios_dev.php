<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hire_ios_dev extends Frontend_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_clients');
    }

    public function index()
    {
        $data['title'] = $this->lang->line("hire_title");
        $data['description'] = $this->lang->line("hire_description_title");
        $data['og'] = $this->lang->line("hire_title");
        $data['og_image'] = $this->lang->line("hire_og_image");

        $this->form_validation->set_rules('reg_first_name', 'First name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reg_last_name', 'Job title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reg_name', 'Organization name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('reg_email', 'Work email', 'trim|required|valid_email|is_unique[clients.email]|xss_clean');
        $this->form_validation->set_rules('reg_tel', 'Phone', 'trim|required|numeric|is_unique[clients.phone]|xss_clean');
        $this->form_validation->set_rules('reg_mode', 'How did you hear about us', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $data['message'] = null;
            $data['body_view'] = 'hire-ios-dev';
            $this->load->view('template/layout_manager', $data);
        } else {
            $name = $this->input->post('reg_first_name');
            $job_title = $this->input->post('reg_last_name');
            $company = $this->input->post('reg_name');
            $email = $this->input->post('reg_email');
            $phone = $this->input->post('reg_tel');
            $how = $this->input->post('reg_mode');
            $randomString = $this->generateRandomString();
            $passwd = $this->password_hash($randomString);

            $inputdata = array(
                'name' => $name,
                'job_title' => $job_title,
                'company' => $company,
                'email' => $email,
                'how' => $how,
                'phone' => $phone,
                'password' => $passwd
            );

            $create = $this->model_clients->create($inputdata);

            $from = 'no-reply@talrn.com';
            $to = $email;

            $subject = 'Talrn - Client Account Information';
            $message = 'Welcome to Talrn Client Beta! <br>
            We are here to match you with the best projects across the globel. <br> <br>
            Please find your login information here <br><br>
            URL: ' . base_url('/admin') . ' <br> 
            Email: ' . $to . ' <br>
            Password: ' . $randomString . ' <br><br>
            We recommend you reset the password from your account after your first time to anything that you find suitable. 
            ' . base_url('client/users/setting') . ' <br><br>
            Please start by uploading your profile(s) with the required information so we can start matching them with suitable projects. <br><br>
            If you require assistance with managing your account, uploading profiles or any general questions you may have for us, you may reach out to us at vendor@talrn.com or use the chat from your vendor dashboard. <br><br>
            
            Regards<br>
            Talrn Client Team<br><br>

            "Always deliver more than expected" <br><br>

            This is an automated email, please do not reply or send anything to this email. 

            ';


            // echo $message;
            
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
            $data['body_view'] = 'client_success';
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

    function generateRandomString($length = 9)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

}