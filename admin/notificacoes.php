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

  <title>E-Escolar | Admin | Notificações</title>

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
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->

          <form action="" name="" method="post" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" enctype="multipart/form-data">
            <div class="input-group">
              <div class="input-group-append">
                <a href="#" class="btn btn-success" role="button">2020
                </a>                   
              </div>
            </div>
          </form>
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-success" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>


            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                     <?php 
                    $quant_men = mysqli_query($connect,"SELECT COUNT(id) AS mensagem FROM central_mensagem WHERE status = 'Aguarda resposta' and receptor = '$code'");
                        if (mysqli_num_rows($quant_men)==''){
                            $quantidade_mensagens = "0";
                        }else{
                            while($resultados = mysqli_fetch_array($quant_men)){
                                $quantidade_mensagens = $resultados['mensagem'];
                            }
                        }

                     ?>                 
                <span class="badge badge-danger badge-counter"><?php echo $quantidade_mensagens; ?></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Central de Suporte
                </h6>
<?php
$sql_1 = mysqli_query($connect,"SELECT * FROM central_mensagem WHERE status = 'Aguarda resposta' and receptor = '$code'");

if(mysqli_num_rows($sql_1) == ''){
  $mensagem = "Não existe nenhuma mensagem."; 
}else{
  while($res_1 = mysqli_fetch_array($sql_1)){

?>                
                <a class="dropdown-item d-flex align-items-center" href="../admin/mensagens.php">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://www.awicons.com/stock-icons/symbol-color/preview/icon-user.png" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate"><?php echo $res_1['mensagem']; ?></div>
                    <div class="small text-gray-500"><?php echo $res_1['date']; ?></div>
                  </div>
                </a>
<?php }} ?>
                  <a class="dropdown-item text-center small text-gray-500" href="../admin/mensagens.php">Ler todas as mensagens</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <?php 
                    $nome_User = mysqli_query($connect,"SELECT nome FROM acesso_ao_sistema WHERE CODE = '$code'");
                        if (mysqli_num_rows($nome_User)==''){
                            $nomeUsuario = "Não autorizado";
                        }else{
                            while($resultados = mysqli_fetch_array($nome_User)){
                                $nomeUsuario = $resultados['nome'];
                            }
                        }

                     ?> 
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nomeUsuario; ?></span>
                <img class="img-profile rounded-circle" src="../../img_servidores/<?php echo $code; ?>" onerror="this.src='../../img_servidores/ico_adm.png'">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">


                <a class="dropdown-item" href="../sistema.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Sair do Sistema
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
  
          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Notificar Professores ou Alunos</h1>
          <p class="mb-4">Neste espaço você pode notificar seu aluno, responsável ou professor pelo mesmo sobre algum trabalho, sugestão ou  reclamação por algo que tenha vindo a acontecer.</p>
            <form name="form_disc" method="post" action="">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Escolha um aluno:</label>
            <select class="form-control" name="alunoEscolhido">
            <option>Selecionar Aluno</option>
   <?php
    $resultI = mysqli_query($connect,"SELECT * FROM estudantes");
    if (mysqli_num_rows($resultI)==''){
    }else{
        while($resultados = mysqli_fetch_array($resultI)){
   ?>                
              <option><?php echo $resultados['nome']; $codigoAluno = $resultados['code'];?></option>
              <?php }}?>  
            </select>
              <label for="exampleFormControlTextarea1">Digite sua mensagem abaixo:</label>
            <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
                        <textarea name="mensagemEnviar"></textarea>
                        <script>
                                CKEDITOR.replace( 'mensagemEnviar' );
                        </script><br>
            <button type="submit" class="btn btn-success mb-2" name="submeterNotificacao">Notificar Aluno</button> 
          </div>          
            </form> 
          <!-- Content Row -->
          <div class="row">

<?php
    if (isset($_POST['submeterNotificacao'])){
        $alunoEscolhido = $_POST['alunoEscolhido'];
        $mensagem = $_POST['mensagemEnviar'];
        $date = date("d/m/Y H:i:s");

        
        
        $sqlCODE = mysqli_query($connect,"SELECT code FROM estudantes WHERE nome = '$alunoEscolhido'");
        if (mysqli_num_rows($sqlCODE)==''){
            $codeAlunoNot = "";
            }else{
            while($resultados = mysqli_fetch_array($sqlCODE)){
            $codeAlunoNot= $resultados['code'];
            }
        }

        $sql_4 = mysqli_query($connect,"INSERT INTO central_mensagem (date, emissor, receptor, mensagem, status) VALUES ('$date', '$code', '$codeAlunoNot', '$mensagem', 'Aguarda resposta')");
        $executar = mysqli_query($connect,$sql_4);
        echo "<script language='javascript'>window.alert('Notificação Enviada!');</script>";
        
    }
?>              
          
          </div>

        </div>
        <!-- /.container-fluid -->
<!-- Begin Page Content2 -->
        <div class="container-fluid">
            <form name="form_disc2" method="post" action="">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Escolha um professor:</label>
            <select class="form-control" name="alunoEscolhido">
            <option>Selecionar Professor</option>
   <?php
    $resultI = mysqli_query($connect,"SELECT * FROM professores");
    if (mysqli_num_rows($resultI)==''){
    }else{
        while($resultados = mysqli_fetch_array($resultI)){
   ?>                
              <option><?php echo $resultados['nome']; $codigoAluno = $resultados['code'];?></option>
              <?php }}?>  
            </select>
              <label for="exampleFormControlTextarea1">Digite sua mensagem abaixo:</label>
            <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
                        <textarea name="mensagemEnviar2"></textarea>
                        <script>
                                CKEDITOR.replace( 'mensagemEnviar2' );
                        </script><br>
            <button type="submit" class="btn btn-success mb-2" name="submeterProfessor">Notificar Professor</button> 
          </div>          
            </form> 
            <a href="../admin/verificarmensagens.php" class="btn btn-success" role="button">Verificar Envios</a> 
          <!-- Content Row -->
          <div class="row">
        
<?php
    if (isset($_POST['submeterProfessor'])){
        $alunoEscolhido = $_POST['alunoEscolhido'];
        $mensagem = $_POST['mensagemEnviar2'];
        $date = date("d/m/Y H:i:s");

        
        
        $sqlCODE = mysqli_query($connect,"SELECT code FROM professores WHERE nome = '$alunoEscolhido'");
        if (mysqli_num_rows($sqlCODE)==''){
            $codeAlunoNot = "";
            }else{
            while($resultados = mysqli_fetch_array($sqlCODE)){
            $codeAlunoNot= $resultados['code'];
            }
        }

        $sql_4 = mysqli_query($connect,"INSERT INTO central_mensagem (date, emissor, receptor, mensagem, status) VALUES ('$date', '$code', '$codeAlunoNot', '$mensagem', 'Aguarda resposta')");
        $executar = mysqli_query($connect,$sql_4);
        echo "<script language='javascript'>window.alert('Notificação Enviada!');</script>";
        
    }
?>                  
          </div>

        </div>
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; e-Escolar 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deseja realmente sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clique em "Sair" abaixo se deseja realmente finalizar esta sessão.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-success" href="../index.php">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
