<?php include ("view/backend/header.php"); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Questões</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Listar Questões</li>
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
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Todas as Questões <small>Lista todos os usuários que podem operar o sistema</small></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Todas as questões do sistema</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Nº</th>
                      <th>Código</th>
                      <th>Pergunta</th>
                      <th>Disciplina</th>
                      <th>Ação</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php

                   foreach ($questoes as $key => $e) { 
                    
                  ?>
                    <tr>
                      <td><?php echo $key+1 ?></td>
                      <td><?php echo $e['codigo'] ?></td>
                      <td><?php echo $e['pergunta'] ?></td>
                      <td><?php echo $d->getTitulo($e['id_disciplina']) ?></td>
                      <td>
                        
                        <div class="btn-group">
                            <a href="/admin/questoes/editar/<?= $e['id_questao']?>" class="btn btn-default"><i class="fa fa-edit"></i> Editar</a>

                          
                            <a href="/admin/questoes/deletar/<?= $e['id_questao']?>" class="btn btn-danger" onclick="confirm('Tem certeza que deseja excluir o cadatro?');"><i class="fa fa-ban"></i> Excluir</a>
                          
                        

                        </div>
                      </td>
                    </tr>
                 <?php 
                  }//FIM DO FOR

                  ?>
                                 
                  <tfoot>
                    <tr>
                      <th>Nº</th>
                      <th>Código</th>
                      <th>Pergunta</th>
                      <th>Disciplina</th>
                      <th>Ação</th>
                    </tr>
                </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


                </div>
                <!-- /.card-body -->
                

                <div class="card-footer">
                 
                </div>

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
  </div>
  <!-- /.content-wrapper -->


<?php include ("view/backend/footer.php"); ?>
</body>
</html>