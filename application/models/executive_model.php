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
	public function get_all(){
		$query = $this->db->query("SELECT id, firstname FROM executive");
		return $query->result();
	}
	
	public function save_contributions($booking_id, $executive, $contribution){
		$this->db->insert('executive_client_unit_relation', array('booking_id'=>$booking_id, 'executive_id'=>$executive, 'contribution'=>$contribution));
	}
	public function remove_executive_contri($booking_id, $executive_id){
		if($this->db->query("DELETE FROM executive_client_unit_relation WHERE `booking_id` LIKE '$booking_id' && `executive_id` LIKE '$executive_id'")){
			return true;
		}else{
			return false;
		}
	}
	public function check_old_password_validity_for_user($userid, $password){
		$query = $this->db->query("SELECT password FROM executive WHERE id LIKE '$userid'");
		$array = $query->row();
		if($array->password==md5($password)){
			return 1;
		}else{
			return 0;
		}
	}
	public function update_password($userid, $password){
		$query = $this->db->query("UPDATE  `propertypistol`.`executive` SET  `password` =  '".md5($password)."' WHERE  `executive`.`id` =$userid;");
	}
	public function delete_for_booking($booking_id){
		$query = $this->db->query("DELETE FROM executive_client_unit_relation WHERE `booking_id` LIKE $booking_id ");
	}
}
?>