 <?php include 'header.php' ?>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Bem Vindo <small><?= $cliente->getnome(); ?></small>,</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Início</a></li>
              <li class="breadcrumb-item active">Painel Inicial</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
    <div class="content">
      <div class="container">
        
        <!-- ALERTA DE ERRO -->
          <?php if (isset($msgfalha)){ ?>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i> Alerta! -  <?php echo $msgfalha; ?>
          </div>
          <?php } ?>

          <?php if ($msgVerificaEmail !== false){ ?>
          <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-ban"></i> Alerta! -  <?php echo $msgVerificaEmail; ?>
          </div>
          <?php } ?>

          <!-- ALERTA DE SUCESSO -->
          <?php if (isset($msgSucesso) && $msgSucesso != ''){ ?>
          <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?= $msgSucesso; ?>                      
          </div>
          <?php } ?>


        <!-- INFORMAÇÕES SOBRE DESEMPENHO-->
        <div class="row">


          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-chart-pie"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Questões respondidas</span>
                <span class="info-box-number">
                  <?= $estatistica['respondidas']; ?>
                  
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Certas</span>
                <span class="info-box-number"><?= $estatistica['certas']; ?> <small>%</small></span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Erradas</span>
                <span class="info-box-number"><?= $estatistica['erradas']; ?> <small>%</small></span>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            
              	<button class="btn btn-app" data-toggle="modal" data-target="#zerar_estatisticas">
                  <i class="fas fa-redo-alt"></i> Zerar
                </button>
                <a class="btn btn-app">
                  <i class="fas fa-eye"></i> Ver detalhes
                </a>
              <!-- /.info-box-content -->
       
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row">

          <div class="col-lg-8">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"> <i class="fas fa-filter"></i> Comece filtrando as questões desejadas</h5>
              </div>
              <div class="card-body">
              <div class="row">
              	<div class="col-lg-6">
              		<form action="/inicio" method="post" name="filtro" id="filtro">
              		<!-- ESCOLHA DOS Disciplinas-->
			        <div class="form-group">
			            <label for="id_disciplina">Escolha as disciplinas desejadas</label>
			              <select class="form-control select2" multiple="multiple" name="id_disciplina[]" id="id_disciplina">
			              </select>
	              	</div>
              	</div>
              	<div class="col-lg-6">
	              	<!-- ESCOLHA DOS Curso/Concurso-->
			        <div class="form-group">
			            <label for="id_curso">Escolha o Curso/Concurso desejado</label>
			              <select class="form-control select2" multiple="multiple" name="id_curso[]" id="id_curso">
			              </select>
	              	</div>
	            </div>

	            <div class="col-lg-6">
	            	<!-- ESCOLHA Da Instituição-->
			        <div class="form-group">
			            <label for="instituicao">Escolha a Instituição desejada</label>
			              <select class="form-control select2" multiple="multiple" name="instituicao[]" id="instituicao">
			              </select>
	              	</div>
	            </div>

	        <?php if (isset($qtd_encontradas) && $qtd_encontradas != ''){?>
	            <div class="col-lg-6">
	            	<!-- ESCOLHA Da Instituição-->
			        <div class="form-group">
			    		<h2 class="text-center">
			    			<span class="badge badge-<?= ($qtd_encontradas == 0)? 'danger' : 'success' ?>"><?= $qtd_encontradas ?></span> 
			    		</h2>
			    		<div class="text-center">
			    			<small> Questões encontradas</small>
			    		</div>
	              	</div>
	            </div>


	          </div>
               <button type="submit" class="btn btn-info" value="buscar" name="btn_buscar">
                  Buscar
                </button>
               <a href="/questoes" class="btn bg-gradient-danger" value="responder" name="btn_responder">
                  Responder
               </a>


        	<?php } else { ?>

              </div>
               <button type="submit" class="btn btn-info" value="buscar" name="btn_buscar">
                  Buscar as questões
                </button>
            <?php } ?>
             </form>
            <?php if (isset($qtd_encontradas) && $qtd_encontradas == 0){ ?>
            	<small class="text-red">Não foram encontradas questões para esses filtros, por favor tente novamente!</small>  
        	<?php } ?>

              </div>
            </div>

            
        </div>

          <div class="col-lg-4">

            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0">Simulados</h5>
              </div>
              <div class="card-body">
                <h6 class="card-title">Comece a estudar agora!</h6>

                <p class="card-text">Aperte no botão baixo e inicie o seu simulado.</p>
                <a href="/simulados" class="btn btn-primary">Fazer Simulado</a>
              </div>
            </div>




            
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->


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
              <form action="/inicio" method="post">
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


      <!-- /MODALS -->


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Select2 -->
<link rel="stylesheet" href="res/backend/plugins/select2/css/select2.min.css">

  <?php include 'footer.php' ?>
<!-- OS JAVA SCRIPTS NECESSÁRIOS ENTRAM AQUI -->
<!-- Select2 -->
<script src="res/backend/plugins/select2/js/select2.full.min.js"></script>
<script src="res/backend/plugins/select2/js/i18n/pt-BR.js"></script>


<script type="text/javascript">

$(function () {
    //Initialize Select2 Elements
    $("#id_disciplina").select2({
        placeholder: "Digite a disciplina desejada",
        language: "pt-BR",
        data: <?= $disciplinas; ?>
  	});

  	$("#id_curso").select2({
        placeholder: "Digite o concurso ou curso desejado",
        language: "pt-BR",
        data: <?= $cursos; ?>
  	});

  	$("#instituicao").select2({
        minimumInputLength: 3,
        placeholder: "Digite a instituição desejada",
        language: "pt-BR",
        ajax: {
          url:"res/extras/ajax.php",
          dataType: 'json',
          type: "POST",
          delay: 250,
          data: function (params) {
              return {
                  s_instituicao: params.term, //search term
              };
          },
          processResults: function (data) {
              
              return {
                results: data
              };
          },
          cache:true
      }
  	});
});
</script>

<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>