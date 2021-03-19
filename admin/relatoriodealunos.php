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

  <title>E-Escolar | Admin | Relatórios</title>

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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Painel de controle</h1>

          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                     <?php 
                    $quant_alunos = mysqli_query($connect,"SELECT COUNT(code) AS CODE FROM estudantes");
                        if (mysqli_num_rows($quant_alunos)==''){
                            $quantidade_aluno = "0";
                        }else{
                            while($resultados = mysqli_fetch_array($quant_alunos)){
                                $quantidade_aluno = $resultados['CODE'];
                            }
                        }

                     ?> 
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de estudantes</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $quantidade_aluno ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-graduate"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                     <?php 
                        $quant_professores = mysqli_query($connect,"SELECT COUNT(code) AS CODE FROM professores");
                        if (mysqli_num_rows($quant_professores)==''){
                            $quantidade_professor = "0";
                        }else{
                            while($resultados = mysqli_fetch_array($quant_professores)){
                                $quantidade_professor = $resultados['CODE'];
                            }
                        }

                     ?> 

                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total de professores</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $quantidade_professor ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data de hoje</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo date("d/m/Y"); ?></div>
                        </div>
                        <div class="col">
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar-alt"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                    <?php
                    $dhoje = date('d/m/yy');
                        $dh = mysqli_query($connect,"SELECT count(id) as contid FROM acessos WHERE data LIKE '$dhoje%'");
                        if (mysqli_num_rows($dh)==''){
                        }else{
                            while($resdh = mysqli_fetch_array($dh)){  
                                $quanthoje = $resdh['contid'];
                        
                    ?>
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Acessos hoje</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $quanthoje;?></div>
                    <?php }}?>    
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-check"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
<hr>  
<div class="row">
              
            
<?php 
    $dataAcessar = date('d/m/yy');
    $turmaBuscar = "1ºA-INTEGRAL";
?>
<th>   
    <form method="post">
    <div class="form-group">
    <label for="exampleFormControlTextarea1"><strong>Filtrar por turma:</strong></label>
    <select name="turmaAcesso" class="form-control" id="exampleFormControlSelect1">
      <option>1ºA-INTEGRAL</option>
      <option>1ºB-INTEGRAL</option>
      <option>1ºC-INTEGRAL</option>
      <option>1ºA-TARDE</option>
      <option>1ºB-TARDE</option>  
      <option>1ºA-NOITE</option>  
      <option>2ºA-MANHÃ</option>  
      <option>2ºB-MANHÃ</option>  
      <option>2ºC-MANHÃ</option>  
      <option>2ºD-MANHÃ</option>  
      <option>2ºA-TARDE</option>  
      <option>2ºB-TARDE</option> 
      <option>2ºC-TARDE</option>  
      <option>2ºA-NOITE</option> 
      <option>3ºA-MANHÃ</option>  
      <option>3ºB-MANHÃ</option>  
      <option>3ºC-MANHÃ</option> 
      <option>3ºA-TARDE</option>  
      <option>3ºB-TARDE</option>  
      <option>3ºC-TARDE</option> 
      <option>3ºA-NOITE</option>  
      <option>1ºA-JACAREÍ</option>  
      <option>2ºA-JACAREÍ</option>  
      <option>3ºA-JACAREÍ</option>  
      <option>1ºA-ANGICAL</option>
      <option>2ºA-ANGICAL</option>       
      <option>3ºA-ANGICAL</option>       
    </select><br>            
            
            <input name="filtrar" type="submit" class="btn btn-success" value="Filtrar">
          </div> 
        </form>
<?php
    if (isset($_POST['filtrar'])){
       $turmaBuscar = $_POST['turmaAcesso'];
    }        
            
?>    
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Controle de Alunos</h1>
            
<table class="table table-striped">
<th>   
            
<label for="exampleFormControlTextarea1"><strong>Hoje é:</strong><?php echo " ".$dataAcessar;?></label>            
 <table class="table table-striped">           
  <thead>
    <tr>
      <th scope="col">Matrícula</th>  
      <th scope="col">Aluno</th>
      <th scope="col">Turma</th>
      <th scope="col">Quant. Acessos</th>       
    </tr>
  </thead>
  <tbody>
<?php
    $acessoss = mysqli_query($connect,"SELECT * FROM estudantes WHERE serie = '$turmaBuscar'");
    if (mysqli_num_rows($acessoss)==''){
    }else{
        while($resAcc = mysqli_fetch_array($acessoss)){
            $codeAlunoy = $resAcc['code'];
            $alunoy = $resAcc['nome'];
            $serie = $resAcc['serie'];
   ?>       
    <tr>
      <td><?php echo $codeAlunoy;?></td>
      <td><?php echo $alunoy;?></td>  
      <td><?php echo $serie;?></td> 
 <?php
    $qacc = mysqli_query($connect,"SELECT count(id) as quantAcesso FROM acessos WHERE codigo = '$codeAlunoy' and acesso = 'Aluno'");
    if (mysqli_num_rows($qacc)==''){
    }else{
        while($resqacc = mysqli_fetch_array($qacc)){
            $quantAcess = $resqacc['quantAcesso'];
            if ($quantAcess==0){
                $info = "NUNCA";
            }else{
                $info = $quantAcess;
            }
   ?>          
        
      <td><?php echo $info;?></td>  
    <?php }}}}?>    
      </tr>
     
</table> 
    </th> 
</table>   
     
<hr>  
            
          <div class="row">
            

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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
