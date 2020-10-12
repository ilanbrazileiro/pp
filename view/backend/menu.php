<?php use \Questoes\Model\Usuario; ?>

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">
      <img src="/res/backend/dist/img/logo-papirar-temp-peq.jpg" alt="Logo Papirar" class="brand-image">
      <span class="brand-text">PAPIRAR</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/res/backend/dist/img/boxed-bg.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="/admin/minha-conta" class="d-block"><?= Usuario::getNameSession(); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if (Usuario::checkAdmin() === true){ ?>
          <!-- MENU CURSOS -->     
          <li class="nav-item has-treeview">
            <a href="/admin/cursos/listar" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Cursos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/cursos/listar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/cursos/adicionar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar Novo</p>
                </a>
              </li>
           </ul>
          </li>
          <?php } ?>

          <!-- MENU DISCIPLINA -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Disciplina
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/disciplinas/listar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar Todas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/disciplinas/adicionar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar Nova</p>
                </a>
              </li>
           </ul>
          </li>

          <!-- MENU QUESTÕES -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Questões
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/questoes/listar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar Todas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/questoes/adicionar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar Nova</p>
                </a>
              </li>
           </ul>
          </li>
          <?php if (Usuario::checkAdmin() === true){ ?>
          <!-- MENU CLIENTES -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Clientes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/clientes/listar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/clientes/adicionar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar Novo</p>
                </a>
              </li>
           </ul>
          </li>
        <?php } ?>
          <!-- MENU CONTEÚDO -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Conteúdo
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/conteudo/listar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/conteudo/adicionar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar Novo</p>
                </a>
              </li>
           </ul>
          </li>


          <!-- MENU SUPORTE -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-headset"></i>
              <p>
                Suporte
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/suporte/listar-abertos" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Listar Chamados Abertos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/suporte/listar-fechados" class="nav-link">
                  <i class="fa fa-clipboard-check nav-icon"></i>
                  <p>Listar Chamados Fechados</p>
                </a>
              </li>

           </ul>
          </li>

          <?php if (Usuario::checkAdmin() === true){ ?>
          <!-- MENU USUÁRIOS -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Usuários
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/usuarios/listar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Listar Todos</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/usuarios/adicionar" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Adicionar Novo</p>
                </a>
              </li>
           </ul>
          </li>


          <!-- MENU CONFIGURAÇÕES -->     
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Configurações
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/admin/configuracao/email" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Configurações de E-mail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/admin/configuracao/aparencia" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Aparência do Sistema</p>
                </a>
              </li>
           </ul>
          </li>
        <?php } ?>
          <!-- MENU SAIR -->     
          <li class="nav-item has-treeview">
            <a href="/admin/logout" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Sair
              </p>
            </a>
          </li>
          
          
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>