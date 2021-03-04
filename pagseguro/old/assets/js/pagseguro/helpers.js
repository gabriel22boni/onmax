	
var formatMoney = function(valor) {
	var valorAsNumber = Number(valor);
	return 'R$ ' + valorAsNumber.toMoney(2,',','.');
};

Number.prototype.toMoney = function(decimals, decimal_sep, thousands_sep) {
	var n = this,
	c = isNaN(decimals) ? 2 : Math.abs(decimals),
	d = decimal_sep || '.', 
	t = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	sign = (n < 0) ? '-' : '',
	i = parseInt(n = Math.abs(n).toFixed(c)) + '', 
	j = ((j = i.length) > 3) ? j % 3 : 0; 
	return sign + (j ? i.substr(0, j) + t : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : ''); 
};

var areaToParams = function (area, params) {
	params = params || {};
	$("#" + area).find('input, select').each(function(){
		params[ $(this).attr('name') ] = $(this).val();
	});
};

var startsWith = function(data, input) {
	return data.substring(0, input.length) === input;
}


var showLoading = function(text) {
	
	$.colorbox({
		html: "<h1>Aguarde...</h1>",
		transition: 'none',
		close: false,
		escKey: false,
		overlayClose: false,
		fixed: true
	});
	
};

var showTransactionCode = function(code) {
	
	var html = ('<h1 class="success">'+code+'</h1>');
	
	$.colorbox({
		html: html,
		close: false,
		escKey: false,
		overlayClose: false,
		fixed: true
	});
	
};

var showWaitingPayment = function(paymentName) {
	
	var html = ('<h1 class="success">'+paymentName+'</h1>');
	
	$.colorbox({
		html: html,
		close: false,
		escKey: false,
		overlayClose: false,
		fixed: true
	});
	
};

var showPaymentErrors = function(errors) {
	
	if (typeof errors == 'object') {
		
		var errors = errors.error;
		var html = '<ul class="errors">';
		
		for (var i in errors) {
			var error = errors[i];
			html += ('<li>' + errorPag(error.message) + '</li>');
		}
		
		html += ('</ul>');
		
		$.colorbox({
			html: html,
			fixed: true
		});
		
	}
	
};

var showCardTokenErrors = function(errors) {
	
	if (typeof errors == 'object') {
		
		var html = '<ul class="errors">';
		
		for (i in errors) {
			html += ('<li>' + errorPag(errors[i]) + '</li>');
		}
		
		html += ('</ul>');
		
		$.colorbox({
			html: html,
			fixed: true
		});
		
	}
	
};

var hideMessages = function() {
	$.colorbox.close();
};




retornoPagSeguroTransparente = [];
retornoPagSeguroTransparente["Credit Card Owner's Name"] = "Nome do Dono do Cartão";
retornoPagSeguroTransparente["Installments"] = "Parcelas";
retornoPagSeguroTransparente["sender hash invalid."] = "Sender Hash inválido.";
retornoPagSeguroTransparente["items invalid quantity."] = "Quantidade inválida de itens.";
retornoPagSeguroTransparente["currency is required."] = "Moeda é obrigatório.";
retornoPagSeguroTransparente["sender email is required."] = "E-mail do comprador obrigatório.";
retornoPagSeguroTransparente["sender name is required."] = "Nome do comprador obrigatório.";
retornoPagSeguroTransparente["sender area code is required."] = "Código de área do comprador obrigatório.";
retornoPagSeguroTransparente["sender phone is required."] = "Telefone do comprador obrigatório.";
retornoPagSeguroTransparente["shipping address postal code is required."] = "CEP do comprador obrigatório.";
retornoPagSeguroTransparente["shipping address street is required."] = "Endereço do comprador obrigatório.";
retornoPagSeguroTransparente["shipping address number is required."] = "Número do endereço do comprador obrigatório.";
retornoPagSeguroTransparente["shipping address district is required."] = "Bairro do comprador obrigatório.";
retornoPagSeguroTransparente["shipping address city is required."] = "Cidade do comprador é obrigatório.";
retornoPagSeguroTransparente["shipping address state is required."] = "Estado do comprador obrigatório.";
retornoPagSeguroTransparente["shipping address country is required."] = "País é obrigatório.";
retornoPagSeguroTransparente["credit card token is required."] = "Token do cartão de crédito é obrigatório.";
retornoPagSeguroTransparente["installment quantity is required."] = "Número de parcelas é obrigatório.";
retornoPagSeguroTransparente["installment value is required."] = "Valor da parcela é obrigatório.";
retornoPagSeguroTransparente["credit card holder name is required."] = "Nome do portador do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder cpf is required."] = "CPF do dono do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder birthdate is required."] = "Data de Nascimento do dono do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder area code is required."] = "DDD do dono do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder phone is required."] = "Telefone do dono do cartão é obrigatório.";
retornoPagSeguroTransparente["billing address postal code is required."] = "CEP do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address street is required."] = "Rua do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address number is required."] = "Número do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address district is required."] = "Bairro do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address city is required."] = "Cidade do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address state is required."] = "Estado do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address country is required."] = "País do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["item id is required."] = "ID do item é obrigatório.";
retornoPagSeguroTransparente["item description is required."] = "Descrição do item é obrigatório.";
retornoPagSeguroTransparente["item quantity is required."] = "Quantidade do item é obrigatório.";
retornoPagSeguroTransparente["item amount is required."] = "Valor do item é obrigatório.";
retornoPagSeguroTransparente["sender is related to receiver."] = "Comprador está relacionado com o recebedor.";
retornoPagSeguroTransparente["payment method unavailable."] = "Método de pagamento indisponível.";
retornoPagSeguroTransparente["invalid creditcard data."] = "Dados do cartão inválido.";
retornoPagSeguroTransparente["sender hash invalid."] = "Identificação do comprador(hash) inválido.";
retornoPagSeguroTransparente["credit card brand is not accepted."] = "Bandeira do cartão não é aceita.";
retornoPagSeguroTransparente["payment mode invalid value, valid values are default and gateway."] = "PaymentMode inváido, valores válidos são default e gateway.";
retornoPagSeguroTransparente["payment method invalid value, valid values are creditCard, boleto e eft."] = "PaymentMethod inválido, valores válidos são creditCard, boleto e eft";
retornoPagSeguroTransparente["shipping cost was provided, shipping address must be complete."] = "Custo de envio foi fornecido, endereço de envio deve estar completo.";
retornoPagSeguroTransparente["sender information was provided, email must be provided too."] = "Informações do comprador foram fornecidas, email também deve ser fornecido.";
retornoPagSeguroTransparente["credit card holder is incomplete."] = "Dados do dono do cartão incompletos.";
retornoPagSeguroTransparente["shipping address information was provided, sender email must be provided too."] = "Endereço foi informado, o e-mail do comprador também deve ser fornecido.";
retornoPagSeguroTransparente["eft bank is required."] = "Banco para EFT deve ser informado.";
retornoPagSeguroTransparente["eft bank is not accepted."] = "Banco não é aceito.";
retornoPagSeguroTransparente["sender is blocked."] = "Comprador bloqueado.";
retornoPagSeguroTransparente["credit card token invalid."] = "Token de cartão de crédito inválido.";
retornoPagSeguroTransparente["Credit Card Owner's CPF"] = "CPF do Dono do Cartão";
retornoPagSeguroTransparente["Credit Card Number"] = "Número do Cartão";
retornoPagSeguroTransparente["sender cpf or sender cnpj is required"] = "CPF do comprador é obrigatório.";
retornoPagSeguroTransparente["Send new order email"] = "Enviar e-mail de novo pedido";
retornoPagSeguroTransparente["invalid creditcard brand."] = "Bandeira do cartão inválida";
retornoPagSeguroTransparente["creditcard number with invalid length."] = "Cartão de crédito com tamanho inválido";
retornoPagSeguroTransparente["invalid date format."] = "Data com formato inválido";
retornoPagSeguroTransparente["invalid security field."] = "Campo de segurança inválido";
retornoPagSeguroTransparente["cvv is mandatory."] = "CVV é obrigatório";
retornoPagSeguroTransparente["security field with invalid length."] = "Código de segurança com tamanho incorreto";
retornoPagSeguroTransparente["items invalid quantity."] = "Quantidade inválida de itens";
retornoPagSeguroTransparente["currency is required."] = "Moeda é obrigatório";
retornoPagSeguroTransparente["currency invalid value"] = "Moeda inválida";
retornoPagSeguroTransparente["reference invalid length"] = "Referência com tamanho inválido";
retornoPagSeguroTransparente["notificationURL invalid length"] = "Tamanho inválido do notificationURL";
retornoPagSeguroTransparente["notificationURL invalid value"] = "Valor inválido do notificationURL";
retornoPagSeguroTransparente["sender email is required."] = "Email do comprador é obrigatório";
retornoPagSeguroTransparente["sender email invalid length"] = "Tamanho inválido do email do comprador";
retornoPagSeguroTransparente["sender email invalid value"] = "Email do comprador incorreto";
retornoPagSeguroTransparente["sender name is required."] = "Nome do comprador é obrigatório";
retornoPagSeguroTransparente["sender name invalid length"] = "Nome do comprador com tamanho inválido";
retornoPagSeguroTransparente["sender name invalid value"] = "Nome do comprador com valor inválido";
retornoPagSeguroTransparente["sender cpf invalid value"] = "CPF do comprador inválido";
retornoPagSeguroTransparente["sender area code is required."] = "Código de área do comprador é obrigatório";
retornoPagSeguroTransparente["sender area code invalid value"] = "Código de área do comprador inválido";
retornoPagSeguroTransparente["sender phone is required."] = "Telefone do comprador é obrigatório.";
retornoPagSeguroTransparente["sender phone invalid value: %s"] = "Telefone do comprador inválido";
retornoPagSeguroTransparente["shipping address postal code is required."] = "CEP de cobrança é obrigatório";
retornoPagSeguroTransparente["shipping address postal code invalid value"] = "CEP de cobrança inválido";
retornoPagSeguroTransparente["shipping address street is required."] = "Endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["shipping address street invalid length"] = "Endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["shipping address number is required."] = "Número do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["shipping address number invalid length"] = "Número do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["shipping address complement invalid length"] = "Complemento do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["shipping address district is required."] = "Bairro do comprador é obrigatório";
retornoPagSeguroTransparente["shipping address district invalid length"] = "Bairro de cobrança com tamanho inválido";
retornoPagSeguroTransparente["shipping address city is required."] = "Cidade de cobrança é obrigatório.";
retornoPagSeguroTransparente["shipping address city invalid length"] = "Cidade de cobrança com tamanho inválido";
retornoPagSeguroTransparente["shipping address state is required."] = "Estado de cobrança é obrigatório.";
retornoPagSeguroTransparente["shipping address state invalid value"] = "Estado de cobrança com valor inválido";
retornoPagSeguroTransparente["shipping address country is required."] = "País de cobrança é obrigatório.";
retornoPagSeguroTransparente["shipping address country invalid length"] = "País de cobrança com tamanho inválido";
retornoPagSeguroTransparente["credit card token is required."] = "Token do cartão é obrigatório.";
retornoPagSeguroTransparente["installment quantity is required."] = "Quantidade de parcelas é obrigatório.";
retornoPagSeguroTransparente["installment quantity invalid value"] = "Quantidade de parcelas incorreto";
retornoPagSeguroTransparente["installment value is required."] = "Valor da parcela é obrigatório.";
retornoPagSeguroTransparente["installment value invalid value"] = "Valor da parcela inválido";
retornoPagSeguroTransparente["credit card holder name is required."] = "Nome do titular do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder name invalid length"] = "Nome do titular do cartão com tamanho inválido";
retornoPagSeguroTransparente["credit card holder name invalid value"] = "Nome do titular do cartão incorreto";
retornoPagSeguroTransparente["credit card holder cpf is required."] = "CPF do titular do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder cpf invalid value"] = "CPF do titular do cartão inválido";
retornoPagSeguroTransparente["credit card holder birthdate is required."] = "Data de nascimento do titular do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder birthdate invalid value"] = "Data de nascimento do titular do cartão incorreto";
retornoPagSeguroTransparente["credit card holder area code is required."] = "Código de área do titular do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder area code invalid value"] = "Código de área do titular do cartão inválido";
retornoPagSeguroTransparente["credit card holder phone is required."] = "Telefone do titular do cartão é obrigatório.";
retornoPagSeguroTransparente["credit card holder phone invalid value"] = "Telefone do titular do cartão inválido";
retornoPagSeguroTransparente["billing address postal code is required."] = "CEP de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address postal code invalid value"] = "CEP de cobrança inválido";
retornoPagSeguroTransparente["billing address street is required."] = "Endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address street invalid length"] = "Endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["billing address number is required."] = "Número do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address number invalid length"] = "Número do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["billing address complement invalid length"] = "Complemento do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["billing address district is required."] = "Bairro do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address district invalid length"] = "Bairro do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["billing address city is required."] = "Cidade do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address city invalid length"] = "Cidade do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["billing address state is required."] = "Estado do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address state invalid value"] = "Estado do endereço de cobrança inválido";
retornoPagSeguroTransparente["billing address country is required."] = "País do endereço de cobrança é obrigatório.";
retornoPagSeguroTransparente["billing address country invalid length"] = "País do endereço de cobrança com tamanho inválido";
retornoPagSeguroTransparente["receiver email invalid length"] = "E-mail do vendedor com tamanho inválido";
retornoPagSeguroTransparente["receiver email invalid value"] = "E-mail do vendedor inválido";
retornoPagSeguroTransparente["item id is required."] = "Id do item é obrigatório.";
retornoPagSeguroTransparente["item id invalid length"] = "Id do item possuí tamanho inválido";
retornoPagSeguroTransparente["item description is required."] = "Descrição do item é obrigatório.";
retornoPagSeguroTransparente["item description invalid length"] = "Descrição do item com tamanho inválido";
retornoPagSeguroTransparente["item quantity is required."] = "Quantidade do item é obrigatório.";
retornoPagSeguroTransparente["item quantity out of range"] = "Quantidade do item fora do permitido";
retornoPagSeguroTransparente["item quantity invalid value"] = "Quantidade do item inválida";
retornoPagSeguroTransparente["item amount is required."] = "Valor do item é obrigatório.";
retornoPagSeguroTransparente["item amount invalid pattern. Must fit the patern: \\d+.\\d\{2\}"] = "Valor do item deve seguir o padrão: \\d+.\\d\{2\}";
retornoPagSeguroTransparente["item amount out of range"] = "Valor do item fora do permitido";
retornoPagSeguroTransparente["sender is related to receiver."] = "O comprador está relacionado ao vendedor.";
retornoPagSeguroTransparente["invalid receiver, verify receiver's account status and if it is a seller's account."] = "Vendedor inválido, verifique se a conta do lojista é uma conta de vendedor.";
retornoPagSeguroTransparente["payment method unavailable."] = "Método de pagamento não disponível.";
retornoPagSeguroTransparente["cart total amount out of range"] = "Valor total do carrinho fora do permitido";
retornoPagSeguroTransparente["invalid credit card data."] = "Dados de cartão inválidos.";
retornoPagSeguroTransparente["sender hash invalid."] = "Hash de comprador inválido.";
retornoPagSeguroTransparente["credit card brand is not accepted."] = "Bandeira de cartão não aceita.";
retornoPagSeguroTransparente["shipping type invalid pattern"] = "Tipo de frete for do padrão";
retornoPagSeguroTransparente["shipping cost invalid pattern"] = "Custo de frete fora dos padrões";
retornoPagSeguroTransparente["shipping cost out of range"] = "Custo de frete fora dos limites";
retornoPagSeguroTransparente["cart total value is negative"] = "Valor total do carrinho é negativo";
retornoPagSeguroTransparente["extra amount invalid pattern. Must fit the patern: -?\\d+.\\d\{2\}"] = "Valor extra incompatível. Deve seguir o padrão: -?\\d+.\\d{2\}";
retornoPagSeguroTransparente["payment mode invalid value, valid values are default and gateway."] = "Modo de pagamento inválido. Valores válidos são: default e gateway.";
retornoPagSeguroTransparente["payment method invalid value, valid values are creditCard, boleto e eft."] = "Método de pagamento inválido. Valores aceitos são: creditCard, boleto e eft";
retornoPagSeguroTransparente["shipping cost was provided, shipping address must be complete."] = "Valor de frete foi especificado, endereço de cobrança deve estar completo.";
retornoPagSeguroTransparente["sender information was provided, email must be provided too."] = "Dados do comprador foram especificados, email deve ser especificado também.";
retornoPagSeguroTransparente["credit card holder is incomplete."] = "Nome do titular do cartão está incompleto.";
retornoPagSeguroTransparente["shipping address information was provided, sender email must be provided too."] = "Endereço de cobrança foi fornecido, e-mail do comprador também deve ser fornecido.";
retornoPagSeguroTransparente["eft bank is required."] = "Banco para tef é obrigatório.";
retornoPagSeguroTransparente["eft bank is not accepted."] = "Banco não aceito para tef.";
retornoPagSeguroTransparente["sender born date invalid value"] = "Data de nascimento do comprador inválida";
retornoPagSeguroTransparente["sender email invalid domain. You must use an email @sandbox.pagseguro.com.br"] = "Domínio do e-mail do comprador inválido. Você deve usar um e-mail @sandbox.pagseguro.com.br";
retornoPagSeguroTransparente["installment quantity out of range. The value must be greater than zero."] = "Quantidade de parcelas fora do limite. O valor deve ser maior que zero.";
retornoPagSeguroTransparente["sender is blocked."] = "Comprador está bloqueado.";
retornoPagSeguroTransparente["credit card token invalid."] = "Token de cartão de crédito inválido.";


function errorPag(er){
	var err = er;
	var com = '';

	if(er.indexOf(": ") >= 0){
		er = er.split(': ');
		err = er[0];
		com = ': '+er[1];
	}

	if(retornoPagSeguroTransparente[err]){
		err = retornoPagSeguroTransparente[err];
	}else if(retornoPagSeguroTransparente[err+'.']){
		err = retornoPagSeguroTransparente[err+'.'];
	}else if(retornoPagSeguroTransparente[err.replace('.', "")]){
		err = retornoPagSeguroTransparente[err.replace('.', "")];
	}

	if(com != ''){
		err = err+''+com;
	}

	return err;
}