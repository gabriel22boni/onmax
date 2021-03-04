function questao_update(timeout){
	var idquestao = jQuery('#idquestao').val();
	var idprova = jQuery('#idprova').val()
	var titulo_seo = jQuery("#titulo_seo").val();
	var questao_aux = jQuery("#questao_aux").val();
	
	var resposta = "";
	//Executa Loop entre todas as Radio buttons com o name de valor
	$('input:radio').each(function() {
		//Verifica qual está selecionado
		if ($(this).is(':checked'))
		resposta = parseInt($(this).val());
		resposta_n = $(this).attr('name');
	})
	
	$.ajax({
	  // Especificamos o método que quermos utilizar
		type: 'POST',			
		method: "POST",
		// Especificamos o arquivo que vai processar a solicitação
		url: full_path+'provas/update',
		// A QUERY STRING contendo os dados necessários
		
		data: "idquestao=" + idquestao
			 + "&idprova=" + idprova
			 + "&titulo_seo=" + titulo_seo
			 + "&questao_aux=" + questao_aux
			 + "&"+resposta_n+"=" + resposta
			 + "&timeout=" + timeout,
		// O que deve acontecer antes de ser enviado
		beforeSend: function(){
		  // Mostra a mensagem de carregando
		 // jQuery("#carregando").show("fast");
		},
		// O que deve acontecer quando o processo estiver completo
		complete: function(){
		  // Oculta a mensagem carregando
		 // jQuery("#carregando").hide("slow");
		},
		// Se houve sucesso vamos carregar o resultado para o argumento
		// "conteudo" para utilizá-lo onde desejarmos
		success: function(conteudo){
			if(conteudo != false) {
				$("#dialog_conteudo").html(conteudo);
	
	
	
				//armazena o atributo href do link
				var id = '#dialog';
				
				//armazena a largura e a altura da tela
				var maskHeight = $(document).height();
				var maskWidth = $(window).width();
				
				//Define largura e altura do div#mask iguais ás dimensões da tela
				$('#mask').css({'width':maskWidth,'height':maskHeight});
				
				//efeito de transição
				$('#mask').fadeIn(1000);
				$('#mask').fadeTo("slow",0.8);
				
				//armazena a largura e a altura da janela
				var winH = $(window).height();
				var winW = $(window).width();
				//centraliza na tela a janela popup
				$(id).css('top',  winH/2-$(id).height()/2);
				$(id).css('left', winW/2-$(id).width()/2);
				//efeito de transição
				$(id).fadeIn(2000);
				
				$(function(){
					$('#counter_3').countdown({
						digitImages: 1,
						digitWidth: 12,
						digitHeight: 18,
						image: full_path+'_img/count_down/numbers2.png',
						startTime: '00:30',
						timerEnd: function(){ window.location.href = full_path+'provas/'+idprova+'/'+titulo_seo+'/questao/'+questao_aux;  },
						format: 'mm:ss'
					});
				});
			}
		}
	  }
	);
}

$(document).ready(function() {

	//seleciona os elementos a com atributo name="modal"
	$('a[name=modal]').click(function(e) {
		//cancela o comportamento padrão do link
		e.preventDefault();
		
		//armazena o atributo href do link
		var id = $(this).attr('href');
		
		//armazena a largura e a altura da tela
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		
		//Define largura e altura do div#mask iguais ás dimensões da tela
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//efeito de transição
		$('#mask').fadeIn(1000);
		$('#mask').fadeTo("slow",0.8);
		
		//armazena a largura e a altura da janela
		var winH = $(window).height();
		var winW = $(window).width();
		//centraliza na tela a janela popup
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
		//efeito de transição
		$(id).fadeIn(2000);
	});
	
	//se o botãoo fechar for clicado
	$('.window .close').click(function (e) {
		//cancela o comportamento padrão do link
		e.preventDefault();
		$('#mask, .window').hide();
	});
		
	//se div#mask for clicado
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});
});