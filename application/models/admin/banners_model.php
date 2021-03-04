<?php

class Banners_model extends Default_model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= 'banners';
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	// Diretórios para upload das imagens. Altere caso necessário.
	public $img_seo_field_name				= 'titulo'; // Renomeia a imagem com o valor passado pelo post. Ex.: 'titulo'
	
	// Tamanho máximo das imagens. Altere caso necessário.
	public $resize							= TRUE;
	public $constrain_proportion			= FALSE; // TRUE = Redimenciona a imagem sem distorcer ela. FALSE = Redimenciona para o valor exato de largura e altura
	public $img_max_width					= 1200;
	public $img_max_height					= 556;
	
	public $getOne_show_tags	 	= TRUE; // Deseja que a função getOne retorne a tags? Por padrão é falso
	public $getSome_show_tags	 	= TRUE; // Deseja que a função getSome retorne as tags? Por padrão é falso
	
	public function _join(){
		$this->db->select('adm.nome as nomeAdmin');
		$this->db->join(PREF_TABLE.'adm_usuarios as adm',$this->table_name.'.id_adm_usuario = adm.id_adm_usuario','left');
	}
	
	public function insertOneField($table_field,&$dados){
		//Grava na tabela do banco qual foi o ID do usuario que alterou o registro
		if($table_field == 'id_adm_usuario') {
			if($this->session_admin['idusuario']) {
			$dados = array_merge( $dados,array('`id_adm_usuario`' => $this->session_admin['idusuario']) );
			return true;
			}
		}
	}
}