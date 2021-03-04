<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gerarmenu  {

	function optmenu($canal,$area) {
		echo '<a href="'.base_url().$area.'" class="bnt_'.$area.'_off" title="'.$canal.'" accesskey="h" tabindex="1"><span class="hidden">'.$canal.'</span></a>';
	}

	function cortaFrase($frase,$qtde_letras) {
	   $p = explode(' ', $frase);
	   $c = 0;
	   $cortada = '';
	   foreach($p as $p1){
		  if ($c<$qtde_letras && ($c+strlen($p1) <= $qtde_letras)){
			 $cortada .= ' '.$p1;
			 $c += strlen($p1)+1;
		  }else{
			 break;
		  }
	   }
	   return strlen($cortada) < $qtde_letras ? $cortada : $cortada;
	}

	function get_global_messages() {
		$str = '';
		$CI =& get_instance();
		
		$global_messages = (array)$CI->session->userdata('global_messages');
		
		if(count($global_messages) > 0) {
			foreach($global_messages as $k => $v) {
				echo '<div class="'.$k.'">';
				
				foreach((array)$v as $w) {
					echo "$w\n";
				}
				
				echo '</div>';
			}
		} 
		
		$CI->session->unset_userdata('global_messages');
		
		return $str;
	}


	function set_global_messages($msg='', $type='error', $is_multiple=true) {
		$CI =& get_instance();
		
		$global_messages = (array)$CI->session->userdata('global_messages');
		
		foreach((array)$msg as $v) {
			if(!$is_multiple)
				unset($global_messages[$type]);
			$global_messages[$type][] = (string)$v;
		}

		$CI->session->set_userdata('global_messages', $global_messages);
	}
}