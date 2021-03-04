<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="<?php echo base_url(); ?>_css/login_admin.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="<?php echo base_url(); ?>_js/jquery-1.4.2.js"/></script>
<script language="javascript">
$(document).ready(function(){
  $("#user_login").focus();
});
</script>
<title><?=$titulo?></title>
</head>
<body class="login">
<div id="login">
  <div class="logo_adm">
  	<img src="<?php echo base_url(); ?>_img/admin/logo_adm.gif" border="0" />
  </div>
  <?php /*?><h1>Virbac</h1><?php */?>
   <?php if(isset($erro)) { echo '<div style="color:#F00; margin-top:-12px; margin-left:80px; margin-bottom:20px; font-size:14px;"><strong>'.$erro.'</strong></div>'; } ?>
<form name="loginform" id="loginform" class="loginform" action="<?php echo BASE_URL_ADMIN; ?>/login/do_login" method="post">

		<label>Usu&aacute;rio<br />
            <input type="text" name="usuario" id="user_login" class="input" value="<? if(isset($this->validation->usuario)) { echo $this->validation->usuario; } ?>" size="20" tabindex="10" autocomplete="off" />
            <?php if(isset($this->validation->usuario_error)) { echo '<div style="color:#F00; margin-top:-12px; margin-bottom:20px;">'.$this->validation->usuario_error.'</div>'; } ?>
		</label>
	
		<label>Senha<br />
            <input type="password" name="senha" id="user_pass" class="input" value="" size="20" tabindex="20" autocomplete="off" />
            <?php if(isset($this->validation->senha_error)) { echo '<div style="color:#F00; margin-top:-12px;">'.$this->validation->senha_error.'</div>'; } ?>
   		</label>
	
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Entrar" tabindex="100" />
		<input type="hidden" name="testcookie" value="1" />
	</p>

</form>
</div>
<p id="backtoblog"><a href="<?php echo base_url(); ?>" title="Are you lost?">Voltar para o site</a></p>
</body>
</html>