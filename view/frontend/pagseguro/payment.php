<?php include 'view/frontend/header.php' ?>

<style>
.button.alt.btn:hover, .button.alt.btn:focus {
    color: #fff!important;
}
</style>

<div class="content-header">

</div>
 
<!-- Main content -->
<div class="content">

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="product-content-right">
					
						<div id="customer_details" class="col2-set">
							<div class="row">
								<div class="col-md-12">

									<?php if ($msgError != '') { ?>
									<div class="alert alert-danger">
										<?= $msgError ?>
									</div>
                                    <?php } ?>
                                    
                                    <div id="alert-error" class="alert alert-danger hide">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <span class="msg">Error</span>
                                    </div>

                                    <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detalhes da Compra</h3>
        </div>

        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h3>Assinatura Premium</h3>
                <div class="post">
                  <p>
                    Tenha acesso liberado a todo o conteúdo e questões do Papirar.com.br
                    e tenha seu aprendizado de forma prática e dinâmica.  
                  </p>
                </div>
                <div class="post">
                  <p>
                    <small>Você terá acesso até <span id="data"><?= exibeData($pedido['dt_expira']) ?></span>  </small>
                  </p>
                  <p>
                    <small>Aceitamos cartões de crédito, débito online e boleto bancário</small>
                  </p>
                </div>
            </div>
            
            <div class="col-lg-2 pl-3 mr-9">
                  <label for="qtd">Qtd Dias</label>
                  <h3 class="form-control"><?= $order->getqtd() ?></h3>
            </div>

            <div class="col-lg-1">
            </div>
            
            <div class="col-lg-3">
              <h5 class="text-muted">Total:</h5>
              <h1><span id="valor">R$ <?= number_format($pedido['valor'],2,',','')?></span></h1>
            </div>

          </div>
        </div>


      </div><!-- /CARD -->

									<div class="woocommerce-billing-fields">
										<h3>Escolha a sua Forma de Pagamento</h3>

                                        <div id="loading" style="margin:10px 0;">
                                            <i class="fas fa-3x fa-sync-alt fa-spin"></i> Carregando métodos de pagamento...
                                        </div>

                                        <div id="payment-methods" class="hide">
                                            <!-- Nav tabs -->
                                            <ul id="tabs-methods" class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#tab-boleto" role="tab">Boleto</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#tab-debito" role="tab">Débito</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#tab-credito" role="tab">Cartão de Crédito</a>
                                                </li>
                                            </ul>
                                            
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div class="tab-pane" id="tab-boleto" role="tabpanel">

                                                    <form action="/payment/boleto" class="checkout" method="post" name="checkout" style="padding:10px;" id="form-boleto">

                                                        <div class="row">
                                                          <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="cpf_field">CPF:</label>
                                                                    <input type="text" required="required" id="cpf_field" name="cpf" class="form-control" value="<?= $clientes['cpf'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="nascimento_field">Data de nascimento:</label>
                                                                    <input type="date" required="required" id="nascimento_field" name="birth" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="telefone_field">Telefone:</label>
                                                                    <div class="row">
                                                                        <div class="col-4 inline-block">
                                                                            <input type="text" required="required" maxlength="2" minlength="2" placeholder="DDD" id="ddd_field" name="ddd" class="form-control" value="<?= $clientes['ddd'] ?>">
                                                                        </div>
                                                                        <div class="col-8 inline-block">
                                                                            <input type="text" required="required" maxlength="9" minlength="8" placeholder="Número" id="telefone_field" name="phone" class="form-control" value="<?= $clientes['celular'] ?>">
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group place-order">
                                                            <button type="submit" id="place_order_credit" name="woocommerce_checkout_place_order" class="btn btn-success"><i class="fa fa-refresh fa-spin fa-fw margin-bottom hide"></i>Continuar</button>
                                                            <span class="msgPagamento text-red">Aguarde o processamento do seu pedido!</span>
                                                        </div>

                                                        <div class="clear"></div>

                                                    </form>

                                                </div>
                                                <div class="tab-pane" id="tab-debito" role="tabpanel">

                                                    <form action="/payment/debit" class="checkout" method="post" name="checkout" style="padding:10px;" id="form-debit">

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="cpf_field">CPF:</label>
                                                                    <input type="text" required="required" id="cpf_field" name="cpf" class="form-control" value="<?= $clientes['cpf'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="nascimento_field">Data de nascimento:</label>
                                                                    <input type="date" required="required" id="nascimento_field" name="birth" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="telefone_field">Telefone:</label>
                                                                    <div class="row">
                                                                        <div class="col-4 inline-block">
                                                                            <input type="text" required="required" maxlength="2" minlength="2" placeholder="DDD" id="ddd_field" name="ddd" class="form-control" value="<?= $clientes['ddd'] ?>">
                                                                        </div>
                                                                        <div class="col-8 inline-block">
                                                                            <input type="text" required="required" maxlength="9" minlength="8" placeholder="Número" id="telefone_field" name="phone" class="form-control" value="<?= $clientes['celular'] ?>">
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <fieldset class="form-group row">
                                                            <div class="col-sm-10 contents"></div>
                                                        </fieldset>

                                                       <div class="form-group place-order">
                                                            <button type="submit" id="place_order_credit" name="woocommerce_checkout_place_order" class="btn btn-success"><i class="fa fa-refresh fa-spin fa-fw margin-bottom hide"></i>Continuar</button>
                                                        </div>

                                                        <div class="clear"></div>

                                                    </form>

                                                </div>
                                                <div class="tab-pane" id="tab-credito" role="tabpanel">

                                                    <form action="/payment/credit" class="checkout" method="post" name="checkout" style="padding:10px;" id="form-credit">

                                                        <input type="hidden" name="brand" id="brand_field">

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="cpf_field">CPF:</label>
                                                                    <input type="text" required="required" id="cpf_field" name="cpf" class="form-control" value="<?= $clientes['cpf'] ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="nascimento_field">Data de nascimento:</label>
                                                                    <input type="date" required="required" id="nascimento_field" name="birth" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="telefone_field">Telefone:</label>
                                                                    <div class="row">
                                                                        <div class="col-4 inline-block">
                                                                            <input type="text" required="required" maxlength="2" minlength="2" placeholder="DDD" id="ddd_field" name="ddd" class="form-control" value="<?= $clientes['ddd'] ?>">
                                                                        </div>
                                                                        <div class="col-8 inline-block">
                                                                            <input type="text" required="required" maxlength="9" minlength="8" placeholder="Número" id="telefone_field" name="phone" class="form-control" value="<?= $clientes['celular'] ?>">
                                                                        </div>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                    <div class="form-group validate-required">
                                                                        <label for="name_field">Nome impresso no cartão:</label>
                                                                        <input type="text" required="required" id="name_field" name="name" class="form-control">
                                                                    </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="number_field">Número do cartão:</label>
                                                                    <input type="text" required="required" id="number_field" name="number" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-2">
                                                                <div class="form-group validate-required">
                                                                    <label for="cvv_field">Código:</label>
                                                                    <input type="text" required="required" id="cvv_field" name="cvv" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-xs-6 col-sm-2">
                                                                <div class="form-group validate-required">
                                                                    <label for="month_name">Validade:</label>
                                                                    <select name="month" class="form-control" required="required">
                                                                        <option disabled="disabled" selected="selected" value="">Mês</option>
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4">4</option>
                                                                        <option value="5">5</option>
                                                                        <option value="6">6</option>
                                                                        <option value="7">7</option>
                                                                        <option value="8">8</option>
                                                                        <option value="9">9</option>
                                                                        <option value="10">10</option>
                                                                        <option value="11">11</option>
                                                                        <option value="12">12</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6 col-sm-2">
                                                                <div class="form-group validate-required">
                                                                    <label for="month_name">&nbsp;</label>
                                                                    <select name="year" class="form-control" required="required">
                                                                        <option disabled="disabled" selected="selected" value="">Ano</option>
                                                                        
                                                                        <?php foreach ($years as $value) {
                                                                            echo '<option value="'.$value.'">'.$value.'</option>';
                                                                        } ?>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="installments_qtd">
                                                            <input type="hidden" name="installments_value">
                                                            <input type="hidden" name="installments_total">
                                                            <div class="col-xs-12 col-sm-4">
                                                                <div class="form-group validate-required">
                                                                    <label for="installments_field">Parcelamento</label>
                                                                    <select name="installments" id="installments_field" class="form-control" required="required">
                                                                        <option disabled="disabled" selected="selected">Carregando...</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12">
                                                                <div class="form-group validate-required" style="margin-bottom:10px; display:inline-block;">
                                                                    <label for="month_name">Bandeiras aceitas</label>
                                                                    <div class="contents"></div>
                                                                </div>
                                                            </div>
                                                        </div>                                                            

                                                        <div class="form-group place-order">
                                                            <button type="submit" id="place_order_credit" name="woocommerce_checkout_place_order" class="btn btn-success"><i class="fa fa-refresh fa-spin fa-fw margin-bottom hide"></i>Continuar</button>
                                                        </div>

                                                        <div class="clear"></div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>

									</div>
								</div>
							</div>
						</div>
					
				</div>                

            </div>
        </div>
    </div>
</div>

   </div>
  <!-- /.content-wrapper -->

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->

<script type="text/javascript" src="/res/frontend/plugin/handlebar/handlebars-v4.7.6.js"></script> 
<script src="<?= $pagseguro['urlJS'] ?>"></script>
<script type="text/javascript" src="/res/extras/js/funcoes.js"></script> 

<script id="tpl-payment-debit" type="text/x-handlebars-template">
    <div class="form-check" style="padding: 10px;">
        <label class="form-check-label">
            <input class="form-check-input" type="radio" name="bank" value="{{value}}" checked>
            <img src="https://stc.pagseguro.uol.com.br/{{image}}" alt="{{value}}">
            {{text}}
        </label>
    </div>
</script>
<script id="tpl-payment-credit" type="text/x-handlebars-template">
    <img src="https://stc.pagseguro.uol.com.br/{{image}}" alt="{{name}}" style="float:left; margin-right:4px;">
</script>
<script id="tpl-installment-free" type="text/x-handlebars-template">
    <option>{{quantity}}x de R${{installmentAmount}} sem juros</option>
</script>
<script id="tpl-installment" type="text/x-handlebars-template">
    <option>{{quantity}}x de R${{installmentAmount}} com juros (R${{totalAmount}})</option>
</script>

<script type="text/javascript">
    //Session ID
      PagSeguroDirectPayment.setSessionId('<?= $pagseguro['id'] ?>');
            
      getPaymentMethods( <?= $pedido['valor'] ?> );

$(function () {
   
   $("#alert-error").hide();
   $(".msgPagamento").hide();

    //Get CreditCard Brand and check if is Internationl
      $("#number_field").on('change' ,function(){
        if ($("#number_field").val().length >= 6) {
            PagSeguroDirectPayment.getBrand({
                cardBin: $("#number_field").val().substring(0,6),
                success: function(response) { 
                        console.log(response);
                        $("#brand_field").val(response['brand']['name']);
                        $("#cvv_field").attr('size', response['brand']['cvvSize']);
                        getInstallments();
                },
                error: function(response) {
                    $("#alert-error span.msg").text('Bandeira do cartão não reconhecida!');
                    $("#alert-error").show();
                }
            })
        };
      });

      //Check installment
      $("#installmentCheck").click(function(){
        if($("#creditCardBrand").val() != '') {
            getInstallments();
        } else {
            alert("Uma bandeira deve estar selecionada");
        }
      });


/////////Evento para pagamento com DEBITO
$("#form-debit").on("submit", function(e){

       e.preventDefault();

        $("#form-debit [type=submit]").prop("disabled", "disabled");
        $("#form-debit .msgPagamento").show();

        if (!isValidCPF($("#form-debit [name=cpf]").val())) {
            $("#alert-error span.msg").text('Este número de CPF não é válido');
            $("#alert-error").show();
            return false;
        }

        var formData = $(this).serializeArray();

        var params = {};

        $.each(formData, function(index, field){

            params[field.name] = field.value;

        });

        PagSeguroDirectPayment.onSenderHashReady(function(response){

            if(response.status == 'error') {
                console.log(response.message);
                return false;
            }

            var hash = response.senderHash;

            params.hash = hash;

            $.post(
                "/payment/debito",
                $.param(params),
                function(r){

                    var response = JSON.parse(r);

                    if (response.success === true) {

                        window.location.href = "/payment/success/debit";

                    } else {

                        printError("Não foi possível efetuar o pagamento.");
                        
                    }

                }
            );

        });

    });

/////////Evento para pagamento com BOLETO
      $("#form-boleto").on("submit", function(e){

        e.preventDefault();

        $("#form-boleto [type=submit]").prop("disabled", "disabled");
        $("#form-boleto .msgPagamento").show();

        if (!isValidCPF($("#form-boleto [name=cpf]").val())) {
            $("#alert-error span.msg").text('Este número de CPF não é válido');
            $("#alert-error").show();
            return false;
        }

        var formData = $(this).serializeArray();

        var params = {};

        $.each(formData, function(index, field){

            params[field.name] = field.value;

        });

        PagSeguroDirectPayment.onSenderHashReady(function(response){

            if(response.status == 'error') {
                console.log(response.message);
                return false;
            }

            var hash = response.senderHash;

            params.hash = hash;

            $.post(
                "/payment/boleto",
                $.param(params),
                function(r){

                    var response = JSON.parse(r);

                    if (response.success === true) {

                        window.location.href = "/payment/success/boleto";

                    } else {

                         printError("Não foi possível efetuar o pagamento.");
                        
                    }

                }
            );

        });

    });

///////////////Evento para pagamento com CARTÃO DE CRÉDITO
      $("#form-credit").on("submit", function(e){

        e.preventDefault();

        if (!isValidCPF($("#form-credit [name=cpf]").val())) {
            $("#alert-error span.msg").text('Este número de CPF não é válido');
            $("#alert-error").show();
            return false;
        }

        $("[name=installments_qtd]").val($("#installments_field").find("option:selected").data("qtd"));
        $("[name=installments_value]").val($("#installments_field").find("option:selected").data("amount"));
        $("[name=installments_total]").val($("#installments_field").find("option:selected").data("totalamount"));

        $("#form-credit [type=submit]").attr("disabled", "disabled");

        var formData = $(this).serializeArray();

        var params = {};

        $.each(formData, function(index, field){

            params[field.name] = field.value;

        });

        PagSeguroDirectPayment.createCardToken({
            cardNumber: params.number,
            brand: params.brand,
            cvv: params.cvv,
            expirationMonth: params.month,
            expirationYear: params.year,
            success: function(response) {

                params.token = response.card.token;

                PagSeguroDirectPayment.onSenderHashReady(function(response){

                    if(response.status == 'error') {
                        console.log(response.message);
                        return false;
                    }

                    var hash = response.senderHash;

                    params.hash = hash;

                    $.post(
                        "/payment/credit",
                        $.param(params),
                        function(r){
                                                        
                            var response = JSON.parse(r);

                            if (response.success === true) {

                                window.location.href = "/payment/success";

                            } else {
                                printError(response);
                                 $("#form-credit [type=submit]").removeAttr("disabled");
                            }

                        }
                    );

                });
              

            },
            error: function(response) {
                printError(response);
                $("#form-credit [type=submit]").removeAttr("disabled");
            },
            complete: function(response) {
                
                $("#form-credit [type=submit]").removeAttr("disabled");
                    
            }
        });

    });

}); 

 
      
      function getInstallments(){
        var brand = $("#brand_field").val();
        PagSeguroDirectPayment.getInstallments({
            amount: parseFloat(<?= $pedido['valor'] ?>),
            brand: brand,
            maxInstallmentNoInterest: parseInt(<?= $pagseguro['maxInstallmentNoInterest'] ?>), //calculo de parcelas sem juros
            success: function(response) {
                var installments = response['installments'][brand];
                $("#installments_field").html('<option disabled="disabled"></option>');
                buildInstallmentSelect(installments);

            },
            error: function(response) {
                printError(response);
            }
        })
      }
      
      function buildInstallmentSelect(installments){

        var formatReal = { minimumFractionDigits: 2,
                                style: "currency",
                                currency: "BRL"
                         };

        $.each(installments, (function(key, value){
            $("#installments_field").append("<option value = "+ value['quantity'] +" data-qtd='"+ value['quantity'] +"' data-amount='"+ value['installmentAmount'] +"' data-totalamount='"+ value['totalAmount'] +"'>" + value['quantity'] + "x de " + value['installmentAmount'].toLocaleString("pt-BR", formatReal) + " - Total de " + value['totalAmount'].toLocaleString("pt-BR", formatReal) + "</option>");

        }))
      }

      function printError(error){
        
        var texto = '';

        $.each(error['errors'], (function(key, value){
            texto += "Foi retornado o código " + key + " com a mensagem: " + value;
        }));

        $("#alert-error span.msg").text(texto);
        $("#alert-error").show();        

      }
      
      function getPaymentMethods(valor){
        PagSeguroDirectPayment.getPaymentMethods({
            amount: parseFloat(valor),
            success: function(response) {

                var tplDebit = Handlebars.compile($("#tpl-payment-debit").html());
                var tplCredit = Handlebars.compile($("#tpl-payment-credit").html());

                
                $.each(response.paymentMethods.ONLINE_DEBIT.options, function(index, option){

                    $("#tab-debito .contents").append(tplDebit({
                        value: option.name,
                        image: option.images.MEDIUM.path,
                        text: option.displayName
                    }));
                    

                });

                $.each(response.paymentMethods.CREDIT_CARD.options, function(index, option){

                    $("#tab-credito .contents").append(tplCredit({
                        name: option.name,
                        image: option.images.MEDIUM.path
                    }));

                });
                

                $("#loading").hide();

                $("#tabs-methods .nav-link:last").tab('show');
                
                $("#payment-methods").show();

            },
            error: function(response) {
                printError(response);
            }
        })
      }



</script>

<!-- FIM DOS JAVASCRIPTS-->

</body>
</html>