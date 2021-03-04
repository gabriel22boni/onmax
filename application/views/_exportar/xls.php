<?php
header('Content-type: application/vnd.ms-excel');
header('Content-type: application/force-download');
header('Content-Disposition: attachment; filename='.$titulo.'.xls');
header('Pragma: no-cache');
?>