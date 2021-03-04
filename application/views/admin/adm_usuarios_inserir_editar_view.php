<?php
include_once(SITE_ROOT."_js/fckeditor/fckeditor.php");
$row =  @$this->$router_class;
$primary_key = $this->$model->primary_key;
?>

<h1><em><?=ucfirst($action_form).' '.$this->titulo2?></em></h1>
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
      <form action="<?=BASE_URL_ADMIN.'/'.$router_class.'/'.$action_form.'_action'?>" class="editar_inserir_view" method="post" name="form_<?=$router_class?>" id="form_<?=$router_class?>" enctype="multipart/form-data">
        <input name="area" type="hidden" id="area" size="100" value="<?php echo $router_class;?>" />
        <?php
        if($action_form == 'editar') {
            echo '<input type="hidden" value="'.$row->$primary_key.'" id="'.$primary_key.'" name="'.$primary_key.'" />'; ?>
            <div class="informacao">
              <h2>Informa&ccedil;&otilde;es:</h2>
              <?php
              if($this->$model->primary_key) {
                  echo '<h3>ID: '.$row->$primary_key.'</h3>';
              }
              if($this->$model->table_field_dateinsert) {
                  $dateinsert = $this->$model->table_field_dateinsert;
                  echo '<h3>Data de cria&ccedil;&atilde;o: '.$this->help->formatadatapagina($row->$dateinsert).'</h3>';
              }
              if($this->$model->table_field_dateupdate) {
                  $dateupdate = $this->$model->table_field_dateupdate;
                  echo '<h3>&Uacute;ltima altera&ccedil;&atilde;o: '.$this->help->formatadatapagina($row->$dateupdate).'</h3>';
              }
              ?>
            </div>
        <?php } ?>
        
        <h2>Nome:</h2>
        <input name="nome" type="text" id="nome" size="100" value="<?php echo @$row->nome;?>" />
        
        <h2>Usu&aacute;rio:</h2>
        <input name="usuario" type="text" id="usuario" size="100" value="<?php echo @$row->usuario;?>" />
        
        <h2>Senha:</h2>
        <input name="senha" type="text" id="senha" size="100" value="<?php echo @$row->senha;?>" />
        
        <h2>Áreas:</h2>
        <?php $this->funcoesadm->show_tags($all_tags,(array)@$row->tags,'links_adm'); ?>   
                
        <?php if($this->$model->table_field_status) { ?>
        <h2>Mostrar:<input name="<?=$this->$model->table_field_status?>" type="checkbox" id="<?=$this->$model->table_field_status?>" <?php if(@$row->status == $this->$model->table_value_status_ativo) { ?> checked="checked"<?php } ?> value="<?=$this->$model->table_value_status_ativo?>" /></h2>
        <?php } ?>
        
        <input type="submit" name="editar" id="btn_inserir_editar" class="btn_<?=$action_form?>" value="   <?=ucfirst($action_form)?>   " />
      </form>
    </td>
    <td valign="top">
    </td>
  </tr>
</table>