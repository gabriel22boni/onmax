<?php
	
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
	
	require_once "HttpConnection.class.php";
	require_once "XmlParser.class.php";
	require_once "PagSeguroData.class.php";



	class Checkout {
		
		public $pagSeguroData;
		
		// troca sandbox
		public function __construct() {
			$this->pagSeguroData = new PagSeguroData();
		}
		
		public function showTemplate() {
			$isSandbox = $this->pagSeguroData->isSandbox();
			//require 'templates/checkout.php';
			//exit();
		}
		
		
		public function printSessionId() {
			
			// Creating a http connection (CURL abstraction)
			$httpConnection = new HttpConnection();

			print_r($this->pagSeguroData->getCredentials());
			
			// Request to PagSeguro Session API using Credentials
			$httpConnection->post($this->pagSeguroData->getSessionURL(), $this->pagSeguroData->getCredentials());
			
			// Request OK getting the result
			if ($httpConnection->getStatus() === 200) {
				
				$data = $httpConnection->getResponse();
				
				$sessionId = $this->parseSessionIdFromXml($data);
				
				echo $sessionId;
				
			} else {
				
				throw new Exception("API Request Error: ".$httpConnection->getStatus());
				
			}
			
		}
		
		public function getSessionId() {
			
			// Creating a http connection (CURL abstraction)
			$httpConnection = new HttpConnection();
			
			// Request to PagSeguro Session API using Credentials
			$httpConnection->post($this->pagSeguroData->getSessionURL(), $this->pagSeguroData->getCredentials());
			
			// Request OK getting the result
			if ($httpConnection->getStatus() === 200) {
				
				$data = $httpConnection->getResponse();
				
				$sessionId = $this->parseSessionIdFromXml($data);
				
				return $sessionId;
				
			} else {
				
				throw new Exception("API Request Error: ".$httpConnection->getStatus());
				
			}
			
		}		
		
		public function doPayment($params) {
			$CHAVE = HASH;

			$params = array_map('utf_DE_All', $params);

			//$params['shippingAddressStreet'] = slug($params['shippingAddressStreet']);
			//$params['senderName'] = slug($params['senderName']);

			$params['senderCPF'] = preg_replace('/\D/', '', $params['senderCPF']);
			$params['senderAreaCode'] = preg_replace('/\D/', '', $params['senderAreaCode']);
			$params['senderPhone'] = preg_replace('/\D/', '', $params['senderPhone']);
			$params['shippingAddressPostalCode'] = preg_replace('/\D/', '', $params['shippingAddressPostalCode']);

			$params['cardNumber'] = preg_replace('/\D/', '', $params['cardNumber']);
			$params['cardCvv'] = preg_replace('/\D/', '', $params['cardCvv']);
			
			$params['creditCardHolderCPF'] = preg_replace('/\D/', '', $params['creditCardHolderCPF']);
			$params['creditCardHolderAreaCode'] = preg_replace('/\D/', '', $params['creditCardHolderAreaCode']);
			$params['creditCardHolderPhone'] = preg_replace('/\D/', '', $params['creditCardHolderPhone']);
			$params['billingAddressPostalCode'] = preg_replace('/\D/', '', $params['billingAddressPostalCode']);

			$params['shippingAddressState'] = strtoupper($params['shippingAddressState']);
			$params['billingAddressState'] = strtoupper($params['billingAddressState']);

			$params['notificationURL'] = CP.'/__recebePagseguro.php';

			$params['itemAmount1'] = $_SESSION['valor_venda'][$CHAVE];
			// Adding parameters
			
			$params += $this->pagSeguroData->getCredentials(); // add credentials
			$params['paymentMode'] = 'default'; // paymentMode
			$params['currency'] = 'BRL'; // Currency (only BRL)
			$params['reference'] = 'sysX_'.$CHAVE; // Setting the Application Order to Reference on PagSeguro

			// treat parameters here!
			$httpConnection = new HttpConnection();
			$httpConnection->post($this->pagSeguroData->getTransactionsURL(), $params);
			
			// Get Xml From response body
			$xmlArray = $this->paymentResultXml($httpConnection->getResponse());

			// Setting http status and show json as result
			//http_response_code($httpConnection->getStatus());
			header("HTTP/1.1 ".$httpConnection->getStatus());
			
			//$_SESSION['dadosVendaStatus'] = $params['paymentMethod'];
				
			echo json_encode($xmlArray);
			
		}
		
		private function parseSessionIdFromXml($data) {
			
			// Creating an xml parser 
			$xmlParser = new XmlParser($data);
			
			// Verifying if is an XML
			if ($xml = $xmlParser->getResult("session")) {
				
				// Retrieving the id from "session node"
				return $xml['id'];
				
			} else {
				throw new Exception("[$data] is not an XML");
			}
			
		}
		
		
		private function paymentResultXml($data) {
			
			// Creating an xml parser 
			$xmlParser = new XmlParser($data);
			
			// Verifying if is an XML
			if ($xml = $xmlParser->getResult()) {
				return $xml;
			} else {
				throw new Exception("[$data] is not an XML");
			}
			
		}
		
		
		
	}
	
?>