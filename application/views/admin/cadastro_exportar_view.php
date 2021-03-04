<?php
// Configurações header para forçar o download
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/x-msexcel");
header ("Content-Disposition: attachment; exportar_cadastrados.xls" );
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
          <td width="50" bgcolor="#CCCCCC"><strong>Sexo</strong></td>
          <td width="50"  bgcolor="#CCCCCC"><strong>Data de Nascimento</strong></td>
          <td width="103"  bgcolor="#CCCCCC"><strong>Respons&aacute;vel (se menor)</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>CEP</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Endere&ccedil;o</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>N&uacute;mero</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Complemento</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Bairro</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Cidade</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Estado</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>E-mail</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Telefone Fixo</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Telefone M&oacute;vel</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Altura</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Peso</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Sapato</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Manequim</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Cabelo</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Tipo de Cabelo</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Pelo</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Olhos</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Habilidades</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Mensagem</strong></td>
          <td width="200"  bgcolor="#CCCCCC"><strong>Como voc&ecirc; conheceu a MaxFama?</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Foto 1</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Foto 2</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Foto 3</strong></td>
          <td width="200"   bgcolor="#CCCCCC"><strong>Data da mensagem</strong></td>
        </tr>
        <?php if($this->$router_class){ foreach($this->$router_class as $row) :?>
          <tr style="font-size:12px; color:#000;">
            <td><?php echo utf8_decode($row->nome); ?></td>
            <td><?php if($row->fb_id){ echo 'http://www.facebook.com/'.$row->fb_id; } ?></td>
            <td><?php echo $row->sexo; ?></td>
            <td><?php echo $row->data_nascimento; ?></td>
            <td><?php echo $row->responsavel; ?></td>
            <td><?php echo $row->cep; ?></td>
            <td><?php echo $row->endereco; ?></td>
            <td><?php echo $row->numero; ?></td>
            <td><?php echo $row->complemento; ?></td>
            <td><?php echo $row->bairro; ?></td>
            <td><?php echo $row->cidade; ?></td>
            <td><?php echo $row->estado; ?></td>
            <td><?php echo $row->email; ?></td>
            <td><?php echo $row->telefone_fixo; ?></td>
            <td><?php echo $row->telefone_movel; ?></td>
            <td><?php echo $row->altura; ?></td>
            <td><?php echo $row->peso; ?></td>
            <td><?php echo $row->sapato; ?></td>
            <td><?php echo $row->manequim; ?></td>
            <td><?php echo $row->cabelo; ?></td>
            <td><?php echo $row->cabelo_tipo; ?></td>
            <td><?php echo $row->pele; ?></td>
            <td><?php echo $row->olhos; ?></td>            
            <td><?php foreach($row->tags as $tags): echo  $tags->nome.'<br/>'; endforeach; ?></td>
            <td><?php echo $row->mensagem; ?></td>
            <td><?php echo $row->conheceu; ?></td>
            <td><?php if($row->imagem1){ echo BASE_URL_ADMIN.'/cadastro/download?img='.$row->imagem1; } ?></td>
            <td><?php if($row->imagem2){ echo BASE_URL_ADMIN.'/cadastro/download?img='.$row->imagem2; } ?></td>
            <td><?php if($row->imagem3){ echo BASE_URL_ADMIN.'/cadastro/download?img='.$row->imagem3; } ?></td>
            <td><?php echo $row->dateinsert; ?></td>
          </tr>
        <?php endforeach; } ?>
	  </table>    
    </td>
  </tr>
</table>