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
        <input name="idcategoria" type="hidden" id="idcategoria" size="100" value="0" />
        <input name="texto" type="hidden" id="texto" size="100" value="Vazio" />
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
        
        
        <h2>T&iacute;tulo:</h2>
        <input name="titulo" type="text" id="titulo" size="100" value="<?php echo @$row->titulo;?>" />
        
        <h2>Imagem:</h2>
        <?php if(@$row->imagem) { ?>
          <img src="<?=base_url().'_img/_'.$router_class.'/'.$row->imagem; ?>" title="<?=$row->imagem?>" /><br />	
          <input name="apagar_imagem" type="checkbox" id="apagar_imagem" value="1" />
          <label for="apagar_imagem">Apagar imagem</label><br /><br />
        <?php  } ?>
        <input name="imagem" id="imagem" type="file" size="76" />
        <?php
        if($this->$model->resize) {
            echo '<div style="color:#333;">Imagem com tamanho m&aacute;ximo de '.$this->$model->img_max_width.' x '.$this->$model->img_max_height.' pixels, JPG, GIF ou PNG, formato RGB, 72 dpi</div>';
        } else {
            echo '<div style="color:#333;">Imagem JPG, GIF ou PNG, formato RGB, 72 dpi</div>';
        }
        ?>
        <h2>Url do Logotipo:</h2>
        <input name="link_logo" type="text" id="link_logo" size="100" value="<?php echo @$row->link_logo;?>" />
        <h2>Abrir janela em :</h2>
        <select name="target" id="target">
          <option value="_self" <?php if(@$row->target == '_self') { echo 'selected="selected"'; } ?>>Mesma Janela</option>
          <option value="_blank" <?php if(@$row->target == '_blank') { echo 'selected="selected"'; } ?> >Nova Janela</option>
        </select>
        
        <h2>Ordem:
        <input name="ordem" type="text" id="ordem" size="2" value="<?php echo @$row->ordem;?>" autocomplete="off" /></h2>
        
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