<?php

class Login_model extends CI_Model {

	public function validate() {
		$this->db->where('usuario', $this->input->post('usuario'));
		$this->db->where('senha', $this->input->post('senha'));
		$query = $this->db->get(PREF_TABLE.'admin');
		
		if($query->num_rows == 1) {
			return true;
		}
		
	}	
}