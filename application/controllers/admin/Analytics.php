<?php

class Analytics extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Analytics';
	}

	public function index()
	{
		$this->load->model('Model_groups');
		$this->data['users_count'] = $this->Model_groups->noOfUsers();
		$this->data['profile_count'] = $this->Model_groups->noOfProfiles();
		$vendor_signup = $this->Model_groups->vendorSignups();
		$profiles_upload = $this->Model_groups->profilesUpload();
		$Active_users = $this->Model_groups->ActiveUsers();
		$total_visitors = $this->Model_groups->TotalVisitors();
		$profile_actions = $this->Model_groups->profilesActions();
		$profile_upload_location = $this->Model_groups->profilesUploadsLocation();
		$this->data['profiles_uploads_location'] = $profile_upload_location;

		//profiles_upload array processing
		$profiles_upload_array = array_reverse($profiles_upload);
		
		$currentDate = new DateTime(); // Create a DateTime object for the current date
		$interval = new DateInterval('P90D'); // Create a DateInterval object for a period of 90 days
		$currentDate->sub($interval); // Subtract the 90-day interval from the current date
		$date90DaysAgo = $currentDate->format('Y-m-d');
		$first_date = date_create($date90DaysAgo);

		array_shift($profiles_upload_array);
		if (sizeof($profiles_upload_array) > 0) {
			$first_date_array = date_create($profiles_upload_array[0]['date']);
			if ($first_date_array < $first_date) {
				$first_date = $first_date_array;
			}

			$last_date = date_create(end($profiles_upload_array)['date']);
		} else {
			$last_date = new DateTime();
		}
		
		$date_range = new DatePeriod($first_date, new DateInterval('P1D'), $last_date->modify('+1 day'));

		// Initialize a new associative array with all dates and counts set to 0
		$new_profiles_data = array();
		foreach ($date_range as $date) {
			$new_profiles_data[] = array('date' => $date->format('Y-m-d'), 'uploads' => 0);
		}
		// Update the counts for dates that exist in the original array
		foreach ($profiles_upload_array as $entry) {
			$index = array_search($entry['date'], array_column($new_profiles_data, 'date'));
			$new_profiles_data[$index]['uploads'] = $entry['uploads'];
		}
		$this->data['profiles_uploads'] = $new_profiles_data;



		//Vendor signup array processing
		$vendor_signup_array = array_reverse($vendor_signup);
		$currentDate = new DateTime(); // Create a DateTime object for the current date
		$interval = new DateInterval('P90D'); // Create a DateInterval object for a period of 90 days
		$currentDate->sub($interval); // Subtract the 90-day interval from the current date
		$date90DaysAgo = $currentDate->format('d/m/Y');
		$first_date = date_create_from_format("d/m/Y", $date90DaysAgo);

		array_shift($vendor_signup_array);
		if (sizeof($vendor_signup_array) > 0) {
			$first_date_array = date_create_from_format("d/m/Y", $vendor_signup_array[0]['date']);
			if ($first_date_array < $first_date) {
				$first_date = $first_date_array;
			}

			$last_date = date_create_from_format("d/m/Y", end($vendor_signup_array)['date']);
		} else {
			$last_date = new DateTime();
		}
		$date_range = new DatePeriod($first_date, new DateInterval('P1D'), $last_date->modify('+1 day'));
		// Initialize a new associative array with all dates and counts set to 0
		$new_data = array();
		foreach ($date_range as $date) {
			$new_data[] = array('date' => $date->format('Y-m-d'), 'signups' => 0);
		}
		// Update the counts for dates that exist in the original array
		foreach ($vendor_signup_array as $entry) {
			$date1 = date_create_from_format("d/m/Y", $entry['date']);
			$date1_str = date_format($date1, "Y-m-d");
			$index = array_search($date1_str, array_column($new_data, 'date'));
			$new_data[$index]['signups'] = $entry['signups'];
		}
		$this->data['vendor_signups'] = $new_data;

		//Active Users array processing
		$active_users_array = array_reverse($Active_users);
		$currentDate = new DateTime(); // Create a DateTime object for the current date
		$interval = new DateInterval('P90D'); // Create a DateInterval object for a period of 90 days
		$currentDate->sub($interval); // Subtract the 90-day interval from the current date
		$date90DaysAgo = $currentDate->format('Y-m-d');
		$first_date = date_create($date90DaysAgo);
		if (sizeof($active_users_array) > 0) {
			$first_date_array = date_create($active_users_array[0]['date']);
			if ($first_date_array < $first_date) {
				$first_date = $first_date_array;
			}

			$last_date = date_create(end($active_users_array)['date']);
		} else {
			$last_date = new DateTime();
		}
		$date_range = new DatePeriod($first_date, new DateInterval('P1D'), $last_date->modify('+1 day'));
		// Initialize a new associative array with all dates and counts set to 0
		$new_active_user_data = array();
		foreach ($date_range as $date) {
			$new_active_user_data[] = array('date' => $date->format('Y-m-d'), 'new_logged_users' => 0, 'returning_logged_users' => 0);
		}
		// Update the counts for dates that exist in the original array
		foreach ($active_users_array as $entry) {
			$index = array_search($entry['date'], array_column($new_active_user_data, 'date'));
			$new_active_user_data[$index]['new_logged_users'] = $entry['new_logged_users'];
			$new_active_user_data[$index]['returning_logged_users'] = $entry['returning_logged_users'];
		}
		$this->data['active_users'] = $new_active_user_data;


		//Total Visitors array processing
		$total_visitors_array = array_reverse($total_visitors);
		$currentDate = new DateTime(); // Create a DateTime object for the current date
		$interval = new DateInterval('P90D'); // Create a DateInterval object for a period of 90 days
		$currentDate->sub($interval); // Subtract the 90-day interval from the current date
		$date90DaysAgo = $currentDate->format('Y-m-d');
		$first_date = date_create($date90DaysAgo);
		if (sizeof($total_visitors_array) > 0) {
			$first_date_array = date_create($total_visitors_array[0]['date']);
			if ($first_date_array < $first_date) {
				$first_date = $first_date_array;
			}

			$last_date = date_create(end($total_visitors_array)['date']);
		} else {
			$last_date = new DateTime();
		}
		$date_range = new DatePeriod($first_date, new DateInterval('P1D'), $last_date->modify('+1 day'));
		// Initialize a new associative array with all dates and counts set to 0
		$new_visitors_data = array();
		foreach ($date_range as $date) {
			$new_visitors_data[] = array('date' => $date->format('Y-m-d'), 'new_visitors' => 0, 'returning_visitors' => 0);
		}
		// Update the counts for dates that exist in the original array
		foreach ($total_visitors_array as $entry) {
			$index = array_search($entry['date'], array_column($new_visitors_data, 'date'));
			$new_visitors_data[$index]['new_visitors'] = $entry['new_visitors'];
			$new_visitors_data[$index]['returning_visitors'] = $entry['returning_visitors'];
		}
		$this->data['total_visitors'] = $new_visitors_data;


		//Profile actions array processing
		$profile_actions_array = array_reverse($profile_actions);
		$currentDate = new DateTime(); // Create a DateTime object for the current date
		$interval = new DateInterval('P90D'); // Create a DateInterval object for a period of 90 days
		$currentDate->sub($interval); // Subtract the 90-day interval from the current date
		$date90DaysAgo = $currentDate->format('Y-m-d');
		$first_date = date_create($date90DaysAgo);
		if (sizeof($profile_actions_array) > 0) {
			$first_date_array = date_create($profile_actions_array[0]['day']);
			if ($first_date_array < $first_date) {
				$first_date = $first_date_array;
			}

			$last_date = date_create(end($profile_actions_array)['day']);
		} else {
			$last_date = new DateTime();
		}
		$date_range = new DatePeriod($first_date, new DateInterval('P1D'), $last_date->modify('+1 day'));
		// Initialize a new associative array with all dates and counts set to 0
		$new_actions_data = array();
		foreach ($date_range as $date) {
			$new_actions_data[] = array('day' => $date->format('Y-m-d'), 'views' => 0, 'hires' => 0, 'shares' => 0, 'pdfs' => 0);
		}
		// Update the counts for dates that exist in the original array
		foreach ($profile_actions_array as $entry) {
			$index = array_search($entry['day'], array_column($new_actions_data, 'day'));
			$new_actions_data[$index]['views'] = $entry['views'];
			$new_actions_data[$index]['hires'] = $entry['hires'];
			$new_actions_data[$index]['shares'] = $entry['shares'];
			$new_actions_data[$index]['pdfs'] = $entry['pdfs'];
		}
		$this->data['profile_actions'] = $new_actions_data;


		$this->render_template('admin/analytics/index', $this->data);
	}

}