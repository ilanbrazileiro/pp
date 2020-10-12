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
              <li class="breadcrumb-item active">Listar Cursos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

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
                <h3 class="card-title">Todos os cursos são listados <small>Ainda não existem cursos desabilitados</small></h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <div class="card">
              <div class="card-header">
                <h3 class="card-title">Todos os Cursos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Nº</th>
                      <th>Título</th>
                      <th>Slug</th>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th>Ação</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php

                   foreach ($cursos as $key => $e) { 
                    
                  ?>
                    <tr>
                      <td><?= $key+1 ?></td>
                      <td><?= $e['titulo'] ?></td>
                      <td><?= $e['slug'] ?></td>
                      <td><?= $e['descricao'] ?></td>
                      <td><?= number_format($e['valor'], 2, ",", ".") ?></td>
                      <td><?= $e['situacao'] ?></td>
                      <td>
                        
                        <div class="btn-group">
                            <a href="/admin/cursos/editar/<?= $e['id_curso']?>" class="btn btn-default"><i class="fa fa-edit"></i> Editar</a>

                          
                            <a href="/admin/cursos/deletar/<?= $e['id_curso']?>" class="btn btn-danger" onclick="confirm('Tem certeza que deseja excluir o cadatro?');"><i class="fa fa-ban"></i> Excluir</a>
                          
                        

                        </div>
                      </td>
                    </tr>
                 <?php }//FIM DO FOR ?>
                                 
                  <tfoot>
                    <tr>
                      <th>Nº</th>
                      <th>Título</th>
                      <th>Slug</th>
                      <th>Descrição</th>
                      <th>Valor</th>
                      <th>Situação</th>
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