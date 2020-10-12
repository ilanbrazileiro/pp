<?php include 'view/frontend/header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Bem Vindo <small><?= $cliente->getnome(); ?></small>,</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item active">Simulados</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
    <div class="content">
      <div class="container">

        
        <div class="row">

          <div class="col-lg-12">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"> </h5>
              </div>
              <div class="card-body">
                <h1 class="text-red">EM MANUTENÇÃO</h1>
                <a href="/inicio" class="btn btn-danger">Voltar para página inicial</a>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


     


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->

<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>