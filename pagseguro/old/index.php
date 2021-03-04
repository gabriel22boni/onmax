<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagseguro Transparente</title>	
</head>
<body>
<?php 

/* Informa o nível dos erros que serão exibidos */
error_reporting(E_ALL);

/* Habilita a exibição de erros */
ini_set("display_errors", 1); 

require "pagseguro/Checkout.class.php";

$checkout = new Checkout();
$URL_JS_PAGSEGURO = $checkout->pagSeguroData->getJavascriptURL();
var_dump($checkout->printSessionId());

header("access-control-allow-origin: ".$URL_JS_PAGSEGURO."");

?>

<script type="text/javascript" src="<?php echo $URL_JS_PAGSEGURO; ?>"></script>
<div class="container" id="tela-pagamento" style="padding-bottom: 50px; min-height: calc(100vh - 252px);">
	<div class="row">

			
		<div class="col-xs-12">

			<div class="groupData" id="buyerData">
				
				<div class="row">
					<div class="col-xs-12 col-md-6">

						<h2>Dados do comprador</h2>
						
						<!-- nome e email -->
						<div class="form-group clearfix required">
							<div class="col-md-6 input-senderEmail" style="padding-left: 0">
							<label for="senderEmail">E-MAIL</label>
								<input type="email" class="form-control " id="senderEmail" name="senderEmail" value="">
							</div>

							<div class="col-md-6 input-senderName" style="padding-left: 0">
								<label for="senderName">NOME COMPLETO</label>
								<input type="text" class="form-control " id="senderName" name="senderName" value="">
							</div>
						</div>

						<!-- cpf telefone -->
						<div class="form-group clearfix required">
							<div class="col-md-6 input-senderCPF" style="padding-left: 0">
								<label>CPF</label>
								<input type="text" class="form-control  maskCPF_PG" id="senderCPF" name="senderCPF" value="" holderField="cpf">
							</div>


							<div class="col-md-6 input-senderAreaCode" style="padding-left: 0">
								<label for="senderAreaCode">DDD - TELEFONE</label>
								<div>
									<input type="text" name="senderAreaCode" id="senderAreaCode" holderField="areaCode" class="form-control areaCode mask2Casas" style="width:40px; display:inline-block;  text-align:center" value="" /> - 
									<input type="text" name="senderPhone" value="" id="senderPhone" holderField="phone" class="form-control  maskTEL_PG" style="width:100px; display:inline-block;" /> 
								</div>
							</div>


						</div>
					</div>
					
					<div class="col-xs-12 col-md-6">

				
						<h2>Endere&ccedil;o Residencial</h2>
						
						<!-- endereco -->
						<div class="form-group clearfix required">
							<div class="col-md-3 col-lg-2 input-shippingAddressPostalCode" style="padding-left: 0">
								<label for="shippingAddressPostalCode">CEP</label>
								<input type="text" class="form-control  maskCEP_PG" id="shippingAddressPostalCode" name="shippingAddressPostalCode" value="" holderField="postalCode" >
							</div>


							<div class="col-md-4 col-lg-5 input-shippingAddressStreet" style="padding-left: 0">
								<label for="shippingAddressStreet">ENDEREÇO</label>
								<input type="text" class="form-control " id="shippingAddressStreet" name="shippingAddressStreet" value="" holderField="street" >
							</div>

							<div class="col-md-2 input-shippingAddressNumber" style="padding-left: 0">
								<label for="shippingAddressNumber">NÚMERO</label>
								<input type="text" class="form-control " id="shippingAddressNumber" name="shippingAddressNumber" value="" holderField="number" >
							</div>

							<div class="col-md-3 input-shippingAddressComplement " style="padding-left: 0">
								<label class="notrequired" for="shippingAddressComplement">COMPLEMENTO</label>
								<input type="text" class="form-control " id="shippingAddressComplement" name="shippingAddressComplement" value="" holderField="complement" >
							</div>
						</div>


						<div class="form-group clearfix required">

							<div class="col-md-4 input-shippingAddressDistrict" style="padding-left: 0">
								<label for="shippingAddressDistrict">BAIRRO</label>
								<input type="text" class="form-control " id="shippingAddressDistrict" name="shippingAddressDistrict" value="" holderField="district" >
							</div>

							<div class="col-md-4 input-shippingAddressCity" style="padding-left: 0">
								<label for="shippingAddressCity">CIDADE</label>
								<input type="text" class="form-control " id="shippingAddressCity" value="" name="shippingAddressCity" value="" holderField="city" >
							</div>


							<div class="col-md-4 input-shippingAddressState" style="padding-left: 0">
								<label>Estado</label>
								<select name="shippingAddressState" id="shippingAddressState" class="form-control  addressState" holderField="state"> 
									<option value="">Selecione o Estado</option> 
									<option value="ac">Acre</option> 
									<option value="al">Alagoas</option> 
									<option value="am">Amazonas</option> 
									<option value="ap">Amapá</option> 
									<option value="ba">Bahia</option> 
									<option value="ce">Ceará</option> 
									<option value="df">Distrito Federal</option> 
									<option value="es">Espírito Santo</option> 
									<option value="go">Goiás</option> 
									<option value="ma">Maranhão</option> 
									<option value="mt">Mato Grosso</option> 
									<option value="ms">Mato Grosso do Sul</option> 
									<option value="mg">Minas Gerais</option> 
									<option value="pa">Pará</option> 
									<option value="pb">Paraíba</option> 
									<option value="pr">Paraná</option> 
									<option value="pe">Pernambuco</option> 
									<option value="pi">Piauí</option> 
									<option value="rj">Rio de Janeiro</option> 
									<option value="rn">Rio Grande do Norte</option> 
									<option value="ro">Rondônia</option> 
									<option value="rs">Rio Grande do Sul</option> 
									<option value="rr">Roraima</option> 
									<option value="sc">Santa Catarina</option> 
									<option value="se">Sergipe</option> 
									<option value="sp">São Paulo</option> 
									<option value="to">Tocantins</option> 
								</select>
							</div>

						</div>
						
						<input type="hidden" name="shippingAddressCountry" id="shippingAddressCountry" holderField="country" value="Brasil" />
						
					</div>

				</div>
			</div>

			<div class="groupData" id="paymentMethods">
				<div style="padding-top:10px"></div>

				<h2>Meio de Pagamento</h2>

				<div id="paymentMethodsOptions">
					
					<div class="radio radio-info radio-inline">
						<input id="creditCardRadio" type="radio" name="changePaymentMethod" value="creditCard" />
						<label for="creditCardRadio">Cart&atilde;o de Cr&eacute;dito</label>
	                </div>
					
					<div id="paymentMethodLoading"></div>
					
				</div>
				
				<div id="creditCardData" class="paymentMethodGroup" dataMethod="creditCard">
					<div style="padding-top:15px"></div>
					
					<div id="cardData">

						<h2>Dados do Cart&atilde;o </h2>

						<div class="form-group clearfix required">
							<div class="col-md-4 input-cardNumber" style="padding-left: 0">
								<label for="cardNumber">N&uacute;mero</label>
								<input type="text" name="cardNumber" id="cardNumber" class="cardBrand form-control cardDatainput maskCARD" />
							</div>

							<div class="col-md-3 input-cardCvv" style="padding-left: 0">
								<label for="cardCvv">C&oacute;digo de Seguran&ccedil;a</label>
								<input type="text" name="cardCvv" id="cardCvv" placeholder="CVV" class="form-control maskCCV" style="width:90px;" />
							</div>

							
							<div class="col-md-3" style="padding-left: 0">
								<label for="cardExpirationMonth">Validade 00/0000</label>
								<div>
									<input type="text" name="cardExpirationMonth" id="cardExpirationMonth" placeholder="mês" class="form-control month mask2Casas" style="width:60px; display:inline-block" /> /
									<input type="text" name="cardExpirationYear" id="cardExpirationYear" placeholder="ano" class="form-control year mask4Casas" style="width:80px; display:inline-block" />
								</div>
							</div>
						</div>
						
					</div>
					
					<div class="clearfix"></div>

					

					<div class="col-md-6" style="padding-left: 0">
						<div class="field" id="installmentsWrapper">
							<label for="installmentQuantity">Parcelamento</label>
							<select name="installmentQuantity" class="form-control " id="installmentQuantity"></select>
							<input type="hidden" name="installmentValue" id="installmentValue" />
						</div>
					</div>

					<div class="clearfix"></div>
					
					<div style="padding-top:15px"></div>
					<h2>Dados do Titular do Cart&atilde;o</h2>
					
					<div id="holderDataChoice">
						
						<div class="radio radio-info radio-inline">
							<input id="sameHolder" type="radio" name="holderType" />
							<label for="sameHolder">mesmo que o comprador</label>
	                    </div>

	                    <div class="radio radio-info radio-inline">
							<input id="otherHolder" type="radio" name="holderType" />
							<label for="otherHolder">outro</label>
	                    </div>

						
					</div>
					
					<div id="holderData">
						<div style="padding-top:10px"></div>

						<div class="form-group clearfix required">
						
							<div class="col-md-6 input-creditCardHolderName" style="padding-left: 0">
								<label for="creditCardHolderName">Nome (Como est&aacute; impresso no cart&atilde;o)</label>
								<input type="text" class="form-control text-uppercase" name="creditCardHolderName" id="creditCardHolderName" holderField="name" />
							</div>

							<div class="col-md-4 input-creditCardHolderBirthDate" style="padding-left: 0">
								<label for="creditCardHolderBirthDate">Data de Nascimento (00/00/0000)</label>
								<input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" class="form-control maskNASC_PG" />
							</div>

						</div>

						<div class="form-group clearfix required dadosCobranca">
							
							<div class="col-md-6 input-creditCardHolderCPF" style="padding-left: 0">
								<label for="creditCardHolderCPF">CPF DO PORTADOR</label>
								<input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" class="form-control maskCPF_PG" holderField="cpf" />
							</div>
							
							<div class="col-md-6 input-creditCardHolderAreaCode" style="padding-left: 0">
								<label for="creditCardHolderAreaCode">DDD - TELEFONE</label>
								<div>
									<input type="text" name="creditCardHolderAreaCode" id="creditCardHolderAreaCode" holderField="areaCode" class="form-control areaCode mask2Casas" style="width:40px; display:inline-block" /> - 
									<input type="text" name="creditCardHolderPhone" id="creditCardHolderPhone" holderField="phone" class="form-control maskTEL_PG" style="width:120px; display:inline-block" /> 
								</div>
							</div>
						</div>


						<div class="clearfix"></div>

						<div class="dadosCobranca">
							<div style="padding-top:10px"></div>

							<h2>Endere&ccedil;o de Cobran&ccedil;a</h2>

							<!-- endereco -->
							<div class="form-group clearfix required">
								<div class="col-md-2 input-billingAddressPostalCode" style="padding-left: 0">
									<label for="billingAddressPostalCode">CEP</label>
									<input type="text" class="form-control  maskCEP_PG" id="billingAddressPostalCode" name="billingAddressPostalCode" value="" holderField="postalCode">
								</div>


								<div class="col-md-5 input-billingAddressStreet" style="padding-left: 0">
									<label for="billingAddressStreet">ENDEREÇO</label>
									<input type="text" class="form-control " id="billingAddressStreet" name="billingAddressStreet" value="" holderField="street" >
								</div>

								<div class="col-md-2 input-billingAddressNumber" style="padding-left: 0">
									<label for="billingAddressNumber">NÚMERO</label>
									<input type="text" class="form-control " id="billingAddressNumber" name="billingAddressNumber" value="" holderField="number" >
								</div>

								<div class="col-md-3 input-billingAddressComplement" style="padding-left: 0">
									<label class="notrequired" for="billingAddressComplement">COMPLEMENTO</label>
									<input type="text" class="form-control " id="billingAddressComplement" name="billingAddressComplement" value="" holderField="complement" >
								</div>
							</div>


							<div class="form-group clearfix required">

								<div class="col-md-4 input-billingAddressDistrict" style="padding-left: 0">
									<label for="billingAddressDistrict">BAIRRO</label>
									<input type="text" class="form-control " id="billingAddressDistrict" name="billingAddressDistrict" value="" holderField="district" >
								</div>

								<div class="col-md-4 input-billingAddressCity" style="padding-left: 0">
									<label for="billingAddressCity">CIDADE</label>
									<input type="text" class="form-control " id="billingAddressCity" name="billingAddressCity" value="" holderField="city" >
								</div>


								<div class="col-md-4 input-billingAddressState" style="padding-left: 0">
									<label>Estado</label>
									<select name="billingAddressState" id="billingAddressState" class="form-control  addressState" holderField="state"> 
										<option value="">Selecione o Estado</option> 
										<option value="ac">Acre</option> 
										<option value="al">Alagoas</option> 
										<option value="am">Amazonas</option> 
										<option value="ap">Amapá</option> 
										<option value="ba">Bahia</option> 
										<option value="ce">Ceará</option> 
										<option value="df">Distrito Federal</option> 
										<option value="es">Espírito Santo</option> 
										<option value="go">Goiás</option> 
										<option value="ma">Maranhão</option> 
										<option value="mt">Mato Grosso</option> 
										<option value="ms">Mato Grosso do Sul</option> 
										<option value="mg">Minas Gerais</option> 
										<option value="pa">Pará</option> 
										<option value="pb">Paraíba</option> 
										<option value="pr">Paraná</option> 
										<option value="pe">Pernambuco</option> 
										<option value="pi">Piauí</option> 
										<option value="rj">Rio de Janeiro</option> 
										<option value="rn">Rio Grande do Norte</option> 
										<option value="ro">Rondônia</option> 
										<option value="rs">Rio Grande do Sul</option> 
										<option value="rr">Roraima</option> 
										<option value="sc">Santa Catarina</option> 
										<option value="se">Sergipe</option> 
										<option value="sp">São Paulo</option> 
										<option value="to">Tocantins</option> 
									</select>
								</div>

							</div>
							
							<input type="hidden" name="billingAddressCountry" id="billingAddressCountry" holderField="country" value="Brasil" />
						</div>
						
					</div>
					
					<input type="hidden" name="creditCardToken" id="creditCardToken"  />
					<input type="hidden" name="creditCardBrand" id="creditCardBrand"  />

					<div  style="padding-top:10px" >
						<button type="button" id="creditCardPaymentButton" class="btn btn-success btn-send">Pagar <i class="fa fa-credit-card-alt"></i></button>
					</div>
					
				</div>
				
				<div id="eftData" class="paymentMethodGroup" dataMethod="eft">

					<ul style="padding:0; margin:0">
						<li dataBank="bancodobrasil" class="bank-flag bancodobrasil">Banco do Brasil</li>
						<li dataBank="bradesco" class="bank-flag bradesco">Bradesco</li>
						<li dataBank="itau" class="bank-flag itau">Itau</li>
						<li dataBank="banrisul" class="bank-flag banrisul">Banrisul</li>
						<li dataBank="hsbc" class="bank-flag hsbc">HSBC</li>
					</ul>
				</div>
				
				<div id="boletoData" class="paymentMethodGroup" dataMethod="boleto">
					<button type="button" id="boletoButton" class="btn btn-success btn-send">Gerar Boleto <i class="fa fa-barcode"></i></button>
				</div>
				
			</div>
		</div>

		<div class="clearfix"></div>
	</div>


	<div class="row" style="margin-top:15px;">
	<div class="col-xs-12 col-sm-6 text-left" style="padding-top:15px; border-top: 1px solid #e0e0e0;"><img src="assets/img/selos/selo01_300x60.gif" class="img-responsive" style="max-height:41px"></div>
	
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/pagseguro/helpers.js"></script>
<script type="text/javascript" src="assets/js/pagseguro/checkout.js"></script>
</body>
</html>