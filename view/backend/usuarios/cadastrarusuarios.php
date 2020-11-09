<?php include ("view/backend/header.php"); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usuários</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Cadastrar Usuários</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <!-- ALERTA DE ERRO -->
          <?php if (isset($msgfalha)){ ?>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i> Alerta! -  <?php echo $msgfalha; ?>
          </div>
          <?php } ?>

          <!-- ALERTA DE SUCESSO -->
          <?php if (isset($msgsucesso)){ ?>
          <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?php echo $msgsucesso; ?>
                      
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
                <h3 class="card-title">Preencha os campos para inserir o usuário <small>Atenção ao dados requeridos</small></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" action="/admin/usuarios/adicionar" method="post" enctype="multipart">
                <div class="card-body">
                  <input type="hidden" name="id_usuario" value="">
                  <!-- INICIO DO CADASTRO -->
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome">
                  </div>

                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Digite o e-mail">
                  </div>
                  <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
                  </div>
                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="text" name="celular" class="form-control" id="celular" placeholder="celular">
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" value="enviar">Enviar</button>
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

<!-- jquery-validation -->
<script src="/res/backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/res/backend/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="/res/backend/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/res/backend/dist/js/demo.js"></script>

<script type="text/javascript">
$(document).ready(function () {
  //$.validator.setDefaults({
    //submitHandler: function () {
      //alert( "Usuário enviado para cadastro" );
    //}
  //});
  $('#quickForm').validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      senha: {
        required: true,
        minlength: 5
      },
      nome: {
        required: true,
      },
      
    },
    messages: {
      email: {
        required: "Por favor entre com seu e-mail",
        email: "Este não é um e-mail válido"
      },
      senha: {
        required: "Digite um senha",
        minlength: "Sua senha deve conter pelo menos 5 caracteres"
      },
      nome: "Digite seu nome"
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
});
</script>

</body>
</html>