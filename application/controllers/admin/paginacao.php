<?php
class Paginacao extends CI_Controller {
		
	function __construct() {
		parent::__construct();
	}
	
	function index($per_page = NULL) {
		$this->session->sess_destroy('paginacao');
		
		if($per_page != NULL) {
			$data = array( 'paginacao' => array(
				'PER_PAGE_ADMIN' => $per_page
			));
			$this->session->set_userdata($data);
		}
		if($this->input->post('per_page') != NULL) {
			$data = array( 'paginacao' => array(
				'PER_PAGE_ADMIN' => $this->input->post('per_page')
			));
			$this->session->set_userdata($data);
		}
	}
}