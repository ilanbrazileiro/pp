 
<?php include ("view/backend/header.php"); ?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

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


        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Minha Conta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Minha conta</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="/res/backend/dist/img/user4-128x128.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $user->getnome(); ?></h3>

                <p class="text-muted text-center"><?= exibeFuncao($user->getfuncao()); ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Followers</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>

                <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#dados" data-toggle="tab">Meus Dados</a></li>
                  <li class="nav-item"><a class="nav-link" href="#senha" data-toggle="tab">Senha</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="dados">
                    <form class="form-horizontal" action="" method="post">
                      <div class="form-group row">
                        <label for="nome" class="col-sm-2 col-form-label">Nome</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nome" name="nome" value="<?= $user->getnome(); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="login" class="col-sm-2 col-form-label">Login</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="login" name="login" value="<?= $user->getlogin(); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $user->getemail(); ?>">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="celular" class="col-sm-2 col-form-label">Telefone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="celular" name="celular" value="<?= $user->getcelular(); ?>">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" value="alteraDados" name="btn">Alterar</button>
                        </div>
                      </div>
                    </form>
                  </div> 

                  <div class="tab-pane" id="senha">
                    <form class="form-horizontal" action="" method="post" id="form_senha">
                      <div class="form-group row">
                        <label for="senha_atual" class="col-sm-2 col-form-label">Senha Atual</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="senha_atual" placeholder="Senha Atual" name="senha_atual">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="nova_senha" class="col-sm-2 col-form-label">Nova Senha</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="nova_senha" placeholder="Nova Senha" name="nova_senha">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="confirma_senha" class="col-sm-2 col-form-label">Confirma Senha</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirma_senha" placeholder="Confirma Senha" name="confirma_senha">
                        </div>
                      </div>
                     
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" value="alteraSenha" name="btn">Alterar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <?php include ("view/backend/footer.php"); ?>

<!-- AdminLTE App -->
<script src="/res/backend/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/res/backend/dist/js/demo.js"></script>

<script src="/res/backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/res/backend/plugins/jquery-validation/additional-methods.min.js"></script>

<script type="text/javascript">
  

$(document).ready(function () {
  //$.validator.setDefaults({
  //  submitHandler: function () {
  //    alert( "Form successful submitted!" );
  //  }
  //});
  $('#form_senha').validate({
    rules: {
      senha_atual: {
        required: true,
      },
      nova_senha: {
        required: true,
        minlength: 6
      },
      confirma_senha: {
        required: true,
        minlength: 6,
        equalTo: "#nova_senha"
      },
    },
    messages: {
      senha_atual: {
        required: "Para alterar a senha você precisa preencher a Senha Atual",
      },
      nova_senha: {
        required: "Preenchar a Nova Senha para alterar",
        minlength: "Sua senha deve ter no mínimo 6 caracteres"
      },
      confirma_senha: {
        required: "Preencha a Confirmação de Senha para alterar",
        minlength: "Sua senha deve ter no mínimo 6 caracteres",
        equalTo: "As senhas não conferem, tente novamente!"
      },
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