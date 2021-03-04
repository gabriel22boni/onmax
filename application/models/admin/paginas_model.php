<?php

class Paginas_model extends Default_model {
	
	// VARIAVEIS
	// Preenchimento obrigatório
	public $table_name						= 'paginas';
	
	// Detalhes da tabela. Preenchimento padrão ou automático, altere apenas se for necessário
	public $where 							= array(); // Os campos inexistentes são corrigidos automaticamente. Por padrão é array('status' => 'publicado')
	
	// Diretórios para upload das imagens. Altere caso necessário.
	public $img_seo_field_name				= 'titulo'; // Renomeia a imagem com o valor passado pelo post. Ex.: 'titulo'
	
	// Tamanho máximo das imagens. Altere caso necessário.
	public $resize							= TRUE;
	public $constrain_proportion			= FALSE; // TRUE = Redimenciona a imagem sem distorcer ela. FALSE = Redimenciona para o valor exato de largura e altura
	public $img_max_width					= 550;
	public $img_max_height					= 413;
	public $gallery_encrypt_name			= TRUE; // Encripta o nome da imagem principal e das imagens da galeria
	
	public $create_thumb					= TRUE;
	public $resize_thumb					= TRUE;
	public $thumb_proportion				= FALSE; // Redimenciona a thumb sem distorcer ela. Ou redimenciona para o valor exato de largura e altura
	public $thumb_max_width					= 260;
	public $thumb_max_height				= 195;
	
	public $getOne_show_gallery 			= TRUE; // Deseja que a função getOne retorne a geleria de imagens? Por padrão é falso
	public $getSome_show_gallery 			= TRUE; // Deseja que a função getSome retorne a geleria de imagens? Por padrão é falso
		
	public $resize_gallery					= TRUE;
	public $gallery_max_width				= 800;
	public $gallery_max_height				= 600;

	public $gallery_resize_thumb			= TRUE;
	public $gallery_thumb_proportion		= FALSE;
	public $gallery_thumb_max_width			= 260;
	public $gallery_thumb_max_height		= 195;
	
	public $getOne_show_tags	 			= TRUE; // Deseja que a função getOne retorne a tags? Por padrão é falso
	public $getSome_show_tags	 			= TRUE; // Deseja que a função getSome retorne as tags? Por padrão é falso
	
	public $file_field_name					= array('file', 'arquivo', 'arquivo1');
	public $file_allowed_types				= '*';
	public $allowed_types					= '*';	
	
	public function _join(){
		$this->db->select('adm.nome as nomeAdmin');
		$this->db->join(PREF_TABLE.'adm_usuarios as adm',$this->table_name.'.id_adm_usuario = adm.id_adm_usuario','left');
	}	

	public function getOne($id)	{
		// Faz a busca da segunda galeria de imagens no banco
		$row = parent::getOne($id);// Faz a busca normal no banco
		$gallery_area_aux = $this->gallery_area;// Guarda o nome original da tabela de galerias
		$this->gallery_area = $this->gallery_area.'_1';// Altera o nome da tabela de galerias
		$row->images_gallery1 = (array)$this->getSomeGallery($id);// Faz a conssulta no banco
		$this->gallery_area = $gallery_area_aux;// Volta o nome original da tabela de galerias

		$this->gallery_area = $this->gallery_area.'_2';// Altera o nome da tabela de galerias
		$row->images_gallery2 = (array)$this->getSomeGallery($id);// Faz a conssulta no banco
		$this->gallery_area = $gallery_area_aux;// Volta o nome original da tabela de galerias

		$this->gallery_area = $this->gallery_area.'_3';// Altera o nome da tabela de galerias
		$row->images_gallery3 = (array)$this->getSomeGallery($id);// Faz a conssulta no banco
		$this->gallery_area = $gallery_area_aux;// Volta o nome original da tabela de galerias

		return $row;
	}
	
	public function insertOneField2($table_field,&$dados,$insert_id){

		if($this->input->post('titulo_video')){
			$this->db->where('idpagina', $insert_id);
			$this->db->delete(PREF_TABLE.'videos'); 

			foreach($this->input->post('titulo_video') as $key=> $videos):

				if($videos != ''){
					$data_video = array(
							   'idpagina' 			=> $insert_id,
							   'titulo_video' 		=> $videos,
							   'data_video' 		=> $_POST['data_video'][$key],
							   'descricao_video' 	=> $_POST['descricao_video'][$key],
							   'link_video' 		=> $_POST['link_video'][$key]
							);

					$this->db->insert(PREF_TABLE.'videos', $data_video);
				}

			endforeach;
		}

	$this->db->where('idregistro', $insert_id);
	$this->db->where('area', 'modelo');
	$this->db->delete(PREF_TABLE.'tags_relashionships'); 

	if($this->input->post('modelos')){		

		//$explode = explode(',',$this->input->post('modelos'));
			foreach($this->input->post('modelos') as $explode):
				if($explode){

					$data = array(
					   'idtag' 		=> $explode,
					   'idregistro' => $insert_id,
					   'area'		=> 'modelo'
					);
					$this->db->insert(PREF_TABLE.'tags_relashionships', $data);
				}
			endforeach;
	}

		if($table_field == 'destaque') {
			if($this->input->post('destaque') == 0) {
			$dados = array_merge( $dados,array('`destaque`' => '0') );
			return true;
			}
		}	
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