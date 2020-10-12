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
              <li class="breadcrumb-item active">Editar Usuários</li>
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

          <!-- ALERTA DE SUCESSO -->
          <?php if (isset($msgsucesso)){ ?>
          <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?php echo $msgsucesso; ?>
                      
          </div>
          <?php } ?>



<!-- INICIO DO CONTENT -->

      <div class="container-fluid">
           <form role="form" id="quickForm" action="" method="post" enctype="multipart">

        <div class="row">
          <!-- left column -->
          <div class="col-md-6">

            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Preencha os campos para alterar o usuário <small>Atenção ao dados requeridos</small></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <!-- INICIO DO CADASTRO -->
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" value="<?= $usuario['nome'] ?>">
                  </div>

                  <div class="form-group">
                    <label for="login">Escolha um Login para o sistema</label>
                    <input type="text" name="login" class="form-control" id="login" value="<?= $usuario['login'] ?>">
                  </div>

                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" value="<?= $usuario['email'] ?>">
                  </div>

                  <div class="form-group">
                    <label for="celular">Celular</label>
                    <input type="celular" name="celular" class="form-control" id="celular" value="<?= $usuario['celular'] ?>">
                  </div>

               </div>
                <!-- /.card-body -->
                <div class="card-footer">
                 
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Preencha os campos para inserir o usuário <small>Atenção ao dados requeridos</small></h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="funcao">Defina a Função deste Usuário</label>
                    <select name="funcao" class="form-control">
                      <option value="<?= $usuario['funcao'] ?>"><?= $usuario['funcao'] ?></option>
                      <option value="admin">Administrador</option>
                      <option value="op">Operador do Sistema</option>
                    </select>
                  </div>
                  
                  <div class="form-group">
                    <label for="Status">Status do Usuário</label>
                    <select name="status" class="form-control">
                      <option value="<?= $usuario['status'] ?>"><?= $usuario['status'] ?></option>
                      <option value="ATIVO">ATIVO</option>
                      <option value="INATIVO">INATIVO</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" value="cadastrar">Editar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
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