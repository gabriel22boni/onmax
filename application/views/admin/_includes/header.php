<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt-br" xml:lang="pt-br">
<head>
<meta http-equiv = "Content-Type" content = "text/html; charset=UTF-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<title><?php echo $titulo; ?></title>

<link href="<?php echo base_url(); ?>_css/admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?php echo base_url(); ?>_js/jquery/jquery-1.4.2.js"/></script>
<script language="javascript" src="<?php echo base_url(); ?>_js/jquery/jquery.limit-1.2.source.js"/></script>
<script language="javascript" src="<?php echo base_url(); ?>_js/jquery/jquery.MultiFile.min.js" type="text/javascript"></script>
<script language="javascript" src="<?php echo base_url(); ?>_js/funcoes_adm.js?cache=<?=time()?>" type="text/javascript" charset="iso-8859-1"></script>
<script>
var fullpath = '<?php echo BASE_URL_ADMIN; ?>';
</script>
</head>
<body>
<!--Inicio div master-->
<div id="master">
<div id="master_top">
	<?php if(is_file(SITE_ROOT.'_img/admin/logo_adm.gif')) { ?>
		<div class="logo_adm"><a href="<?php echo BASE_URL_ADMIN; ?>"><img src="<?php echo base_url(); ?>_img/admin/logo_adm.gif" border="0" /></a></div>
    <?php } else { ?>
	    <h1 class="titulo">Admin</h1>
    <?php } ?>
	<h1 class="usuario">Bem Vindo, <?php echo $this->session_admin["nome"]; ?> | <?php echo anchor('admin/login/logout', 'Sair'); ?></h1>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:30px;">
  <tr>
    <td width="250" valign="top">
      <div id="menu">
        <div id="firstpane" class="menu_list">
          <?php $i=0; foreach($this->menu as $key=> $menu):	$i++;
		  		if($menu->controller == 'contato'){	echo '<p class="menu_head_titulo">Exportar</p>'; }
				if($menu->controller == 'adm_usuarios'){
		  			echo '<p class="menu_head_titulo">Admin</p>';
					echo '<a href="'.BASE_URL_ADMIN.'/'.$menu->url.'" class="link_menu"><p class="menu_head">'.$menu->nome.'</p></a>';
					echo '<p class="menu_head_titulo">Gerenciar</p>';
				} else {
					if($i=='1'){ echo '<p class="menu_head_titulo">Gerenciar</p>'; }			
					echo '<a href="'.BASE_URL_ADMIN.'/'.$menu->url.'" class="link_menu"><p class="menu_head">'.$menu->nome.'</p></a>';
				}				
		endforeach; ?>
        </div>
      </div>
    </td>
    <td width="100%" valign="top" style="padding-right:20px" >
	<?php echo $this->gerarmenu->get_global_messages(); ?>