<?php

class Menu_admin_model extends Default_model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= 'tags_relashionships';
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	public $getOne_show_tags	 			= TRUE; // Deseja que a função getOne retorne a tags? Por padrão é falso
	public $getSome_show_tags	 			= TRUE; // Deseja que a função getSome retorne as tags? Por padrão é falso
	
	
	public function _join(){
		//$this->db->join(PREF_TABLE.'tags_relashionships as tags_rel',$this->table_name.'.id_adm_usuario = tags_rel.idregistro','left');
		$this->db->select('tags.nome,tags.url,tags.controller');
		$this->db->join(PREF_TABLE.'tags as tags',$this->table_name.'.idtag = tags.idtag','left');
		$this->db->order_by('tags.ordem','ASC');
		//$this->db->group_by($this->table_name.'.idregistro');
	}
	
	public function montaMenuAdmin($idusuario) {
		$this->db->where($this->table_name.'.area','adm_usuarios'); //area das tags que o usuario esta cadastrados
		$this->db->where($this->table_name.'.idregistro', $idusuario); //area das tags que o usuario esta cadastrados	
		return $this->getSome();
	}	
	
	public function validaAcessoPagina(){
		$idusuario = $this->session_admin['idusuario'];
		$menu = $this->montaMenuAdmin($idusuario);
		
		foreach($menu as $row):	
			$url[] = $row->controller; //Grava em array o nome dos controllers
		endforeach;
		if (in_array($this->uri->segment(2),$url)) {
			} else {
				$msg = array('Você não tem acesso a essa página.');
				$this->gerarmenu->set_global_messages($msg, 'alert_messages');
				redirect(BASE_URL_ADMIN);
			}
	}
}