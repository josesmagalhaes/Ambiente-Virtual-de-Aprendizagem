<?php $painel_atual = "Aluno"; ?>
<?php require "../config.php"; ?>
<?php require "../conexao.php"; ?>
<?php date_default_timezone_set('America/Sao_Paulo');?>
<html lang="pt-br">

<head>
    <link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
    
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-Escolar | Alunos</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="../imagens/logo_escola.png" alt="Minha Figura">	
            
<?php 
            $dados = mysqli_query($connect,"SELECT * FROM dados_escola");
                if (mysqli_num_rows($dados)==''){
                    
                }else{
                    while($resuldados = mysqli_fetch_array($dados)){
                        
    ?>             
        </div>
        <div class="sidebar-brand-text mx-3"><?php echo $resuldados['nome'];?> <sup></sup></div>
      </a>
<?php }}?>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Divider -->
      <hr class="sidebar-divider">


      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="../aluno/minhasnotas.php">
          <i class="fas fa-table"></i>
          <span>Minhas Notas</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../aluno/trabalhos.php?pg=trabalhos_extras">
          <i class="far fa-clipboard"></i>
          <span>Meus Trabalhos</span></a>
      </li>         
      <li class="nav-item">
        <a class="nav-link" href="../aluno/notificacoes.php">
          <i class="far fa-bell"></i>
          <span>Enviar Mensagens</span></a>
      </li>     
      <li class="nav-item">
        <a class="nav-link" href="../aluno/verificarmensagens.php">
          <i class="fas fa-envelope"></i>
          <span>Verificar Envios</span></a>
      </li> 
      <li class="nav-item">
        <a class="nav-link" href="../aluno/treinamento.php">
          <i class="fas fa-video"></i>
          <span>Treinamento em Vídeo</span></a>
      </li>     
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>