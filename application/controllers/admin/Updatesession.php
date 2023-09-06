<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateSession extends Admin_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
    
    public function setNewSession() 
    {
        // Make sure it's an AJAX request
        if (!$this->input->is_ajax_request()) {
          show_404(); // Return a 404 response if it's not an AJAX request
        }
        
        // Get the JSON data from the AJAX request
        $showPopup = $this->input->post('showPopup');
    
        
        // Check if the new value has been received from the client through the AJAX request.
        // session_start();
        
        // Update the session variable based on your session variable name.
        $_SESSION['showPopup'] = $showPopup;

    
        // Return a response (optional)
        $response = array('status' => 'success', 'message' => 'Data received successfully.', 'showPopup' => $showPopup);
        header('Content-Type: application/json');
        echo json_encode($response);
   }

}
?>
