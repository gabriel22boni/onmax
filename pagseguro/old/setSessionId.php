<?php

require "pagseguro/Checkout.class.php";

$checkout = new Checkout();
$URL_JS_PAGSEGURO = $checkout->pagSeguroData->getJavascriptURL();
echo $checkout->printSessionId();


?>