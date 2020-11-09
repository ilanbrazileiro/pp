<?php include 'view/frontend/header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Carrinho</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item active">Carrinho</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
 
  <!-- Main content -->
    <section class="content">
      <div class="container">

        <div id="alert-error" class="alert alert-danger hide">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <span class="msg">Error</span>
        </div>

        <form action="/carrinho" method="post" name="carrinho" id="carrinho">
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detalhes do carrinho</h3>
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
                  <input type="hidden" name="data_expira" value="<?= $data ?>" id="data_expira">
                  <p>
                    <small>Você terá acesso até <span id="data"><?= $data ?></span>  </small>
                  </p>
                  <p>
                    <small>Aceitamos cartões de crédito, débito online e boleto bancário</small>
                  </p>
                </div>
            </div>
            
            <div class="col-lg-2 pl-3 mr-9">
                  <label for="qtd">Qtd Dias</label>
                  <input type="number" name="qtd" class="form-control" min="30" id="qtd" value="30" step="30">
            </div>

            <div class="col-lg-1">
            </div>
            
            <div class="col-lg-3">
              <h5 class="text-muted">Total:</h5>
              <h1><span id="valor">R$ 30,00</span></h1>
              <input type="hidden" name="valor_total" id="valor_total" value="30.00">
              <button type="submit" class="btn btn-block btn-danger btn-flat pt-3 pb-3">Efetuar Pagamento</button>

            </div>

          </div>
        </div>


      </div><!-- /CARD -->
      
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Confirme seus dados <small>Precisamos de todos esses dados preenchidos para efetuarmos o seu pagamento!</small></h3>

        </div>

        <div class="card-body">
                    
             <div class="form-group">
                <div class="row">
                  <div class="col-sm-5">
                    <label for="nome">Nome <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="nome" value="<?= $cliente->getnome(); ?>" readonly >
                    <input type="hidden" name="email" value="<?= $cliente->getemail(); ?>">
                  </div>
                  <div class="col-sm-3">
                    <label for="cpf">CPF <?= (validaCPF($clientes['cpf']))? '<span class="text-red">*</span>': '' ?></label>
                    <input type="text" class="form-control" name="cpf" value="<?= $clientes['cpf']; ?>" 
                    <?= (validaCPF($clientes['cpf']))? 'disable': '' ?> id="cpf_form"><span id="cpf_val" class="text-red"></span>
                  </div>
                  <div class="col-sm-1">
                    <label for="ddd">DDD </label>
                    <input type="text" class="form-control" name="ddd" value="<?= $clientes['ddd']; ?>">
                  </div>
                  <div class="col-sm-3">
                    <label for="telefone">Telefone </label>
                    <input type="text" class="form-control" name="telefone" value="<?= $clientes['celular']; ?>">
                  </div>

                </div>
             </div>

                     <div class="dropdown-divider"></div>

                      <div class="form-group">
                        <h4>Endereço</h4>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <label for="cep">CEP </label>
                            <input type="text" class="form-control" name="cep" value="<?= $clientes['cep']; ?>">                            
                          </div>
                          <div class="col-sm-8">
                            <label for="logradouro">Logradouro </label>
                            <input type="text" class="form-control" name="logradouro" value="<?= $clientes['logradouro']; ?>"> 
                          </div>

                          <div class="col-sm-2">
                            <label for="numero">Número </label>
                            <input type="text" class="form-control" name="numero" value="<?= $clientes['numero']; ?>">
                          </div>
                        </div>

                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="complemento">Complemento </label>
                            <input type="text" class="form-control" name="complemento" value="<?= $clientes['complemento']; ?>"> 
                          </div>

                          <div class="col-sm-6">
                            <label for="bairro">Bairro </label>
                            <input type="text" class="form-control" name="bairro" value="<?= $clientes['bairro']; ?>">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="cidade">Cidade </label>
                            <input type="text" class="form-control" name="cidade" value="<?= $clientes['cidade']; ?>"> 
                          </div>

                          <div class="col-sm-3">
                            <label for="uf">Estado </label>
                            <input type="text" class="form-control" name="uf" value="<?= $clientes['uf']; ?>">
                          </div>

                          <div class="col-sm-3">
                            <label for="pais">País </label>
                            <input type="text" class="form-control" name="pais" value="<?= $clientes['pais']; ?>">
                          </div>
                        </div>
                      </div>

 
        </div>
        <div class="card-footer">
          <div class="col-lg-3 pull-rigth">
            <button type="submit" class="btn btn-block btn-danger btn-flat pt-3 pb-3">Efetuar Pagamento</button>
          </div>
        </div>

      </div><!-- /CARD -->

    </div><!-- /CONTAINER -->
    </section>

  </form><!-- FECHA O FORMULÁRIO CARRINHO -->
 </div>
  <!-- /.content-wrapper -->

   

 
<?php include 'view/frontend/footer.php' ?>
<script src="res/backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="res/backend/plugins/jquery-validation/additional-methods.min.js"></script>
<script type="text/javascript" src="/res/extras/js/funcoes.js"></script>
<script src="/res/backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

<!-- JAVA ENTRA AQUI-->
<script type="text/javascript">

  $("#alert-error").hide();

  $('[name=cep]').inputmask({
    mask: ['99999-999'],
    keepStatic: true
  });
  $('[name=cpf]').inputmask({
    mask: ['999.999.999-99'],
    keepStatic: true
  });
  $('[name=telefone]').inputmask({
    mask: ['99999-9999'],
    keepStatic: true
  });

jQuery.validator.addMethod("cpf", function(value, element) {
   value = jQuery.trim(value);
   var retorno = isValidCPF(value);

   return this.optional(element) || retorno;

}, "Informe um CPF válido");

  //Validação do Formulário
  $('#carrinho').validate({
    rules: {
      cpf: {cpf: true, required: true},
      cep: {required: true, minlength: 8},
      logradouro: {required: true },
      bairro: {required: true },
      cidade: {required: true },
      uf: {required: true },
      pais: {required: true },
    },
    messages: {
      cpf: {
        cpf:'Informe um CPF inválido',
        required:'Informe um CPF'
      },
      cep: {
        required: "Informe um CEP",
        minlength: "Por favor informe um CEP válido"
      },
      logradouro: "Por favor informe um logradouro",
      bairro: "Por favor informe um bairro",
      cidade: "Por favor informe uma cidade",
      uf: "Por favor informe um estado",
      pais: "Por favor informe um país",
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });


  $('#qtd').on('change', function(){
    if ($('#qtd').val() > 0){
      var qtd = $('#qtd').val()/30;
      var data = new Date();
      var valor = ($('#qtd').val()/30) * 30.00;
      var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      $('#valor').html(valorFormatado); 
      data.setMonth(data.getMonth() + qtd);
      $('#data').html(adicionarDiasData(qtd));
      $('#data_expira').val(adicionarDiasData(qtd));
      $('#valor_total').val(valor);
    } else {
      $('#qtd').val(1);
    }
  });

  function adicionarDiasData(dias){
    var hoje        = new Date();
    var dataVenc    = new Date(hoje.getTime() + (30 * dias * 24 * 60 * 60 * 1000));
    return dataVenc.getDate() + "/" + (dataVenc.getMonth() + 1) + "/" + dataVenc.getFullYear();
  }

  // Limpa valores do formulário de cep.
function limpa_formulario_cep() {
    $("[name=logradouro]").val("");
    $("[name=bairro]").val("");
    $("[name=cidade]").val("");
    $("[name=uf]").val("");
    $("[name=pais]").val("");
}


$("[name=cep]").blur(function() {
    var cep = $(this).val().replace(/\D/g, '');

  //Verifica se campo cep possui valor informado.
  if (cep != "") {

  //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;

    //Valida o formato do CEP.
    if(validacep.test(cep)) {

      //Preenche os campos com "..." enquanto consulta webservice.
      $("[name=logradouro]").val("...");
      $("[name=bairro]").val("...");
      $("[name=cidade]").val("...");
      $("[name=uf]").val("...");
      $("[name=pais]").val("...");
      
      //Consulta o webservice viacep.com.br/
      $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

          if (!("erro" in dados)) {
             //Atualiza os campos com os valores da consulta.
              $("[name=logradouro]").val(dados.logradouro.toUpperCase());
              $("[name=bairro]").val(dados.bairro.toUpperCase());
              $("[name=cidade]").val(dados.localidade.toUpperCase());
              $("[name=uf]").val(dados.uf.toUpperCase());
              $("[name=pais]").val('Brasil');
            
          } //end if.
          else {
              //CEP pesquisado não foi encontrado.
              limpa_formulario_cep();
              printError("CEP não encontrado.");
          }
      });
    } //end if.
    else {
        //cep é inválido.
        limpa_formulario_cep();
        printError("Formato de CEP inválido.");
    }
  } //end if.
  else {
      //cep sem valor, limpa formulário.
      limpa_formulario_cep();
  }


});

function printError(error){
        
  $("#alert-error span.msg").text(error);
  $("#alert-error").show();        

}

</script>

</body>
</html>