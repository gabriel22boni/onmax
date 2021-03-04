<?php
// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; exportar_contatos.xls" );
header ("Content-Description: PHP Generated Data" );
?>
<style type="text/css">
body {
	font-size:11px;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
}
</style>
<table width="100%" border="0" cellpadding="0" cellspacing="0">  
  <tr>
    <td align="left">   
      <table width="100%" border="1" cellpadding="3" cellspacing="0">
         <tr>
          <td width="137" bgcolor="#CCCCCC"><strong>Nome</strong></td>
          <td width="155" bgcolor="#CCCCCC"><strong>E-mail</strong></td>
          <td width="103"  bgcolor="#CCCCCC"><strong>Telefone</strong></td>
          <td width="103"  bgcolor="#CCCCCC"><strong>Assunto</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Mensagem</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Data da mensagem</strong></td>
        </tr>
        <?php if($this->$router_class){ foreach($this->$router_class as $row) :?>
          <tr style="font-size:12px; color:#000;">
            <td><?php echo $row->nome; ?></td>
            <td><?php echo utf8_decode($row->email); ?></td>
            <td><?php echo utf8_decode($row->telefone); ?></td>
            <td><?php echo utf8_decode($row->assunto); ?></td>
            <td><?php echo $row->mensagem; ?></td>
            <td><?php echo $row->dateinsert; ?></td>
          </tr>
        <?php endforeach; } ?>
	  </table>    
    </td>
  </tr>
</table>