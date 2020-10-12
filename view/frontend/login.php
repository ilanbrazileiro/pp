<?php include 'header_site.php'; ?>




    <section class="pb_cover_v3 overflow-hidden cover-bg-indigo cover-bg-opacity text-left pb_gradient_v1 pb_slant-light" id="section-home">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          
          <div class="col-md-1">
          </div>
          <div class="col-md-5 relative align-self-center">

            <form action="/login" class="bg-white rounded pb_form_v1" method="post" id="flogar">
              <h2 class="mb-4 mt-0 text-center">Faça o login abaixo</h2>
              
              <div class="form-group">
                <input type="email" class="form-control pb_height-50 reverse" placeholder="E-mail" id="email" name="email" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control pb_height-50 reverse" placeholder="Sua Senha" id="senha" name="senha" required>
              </div>
              <div class="form-group">
                <a href="/forgout" class="text-primary">Esqueci a senha</a>
             
              
              <?php if(isset($erro)){ ?>
              <small id="erro_email" class="form-text text-danger"><?= $erro ?></small>
              <?php } ?>
              </div>

              
              <div class="form-group">
                <input type="submit" class="btn btn-primary btn-lg btn-block pb_btn-pill  btn-shadow-blue" value="Entrar">
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
    <!-- END section -->

    <?php include 'footer_site.php'; ?>

</body>
</html>