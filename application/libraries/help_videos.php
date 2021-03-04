<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help_videos {

	function embedVideo($url,$width,$height){
		/*
		* RETORNA VIDEOS DO YOUTUBE E METACAFE
		*
		* É POSSÍVEL IMPLEMENTAR MAIS EXPRESSÕES REGULARES
		*
		* é possível adaptar um retorno em string também,
		* aí fica a critério de quem usar a função
		*
		*/
		
		if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){
			return '
				<object width="'.$width.'" height="'.$height.'">
				   <param name="movie" value="http://www.youtube.com/v/'.$matches[2].'&hl=pt-br&fs=1"></param>
				   <param name="allowFullScreen" value="true"></param>
				   <param name="allowscriptaccess" value="always"></param>
				   <embed src="http://www.youtube.com/v/'.$matches[2].'&hl=pt-br&fs=1" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="'.$width.'" height="'.$height.'"></embed>
				</object>
				';
		} elseif(preg_match("#http://www\.metacafe\.com/watch/(([^/].*)/([^/].*))/?#", $url, $matches)) {
			return '<embed flashVars="playerVars=showStats=no|autoPlay=no|videoTitle="  src="http://www.metacafe.com/fplayer/'.$matches[1].'.swf" width="'.$width.'" height="'.$height.'" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed>';
		}
	}
	
	 
	function youtubeImage($url,$tipo='src') {
	   $img = '';
	   $url = str_replace('&feature=g-vrec','',$url);
	   $url = str_replace('&feature=plcp','',$url);
	   $url = str_replace('&feature=youtube_gdata','',$url);	   
	   // O TAMANHO PADRAO DA IMAGEM DO YOUTUBE É 120x90
	   if(preg_match("#http://(.*)\.youtube\.com/watch\?v=(.*)(&(.*))?#", $url, $matches)){
		  if(isset($matches[2]) && $matches[2]!=''){
			 $img = 'http://i4.ytimg.com/vi/'.$matches[2].'/default.jpg';
		  }
	   }
	   return $tipo=='src' ? $img : '<img src="'.$img.'" border="0" witdh="170" height="127" class="borda_img_youtube"/>';
	}
}