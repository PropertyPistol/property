<?php
	/**
	* 
	*/
class Executive_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function authenticate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->db->where('username', $username);
		$query = $this->db->get('executive');
		if ($query->num_rows() == 1)
		{
		   $array = $query->row(); 
		   if($array->password == md5($password)){
		   		$this->session->set_userdata(array('username'=>$username, 'userid'=>"$array->id", 'name'=>"$array->firstname", 'is_admin'=>"$array->is_admin"));
		   		return TRUE;
		   }
		}
		else{
			return FALSE;
		}
	}
}
?>