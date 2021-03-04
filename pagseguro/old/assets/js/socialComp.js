function socialComp(social, socialUrl, titulo){
	var dualScreenLeft, dualScreenTop, left, top, windowHeight, windowTile, windowUrl, windowWidth;
	var socialUrl = (!socialUrl) ? window.location.href : socialUrl;
	var titulo = (!titulo) ? window.document.title : titulo;

	switch (social) {
	  case 'linkedin':
	  	windowTile = 'Linkedin Share';
		windowUrl = 'https://www.linkedin.com/shareArticle?mini=true&url='+socialUrl+'&title='+encodeURIComponent(titulo)+'&summary=%20OPCIONAL&source=';
		break;
  
	  case 'facebook':
		windowTile = 'Facebook Share';
		windowUrl = '//www.facebook.com/sharer.php?u=' + socialUrl;
		break;
	  case 'twitter':
		windowTile = 'Twitter Share';
		windowUrl = '//twitter.com/share?url='+socialUrl+'&text='+encodeURIComponent(titulo);
		break;
	  case 'googleplus':
		windowTile = 'Google+ Share';
		windowUrl = '//plus.google.com/share?url=' + socialUrl+'&text='+encodeURIComponent(titulo);
		break;
	  case 'whatsapp':
		windowUrl = 'https://api.whatsapp.com/send?text=' +encodeURIComponent(titulo)+' - '+ socialUrl;
		break;
	  case 'instagram':
	 	windowUrl = 'https://api.whatsapp.com/send?text=' +encodeURIComponent(titulo)+' - '+ socialUrl;
		break; 
	  case 'email':
		windowUrl = 'mailto:?body=' +encodeURIComponent(titulo+ ' '+socialUrl)+' - '+ socialUrl+'&subject='+encodeURIComponent(titulo);
		break;
	}

	console.log(windowUrl);
			

	if(social == 'whatsapp' || social == 'email'){
		window.location.href = windowUrl;
		return false;
	}
			
	windowWidth = 600;
	windowHeight = 300;
	dualScreenLeft = window.screenLeft !== void 0 ? window.screenLeft : screen.left;
	dualScreenTop = window.screenTop !== void 0 ? window.screenTop : screen.top;
	left = ((screen.width / 2) - (windowWidth / 2)) + dualScreenLeft;
	top = ((screen.height / 2) - (windowHeight / 2)) + dualScreenTop;
	return window.open(windowUrl, windowTile, 'height=' + windowHeight + ', width=' + windowWidth + ', top=' + top + ', left=' + left + ', scrollbars=yes, location=no, directories=no, status=no, menubar=no, toolbar=no');

	return false;
}