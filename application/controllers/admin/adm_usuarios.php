<?php
class Adm_usuarios extends MY_Controller_Admin {
		
	public $titulo1				= 'Usuários'; // Nome do titulo da página ( Plural ). Usado na view principal.
		
	function __construct() {
		parent::__construct();
		//Validacao para saber se usuario pode acessar a pagina	
		$this->load->model('admin/menu_admin_model');
		$this->menu_admin_model->validaAcessoPagina();
	}
}