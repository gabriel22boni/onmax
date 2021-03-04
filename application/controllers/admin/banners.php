<?php
class Banners extends MY_Controller_Admin {
		
	function __construct() {
		parent::__construct();
		//Validacao para saber se usuario pode acessar a pagina	
		$this->load->model('admin/menu_admin_model');
		$this->menu_admin_model->validaAcessoPagina();
	}
	
	public function inserir(){
		$this->load->model('admin/tags_model');
		
		$busca['area'] = 'banner';
		$this->tags = $this->tags_model->getSome(NULL,NULL,$busca);
		
		parent::inserir();
	}
	
	public function editar($idregistro){
		$this->load->model('admin/tags_model');
		
		$busca['area'] = 'banner';
		$this->tags = $this->tags_model->getSome(NULL,NULL,$busca);
		
		parent::editar($idregistro);
	}
}