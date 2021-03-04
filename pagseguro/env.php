<?php

/*
Arquivo de configuração do ambiente
*/

$sandBox = 1;

if (!($sandBox)) {
	$emailPagseguro = "ybrasil@ybrasil.com.br";
	$tokenPagseguro = "116e34e8-3511-45d0-8499-f75017e5dd83bf28c603434f937fd580b3e9b29d050bad67-460a-4a45-958f-e9019ae20dd4";
	$urlNotificacao = "https://www.onmax.com.br/pagseguro/retornoPagamento.php";

	$scriptPagseguro = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
	$urlPagseguro = "https://ws.pagseguro.uol.com.br/v2/";

} else {
	$emailPagseguro = "gccamargo@gmail.com";
	$tokenPagseguro = "D89D0DCAAAAC47E39F5419AFC8D102BB";
	$urlNotificacao = "https://www.onmax.com.br/pagseguro/retornoPagamento.php";

	$scriptPagseguro = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
	$urlPagseguro = "https://ws.sandbox.pagseguro.uol.com.br/v2/";
}
