<div style="background-color: #DDD;">
  <div class="container">

      <div class="row justify-content-xs-center" style="align-items: right; text-align: right; padding-top: 20px;">
        <div class="col-xs-6 text-right" style="align-content: right; text-align: right;"><img src="<?php echo base_url(); ?>_img/logo_onmaxfama.png" class="img-fluid img-responsive" style="float:right;"></div>
        <div class="col-xs-6" style=""><h2 style="text-align: left; padding-top: clamp(0.5px, 20px, 35px); font-size: min(max(16px, 2.5vw), 24px);"><strong>A partir de agora você faz parte<br/>do ON MAX</strong></h2></div>
      </div>

      <div class="clearfix"></div>

    <div class="col-md-12 m-3" style="align-items: center;">
      <div class="dotted_rosa"></div>

      <div class="col-md-4"><h1 style="text-align: right; padding-top: 2rem;"><strong>Sua Escolha</strong></h1></div>

      <?php if($this->plano == 'premium'){ ?>

        <div class="col-md-6 align-self-center" style="align-items: left; padding-top:2rem;">
          <div class="border-5 border-purple" style="border:solid 5px; border-radius:10px; border-color: #b974a1; padding:20px;">
            <div class="row">
              <div class="col-md-8">
                <span style="font-weight: 800; font-size: 3rem; line-height: 2rem;"><span style="color: #666; font-size: 1.7rem; font-weight: 300;">Agenciamento</span><br/>PREMIUM</span>
                <p>Ao se tornar <strong>Premium</strong> você garante todo o material instrucional para organização e realização do seu book e passará a fazer parte do casting da <strong>Max Fama</strong> pelo período de 6 meses, podendo ser selecionado pelas principais marcas de moda do mercado.</p></div>
                <div class="col-md-4" style="text-align: right;">
                  <h5><strong>6 meses</strong><br/>(Até 3X no cartão)</h5>
                  <h2><sup style="font-weight: 300; color: #666;">R$</sup> <strong style="font-size: 4rem;">299</strong><sup style="font-weight: 300; color: #666;">,00</sup></h2></div>
                
              </div>
            </div>
          </div>
        </div>

      <?php } else { ?>

        <div class="col-md-6 align-self-center" style="align-items: left; padding-top:2rem;">
          <div class="border-5 border-purple m-5" style="border:solid 5px; border-radius:10px; border-color: #b974a1; padding:20px; text-align: left;">
            <div class="row">
              <div class="col-md-8">
                <span style="font-weight: 800; font-size: 3rem; line-height: 2rem;"><span style="color: #666; font-size: 1.7rem; font-weight: 300;">Agenciamento</span><br/>DIAMANTE</span>
                <p>Ao se tornar <strong>Diamante</strong>, você garantirá todo o material instrucional para organização e produção do seu book, e passará a fazer parte do casting da <strong>Max Fama</strong> pelo período de 12 meses. Com o dobro de oportunidades para ser escolhido pelas principais marcas de moda do mercado.</p></div>
                <div class="col-md-4" style="text-align: right;">
                  <h5><strong>12 meses</strong><br/>(Economize R$ 99,00)</h5>
                  <h2><sup style="font-weight: 300; color: #666;">R$</sup> <strong style="font-size: 4rem;">499</strong><sup style="font-weight: 300; color: #666;">,00</sup></h2></div>
                
              </div>
            </div>
          </div>
        </div>

      <?php } ?>



      <div class="clearfix"></div>

      <div class="col-md-6">
          <p style="font-size:18px;color: #b35b96;font-weight:bold;margin-bottom:15px;margin-top:40px">Dados do Modelo</p>
          <div class="field" style="margin-top:5px;">
            <input class="form-control" type="text" name="senderEmail" id="senderEmail" required placeholder="E-mail *" autocomplete="off" />
          </div>
          <div class="field" style="margin-top:5px">
            <input class="form-control" type="text" name="senderName" id="senderName" required placeholder="Nome completo*" autocomplete="off" />
          </div>
          <div class="field" style="margin-top:5px">
            <input class="form-control" type="text" name="senderCPF" id="senderCPF" maxlength="14" required  placeholder="CPF (somente números)" autocomplete="off" />
          </div>
          <div class="field">
              <div class="col-xs-4" style="padding-left:0; margin-top:5px">
                <input class="form-control areaCode" type="text" name="senderAreaCode" id="senderAreaCode" maxlength="2" required  placeholder="DDD" autocomplete="off" />
              </div>
              <div class="col-xs-8"  style="padding-right:0; margin-top:5px">
                <input class="form-control phone" type="text" name="senderPhone" id="senderPhone" maxlength="9" required  placeholder="Telefone" autocomplete="off" />
              </div>
          </div>
      
          <p style="font-size:18px;color: #b35b96; margin-bottom:15px; margin-top:40px">Endereço</p>

          <div class="field" style="margin-top: 5px;">
              <input class="form-control" type="text" name="shippingAddressPostalCode" id="shippingAddressPostalCode" maxlength="9" required placeholder="CEP" autocomplete="off" />
          </div>

          <div class="field" style="margin-top: 5px;" >
              <input class="form-control" type="text" name="shippingAddressStreet" id="shippingAddressStreet" required placeholder="Endereço" autocomplete="off" />
          </div>

          <div class="field" style="margin-top: 5px;" >
              <input class="form-control" type="text" name="shippingAddressNumber" id="shippingAddressNumber" size="5" required placeholder="Número" autocomplete="off" />  
          </div>

          <div class="field" style="margin-top: 5px;">
              <input class="form-control" type="text" name="shippingAddressComplement" id="shippingAddressComplement" placeholder="Complemento" autocomplete="off" />
          </div>

          <div class="field" style="margin-top: 5px;">
          <input class="form-control" type="text" name="shippingAddressDistrict" id="shippingAddressDistrict" required placeholder="Bairro" autocomplete="off" />
          </div>

          <div class="field" style="margin-top: 5px;">
              <input class="form-control" type="text" name="shippingAddressCity" id="shippingAddressCity" required placeholder="Cidade" autocomplete="off" />
          </div>

          <div class="field" style="margin-top: 5px;">
              <input class="form-control addressState" type="text" name="shippingAddressState" id="shippingAddressState" placeholder="Estado" maxlength="2" style="text-transform: uppercase;" onBlur="this.value=this.value.toUpperCase()" required />
          </div>    
      </div>

      <div class="col-md-6">
          <p style="font-size:18px;color: #b35b96; font-weight:bold; margin-bottom:15px; margin-top:40px">Pagamento</p>
       
               <div id="creditCardData" class="paymentMethodGroup" dataMethod="creditCard">

                <div id="cardData">                
                  <div class="col-md-6">
                    <div class="field" id="cardBrand" style="">
                      <input class="form-control" type="text" name="cardNumber" id="cardNumber" class="cardDatainput" placeholder="Número do cartão*" onblur="brandCard();" size="30" maxlength="19"  aria-describedby="cardNumberHelp" autocomplete="off" />
                      <small id="cardNumberHelp" class="form-text text-muted">Número do Cartão de Crédito</small>
                        <!--img class="bandeiraCartao" id="bandeiraCartao" />-->
                      </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <input class="form-control form-inline" type="text" name="cardExpirationMonth" id="cardExpirationMonth" maxlength="5" placeholder="mm/aaaa" aria-describedby="cardNumberHelp" autocomplete="off" />
                    <small id="cardExpirationMonthHelp" class="form-text text-muted">Data de Validade do Cartão</small>
                    </div>
                  </div>
                  <div class="col-md-12 input-nome-titulo-principal" style="margin-top:15px">
                    <input class="form-control form-inline" type="text" name="creditCardHolderName" id="creditCardHolderName" class="cardDatainput" placeholder="Nome do Titular (Como escrito no cartão)"  aria-describedby="creditCardHolderNameHelp" autocomplete="off" /></div>
                    <!--<small id="creditCardHolderNameHelp" class="form-text text-muted">Nome do Titular (Como escrito no Cartão)</small>-->
                  </div>
                  <div class="clearfix"></div>
                  <div style="margin-top:15px">
                    <div class="col-md-6">
                      <input class="form-control" type="text" name="cardCvv" id="cardCvv" maxlength="5" class="cardDatainput" size="3" placeholder="Código de segurança"  aria-describedby="cardCvvHelp" autocomplete="off" />
                      <small id="cardCvvHelp" class="form-text text-muted">Código de Segurança</small>
                    </div>
                    <div class="col-md-6">
                      <select class="form-control" name="installmentQuantity" id="installmentQuantity">
                        <option value="">Parcelas</option>
                      </select>
                      <input type="hidden" name="installmentValue" id="installmentValue" />
                    </div>
                  </div>
                  <div class="col-md-12 input-data-nascimento" style="margin-top:15px;">
                  <div class="field">
                  <input class="form-control" type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" maxlength="10" placeholder="Data de Nascimento do Titular do Cartão"  data-inputmask="'alias': 'date'" aria-describedby="creditCardHolderBirthDateHelp" autocomplete="off" />
                  <small id="creditCardHolderBirthDateHelp" class="form-text text-muted">Data de Nascimento do Titular do Cartão</small>
                </div>
                  </div>
                  <div class="clearfix"></div>
                  <div id="holderDataChoice" style="padding-top:15px; padding-bottom:30px;">
                    <div class="field radio">
                    <div class="col-md-12">
                      <input type="checkbox" name="holderType" id="otherHolder" value="otherHolder" style="margin-left:0;margin-top: 2px;" />
                      <label for="otherHolder" style="padding-left: 10px; display: initial;">Nome do titular do cartão é diferente do nome do modelo</label>
                    </div>
                    </div>
                  </div>
                  
                  <div id="dadosOtherPagador" class="dadosOtherPagador" style="margin-top: 5px;display:none;">
                    <div class="col-md-12">
                      <div class="field" style="margin-top: 5px;">                        
                        <input class="form-control" type="text" name="creditCardHolderNameOther" id="creditCardHolderNameOther" placeholder="Nome do Titular (Como escrito no cartão)"  aria-describedby="creditCardHolderNameOtherHelp" autocomplete="off" />
                        <small id="creditCardHolderNameOtherHelp" class="form-text text-muted">Nome do Titular (Como escrito no Cartão)</small>
                      </div>
                      <div style="margin-top:10px">
                      <div class="col-md-6" style="padding-left:0;">
                        <div class="field" id="CPFP" style="margin-top: 5px;">
                          <input class="form-control" type="text" name="creditCardHolderCPFOther" id="creditCardHolderCPFOther" maxlength="14" placeholder="CPF (somente números)*"  aria-describedby="creditCardHolderCPFOtherHelp" autocomplete="off" />
                          <small id="creditCardHolderCPFOtherHelp" class="form-text text-muted">CPF (somente números)*</small>
                        </div>
                      </div>
                      <div class="col-md-6" style="padding-right:0;">
                      <div class="field" id="CPFP" style="margin-top: 5px;">
                          <input class="form-control" type="text" name="creditCardHolderNascimentoOther" id="creditCardHolderNascimentoOther" maxlength="14" placeholder="Data de nascimento"  aria-describedby="creditCardHolderNascimentoOtherHelp" autocomplete="off" />
                          <small id="creditCardHolderNascimentoOtherHelp" class="form-text text-muted">Data de nascimento do Titular do Cartão</small>
                        </div>
                      </div>
                      </div>                    
                      <div class="clearfix"></div>
                      <div style="margin-top:10px;">                    
                      <div class="field" id="TelP">                      
                          <div class="col-sm-4" style="padding-left:0">
                            <input class="form-control" type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode" class="areaCode" maxlength="2" placeholder="DDD*" size="3"  aria-describedby="creditCardHolderAreaCodeHelp" autocomplete="off" />
                            <small id="creditCardHolderAreaCodeHelp" class="form-text text-muted">DDD*</small>
                          </div>
                          <div class="col-sm-8" style="padding-right:0">
                            <input class="form-control" type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" class="phone" maxlength="9" placeholder="Telefone*"  aria-describedby="creditCardHolderPhoneHelp" autocomplete="off" />
                            <small id="creditCardHolderPhoneHelp" class="form-text text-muted">Telefone*</small>
                          </div>
                      </div>
                      </div>
                      </div>
                  </div>

                </div>
              </div>
          </div>
      </div>

      

      <div id="aguarde" class="modal fade" role="dialog" style="display: none;">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title" id="modal-title" style="font-size:25px;"><font color="red" >Erro</font></h1>
            </div>
            <div class="modal-body" id="modal-body" style="font-size: 18px;"></div>

          </div>

        </div>
      
      </div>
      <div class="col-md-12 offset-6" style="margin-top: 5px;">
        <div id="modal-body" style="display:none;"></div>
          <input type="hidden" name="creditCardToken" id="creditCardToken"  />
          <input type="hidden" name="creditCardBrand" id="creditCardBrand"  />
          <?php if($this->plano == 'premium'){ ?>
            <input type="hidden" id="totalValue" name="valorTotal" value="2,99"> <!-- Troca do valor do serviço -->
            <input type="hidden" id="descricao" name="descricao" value="Agenciamento PREMIUM">
            <input type="hidden" id="plano" name="plano" value="premium">
          <?php } else { ?>
            <input type="hidden" id="totalValue" name="valorTotal" value="4,99"> <!-- Troca do valor do serviço -->
            <input type="hidden" id="descricao" name="descricao" value="Agenciamento DIAMANTE">
            <input type="hidden" id="plano" name="plano" value="diamante">
          <?php } ?>
          
          <center>
            <input class="form-control" type="button" id="creditCardPaymentButton" class="btn btn-default btn-block" onclick="pagarCartao(PagSeguroDirectPayment.getSenderHash());" value="INICIAR O AGENCIAMENTO" style="max-width:500px; padding: 1px 80px 3px 80px; border-radius: 50px; margin: 20px 0px 50px 0px; background-color: #b974a1; color: #fff; height:60px;" />
          </center>

        </div>


      </div>
      <div class="container">
        <div class="col-12" style="margin-top: 40px;">
          <center><img src="<?php echo base_url(); ?>_img/bandeiras-pgto.jpg" class="img-responsive" style="position:relative;" ></center>
        </div>
      </div>
      <div class="clearfix"></div>

  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/masking-input.js" data-autoinit="true"></script>

  </div>
      
</div>