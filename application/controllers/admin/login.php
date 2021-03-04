<?php

class Login extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if($this->help->is_logged_in_admin(FALSE)) {
			redirect(BASE_URL_ADMIN);
		}
		$data['titulo'] = TITLE_SITE_ADMIN.'Login';
		$this->load->view('admin/login_view',$data);
	}
	
	public function do_login(){
		$data['titulo'] = TITLE_SITE_ADMIN.'Login';
		
		$this->load->model('admin/adm_usuarios_model');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('usuario');
		$this->form_validation->set_rules('senha');
		if ($this->form_validation->run() == FALSE){
			$this->load->view('admin/login_view',$data);
			exit;
		}
		
		//verifica no banco de dados se usuario e valido
		$login = (array)$this->adm_usuarios_model->validate_login();
			  
		if(count($login) > 0) {
			foreach ($login as $row){
				$data = array( 'admin' => array(
					'nome' => $row->nome,
					'usuario' => $row->usuario,
					'idusuario' => $row->id_adm_usuario ,
					'is_logged_in_admin' => true
				));
				$this->session->set_userdata($data);
				redirect(BASE_URL_ADMIN);
			}
		} else {
			//volta para a pagina de login informando que o usuario e senha sao invalidos
			$data['erro'] = 'Usu&aacute;rio ou senha inv&aacute;lidos';
			$this->load->view('admin/login_view',$data);
		}
	}
	
	public function logout() {
		$this->session->sess_destroy('admin');
		redirect(BASE_URL_ADMIN);
	}
}