<?php include ("view/backend/header.php"); ?>
<?php use Questoes\Model\Usuario; ?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><i class="icon fa fa-headset"></i> Chamado (<?= $chamado['cod_chamado']; ?>)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Ver Chamado</li>
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
          <?php if (isset($msgSucesso) && $msgSucesso != ''){ ?>
          <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?= $msgSucesso; ?>                      
          </div>
          <?php } ?>


      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <div class="card card-prirary cardutline direct-chat direct-chat-primary">
              <div class="card-header">
                
                  <h3 class="card-title"><i class="fas fa-ticket-alt"></i> <?= $chamado['cod_chamado'] ?></h3>
                <br>
                <h4 class="card-title"><?= textoMotivo($chamado['motivo']) ?></h4>
                <span class="badge bg-<?= qualSituacao($chamado['situacao']) ?> float-right"> <?= textoSituacao($chamado['situacao']) ?></span>

                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">

                <?php foreach ($conversas as $key => $value) {
                        if ($value['quem'] == 'CLIENTE'){
                ?>
                          <!-- Message. Default to the left -->
                          <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-name float-left"><?= $cliente['nome']; ?></span>
                              <span class="direct-chat-timestamp float-right"><?= exibeData($value['dt_conversa']) ?> <?= $value['hr_conversa'] ?></span>
                            </div>

                            <div class="direct-chat-img">
                              <i class="fas fa-user mr-2"></i>
                            </div>

                            <div class="direct-chat-text">
                              <?= $value['conversa'] ?>
                            </div>
                            <!-- /.direct-chat-text -->
                          </div>
                          <!-- /.direct-chat-msg -->
                          
                <?php   } else { ?>
                          <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                              <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right"><?= Usuario::getNomeUsuario($value['id_quem']); ?></span>
                                <span class="direct-chat-timestamp float-left"><?= exibeData($value['dt_conversa']) ?> <?= $value['hr_conversa'] ?></span>
                              </div>
                              <!-- /.direct-chat-infos -->
                              <img class="direct-chat-img" src="/res/backend/dist/img/boxed-bg.jpg" alt="Message User Image">
                              <!-- /.direct-chat-img -->
                              <div class="direct-chat-text">
                                <?= $value['conversa'] ?>
                              </div>
                              <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->                          
                <?php 
                        }//fim if
                      }// fim for
                 ?>
                               
               </div>
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <form action="#" method="post">
                  <div class="input-group">
                    <input type="text" name="conversa" placeholder="Digite sua mensagem ..." class="form-control">
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-primary">Enviar</button>
                    </span>
                  </div>
                </form>
              </div>
              <!-- /.card-footer-->
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php include ("view/backend/footer.php"); ?>
</body>
</html>