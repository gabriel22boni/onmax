<?php

class Adm_usuarios_model extends Default_Model {
	
	public $table_name						= 'adm_usuarios';
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $table_field_dateinsert			= FALSE; // Campo do tipo datetime com a infomação da data e hora que o registro foi criado
	public $table_field_dateupdate			= FALSE; // Campo do tipo datetime com a infomação da data e hora que foi feita a última alteração
	
	public $getOne_show_tags	 			= TRUE; // Deseja que a função getOne retorne a tags? Por padrão é falso
	public $getSome_show_tags	 			= FALSE; // Deseja que a função getSome retorne as tags? Por padrão é falso
	
	/*public function _join(){
		$this->db->select('group_concat(tags.nome ORDER BY tags.nome ASC) as nomeMenu,group_concat(tags.url ORDER BY tags.nome ASC) as url,group_concat(tags.controller) as controller');
		$this->db->join(PREF_TABLE.'tags_relashionships as tags_rel',$this->table_name.'.id_adm_usuario = tags_rel.idregistro','left');
		$this->db->join(PREF_TABLE.'tags as tags','tags.idtag = tags_rel.idtag','left');
		$this->db->order_by('tags.ordem','ASC');
		$this->db->group_by('tags_rel.idregistro');
	}*/
	
	public function validate_login() {
		$this->db->where('usuario', $this->input->post('usuario'));
		$this->db->where('senha', $this->input->post('senha'));
		$this->db->where('status', 'publicado');
		//$this->db->where('tags_rel.area', 'adm_usuarios'); //area das tags que o usuario esta cadastrados
		return $this->getSome(1);
	}	
	
	/*public function montaMenuAdmin($idusuario) {
		$this->db->where('tags_rel.area','adm_usuarios'); //area das tags que o usuario esta cadastrados
		$this->db->where('tags_rel.idregistro', $idusuario); //area das tags que o usuario esta cadastrados	
		return $this->getSome();
	}*/
}