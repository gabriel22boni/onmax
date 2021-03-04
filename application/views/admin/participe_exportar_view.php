<?php
// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; exportar_participe.xls" );
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
          <td width="137" bgcolor="#CCCCCC"><strong>Facebook ID</strong></td>
          <td width="155" bgcolor="#CCCCCC"><strong>Nascimento</strong></td>
          <td width="103"  bgcolor="#CCCCCC"><strong>Sexo</strong></td>
          <td width="103"  bgcolor="#CCCCCC"><strong>E-mail</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Telefone</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Celular</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>O que gosta de fazer nas horas livres?</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Profiss&atilde;o</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>CEP</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Rua</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Numero</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Complemento</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Bairro</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Cidade</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Estado</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Sua Id&eacute;ia</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Data Cadastro</strong></td>
        </tr>
        <?php if($this->$router_class){ foreach($this->$router_class as $row) :?>
          <tr style="font-size:12px; color:#000;">
            <td><?php echo utf8_decode($row->nome); ?></td>
            <td><?php if($row->fb_id == '0') { echo ' - '; } else { echo $row->fb_id; } ?></td>
            <td><?php echo utf8_decode($row->nascimento); ?></td>
            <td><?php echo utf8_decode($row->telefone); ?></td>
            <td><?php echo utf8_decode($row->email); ?></td>
            <td><?php echo utf8_decode($row->telefone); ?></td>
            <td><?php echo utf8_decode($row->celular); ?></td>
            <td><?php echo utf8_decode($row->hora_livre); ?></td>
            <td><?php echo utf8_decode($row->profissao); ?></td>
            <td><?php echo utf8_decode($row->cep); ?></td>
            <td><?php echo utf8_decode($row->rua); ?></td>
            <td><?php echo utf8_decode($row->numero); ?></td>
            <td><?php echo utf8_decode($row->complemento); ?></td>
            <td><?php echo utf8_decode($row->bairro); ?></td>
            <td><?php echo utf8_decode($row->cidade); ?></td>
            <td><?php echo utf8_decode($row->estado); ?></td>
            <td><?php echo utf8_decode($row->sua_ideia); ?></td>
            <td><?php echo utf8_decode($row->dateinsert); ?></td>
          </tr>
        <?php endforeach; } ?>
	  </table>    
    </td>
  </tr>
</table>