<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="pt_BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Papirar.com.br</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/res/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/res/backend/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="/inicio" class="navbar-brand">
        <img src="/res/backend/dist/img/logo-papirar-temp-peq.jpg" alt="Papirar.com.br" class="brand-image">
        <span class="brand-text">Papirar.com.br</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
         
        <!-- MINHA CONTA -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <div class="img-circle">
              <i class="fas fa-user mr-2"></i>
            
            <span class="brand-text font-weight-light"><?= $cliente->getnome(); ?></span>
            </div>
          </a>

          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="/minha-conta" class="dropdown-item">
              <i class="fas fa-user mr-2"></i> Minha Conta
            </a>
            <div class="dropdown-divider"></div>

            <a href="/inicio" class="dropdown-item">
              <i class="fas fa-book mr-2"></i> Questões
            </a>
            <div class="dropdown-divider"></div>

            <a href="/simulados" class="dropdown-item">
              <i class="fas fa-pen mr-2"></i> Simulados
            </a>
            <div class="dropdown-divider"></div>

            <a href="/minha-conta/estatistica" class="dropdown-item">
              <i class="fas fa-chart-bar mr-2"></i> Minhas Estatísticas
            </a>
            <div class="dropdown-divider"></div>

            <a href="/minha-conta/meus-cadernos" class="dropdown-item">
              <i class="fas fa-book-open mr-2"></i> Meus Cadernos
            </a>
            <div class="dropdown-divider"></div>

            <a href="/suporte" class="dropdown-item">
              <i class="fas fa-headset mr-2"></i> Suporte
                  <span class="float-right text-muted text-sm">
                    <i class="fas fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                  </span>
            </a>
            <div class="dropdown-divider"></div>

            <a href="/logout" class="dropdown-item dropdown-footer"> <i class="fas fa-sign-out-alt mr-2"></i>Sair</a>
          </div>
        </li>


      </ul>
    </div>
  </nav>
  <!-- /.navbar -->
