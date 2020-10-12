<?php include ("view/backend/header.php"); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cursos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Cadastrar Cursos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <!-- ALERTA DE ERRO -->
          <?php if (isset($erro) && $erro != ''){ ?>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i> Alerta! -  <?= $erro; ?>
          </div>
          <?php } ?>

         
<!-- INICIO DO CONTENT -->

      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Preencha todos os campos para Cadastrar a questão <small>Atenção ao dados requeridos</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" action="" method="post" enctype="multipart">
                <div class="card-body">

                  <div class="form-group">
                    <label for="situacao">Situação Curso</label>
                    <div class="col-md-3">
                      <select class="form-control" name="situacao">
                        
                        <option value="INATIVO">INATIVO</option>
                        <option value="ATIVO">ATIVO</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="titulo">Título do Curso</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Digite umm titulo para o Curso">
                  </div>

                  <div class="form-group">
                    <label for="slug">Slug do Curso</label>
                    <input type="text" name="slug" class="form-control" placeholder="Digite o titulo sem espaços">
                  </div>

                  <div class="form-group col-md-3">
                    <label for="valor">Valor Inicial do Curso</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                      </div>
                    <input type="text" name="valor" class="form-control" id="valor">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="descricao">Descrição do Curso</label>
                    <textarea class="textarea" name="descricao"></textarea>
                  </div>
                  

              </div>

                  
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php include ("view/backend/footer.php"); ?>

<script src="/res/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script src="/res/backend/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>


<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>


<script type="text/javascript">
$(document).ready(function () {
  $("#valor").inputmask('decimal', {
                'alias': 'numeric',
                'groupSeparator': '.',
                'autoGroup': true,
                'digits': 2,
                'radixPoint': ",",
                'digitsOptional': false,
                'allowMinus': false,
                'prefix': '',
                'placeholder': '0,00'
    });
});
</script>
</body>
</html>