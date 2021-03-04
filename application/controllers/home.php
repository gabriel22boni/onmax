<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public $show_left			= FALSE;
	public $show_right			= FALSE;
	public $model				= FALSE;
	public $login_required		= TRUE;
	public $show_trocalinks		= FALSE; // Tira do Rodapé na pagina Home
	
	public function __construct() {	
        parent::__construct();		
		$this->banner = TRUE;
    }
	
	public function index($idcategoria = FALSE) {		
		$this->load->library('helps');	
		$this->show_main	= $this->router_class.'_view';
		$this->load_template();		
	}

	public function login(){
		redirect(base_url().'login');
	}
}