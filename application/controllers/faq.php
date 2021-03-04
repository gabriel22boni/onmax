<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends MY_Controller {
	
	public $show_left			= FALSE;
	public $show_right			= FALSE;
	public $login_required		= TRUE;
	
	public function __construct() {		
        parent::__construct();
		
		$this->banner = FALSE;

		// Mercadopago conforme GITHub
		/*$CI = &get_instance();
	    $CI->config->load("mercadopago", TRUE);
	    $config = $CI->config->item('mercadopago');
	    $this->load->library('Mercadopago', $config); */


    }
	
	public function index(){


		
		parent::index();
	}
	
}