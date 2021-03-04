<?php

class Imagem_model extends Default_model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= 'imagem';
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	// Diretórios para upload das imagens. Altere caso necessário.
	public $img_seo_field_name				= 'titulo'; // Renomeia a imagem com o valor passado pelo post. Ex.: 'titulo'
	
	// Tamanho máximo das imagens. Altere caso necessário.
	public $resize							= TRUE;
	public $constrain_proportion			= FALSE; // TRUE = Redimenciona a imagem sem distorcer ela. FALSE = Redimenciona para o valor exato de largura e altura
	public $img_max_width					= 580;
	public $img_max_height					= 700;
	public $getOne_show_gallery 			= TRUE; // Deseja que a função getOne retorne a geleria de imagens? Por padrão é falso
	public $getSome_show_gallery 			= TRUE; // Deseja que a função getSome retorne a geleria de imagens? Por padrão é falso
	
	
	public function insertOneField2($table_field,&$dados,$insert_id){
		
		if($table_field == 'destaque') {
			if($this->input->post('destaque') == 0) {
			$dados = array_merge( $dados,array('`destaque`' => '0') );
			return true;
			}
		}
		
		foreach($this->input->post('videos_youtube') as $video_youtube):			
			$dados = array(
				'fkcurso' => $insert_id,	
				'url_video' => $video_youtube
			);
			$this->db->set($this->gallery_field_dateinsert, 'NOW()', FALSE);
			$this->db->set($this->gallery_field_dateupdate, 'NOW()', FALSE);
			$this->db->insert(PREF_TABLE.'videos', $dados);
		endforeach;
		
	}
	
	
}