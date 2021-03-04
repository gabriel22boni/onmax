<?php 
var_dump($_POST['notificationType']);
var_dump($_POST['notificationCode']);

//criamos o arquivo
$arquivo = fopen('meuarquivo.txt','w');
//verificamos se foi criado
if ($arquivo == false) die('Não foi possível criar o arquivo.');
//escrevemos no arquivo
$texto = $_POST['notificationType'] . ' - '.$_POST['notificationCode'];
fwrite($arquivo, $texto);
//Fechamos o arquivo após escrever nele
fclose($arquivo);

?>