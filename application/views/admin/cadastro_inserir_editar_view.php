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
                
        <h2>Sexo:</h2>
			<select name="sexo" id="sexo" class="select_list">
       	           <option>[ Selecione uma op&ccedil;&atilde;o ]</option>
       	           <option value="Masculino" <?php if(@$row->sexo == 'Masculino'){ echo 'selected="selected"'; } ?>>Masculino</option>
       	           <option value="Feminino" <?php if(@$row->sexo == 'Feminino'){ echo 'selected="selected"'; } ?>>Feminino</option>
               </select>
        
        <h2>Data de Nascimento:</h2>
        <input name="data_nascimento" type="text" id="data_nascimento" size="100" value="<?php echo @$row->data_nascimento;?>" />
        
        <h2>Respons&aacute;vel (se menor)</h2>
        <input name="responsavel" type="text" id="responsavel" size="100" value="<?php echo @$row->responsavel;?>" />
                
        <h2>CEP</h2>
        <p>
          <input name="cep" type="text" id="cep" size="100" value="<?php echo @$row->cep;?>" />
        </p>
        <h2>Endere&ccedil;o</h2>
        <p>
          <input name="endereco" type="text" id="endereco" size="100" value="<?php echo @$row->endereco;?>" />
        </p>
        <h2>N&uacute;mero</h2>
        <p>
          <input name="responsavel4" type="text" id="responsavel4" size="100" value="<?php echo @$row->responsavel;?>" />
        </p>
        <h2>Complemento</h2>
        <p>
          <input name="complemento" type="text" id="complemento" size="100" value="<?php echo @$row->complemento;?>" />
        </p>
        <h2>Bairro</h2>
        <p>
          <input name="bairro" type="text" id="bairro" size="100" value="<?php echo @$row->bairro;?>" />
        </p>
        <h2>Cidade</h2>
        <p>
          <input name="cidade" type="text" id="cidade" size="100" value="<?php echo @$row->cidade;?>" />
        </p>
        <h2>Estado</h2>
        <p>
          <input name="estado" type="text" id="estado" size="100" value="<?php echo @$row->estado;?>" />
        </p>
        <h2>E-mail</h2>
        <p>
          <input name="email" type="text" id="email" size="100" value="<?php echo @$row->email;?>" />
        </p>
        <h2>Telefone Fixo</h2>
        <p>
          <input name="telefone_fixo" type="text" id="telefone_fixo" size="100" value="<?php echo @$row->telefone_fixo;?>" />
        </p>
        <h2>Telefone M&oacute;vel</h2>
        <p>
          <input name="telefone_movel" type="text" id="telefone_movel" size="100" value="<?php echo @$row->telefone_movel;?>" />
        </p>
        <h2>Altura</h2>
        <p>
          <input name="altura" type="text" id="altura" value="<?php echo @$row->altura;?>" size="2" maxlength="3" />
        </p>
        <h2>Peso</h2>
        <p>
          <input name="peso" type="text" id="peso" value="<?php echo @$row->peso;?>" size="2" maxlength="3" />
        </p>
        <h2>Sapato</h2>
        <p>
          <input name="sapato" type="text" id="sapato" value="<?php echo @$row->sapato;?>" size="2" maxlength="3" />
        </p>
        <h2>Manequim</h2>
        <p>
          <input name="manequim" type="text" id="manequim" value="<?php echo @$row->manequim;?>" size="2" maxlength="3" />
        </p>
        <h2>Cabelo</h2>
        <p>
          <select name="cabelo" id="cabelo" class="select_list">
       	            <option value="">[ Selecione uma op&ccedil;&atilde;o ]</option>
       	            <option value="Loiro" <?php if(@$row->cabelo == 'Loiro') { echo 'selected="selected"';} ?>>Loiro</option>
       	            <option value="Preto" <?php if(@$row->cabelo == 'Preto') { echo 'selected="selected"';} ?>>Preto</option>
       	            <option value="Castanho" <?php if(@$row->cabelo == 'Castanho') { echo 'selected="selected"';} ?>>Castanho</option>
       	            <option value="Ruivo" <?php if(@$row->cabelo == 'Ruivo') { echo 'selected="selected"';} ?>>Ruivo</option>
       	            <option value="N&atilde;o tem" <?php if(@$row->cabelo == utf8_encode('N�o tem')) { echo 'selected="selected"';} ?>>N&atilde;o tem</option>
                </select>
        </p>
        <h2>Tipo de Cabelo</h2>
        <p>
         <select name="cabelo_tipo" id="cabelo_tipo" class="select_list">
       	          <option value="">[ Selecione uma op&ccedil;&atilde;o ]</option>
       	          <option value="Ondulado" <?php if(@$row->cabelo_tipo == 'Ondulado') { echo 'selected="selected"';} ?>>Ondulado</option>
       	          <option value="Liso" <?php if(@$row->cabelo_tipo == 'Loiro') { echo 'selected="selected"';} ?>>Liso</option>
       	          <option value="Encaracolado" <?php if(@$row->cabelo_tipo == 'Encaracolado') { echo 'selected="selected"';} ?>>Encaracolado</option>
       	          <option value="Crespo" <?php if(@$row->cabelo_tipo == 'Crespo') { echo 'selected="selected"';} ?>>Crespo</option>
       	          <option value="N&atilde;o tem" <?php if(@$row->cabelo_tipo == utf8_encode('N�o tem')) { echo 'selected="selected"';} ?>>N&atilde;o tem</option>
                </select>
        </p>
        <h2>Pele</h2>
        <p>
         <select name="pele" id="pele" class="select_list">
       	          <option value="">[ Selecione uma op&ccedil;&atilde;o ]</option>
       	          <option value="Branca" <?php if(@$row->pele == 'Branca') { echo 'selected="selected"';} ?>>Branca</option>
       	          <option value="Negra" <?php if(@$row->pele == 'Negra') { echo 'selected="selected"';} ?>>Negra</option>
       	          <option value="Amarela" <?php if(@$row->pele == 'Amarela') { echo 'selected="selected"';} ?>>Amarela</option>
       	          <option value="Parda" <?php if(@$row->pele == 'Parda') { echo 'selected="selected"';} ?>>Parda</option>
       	          <option value="Mesti&ccedil;a" <?php if(@$row->pele == utf8_encode('Mesti�a')) { echo 'selected="selected"';} ?>>Mesti&ccedil;a</option>
       	          <option value="Vermelha" <?php if(@$row->pele == 'Vermelha') { echo 'selected="selected"';} ?>>Vermelha</option>
                </select>
        </p>
        <h2>Olhos</h2>
        <p>
          <select name="olhos" id="olhos" class="select_list">
       	          <option value="">[ Selecione uma op&ccedil;&atilde;o ]</option>
       	          <option value="Pretos" <?php if(@$row->olhos == 'Pretos') { echo 'selected="selected"';} ?>>Pretos</option>
       	          <option value="Azul" <?php if(@$row->olhos == 'Azul') { echo 'selected="selected"';} ?>>Castanho</option>
       	          <option value="Mel" <?php if(@$row->olhos == 'Mel') { echo 'selected="selected"';} ?>>Verdes</option>
                </select>
        </p>
        <h2>Habilidades</h2>
        <?php $this->funcoesadm->show_tags($all_tags,(array)@$row->tags); ?>   
        
        <h2>Mensagem</h2>
        <p>
          <input name="bairro6" type="text" id="bairro6" size="100" value="<?php echo @$row->bairro;?>" />
        </p>
        <h2>Foto 1:</h2>
        <p>
          <?php if(@$row->imagem1) { ?>
          <img src="<?=base_url().'_img/_cadastro/'.$row->imagem1; ?>" title="<?=$row->imagem1?>" /><br />	
          <input name="apagar_imagem" type="checkbox" id="apagar_imagem" value="1" />
          <label for="apagar_imagem">Apagar imagem</label>
          <br /><br />
          <?php  } ?>
          <input name="imagem1" id="imagem1" type="file" size="76" />        
        </p>
        <h2>Foto 2:</h2>
        <p>
          <?php if(@$row->imagem2) { ?>
          <img src="<?=base_url().'_img/_cadastro/'.$row->imagem2; ?>" title="<?=$row->imagem2?>" /><br />
          <input name="apagar_imagem2" type="checkbox" id="apagar_imagem2" value="1" />
          <label for="apagar_imagem2">Apagar imagem</label>
          <br />
          <br />
          <?php  } ?>
          <input name="imagem2" id="imagem2" type="file" size="76" />        
        </p>
        <h2>Foto 3:</h2>
        <?php if(@$row->imagem3) { ?>
        <img src="<?=base_url().'_img/_cadastro/'.$row->imagem3; ?>" title="<?=$row->imagem3?>" /><br />
        <input name="apagar_imagem3" type="checkbox" id="apagar_imagem3" value="1" />
        <label for="apagar_imagem3">Apagar imagem</label>
        <br />
        <br />
        <?php  } ?>
        <input name="imagem3" id="imagem3" type="file" size="76" />       
        <p>
        
        <input type="submit" name="editar" id="btn_inserir_editar" class="btn_<?=$action_form?>" value="   <?=ucfirst($action_form)?>   " />
      </p>
      </form>
    </td>
    <td valign="top">
    </td>
  </tr>
</table>