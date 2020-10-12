<?php include 'view/frontend/header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Minha Conta</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item active">Minha Conta</li>
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
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="res/backend/dist/img/boxed-bg.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?= $cliente->getnome(); ?></h3>

                <p class="text-muted text-center">Assinante básico 
                  <small><a href="#">(Assine agora)</a></small>
                </p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Questões Respondidas</b> <a class="float-right"><?= $estatistica['respondidas']; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Porcentagem certas</b> <a class="float-right badge badge-success text-white"><?= $estatistica['certas']; ?> %</a>
                  </li>
                  <li class="list-group-item">
                    <b>Porcentagem erradas</b> <a class="float-right badge badge-danger text-white"><?= $estatistica['erradas']; ?> %</a>
                  </li>
                </ul>

                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#estatisticas">Ver estatísticas</button>
                <button class="btn btn-danger btn-block mt-1" data-toggle="modal" data-target="#zerar_estatisticas"><i class="fas fa-redo-alt"></i> Zerar Estatísticas</button>	
               
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Outras Informações</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Meus Cadernos</strong>

                <p class="text-muted">
                  Nenhum caderno adicionado
                </p>

               <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i> Simulados</strong>

                <p class="text-muted">
                 Nenhum Simulado respondido
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Minhas Questões</strong>

                <p class="text-muted">
                  Nenhuma questão respondida
                </p>
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
                  <li class="nav-item"><a class="nav-link active" href="#cadastro" data-toggle="tab">Cadastro</a></li>
                  <li class="nav-item"><a class="nav-link" href="#senha" data-toggle="tab">Alterar Senha</a></li>
                  <li class="nav-item"><a class="nav-link" href="#configuracoes" data-toggle="tab">Configurações</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

                <!--TAB CADASTRO -->
                  <div class="active tab-pane" id="cadastro">
                    <form role="form" name="cadastro" id="cadastro" method="post" action="/minha-conta">

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-9">
                            <label for="nome">Nome <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="nome" value="<?= $cliente->getnome(); ?>" disabled>
                          </div>
                          <div class="col-sm-3">
                            <label for="cpf">CPF <?= (validaCPF($cliente->getcpf()))? '<span class="text-red">*</span>': '' ?></label>
                            <input type="text" class="form-control" name="cpf" value="<?= $cliente->getcpf(); ?>" 
                            <?= (validaCPF($cliente->getcpf()))? 'disable': '' ?>>
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="email">E-mail <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="email" value="<?= $cliente->getemail(); ?>" disabled> 
                          </div>

                          <div class="col-sm-6">
                            <label for="telefone">Telefone </label>
                            <input type="text" class="form-control" name="telefone" value="<?= $cliente->getcelular(); ?>">
                          </div>
                        </div>
                      </div>

                      <div class="dropdown-divider"></div>

                      <div class="form-group">
                        <h4>Endereço</h4>
                      </div>
                      
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-2">
                            <label for="cep">CEP </label>
                            <input type="text" class="form-control" name="cep" value=""> 
                          </div>
                          <div class="col-sm-8">
                            <label for="logradouro">Logradouro </label>
                            <input type="text" class="form-control" name="logradouro" value=""> 
                          </div>

                          <div class="col-sm-2">
                            <label for="numero">Número </label>
                            <input type="text" class="form-control" name="numero" value="">
                          </div>
                        </div>

                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="complemento">Complemento </label>
                            <input type="text" class="form-control" name="complemento" value=""> 
                          </div>

                          <div class="col-sm-6">
                            <label for="bairro">Bairro </label>
                            <input type="text" class="form-control" name="bairro" value="">
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-8">
                            <label for="cidade">Cidade </label>
                            <input type="text" class="form-control" name="cidade" value=""> 
                          </div>

                          <div class="col-sm-4">
                            <label for="uf">Estado </label>
                            <input type="text" class="form-control" name="uf" value="">
                          </div>
                        </div>
                      </div>


                      <div class="form-group">
                        <p class="text-red">* Para alteração desses dados marcados, por favor, faça contato com a gente!</p>
                        <p>Todos os dados desse cadastro são importantes para que sejam efetuados os pagamentos!</p>
                      </div>
                                         
                      <div class="form-group ">
                          <button type="submit" class="btn btn-danger" name="alterar_cadastro">Alterar Cadastro</button>
                      </div>

                    </form>
                  </div>
                  <!-- /.tab-pane-cadastro-->

                 

                  <!--TAB ALTERAR A SENHA -->
                  <div class="tab-pane" id="senha">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="senha_atual" class="col-sm-2 col-form-label">Senha atual</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="senha_atual" name="senha_atual">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="senha_nova" class="col-sm-2 col-form-label">Nova Senha</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="senha_nova" name="senha_nova">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="confirma_senha" class="col-sm-2 col-form-label">Confirmar Senha</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirma_senha" name="confirma_senha">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger" value="alterar_senha">Alterar Senha</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane-SENHA-->


                  <!--TAB CONFIGURAÇÕES -->
                  <div class="tab-pane" id="configuracoes">
                    <p class="text-red">Em Breve!</p>
                  </div>
                  <!-- /.tab-pane-Configuração-->


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

   <!-- MODALS -->

        <div class="modal fade" id="zerar_estatisticas" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content text-center">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            	<h1 class="modal-title text-orange"><i class="fas fa-exclamation-triangle"></i></h1>
            	<br>
              <h5>Todas a sua estatística e histórico de respostas as questões será apagado!</h5>
              <br>
              <br>
              
              <p><b>Você tem certeza que deseja continuar?</b></p>
              <p class="text-red"><b>Essa ação não poderá ser revertida!</b></p>
              

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <form action="/minha-conta" method="post">
              	<button type="submit" class="btn btn-default" name="zerar">
                  Zerar estatísticas
              	</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- ESTATISTICAS -->
      <div class="modal fade" id="estatisticas" style="display: none;" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content text-center card-primary card-outline">
            <div class="modal-header">
            	 <h5><i class="fas fa-chart-pie"></i> Estatísticas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            	<div class="row">
                  <div class="col-md-8">
                    <div class="chart-responsive">
                      <canvas id="pieChart" height="150"></canvas>
                    </div>
                    <!-- ./chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <ul class="chart-legend clearfix">
                      <li><i class="far fa-circle text-danger"></i> % ERRADAS</li>
                      <li><i class="far fa-circle text-success"></i> % CERTAS</li>
                      
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->            

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              
              	<button class="btn btn-default" data-toggle="modal" data-target="#zerar_estatisticas">
                  Zerar estatísticas
              	</button>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


      <!-- /MODALS -->

 
<?php include 'view/frontend/footer.php' ?>
<!-- JAVA ENTRA AQUI-->
<!-- jQuery Mapael -->
<script src="/res/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="/res/backend/plugins/raphael/raphael.min.js"></script>
<script src="/res/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="/res/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="/res/backend/plugins/chart.js/Chart.min.js"></script>

<script type="text/javascript">
  
  $(function(){
  //-------------
  //- PIE CHART -
  //-------------
  // Get context with jQuery - using jQuery's .get() method.
    var canvas = $('#pieChart')
    var pieChartCanvas = canvas.get(0).getContext('2d')
    var pieData        = {
      labels: [
          '% CERTAS', 
          '% ERRADAS',
      ],
      datasets: [
        {
          data: [<?= $estatistica['certas']; ?>,<?= $estatistica['erradas']; ?>],
          backgroundColor : ['#00a65a','#f56954'],
        }
      ]
    }
    var pieOptions     = {
      legend: {
        display: false
      }
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
      type: 'doughnut',
      data: pieData,
      options: pieOptions      
    })

  //-----------------
  //- END PIE CHART -
  //-----------------

  });


</script>
<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>