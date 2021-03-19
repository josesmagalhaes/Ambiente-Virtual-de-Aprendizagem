<?php $painel_atual = "admin"; ?>
<?php require "../config.php"; ?>
<?php require "../conexao.php"; ?>
<?php date_default_timezone_set('America/Sao_Paulo');?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
    <link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
    
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>E-Escolar | Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
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

      <!-- Heading -->
      <div class="sidebar-heading">
        Administrativo
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-book"></i>
          <span>Grade Escolar</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Estrutura Escolar:</h6>
            <a class="collapse-item" href="cursos_e_disciplinas.php?pg=curso">Turma</a>
            <a class="collapse-item" href="cursos_e_disciplinas.php?pg=disciplina">Disciplinas</a>
            <a class="collapse-item" href="cursos_e_disciplinas.php?pg=cursoedisciplinas">Formação</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-copy"></i>
          <span>Relatórios</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Ver Relatórios:</h6>            
            <a class="collapse-item" href="../admin/relatoriodeprofessores.php">Professor</a>
            <a class="collapse-item" href="../admin/relatoriodealunos.php">Aluno</a>  
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Humanos
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Registros</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="relatorios.php?tipo=professores&s=<?php echo base64_encode("SELECT * FROM disciplinas"); ?>">Professores</a>
            <a class="collapse-item" href="relatorios.php?tipo=alunos&s=<?php echo base64_encode("SELECT * FROM estudantes WHERE nome != ''"); ?>">Alunos</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="professores.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Professores</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="estudantes.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Estudantes</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="funcionarios.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Funcionários</span></a>
      </li>          
      <li class="nav-item">
        <a class="nav-link" href="../admin/notificacoes.php">
          <i class="far fa-bell"></i>
          <span>Notificações</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../admin/agenda.php">
          <i class="fas fa-envelope-open-text"></i>
          <span>Mensagens</span></a>
      </li>         
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

        <!-- End of Topbar -->
