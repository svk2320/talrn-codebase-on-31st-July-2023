<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_announcement');
		// Check if the alert cookie exists
		// if (!$this->input->cookie('alert_displayed')) {
		// 	// Set the alert cookie with an expiration time (e.g., 24 hours)
		// 	$cookie = array(
		// 		'name' => 'alert_displayed',
		// 		'value' => true,
		// 		'expire' => 86400,
		// 		// 24 hours in seconds
		// 		'path' => '/',
		// 	);
		// 	$this->input->set_cookie($cookie);
		// }

	}
}

class Frontend_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->lang->load("title", "english");
		$this->load->model('model_home');
		$request_logs = [
			"IP" => $this->input->ip_address(),
			"url" => current_url(),
			"status" => 'guest',
		];
		$this->model_home->create_request_log($request_logs);
	}
}

class Admin_Controller extends MY_Controller
{

	var $permission = array();

	public function __construct()
	{
		parent::__construct();
		$this->lang->load("title", "english");

		$group_data = array();
		if (empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
			$this->load->model('model_home');
			$request_logs = [
				"IP" => $this->input->ip_address(),
				"url" => current_url(),
				"status" => 'guest',
			];
			$this->model_home->create_request_log($request_logs);
		} else {
			if($this->session->userdata('type') != 'admin'){
				redirect('client', 'refresh');
			}
			$user_id = $this->session->userdata('id');
			$this->load->model('model_groups');
			$this->data['group_data'] = $group_data = $this->model_groups->getUserGroupByUserId($user_id);

			$this->data['user_permission'] = unserialize($group_data['permission']);

			$this->permission = unserialize($group_data['permission']);

			$this->load->model('model_home');
			$request_logs = [
				"IP" => $this->input->ip_address(),
				"url" => current_url(),
				"status" => 'logged',
				"user_id" => $user_id
			];
			$this->model_home->create_request_log($request_logs);

			// 	echo '<pre>';
			// print_r($this->data['group_data']);
			// exit;

		}
	}

	public function logged_in()
	{
		echo 'logged_in';
		$session_data = $this->session->userdata();
		print_r($session_data);
		exit;
		if ($session_data['logged_in'] == TRUE) {
			redirect('admin/dashboard', 'refresh');
		}
	}

	public function not_logged_in()
	{
		//echo 'not_logged_in';
		$session_data = $this->session->userdata();
		//print_r($session_data); exit;
		if ($session_data['logged_in'] == FALSE) {
			redirect('admin/auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('admin/templates/header', $data);
		$this->load->view('admin/templates/main_header', $data);
		$this->load->view('admin/templates/main_sidebar', $data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer', $data);
	}

	public function contact_reason()
	{
		return $reason = array(
			"Webiste" => "webiste",
			"Others" => "others"
		);
	}

	public function currency()
	{
		return $currency_symbols = array(
			'AED' => '&#1583;.&#1573;',
			// ?
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;',
			// ?
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;',
			// ?
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;',
			// ?
			'BIF' => '&#70;&#66;&#117;',
			// ?
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;',
			// ?
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;',
			// ?
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;',
			// ?
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;',
			// ?
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;',
			// ?
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;',
			// ?
			'GNF' => '&#70;&#71;',
			// ?
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;',
			// ?
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '<i class="fa fa-inr" aria-hidden="true"></i>
',
			'IQD' => '&#1593;.&#1583;',
			// ?
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;',
			// ?
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;',
			// ?
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;',
			// ?
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;',
			// ?
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;',
			// ?
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;',
			// ?
			'MAD' => '&#1583;.&#1605;.',
			//?
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;',
			// ?
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;',
			// ?
			'MRO' => '&#85;&#77;',
			// ?
			'MUR' => '&#8360;',
			// ?
			'MVR' => '.&#1923;',
			// ?
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;',
			// ?
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;',
			// ?
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;',
			// ?
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;',
			// ?
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;',
			// ?
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;',
			// ? TJS (guess)
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;',
			// New Turkey Lira (old symbol used)
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;',
			// ?
			'ZWL' => '&#90;&#36;',
		);
	}
}

class Client_Controller extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->lang->load("title", "english");

		if (empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
			$this->load->model('model_home');
			$request_logs = [
				"IP" => $this->input->ip_address(),
				"url" => current_url(),
				"status" => 'guest',
			];
			$this->model_home->create_request_log($request_logs);
		} else {
			if($this->session->userdata('type') != 'client'){
				redirect('admin', 'refresh');
			}

			$this->load->model('model_home');
			$request_logs = [
				"IP" => $this->input->ip_address(),
				"url" => current_url(),
				"status" => 'client_logged',
			];
			$this->model_home->create_request_log($request_logs);

		}
	}

	public function logged_in()
	{
		echo 'logged_in';
		$session_data = $this->session->userdata();
		print_r($session_data);
		exit;
		if ($session_data['logged_in'] == TRUE) {
			redirect('client/dashboard', 'refresh');
		}
	}

	public function not_logged_in()
	{
		//echo 'not_logged_in';
		$session_data = $this->session->userdata();
		//print_r($session_data); exit;
		if ($session_data['logged_in'] == FALSE) {
			redirect('admin/auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('client/templates/header', $data);
		$this->load->view('client/templates/main_header', $data);
		$this->load->view('client/templates/main_sidebar', $data);
		$this->load->view($page, $data);
		$this->load->view('client/templates/footer', $data);
	}

	public function contact_reason()
	{
		return $reason = array(
			"Webiste" => "webiste",
			"Others" => "others"
		);
	}

	public function currency()
	{
		return $currency_symbols = array(
			'AED' => '&#1583;.&#1573;',
			// ?
			'AFN' => '&#65;&#102;',
			'ALL' => '&#76;&#101;&#107;',
			'ANG' => '&#402;',
			'AOA' => '&#75;&#122;',
			// ?
			'ARS' => '&#36;',
			'AUD' => '&#36;',
			'AWG' => '&#402;',
			'AZN' => '&#1084;&#1072;&#1085;',
			'BAM' => '&#75;&#77;',
			'BBD' => '&#36;',
			'BDT' => '&#2547;',
			// ?
			'BGN' => '&#1083;&#1074;',
			'BHD' => '.&#1583;.&#1576;',
			// ?
			'BIF' => '&#70;&#66;&#117;',
			// ?
			'BMD' => '&#36;',
			'BND' => '&#36;',
			'BOB' => '&#36;&#98;',
			'BRL' => '&#82;&#36;',
			'BSD' => '&#36;',
			'BTN' => '&#78;&#117;&#46;',
			// ?
			'BWP' => '&#80;',
			'BYR' => '&#112;&#46;',
			'BZD' => '&#66;&#90;&#36;',
			'CAD' => '&#36;',
			'CDF' => '&#70;&#67;',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => '&#36;',
			'CNY' => '&#165;',
			'COP' => '&#36;',
			'CRC' => '&#8353;',
			'CUP' => '&#8396;',
			'CVE' => '&#36;',
			// ?
			'CZK' => '&#75;&#269;',
			'DJF' => '&#70;&#100;&#106;',
			// ?
			'DKK' => '&#107;&#114;',
			'DOP' => '&#82;&#68;&#36;',
			'DZD' => '&#1583;&#1580;',
			// ?
			'EGP' => '&#163;',
			'ETB' => '&#66;&#114;',
			'EUR' => '&#8364;',
			'FJD' => '&#36;',
			'FKP' => '&#163;',
			'GBP' => '&#163;',
			'GEL' => '&#4314;',
			// ?
			'GHS' => '&#162;',
			'GIP' => '&#163;',
			'GMD' => '&#68;',
			// ?
			'GNF' => '&#70;&#71;',
			// ?
			'GTQ' => '&#81;',
			'GYD' => '&#36;',
			'HKD' => '&#36;',
			'HNL' => '&#76;',
			'HRK' => '&#107;&#110;',
			'HTG' => '&#71;',
			// ?
			'HUF' => '&#70;&#116;',
			'IDR' => '&#82;&#112;',
			'ILS' => '&#8362;',
			'INR' => '<i class="fa fa-inr" aria-hidden="true"></i>
',
			'IQD' => '&#1593;.&#1583;',
			// ?
			'IRR' => '&#65020;',
			'ISK' => '&#107;&#114;',
			'JEP' => '&#163;',
			'JMD' => '&#74;&#36;',
			'JOD' => '&#74;&#68;',
			// ?
			'JPY' => '&#165;',
			'KES' => '&#75;&#83;&#104;',
			// ?
			'KGS' => '&#1083;&#1074;',
			'KHR' => '&#6107;',
			'KMF' => '&#67;&#70;',
			// ?
			'KPW' => '&#8361;',
			'KRW' => '&#8361;',
			'KWD' => '&#1583;.&#1603;',
			// ?
			'KYD' => '&#36;',
			'KZT' => '&#1083;&#1074;',
			'LAK' => '&#8365;',
			'LBP' => '&#163;',
			'LKR' => '&#8360;',
			'LRD' => '&#36;',
			'LSL' => '&#76;',
			// ?
			'LTL' => '&#76;&#116;',
			'LVL' => '&#76;&#115;',
			'LYD' => '&#1604;.&#1583;',
			// ?
			'MAD' => '&#1583;.&#1605;.',
			//?
			'MDL' => '&#76;',
			'MGA' => '&#65;&#114;',
			// ?
			'MKD' => '&#1076;&#1077;&#1085;',
			'MMK' => '&#75;',
			'MNT' => '&#8366;',
			'MOP' => '&#77;&#79;&#80;&#36;',
			// ?
			'MRO' => '&#85;&#77;',
			// ?
			'MUR' => '&#8360;',
			// ?
			'MVR' => '.&#1923;',
			// ?
			'MWK' => '&#77;&#75;',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZN' => '&#77;&#84;',
			'NAD' => '&#36;',
			'NGN' => '&#8358;',
			'NIO' => '&#67;&#36;',
			'NOK' => '&#107;&#114;',
			'NPR' => '&#8360;',
			'NZD' => '&#36;',
			'OMR' => '&#65020;',
			'PAB' => '&#66;&#47;&#46;',
			'PEN' => '&#83;&#47;&#46;',
			'PGK' => '&#75;',
			// ?
			'PHP' => '&#8369;',
			'PKR' => '&#8360;',
			'PLN' => '&#122;&#322;',
			'PYG' => '&#71;&#115;',
			'QAR' => '&#65020;',
			'RON' => '&#108;&#101;&#105;',
			'RSD' => '&#1044;&#1080;&#1085;&#46;',
			'RUB' => '&#1088;&#1091;&#1073;',
			'RWF' => '&#1585;.&#1587;',
			'SAR' => '&#65020;',
			'SBD' => '&#36;',
			'SCR' => '&#8360;',
			'SDG' => '&#163;',
			// ?
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => '&#163;',
			'SLL' => '&#76;&#101;',
			// ?
			'SOS' => '&#83;',
			'SRD' => '&#36;',
			'STD' => '&#68;&#98;',
			// ?
			'SVC' => '&#36;',
			'SYP' => '&#163;',
			'SZL' => '&#76;',
			// ?
			'THB' => '&#3647;',
			'TJS' => '&#84;&#74;&#83;',
			// ? TJS (guess)
			'TMT' => '&#109;',
			'TND' => '&#1583;.&#1578;',
			'TOP' => '&#84;&#36;',
			'TRY' => '&#8356;',
			// New Turkey Lira (old symbol used)
			'TTD' => '&#36;',
			'TWD' => '&#78;&#84;&#36;',
			'UAH' => '&#8372;',
			'UGX' => '&#85;&#83;&#104;',
			'USD' => '&#36;',
			'UYU' => '&#36;&#85;',
			'UZS' => '&#1083;&#1074;',
			'VEF' => '&#66;&#115;',
			'VND' => '&#8363;',
			'VUV' => '&#86;&#84;',
			'WST' => '&#87;&#83;&#36;',
			'XAF' => '&#70;&#67;&#70;&#65;',
			'XCD' => '&#36;',
			'XPF' => '&#70;',
			'YER' => '&#65020;',
			'ZAR' => '&#82;',
			'ZMK' => '&#90;&#75;',
			// ?
			'ZWL' => '&#90;&#36;',
		);
	}
}