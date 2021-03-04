<?php

class Home extends MY_Controller_Admin {
	
	public $model				= FALSE;
		
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$data['titulo'] = TITLE_SITE_ADMIN.$this->titulo1;
		
		$data['main_content'] = 'admin/'.$this->router_class.'_view';
		$this->load->view('admin/_includes/template', $data);
	}
}