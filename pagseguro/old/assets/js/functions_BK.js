$(document).ready(function(){

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
