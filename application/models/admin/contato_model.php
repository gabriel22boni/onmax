<?php

class Contato_model extends Default_model {
	
	//VARIAVEIS 
	public $table_name						= 'contato';
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	//public $table_field_status				= FALSE; // Campo do tipo varchar ou int com a infomação do status ( ativo/publicado/1 ou inativo/inativo/0)
}