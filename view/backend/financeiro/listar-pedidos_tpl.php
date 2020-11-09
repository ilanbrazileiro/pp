<?php include ("view/backend/header.php"); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pedidos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Listar Pedidos</li>
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
                <h3 class="card-title">Pedidos </h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <div class="card">
              
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                      <th>Nº</th>
                      <th>Data / Hora</th>
                      <th>Id - Nome</th>
                      <th>Expiração</th>
                      <th>Valor</th>
                      <th>Situação</th>
                      <th>Ação</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php
                  
                   foreach ($pedidos as $key => $e) { 
                    
                  ?>
                    <tr>
                      <td><?= $key+1 ?></td>
                      <td><?= exibeData($e['dt_pedido']) .' '. $e['hr_pedido'] ?></td>
                      <td><?= $e['id_cliente'] .' - '.$e['nome']  ?></td>
                      <td><?= exibeData($e['dt_expira']) ?></td>
                      <td><?= bancoParaMoeda($e['valor']) ?></td>
                      <td><?= getSituacao($e['id_situacao']) ?></td>
                      <td>
                       <div class="btn-group">
                            <a href="" class="btn btn-default"><i class="fa fa-eyes"></i> Detalhes</a>
                       </div>
                      </td>
                    </tr>
                 <?php 
                  }//FIM DO FOR

                  ?>
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