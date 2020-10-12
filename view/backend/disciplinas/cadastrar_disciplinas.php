<?php include ("view/backend/header.php"); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Disciplina</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Cadastrar Disciplina</li>
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
                <h3 class="card-title">Cadastrar Disciplina <small>Atenção ao dados requeridos</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" action="" method="post" enctype="multipart">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="titulo">Título da Disciplina</label>
                    <input type="text" name="titulo" class="form-control" placeholder="Digite umm titulo para o Curso">
                  </div>

                  <div class="form-group">
                    <label for="slug">Slug da Disciplina</label>
                    <input type="text" name="slug" class="form-control" placeholder="Digite o titulo sem espaços">
                  </div>

                  <div class="form-group">
                    <label for="descricao">Descrição do Curso</label>
                    <textarea class="textarea" name="descricao"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="cursos">Cursos disponíveis para a Disciplina</label>
                      <div class='checkbox-inline'>
                          <label>
                            <?php foreach ($cursos as $value) {
                              echo "<input type='checkbox' value='".$value['id_curso']."' name='cursos[]'> ".$value['titulo']."&nbsp;&nbsp;|&nbsp;&nbsp;";
                            } ?>
                          </label>
                      </div>
                  </div>
                  

              </div>

                  
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cadastrar</button>
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

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

</body>
</html>