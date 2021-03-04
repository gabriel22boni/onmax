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
        
        <h2>T&iacute;tulo:</h2>
        <input name="titulo" type="text" id="titulo" size="105" value="<?php echo @$row->titulo;?>" />
               
        <h2>Texto:</h2>
        <?php
        $oFCKeditor = new FCKeditor('texto') ;
        $oFCKeditor->BasePath =  base_url().'_js/fckeditor/' ;
        $oFCKeditor->Config['SkinPath'] = 'skins/silver/' ;
		$oFCKeditor->ToolbarSet = 'Default_Table';
        $oFCKeditor->Height = '450';
        $oFCKeditor->Value =  @$row->texto;
        $oFCKeditor->Create();
        ?>         
        
 		<h2>Galeria de imagens:</h2>
        <?php if(@$row->images_gallery) { foreach($row->images_gallery as $imagem): ?>
        <div  id="img<?php echo $imagem->idgaleria; ?>" style="float:left; margin-right:20px; margin-bottom:15px; text-align:center;">				
          <img src="<?=base_url().'_img/_'.$router_class.'/_gallery/'.$imagem->imagem; ?>" width="100" height="80" border="0" />  <br />
          <a onclick="apagarImagem(this, '<?php echo $imagem->idgaleria; ?>')" href="javascript: void(0);">[ x apagar imagem ]</a> <br/>
          <input name="alt_galeria[<?php echo $imagem->idgaleria;?>]" type="text" id="alt_galeria[]" size="10" value="<?php echo $imagem->alt_galeria;?>" style="margin-top:10px;" placeholder="Digite o alt" />
        </div>
        <?php endforeach; } ?>
        <br clear="all" />
        <input name="userfile[]" id="userfile" type="file" class="multi" accept="gif|jpg" size="70" />
        <input type="hidden" readonly="readonly" name="apagar_galeria" id="apagar_galeria" />        
        <div style="color:#333;">Imagem com tamanho máximo de 580 x 700 pixels, JPG, GIF ou PNG, formato RGB, 72 dpi</div>
        
        <h2>Ordem:</h2>
        <input name="ordem" type="text" id="ordem" size="1" maxlength="2" value="<?php echo @$row->ordem;?>" />
        
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