<?php
$row =  @$this->$router_class;
?>

<h1><em><?=ucfirst($action_form).' '.$this->titulo2?></em></h1>
<form action="<?=BASE_URL_ADMIN.'/'.$router_class.'/'.$action_form.'_action'?>" class="editar_inserir_view" method="post" name="form_<?=$router_class?>" id="form_<?=$router_class?>" enctype="multipart/form-data">	
	<input type="hidden" value="gerenciar_email" id="area" name="area" />
  <?php
  if($action_form == 'editar') {
	  echo '<input type="hidden" value="'.$row->$primary_key.'" id="'.$primary_key.'" name="'.$primary_key.'" />';
  }
  ?>
	<h2>E-mail:<input name="texto" type="text" id="texto" size="100" value="<?php echo @$row->texto;?>" /></h2>
  
  	<h2>Mostrar:<input name="status" type="checkbox" id="status" <?php if(@$row->status =='publicado') { ?> checked="checked"<?php } ?> value="publicado" /></h2>
  
  <input type="submit" name="editar" id="editar" value="   <?=ucfirst($action_form)?>   " />
</form>