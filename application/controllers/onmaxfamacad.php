<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Onmaxfamacad extends MY_Controller {
	
	public $show_left			= FALSE;
	public $show_right			= FALSE;
	public $login_required		= TRUE;
	
	public function __construct() {		
        parent::__construct();
		
		$this->banner = FALSE;
    }
	
	public function index(){

		
		parent::index();
	}
	
}