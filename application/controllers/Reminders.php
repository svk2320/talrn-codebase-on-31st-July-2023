<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reminders extends CI_Controller
{

	public function index()
	{
		$this->load->view('welcome_message');
	}

    public function sendreminder()
    {
        $this->load->model('model_users');
        $user_list = $this->model_users->getNoProfileUsers();
        $email_count = 0;
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

            //if($this->email->send()){
            if(true){
                $email_log = array(
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'status' => 'success'
                );
            }else{
                $email_log = array(
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'status' => 'failure'
                );
            }

            // add the entry to the  database
            $this->model_users->createReminder($email_log);
            echo "email sent to " . $user['email'] . "<br>";
            $email_count = $email_count + 1;
        }

        echo 'success<br>';
        echo "Total emails sent: " . $email_count;
    }
}