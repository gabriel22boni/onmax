<?php
class Imagem extends MY_Controller_Admin {
		
	function __construct() {
		parent::__construct();
		//Validacao para saber se usuario pode acessar a pagina	
		$this->load->model('admin/menu_admin_model');
		$this->menu_admin_model->validaAcessoPagina();
	}
}