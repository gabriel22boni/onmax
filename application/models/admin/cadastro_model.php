<?php

class Cadastro_model extends Default_model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= 'cadastro';
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	// Diretórios para upload das imagens. Altere caso necessário.
	public $img_seo_field_name				= 'nome'; // Renomeia a imagem com o valor passado pelo post. Ex.: 'titulo'
	
	// Tamanho máximo das imagens. Altere caso necessário.	
	public $resize							= FALSE;	
	
	public $getOne_show_tags	 	= TRUE; // Deseja que a função getOne retorne a tags? Por padrão é falso
	public $getSome_show_tags	 	= TRUE; // Deseja que a função getSome retorne as tags? Por padrão é falso
}