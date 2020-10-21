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
                  <p>
                    <small>Você terá acesso até <span id="data"><?= $data ?></span>  </small>
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
              <button type="submit" class="btn btn-block btn-danger btn-flat pt-3 pb-3">Finalizar compra</button>

            </div>

          </div>
        </div>


      </div><!-- /CARD -->
      
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Confirme seus dados</h3>
        </div>

        <div class="card-body">
                    
             <div class="form-group">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="nome">Nome <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="nome" value="<?= $cliente->getnome(); ?>" disabled>
                  </div>
                  <div class="col-sm-3">
                    <label for="cpf">CPF <?= (validaCPF($cliente->getcpf()))? '<span class="text-red">*</span>': '' ?></label>
                    <input type="text" class="form-control" name="cpf" value="<?= $cliente->getcpf(); ?>" 
                    <?= (validaCPF($cliente->getcpf()))? 'disable': '' ?> id="cpf_form"><span id="cpf_val" class="text-red"></span>
                  </div>
                  <div class="col-sm-3">
                    <label for="telefone">Telefone </label>
                    <input type="text" class="form-control" name="telefone" value="<?= $cliente->getcelular(); ?>">
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
                            <input type="text" class="form-control" name="cep" value=""> 
                          </div>
                          <div class="col-sm-8">
                            <label for="logradouro">Logradouro </label>
                            <input type="text" class="form-control" name="logradouro" value=""> 
                          </div>

                          <div class="col-sm-2">
                            <label for="numero">Número </label>
                            <input type="text" class="form-control" name="numero" value="">
                          </div>
                        </div>

                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="complemento">Complemento </label>
                            <input type="text" class="form-control" name="complemento" value=""> 
                          </div>

                          <div class="col-sm-6">
                            <label for="bairro">Bairro </label>
                            <input type="text" class="form-control" name="bairro" value="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-8">
                            <label for="cidade">Cidade </label>
                            <input type="text" class="form-control" name="cidade" value=""> 
                          </div>

                          <div class="col-sm-4">
                            <label for="uf">Estado </label>
                            <input type="text" class="form-control" name="uf" value="">
                          </div>
                        </div>
                      </div>

 
        </div>
        <div class="card-footer">
          <div class="col-lg-3 pull-rigth">
            <button type="submit" class="btn btn-block btn-danger btn-flat pt-3 pb-3">Finalizar compra</button>
          </div>
        </div>

      </div><!-- /CARD -->

    </div><!-- /CONTAINER -->
    </section>

 </div>
  <!-- /.content-wrapper -->

   

 
<?php include 'view/frontend/footer.php' ?>
<script type="text/javascript" src="/res/extras/js/funcoes.js"></script> 

<!-- JAVA ENTRA AQUI-->
<script type="text/javascript">
  
  $('#qtd').on('change', function(){
    if ($('#qtd').val() > 0){
      var qtd = $('#qtd').val()/30;
      var data = new Date();
      var valor = ($('#qtd').val()/30) * 30.00;
      var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      $('#valor').html(valorFormatado); 
      data.setMonth(data.getMonth() + qtd);
      $('#data').html(adicionarDiasData(qtd));
    } else {
      $('#qtd').val(1);
    }
  });

  $("#cpf_form").on('keyup', function(){
    if (!isValidCPF($(this).val())) {
      $("#cpf_val").text('Este número de CPF não é válido');
      return false;
    } else {
      $("#cpf_val").text('CPF válido');
      $("#cpf_val").removeClass('text-red');
      $("#cpf_val").addClass('text-success');
    } 
  });

  function adicionarDiasData(dias){
    var hoje        = new Date();
    var dataVenc    = new Date(hoje.getTime() + (30 * dias * 24 * 60 * 60 * 1000));
    return dataVenc.getDate() + "/" + (dataVenc.getMonth() + 1) + "/" + dataVenc.getFullYear();
  }

</script>

</body>
</html>