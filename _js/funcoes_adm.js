/**
* Fun��o para apagar a mensagem de alerta depois de alguns segundos
*/
$(document).ready(function(){
	$('.alert_messages,.success_messages').delay(15000).animate({"opacity":"0","height":"0","padding":"0"},500);
	$('.alert_messages,.success_messages').click(
		function() {
			$(this).remove();
		}
	);
	
	jQuery("#btn").click(function(){
		jQuery("#resultado").append("<input type=\"text\" name=\"videos_youtube[]\"id=\"videos_youtube[]\" \><br/>")
	});
	
	
});

$(function(){	
	/* Quando o bot�o adicionar for clicado... */
	$('input.add').click(function()	{	
		/* Pega uma linha existente */
		var linha = $('#clonar_campo').html();	
		/* Acrescenta uma nova linha */
		$('#campo_clonado').append(linha);		
	});	
});


$(document).ready(function() {
	// Atualiza a quantidade m�xima de itens por p�gina
	jQuery('.maximo_per_page_admin').change(
		function() {
			var per_page = jQuery('.maximo_per_page_admin').val();
			jQuery.ajax({
				type: 'POST',			
				method: "POST",// Especificamos o m�todo que queremos utilizar
				// Especificamos o arquivo que vai processar a solicita��o
				url: fullpath+"/paginacao/index",// Especificamos o arquivo que vai processar a solicita��o
				data: "per_page=" + per_page,// A QUERY STRING contendo os dados necess�rios
				beforeSend: function(){// O que deve acontecer antes de ser enviado
					jQuery("#carregando").show("fast");// Mostra a mensagem de carregando
				},
				complete: function(){// O que deve acontecer quando o processo estiver completo
					jQuery("#carregando").hide("slow");// Oculta a mensagem carregando
				},
				success: function(conteudo){// Se houve sucesso vamos carregar o resultado para o argumento
					//jQuery("#idassunto").html(conteudo);// "conteudo" para utiliz�-lo onde desejarmos
					location.reload();
				}
			});
		}
	);
	
	// Atualiza o action do formulario para que ele fa�a a busca pelo termo digitado
	$('#btn_buscar').click(
		function() {
			var action_buscar = $('#action_buscar').val();
			$('form').attr('action',action_buscar);
		}
	);
	
	$('#data_inicio').focus(function(){
		$(this).calendario({ 
			target:'#data_inicio',
			top:35
		});
	});
	
	$('#data_final').focus(function(){
		$(this).calendario({ 
			target:'#data_final',
			top:35
		});
	});
	
	$('#tipo_banner').change(function() {		
		var id = $(this).attr('value');
		if(id == 'expansivel') {			
			$('#cliques').attr('style', 'display:none;');
			$('#link_img').attr('style', 'display:none;');
			$('#url_img').attr('style', 'display:none;');			
		} else if(id == 'swf_normal') {			
			$('#cliques').attr('style', 'display:none;');
			$('#link_img').attr('style', 'display:none;');
			$('#url_img').attr('style', 'display:none;');			
		} else if(id == 'imagem') {
			$('#cliques').attr('style', 'display:block;');
			$('#link_img').attr('style', 'display:block;');
			$('#url_img').attr('style', 'display:block;');
		}		
	});
})



function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

//menu admin
$(document).ready(function() {
	//mostra o box com as cores do calendario
	$('#mostra_cor').click(function(){	
		$('#box_cor_calendario_esconde').attr('style', 'display:block;');
	});
	//fecha o box com as cores do calendario
	$('#fecha_cor_calendario').click(function(){
		$('#box_cor_calendario_esconde').removeAttr('style', 'display:block;');		
	});	
	//pega o valor da cor escolhida e envia para o campo do formulario
	$('.cor_box_opcao').click(function(){
		var id_cor = $(this).attr('id');
			$('#cor').attr('value',id_cor);
			$('#mostra_cor').attr('style','background-color:'+id_cor);
			
		//fecha o box de cores
		$('#box_cor_calendario_esconde').removeAttr('style', 'display:block;');			
	});
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#firstpane p.menu_head").click(function()  {
		$(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(left.png)"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph
	$("#secondpane p.menu_head").mouseover(function() {
	     $(this).css({backgroundImage:"url(down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings().css({backgroundImage:"url(left.png)"});
	});
	
	//sele��o de todos os checklist
	$('#selectAll').click(function() {
		if(this.checked == true){
			$("input[type=checkbox]").each(function() { 
				this.checked = true; 
			});
		} else {
			$("input[type=checkbox]").each(function() { 
				this.checked = false; 
			});
		}
	});	
	
	
	$('.opcoes_curso').click(function() {
		var id = $(this).attr('value');
		if(id == 1){
			$("#caixa_texto").each(function() { 
				this.checked = false; 
			});
			
			$('#caixa_info_curso').removeAttr('style', 'display:block;');	
			$('#caixa_texto_curso').attr('style', 'display:none;');	
		} else {
			$("#link_info").each(function() { 
				this.checked = false; 
			});
			$('#caixa_info_curso').attr('style', 'display:none;');
			$('#caixa_texto_curso').attr('style', 'display:block;');
		}
	});	
	
	$('#link_externo').click(function() {
		if(this.checked == true) {
			$('#caixa_link_externo').attr('style', 'display:block;');
			$('.esconde_conteudo').attr('style', 'display:none;')
	    } else {
			$('#caixa_link_externo').attr('style', 'display:none;');		
			$('.esconde_conteudo').attr('style','display:')
		}
	});	

	$(function () {
		function removeCampo() {
			$(".removerCampo").unbind("click");
			$(".removerCampo").bind("click", function () {
				i=0;
				$(".outras_imgs p.campoutras_imgs").each(function () {
					i++;				
				});
				if (i>1) {
					$(this).parent().remove();
				}
			});
		}
		removeCampo();
		
		$(".adicionarCampo").click(function () {
			novoCampo = $(".outras_imgs p.campoutras_imgs:first").clone();
			novoCampo.find("input").val("");
			novoCampo.insertAfter(".outras_imgs p.campoutras_imgs:last");
			removeCampo();	
		});
	});


	$('#aplicar').click(function() {
		//coloca em array os ids selecionados
		var selectedItems = new Array();
		$("input[name$='id[]']:checked").each(function() {
			selectedItems.push($(this).val());
		}); 
		//caso nao tenha selecionado nada envia um alerta para o usuario
		if (selectedItems.length == 0 || $("#status").val() == '0' )  { 
			alert("Selecione alguma op��o");
			return false;
		} else {
			//variavel com os ids selecionados	
			var olink = selectedItems;
			//variavel com a opcao que foi selecioada
			var opcao = $("#status").val();
			//variavel com a opcao que foi selecioada
			var opcao2 = $("#status2").val();
			if(opcao2) {
				opcao = opcao2;
			}
			//variavel da pagina
			var pg = $("#area_admin").val();
			//variavel da pagina
			var pg2 = $("#area_admin2").val();
			
			jQuery.ajax( {
				// Especificamos o m�todo que quermos utilizar
				type: 'POST',			
				method: "POST",
				// Especificamos o arquivo que vai processar a solicita��o
				url: fullpath+'/'+pg+'/update_status',
				// A QUERY STRING contendo os dados necess�rios
				data: "id=" + olink+"&opcao="+ opcao ,		
				// O que deve acontecer antes de ser enviado
				beforeSend: function(){
					// Mostra a mensagem de carregando
					jQuery("#carregando").show("fast");
				},
				// O que deve acontecer quando o processo estiver completo
				complete: function(){
					// Oculta a mensagem carregando
					jQuery("#carregando").hide("slow");
				},
				// Se houve sucesso vamos carregar o resultado para o argumento
				// "conteudo" para utiliz�-lo onde desejarmos
				success: function(conteudo){
					//alert(conteudo);			 
					//JQuery("#"+conteudo+"'").html(conteudo);
					if(pg2) {
						pg = pg2;
					}
					location.href=fullpath+'/'+pg;
				}
				
			});		  
			return false;
		}
	});

	$('#data_inicial').focus(function(){
		$(this).calendario({ 
			target:'#data_inicial',
			closeClick:true
		});
	});
	
	$('#data_final').focus(function(){
		$(this).calendario({ 
			target:'#data_final',
			closeClick:true
		});
	});
	
	//mostra o box com as cores do calendario
	$('#cor_evento').focus(function(){	
		$('#box_cor_calendario_esconde').attr('style', 'display:block;');
	});
	
	
	//fecha o box com as cores do calendario
	$('#fecha_cor_calendario').click(function(){
		$('#box_cor_calendario_esconde').removeAttr('style', 'display:block;');		
	});
	
	//pega o valor da cor escolhida e envia para o campo do formulario
	$('.cor_box_opcao').click(function(){
		var id_cor = $(this).attr('id');
			$('#cor_evento').attr('value',id_cor);		
			
		//fecha o box de cores
		$('#box_cor_calendario_esconde').removeAttr('style', 'display:block;');			
	});

});


function inativar(id,pagina) {	
	if( confirm( 'Tem certeza que deseja inativar o registro?\n') ) { 
		var campo1 = pagina;
		var campo2 = id+"/inativo" ;
		location.href=campo1+campo2;
	}
	return false;
}
function publicar(id,pagina) {	
	if( confirm( 'Tem certeza que deseja publicar o registro?\n') ) { 
		var campo1 = pagina;
		var campo2 = id+"/publicado" ;
		location.href=campo1+campo2;
	}
	return false;
}
function deletar(id,pagina) {	
	if( confirm( 'O registro ser� excluido e ap�s a confirma��o n�o ser� poss�vel recuperar.\nTem certeza excluir o registro?\n') ) { 
		var campo1 = pagina;
		var campo2 = id+"/deletar" ;
		location.href=campo1+campo2;
	}
	return false;
}
	
	
//FUNCAO PARA LIMITAR CARACTERES EM TEXTAREA

var max=5000;
var ancho=300;

function progreso_tecla(obj,permitido,limite) {
  var progreso = document.getElementById(limite);  
  if (obj.value.length < permitido) {
       
    progreso.style.backgroundImage = "url(textarea.png)";    
   //progreso.style.color = "#E5E4E4";
    var pos = ancho-parseInt((ancho*parseInt(obj.value.length))/permitido);
    progreso.style.backgroundPosition = "-"+pos+"px 0px";
  } else {
    //progreso.style.backgroundColor = "#E5E4E4";    
    progreso.style.backgroundImage = "url()";    
   // progreso.style.color = "#E5EEA1";
  } 
  progreso.innerHTML = "("+obj.value.length+" / "+permitido+")";
}

function limitaText( p_objCampo, p_permitido ) {

   if (  p_objCampo.value.length > p_permitido ) {
         p_objCampo.value =  p_objCampo.value.substr( 0, p_permitido )

      if ( p_objCampo.value.length > p_permitido )  
         p_objCampo.value =  p_objCampo.value.substr( 0, p_permitido-1 )
   }
  
}	
	
//mostra as op��es para editar o post
function posts(idcontrole,idregistro) {
		$('.opcoes_post_'+idcontrole+'_'+idregistro).removeAttr('style');	
}
//mostra as op��es para editar o post
function posts_out(idcontrole,idregistro) {
		$('.opcoes_post_'+idcontrole+'_'+idregistro).attr('style','display:none');	
}
function apagarImagem(elm, idapagarImagem) {
	//jQuery(elm)	
	jQuery('#img'+idapagarImagem).hide();	
	var apagar_galeria = jQuery('#apagar_galeria').val();
	jQuery('#apagar_galeria').val( apagar_galeria +','+ idapagarImagem );
}
function apagarImagem2(elm, idapagarImagem) {
	//jQuery(elm)	
	jQuery('#img2_'+idapagarImagem).hide();	
	var apagar_galeria = jQuery('#apagar_galeria2').val();
	jQuery('#apagar_galeria2').val( apagar_galeria +','+ idapagarImagem );
}