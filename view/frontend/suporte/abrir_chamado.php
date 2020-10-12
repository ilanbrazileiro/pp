<?php include 'view/frontend/header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Abrir Chamado</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item"><a href="/suporte">Suporte</a></li>
              <li class="breadcrumb-item active">Abrir Chamado</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
    <div class="content">
    	<div class="container">

    	<!-- ALERTA DE ERRO -->
          <?php if (isset($erro) && $erro != ''){ ?>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i> Alerta! -  <?= $erro; ?>
          </div>
          <?php } ?>

        <div class="row">

          <div class="col-md-12">
            <div class="card card-info card-outline">
              
              <div class="card-body">
                <form action="" method="post">


                <div class="form-group">
                  <label for="tipo">Qual o tipo de contato você deseja?</label>
                  <select name="tipo" class="form-control" id="tipo">
                  	<option value="0">---</option>
                  	<option value="financeiro">Contato com o setor Financeiro</option>
                  	<option value="questao">Falar sobre uma questão</option>
                  	<option value="duvida">Dúvidas / Críticas / Sugestão</option>
                  </select>
                </div>

                <div class="form-group" id="cod">
                  <label for="cod_questao">Informe o Código da questão.</label>
                  <input type="text" name="cod_questao" class="form-control" placeholder="Ex. Q0123654">
                </div>

                <div class="form-group">
                  <label for="conversa">Conversa</label>
                  <textarea class="form-control" name="conversa"></textarea>
                </div>

                <div class="form-group">
                  <button type="submit" name="enviar" class="btn btn-info">Enviar</button>                  
                </div>



                </form>
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


     


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->

<script>
  $(function () {
    // Summernote
    $('#cod').css('display', 'none');

    $('#tipo').on('change', function(){
    	if ($(this).val() == 'questao'){
    		$('#cod').css('display', 'block');
    	} else {
    		$('#cod').css('display', 'none');
    	}
    });

  })
</script>

<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>