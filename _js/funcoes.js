function cep_valido(cep,blur) {	
	regex = /^[0-9]{8}|[0-9]{5}\-[0-9]{3}$/;
	var cepok = regex.test(cep);
	vcep = cepok;
		
	if( (vcep == true) && (blur == true) ){
		
		jQuery.ajax({
		  // Especificamos o método que quermos utilizar
			method: "get",
			// Especificamos o arquivo que vai processar a solicitação
			url: "cep.php",
			// A QUERY STRING contendo os dados necessários
			data: "cep="+ cep,
			// O que deve acontecer antes de ser enviado
			beforeSend: function(){
				// Mostra a mensagem de carregando
				jQuery("#carregando_cep").show("fast");
			},
			// O que deve acontecer quando o processo estiver completo
			complete: function(){
				// Oculta a mensagem carregando
				jQuery("#carregando_cep").hide("slow");
			},
			// Se houve sucesso vamos carregar o resultado para o argumento
			// "conteudo" para utilizá-lo onde desejarmos
			success: function(data){
				$('input:text[name=endereco]').val(data.logradouro);
				$('input:text[name=bairro]').val(data.bairro);
				$('input:text[name=cidade]').val(data.cidade);
				$('input:text[name=estado]').val(data.uf);
			}
		});
	}	
}

$(document).ready(function(){	

	$("img.lazy").lazyload();

	$('#menu').slicknav({
	  prependTo:'#menu-responsive'
	});

	 $(window).load(function() {
        $('#slider').nivoSlider();
    });

	 setInterval( function(){
    if($('.cbp-fwnext').is(":visible")){
            $('.cbp-fwnext').click();   
	}
	else{
	        $('.cbp-fwdots').find('span').click();
	    }
	} ,7000 );

	$( '#cbp-fwslider' ).cbpFWSlider();

$('.alert_messages,.success_messages').delay(15000).animate({"opacity":"0","height":"0","padding":"0"},500);
$('.alert_messages,.success_messages').click(
	function() {
		$(this).remove();
	}
);

// Alterar a imagem do icone do facebok para ativo
$('.btn_facebook').mouseover(function(){
	$(this).attr('src',fullpath+'_img/btn_face_on.gif');
   }).mouseout(function(){
		$(this).attr('src',fullpath+'_img/btn_face_off.gif');
   });
   
   // Alterar a imagem do icone do youtube para ativo
$('.btn_youtube').mouseover(function(){
	$(this).attr('src',fullpath+'_img/btn_youtube_on.gif');
   }).mouseout(function(){
		$(this).attr('src',fullpath+'_img/btn_youtube_off.gif');
   });
   
   // Alterar a imagem do icone do flicker para ativo
$('.btn_instagram').mouseover(function(){
	$(this).attr('src',fullpath+'_img/btn_instagram_on.gif');
   }).mouseout(function(){
		$(this).attr('src',fullpath+'_img/btn_instagram_off.gif');
   });	
		
//Thumbnailer.config.shaderOpacity = 1;
// var tn1 = $('.mygallery').tn3({
// skinDir:"skins",
// imageClick:"fullscreen",
// image:{
// maxZoom:1.5,
// crop:true,
// clickEvent:"dblclick",
// transitions:[{
// type:"blinds"
// },{
// type:"grid"
// },{
// type:"grid",
// duration:460,
// easing:"easeInQuad",
// gridX:1,
// gridY:8,
// // flat, diagonal, circle, random
// sort:"random",
// sortReverse:false,
// diagonalStart:"bl",
// // fade, scale
// method:"scale",
// partDuration:360,
// partEasing:"easeOutSine",
// partDirection:"left"
// }]
// }
// 		});
		
$("#form_inscrevase").validate({

submitHandler: function(form) {

	$(form).ajaxSubmit({

	dataType: 'html',

	beforeSubmit: success_contato,
	success: response_contato,
	resetForm: true,

		});

	},rules: {
			fkcurso: {
				required: true
		},	nome: {
				required: true,
				minlength:5
		},
			email: {
				required: true,
				email: true
		},
			mensagem: 'required',
			prof_saudes: 'required',
			sexo: 'required',
			data_nascimento: 'required'
		},

		messages: {
			fkcurso: {
			required: 'Voc&ecirc; n&atilde;o selecionou o Curso'
		},
			nome: {
			required: 'Voc&ecirc; n&atilde;o preencheu seu nome',
			minlength:"Digite mais de 5 caracteres"
		},

		email: {
			required: 'Voc&ecirc; precisa preencher um e-mail',
			email: 'Endere&ccedil;o de e-mail n&atilde;o v&aacute;lido'
		},
			mensagem: 'Voc&ecirc; n&atilde;o digitou sua mensagem',
			sexo: 'Voc&ecirc; n&atilde;o informou seu sexo',
			data_nascimento: 'Voc&ecirc; n&atilde;o informou sua data de nascimento'

		}	
	});
		
$('.inscreva_se_login').fancybox();		
		
$('#facebook').click(function(e){
    $.oauthpopup({
        path: 'login',
        width:600,
        height:300,
        callback: function(){
            window.location.reload();
        }
    });
    e.preventDefault();
});		
	
		
});