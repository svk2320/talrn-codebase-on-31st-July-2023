<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Email Reminder';

        $this->load->model('model_users');
	}

	public function index()
	{
        $this->render_template("admin/reminder/index", $this->data);
	}

	public function sendreminder()
    {
        
        $user_list = $this->model_users->getNoProfileUsers();
        $email_count = 0;
        $email_success = 0;
        $email_failure = 0;
        foreach ($user_list as $user) {
            // check wheather email is already sent within timeframe using database
            $datestamp = $this->model_users->getLatestEmailUsers($user['id']);

            // Create a DateTime object for the datestamp
            $mysqlDate = new DateTime($datestamp);

            // Create a DateTime object for the current date and time
            $currentDate = new DateTime();

            // Calculate the difference between the two dates
            $interval = $currentDate->diff($mysqlDate);

            // Get the total number of days between the two dates
            $days = $interval->days;
            if ($datestamp == null) {
                $days = 1000;
            }
            // Check if the date is more than 7 days earlier
            if ($days < 7) {
                continue;
            }
            

            // send the reminder  email
            $from = 'test@talrn.com';
            $to = $user['email'];

            $subject = 'Talrn - Profile upload reminder';
            $message = "Hello " . $user['firstname'] . " " . $user['lastname'] . "<br><br>
            We wanted to reach out and say thank you for signing up to Talrn. We are excited to have you as a part of our community.<br><br>
            We noticed that you haven't uploaded your profile yet. We know that life can get busy, but we want to remind you of the benefits of having a completed profile. By uploading your profile, you'll be able to stand out to potential employers and increase your chances of landing your dream remote job.<br><br>
            We understand that filling out a profile can be a bit daunting, but we're here to help! Our team is always available to answer any questions or offer guidance.<br><br>
            So, what are you waiting for? Take a break from your busy schedule, grab a cup of coffee, and get your profile uploaded. Trust us, it's worth it!<br><br>
            Thank you again for joining our community, and we look forward to seeing your completed profile soon!<br><br>
            Regards<br>
            Vendor Team<br><br>
            ";

            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.talrn.com',
                'smtp_port' => 25,
                'smtp_user' => 'test@talrn.com',
                'smtp_pass' => '&A+q[!phA-WB',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => 'TRUE'
            );
            $this->email->clear();
            $this->email->initialize($config);
            $this->email->from($from);
            $this->email->cc('test@talrn.com');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);

            if($this->email->send()){
            // if(true){
                $email_log = array(
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'status' => 'success'
                );
                $email_success = $email_success + 1;
            }else{
                $email_log = array(
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'status' => 'failure'
                );
                $email_failure = $email_failure + 1;
            }

            // add the entry to the  database
            $this->model_users->createReminder($email_log);
            $email_count = $email_count + 1;
        }

        $this->data['email_count'] = $email_count;
        $this->data['email_success'] = $email_success;
        $this->data['email_failure'] = $email_failure;
        $this->render_template("admin/reminder/index", $this->data);
    }

    public function fetchEmailData(){
        $result = array('data' => array());

		$data = $this->model_users->getEmailLogs();

		foreach ($data as $key => $value) {
			$result['data'][$key] = array(
				$value['email'],
				$value['date'],
                $value['status']
			);
		} // foreach

		echo json_encode($result);
    }

    public function bulktest()
    {
        for($i = 0; $i < 100; $i++ ){
            $from = 'test@talrn.com';
            $to = 'bhumitmalvi999@gmail.com';

            $subject = 'Talrn - Profile upload reminder';
            $message = "Hello Bhumit malvi<br><br>
            We wanted to reach out and say thank you for signing up to Talrn. We are excited to have you as a part of our community.<br><br>
            We noticed that you haven't uploaded your profile yet. We know that life can get busy, but we want to remind you of the benefits of having a completed profile. By uploading your profile, you'll be able to stand out to potential employers and increase your chances of landing your dream remote job.<br><br>
            We understand that filling out a profile can be a bit daunting, but we're here to help! Our team is always available to answer any questions or offer guidance.<br><br>
            So, what are you waiting for? Take a break from your busy schedule, grab a cup of coffee, and get your profile uploaded. Trust us, it's worth it!<br><br>
            Thank you again for joining our community, and we look forward to seeing your completed profile soon!<br><br>
            Regards<br>
            Vendor Team<br><br>
            ";

            $config = array(
                'protocol' => 'smtp',
                'smtp_host' => 'mail.talrn.com',
                'smtp_port' => 25,
                'smtp_user' => 'test@talrn.com',
                'smtp_pass' => '&A+q[!phA-WB',
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'wordwrap' => 'TRUE'
            );
            $this->email->clear();
            $this->email->initialize($config);
            $this->email->from($from);
            $this->email->cc('test@talrn.com');
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($message);
        }
    }

}
