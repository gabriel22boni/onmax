<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Helps {
	

	public function UploadArquivo($fileUpload,$diretorio,$redimenciona = false,$largura = false,$altura = false) {
		
		$CI =& get_instance();	
			
			//verifica se existe alguma imagem
			if ($fileUpload['name'] !=""){
				if($fileUpload['error'] == 0 ){
				//upload and update the file
				$config['upload_path'] = $diretorio;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$config['encrypt_name'] = true;
							
				$CI->load->library('upload', $config);
			
				$CI->load->library('image_lib');
	
			
				if ( ! $CI->upload->do_upload('imagem')) {
					$this->session->set_flashdata('message', $this->upload->display_errors('<p class="error">', '</p>'));	
						echo $CI->upload->display_errors('<p class="error">', '</p>');
				} else {
					$datas = array('upload_data' => $CI->upload->data());
						foreach($datas as $data):
						
				if($redimenciona) 
				{
										
					//Cria o thumb
					$config['image_library']     = 'GD2';
					$config['source_image']     = $data['full_path'];
					$config['new_image']     = $data['file_path'];
					$config['create_thumb']     = FALSE;
					$config['maintain_ratio']    = FALSE;
					$config['width']             = $largura;
					$config['height']             = $altura;
					$CI->image_lib->initialize($config);
					$CI->image_lib->resize();
				}
							return $data['file_name'];
						endforeach;
				
				} 
			}
		}
	}
	
	//redimenciona a imagem proporcionalmente conforme a altura desejada
	public function img_resize($tmpname, $size, $save_dir, $save_name,$nome_produto = false,$thumb = false,$save_dir_thumb = false,$size_thumb = false, $maxisheight = 0)    
	{
		//renomeia a imagem
		
		if($nome_produto) {
			$save_name = $nome_produto.'.jpg';
		} else {
			mt_srand();
			$save_name = $filename = md5(uniqid(mt_rand())).'.jpg';
		}
		
		if($thumb = true){
			
			$save_dir_thumb     .= ( substr($save_dir_thumb,-1) != "/") ? "/" : "";	
			$gis_2        = getimagesize($tmpname);
			$type_2      = $gis_2[2];
	
			switch($type_2)
				{
				case "1": $imorig_2 = imagecreatefromgif($tmpname); break;
				case "2": $imorig_2 = imagecreatefromjpeg($tmpname);break;
				case "3": $imorig_2 = imagecreatefrompng($tmpname); break;
				default:  $imorig_2 = imagecreatefromjpeg($tmpname);
				}
		
				$x_2 = imagesx($imorig_2);
				$y_2 = imagesy($imorig_2);
			   
				$woh_2 = (!$maxisheight)? $gis_2[0] : $gis_2[1] ;   
			   
				if($woh_2 <= $size_thumb)
				{
				$aw_2 = $x_2;
				$ah_2 = $y_2;
				}
					else
				{
					if(!$maxisheight){
						$aw_2 = $size_thumb;
						$ah_2 = $size_thumb * $y_2 / $x_2;
					} else {
						$aw_2 = $size_thumb * $x_2 / $y_2;
						$ah_2 = $size_thumb;
					}
				}  
				$im_2 = @imagecreatetruecolor($aw_2,$ah_2);
			if (@imagecopyresampled($im_2,$imorig_2 , 0,0,0,0,$aw_2,$ah_2,$x_2,$y_2))
				
				@imagejpeg($im_2, $save_dir_thumb.$save_name);
						//echo $save_name;
					//else
				//	return false;
		}
		
				
    $save_dir     .= ( substr($save_dir,-1) != "/") ? "/" : "";	
    $gis        = getimagesize($tmpname);
    $type        = $gis[2];
	
    switch($type)
        {
        case "1": $imorig = imagecreatefromgif($tmpname); break;
        case "2": $imorig = imagecreatefromjpeg($tmpname);break;
        case "3": $imorig = imagecreatefrompng($tmpname); break;
        default:  $imorig = imagecreatefromjpeg($tmpname);
        }

        $x = imagesx($imorig);
        $y = imagesy($imorig);
       
        $woh = (!$maxisheight)? $gis[0] : $gis[1] ;   
       
        if($woh <= $size)
        {
        $aw = $x;
        $ah = $y;
        }
            else
        {
            if(!$maxisheight){
                $aw = $size;
                $ah = $size * $y / $x;
            } else {
                $aw = $size * $x / $y;
                $ah = $size;
            }
        }  
        $im = imagecreatetruecolor($aw,$ah);
    if (imagecopyresampled($im,$imorig , 0,0,0,0,$aw,$ah,$x,$y))
		
        if (imagejpeg($im, $save_dir.$save_name))
            return $save_name;
            else
            return false;
    }
	
	public function retiraTagHTML($textoComTag){
			return strip_tags($textoComTag, '<(.*?)>');
		}
	
	
	public function FormataData($data) {		
		
		$data = explode('/',$data);
		
		$data_formatada = $data[2].'-'.$data[1].'-'.$data[0];
		
		return $data_formatada;
		
	}
	
	public function FormataDataPagina($data) {		
		
		$data = explode('-',$data);
		
		$data_formatada = $data[2].'/'.$data[1].'/'.$data[0];
		
		return $data_formatada;
		
	}
	
	public function FormataDataPaginaAdmin($data) {
		
		$data = str_replace(' ','-',$data);
		$data = explode('-',$data);
		
		$data_formatada = $data[2].'/'.$data[1].'/'.$data[0].' '.$data[3];
		
		return $data_formatada;
		
		}

	function is_logged_in()	{
			
		$CI =& get_instance();
			
		$is_logged_in_admin = $CI->session->userdata('is_logged_in_admin');
		$usuario = $CI->session->userdata('usuario');
			
		if(isset($is_logged_in_admin) && $is_logged_in_admin == true && isset($usuario)){
			return true;			
		} else {			
			redirect(BASE_URL_ADMIN);
		}
	}
	
	function is_logged_in_profissional_saude() {				
		
		$CI =& get_instance();
		
		$is_logged_in = $CI->session->userdata('is_logged_in');
		$nome_medico = $CI->session->userdata('nome_medico');
		
		if(isset($is_logged_in) && $is_logged_in == true && isset($nome_medico)) {
			
			return true;
						
		} else {
			
			redirect(base_url()."?avaliacao_nutricional/profissional_de_saude");
		}
	}
	
	function is_logged_in_sugestao() {				
		
		$CI =& get_instance();
		
		$is_logged_in_sugestao = $CI->session->userdata('is_logged_in_sugestao');
		$nome = $CI->session->userdata('nome');
		
		if(isset($is_logged_in_sugestao) && $is_logged_in_sugestao == true && isset($nome)) {
			
			//redirect(base_url()."?sugestao_da_semana/cadastra_sugestao");
			return true;
						
		} else {
			
			//redirect(base_url()."?sugestao_da_semana/mande_uma_sugestao");
			return false;
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
	
	function remove_acento($var) {

		$var = strtolower($var);
		
		$var = @ereg_replace("[����]","a",$var);	
		$var = @ereg_replace("[���]","e",$var);	
		$var = @ereg_replace("[�����]","o",$var);	
		$var = @ereg_replace("[���]","u",$var);	
		$var = @str_replace("�","c",$var);
		
		return $var;
	}	

	function removeAcentos($string, $slug = false) {
		$string = strtolower($string);
	
		// C�digo ASCII das vogais
		$ascii['a'] = range(224, 230);
		$ascii['e'] = range(232, 235);
		$ascii['i'] = range(236, 239);
		$ascii['o'] = array_merge(range(242, 246), array(240, 248));
		$ascii['u'] = range(249, 252);
	
		// C�digo ASCII dos outros caracteres
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
			// Troca tudo que n�o for letra ou n�mero por um caractere ($slug)
			$string = preg_replace('/[^a-z0-9]/i', $slug, $string);
			// Tira os caracteres ($slug) repetidos
			$string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
			$string = trim($string, $slug);
		}
	
		return urlencode($string);
	}
	
	
	
}
?>