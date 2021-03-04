<?php

class Default_model extends CI_Model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= ''; // Nome da tabela sem o prefixo
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= 'AUTO'; // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	public $order_by 						= 'AUTO'; // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'DESC','ordem' => 'ASC')
	public $describe_table					= ''; // Lista com todos os detalhes da tabela, como nome dos campos e chave primária
	public $table_fields					= ''; // Lista com apenas o nome dos campos da tabela.
	public $primary_key 					= ''; // Campo primary key. Por padrão recebe o campo que foi configurado como pk no banco
	public $table_field_dateinsert			= 'dateinsert'; // Campo do tipo datetime com a infomação da data e hora que o registro foi criado
	public $table_field_dateupdate			= 'dateupdate'; // Campo do tipo datetime com a infomação da data e hora que foi feita a última alteração
	public $table_field_status				= 'status'; // Campo do tipo varchar ou int com a infomação do status ( ativo/publicado/1 ou inativo/inativo/0)
	public $table_value_status_ativo		= 'publicado'; // Valor do status quando foir publicado Ex.: ativo, publicado, 1
	public $table_value_status_inativo		= 'inativo'; // Valor do status quando foir publicado Ex.: inativo, 0
	// Diretórios para upload das imagens. Altere caso necessário.
	public $allowed_types					= '*'; // Extensões permitidas para upload.
	public $img_seo_field_name				= FALSE; // Renomeia a imagem com o valor passado pelo post. Ex.: 'titulo'
	public $encrypt_name					= FALSE; // Encripta o nome da imagem principal e das imagens da galeria
	public $create_thumb					= FALSE; // Cria uma thumb para a imagem
	public $dir_upload_file					= '';// Será definido automaticamente como: './_file/_[nome_da_tabela]/'
	public $dir_upload_img					= '';// Será definido automaticamente como: './_img/_[nome_da_tabela]/'
	public $dir_upload_thumb				= '_thumbs';
	public $thumb_marker					= ''; // Sufixo do nome do thumb. Ex.: nome_da_imagem_thumb.jpg
	// Tamanho máximo das imagens. Altere caso necessário.
	public $resize							= FALSE;
	public $constrain_proportion			= TRUE; // TRUE = Redimenciona a imagem sem distorcer ela. FALSE = Redimenciona para o valor exato de largura e altura
	public $img_max_width					= 340;
	public $img_max_height					= 400;
	public $resize_thumb					= FALSE;
	public $thumb_proportion				= TRUE; // Redimenciona a thumb sem distorcer ela. Ou redimenciona para o valor exato de largura e altura
	public $thumb_max_width					= 88;
	public $thumb_max_height				= 88;
	// Detalhes da galeria de imagens. Altere caso necessário.
	public $gallery_area 					= ''; // Nome da área da galeria. Por padrão recebe o nome da tabela ($table_name)
	public $dir_upload_gallery				= '';
	public $getOne_show_gallery 			= FALSE; // Deseja que a função getOne retorne a geleria de imagens? Por padrão é falso
	public $getSome_show_gallery 			= FALSE; // Deseja que a função getSome retorne a geleria de imagens? Por padrão é falso
	public $gallery_table_name 				= 'galeria'; // nome da tabela de galerias de imagens. Por padrão é 'galeria'
	public $gallery_pk 						= 'idgaleria'; // Campo primary key. Por padrão é 'idgaleria'
	public $gallery_fk 						= 'idregistro'; // Campo Foreing Key. Por padrão é 'idregistro'
	public $gallery_field_image 			= 'imagem'; // Nome do campo da imagem. Por padrão o campo é 'imagem'.
	public $gallery_field_area 				= 'area'; // Nome do campo da area. Por padrão o nome do campo é 'area' e o valor deste campo é o nome da tebela.
	public $gallery_field_dateinsert 		= 'dateinsert'; // Nome do campo que registra a data que o registro foi inserido na tabela.
	public $gallery_field_dateupdate 		= 'dateupdate'; // Nome do campo que registra a data da última alteração do registro.
	// Detalhes da tabela das tags. Altere caso necessário.
	public $getOne_show_tags	 			= FALSE; // Deseja que a função getOne retorne a tags? Por padrão é falso
	public $getSome_show_tags	 			= FALSE; // Deseja que a função getSome retorne as tags? Por padrão é falso
	public $tags_form_name		 			= 'tags'; // nome do campo do form com as tags separadas por virgula para serem inseridas no banco. Por padrão é 'tags'
	public $tags_id_form_name		 		= 'tags_id'; // nome do campo do form com o array das tags selecionadas para serem inseridas no banco. Por padrão é 'tags_id'
	public $tags_table_name	 				= 'tags'; // nome da tabela de galerias de imagens. Por padrão é 'galeria'
	public $tags_rel_table_name				= 'tags_relashionships'; // Nome da tabela que faz o relacionamento da tag com o post
	public $tags_field_pk 					= 'idtag'; // Campo primary key. Por padrão é 'idgaleria'
	public $tags_field_fk 					= 'idregistro'; // Campo Foreing Key. Por padrão é 'idregistro'
	public $tags_field_name	 				= 'nome'; // Nome do campo da imagem. Por padrão o campo é 'imagem'.
	public $tags_field_name_seo 			= 'nome_seo'; // Nome do campo da imagem. Por padrão o campo é 'imagem'.
	public $tags_field_area	 				= 'area'; // Nome do campo da area. Por padrão o nome do campo é 'area' e o valor deste campo é o nome da tebela.
	public $tags_field_dateinsert 			= 'dateinsert'; // Nome do campo que registra a data que o registro foi inserido na tabela.
	public $tags_field_dateupdate 			= 'dateupdate'; // Nome do campo que registra a data da última alteração do registro.
	public $tags_value_area 				= ''; // Valor da área da tag. Por padrão recebe o nome da tabela ($table_name)
	// Detalhes da tabela das tags. Altere caso necessário.
	public $vejatambem_rel_table_name		= 'vejatambem_relashionships';
	public $getOne_show_vejatambem		 	= FALSE; // Deseja que a função getOne retorne os registros(produtos) relacionados? Por padrão é falso
	public $getSome_show_vejatambem	 		= FALSE; // Deseja que a função getSome retorne os registros(produtos) relacionados? Por padrão é falso
	public $vejatambem_field_pk				= 'idregistro';
	public $vejatambem_field_fk				= 'idregistro_rel';
	public $vejatambem_field_area			= 'area';
	public $vejatambem_field_dateinsert		= 'dateinsert';
	public $vejatambem_value_area			= '';
	// Grava a mensagem em session para exibi-la ao usuário. Altere caso necessário.
	public $set_global_messages				= TRUE;
	
	public function __construct() {
		if($this->table_name){
			// Configura os campos da tabela. ( $this->describe_table )
			if( ! $this->describe_table ) {
				$q = $this->db->query('DESCRIBE '.PREF_TABLE.$this->table_name);
				
				if($q->num_rows() > 0) {
					foreach ($q->result() as $row):
						$this->describe_table[] = $row;
					endforeach;
				}
			}
			// Grava o nome dos campos da tabela. ( $this->table_fields )
			if( ! $this->table_fields){
				foreach($this->describe_table as $describe_table_row){
					$this->table_fields[] = $describe_table_row->Field;
				}
			}
			// Descobre qual é a chave primária da tabela. ( $this->primary_key )
			if(! $this->primary_key){
				foreach($this->describe_table as $describe_table_row){
					if($describe_table_row->Key == 'PRI'){
						$this->primary_key = $describe_table_row->Field;
					}
				}
			}
			// Verifica se os campos existem na tabela. ( $this->where )
			if($this->where === 'AUTO'){
				$this->where = array($this->table_field_status => $this->table_value_status_ativo);
				foreach($this->where as $key => $value){
					if( ! in_array($key,$this->table_fields)){
						unset($this->where[$key]);
					}
				}
			}
			// Verifica se os campos existem na tabela. ( $this->order_by )
			if($this->order_by === 'AUTO'){
				 $this->order_by = array($this->table_field_status => 'DESC','ordem' => 'ASC');
				foreach($this->order_by as $key => $value){
					if( ! in_array($key,$this->table_fields)){
						unset($this->order_by[$key]);
					}
				}
			}
			// Acrescenta o campo primary key na ordem da tabela. ( $this->order_by )
			if( ! array_key_exists($this->primary_key,$this->order_by)){
				if($this->primary_key){
					$this->order_by[$this->primary_key] = 'DESC';
				}
			}
			// Define área da galeria com o mesmo valor de $this->table_name. ( $this->gallery_area )
			if( ! $this->gallery_area){
				$this->gallery_area = $this->table_name;
			}
			// Define o diretório de upload
			if( ! $this->dir_upload_file){
				$this->dir_upload_file = './_file/_'.$this->table_name.'/';
			}
			// Define o diretório de upload
			if( ! $this->dir_upload_img){
				$this->dir_upload_img = './_img/_'.$this->table_name.'/';
			}
			// Define o diretório de upload
			if( ! $this->dir_upload_gallery){
				$this->dir_upload_gallery = './_img/_'.$this->table_name.'/_gallery';
			}
			// Define área da galeria com o mesmo valor de $this->table_name. ( $this->gallery_area )
			if( ! $this->tags_value_area){
				$this->tags_value_area = $this->table_name;
			}
			// Define área da galeria com o mesmo valor de $this->table_name. ( $this->gallery_area )
			if( ! $this->vejatambem_value_area){
				$this->vejatambem_value_area = $this->table_name;
			}
		}
	}
	
	public function _select(){
		$this->db->select($this->table_name.'.*');
	}
	public function _from(){
		if(isset($this->table_name)){
			$this->db->from(PREF_TABLE.$this->table_name.' as '.$this->table_name);
		}
	}
	public function _join(){
		//$this->db->join(PREF_TABLE.'cursos as cursos',$this->table_name.'.idcurso = cursos.idcurso','left');
	}
	public function _order_by(){
		if(is_array($this->order_by)){
			foreach($this->order_by as $key => $value){
				$this->db->order_by($this->table_name.'.'.$key.' '.$value);
			}
		}
	}
	public function _where(){
		if(is_array($this->where)){
			foreach($this->where as $key => $value){
				$this->db->where($this->table_name.'.'.$key,$value);
			}
		}
	}
	public function _limit($maximo = NULL,$inicio = NULL){
		if($maximo !== NULL && $inicio !== NULL){
			$this->db->limit($maximo,$inicio);
		}elseif($maximo !== NULL && $inicio === NULL){
			$this->db->limit($maximo);
		}
	}
	public function search($busca_key,$busca_value){
		/*
		if($busca_key == 'titulo') {
			$this->db->where($this->table_name.'.'.$busca_key,$busca_value);
		}
		*/
		return FALSE;
	}
	public function _search($busca){
		if(is_array($busca)) {
			foreach($busca as $busca_key=>$busca_value) {
				if(!$this->search($busca_key,$busca_value)) {
					// Faz uma busca geral em todos os campos da tabela
					if($busca_key == 'busca_geral') {
						$busca_geral = false;
						foreach($this->table_fields as $field) {
							$busca_geral[] = '`'.$this->table_name.'`.`'.$field.'` like "%'.$busca_value.'%"';
						}
						if($busca_geral) {
							$busca_geral = implode(' OR ',$busca_geral);
							$this->db->where('('.$busca_geral.') AND 1','1',false);
						}
					} else {
						// Faz uma busca simples em um campo expecifico da tabela
						foreach($this->table_fields as $field) {
							if($busca_key == $field) {
								$this->db->where($this->table_name.'.'.$field,$busca_value);
							}
						}
					}
				}
			}
		} elseif($busca) {
			$this->search('busca_simples',$busca);
		}
		/*
		* Exemplos de buscas a serem utilizadas
		*
		if(is_array($busca) && isset($busca['titulo'])) {
			$this->db->where('categorias.nome_seo',$busca['titulo']);
		}
		$this->db->where('(`titulo` like "%'.$busca.'%" OR '.
						 '`resumo` like "%'.$busca.'%" OR '.
						 '`texto` like "%'.$busca.'%") AND 1','1',false);
		*/
	}
	public function _construct_table(){
		$this->_select();
		$this->_from();
		$this->_join();
		$this->_where();
		$this->_order_by();
	}
	
	
	
	public function getOne($id)	{
		$this->_construct_table();
		$this->db->where($this->primary_key,$id);
		$this->_limit(1);
  
		$q = $this->db->get();

		if($q->num_rows() > 0) {
			foreach ($q->result() as $row):
				
				if($this->getOne_show_gallery){
					$gallery_fk = $this->primary_key;
					$row->images_gallery = (array)$this->getSomeGallery($row->$gallery_fk);
				}
				
				if($this->getOne_show_tags){
					$tags_fk = $this->primary_key;
					$row->tags = (array)$this->getSomeTags_byArea($row->$tags_fk);
				}
				
				if($this->getOne_show_vejatambem){
					$vejatambem_pk = $this->primary_key;
					$row->vejatambem = (array)$this->getSomeVejaTambem($row->$vejatambem_pk);
				}
				
				return $row;
			endforeach;
		}
	}
	
	public function countSome($busca = NULL) {
		$this->_construct_table();
		$this->_search($busca);

		return $this->db->count_all_results();
	}
	
	public function getSome($maximo = NULL,$inicio = NULL,$busca = NULL) {
		$this->_construct_table();
		$this->_search($busca);
		$this->_limit($maximo,$inicio);

		$q = $this->db->get();

		if($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				if($this->getSome_show_gallery){
					$gallery_fk = $this->primary_key;
					$row->images_gallery = (array)$this->getSomeGallery($row->$gallery_fk);
				}
				if($this->getSome_show_tags){
					$tags_fk = $this->primary_key;
					$row->tags = (array)$this->getSomeTags_byArea($row->$tags_fk);
				}
				if($this->getOne_show_vejatambem){
					$vejatambem_pk = $this->primary_key;
					$row->vejatambem = (array)$this->getSomeVejaTambem($row->$vejatambem_pk);
				}
				$data[] = $row;
			}
			return $data;
		}
	}
	
	public function getSomeExcept($id = FALSE,$maximo = NULL,$inicio = NULL,$busca = NULL) {
		if($id) {
			if(is_array($id)) {
				$this->db->where_not_in($this->table_name.'.'.$this->primary_key,$id);
			} else {
				$this->db->where($this->table_name.'.'.$this->primary_key.' <>',$id);
			}
		}
		return $this->getSome($maximo,$inicio,$busca);
	}
	
	public function countAllGallery($gallery_fk = NULL) {
		$this->db->select('*');
		$this->db->from(PREF_TABLE.$this->gallery_table_name);
		if(isset($this->area_galeria)){
			$this->db->where($this->gallery_fk,$gallery_fk);
		}
		if(isset($this->area_galeria)){
			$this->db->where($this->gallery_field_area,$this->gallery_area);
		}
				
		return $this->db->count_all_results();
	}
	
	public function getSomeGallery($gallery_fk = NULL,$maximo = NULL,$inicio = NULL) {
		$this->db->select('*');
		$this->db->from(PREF_TABLE.$this->gallery_table_name);
		if(isset($gallery_fk)){
			$this->db->where($this->gallery_fk,$gallery_fk);
		}
		if(isset($this->gallery_area)){
			$this->db->where($this->gallery_field_area,$this->gallery_area);
		}
		$this->_limit($maximo,$inicio);
				
		$q = $this->db->get();				
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row):
				$data[] = $row;
			endforeach;
			return $data;
		}	
	}
	
	public function countAllTags($tags_fk = NULL) {
		$this->db->select('*');
		$this->db->from(PREF_TABLE.$this->tags_table_name);
		if(isset($this->tags_field_fk)){
			$this->db->where($this->tags_field_fk,$tags_fk);
		}
		if(isset($this->tags_field_area)){
			$this->db->where($this->tags_field_area,$this->tags_value_area);
		}
		$this->db->where($this->tags_table_name.'.status','publicado');
		
		return $this->db->count_all_results();
	}
	
	public function getSomeTags($tags_fk = NULL,$maximo = NULL,$inicio = NULL) {
		$this->db->select($this->tags_table_name.'.*');
		$this->db->from(PREF_TABLE.$this->tags_table_name.' as '.$this->tags_table_name);
		$this->db->join(PREF_TABLE.$this->tags_rel_table_name.' as '.$this->tags_rel_table_name,$this->tags_table_name.'.'.$this->tags_field_pk.' = '.$this->tags_rel_table_name.'.'.$this->tags_field_pk,'left');
		
		if($tags_fk !== NULL) $this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_fk,$tags_fk);
		$this->db->where($this->tags_table_name.'.status','publicado');
		$this->db->order_by($this->tags_table_name.'.'.$this->tags_field_name, 'ASC');
		$this->db->order_by($this->tags_table_name.'.'.$this->tags_field_pk, 'DESC');
		$this->db->group_by($this->tags_table_name.'.'.$this->tags_field_pk);
		$this->_limit($maximo,$inicio);
		
		$q = $this->db->get();				
		if($q->num_rows() > 0) {
			foreach ($q->result() as $row):
				$data[] = $row;
			endforeach;
			return $data;
		}
	}
	
	public function getSomeTags_byArea($tags_fk = NULL,$maximo = NULL,$inicio = NULL) {
		$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_area,$this->tags_value_area);
		return $this->getSomeTags($tags_fk,$maximo,$inicio);
	}
	
	public function countSomeByIDTag($busca = NULL) {
		/*
		print_r($idtag);
		$busca = NULL;
		$this->db->join(PREF_TABLE.$this->tags_rel_table_name.' as '.$this->tags_rel_table_name,$this->table_name.'.'.$this->primary_key.' = '.$this->tags_rel_table_name.'.'.$this->tags_field_fk,'left');
		$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_area,$this->tags_value_area);
		if(is_array($idtag) && isset($idtag['idtag'])) {
			$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_pk,$idtag['idtag']);
			$busca = $idtag;
		} elseif(is_string($idtag) || is_int($idtag)) {
			$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_pk,$idtag);
		}
		
		$this->db->group_by($this->table_name.'.'.$this->primary_key);
		*/
		if((is_array($busca) && isset($busca['idtag'])) || is_string($busca) || is_int($busca)) {
			$this->db->join(PREF_TABLE.$this->tags_rel_table_name.' as '.$this->tags_rel_table_name,$this->table_name.'.'.$this->primary_key.' = '.$this->tags_rel_table_name.'.'.$this->tags_field_fk,'left');
			$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_area,$this->tags_value_area);
			if(is_array($busca) && isset($busca['idtag'])) {
				$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_pk,$busca['idtag']);
			} elseif(is_string($busca) || is_int($busca)) {
				$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_pk,$busca);
			}
			$this->db->group_by($this->table_name.'.'.$this->primary_key);
		}
		//return $this->countSome();
		return count($this->getSome(NULL,NULL,$busca));
	}
	
	public function getSomeByIDTag($maximo = NULL,$inicio = NULL,$busca = NULL) {
		if((is_array($busca) && isset($busca['idtag'])) || is_string($busca) || is_int($busca)) {
			$this->db->join(PREF_TABLE.$this->tags_rel_table_name.' as '.$this->tags_rel_table_name,$this->table_name.'.'.$this->primary_key.' = '.$this->tags_rel_table_name.'.'.$this->tags_field_fk,'left');
			$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_area,$this->tags_value_area);
			if(is_array($busca) && isset($busca['idtag'])) {
				$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_pk,$busca['idtag']);
			} elseif(is_string($busca) || is_int($busca)) {
				$this->db->where($this->tags_rel_table_name.'.'.$this->tags_field_pk,$busca);
			}
			$this->db->group_by($this->table_name.'.'.$this->primary_key);
		}
		return $this->getSome($maximo,$inicio,$busca);
	}
	
	public function getSomeVejaTambem($vejatambem_pk = NULL,$maximo = NULL,$inicio = NULL) {
		$this->db->join(PREF_TABLE.$this->vejatambem_rel_table_name.' as '.$this->vejatambem_rel_table_name,$this->vejatambem_rel_table_name.'.'.$this->vejatambem_field_fk.' = '.$this->table_name.'.'.$this->primary_key);
		if($vejatambem_pk !== NULL) $this->db->where($this->vejatambem_rel_table_name.'.'.$this->vejatambem_field_pk,$vejatambem_pk);
		$this->db->where($this->vejatambem_rel_table_name.'.'.$this->vejatambem_field_area,$this->vejatambem_value_area);
		
		// Muda os valores para FALSO para evitar looping infinito no código e depois retorna ao valor original
		$getOne_show_vejatambem_aux	 = $this->getOne_show_vejatambem;
		$getSome_show_vejatambem_aux = $this->getSome_show_vejatambem;
		$this->getOne_show_vejatambem  = FALSE;
		$this->getSome_show_vejatambem = FALSE;
		
		$return = $this->getSome($maximo,$inicio);
		
		$this->getOne_show_vejatambem  = $getOne_show_vejatambem_aux;
		$this->getSome_show_vejatambem = $getSome_show_vejatambem_aux;
		
		return $return;
	}
	
	
	
	/**************************************
	***
	***  Insert, update e delete
	***
	***************************************/
	public function insertOneField($table_field,&$dados){
		/*if($table_field == 'titulo') {
			$dados = array_merge( $dados,array('`titulo`' => $this->input->post('titulo')) );
			return true;
		} elseif($table_field == 'resumo') {
			$dados = array_merge( $dados,array('`resumo`' => $this->input->post('resumo')) );
			return true;
		}*/
	}
	public function insertOneField2($table_field,&$dados,$insert_id){
		/*if($table_field == 'titulo') {
			$dados = array_merge( $dados,array('`titulo`' => $this->input->post('titulo')) );
			return true;
		} elseif($table_field == 'resumo') {
			$dados = array_merge( $dados,array('`resumo`' => $this->input->post('resumo')) );
			return true;
		}*/
	}
	public function insertTags($table_fields,&$dados,$insert_id){
		// Insere as tags na tabela
		// Pode inserir a partir de um campo string separado por virgulas. O nome do campo deve ser "tags"
		// Pode inserir a partir de uma lista de checkbox. O campo deve ser um array com o nome de "tags_id"
		
		if(!$this->getOne_show_tags) {
			return false;
		}
		// Apaga as tags e depois insere novamente
		$this->db->where($this->tags_field_fk, $insert_id);
		$this->db->where($this->tags_field_area,$this->tags_value_area);
		$this->db->delete(PREF_TABLE.$this->tags_rel_table_name);
		
		//faz um explode para separar as tags para iniciar o cadastro
		$tags = explode (",",$this->input->post($this->tags_form_name));				
		//cadastra as tags que foram separadas no banco de dados
		foreach($tags as $tag_name){
			$tag_name = trim($tag_name);
			if($tag_name != '') {
				$this->db->select('*');
				$this->db->where($this->tags_field_name,$tag_name);
				$this->db->from(PREF_TABLE.$this->tags_table_name);
				$this->db->limit(1);
				$q = $this->db->get();
				if($q->num_rows() == 0) {
					// Insere o nome da tag
					$this->db->set($this->tags_field_name, $tag_name);
					$this->db->set($this->tags_field_name_seo, $this->encurtaurl->sanitize_title_with_dashes($tag_name));
					$this->db->set('status', 'publicado');
					if($this->tags_field_dateinsert) $this->db->set($this->tags_field_dateinsert, 'NOW()', FALSE);
					if($this->tags_field_dateupdate) $this->db->set($this->tags_field_dateupdate, 'NOW()', FALSE);
					$this->db->insert(PREF_TABLE.$this->tags_table_name);
					$idtag = $this->db->insert_id();
				} else {
					// Pega o id da tag ja inserida
					foreach ($q->result() as $row):
						$idtag = $row->idtag;
					endforeach;
				}
				// Faz o relacionamento da tag com o post
				$data_tag = array(
					$this->tags_field_pk => $idtag,
					$this->tags_field_fk => $insert_id,
					$this->tags_field_area => $this->tags_value_area
				);
				if($this->tags_field_dateinsert) $this->db->set($this->tags_field_dateinsert, 'NOW()', FALSE);
				$this->db->insert(PREF_TABLE.$this->tags_rel_table_name, $data_tag);
			}
		}
		
		if($this->input->post($this->tags_id_form_name)){
			// Insere as tags na tabela
			// Pega o array das tags
			$tags = $this->input->post($this->tags_id_form_name);
			//cadastra as tags que foram separadas no banco de dados
			foreach($tags as $idtag){
				// Faz o relacionamento da tag com o post
				$data_tag = array(
					$this->tags_field_pk => $idtag,
					$this->tags_field_fk => $insert_id,
					$this->tags_field_area => $this->tags_value_area
				);
				$this->db->insert(PREF_TABLE.$this->tags_rel_table_name, $data_tag);
			}
		}
	}
	public function insertVejatambem($table_fields,&$dados,$insert_id){
		// Insere as tags na tabela
		// Pode inserir a partir de um campo string separado por virgulas. O nome do campo deve ser "tags"
		// Pode inserir a partir de uma lista de checkbox. O campo deve ser um array com o nome de "tags_id"
		
		
		
		if(!$this->getOne_show_vejatambem) {
			return false;
		}
		// Apaga as tags e depois insere novamente
		$this->db->where($this->vejatambem_field_pk, $insert_id);
		$this->db->where($this->vejatambem_field_area,$this->vejatambem_value_area);
		$this->db->delete(PREF_TABLE.$this->vejatambem_rel_table_name);
		
		// Insere as tags na tabela
		// Pega o array das tags
		$veja_tambem_array = $this->input->post('veja_tambem');
		//cadastra as tags que foram separadas no banco de dados
		foreach($veja_tambem_array as $idveja_tambem){
			// Faz o relacionamento da tag com o post
			$data_tag = array(
				$this->vejatambem_field_pk => $insert_id,
				$this->vejatambem_field_fk => $idveja_tambem,
				$this->vejatambem_field_area => $this->vejatambem_value_area
			);
			if($this->vejatambem_field_dateinsert) $this->db->set($this->vejatambem_field_dateinsert, 'NOW()', FALSE);
			$this->db->insert(PREF_TABLE.$this->vejatambem_rel_table_name, $data_tag);
		}
	}
	
	public function insertOne(){
		if( ! @$this->help ) $this->load->library('help');
		if( ! @$this->encurtaurl ) $this->load->library('encurtaurl');
		if( ! @$this->gerarmenu ) $this->load->library('gerarmenu');
		
		$this->config_upload = array();
		$this->config_upload['upload_path']				= $this->dir_upload_img;
		$this->config_upload['encrypt_name']			= $this->encrypt_name;
		$this->config_upload['resize'] 					= $this->resize;
		$this->config_upload['constrain_proportion']	= $this->constrain_proportion;
		$this->config_upload['img_max_width']			= $this->img_max_width;
		$this->config_upload['img_max_height']			= $this->img_max_height;
		$this->config_upload['create_thumb']			= $this->create_thumb;
		$this->config_upload['upload_thumb_path']		= $this->dir_upload_thumb;
		$this->config_upload['thumb_marker']			= $this->thumb_marker;
		$this->config_upload['resize_thumb'] 			= $this->resize_thumb;
		$this->config_upload['thumb_proportion']		= $this->thumb_proportion;
		$this->config_upload['thumb_max_width']			= $this->thumb_max_width;
		$this->config_upload['thumb_max_height']		= $this->thumb_max_height;
		
		$dados = array();
		$input_post = $this->input->post();
		
		foreach($this->table_fields as $table_field){
			
			if($this->insertOneField($table_field,$dados)) {
				// Chama a função unsertOneField() para que possa configurar um upload para um campo especifico
				
			// SEO
			} elseif(substr($table_field, -4) == '_seo') {
				//Caso não tenha o titulo ele cria o titulo SEO se baseando pelo texto
				if(@$this->input->post('titulo')){		
					$aux_seo = $this->encurtaurl->sanitize_title_with_dashes($this->input->post(substr($table_field,0,-4)));
					$dados = array_merge( $dados, array($table_field => $aux_seo ) );
				} else {
					$this->load->library('help');
					$campo_seo = $this->help->cortaFrase($this->help->retiraTagHTML($this->input->post('texto')),40);
					$aux_seo = $this->encurtaurl->sanitize_title_with_dashes($campo_seo);
					$dados = array_merge( $dados, array($table_field => $aux_seo ) );
				}		
				
			// Status
			} elseif($table_field == $this->table_field_status) {
				if(@$input_post[$table_field] == $this->table_value_status_ativo) {
					$dados = array_merge( $dados,array($table_field => $this->table_value_status_ativo) );
				} else {
					$dados = array_merge( $dados,array($table_field => $this->table_value_status_inativo) );
				}
				
			// Destaque
			} elseif($table_field == 'destaque') {
				if(@$input_post[$table_field] != '') {
					$dados = array_merge( $dados,array($table_field => $input_post[$table_field]) );
				} else {
					$dados = array_merge( $dados,array($table_field => '0') );
				}
				
			// Arquivo (Documento, Audio, Video)
			} elseif(in_array($table_field,array('file','arquivo')) && array_key_exists($table_field, $_FILES)) {
				$arquivo = $this->help->UploadArquivo('Tudo',$table_field,$this->dir_upload_file);
				$dados = array_merge( $dados,array($table_field => $arquivo));
				
			// Imagem
			} elseif(array_key_exists($table_field, $_FILES)) {
				$this->config_upload['fileUpload']		= $table_field;
				$this->config_upload['allowed_types']	= $this->allowed_types;
				if($this->img_seo_field_name){
					$this->config_upload['file_name']		= $this->encurtaurl->sanitize_title_with_dashes($this->input->post($this->img_seo_field_name));
					$this->config_upload['encrypt_name']	= FALSE;
				}
				$imagem = $this->help->UploadImagem($this->config_upload);
				if($imagem) {
					$dados = array_merge( $dados,array($table_field => $imagem));
				}
				$this->config_upload['encrypt_name']		= $this->encrypt_name;
				
			// DATE INSERT
			} elseif($table_field == $this->table_field_dateinsert) {
				$this->db->set($table_field, 'NOW()', FALSE);
				
			// DATE UPDATE
			} elseif($table_field == $this->table_field_dateupdate) {
				$this->db->set($table_field, 'NOW()', FALSE);
				
			// Campos texto
			} elseif($this->input->post($table_field)){
				$dados = array_merge( $dados,array($table_field => $this->input->post($table_field)) );
			}
		}
		
		// Faz o insert no banco de dados
		$insert = $this->db->insert(PREF_TABLE.$this->table_name, $dados);	
		$insert_id = $this->db->insert_id();//Pega o último id gerado
		
		// Chama a função para inserir as Tags
		$this->insertTags($this->table_fields,$dados,$insert_id);
		
		// Chama a função insertOneField2() para que possa configurar uma função para outra tabela. Como galeria de fotos, tags etc
		if($this->insertOneField2($this->table_fields,$dados,$insert_id)){
			
		} else {
			// Faz o upload da galeria de imagens
			$config_upload['allowed_types']		= $this->allowed_types;
			$config_upload['upload_path']		= $this->dir_upload_gallery;
			$this->load->library('upload');
			$this->upload->initialize($config_upload);
			$this->load->library('Multi_upload');
			
			// Cria a pasta de galeria de imagens
			$dir = explode('/',$config_upload['upload_path']);
			$dir_aux = '';
			foreach($dir as $dir_row) {
				if($dir_aux == ''){
					$dir_aux = $dir_row;
				} else {
					$dir_aux .= '/'.$dir_row;
				}
				if(!is_dir($dir_aux)){
					mkdir($dir_aux, 0755 );
				}
			}
			
			$gallery_images = $this->multi_upload->go_upload();
			
			if ( ! $gallery_images ) {
				$error = array('error' => $this->upload->display_errors());	
				//print_r($this->upload->display_errors());
			} else {
				foreach($gallery_images as $key=> $image) :	
					$imagem = array(
						$this->gallery_fk => $insert_id,	
						$this->gallery_field_image => $image['name'],
						$this->gallery_field_area => $this->gallery_area
					);
					$this->db->set($this->gallery_field_area, 'NOW()', FALSE);
					if($this->gallery_field_dateinsert) $this->db->set($this->gallery_field_dateinsert, 'NOW()', FALSE);
					if($this->gallery_field_dateupdate) $this->db->set($this->gallery_field_dateupdate, 'NOW()', FALSE);
					$this->db->insert(PREF_TABLE.$this->gallery_table_name, $imagem);
				endforeach;
			}
		}
		//grava a mensagem em session para exibir
		if($this->set_global_messages) {
			$msg = array('Registro inserido com sucesso');
			$this->gerarmenu->set_global_messages($msg, 'success_messages');
		}
		return $insert_id;
	}
	
	
	public function updateOne(){
		if( ! @$this->help ) $this->load->library('help');
		if( ! @$this->encurtaurl ) $this->load->library('encurtaurl');
		if( ! @$this->gerarmenu ) $this->load->library('gerarmenu');
		
		$this->config_upload = array();
		$this->config_upload['upload_path']				= $this->dir_upload_img;
		$this->config_upload['encrypt_name']			= $this->encrypt_name;
		$this->config_upload['resize'] 					= $this->resize;
		$this->config_upload['constrain_proportion']	= $this->constrain_proportion;
		$this->config_upload['img_max_width']			= $this->img_max_width;
		$this->config_upload['img_max_height']			= $this->img_max_height;
		$this->config_upload['create_thumb']			= $this->create_thumb;
		$this->config_upload['upload_thumb_path']		= $this->dir_upload_thumb;
		$this->config_upload['thumb_marker']			= $this->thumb_marker;
		$this->config_upload['resize_thumb'] 			= $this->resize_thumb;
		$this->config_upload['thumb_proportion']		= $this->thumb_proportion;
		$this->config_upload['thumb_max_width']			= $this->thumb_max_width;
		$this->config_upload['thumb_max_height']		= $this->thumb_max_height;

		if($this->input->post('alt_galeria')){
			foreach($this->input->post('alt_galeria') as $key=> $alt_galeria):				
				$alt_galeria = array(
						'idgaleria' => $key,
						'alt_galeria' => $alt_galeria
					);	
				$this->db->where('idgaleria', $key);
				$this->db->update(PREF_TABLE.$this->gallery_table_name,$alt_galeria);			
			endforeach;	
		}
		
		$dados = array();
		$input_post = $this->input->post();
		foreach($this->input->post() as $key => $value) {
			if($key == 'apagar_galeria') {
				$idimagens = explode(',',$this->input->post('apagar_galeria'));
				
				//procura o nome das imagens para apagar na pasta do servidor
				$this->db->select('*');
				$this->db->from(PREF_TABLE.$this->gallery_table_name);
				$this->db->where_in($this->gallery_pk,$idimagens);
				
				$q = $this->db->get();
				if($q->num_rows() > 0) {
					foreach ($q->result() as $row):
						//deleta a imagem do servidor
						$path = SITE_ROOT.'/'.$this->dir_upload_gallery.'/'.$row->imagem;
						@unlink($path);
					endforeach;
					//deleta o relecionamento pagina e imagem
					$this->db->where_in($this->gallery_pk,$idimagens);
					$this->db->delete(PREF_TABLE.$this->gallery_table_name);
				}
			// APAGAR IMAGEM
			} elseif(substr($key, 0,7) == 'apagar_' && in_array(substr($key, 7),$this->table_fields)) {
				//procura o nome das imagens para apagar na pasta do servidor
				$this->db->select(substr($key, 7));
				$this->db->from(PREF_TABLE.$this->table_name);
				$this->db->where_in($this->primary_key,$this->input->post($this->primary_key));
				
				$q = $this->db->get();
				if($q->num_rows() > 0) {
					foreach ($q->result() as $row):
						//deleta a imagem do servidor
						$path = SITE_ROOT.'/'.$this->dir_upload_img.'/'.$row->imagem;
						@unlink($path);
						$path = SITE_ROOT.'/'.$this->dir_upload_thumb.'/'.$row->imagem;
						@unlink($path);
					endforeach;
				}
				$aux_apagar = substr($key,7);
				$dados = array_merge( $dados, array($aux_apagar => '' ) );
			}
		}
		foreach($this->table_fields as $table_field){
			
			if($this->insertOneField($table_field,$dados)) {
				// Chama a função unsertOneField() para que possa configurar um upload para um campo especifico
				
			// SEO
			} elseif(substr($table_field, -4) == '_seo') {
				//Caso não tenha o titulo ele cria o titulo SEO se baseando pelo texto
				if(@$this->input->post('titulo')){		
					$aux_seo = $this->encurtaurl->sanitize_title_with_dashes($this->input->post(substr($table_field,0,-4)));
					$dados = array_merge( $dados, array($table_field => $aux_seo ) );
				} else {
					$this->load->library('help');
					$campo_seo = $this->help->cortaFrase($this->help->retiraTagHTML($this->input->post('texto')),40);
					$aux_seo = $this->encurtaurl->sanitize_title_with_dashes($campo_seo);
					$dados = array_merge( $dados, array($table_field => $aux_seo ) );
				}				
			// Status
			} elseif($table_field == $this->table_field_status) {
				if(@$input_post[$table_field] == $this->table_value_status_ativo) {
					$dados = array_merge( $dados,array($table_field => $this->table_value_status_ativo) );
				} else {
					$dados = array_merge( $dados,array($table_field => $this->table_value_status_inativo) );
				}
			// Destaque
			} elseif($table_field == 'destaque') {
				if(@$input_post[$table_field] != '') {
					$dados = array_merge( $dados,array($table_field => $input_post[$table_field]) );
				} else {
					$dados = array_merge( $dados,array($table_field => '0') );
				}
				
			// Arquivo (Documento, Audio, Video)
			} elseif(in_array($table_field,array('file','arquivo')) && array_key_exists($table_field, $_FILES)) {
				$arquivo = $this->help->UploadArquivo('Tudo',$table_field,$this->dir_upload_file);
				if($arquivo) {					
					$dados = array_merge( $dados,array($table_field => $arquivo));
				}					
			// Imagem
			} elseif(array_key_exists($table_field, $_FILES)) {
				$this->config_upload['fileUpload']			= $table_field;
				$this->config_upload['allowed_types']		= $this->allowed_types;
				if($this->img_seo_field_name){
					$this->config_upload['file_name']		= $this->encurtaurl->sanitize_title_with_dashes($this->input->post($this->img_seo_field_name));
					$this->config_upload['encrypt_name']	= FALSE;
				}
				$imagem = $this->help->UploadImagem($this->config_upload);
				if($imagem) {
					$dados = array_merge( $dados,array($table_field => $imagem));
				}
				$this->config_upload['encrypt_name']		= $this->encrypt_name;
				
			// Senha
			} elseif($table_field == 'senha' || $table_field == 'password') {
				if($this->input->post($table_field) != ''){
					$dados = array_merge( $dados,array($table_field => $this->input->post($table_field)) );
				}
				
			// DATE UPDATE
			} elseif($table_field == $this->table_field_dateupdate) {
				$this->db->set($table_field, 'NOW()', FALSE);
				
			// Campos texto
			} elseif(isset($input_post[$table_field])){
				$dados = array_merge( $dados,array($table_field => $this->input->post($table_field)) );
			}
		}
		
		$this->db->where($this->primary_key, $this->input->post($this->primary_key));
		$this->db->update(PREF_TABLE.$this->table_name, $dados);
		$insert_id = $this->input->post($this->primary_key);
		
		// Chama a função para inserir as Tags
		$this->insertTags($this->table_fields,$dados,$insert_id);
		$this->insertVejatambem($this->table_fields,$dados,$insert_id);
		
		// Chama a função insertOneField2() para que possa configurar um upload para outra tabela. Como galeria de fotos e 
		if($this->insertOneField2($this->table_fields,$dados,$insert_id)){
			
		} else {
			// Faz o upload da galeria de imagens
			$config_upload['allowed_types']		= $this->allowed_types;
			$config_upload['upload_path']		= $this->dir_upload_gallery;
			$this->load->library('upload');
			$this->upload->initialize($config_upload);
			$this->load->library('Multi_upload');
			
			// Cria a pasta de galeria de imagens
			$dir = explode('/',$config_upload['upload_path']);
			$dir_aux = '';
			foreach($dir as $dir_row) {
				if($dir_aux == ''){
					$dir_aux = $dir_row;
				} else {
					$dir_aux .= '/'.$dir_row;
				}
				if(!is_dir($dir_aux)){
					mkdir($dir_aux, 0755 );
				}
			}
			
			$gallery_images = $this->multi_upload->go_upload();

			if($this->input->post('legenda_galeria')){
			
				foreach($this->input->post('legenda_galeria') as $key=> $legenda_galeria):
					
					/*print_r($key .' - '.$legenda_galeria);
					$imagem_legenda = array(
							'idgaleria' => $key,	
							'legenda_galeria' => $legenda_galeria
						);*/
						
					$this->db->where('idgaleria', $key);
					$this->db->update(PREF_TABLE.$this->gallery_table_name,$imagem_legenda);
				
				endforeach;	
			}	
			
			if ( ! $gallery_images ) {
				$error = array('error' => $this->upload->display_errors());	
				//print_r($this->upload->display_errors());
			} else {
				foreach($gallery_images as $key=> $image) :	
					$imagem = array(
						$this->gallery_fk => $insert_id,	
						$this->gallery_field_image => $image['name'],
						$this->gallery_field_area => $this->gallery_area
					);
					$this->db->insert(PREF_TABLE.$this->gallery_table_name, $imagem);
				endforeach;
			}
		}
				
		//grava a mensagem em session para exibir
		if($this->set_global_messages) {
			$msg = array('Registro alterado com sucesso');
			$this->gerarmenu->set_global_messages($msg, 'success_messages');
		}
		return $this->input->post($this->primary_key);
	}
	
	public function updateStatus($id,$status) {
		if($status=='deletar') {
			$this->db->where($this->primary_key, $id);
			$this->db->delete(PREF_TABLE.$this->table_name);
			//grava a mensagem em session para exibir
			if($this->set_global_messages) {
				$msg = array('Registro deletado com sucesso');
				$this->gerarmenu->set_global_messages($msg, 'success_messages');
			}
		}else {
			if($status == 'publicado') {
				$dados= array( $this->table_field_status => $this->table_value_status_ativo);
			} elseif($status == 'inativo') {
				$dados= array( $this->table_field_status => $this->table_value_status_inativo);
			} else {
				$dados= array( $this->table_field_status => $status);
			}
			($this->table_field_dateupdate)?$this->db->set($this->table_field_dateupdate, 'NOW()', FALSE):NULL;
			$this->db->where($this->primary_key, $id);
			$this->db->update(PREF_TABLE.$this->table_name, $dados);
			//grava a mensagem em session para exibir
			if($this->set_global_messages) {
				$msg = array('Registro alterado com sucesso');
				$this->gerarmenu->set_global_messages($msg, 'success_messages');
			}
		}
	}
	
	public function updateStatusOpcao() {
		switch ($this->input->post('opcao')) {
			case 'publicado':
				$ids = explode(',',$this->input->post('id'));
				foreach($ids as $id):
					$dados= array(
								$this->table_field_status => $this->table_value_status_ativo,
							);
					($this->table_field_dateupdate)?$this->db->set($this->table_field_dateupdate, 'NOW()', FALSE):NULL;
					$this->db->where($this->primary_key, $id);
					$this->db->update(PREF_TABLE.$this->table_name, $dados);
				endforeach;		
				//grava a mensagem em session para exibir
				if($this->set_global_messages) {
					$msg = array('Registros publicados com sucesso');
					$this->gerarmenu->set_global_messages($msg, 'success_messages');
				}
			break;
			case 'inativo':
				$ids = explode(',',$this->input->post('id'));
				foreach($ids as $id):
					$dados= array(
								$this->table_field_status =>  $this->table_value_status_inativo,
							);
					($this->table_field_dateupdate)?$this->db->set($this->table_field_dateupdate, 'NOW()', FALSE):NULL;
					$this->db->where($this->primary_key, $id);
					$this->db->update(PREF_TABLE.$this->table_name, $dados);
				endforeach;		
				//grava a mensagem em session para exibir
				if($this->set_global_messages) {
					$msg = array('Registros inativados com sucesso');
					$this->gerarmenu->set_global_messages($msg, 'success_messages');
				}	
			break;
			case 'deletar':				
				$ids = explode(',',$this->input->post('id'));
				foreach($ids as $id):
					$this->db->where($this->primary_key, $id);
					$this->db->delete(PREF_TABLE.$this->table_name);
				endforeach;	
				//grava a mensagem em session para exibir
				if($this->set_global_messages) {
					$msg = array('Registros deletados com sucesso');
					$this->gerarmenu->set_global_messages($msg, 'success_messages');
				}
			break;
		}
	}
}