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

            <div class="col-lg-7">
              <h3>Assinatura por mês</h3>
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
            
            <div class="col-lg-1 pl-3 mr-9">
                  <label for="qtd">Qtd</label>
                  <input type="number" name="qtd" class="form-control" min="1" id="qtd" value="1">

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
    </div><!-- /CONTAINER -->
    </section>

 </div>
  <!-- /.content-wrapper -->

   

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->
<script type="text/javascript">
  
  $('#qtd').on('change', function(){
    if ($('#qtd').val() > 0){
      var qtd = $('#qtd').val();
      var valor = $('#qtd').val() * 30.00;
      var valorFormatado = valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
      $('#valor').html(valorFormatado); 
      //var data = 
      <?php $qtd = ?>qtd;
      <?php echo $qtd ?>  //echo date('d/m/Y', strtotime("+$qtd month")); 
      
       $('#data').html(qtd);
    } else {
      $('#qtd').val(1);
    }
  });

</script>

</body>
</html>