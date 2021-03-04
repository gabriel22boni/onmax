<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagamento_efetuado extends MY_Controller {
	
	public $show_left			= FALSE;
	public $show_right			= FALSE;
	public $login_required		= TRUE;
	public $model 				= FALSE;
	
	public function __construct() {		
		parent::__construct();
		//$this->trocalink = TRUE; // Exibir logo abaixo do Banner
    }
	
	public function index($email = "vazio") {
		
		$arroba = "@";
		$hash = "66123403347";
		
		$emailDecoded = str_replace($hash, $arroba, $email);
		log_message('info', 'email: '.$emailDecoded);

		$data = array(
			'email' => $emailDecoded,
		);

		$this->show_main	= $this->router_class.'_view';
		$this->load_template($data);
	}

}