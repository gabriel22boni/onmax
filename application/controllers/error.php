<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller {
	
	public $model				= FALSE;
	public $show_left			= FALSE;
	public $show_right			= FALSE;
	
	public function __construct() {		
        parent::__construct();
		
		$this->banner = FALSE;
    }
	
	public function index()	{
		$this->show_main	= $this->router_class.'_view';
		$this->load_template();
	}
	
}