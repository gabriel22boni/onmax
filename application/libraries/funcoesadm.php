<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Funcoesadm {
	
	
	public function show_tags($all_tags, $checked_tags = array(),$area = FALSE,$name = 'tags_id',$id = 'tags_id',$primary_key = 'idtag',$show_field = 'nome') {
		
		$CI =& get_instance();
		foreach($checked_tags as $tags) {
			$selected_tags[] = $tags->$primary_key;
		}
		if($all_tags) {
			foreach($all_tags as $tags) {
			if($tags->area == $area){
				if(in_array($tags->$primary_key,(array)@$selected_tags)) {
					$checked = 'checked="checked"';
				} else {
					$checked = '';
				}
				$tags_td[] = '<input name="'.$name.'[]" type="checkbox" id="'.$tags->$primary_key.'" value="'.$tags->$primary_key.'" '.$checked.' /> <label for="'.$tags->$primary_key.'">'.$tags->$show_field.'</label><br />';
			}
			}
		} else {
			$tags_td[] = 'Nenhuma tag cadastrada';
		}
		if(isset($tags_td)) {  ?>
			<table class="check_tags">
			  <tr>
				<td>
				  <?php
				  $i=0;
				  foreach($tags_td as $td) {$i++;
					  echo $td;
					  if($CI->help->quebra_coluna(count($tags_td), 3, $i)) {
						  echo '</td><td>'; 
					  }
				  }
				  ?>
				</td>
			  </tr>
			</table>
		<?php
        }
    }

	public function Logger($msg){
		$data = date("d-m-y");
		$hora = date("H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
		 
		//Nome do arquivo:
		$arquivo = "Logger_$data.txt";
		 
		//Texto a ser impresso no log:
		$texto = "[$hora][$ip]> $msg \n";
		 
		$manipular = fopen("_logs/$arquivo", "a+b");
		fwrite($manipular, $texto);
		fclose($manipular);
	}

	public function escape($str) {
		$search=array("\\","\0","\n","\r","\x1a","'",'"');
		$replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"');
		return str_replace($search,$replace,$str);
	}

	public function opcoes_post($config = NULL) {
		// Define os valores padrões para esta função
		$config_default['id_registro']				= NULL; // ID do registro
		$config_default['status']					= FALSE; // Status atual do registro (FALSE, 'publicado', 'inativo')
		$config_default['link_editar']				= FALSE; // Link absoluto da página editar (sem o ID)
		$config_default['link_status']				= FALSE; // Link absoluto da página que altera o Status e/ou Deleta o registro (incluindo o ID)
		$config_default['texto_editar']				= 'Editar'; // Texto que será exibido pro usuário
		$config_default['texto_deletar']			= 'Deletar'; // Texto que será exibido pro usuário
		$config_default['texto_publicar']			= 'Publicar'; // Texto que será exibido pro usuário
		$config_default['texto_inativar']			= 'Inativar'; // Texto que será exibido pro usuário
		$config_default['idcontrole_post']				= '0'; // Usado para exibir vários "opcoes_row()" em uma página ('0','1','2');
		
		if($config) {
			if(is_array($config)) {
				$config_default = array_merge($config_default,$config);
			}
		}
		$config = $config_default;
		
		$aux = '';
		$dados = '<div class="opcoes_post_'.$config['idcontrole_post'].'_'.$config['id_registro'].'" style="display:none;">';
			if($config['texto_editar']) {
			  $dados.= '<a href="'.$config['link_editar'].$config['id_registro'].'">'.$config['texto_editar'].'</a>';
			  $aux = ' | ';
			}
			if($config['texto_deletar']) {
			  $dados.= $aux.'<a href="#" onclick="deletar('.$config['id_registro'].',\''.$config['link_status'].'\');">'.$config['texto_deletar'].'</a>';
			  $aux = ' | ';
			}
			if($config['texto_publicar']) {
				if($config['status']=='' || $config['status']=='inativo') { 
					$dados .= $aux.'<a href="#" onclick="publicar('.$config['id_registro'].',\''.$config['link_status'].'\');">'.$config['texto_publicar'].'</a>';
				} else {
					$dados .= $aux.'<a href="#" onclick="inativar('.$config['id_registro'].',\''.$config['link_status'].'\');">'.$config['texto_inativar'].'</a>'; 
				}
			}
		$dados .= '</div>';
		
		echo $dados;
	}

	public function contagem_registro($type,$tabela){
		$valor = '<a href="principal.php?type='.$type.'" title="Todos">Todos</a> (<strong>'.$this->countQuery($tabela).'</strong>) | 
				<a href="principal.php?type='.$type.'&status=publicado" title="Publicado">Publicados</a> (<strong>'.$this->countQuery($tabela,'status="publicado"').'</strong>)  | 
				<a href="principal.php?type='.$type.'&status=inativo" title="Todos">Inativo</a> (<strong>'.$this->countQuery($tabela,'status="inativo"').'</strong>)  | 
				<a href="principal.php?type='.$type.'&status=lixo" title="Lixo">Lixeira</a> (<strong>'.$this->countQuery($tabela,'status="lixo"').'</strong>)
				';
		echo $valor;
	}

	public function resume($var, $limite){
		// Se o texto for maior que o limite, ele corta o texto e adiciona 3 pontinhos.
		if (strlen($var) > $limite){
			echo substr_replace ($var, '.', $limite);
		} else {
			// Se não for maior que o limite, ele não adiciona nada.
			echo substr_replace ($var, '', $limite);
		}
	}
}
?>