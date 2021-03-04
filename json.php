<?php
$json = file_get_contents('http://maxsystem.azurewebsites.net/Model/GetModel?contractNumber=51788');

var_dump($json);

?>