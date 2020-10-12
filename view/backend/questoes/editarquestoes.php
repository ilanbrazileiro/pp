<?php include ("view/backend/header.php"); ?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Questões </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/admin">Home</a></li>
              <li class="breadcrumb-item active">Editar Questões</li>
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
          <?php if (isset($msgsucesso)){ ?>
          <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <?php echo $msgsucesso; ?>
                      
          </div>
          <?php } ?>


<!-- INICIO DO CONTENT -->
    
    <!-- form start -->
    <form role="form" id="quickForm" action="" method="post" enctype="multipart">
      <div class="container-fluid">
        <!-- DISCIPLINA e CURSOS -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-orange">
              <div class="card-header">
                <h3 class="card-title">Escolha a Disciplina e pelo menos um curso para cadastrar a questão</h3>
              </div>
              <div class="card-body">
                <div class="form-group col-md-5">
                  <label for="disciplina">Escolha a disciplina</label>
                  <select class="form-control" name="disciplina" id="disciplina">
                      <option value="<?= $questao['id_disciplina']?>"><?= $disciplina->getTitulo($questao['id_disciplina']); ?></option>
                    <?php foreach ($disciplinas as $key => $value) { ?>
                        <option value="<?= $value['id_disciplina']; ?>"><?= $value['titulo']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                
                <div class="form-group">
                    <label for="cursos">Cursos disponíveis para a Disciplina</label>


                  <div class="overlay" id="loader">
                      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                      <span class="info-box-text"> Carregando....</span>
                    </div>
            
                      <div class='checkbox-inline' id="cursos">
                          <label>
                            <?php 
                            foreach ($cursos as $value) {
                              if ($questoes->checkCurso($value['id_curso'], $id_questao) === true){
                                $checked = 'checked';
                              } else {
                                $checked = '';
                              }
                              echo "<input type='checkbox' value='".$value['id_curso']."' name='cursos[]' ".$checked." > ".$value['titulo']."&nbsp;&nbsp;|&nbsp;&nbsp;";
                            } ?>
                          </label>
                      </div>
                  </div>
           

              </div>
            </div><!-- /.card -->
          </div><!--FIM COL-->
        </div><!--FIM LINHA -->

        <!-- FIM DISCIPLINA E CURSOS-->

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-info">
              <div class="card-header">
                <h2 class="card-title">Sobre a Questão </h2>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body questao">
                  <div class="row">
                    
                    <div class="col-md-1">
                      <div class="form-group"> 
                        <label for="ano">Ano</label>
                        <input type="text" name="ano" class="form-control" value="<?= $questao['ano'] ?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group"> 
                        <label for="banca">Banca</label>
                        <input type="text" name="banca" class="form-control" value="<?= $questao['banca'] ?>">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group"> 
                        <label for="orgao">Órgao</label>
                        <input type="text" name="orgao" class="form-control" value="<?= $questao['orgao'] ?>">
                      </div>
                    </div>

                    <div class="col-md-5">
                      <div class="form-group"> 
                        <label for="prova">Prova</label>
                        <input type="text" name="prova" class="form-control" value="<?= $questao['prova'] ?>">
                      </div>
                    </div>
                  </div><!--FIM LINHA -->
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group"> 
                        <label for="nivel">Nivel</label>
                        <select name="nivel" class="form-control">
                          <option value="<?= $questao['nivel'] ?>"><?= $questao['nivel'] ?></option>
                          <option value="facil">Fácil</option>
                          <option value="medio">Médio</option>
                          <option value="dificil">Difícil</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group"> 
                        <label for="escolaridade">Escolaridade</label>
                        <select name="escolaridade" class="form-control">
                          <option value="<?= $questao['escolaridade'] ?>"><?= $questao['escolaridade'] ?></option>
                          <option value="superior">Ensino Superior</option>
                          <option value="medio">Ensino Médio</option>
                          <option value="primario">Ensino Primário</option>
                          <option value="pos">Pós Graduação</option>
                        </select>
                      </div>
                    </div>

                  </div>
                </div><!--FIM CARD BODY-->
            </div><!--FIM CARD-->
       </div> <!--FIM COLUNA-->
      </div><!--FIM LINHA-->

        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-info">
              <div class="card-header">
                <h2 class="card-title">Questão <small>Atenção todos os dados são requeridos</small></h2>
              </div>
              <!-- /.card-header -->
                <div class="card-body questao">
                  <div class="mb-3">
                    <label for="pergunta">Questão</label>
                    <textarea name="pergunta" class="textarea" id="summernote" ><?= $questao['pergunta'] ?></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="certa">Resposta Correta</label>
                    <textarea name="certa" class="textarea" ><?= $certa['resposta'] ?></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="errada1">Resposta Errada 1</label>
                    <textarea name="errada1" class="textarea"><?= $errada[0]['resposta'] ?></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="errada2">Resposta Errada 2</label>
                    <textarea name="errada2" class="textarea" ><?= $errada[1]['resposta'] ?></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="errada3">Resposta Errada 3</label>
                    <textarea name="errada3" class="textarea" ><?= $errada[2]['resposta'] ?></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="errada4">Resposta Errada 4</label>
                    <textarea name="errada4" class="textarea"><?= $errada[3]['resposta'] ?></textarea>
                  </div>

            </div>
              </div>
            </div>
          </div>

          <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-info">
              <div class="card-header">
                <h2 class="card-title">Outras Opções </h2>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body questao">

                  <div class="mb-3">
                    <label for="comentario">Insira aqui um COMENTÁRIO para a questão</label>
                    <textarea name="comentario" class="textarea" id="comentario"><?= $questao['comentario'] ?></textarea>
                  </div>

                  <div class="mb-3">
                    <label for="descricao">Coloque aqui uma descrição sobre a questão, ou palavras chaves que ajudem na pesquisa</label>
                    <textarea name="descricao" class="textarea" id="descricao"><?= $questao['descricao'] ?></textarea>
                  </div>

                  
                </div>
                <!-- inputs ocultos-->
                <input type="hidden" name="id_questao" value="<?= $questao['id_questao'] ?>">
                <input type="hidden" name="certa_id" value="<?= $certa['id_resposta'] ?>">
                <input type="hidden" name="errada1_id" value="<?= $errada[0]['id_resposta'] ?>">
                <input type="hidden" name="errada2_id" value="<?= $errada[1]['id_resposta'] ?>">
                <input type="hidden" name="errada3_id" value="<?= $errada[2]['id_resposta'] ?>">
                <input type="hidden" name="errada4_id" value="<?= $errada[3]['id_resposta'] ?>">

                <input type="hidden" name="files" value=" ">
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
         
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

<?php include ("view/backend/footer.php"); ?>

<!-- jquery-validation -->
<script src="/res/backend/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="/res/backend/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="/res/backend/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/res/backend/dist/js/demo.js"></script>

<script src="/res/backend/plugins/summernote/summernote-bs4.min.js"></script>
<script>
 $(document).ready(function() {
    $('.textarea').summernote({
      callbacks:{
        onImageUpload: function(files, editor, welEditable) {
            var url = sendFile(files[0],editor,welEditable);
            $img = $('<img>').attr({src: url});
            $(this).summernote('insertNode', $img[0]);
        }
      }
    });
});

function sendFile(file,editor,welEditable) {
    data = new FormData();
    data.append("file", file);
    $.ajax({
        data: data,
        type: "POST",
        url: "/res/extras/upload.php",
        cache: false,
        contentType: false,
        processData: false,
        async: false,
        success: function(url) {
            result = url;
        }
    });
    return result;
}

$(document).ready(function () {
  $('#quickForm').validate({
    rules: {
      curso: {
        required: true        
      },
      disciplina: {
        required: true
      },
      pergunta: {
        required: true,
      },
      errada1: {
        required: true,
      },
      errada2: {
        required: true,
      },
      errada3: {
        required: true,
      },
      errada4: {
        required: true,
      },
      
    },
    messages: {
      curso: "Você deve selecionar um Curso",
      disciplina: "Você deve selecionar uma Disciplina",
      pergunta: "Nenhuma das opções pode ficar em branco",
      errada1: "Nenhuma das opções pode ficar em branco",
      errada2: "Nenhuma das opções pode ficar em branco",
      errada3: "Nenhuma das opções pode ficar em branco",
      errada4: "Nenhuma das opções pode ficar em branco"
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

$('#loader').hide();


$('#disciplina').on('change', function(){
  if ($(this).val() == '0'){
    alert('Você precisa escolher uma disciplina para cadastrar a questão');
    $(this).focus();
  } else {
    var id_disciplina = $(this).val();
    $.ajax({
      method: "POST",
      url: "/res/extras/ajax.php",
      data: { id_disciplina: id_disciplina },
      beforeSend: function(){
        $('#loader').show();
        $('#cursos').hide();
        }
    })
      .done(function( msg ) {
        $('#loader').hide();
        $('#cursos').show().html(msg);
      });
  }//fim else
});
</script>
</body>
</html>