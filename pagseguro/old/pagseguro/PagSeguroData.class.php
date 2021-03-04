<?php
	
	class PagSeguroData {
		
		private $sandbox;
		
		private $sandboxData = Array(
			
			'credentials' => array(
				"email" => "financeiro@ltxdesign.com.br",
				"token" => ""
			),
			
			'sessionURL' => "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions",
			'transactionsURL' => "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions",
			'javascriptURL' => "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"
		);
		
		private $productionData = Array(
			
			'credentials' => array(
				"email" => 'ybrasil@ybrasil.com.br',
				"token" => '116e34e8-3511-45d0-8499-f75017e5dd83bf28c603434f937fd580b3e9b29d050bad67-460a-4a45-958f-e9019ae20dd4'
			),
			
			'sessionURL' => "https://ws.pagseguro.uol.com.br/v2/sessions",
			'transactionsURL' => "https://ws.pagseguro.uol.com.br/v2/transactions",
			'javascriptURL' => "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"
			
		);
		

		public function __construct() { // MODOPAG

			$this->sandboxData['credentials']['email'] = 'ybrasil@ybrasil.com.br';
			$this->sandboxData['credentials']['token'] = '116e34e8-3511-45d0-8499-f75017e5dd83bf28c603434f937fd580b3e9b29d050bad67-460a-4a45-958f-e9019ae20dd4';

			$this->productionData['credentials']['email'] = 'ybrasil@ybrasil.com.br';
			$this->productionData['credentials']['token'] = '116e34e8-3511-45d0-8499-f75017e5dd83bf28c603434f937fd580b3e9b29d050bad67-460a-4a45-958f-e9019ae20dd4';

			//cho $this->sandboxData['credentials']['token'];
			//echo getStatic('pag_pagseguro_modo');
			$this->sandbox = (bool)false;	
			/*if(getStatic('pag_pagseguro_modo') == 'production'){
				$this->sandbox = (bool)false;	
			}else{
				$this->sandbox = (bool)true;
			}*/

			//$this->sandbox = (bool)$sandbox;
			//echo $this->sandbox;

		}

		// public function __construct($sandbox = false) {
		// 	$this->sandbox = (bool)$sandbox;
		// }
		
		private function getEnviromentData($key) {
			/*if ($this->sandbox) {
				return $this->sandboxData[$key];
			} else {
				return $this->productionData[$key];
			}*/
			return $this->productionData[$key];
		}
		
		public function getSessionURL() {
			return $this->getEnviromentData('sessionURL');
		}
		
		public function getTransactionsURL() {
			return $this->getEnviromentData('transactionsURL');
		}
		
		public function getJavascriptURL() {
			return $this->getEnviromentData('javascriptURL');
		}
		
		public function getCredentials() {
			return $this->getEnviromentData('credentials');
		}
		
		public function isSandbox() {
			return (bool)$this->sandbox;
		}
		
	}
	
?>