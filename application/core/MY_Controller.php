<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class MY_Controller extends CI_Controller {	

	public $show_header			= '_includes/header';
	public $show_top			= '_includes/top';
	public $show_left			= '_includes/left';
	public $show_main			= FALSE;
	public $show_main2			= FALSE;	//'_includes/main2';
	public $show_right			= '_includes/right';
	public $show_trocalinks		= '_includes/trocalinks'; // Faixa Troca de Links
	public $show_footer			= '_includes/footer';
	public $show_janela_modal	= '_includes/janela_modal';
	public $header_title		= 'Agência de modelo infantil Max Fama - A melhor agência de modelos infantis do Brasil';
	public $header_description	= 'A Max Fama é uma agencia de modelo infantil de São Paulo - SP que atua no mercado da moda desde 2002 e está entre as melhores agências de modelos infantis do Brasil.';
	public $router_class		= NULL;
	public $model				= NULL;
	public $login_required		= FALSE;    

    /**
     * @var Help_facebook
     */
    public $help_facebook = null;    

	public function __construct() {
        parent::__construct();		

		if($this->uri->segment(2) == 'baby'){
			$this->logo ='logo-maxfama-baby.png';
		} elseif($this->uri->segment(2) == 'kids') {
			$this->logo ='logo-maxfama-kids.png';
		} else {
			$this->logo ='logo-maxfama.png?';
		}		

		if($this->uri->segment(2) && (!in_array($this->uri->segment(2), array('trabalhos')))){
			if(!is_numeric($this->uri->segment(2))){			
				$this->filtro_area = $this->uri->segment(2);
				$this->filtro_pagina = $this->uri->segment(1);
			} else {
				$this->filtro_area = '';
				$this->filtro_pagina = $this->uri->segment(1);
			}
		} else {
			$this->filtro_area = '';
			$this->filtro_pagina = $this->uri->segment(1);
		}		

        // Verifica se o usuário está em uma página que exige login, se sim, tenta logar no Facebook.

        if($this->login_required) {		
			if($this->session->userdata('redirect')){
				$url_redirect = $this->session->userdata('redirect');	
				$this->session->sess_destroy('redirect');
				redirect(base_url().'cadastro');
			}
        }

        

		if($this->router_class === NULL) {

			$this->router_class = $this->router->class;

		}

		

		if($this->model === NULL) {

			$this->model = $this->router_class.'_model';

		}

		if($this->model !== FALSE) {

			$this->load->model($this->model);

		}

    }

	

	public function index() {	
		$this->config_pagination['type']				= 'web'; // 'web' ou 'admin'

		$this->config_pagination['model']				= $this->model;// Carrega automaticamente o model a partir do router->class

		$this->pagination->create_auto($this->config_pagination);

		$this->show_main	= $this->router_class.'_view';
	

		$this->load_template();

	}

	

	public function detalhes($idregistro, $titulo_seo = '') {

		$model = $this->model;

		$router_class = $this->router_class;

		

		$this->$router_class = $this->$model->getOne($idregistro);

		$this->show_main	= $this->router_class.'_detalhes_view';

		$this->load_template();

	}

	

	public function leia_mais($idregistro = NULL, $titulo_seo = '') {

		$model = $this->model;

		$router_class = $this->router_class;

		$primary_key = $this->$model->primary_key;

				

		if($idregistro == NULL) {

			$this->$router_class = $this->$model->getSome(1);

			$registros = $this->$router_class;

			$this->$router_class = @$registros[0];

			$idregistro = (int)@$this->$router_class->$primary_key;			

		} else {

			$this->$router_class = $this->$model->getOne($idregistro);

		}

		if($idregistro) {

			$this->$model->where = array_merge( $this->$model->where,array($primary_key.' <>' => $idregistro));

			$this->$router_class->leia_mais = $this->$model->getSome();

		}

		$this->show_main	= $this->router_class.'_detalhes_view';

		$this->load_template();

	}

	

	public function load_header() {

		

	}

	

	public function load_top() {

	}

	

	public function load_left() {

	}

	

	public function load_right() {

	}

	

	public function load_main() {

		

	}

	

	public function load_footer() {

		

	}

	

	public function load_template($data = NULL) {		
		
		if($this->show_header)	$this->load_header();
		if($this->show_top)		$this->load_top();
		if($this->show_left)	$this->load_left();
		if($this->show_right)	$this->load_right();
		if($this->show_main)	$this->load_main();
		if($this->show_footer)	$this->load_footer();	

		$this->load->view('_includes/template', $data);

	}

}



class MY_Controller_Admin extends CI_Controller {

	

	public $router_class		= NULL;

	public $titulo1				= NULL; // Nome do titulo da página ( Plural ). Usado na view principal.

	public $titulo2				= NULL; // Nome do titulo da página ( Singular ). Usado nas view criar e editar.

	public $show_main			= NULL;

	public $model				= NULL;

	public $login_required		= TRUE;

	

	//var $config_pagination = array();

	

	public function __construct() {

		parent::__construct();		

		

		$this->help->is_logged_in_admin($this->login_required);

		if($this->router_class === NULL) {

			$this->router_class = $this->router->class;

		}

		if($this->titulo1 === NULL) {

			$this->titulo1 = ucfirst($this->router_class);

		}

		if($this->titulo2 === NULL) {

			$this->titulo2 = $this->titulo1; // Singular

		}

		if($this->model === NULL) {

			$this->model = $this->router_class.'_model';

		}

		if($this->model !== FALSE) {

			$this->load->model('admin/'.$this->model);

		}		



		/*$this->load->model('admin/adm_usuarios_model');

		$idusuario = $this->session_admin['idusuario'];

		$this->menu = $this->adm_usuarios_model->montaMenuAdmin($idusuario);*/	

		

		$this->load->model('admin/menu_admin_model');

		$idusuario = $this->session_admin['idusuario'];

		$this->menu = $this->menu_admin_model->montaMenuAdmin($idusuario);

	}

	

	public function index() {

		$data['titulo'] = TITLE_SITE_ADMIN.$this->titulo1;

		

		$this->load->library('pagination');

		if($_GET) {

			foreach($_GET as $key=>$value) {

				$busca[$key] = $value;

			}

			$this->config_pagination['busca']			= $busca; // Passa os valores da busca para o model

		}

		$this->config_pagination['type']				= 'admin'; // 'web' ou 'admin'

		$this->config_pagination['model']				= $this->model;// Carrega automaticamente o model a partir do router->class

		$this->pagination->create_auto($this->config_pagination);

		

		if($this->show_main !== FALSE) {

			if($this->show_main === NULL) {

				$data['main_content'] = 'admin/'.$this->router_class.'_view';

			} else {

				$data['main_content'] = $this->show_main;

			}

		}

		$this->load_template($data);

	}

	

	public function buscar_action() {

		$url = false;

		foreach($this->input->post() as $key=>$value) {

			if($value) {

				if($key == 'busca_geral') {

					$url[$key] = $value;

				} elseif(substr($key,0, 7) == 'buscar_') {

					$url[substr($key, 7)] = $value;

				} elseif(substr($key,0, 6) == 'busca_') {

					$url[substr($key, 6)] = $value;

				}

			}

		}

		if($url) {

			foreach($url as $key=>$value) {

				$url_busca[] = $key.'='.$value;

			}

			$url_busca = implode('&',$url_busca);

			redirect(BASE_URL_ADMIN.'/'.$this->router->class.'/index?'.$url_busca);

		} else {

			redirect(BASE_URL_ADMIN.'/'.$this->router->class);

		}

	}

	

	public function inserir() {

		$data['action_form'] = $this->router->method;

		

		$data['titulo'] = TITLE_SITE_ADMIN.' '.$data['action_form'].' '.$this->titulo2;

		

		$model = $this->model;

		if($this->$model->getOne_show_tags) {

			$data['all_tags'] = $this->$model->getSomeTags();

		}

		

		if($this->show_main !== FALSE) {

			if($this->show_main === NULL) {

				$data['main_content'] = 'admin/'.$this->router_class.'_inserir_editar_view';

			} else {

				$data['main_content'] = $this->show_main;

			}

		}

		$this->load_template($data);

	}

	

	public function inserir_action() {

		$model = $this->model;

		$id = $this->$model->insertOne();

		

		redirect(BASE_URL_ADMIN.'/'.$this->router_class.'/editar/'.$id);

	}

	

	public function editar($id) {

		$data['action_form'] = $this->router->method;

		

		$router_class = $this->router_class;

		$data['titulo'] = TITLE_SITE_ADMIN.' '.$data['action_form'].' '.$this->titulo2;

		

		$model = $this->model;

		$this->$router_class = $this->$model->getOne($id);

		if($this->$model->getOne_show_tags) {

			$data['all_tags'] = $this->$model->getSomeTags();

		}

		

		if($this->show_main !== FALSE) {

			if($this->show_main === NULL) {

				$data['main_content'] = 'admin/'.$this->router_class.'_inserir_editar_view';

			} else {

				$data['main_content'] = $this->show_main;

			}

		}

		$this->load_template($data);

	}

	

	public function editar_action(){

		$model = $this->model;

		$id = $this->$model->updateOne();	

		

		redirect(BASE_URL_ADMIN.'/'.$this->router_class.'/editar/'.$id);

	}

	

	public function status($id,$status)	{

		$model = $this->model;

		$this->$model->updateStatus($id,$status);

		redirect(BASE_URL_ADMIN.'/'.$this->router_class);

	}

	

	public function update_status() {

		$model = $this->model;

		$this->$model->updateStatusOpcao();

	}

	

	public function load_template($data = NULL) {
		echo 2;
		exit;

		$data['router_class']	= $this->router_class;

		$data['model']			= $this->model;

		$model					= $data['model'];

		if($model) {

			$data['primary_key']	= $this->$model->primary_key;

		}

		

		$this->load->view('admin/_includes/template', $data);

	}

}