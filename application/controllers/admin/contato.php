<?php
class Contato extends MY_Controller_Admin {
	
	function __construct() {
		parent::__construct();
		//Validacao para saber se usuario pode acessar a pagina	
		$this->load->model('admin/menu_admin_model');
		$this->menu_admin_model->validaAcessoPagina();
	}
	
	public function exportar() {
		$model = $this->model;
		$router_class = $this->router_class;
		$this->$router_class = $this->$model->getSome();
		$data['router_class']	= $this->router_class;
		$data['model']			= $this->model;
		$this->load->view('admin/'.$router_class.'_exportar_view',$data);
	}
	
}