<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagamento extends MY_Controller {
	
	public $show_left			= FALSE;
	public $show_right			= FALSE;
	public $login_required		= TRUE;
	public $model 				= FALSE;
	
	public function __construct() {		
		parent::__construct();
		$this->trocalink = TRUE; // Exibir logo abaixo do Banner
    }
	
	public function index($plano = false) {

		if($plano != 'premium' && $plano != 'diamante'){
			redirect(base_url());
		}
		
		$this->plano = $plano; 

		$this->show_main	= $this->router_class.'_view';
		$this->load_template();
	}

	public function getSessionaHash(){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URLPAGSEGURO . 'sessions?email=' . EMAILPAGSEGURO . '&token=' . TOKENPAGSEGURO);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, true);

		$data = curl_exec($ch);
		$xml = new SimpleXMLElement($data);

		echo $xml->id;
		curl_close($ch);
	}

	public function pagamentoCartao(){

		$_POST['cpf'] = str_replace(".", "", $_POST['cpf']);
		$_POST['cpf'] = str_replace("-", "", $_POST['cpf']);

		$_POST['cardCPF'] = str_replace(".", "", $_POST['cardCPF']);
		$_POST['cardCPF'] = str_replace("-", "", $_POST['cardCPF']);

		$valor = $_POST['valorTotal'];
		$valor = str_replace(",", ".", $valor);
		$valor = number_format($valor, 2, '.', '');

		if (!(isset($_POST['valorParcelas'])) || empty($_POST['valorParcelas'])) {
			$_POST['valorParcelas'] = $valor;
		}

		if (!(isset($_POST['numParcelas'])) || empty($_POST['numParcelas'])) {
			$_POST['numParcelas'] = 1;
		}


		$_POST['valorParcelas'] = (number_format($_POST['valorParcelas'], 2));
		$_POST['valorParcelas'] = str_replace(",", ".", $_POST['valorParcelas']);

		$_POST['numParcelas'] = intval($_POST['numParcelas']);

		$xml = $this->gerarXmlCartao(
			$_POST['id'],
			$_POST['descricao'], 
			$valor,
			$_POST['nome'], 
			$_POST['cpf'], 
			$_POST['ddd'], 
			$_POST['telefone'], 
			$_POST['email'], 
			$_POST['senderHash'],
			$_POST['endereco'], 
			$_POST['numero'], 
			$_POST['complemento'], 
			$_POST['bairro'], 
			$_POST['cep'], 
			$_POST['cidade'], 
			$_POST['estado'], 
			$_POST['enderecoPagamento'], 
			$_POST['numeroPagamento'], 
			$_POST['complementoPagamento'], 
			$_POST['bairroPagamento'],
			$_POST['cepPagamento'], 
			$_POST['cidadePagamento'], 
			$_POST['estadoPagamento'], 
			$_POST['cardToken'], 
			$_POST['cardNome'], 
			$_POST['cardCPF'], 
			$_POST['cardNasc'], 
			$_POST['cardFoneArea'], 
			$_POST['cardFoneNum'], 
			$_POST['numParcelas'], 
			$_POST['valorParcelas']
		);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, URLPAGSEGURO . "transactions/?email=" . EMAILPAGSEGURO . "&token=" . TOKENPAGSEGURO);
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));
		
		$data = curl_exec($ch);
		$dataXML = simplexml_load_string($data);
		
		header('Content-Type: application/json; charset=UTF-8');
		echo json_encode($dataXML);
			 
		curl_close($ch);

	}

	public function gerarXmlCartao($id, $produto, $valor, $nome, $cpf, $ddd, $telefone, $email, $senderHash, $endereco, $numero, $complemento, $bairro, $cep, $cidade, $estado, $enderecoPagamento, $numeroPagamento, $complementoPagamento, $bairroPagamento, $cepPagamento, $cidadePagamento, $estadoPagamento, $cardToken, $holdCardNome, $holdCardCPF, $holdCardNasc, $holdCardArea, $holdCardFone, $parcelas, $valorParcelas, $urlNotificacao) {
		return "<payment>
		<mode>default</mode>
		<currency>BRL</currency>
		<notificationURL>" . URLNOTIFICACAO . "</notificationURL>
		<receiverEmail>" . $emailPagseguro . "</receiverEmail>
		<sender>
		  <hash>". $senderHash . "</hash>
		  <ip>" . $_SERVER['REMOTE_ADDR'] . "</ip>
		  <email>". $email . "</email>
		  <documents>
			<document>
			  <type>CPF</type>
			  <value>" . $cpf . "</value>
			</document>
		  </documents>
		  <phone>
			<areaCode>" . $ddd . "</areaCode>
			<number>" . $telefone . "</number>
		  </phone>
		  <name>" . $nome . "</name>
		</sender>
		<creditCard>
		  <token>". $cardToken ."</token>
		  <holder>
			<name>" . $holdCardNome . "</name>
			<birthDate>" . $holdCardNasc ."</birthDate>
			  <documents>
				<document>
				  <type>CPF</type>
				  <value>" . $holdCardCPF . "</value>
				</document>
			  </documents>
			<phone>
			  <areaCode>" . $ddd . "</areaCode>
			  <number>" . $telefone . "</number>
			</phone>
		  </holder>
		  <billingAddress>
			  <street>" . $enderecoPagamento . "</street>
			  <number>" . $numeroPagamento . "</number>
			  <complement>" . $complementoPagamento . "</complement>
			  <district>" . $bairroPagamento . "</district>
			  <city>" . $cidadePagamento . "</city>
			  <state>" . $estadoPagamento . "</state>
			  <postalCode>" . $cepPagamento . "</postalCode>
			  <country>BRA</country>
		  </billingAddress>
		  <installment>
			<quantity>" . $parcelas . "</quantity>
			<value>" . $valorParcelas . "</value>
			<noInterestInstallmentQuantity>2</noInterestInstallmentQuantity>
		  </installment>
		</creditCard>
		<items>
		  <item>
			<id>" . $id . "</id>
			<description>" . $produto . "</description>
			<amount>" . $valor . "</amount>
			<quantity>1</quantity>
		  </item>
		</items>
		<reference>" . $id . "</reference>
		<shipping>
		  <address>
			<street>" . $endereco . "</street>
			<number>" . $numero . "</number>
			<complement>" . $complemento . "</complement>
			<district>" . $bairro . "</district>
			<city>" . $cidade . "</city>
			<state>" . $estado . "</state>
			<country>BRA</country>
			<postalCode>" . $cep . "</postalCode>
		  </address>
		  <type>1</type>
		  <cost>0.00</cost>
		  <addressRequired>true</addressRequired>
		</shipping>
		<extraAmount>0.00</extraAmount>
		<method>creditCard</method>
		<dynamicPaymentMethodMessage>
		  <creditCard>infoEnem</creditCard>
		  <boleto>infoEnem</boleto>
		</dynamicPaymentMethodMessage>
	  </payment>";
	  }

	public function getStatus(){

		sleep(5);
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, URLPAGSEGURO . "transactions/". $_POST['id'] . "?email=". EMAILPAGSEGURO . "&token=" . TOKENPAGSEGURO);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$dataXML = simplexml_load_string($data);

		header('Content-Type: application/json; charset=UTF-8');
		$data = (json_encode($dataXML));

		echo (json_decode($data)->status);
		curl_close($ch);

	}

	public function busca_cep(){  
		// formatar o cep removendo caracteres nao numericos
		$cep = preg_replace("/[^0-9]/", "", $_POST['cep']);
		$url = "http://viacep.com.br/ws/$cep/xml/";
		$xml = simplexml_load_file($url);

		echo json_encode($xml[0]);
	}  

	public function retorno(){

		/*- idtransacao
		- nomecliente
		- emailcliente
		- statustransacao
		- valortransacao*/

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, URLPAGSEGURO . "transactions/notifications/BD9D2D-58F53CF53C2A-FDD4897F81A4-28554E?email=". EMAILPAGSEGURO . "&token=" . TOKENPAGSEGURO);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml; charset=ISO-8859-1'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$data = curl_exec($ch);
		$dataXML = simplexml_load_string($data);

		header('Content-Type: application/json; charset=UTF-8');
		$data = (json_encode($dataXML));

		echo $data;
		curl_close($ch);

		$name = 'arquivo.txt';
		$text = var_export($_POST, true);
		$file = fopen($name, 'a');
		fwrite($file, $text);
		fclose($file);



	}

}