<?php include 'view/frontend/header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Lista de Chamados</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item active">Suporte</li>
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
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#pendentes" data-toggle="tab">Pendentes</a></li>
                  <li class="nav-item"><a class="nav-link" href="#finalizados" data-toggle="tab">Finalizados</a></li>
                  <li class="nav-item ml-2"><a class="btn btn-outline-info" href="/suporte/abrir-chamado">Abrir Novo Chamado</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <!--TAB CADASTRO -->
                  <div class="active tab-pane" id="pendentes">
                  	<div class="card-body table-responsive p-0">
		                <table class="table table-striped table-valign-middle">
		                  <thead>
		                  <tr>
		                    <th>Código do Chamado</th>
		                    <th>Motivo do Chamado</th>
		                    <th>Tempo do Chamado</th>
		                    <th>Ver Chamado</th>
		                  </tr>
		                  </thead>
		                  <tbody>
		                  	<?php foreach ($chamados_abertos as $key => $value) {  ?>
			                  	<tr>
			                    <td>
			                      <?= $value['cod_chamado'] ?> <br>
			                      <span class="badge bg-<?= qualSituacao($value['situacao']) ?>"><?= textoSituacao($value['situacao']) ?></span>
			                      
			                    </td>
			                    <td><?= textoMotivo($value['motivo']) ?>
			                    	<?php if ($value['cod_questao'] != '0'){ echo '('.$value['cod_questao'].')'; } ?>
			                    </td>
			                    <td>
			                      <small class="mr-1">
			                       <?= $value['dt_chamado'] ?> <?= $value['hr_chamado'] ?>
			                      </small>
			                      
			                    </td>
			                    <td>
			                      <a href="/suporte/chamado/<?= $value['id_chamado']?>" class="btn btn-info">
			                        <i class="fas fa-search"></i>
			                        VER 
			                      </a>
			                      <a href="/suporte/<?= $value['id_chamado']?>/fechar" class="btn btn-danger" alt="Finalizar Chamado" title="Finalizar Chamado">
			                        <i class="fas fa-times"></i>
			                        
			                      </a>
			                    </td>
			                  </tr>
		              		<?php } ?>
		                  
		                  </tbody>
		                </table>
		              </div>
                  </div>
                  <!-- /.tab-pane-cadastro-->


                  <!--TAB ALTERAR A SENHA -->
                  <div class="tab-pane" id="finalizados">
                   	<div class="card-body table-responsive p-0">
		                <table class="table table-striped table-valign-middle">
		                  <thead>
		                  <tr>
		                    <th>Código do Chamado</th>
		                    <th>Motivo do Chamado</th>
		                    <th>Tempo do Chamado</th>
		                    <th>Ver Chamado</th>
		                  </tr>
		                  </thead>
		                  <tbody>
		                  <?php foreach ($chamados_fechados as $key => $value) {  ?>
			                  	<tr>
			                    <td>
			                      <?= $value['cod_chamado'] ?> <br>
			                      <span class="badge bg-<?= qualSituacao($value['situacao']) ?>"><?= textoSituacao($value['situacao']) ?></span>
			                      
			                    </td>
			                    <td><?= $value['motivo'] ?></td>
			                    <td>
			                      <small class="mr-1">
			                        <?= $value['dt_chamado'] ?> <?= $value['hr_chamado'] ?>
			                      </small>
			                      
			                    </td>
			                    <td>
			                      <a href="#" class="text-muted">
			                        <i class="fas fa-search"></i>
			                        VER CHAMADO
			                      </a>
			                     
			                    </td>
			                  </tr>
		              		<?php } ?>
		                  
		                  </tbody>
		                </table>
		              </div>
                  </div>
                  <!-- /.tab-pane-SENHA-->

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


     


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->

<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>