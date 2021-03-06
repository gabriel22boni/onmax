$(document).ready(function(){

	$('.single-item').slick();

	var modalConfirm = function(callback){
  
	  $("#btn-confirm").on("click", function(){
	    $("#modalProva").modal('show');
	  });

	  $(".modal-btn-si").on("click", function(){
	    callback(true);
	    $("#modalProva").modal('hide');
	    $("#modalDeclaracao").modal('hide');
	  });
	  
	  $(".modal-btn-no").on("click", function(){
	    callback(false);
	    $("#modalProva").modal('hide');
	    $("#modalDeclaracao").modal('hide');
	  });
	};

	modalConfirm(function(confirm){
	  if(confirm){

	  	var idProva 		= $('#idProva').val();
	  	var nomeModal 		= $('#nomeModal').val();

	  	if(nomeModal == 'declaracao'){

		  	$.ajax({
			  type: "POST",
			  url: 'model/declaraoModel/formDeclaracao',
			  data: "idProva= " + idProva,
			  beforeSend: function() {
		        $('.btn-declaracao').css( "font-size","18px" );
    			$('.btn-declaracao').css( "padding","6px" );
			  	$('.btn-declaracao').html('ENVIANDO SOLICITAÇÃO<br/>AGUARDE...');
			  	$('.btn-declaracao').addClass('btn-efetuada');
		  	 },
			  success: function(data){
			  	$('#aviso-reserva').html(data);	
    			$('.btn-declaracao').css( "font-size","18px" );
    			$('.btn-declaracao').css( "padding","6px" );
			  	$('.btn-declaracao').html('SOLICITAÇÃO ENVIADA...<br/>AGUARDE O PRAZO INFORMADO!');	  	
			  }
			});		

		}else{

			$.ajax({
			  type: "POST",
			  url: 'model/agendamentoModel/formAgendamento',
			  data: "idProva= " + idProva,
			  success: function(data){
			  	$('#aviso-reserva').html(data);
			  	$('#'+idProva).html('RESERVA EFETUADA');
			  }
			});	

		}

	  }else{
	    //Acciones si el usuario no confirma
	     console.log("NO CONFIRMADO");
	  }
	});

	//Carrega os horarios disponiveis
	$('#esqueci-senha').click(function(e){

		$('#recupera_senha').val('1');

		var email = $(".email").val();
		if(email == ''){
			swal('ERRO!!!', 'Preencha o e-mail para recuperar a senha, e clique em acessar', 'error');
		}else{
			swal('ERRO!!!', 'Clique em acessar para receber o e-mail com o link de recuperação!', 'error');
		}
	});	

	//Carrega os horarios disponiveis
	$('.alterar-horario').click(function(e){

		var idProva = $(this).attr('data-prova');
		$.ajax({
		  type: "POST",
		  url: 'model/agendamentoModel/formHorario',
		  data: "idProva= " + idProva + "&altera= 1 ",
		  success: function(data){
		  	$('.body-prova').html(data);
		  }
		});	

	});	

	//Carrega os horarios disponiveis
	$('.btn-agenda-prova').click(function(e){

		var idProva = $(this).attr('data-id');
		$.ajax({
		  type: "POST",
		  url: 'model/agendamentoModel/formHorario',
		  data: "idProva= " + idProva,
		  success: function(data){
		  	$('.body-prova').html(data);
		  }
		});	

	});	

	//Reserva o horário selecionado
	$('.reservar-horario').click(function(e){

		var Prova 		= $(this).attr('data-prova');
		var Horario 	= $(this).attr('data-horario');
		var idHorario 	= $('.horario-'+ Horario +' option:selected').val();
		
		$.ajax({
		  type: "POST",
		  url: 'model/agendamentoModel/formAgendamento',
		  data: "idProva= " + Prova +"&idHorario= "+ idHorario,
		   beforeSend: function() {
		        $('.reservar-horario').addClass('disable-elemento');
		        $('#'+Horario).html('EFETUANDO RESERVA');
		        //$('.reservar-horario').html('RESERVA INDISPONÍVEL');
		  		$('.reservar-horario').addClass('btn-efetuada');
		   },
		  success: function(data){
		  	$('#aviso-reserva').html(data);		  			  	
		  	$('#'+Horario).addClass('btn-efetuada');
		  	$('#'+Horario).html('RESERVA EFETUADA');
		  }
		});	

	});	
	

	$('.formBoletin .btn-solicitar').click(function(e){
		e.preventDefault();
		var botao = $(this);

		botao.html('ACESSANDO...');
		botao.prop('disabled', true);
		
		$('.formBoletin').ajaxSubmit({
			url: 'model/boletimModel/formBoletin',
			type: 'POST',
			success: function(data){
				$('#recupera_senha').val('');
				$('.result').html(data);
				botao.prop('disabled', false);
				botao.html('ACESSAR');
			}
		});
	});

	$('.formAlteraSenha .btn-alterar').click(function(e){
		e.preventDefault();
		var botao = $(this);

		botao.html('ALTERANDO SENHA...');
		botao.prop('disabled', true);
		
		$('.formAlteraSenha').ajaxSubmit({
			url: 'model/boletimModel/formAlteraSenha',
			type: 'POST',
			success: function(data){
				$('.result').html(data);
				botao.prop('disabled', false);
				botao.html('ALTERAR SENHA');
			}
		});

	});

	$('.formNovaSenha .btn-alterar').click(function(e){
		e.preventDefault();
		var botao = $(this);

		botao.html('ALTERANDO SENHA...');
		botao.prop('disabled', true);
		
		$('.formNovaSenha').ajaxSubmit({
			url: 'model/boletimModel/formAlteraSenha',
			type: 'POST',
			success: function(data){
				$('.result').html(data);
				botao.prop('disabled', false);
				botao.html('SENHA ALTERADA');
			}
		});

	});

	


	// Style PHP ucWords in JavaScript

	$(".ucWordsJs").keyup(function(){

		var txt = $(this).val();

		$(this).val(txt.replace(/^(.)|\s(.)/g, function($1){ 

			return $1.toUpperCase( ); 

		}));

	});



	// Tooltip bootstrap

	$('[data-toggle="tooltip"]').tooltip({

		html : true

	});



	$('[data-toggle="popover"]').popover({

		html : true

	});



	// Masks Default

    $(".maskTelefoneBR").mask("(00) 0000-00000");

    $(".maskTelefonesMundial").mask("+00 00 0000-00000");

    $(".maskCnpj").mask("00.000.000/0000-00");

    $(".maskCPF").mask("000.000.000-00");

    $(".maskCep").mask("00000-000");

    $(".maskMoney").mask('000.000.000.000.000,00', {reverse: true});

    $(".maskNum").mask("000000000000000000");



    // PORCENTAGEM

    $(".maskInteriroCentena").mask('000', {reverse: true});

    $(".mask1Casa").mask('0.0', {reverse: true});

    $(".mask2Casas").mask('0.00', {reverse: true});



    // CARTAO

    $(".maskCartao").mask("0000 0000 0000 0000");

    $(".maskCartaoCod").mask("00000");

    



    // HORARIO

    $(".maskData").mask("00/00/0000");

    $(".maskHora").mask("00:00");

    $(".maskHora2").mask("00:00 - 00:00");

    $(".maskMonth").mask("00");

    $(".maskYear").mask("0000");



    // Mask DatePicker

    //$('.datepicker').datepicker({ "language" : "pt-BR", "format"   : "dd/mm/yyyy" });



});

/*function validarSenha(){
	senha1 = document.formAlteraSenha.password.value
	senha2 = document.formAlteraSenha.passwordconf.value
 
	if (senha1 == senha2)
		document.formAlteraSenha.submit();
	else
		sweetAlert("Senhas diferentes!", "digite as senhas iguais!", "warning");
}*/

function sweetAutoRedir(titulo, msg, tipo, url)

{

	if(tipo == "error")

	{

		var btnColor = "#F27474";

	}

	else if(tipo == "success")

	{

		var btnColor = "#A5DC86";

	}

	else if(tipo == "warning")

	{

		var btnColor = "#F8C086";

	}

	else if(tipo == "info")

	{

		var btnColor = "#C9DAE1";

	}



	swal({

		title : titulo,

		html  : msg,

		type  : tipo,

		//timer: 2000,   

		allowEscapeKey: false,

		allowOutsideClick : false,

		showConfirmButton: false,

	}).then(function(isConfirm) {

		

	});



	setTimeout(function(){ window.location.href = url; }, 4000);

}





function sweetRedir(titulo, msg, tipo, url, btnText)

{

	if(tipo == "error")

	{

		var btnColor = "#F27474";

	}

	else if(tipo == "success")

	{

		var btnColor = "#A5DC86";

	}

	else if(tipo == "warning")

	{

		var btnColor = "#F8C086";

	}

	else if(tipo == "info")

	{

		var btnColor = "#C9DAE1";

	}



	swal({

		title : titulo,

		html  : msg,

		type  : tipo,

		allowEscapeKey: false,

		allowOutsideClick : false,

		confirmButtonColor : btnColor,

		confirmButtonText  : btnText,

	}).then(function() {

		window.location.href= url; 

	});

}



function sweetAlert(titulo, msg, tipo, btnText)

{

	if(tipo == "error")

	{

		var btnColor = "#F27474";

	}

	else if(tipo == "success")

	{

		var btnColor = "#A5DC86";

	}

	else if(tipo == "warning")

	{

		var btnColor = "#F8C086";

	}

	else if(tipo == "info")

	{

		var btnColor = "#C9DAE1";

	}



	if(btnText != "")

	{

		var textBtn = btnText;

	}

	else

	{

		var textBtn = "Voltar";

	}



	swal({

		title : titulo,

		html  : msg,

		type  : tipo,

		confirmButtonColor : btnColor,

		confirmButtonText  : textBtn,  

	}).then(function(isConfirm) {

		swal.close;

	});

}





function sweetAutoReload(titulo, msg, tipo, btnText)

{

	if(tipo == "error")

	{

		var btnColor = "#F27474";

	}

	else if(tipo == "success")

	{

		var btnColor = "#A5DC86";

	}

	else if(tipo == "warning")

	{

		var btnColor = "#F8C086";

	}

	else if(tipo == "info")

	{

		var btnColor = "#C9DAE1";

	}



	swal({

		title : titulo,

		html  : msg,

		type  : tipo,

		allowEscapeKey: false,

		allowOutsideClick : false,

		//showConfirmButton: false,

		confirmButtonColor : btnColor,

		confirmButtonText  : btnText,

	}).then(function(isConfirm) {

		window.location.hash = ""; location.reload();

	});



	setTimeout(function(){ window.location.hash = ""; location.reload(); }, 2000);

}





// All letters to uppercase

function upCase(lstr)

{

	var str = lstr.value;

	lstr.value = str.toUpperCase();

}



// All letters to lowcase

function lowCase(lstr)

{

	var str = lstr.value;

	lstr.value = str.toLowerCase();

}



function upCase(lstr)

{

	var str = lstr.value;

	lstr.value = str.toUpperCase();

}



// Dependency bootbox.js

function confirmBox(msg, destino)

{

	bootbox.confirm(msg, function(result) {

		if(result == true)

		{

			location.href = destino;

			return true;

		}

	}); 

}



// Dependency bootbox.js

function alertBox(msg)

{

	bootbox.alert(msg);

}


function setaDadosModal(idProva, nomeProva){	
	$("#idProva").val(idProva);
	$("#tituloProva").html(nomeProva);
}