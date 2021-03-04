<?php

class Tags_model extends Default_model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= 'tags';
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	public $order_by						= array('nome' => 'ASC');
	// Diretórios para upload das imagens. Altere caso necessário.
	public $img_seo_field_name				= 'titulo'; // Renomeia a imagem com o valor passado pelo post. Ex.: 'titulo'
	
	// Tamanho máximo das imagens. Altere caso necessário.
	public $resize							= TRUE;
	public $constrain_proportion			= FALSE; // TRUE = Redimenciona a imagem sem distorcer ela. FALSE = Redimenciona para o valor exato de largura e altura
	
	public function _search($busca){
		if(isset($busca['area'])){
			$this->db->where('area',$busca['area']);
		}		
		
	}
	
}