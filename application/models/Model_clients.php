<?php 

class Model_clients extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    public function create($data = '')
	{

		$create = $this->db->insert('clients', $data);
        if ($create) {
            // Get the ID of the inserted row
            $id = $this->db->insert_id();

            // Generate the client_id value
            $unique_id = 'T' . $id. 'C';


            // Update the row with the generated jd_id and url values
            $this->db->where('id', $id);
            $this->db->update('clients', array('unique_id' => $unique_id));

            // Return true to indicate successful creation
            return true;
		}
	}

	public function getClientData($userId = null) 
	{
		if($userId) {
			$sql = "SELECT * FROM clients WHERE id = ?";
			$query = $this->db->query($sql, array($userId));
			return $query->row_array();
		}

		$sql = "SELECT * FROM clients  ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function edit($data = array(), $id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('clients', $data);			
		return ($update == true) ? true : false;	
	}

	public function getClientEmail($email = null) 
	{
		if($email) {
			$sql = "SELECT id,name,email,password FROM clients Where email = ? LIMIT 1";
			$query = $this->db->query($sql ,array($email));
			return $query->row_array();
		}
	}

	public function getStoresDataExtra($id = null)
	{
		if ($id) {
			$sql = "SELECT * FROM clients WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM clients;";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}