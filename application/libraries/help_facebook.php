<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help_facebook {
    const FRIENDS_TODOS = 1;
    const FRIENDS_BUSCA = 2;
    const FRIENDS_ANIVERSARIANDO_HOJE = 3;
    const FRIENDS_ANIVERSARIANDO_SEMANA = 4;
    const FRIENDS_ANIVERSARIANDO_MES = 5;
    
    
	
    /**
     * @var Facebook
     */
	public $fb = null;
    
    protected $_me = null;
    
    protected $myFriends = null;
    
    protected static $_instance = null;
    
    /**
     * @var DateTime
     */
    protected $_dateNow = null;
	
	public function __construct() {
		
		if ( !defined('__DIR__') ) define('__DIR__', dirname(__FILE__));
		
		require_once(__DIR__ . '/facebook/php-sdk/src/facebook.php');
        require_once(__DIR__ . '/../config/facebook.php');
        
		$this->fb = new Facebook(array(
			'appId'  => FB_APP_ID,
			'secret' => FB_APP_SECRET,
		));
        
        if($this->is_logged_in()) {
            $this->_me = $this->fb->api('/me');
            $_SESSION['user']['logged_in'] = 1;
        }
        
        // Mantém uma instância da classe atual gravada para o método de singleton.
        self::$_instance = $this;
        
        $this->_dateNow = new DateTime();
        $this->_dateNow->setTime(0, 0, 0);
	}
    
    public static function getInstance(){
        if(self::$_instance === null) {
            self::$_instance = new Help_facebook();
        }
        
        return self::$_instance;
    }
    
    public function setFbAccessToken($access_token){
        $this->fb->setAccessToken($access_token);
    }
	
    /**
     * Verifica se o usuário esta logado no face e retorna TRUE ou FALSE
     * @return object
     */
    public function is_logged_in() {
        return $this->fb->getUser();
	}
    
    /**
     * Redireciona o usuário para a tela de login com o Facebook se ele não estiver logado.
     */
    public function require_login(){
    	
		$CI =& get_instance();
		
        if(!$this->is_logged_in()) {
			
			// Grava em session qual e a url atual
			$url_atual = $CI->uri->uri_string;
			
			//Caso a pagina seja igual a do login nao grava a session de redirect
			if($url_atual != 'login'){
			$data = array( 'redirect' => TRUE );
			$CI->session->set_userdata($data);
			}
									
            $loginUrl = $this->fb->getLoginUrl(array(
                'scope' => 'publish_stream,user_birthday,email',
                'redirect_uri' => base_url().'login/session', //faz o redirect para outra pagina para criar a session e fazer o login no site
				'display'=>'popup'
            ));
            
            redirect($loginUrl);
        }
		
    }
    
    public function require_logout(){
        if($this->is_logged_in()) {
            $logoutUrl = $this->fb->getLogoutUrl(array(
                'next' => base_url(),
            ));
            
            $this->fb->destroySession();
            session_destroy();
            
            redirect($logoutUrl);
        }
    }
   	
    /**
     * Pega o Facebook ID do usuário atualmente logado.
     * @return int
     */
	public function getMyFbId() {
        return $this->_me['id'];
	}
	
	 /**
     * Pega o Facebook a data de aniversario do usuário atualmente logado.
     * @return int
     */
	public function getMyFbirthday() {
		$CI =& get_instance();
		$CI->load->library('help_datas');
        return $CI->help_datas->FormataData2($this->_me['birthday']);
	}
	
	/**
     * Pega o Facebook Email  do usuário atualmente logado.
     * @return int
     */
	public function getMyFbEmail() {
        return isset($this->_me['email']) ? $this->_me['email'] : '';
	}    
   
    /**
     * Pega o nome do usuário atual.
     */
    public function getMyName() {
        return $this->_me['name'];
    }
	
	/**
     * Pega o nome do usuário atual.
     */
    public function getMyGender()
    {
		if($this->_me['gender'] == 'male'){	
			$gender = 'Masculino';
		} elseif($this->_me['gender'] == 'female'){
			$gender = 'Feminino';
		} else { 
			$gender ='';
		}
        return $gender;
    }
	
	/**
     * Pega o nome do usuário atual.
     */
    public function getAll()
    {
		
        return $this->_me;
    }
	    
    /**
     * Pega o nome do usuário atual.
     */
    public function getMyAccessToken()
    {
        return $this->fb->getAccessToken();
    }
}