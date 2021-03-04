<form id="form1" name="form1" method="post" action="<?php echo BASE_URL_ADMIN.'/'.$router_class.'/update_status'; ?>">      
  <table width="98%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3"><h1><em>Administrar <?=$this->titulo1?></em></h1></td>
    </tr>
    <tr>
      <td style="min-width:350px;">
        <a href="<?php echo BASE_URL_ADMIN.'/'.$router_class.'/inserir'; ?>" class="bnt_inserir"><img src="<?php echo base_url(); ?>_img/admin/bnt_inserir.gif" width="73" height="22" border="0" align="absbottom" /></a> | 
        <select name="status" id="status">
          <option value="0">Escolha uma op&ccedil;&atilde;o</option>
          <option value=""></option>
          <?php if($this->$model->table_field_status) { ?>
              <option value="publicado">Publicar Selecionados</option>
              <option value="inativo">Inativar Selecionados</option>
          <?php } ?>
          <option value="deletar">Deletar Selecionados</option>
        </select>
        <input type="button" name="aplicar" id="aplicar" class="button aplicar" value="aplicar_status1" />
        <input name="area_admin" type="hidden" id="area_admin" value="<?=$router_class?>" /></td>
      <td align="right" style="min-width:260px;">Busca:
        <input type="text" name="busca_geral" id="busca_geral" value="" />
        <input type="hidden" name="action_buscar" id="action_buscar" value="<?php echo BASE_URL_ADMIN.'/'.$router_class.'/buscar_action'; ?>" />
        <input type="submit" name="btn_buscar" id="btn_buscar" class="btn_buscar" value="" />
      </td>
      <td width="150" style="min-width:150px;">
      	<select class="maximo_per_page_admin">
          <option value="">Número de linhas</option>
          <option value="1">1</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </td>
    </tr>
  </table>
  
  <br />
  <div id="carregando" style="display:none; text-align:center; color:#F00;">Carregando...</div>
  <div class="bordaBox"> 
    <b class="b1"></b><b class="b2"></b><b class="b3"></b><b class="b4"></b>    
    <div class="conteudo">
      <table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="25" height="30" align="center"><input type="checkbox" name="selectAll" id="selectAll" value="" /></th>
            <th width=""    align="left">T&iacute;tulo</th>
            <th width="100" align="left">Categoria</th>
            <th width="100" align="left">Ordem</th>
            <?php
			if($this->$model->table_field_status) {
				echo '<th width="100" align="left">Status</th>';
            }
			echo '<th width="100" align="left">Alterado Por</th>';
			if($this->$model->table_field_dateinsert) {
				echo '<th width="150" align="left">Data de Cadastro</th>';
            }
			if($this->$model->table_field_dateupdate) {
				echo '<th width="150" align="left">&Uacute;ltima altera&ccedil;&atilde;o</th>';
            }
            ?>
          </tr>
        </thead>
        <tfoot>
        </tfoot>
        <tbody>
        <?php if($this->$router_class){ foreach($this->$router_class as $row) :
		  $config_opcoes_post['idcontrole_post'] = '0';
		  $config_opcoes_post['id_registro'] = $row->$primary_key;
		  if($this->$model->table_field_status) {
			  $table_field_status = $this->$model->table_field_status;
			  $config_opcoes_post['status'] = $row->$table_field_status;
		  }
		  $config_opcoes_post['link_editar'] = BASE_URL_ADMIN.'/'.$router_class.'/editar/';
		  $config_opcoes_post['link_status'] = BASE_URL_ADMIN.'/'.$router_class.'/status/';
		  ?>
          <tr height="30" valign="top" class="<?='post_'.$row->$primary_key?> fundo" onmouseover="posts('<?=$config_opcoes_post['idcontrole_post']?>','<?=$row->$primary_key?>')" onmouseout="posts_out('<?=$config_opcoes_post['idcontrole_post']?>','<?=$row->$primary_key?>')">
          	<th valign="middle" scope="row"><input type="checkbox" name="id[]" value="<?=$row->$primary_key?>" /></th>
            <td height="40" valign="middle">
            	<strong><a class="row-title" href="<?=$config_opcoes_post['link_editar'].$row->$primary_key?>" title="Editar">
					<?php echo $row->titulo; ?>
                </a></strong>
            	<?php $this->funcoesadm->opcoes_post($config_opcoes_post); ?>
            </td>
           <td valign="middle"><?php foreach($row->tags as $tags){ echo $tags->nome.'<br/>'; } ?></td>
            <td valign="middle"><?php echo $row->ordem; ?></td>
            <?php
			if($this->$model->table_field_status) {
				$table_field_status = $this->$model->table_field_status;
				echo '<td valign="middle">'.$row->$table_field_status.'</td>';
            }
			echo '<td valign="middle">'.$row->nomeAdmin.'</td>';
			if($this->$model->table_field_dateinsert) {
				$table_field_dateinsert = $this->$model->table_field_dateinsert;
				echo '<td valign="middle">'.$this->help->formatadatapagina($row->$table_field_dateinsert).'</td>';
            }
			if($this->$model->table_field_dateupdate) {
				$table_field_dateupdate = $this->$model->table_field_dateupdate;
				echo '<td valign="middle">'.$this->help->formatadatapagina($row->$table_field_dateupdate).'</td>';
            }
            ?>
          </tr>
        <?php endforeach; } ?>
        </tbody>
      </table>
    </div>
    <b class="b4"></b><b class="b3"></b><b class="b2"></b><b class="b1"></b>
  </div>
  <div id="paginacao">
    <?php echo $this->paginacao?>
  </div>
</form>