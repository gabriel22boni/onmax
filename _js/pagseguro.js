    //Mascaras dos inputs
    jQuery(function($){
    $("#creditCardHolderBirthDate, #creditCardHolderNascimentoOther").mask("99/99/9999");
    $("#senderCPF, #creditCardHolderCPFOther").mask("999.999.999-99");
    $("#creditCardHolderCPF").mask("999.999.999-99");
    $("#shippingAddressPostalCode").mask("99999-999");
    $("#billingAddressPostalCode").mask("99999-999");
    $("#cardNumber").mask("9999 9999 9999 9999");
    $("#cardExpirationMonth").mask("99/9999");
    });

    $(document).ready(function() {
    $.ajax({
        type: 'GET',
        url: 'getSessionaHash',
        cache: false,
        success: function(data) {
        PagSeguroDirectPayment.setSessionId(data);
        }
    });
    });

     $("#shippingAddressPostalCode").blur(function(){    // Função que busca endereço com base em CEP. Depende de ALLOW_URL_FOPEN = On 
      $.ajax({
          type: 'POST',
          url: 'busca_cep',
          cache: false,
          dataType: 'json',
          data: {
            'cep' : $('#shippingAddressPostalCode').val()
          },
          beforeSend: function(){
            $('#shippingAddressStreet').val('Carregando dados...');
            $('#shippingAddressDistrict').val('Carregando dados...');
            $('#shippingAddressCity').val('Carregando dados...');
            $('#shippingAddressState').val('Carregando dados...');
          },
          success: function(data) {
            $('#shippingAddressStreet').val(data.tipo_logradouro);
            $('#shippingAddressDistrict').val(data.bairro);
            $('#shippingAddressCity').val(data.localidade);
            $('#shippingAddressState').val(data.uf);
          }
      });
    }); 

    $("input[name='changePaymentMethod']").on('click', function(e) {
        if (e.currentTarget.value == 'creditCard') {
        $('#boletoData').css('display', 'none');
        $('#creditCardData').css('display', 'block');
        } else if (e.currentTarget.value == 'boleto') {
        $('#creditCardData').css('display', 'none');
        $('#boletoData').css('display', 'block');
        }
    });

    // dispara o evento change do checkbox
    $("input[name=holderType]").change(function(){
      // verifica se foi selecionado
      if($(this).is(':checked')){
        $('#dadosOtherPagador').css('display', 'block');
        $('.input-nome-titulo-principal').css('display', 'none');
        $('.input-data-nascimento').css('display', 'none');        
        $('#creditCardHolderName').val('');
        $('#creditCardHolderBirthDate').val('');
      } else {
        $('#creditCardHolderNameOther').val('');
        $('#creditCardHolderNascimentoOther').val('');
        $('#creditCardHolderCPFOther').val('');
        $('#dadosOtherPagador').css('display', 'none');
        $('.input-nome-titulo-principal').css('display', 'block');  
        $('.input-data-nascimento').css('display', 'block');          
      }
    });

    $("input[type='text']").on('blur', function(e) {
        if ( ( $("#" + e.currentTarget.id).css('border') == '2px solid rgb(255, 0, 0)') || ($("#" + e.currentTarget.id).css('border') == '2px solid red' ) ) {
        $("#" + e.currentTarget.id).css('border', '1px solid #999');
        }
    });

  function ReInserir() {
        $("#creditCardHolderName").val($("#senderName").val());
        $("#creditCardHolderCPF").val($("#senderCPF").val());
        $("#creditCardHolderAreaCode").val($("#senderAreaCode").val());
        $("#creditCardHolderPhone").val($("#senderPhone").val());
        $("#billingAddressPostalCode").val($("#shippingAddressPostalCode").val());
        $("#billingAddressStreet").val($("#shippingAddressStreet").val());
        $("#billingAddressNumber").val($("#shippingAddressNumber").val());
        $("#billingAddressComplement").val($("#shippingAddressComplement").val());
        $("#billingAddressDistrict").val($("#shippingAddressDistrict").val());
        $("#billingAddressCity").val($("#shippingAddressCity").val());
        $("#billingAddressState").val($("#shippingAddressState").val());
        $("#billingAddressCountry").val("BRA");
  }

  function parcelasDisponiveis() {
    PagSeguroDirectPayment.getInstallments({
      amount: (($("#totalValue").val()).replace(",", ".")),
      brand: $("#creditCardBrand").val(),
      maxInstallmentNoInterest: 2,

      success: function(response) {
        //console.log(response.installments);
        $("#installmentsWrapper").css('display', "block");


        var installments = response.installments[$("#creditCardBrand").val()];

        var options = '';
        for (var i in installments) {
         if(i <= 3){
            var optionItem     = installments[i];
            var optionQuantity = optionItem.quantity;
            var optionAmount   = optionItem.installmentAmount;
            var optionLabel    = (optionQuantity + " x R$ " + (optionAmount.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,').replace(".", ',')));

            options += ('<option value="' + optionItem.quantity + '" valorparcela="' + optionAmount +'">'+ optionLabel +'</option>');
         }

        };

        $("#installmentQuantity").html(options);

      },

      error: function(response) {
      },

      complete: function(response) {
      }
    });
  }

  $("#installmentQuantity").change(function() {
    var option = $(this).find("option:selected");
    if (option.length) {
      $("#installmentValue").val( option.attr("valorparcela") );
    }
  });

  function brandCard() {

    cardNumber = $("#cardNumber").val();
    cardNumber = cardNumber.replace(/ /g,""); //remove espaco em branco

    PagSeguroDirectPayment.getBrand({
      cardBin: cardNumber,
      success: function(response) {
        $("#cardNumberError").css('display','none');
        $("#creditCardBrand").val(response.brand.name);
        $("#cardNumber").css('border', '1px solid #999');
        $("#bandeiraCartao").attr('src', 'https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/' + response.brand.name + '.png');

        parcelasDisponiveis();

      },

      error: function(response) {
        $("#cardNumber").css('border', '2px solid red');
        $("#cardNumber").focus();
        $("#cardNumberError").css('display','block');
        $("#cardNumberError").html('Cartão inválido');
      },

      complete: function(response) {

      }

    });

  }

  function showModal() {
      $("#modal-title").html("Aguarde");
      $("#modal-body").html("");
      $("#aguarde").modal("show");
  }

  function pagarBoleto(senderHash) {
    showModal();
    $.ajax({
      type: 'POST',
      url: 'pagamentoBoleto.php',
      cache: false,
      data: {
        id: 1,
        email: $("#senderEmail").val(),
        nome: $("#senderName").val(),
        cpf: $("#senderCPF").val(),
        ddd: $("#senderAreaCode").val(),
        telefone: $("#senderPhone").val(),
        cep: $("#shippingAddressPostalCode").val(),
        endereco: $("#shippingAddressStreet").val(),
        numero: $("#shippingAddressNumber").val(),
        complemento: $("#shippingAddressComplement").val(),
        bairro: $("#shippingAddressDistrict").val(),
        cidade: $("#shippingAddressCity").val(),
        estado: $("#shippingAddressState").val(),
        pais: "BRA",
        senderHash: senderHash,
      },
      success: function(data) {

        if (!(data.paymentLink)) {
          //alert(data);
          $("#modal-title").html("<font color='red'>Erro</font>");

          $("#modal-body").html("");
          //console.log(data.error);
          $.each(data.error, function (index, value) {
            if (value.code) {
              //console.log("6 " + value.code);
              tratarError(value.code);
            } else {
              //console.log("7 " + data.error);
              tratarError(data.error.code);
            }

          });
        } else {
          window.location = data.paymentLink;
          setTimeout(function () {
            $("#modal-body").html("");
            $("#modal-title").html("<font color='green'>Sucesso!</font>")

            $("#modal-body").html("Caso você não seja redirecionado para o seu boleto, clique no botão abaixo.<br /><br /><a href='" + data.paymentLink + "'><center><img src='images/boleto.png' /><br /><br /><button class='btn-success btn-block btn-lg'>Ir para o meu boleto</button></center></a>");
          }, 3500);
        }

      }
    });

  }

    function pagarCartao(senderHash) {
      showModal();

      var cardExpiration = $("#cardExpirationMonth").val().split("/");
      now = new Date

      if($("#creditCardHolderName").val() != ''){
        var cardNome = $("#creditCardHolderName").val();
      }else{
        var cardNome = $("#creditCardHolderNameOther").val();
      }

      if($("#creditCardHolderCPFOther").val() != ''){
        var cardCPF = $("#creditCardHolderCPFOther").val();
      }else{
        var cardCPF = $("#senderCPF").val();
      }

      if($("#creditCardHolderBirthDate").val() != ''){
        var cardNasc = $("#creditCardHolderBirthDate").val();
      }else{
        var cardNasc = $("#creditCardHolderNascimentoOther").val();
      }

      PagSeguroDirectPayment.createCardToken({

        //cardNumber: '4111111111111111',

        cardNumber: $("#cardNumber").val(),
        brand: $("#creditCardBrand").val(),
        cvv: $("#cardCvv").val(),
        expirationMonth: cardExpiration[0],
        expirationYear: cardExpiration[1],

        success: function (response) {
          $("#creditCardToken").val(response.card.token);

          $.ajax({
            type: 'POST',
            url: 'pagamentoCartao',
            cache: false,
            data: {
              id: 2,
              email: $("#senderEmail").val(),
              nome: $("#senderName").val(),
              cpf: $("#senderCPF").val(),
              ddd: $("#senderAreaCode").val(),
              telefone: $("#senderPhone").val(),
              cep: $("#shippingAddressPostalCode").val(),
              endereco: $("#shippingAddressStreet").val(),
              numero: $("#shippingAddressNumber").val(),
              complemento: $("#shippingAddressComplement").val(),
              bairro: $("#shippingAddressDistrict").val(),
              cidade: $("#shippingAddressCity").val(),
              estado: $("#shippingAddressState").val(),
              pais: "BRA",
              senderHash: senderHash,
    
              enderecoPagamento: $("#shippingAddressStreet").val(),
              numeroPagamento: $("#shippingAddressNumber").val(),
              complementoPagamento: $("#shippingAddressComplement").val(),
              bairroPagamento: $("#shippingAddressDistrict").val(),
              cepPagamento: $("#shippingAddressPostalCode").val(),
              cidadePagamento: $("#shippingAddressCity").val(),
              estadoPagamento: $("#shippingAddressState").val(),
              cardToken: $("#creditCardToken").val(),
              cardNome: cardNome,
              cardCPF: cardCPF,
              cardNasc: cardNasc,
              cardFoneArea: $("#creditCardHolderAreaCode").val(),
              cardFoneNum: $("#creditCardHolderPhone").val(),
    
              valorTotal: $("#totalValue").val(),
              descricao: $("#descricao").val(),
              numParcelas: $("#installmentQuantity").val(),
              valorParcelas: $("#installmentValue").val(),
    
            },
            success: function(data) {
              if (data.error) {
                if (data.error.code == "53037") {
                  $("#creditCardPaymentButton").click();
                } else {
                  $("#modal-title").html("<font color='red'>Erro</font>");
    
                  $("#modal-body").html("");
                  $.each(data.error, function (index, value) {
                    if (value.code) {
                      tratarError(value.code);
                    } else {
                      tratarError(data.error.code)
                    }
                  })
                }
              } else {
                $.ajax({
                  type: 'POST',
                  url: 'getStatus',
                  cache: false,
                  data: {
                    id: data.code,
                  },
                  success: function(status) {
    
                    if (status == "7") {
                      $("#modal-title").html("<font color='red'>Erro</font>");    
                      $("#modal-body").html("Erro ao processar o seu pagamento.<br/> Não se preocupe pois esse valor <b>não será debitado de sua conta ou não constará em sua fatura</b><br /><br />Verifique se você possui limite suficiente para efetuar a transação e/ou tente um cartão diferente");
                    } else {
                      var email = $("#senderEmail").val();
                      var emailCompiled = email.replace(/@/gi, "66123403347");
                      window.location = "http://www.onmax.com.br/pagamento_efetuado/index/"+emailCompiled;
                      setTimeout(function () {
                        $("#modal-body").html("");
                        $("#modal-title").html("<font color='green'>Sucesso!</font>");    
                        $("#modal-body").html("Caso você não seja redirecionado para a nossa página de instruções, clique no botão abaixo.<br /><br /><a href='http://download.infoenem.com.br/pagamento_efetuado/'><center><button class='btn-success btn-block btn-lg'>Ir para a página de instruções</button></center></a>");
                      }, 1500);
                    }    
                  }
                });
              }    
              }    
          });         
          
        },
        error: function (response) {
          if (response.error) {
            $("#modal-title").html("<font color='red'>Erro</font>");
            $("#modal-body").html("");
            console.log(response.errors);
            $.each(response.errors, function (index, value) {
              console.log(index);
              tratarError(index);
            });
          }
        },
        complete: function (response) {

        }

      });
    }

function tratarError(id) {

  if($('#creditCardHolderName').val() == ''){
    $("#modal-body").append("<p>Informe o nome do titular do cartão</p>");
    $("#creditCardHolderName").css('border', '2px solid red');
  }

  if (id.charAt(0) == '2') id = id.substr(1);
  if (id == "53020" || id == '53021') {
    $("#modal-body").append("<p>Verifique telefone inserido</p>");
    $("#senderPhone").css('border', '2px solid red');

  } else if (id == "53010" || id == '53011' || id == '53012') {
    $("#modal-body").append("<p>Verifique o e-mail inserido</p>");
    $("#senderEmail").css('border', '2px solid red');

  } else if (id == "53017") {
    $("#modal-body").append("<p>Verifique o CPF inserido</p>");
    $("#senderCPF").css('border', '2px solid red');

  } else if (id == "53018" || id == "53019") {
    $("#modal-body").append("<p>Verifique o DDD inserido</p>");
    $("#senderAreaCode").css('border', '2px solid red');

  } else if (id == "53013" || id == '53014' || id == '53015') {
    $("#modal-body").append("<p>Verifique o nome inserido</p>");
    $("#senderName").css('border', '2px solid red');

  } else if (id == "53029" || id == '53030') {
    $("#modal-body").append("<p>Verifique o bairro inserido</p>");
    $("#shippingAddressDistrict").css('border', '2px solid red');

  } else if (id == "53022" || id == '53023') {
    $("#modal-body").append("<p>Verifique o CEP inserido</p>");
    $("#shippingAddressPostalCode").css('border', '2px solid red');

  } else if (id == "53024" || id == '53025') {
    $("#modal-body").append("<p>Verifique a rua inserido</p>");
    $("#shippingAddressStreet").css('border', '2px solid red');

  } else if (id == "53026" || id == '53027') {
    $("#modal-body").append("<p>Verifique o número inserido</p>");
    $("#shippingAddressNumber").css('border', '2px solid red');

  } else if (id == "53033" || id == '53034') {
    $("#modal-body").append("<p>Verifique o estado inserido</p>");
    $("#shippingAddressState").css('border', '2px solid red');

  } else if (id == "53031" || id == '53032') {
    $("#modal-body").append("<p>Verifique a cidade informada</p>");
    $("#shippingAddressCity").css('border', '2px solid red');

  } else if (id == '10001') {
    $("#modal-body").append("<p>Verifique o número do cartão inserido</p>");
    $("#cardNumber").css('border', '2px solid red');

  } else if (id == '10002' || id == '30405') {
    $("#modal-body").append("<p>Verifique a data de validade do cartão inserido</p>");
    $("#cardExpirationMonth").css('border', '2px solid red');
    $("#cardExpirationYear").css('border', '2px solid red');

  } else if (id == '10004') {
    $("#modal-body").append("Infome o código de segurança.");
    $("#cardCvv").css('border', '2px solid red');

  } else if (id == '10006' || id == '10003' || id == '53037') {
    $("#modal-body").append("<p>Verifique o código de segurança do cartão informado</p>");
    $("#cardCvv").css('border', '2px solid red');

  } else if (id == '30404') {
    $("#modal-body").append("<p>Ocorreu um erro. Atualize a página e tente novamente!</p>");

  } else if (id == '53047') {
    $("#modal-body").append("<p>Verifique a data de nascimento do titular do cartão informada</p>");
    $("#creditCardHolderBirthDate").css('border', '2px solid red');

  } else if (id == '53053' || id == '53054') {
    $("#modal-body").append("<p>Verifique o CEP inserido</p>");
    $("#billingAddressPostalCode").css('border', '2px solid red');

  } else if (id == '53055' || id == '53056') {
    $("#modal-body").append("<p>Verifique a rua inserido</p>");
    $("#billingAddressStreet").css('border', '2px solid red');

  } else if (id == '53042' || id == '53043' || id == '53044') {
    $("#modal-body").append("<p>Verifique o nome inserido</p>");
    $("#creditCardHolderName").css('border', '2px solid red');

  } else if (id == '53057' || id == '53058') {
    $("#modal-body").append("<p>Verifique o número inserido</p>");
    $("#billingAddressNumber").css('border', '2px solid red');

  } else if (id == '53062' || id == '53063') {
    $("#modal-body").append("<p>Verifique a cidade informada</p>");
    $("#billingAddressCity").css('border', '2px solid red');

  } else if (id == '53045' || id == '53046') {
    $("#modal-body").append("<p>Verifique o CPF inserido</p>");
    $("#creditCardHolderCPF").css('border', '2px solid red');

  } else if (id == '53060' || id == '53061') {
    $("#modal-body").append("<p>Verifique o bairro inserido</p>");
    $("#billingAddressDistrict").css('border', '2px solid red');

  } else if (id == '53064' || id == '53065') {
    $("#modal-body").append("<p>Verifique o estado inserido</p>");
    $("#billingAddressState").css('border', '2px solid red');

  } else if (id == '53051' || id == '53052') {
    $("#modal-body").append("<p>Verifique telefone inserido</p>");
    $("#billingAddressState").css('border', '2px solid red');

  } else if (id == '53049' || id == '53050') {
    $("#modal-body").append("<p>Verifique o código de área informado</p>");
    $("#creditCardHolderAreaCode").css('border', '2px solid red');

  } else if (id == '53122') {
    $("#modal-body").append("<p>Enquanto na sandbox do PagSeguro, o e-mail deve ter o domínio '@sandbox.pagseguro.com.br' (ex.: comprador@sandbox.pagseguro.com.br)</p>");

  }

  // else {
  //   $("#modal-body").append("<p>"+ id + "</p>");
  // }
}