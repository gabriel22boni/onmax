<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contato extends MY_Controller {

	public $show_left			= FALSE;
	public $show_right			= FALSE;
	public $login_required		= TRUE;

	public function __construct() {		
        parent::__construct();
		$this->banner = FALSE;
		//$this->trocalinks = FALSE;

    }

	public function index() {
		$this->show_main	= $this->router_class.'_view';
		$this->load_template();

	}

	public function enviar() {

		$nome = $this->input->post('nome');
	    $email = $this->input->post('email');
	    $recaptchaResponse = $this->input->post('g-recaptcha-response');
	    $secret = '6Le92s0ZAAAAALksgjmSOjV-Z7ydpAHRBh9crvWn';
	    $url = 'https://www.google.com/recaptcha/api/siteverify';
	    $data1 = array('secret' => $secret, 'response' => $recaptchaResponse);
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	    $response = curl_exec($ch);
	    curl_close($ch);
	    $status = json_decode($response, true);

	    if ($status['success']){

			$this->contato_model->insertOne();
			//$this->load->model('paginas_model');
	        //$this->email = $this->paginas_model->getSome(NULL,NULL,array('area'=>'gerenciar_email'));

	        $this->load->library('My_PHPMailer');

	        $mail = new PHPMailer();
	        $mail->IsSMTP();                                      // Set mailer to use SMTP
	        $mail->Host = 'mail.maxfama.com.br';                 // Specify main and backup server
	        $mail->Port = 587;                                    // Set the SMTP port
	        $mail->SMTPAuth = true;                               // Enable SMTP authentication
	        $mail->Username = 'webmasters@maxfama.com.br';                // SMTP username
	        $mail->Password = 'orange1000*';                  // SMTP password
	        //$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
	        //$mail->SMTPDebug = 1;

	        $mail->From = MAIL_FROM;
	        $mail->FromName = 'Contato MaxFama';
	        $mail->AddAddress(MAIL_TO, 'Contato MaxFama');  // Add a recipient              // Name is optional

	        $mail->IsHTML(true);                                  // Set email format to HTML
	        $mail->Subject = 'Contato - MaxFama';
	        $mail->Body    = '<b>Contato feito no site</b> <br>
			  -------------------------------------------------------------------- <br> 
			  <strong>Nome</strong>:   '.trim($this->input->post('nome')).' <br />
			  <strong>Email</strong>:    '.trim($this->input->post('email')).'<br />
			  <strong>Telefone</strong>:    '.trim(utf8_decode($this->input->post('telefone'))).'<br />
			  <strong>Assunto</strong>:    '.trim(utf8_decode($this->input->post('assunto'))).'<br />
			  <strong>Mensagem</strong>:    '.utf8_decode($this->input->post('mensagem')).'<br/>
			  -------------------------------------------------------------------- <br />
			  <p>Essa &eacute; uma mensagem autom&aacute;tica favor n&atilde;o responder esse email.<br/>';

		 	if($mail->Send()) {
	          $data = array( 'success_messages_front' => 'Mensagem enviada com sucesso');
	          $this->session->set_userdata($data); 
	          redirect(base_url().'contato');   

	        }else {
	          $data = array( 'alert_messages_front' => 'Erro ao enviar a mensagem, favor tentar novamente.');
	          $this->session->set_userdata($data);
	          redirect(base_url().'contato');   

	        }

        }else{
			$data = array( 'alert_messages_front' => 'Erro ao enviar a mensagem, favor confirmar o reCaptcha.');
	        $this->session->set_userdata($data);
			redirect(base_url().'contato');
		}

	}


	public function login(){

		redirect(base_url().'login');

	}

}