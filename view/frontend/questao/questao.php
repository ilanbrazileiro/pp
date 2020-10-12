 <?php include 'view/frontend/header.php' ?>

 <style type="text/css">

   .radio input[type=radio] {
    display:none; 
}

.radio input[type=radio] + label {
    display:inline-block;
    height:30px;
    width: 30px;
    line-height: 28px;
    text-align: center;
    background-color: #fff;
    color: #03a9f4;
    border-radius: 50%;
    border: 1px solid #03a9f4;
}

.radio input[type=radio]:checked + label {
    background-color: #03a9f4;
    color: #fff;
}
 
 .radio label {
    cursor: pointer;
}

.resposta{
  text-align: justify;
  align-items: center;
}

.pergunta{
	line-height: 2;
}

</style>
 
<!-- CABEÇALHO DO CONTEÚDO -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">

    </div>
    <!-- /.content-header -->

<!-- Main content -->
    <div class="content">
      <div class="container">

    <?php if (isset($msgErro)){ ?>
      <div class="alert alert-warning alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <i class="icon fas fa-exclamation-triangle"></i> 
         <?= $msgErro ?>
      </div>
 	<?php } ?>

      	<div class="row">
      		<div class="col-lg-12">
      			<div class="card">
      				<div class="card-header">
      					<h5 class="card-title"> Questão de <?= $disciplina['titulo']?> - <small><b>Código:</b> <?= $questao['codigo']?></small></h5>

              			<div class="card-tools">
		                  <a href="#" class="btn btn-tool" alt="Comentário da questão" title="Comentário da questão" data-toggle="modal" data-target="#modal-lg">
		                    <i class="fas fa-comment"></i> Comentário
		                  </a>

		                  <a href="#" class="btn btn-tool toastrDefaultError" alt="Adicionar ao caderno" title="Adicionar ao caderno" data-toggle="modal" data-target="#caderno">
		                    <i class="fas fa-book"></i> Adicionar ao Caderno
		                  </a>

		                  <div class="btn-group">
		                    <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
		                      <i class="fas fa-ellipsis-v"></i>
		                    </button>
		                    <div class="dropdown-menu dropdown-menu-right" role="menu" style="">
		                      <a href="#" class="dropdown-item"><i class="fas fa-bug"></i> Reportar um erro na questão</a>
		                      <a href="#" class="dropdown-item"><i class="fas fa-share-alt"></i> Compartilhar questão</a>
		                      
		                    </div>
	                  	  </div>
               		 	</div><!-- /FIM CARD-TOOLS-->
      				</div>
      				<div class="card-header">
      					<ul class="nav">
      						<li class="ml-1 mr-1"><small><b>Ano:</b> <?= $questao['ano']?></li></small>
	      					<li class="ml-1 mr-1"><small><b>Banca:</b> <?= $questao['banca']?></li></small>
	      					<li class="ml-1 mr-1"><small><b>Órgão:</b> <?= $questao['orgao']?></li></small>
	      					<li class="ml-1 mr-1"><small><b>Prova:</b> <?= $questao['prova']?></li></small>
      					</ul>
      				</div>
      			</div>
      		</div>
      		
      	</div>



        <div class="row">
          <div class="col-lg-12">

            <div class="card card-primary card-outline">
             
              <div class="card-body texto">
              
                <h6 class="card-title text-justify"> 
                	<div class="pergunta"><?= $questao['pergunta'] ?></div>
                </h6>

              <br><br><br>

                <div class="form-check radio ">
                	<div class="resposta" >
	                   <div style="float: left;"> 
	                      <i class="icon fa fa-cut ico" title="Cortar resposta"></i>
		                  <input class="form-check-input" type="radio" value="<?= $questao['id_resposta1'] ?>" name="resposta" id="resposta1">
		                  <label class="form-check-label-inline" for="resposta1">A </label>
		                </div>		
                   
             			<?= $questao['resposta1'] ?>
              		</div>
           
              	  <div style="clear: both;"></div>
                </div>

                <div class="form-check radio " >
                 <div class="resposta" >
                   <div style="float: left;"> 	
	                  <i class="icon fa fa-cut ico" title="Cortar resposta"></i>
	                  <input class="form-check-input" type="radio" value="<?= $questao['id_resposta2'] ?>" name="resposta" id="resposta2">
	                  <label class="form-check-label-inline" for="resposta2">B </label>
	               </div>
                  		<?= $questao['resposta2'] ?>
                  	
                  </div>
           
              	  <div style="clear: both;"></div>
                </div>

                <div class="form-check radio " >
                  <div class="resposta" >
                   <div style="float: left;"> 
		                  <i class="icon fa fa-cut ico" title="Cortar resposta"></i>
		                  <input class="form-check-input" type="radio" value="<?= $questao['id_resposta3'] ?>" name="resposta" id="resposta3">
		                  <label class="form-check-label-inline" for="resposta3">C </label>
		              </div>
                  <?= $questao['resposta3'] ?>
              	  </div>
              	  <div style="clear: both;"></div>
                </div>
                
                <div class="form-check radio " >
                	<div class="resposta" >
                   		<div style="float: left;"> 
		                  <i class="icon fa fa-cut ico" title="Cortar resposta"></i>
		                  <input class="form-check-input" type="radio" value="<?= $questao['id_resposta4'] ?>" name="resposta" id="resposta4">
		                  <label class="form-check-label-inline" for="resposta4">D </label>
                  		</div>
                  		<?= $questao['resposta4'] ?>
                   </div>
              	  <div style="clear: both;"></div>
                </div>
                
                <div class="form-check radio " >
                	<div class="resposta" >
                   		<div style="float: left;"> 
		                  <i class="icon fa fa-cut ico" title="Cortar resposta"></i>
		                  <input class="form-check-input" type="radio" value="<?= $questao['id_resposta5'] ?>" name="resposta" id="resposta5">
		                  <label class="form-check-label-inline" for="resposta5">E </label>
		                </div>
                  		<?= $questao['resposta5'] ?>
                  	</div>
                  	<div style="clear: both;"></div>                  	
                </div>

                <br>
                <div class="text-red aviso"></div>
                <div id='gabarito'></div>
				<button class="btn btn-info" name="responder" id="responder">Responder</button>
				<a href="/questoes" class="btn btn-danger" name="proxima" id="proxima">Responder a próxima</a>
               
              </div><!-- FIM CARD BODY-->

            </div><!-- FIM DO CARD -->
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <div class="modal fade" id="modal-lg" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Comentário da questão</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            	<?php if ($questao['comentario'] == ''){
            		echo "<p><i>\"Infelizmente não temos comentário para esta questão!\"</i></p>";
            	} else {
            		echo "<p><i>\"".$questao['comentario']."\"</i></p>";
            	}
            	?>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="caderno" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="icon fas fa-ban"></i> Erro!</h5>
                  Infelizmente no momento essa função está desabilitada!
                </div>
        </div>
        <!-- /.modal-dialog -->
      </div>


  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

 <?php include 'view/frontend/footer.php' ?>
<!-- OS JAVA SCRIPTS NECESSÁRIOS ENTRAM AQUI -->
<script type="text/javascript">

  $( document ).ready(function() {
 
   $('.pergunta *').css({'font-size':''});
   $('.resposta *').css({'font-size':''});

   $(".ico").click(function(){
      
     if ($(this).parent().css('color') == 'rgb(128, 128, 128)'){
        $(this).parent().parent().css('color','');
        $(this).parent().parent().css({'text-decoration':'', 'font-style':''});
      } else {
        $(this).css("visibility", 'visible');
        $(this).parent().parent().css('color','gray');
        $(this).parent().parent().css({'text-decoration':'line-through', 'font-style':'italic'});
      }
        
   });

   $("#responder").on('click', function(){
   		if( $( "input:checked" ).length < 1){
   			$('.aviso').html('<b>Você deve marcar pelo menos uma opção para responder a questão!</b>')
   			return false;
   		} else {
   			$('.aviso').hide();
   		}

   		res = $.ajax({
	       type: 'POST', //Esta propriedade diz que tipo de interação faremos entre os dados, neste caso por POST
	       url: 'res/extras/ajax.php',
	       data: {id_resposta: $( "input:checked" ).val(), verifica_resposta: 'ok'}
	      });

	   res.done(function(msg){
	        if (msg == 'certa'){
	             $('#gabarito').html('<h3 class="text-green">Parabésns! Você acertou a questão.</h3>');
	             //$("#responder").attr("disabled", true);
	        } else {
	            $('#gabarito').html('<h3 class="text-red">Desculpe! Você não acertou.</h3>');
	            //$("#responder").attr("disabled", true);
	        }
	  
	      $.ajax({
	       type: 'POST', //Esta propriedade diz que tipo de interação faremos entre os dados, neste caso por POST
	       url: 'res/extras/ajax.php',
	       data: {
	       	cliente: <?= $id_cliente ?>,
	       	questao: <?= $id_questao ?>,
	       	msg: msg,
	       	estatistica: 'ok'
	       	}
	      });
	   });

   });

   
});

  
//Função para verificar se resposta correta
  function verifica(obj){

    id = $(obj).children().first().val();
    
    $(obj).children().first().prop("checked", true);

   res = $.ajax({
       type: 'POST', //Esta propriedade diz que tipo de interação faremos entre os dados, neste caso por POST
       url: 'res/extras/ajax.php',
       data: {id_resposta: id, verifica_resposta: 'ok'}
      });

   res.done(function(msg){
        if (msg == 'certa'){
             $(obj).children().last().css('color','green');
        } else {
            $(obj).children().last().css('color','red');
        }
   });
     
  }

</script>
<!-- FIM DOS JAVASCRIPTS-->
</body>
</html>