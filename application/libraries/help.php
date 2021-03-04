<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help {
	
	public function exibir_pagina($paginas) {
		$CI =& get_instance();
		echo '<div class="internas">';
		if($paginas) {
			foreach($paginas as $pagina) { ?>
                <h1 class="titulo"><?=$pagina->titulo?></h1><hr class="titulo" width="735" />
                <br class="clearall" />
                <div class="data"><?= $pagina->dateinsert?></div>
                <?php
                if($pagina->imagem){
                    echo '<img class="border" src="'.base_url().'_img/_'.$CI->router_class.'/'.$pagina->imagem.'" />';
                }
                ?>
                <div class="texto"><p><?=$pagina->texto?></p></div>
                <?php
			}
		}
		if(isset($CI->leia_mais)) {
			echo '<div class="titulo"><h1>Leia mais</h1></div>';
			foreach($CI->leia_mais as $leia_mais) {
                echo '<div class="titulo"><h1>'.$leia_mais->titulo.'</h1></div>';
			}
		}
		echo '</div>';
	}
	
	public function quebra_coluna($total_de_registros = 1, $total_de_colunas = 1, $posicao_atual = 1) {
		$total_de_colunas_aux = $total_de_colunas;
		$qtd_por_coluna_aux = 0;
		for($i=1;$i<$total_de_colunas;$i++){
			$qtd_por_coluna = (int)(($total_de_registros) / $total_de_colunas_aux);
			if( ($total_de_registros % $total_de_colunas_aux) >=1) {
				$qtd_por_coluna ++;
			}
			$total_de_registros -= $qtd_por_coluna;
			$total_de_colunas_aux--;
			$qtd_por_coluna_aux += $qtd_por_coluna;
			$qtd_por_coluna_array[] = $qtd_por_coluna_aux;
		}
		if(in_array($posicao_atual,(array)@$qtd_por_coluna_array)) {
			return true;
		}
	}
	
	public function save_brownser() {
		$useragent = $_SERVER['HTTP_USER_AGENT'];
	   
		if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
		  $browser_version=$matched[1];
		  $browser = 'IE';
		} elseif (preg_match( '|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
		  $browser_version=$matched[1];
		  $browser = 'Opera';
		} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
		  $browser_version=$matched[1];
		  $browser = 'Firefox';
		} elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
		  $browser_version=$matched[1];
		  $browser = 'Chrome';
		} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
		  $browser_version=$matched[1];
		  $browser = 'Safari';
		} else {
		  // browser not recognized!
		  $browser_version = 0;
		  $browser= 'other';
		}
	  
		// Abre ou cria o arquivo bloco1.txt
		// "a" representa que o arquivo é aberto para ser escrito
		$fp = @fopen("navegador.txt", "a");
		
		// Escreve "exemplo de escrita" no bloco1.txt
		$escreve = @fwrite($fp, date('d/m/y')." - browser: $browser $browser_version\r");
		
		// Fecha o arquivo
		@fclose($abre);
		
		//print "browser: $browser $browser_version";
	}
	
	public function is_logged_in_admin($redirect=TRUE,$nivel_min=0) {
		$CI =& get_instance();
		$CI->session_admin = $CI->session->userdata('admin');
		$is_logged_in = FALSE;
		
		if($nivel_min) {
			$is_logged_in_admin = @$CI->session_admin['is_logged_in_admin'];
			$nivel = $CI->session_admin['nivel'];
			if(isset($is_logged_in_admin) && $is_logged_in_admin == TRUE && isset($nivel) && $nivel >= $nivel_min) {
				$is_logged_in = TRUE;
			}
		} else {
			$is_logged_in_admin = @$CI->session_admin['is_logged_in_admin'];
			if(isset($is_logged_in_admin) && $is_logged_in_admin == TRUE) {
				$is_logged_in = TRUE;
			}
		}
		if($redirect && !$is_logged_in) {
			redirect(BASE_URL_ADMIN.'/login');
		} else {
			return $is_logged_in;
		}
	}
	
	public function is_logged_in_web($redirect=TRUE) {
		$CI =& get_instance();
		
		$CI->session_web = $CI->session->userdata('web');
		$is_logged_in = FALSE;
		
		$is_logged_in_web = @$CI->session_web['is_logged_in_web'];
		if(isset($is_logged_in_web) && $is_logged_in_web == TRUE) {
			$is_logged_in = TRUE;
		}
		if($redirect && !$is_logged_in) {
			redirect(base_url());
		} else {
			return $is_logged_in;
		}
	}
	
	public function FormataData($data) {		
		$data = explode('/',$data);
		$data_formatada = $data[2].'-'.$data[1].'-'.$data[0];
		return $data_formatada;
	}
	
	public function FormataDataPagina($data) {
		$data = str_replace(' ','-',$data);
		$data = explode('-',$data);
		$data_formatada = $data[2].'/'.$data[1].'/'.$data[0].' '.@$data[3];
		return $data_formatada;
	}
	
	public function remove_acento($var) {
		$array1 = array( " ", "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç"
, "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç" );
		$array2 = array( "+", "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c"
		, "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C" );
		$var = str_replace( $array1, $array2, $var);
		
		$var = @ereg_replace("[^a-zA-Z0-9+]", "", $var);
		
		$var = strtolower($var);
		
		return $var;
	}
	
	public function remove_acento2($var) {

		$var = strtolower($var);
		
		$var = @ereg_replace("[áàâãª]","a",$var);	
		$var = @ereg_replace("[éèê]","e",$var);	
		$var = @ereg_replace("[óòôõº]","o",$var);	
		$var = @ereg_replace("[úùû]","u",$var);	
		$var = @str_replace("ç","c",$var);
		
		return $var;
	}	

	public function remove_acento3($string, $slug = false) {
		$string = strtolower($string);
	
		// Código ASCII das vogais
		$ascii['a'] = range(224, 230);
		$ascii['e'] = range(232, 235);
		$ascii['i'] = range(236, 239);
		$ascii['o'] = array_merge(range(242, 246), array(240, 248));
		$ascii['u'] = range(249, 252);
	
		// Código ASCII dos outros caracteres
		$ascii['b'] = array(223);
		$ascii['c'] = array(231);
		$ascii['d'] = array(208);
		$ascii['n'] = array(241);
		$ascii['y'] = array(253, 255);
	
		foreach ($ascii as $key=>$item) {
			$acentos = '';
			foreach ($item AS $codigo) $acentos .= chr($codigo);
			$troca[$key] = '/['.$acentos.']/i';
		}
	
		$string = preg_replace(array_values($troca), array_keys($troca), $string);
	
		// Slug?
		if ($slug) {
			// Troca tudo que não for letra ou número por um caractere ($slug)
			$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
			// Tira os caracteres ($slug) repetidos
			$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
			$string = trim($string, $slug);
		}
	
		return urlencode($string);
	}
	
	public function redimenciona($x,$y,$x_max,$y_max){
		if($x > $x_max && $x_max != 0){//Vê se a largua ultrapassa o limite
			$x2 = $x_max;
			$y2 = ($y * $x2)/$x;
		}
		else{
			$x2 = $x;
			$y2 = $y;
		}
		if($y2 > $y_max && $y_max != 0){//Vê se a altura ultrapassa o limite
			$x2 = ($x2 * $y_max)/$y2;
			$y2 = $y_max;
		}
		$dados['largura']=$x2;
		$dados['altura']=$y2;
		return $dados;
	}
	
	public function UploadImagem($config2 = array()) {
		$config['fileUpload']		= 'userfile';
		$config['allowed_types']	= 'gif|jpg|png|jpeg|bmp|tif|tiff';
		$config['file_name']		= '';
		$config['upload_path']		= './_img/';
		$config['encrypt_name']		= TRUE;
		$config['resize']			= FALSE;
		$config['constrain_proportion']	= TRUE;
		$config['img_max_width']	= 1024;
		$config['img_max_height']	= 768;
		$config['create_thumb']		= FALSE;
		$config['resize_thumb']		= FALSE;
		$config['thumb_max_width']	= 340;
		$config['thumb_max_height']	= 400;
		$config['thumb_marker']		= '';
		$config['upload_thumb_path']= '_thumb';
		$config = array_merge( $config,$config2 );
		
		//echo $config['upload_path'];
		//echo '<br />';
		$dir = explode('/',$config['upload_path']);
		//print_r($dir);
		//echo '<br />';
		$dir_aux = '';
		foreach($dir as $dir_row) {
			if($dir_aux == ''){
				$dir_aux = $dir_row;
			} else {
				$dir_aux .= '/'.$dir_row;
			}
			if(!is_dir($dir_aux)){
				//echo 'Não existe: '.$dir_aux;echo '<br />';
				mkdir($dir_aux, 0755 );
			} else {
				//echo 'Existe: '.$dir_aux;echo '<br />';
			}
		}
		//exit;
		
		//verifica se existe alguma imagem
		if ($_FILES[$config['fileUpload']]['name'] !=""){
			if($_FILES[$config['fileUpload']]['error'] == 0 ){
				// Faz o upload da imagem
				$CI =& get_instance();
				$CI->load->library('upload');
				$CI->upload->initialize($config);
				$CI->load->library('image_lib');
				if ( ! $CI->upload->do_upload($config['fileUpload'])) {
					$CI->session->set_flashdata('message', $CI->upload->display_errors('<p class="error">', '</p>'));	
					echo $CI->upload->display_errors('<p class="error">', '</p>');
				} else {
					$datas = array('upload_data' => $CI->upload->data());
					foreach($datas as $data):
						//Configura as variaveis da biblioteca image_lib
						$config['image_library']    = 'GD2';
						$config['source_image']     = $data['full_path'];
						$config['maintain_ratio']   = FALSE;
						
						
						// Faz o upload e redimensiona a thumb
						if($config['create_thumb']) {
							if($config['resize_thumb']) {
								if($config['thumb_proportion']) {
									$nova = $this->redimenciona($data['image_width'],$data['image_height'],$config['thumb_max_width'],$config['thumb_max_height']);
									$config['width']            = $nova['largura'];
									$config['height']           = $nova['altura'];
								} else {
									$config['maintain_ratio']	= FALSE;
									$config['width']            = $config['thumb_max_width'];
									$config['height']           = $config['thumb_max_height'];
								}
							} else {
								$config['width']            = $data['image_width'];
								$config['height']           = $data['image_height'];
							}
							$config['new_image']     	= $data['file_path'].$config['upload_thumb_path'];
							if(!is_dir($config['new_image'])){
								//echo 'Não existe: '.$dir_aux;echo '<br />';
								mkdir($config['new_image'], 0755 );
							}
							$CI->image_lib->initialize($config);
							$CI->image_lib->resize();
						}
						
						// Redimensiona a imagem principal
						if($config['resize']) {
							if($config['constrain_proportion']) {
								$nova = $this->redimenciona($data['image_width'],$data['image_height'],$config['img_max_width'],$config['img_max_height']);
								$config['width']	= $nova['largura'];
								$config['height']	= $nova['altura'];
							} else {
								$config['maintain_ratio']	= FALSE;
								$config['width']			= $config['img_max_width'];
								$config['height']			= $config['img_max_height'];
							}
							$config['new_image']     	= $data['file_path'];
							$CI->image_lib->initialize($config);
							$CI->image_lib->resize();
						}
						
						return $data['file_name'];
					endforeach;
				} 
			}
		}
	}
	
	public function UploadArquivo($tipo,$fileUpload = 'userfile',$diretorio = './_img/_upload/') {
		$CI =& get_instance();
		$dir = explode('/',$diretorio);
		//print_r($dir);
		//echo '<br />';
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
		//verifica se existe algum arquivo
		if (($_FILES[$fileUpload]['name'] !="")&&($_FILES[$fileUpload]['error'] == 0)){
					
			//upload and update the file
			$config['upload_path'] = $diretorio;
			switch($tipo):
				case 'Documento': $config['allowed_types'] = 'csv|doc|docx|xls|xlsx|ppt|pptx|pps|ppsx|pdf|txt';break;
				case 'Video'	: $config['allowed_types'] = 'mp4|wmv|avi|mov|flv|3gp|mpg|mpeg|divx|xvid';break;
				case 'Audio'	: $config['allowed_types'] = 'mp3|wma|wav|aac';break;
				case 'Tudo'		: $config['allowed_types'] = '*';break;
			endswitch;
			$config['overwrite'] = false;
			$config['remove_spaces'] = true;
			$config['encrypt_name'] = true;
			
			$CI->load->library('upload', $config);
			
			if ( ! $CI->upload->do_upload($fileUpload)) {
				$CI->session->set_flashdata('message', $CI->upload->display_errors('<p class="error">', '</p>'));	
				echo $CI->upload->display_errors('<p class="error">', '</p>');
			} else {
				$datas = array('upload_data' => $CI->upload->data());
				foreach($datas as $data):
					return $data['file_name'];
				endforeach;
			}
		}
	}
	
	function cortaFrase($frase,$qtde_letras) {
		$p = explode(' ', $frase);
		$c = 0;
		$cortada = '';
 
		foreach($p as $p1):
			if ($c<$qtde_letras && ($c+strlen($p1) <= $qtde_letras)){
         		$cortada .= ' '.$p1;
         		$c += strlen($p1)+1;
      		}else{
				break;
			}
		endforeach;
 
	return strlen($cortada) < $qtde_letras ? $cortada.'' : $cortada;
	}

	function retiraTagHTML($textoComTag){
			return strip_tags($textoComTag, '<(.*?)>');
		}
}