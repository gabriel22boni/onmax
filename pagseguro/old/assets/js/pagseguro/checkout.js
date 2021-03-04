// Setting the application NameSpace
var MyApplication = window.MyApplication || {};
MyApplication.CheckoutPage = new function() {
	
	var hasSessionId = false; // Inicia sem sessionId
	
	var updateSessionId = function(callback) {
		
		showLoading();
		
		$.ajax({
			url: "model/getPagamento/sessionid/"+chave+"/"+chave2,
			type:"GET",
			cache: false,
			success: function(response) {
				
				PagSeguroDirectPayment.setSessionId(response);
				
				hasSessionId = true;
				cardBrandEvents();
				callback();
				
			},
			error: function() {
				alert(" Não foi possível obter o Session ID do PagSeguro ");
			},
			complete: function() {
				hideMessages();
			}
		});
		
	};
	
	// Atualiza dados de parcelamento atráves da bandeira do cartão
	var updateInstallments = function(brand) {
		
		var amount = Number($('#CART_VAL').val());
		//var amount = Number('1000');
		
		PagSeguroDirectPayment.getInstallments({
			amount: amount,
			brand:  brand,
			success: function(response) {
				//console.log(response);
				
				// Para obter o array de parcelamento use a bandeira como "chave" da lista "installments"
				var installments = response.installments[brand];
				
				var options = '';
				for (var i in installments) {
					
					if(i < qtpa){
						var optionItem     = installments[i];
						var optionQuantity = optionItem.quantity; // Obtendo a quantidade
						var optionAmount   = optionItem.installmentAmount; // Obtendo o valor
						var optionTotalAmount   = optionItem.totalAmount; // Obtendo o valor
						var optionLabel    = (optionQuantity + "x " + formatMoney(optionAmount)); // montando o label do option
						var price          = Number(optionAmount).toMoney(2,'.','');
						
						if(optionItem.interestFree === false){
							var optionLabel    = (optionQuantity + "x " + formatMoney(optionAmount) + "("+formatMoney(optionTotalAmount)+")"); // montando o label do option
							options += ('<option value="' + optionItem.quantity + '" dataPrice="'+price+'">'+ optionLabel +'</option>');
						}else{
							options += ('<option value="' + optionItem.quantity + '" dataPrice="'+price+'">'+ optionLabel +'</option>');
						}
					}
					
				};
				
				// Atualizando dados do select de parcelamento
				$("#installmentQuantity").html(options);
				
				// Exibindo select do parcelamento
				$("#installmentsWrapper").show();
				
				// Utilizando evento "change" como gatilho para atualizar o valor do parcelamento
				$("#installmentQuantity").trigger('change');
				
			},
			error: function(response) {
				
			},
			complete: function(response) {
				
			}
		});
		
	};
	
	
	var updateCardBrand = function(cardBin) {
		
		PagSeguroDirectPayment.getBrand({
			
			cardBin: cardBin,
			
			success: function(response) {
				
				var brand = response.brand.name;
				
				$(".cardBrand").attr('brand', brand);
				$("#creditCardBrand").val(brand);
				
				updateInstallments(brand);
				
			},
			
			error: function(response) {
				
			},
			
			complete: function(response) {
				
			}
			
		});
		
	};
	
	var changeMethod = function(method) {
		
		var loading = $("#paymentMethodLoading");
		
		loading.show();
		
		var showBox = function() {
			
			var allMethods = $(".paymentMethodGroup");
			var thisMethod = allMethods.filter("[dataMethod='"+method+"']");
			
			allMethods.hide();
			thisMethod.show();
			loading.hide();
			
		};
		
		if (hasSessionId) {
			showBox();
		} else {
			// obter sessioId se ainda não foi setado
			updateSessionId(showBox);
		}
		
	};
	
	
	var updateCardToken = function(callback) {
		
		PagSeguroDirectPayment.createCardToken({
			
			cardNumber: $("#cardNumber").val().replace(/[^0-9.]/g, ""),
			brand: $("#creditCardBrand").val(),
			cvv: $("#cardCvv").val().replace(/[^0-9.]/g, ""),
			expirationMonth: $("#cardExpirationMonth").val().replace(/[^0-9.]/g, ""),
			expirationYear: $("#cardExpirationYear").val().replace(/[^0-9.]/g, ""),
			
			success: function(response) {
				
				// Obtendo token para pagamento com cartão
				var token = response.card.token;
				
				// Executando o callback (pagamento) passando o token como parâmetro
				callback(token);
				
			},
			
			error: function(response) {
				
				showCardTokenErrors(response.errors);
				
			},
			
			complete: function(response) {
				
			}
			
		});
		
	};
	
	
	// Fazer pagamento de qualquer tipo
	var doPayment = function(params, callback) {
		
		// travando a tela (loading)
		showLoading();
		
		// Adicionando dados do comprador aos parâmentros de pagamento
		areaToParams("buyerData", params);
		
		// Adicionando dados dos items (carrinho) aos parâmetros de pagamento
		addCartData(params);
		
		// Atualizando hash do comprador
		params.senderHash = PagSeguroDirectPayment.getSenderHash();
		
		// Request para o PHP passando os dados do pagamento
		$.ajax({
			type:"POST",
			url: "model/getPagamento/payment/"+chave+"/"+chave2,
			data: params,
			dataType: 'json',
			cache: false,
			success: function(response) {
				
				// Executa o callback passado como parâmentro
				callback(response.transaction);
				
			},
			error: function(jqxhr) {
				// Liberando a tela (esconde o loading)
				//hideMessages();
				
				// obtendo lista de erros
				var response = $.parseJSON(jqxhr.responseText);
				
				// Exibindo lista de erros
				showPaymentErrors(response.errors);
				
			}
			
		});
		
	};
	
	// Pagamento com cartão de crédito
	var creditCardPayment = function() {
		
		showLoading();
		
		//////////////////////////////////////
		// fazer validação nesse ponto;
		//////////////////////////////////////
		
		updateCardToken(function(cardToken) {
			
			// Atualizando field que deve conter o valor do token
			$("#creditCardToken").val(cardToken);
			
			var params = {
				paymentMethod: 'creditCard'
			};
			
			// Adicionando dados do cartão de crédito aos parâmentros de pagamento
			areaToParams("creditCardData", params);
			
			// Fazer pagamento via cartão de crédito passando um callback a ser executado no final
			doPayment(params, function(transaction){
				
				finalizaPagamento();
				//window.location.href = "/compra-realizada/"+chave;
				
			});
			
		});
		
	};
	
	// Alerando tipo de meio de pagamento (cartão, boleto ou tef)
	var changeMethodEvents = function() {
		var radioInputs = $("input[name='changePaymentMethod']");
		radioInputs.click(function(){
			
			var method = $(this).val();
			
			changeMethod(method);
			
		});
		radioInputs.filter(":checked").trigger("click");
	};
	
	
	// Pagamento via cartão de crédito no click do "botão pagar"
	var creditCardPaymentEvents = function() {
		$("#creditCardPaymentButton").click(function(){
			creditCardPayment();
		});
	};
	
	
	// Gerenciando bandeira do cartão
	var cardBrandEvents = function() {
		
		var verifyBrand = function() {
			var cardBin = $("#cardNumber").val().replace(/[^0-9.]/g, "");

			// Obtendo apenas os 6 primeiros dígitos (bin)
			var cardBin = cardBin.substring(0, 6);
			
			// Atualizar Brand apenas se tiver 6 ou mais dígitos preenchidos
			if (String(cardBin).length >= 6) {
				
				// Atualizar Brand
				updateCardBrand(cardBin);
				
			} else {
				
				// Se não digitou o número do cartão, esconder parcelamento
				$("#installmentsWrapper").hide();

				$(".cardBrand").attr('brand', '');
				$("#creditCardBrand").val('');
				
			}
		};
		
		// Verificar bandeira após qualquer mudança nos inputs de cartão de crédito
		$(".cardDatainput").on('change', function(){
			verifyBrand();
		});

		// Verificar bandeira logo no início
		verifyBrand();
		
	};
	
	// Atualizando o valor do parcelamento
	var installmentQuantityEvents = function() {
		$("#installmentQuantity").change(function() {
			var option = $(this).find("option:selected");
			if (option.length) {
				$("#installmentValue").val( option.attr("dataPrice") );
			}
		});
	};
	
	var holderEvents = function() {
		
		var holderData = $("#holderData");
		
		// Usar dados do comprador para preencher dados do dono do cartão
		$("#sameHolder").click(function(){
			
			$("#buyerData [holderField]").each(function(){
				var fieldRef = $(this).attr('holderField');
				var value = $(this).val();
				holderData.find("[holderField=\""+fieldRef+"\"]").val(value);
			});
			
			holderData.show();
			$('.dadosCobranca').hide();
			$("#creditCardHolderName").focus();
			
		});
		
		// limpar dados do dono do cartão para preecher novo
		$("#otherHolder").click(function(){
			holderData.find("input").val('');
			$('#billingAddressCountry').val('Brasil');
			holderData.show();
			$('.dadosCobranca').show();
			$("#creditCardHolderName").focus();
		});
		
		// Verificar no início
		$("input[name='holderType']:checked").trigger('click');
		
	};
	
	// Adicionar dados do carrinho aos parâmetros de pagamento
	var addCartData = function(params) {
		
		// $("#cartTable tbody tr").each(function(index, element){
		// 	$(element).find("td").each(function(){
		// 		if($(this).attr("data-name")) {
		// 			if (startsWith($(this).attr("data-name"),"itemAmount")) {
		// 				params[$(this).attr("data-name") + (index+1)] = $(this).html().replace(",",".");
		// 			} else {
		// 				params[$(this).attr("data-name") + (index+1)] = $(this).html();
		// 			}
		// 		}
		// 	});
		// });

		params['itemId1'] = '0001';
		params['itemDescription1'] = $('#CART_DESC').val();
		params['itemAmount1'] = $('#CART_VAL').val();
		params['itemQuantity1'] = 1;

		// console.log(params);
		
		
	};
	
	
	
	
	// Pagamento com TEF
	var eftEvents = function() {
		
		$(".bank-flag").click(function(){
			var bank = $(this).attr("dataBank");
			var params = {
				paymentMethod: 'eft',
				bankName: bank
			};
			doPayment(params, function(transaction){
				window.open(transaction.paymentLink);
				showWaitingPayment('Débito online....<br><a href="'+transaction.paymentLink+'" target="_blank" onclick="window.location.href = \'/compra-aguardando/\'+chave">Clique aqui caso seja redirecionado para a página do banco</a>');

				finalizaPagamentoOutros();
			});
		});
		
	};
	
	
	// Pagamento com boleto
	var boletoEvents = function() {
		
		$("#boletoButton").click(function(){
			var params = {
				paymentMethod: 'boleto'
			};
			doPayment(params, function(transaction){
				window.open(transaction.paymentLink);
				showWaitingPayment('Pagamento com Boleto...<br><a href="'+transaction.paymentLink+'" target="_blank" onclick="window.location.href = \'/compra-aguardando/\'+chave">Clique aqui caso o boleto não apareça</a>');
				finalizaPagamentoOutros();
			});
		});
		
	};
	
	
	// Aplicando eventos apenas quado o documento estiver pronto
	$(document).ready(function(){
		//cartEvents();
		changeMethodEvents();
		holderEvents();
		creditCardPaymentEvents();
		installmentQuantityEvents();
		eftEvents();
		boletoEvents();
	});
	
};
