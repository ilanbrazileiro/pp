<?php include 'view/frontend/header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Chamado <?= $chamado['cod_chamado'] ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item"><a href="/suporte">Suporte</a></li>
              <li class="breadcrumb-item active">Ver Chamado</li>
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
                           <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                              <div class="direct-chat-infos clearfix">
                                <span class="direct-chat-name float-right"><?= $cliente->getnome(); ?></span>
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
                          
                <?php   } else { ?>
                          <!-- Message. Default to the left -->
                          <div class="direct-chat-msg">
                            <div class="direct-chat-infos clearfix">
                              <span class="direct-chat-name float-left">Papirar.com.br</span>
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


     


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->

<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>