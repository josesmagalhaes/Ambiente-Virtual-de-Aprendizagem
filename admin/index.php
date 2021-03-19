<?php require "header.php"; ?>
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
              <!-- Acesso Alunos -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Acesso dos alunos</h6>
                </div>
<?php $dataAcessar = date('d/m/yy');?>
        <div class="container-fluid">
<table class="table table-striped">
<th>   
        <form method="post">
        <div class="form-group">
            <label for="exampleFormControlTextarea1"><strong>Filtrar por data:</strong></label>
            <input class="form-control" name="dataAcesso" type="text" placeholder="dd/mm/aaaa"><br>
            <input name="filtrar" type="submit" class="btn btn-success" value="Filtrar">
          </div> 
        </form>
<?php
    if (isset($_POST['filtrar'])){
       $dataAcessar = $_POST['dataAcesso'];
    }        
            
?>
            
<label for="exampleFormControlTextarea1"><strong>Acessos em:</strong><?php echo " ".$dataAcessar;?></label>            
 <table class="table table-striped">           
  <thead>
    <tr>
      <th scope="col">Matrícula</th>  
      <th scope="col">Aluno</th>
      <th scope="col">Data</th>
      <th scope="col">Turma</th>
    </tr>
  </thead>
  <tbody>
<?php
    $acessoss = mysqli_query($connect,"SELECT * FROM acessos WHERE data LIKE '$dataAcessar%' AND acesso = 'Aluno'");
    if (mysqli_num_rows($acessoss)==''){
    }else{
        while($resAcc = mysqli_fetch_array($acessoss)){
            $codeAlunoy = $resAcc['codigo'];
            $alunoy = $resAcc['nome'];
            $datasd = $resAcc['data'];
   ?>       
    <tr>
      <td><?php echo $codeAlunoy;?></td>
      <td><?php echo $alunoy;?></td>
      <td><?php echo $datasd;?></td>
<?php
    $acessossy = mysqli_query($connect,"SELECT serie FROM estudantes WHERE code = '$codeAlunoy'");
    if (mysqli_num_rows($acessossy)==''){
    }else{
        while($resAccy = mysqli_fetch_array($acessossy)){
            $turmassy = $resAccy['serie'];
   ?>          
      <td><?php echo $turmassy;?></td>
    </tr>
<?php }}}}?>        
  </tbody>
     
</table> 
    </th> 
</table>   
</div>
<br>
              <!-- Acesso Professores-->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Acesso dos professores</h6>
                </div>
<?php $dataAcessar2 = date('d/m/yy');?>
        <div class="container-fluid">
<table class="table table-striped">
<th>             
        <form method="post">
        <div class="form-group">
            <label for="exampleFormControlTextarea1"><strong>Filtrar por data:</strong></label>
            <input class="form-control" name="dataAcesso2" type="text" placeholder="dd/mm/aaaa"><br>
            <input name="filtrar2" type="submit" class="btn btn-success" value="Filtrar">
          </div> 
        </form>
<?php
    if (isset($_POST['filtrar2'])){
       $dataAcessar2 = $_POST['dataAcesso2'];
    }        
            
?>
            
<label for="exampleFormControlTextarea1"><strong>Acessos em:</strong><?php echo " ".$dataAcessar;?></label>            
 <table class="table table-striped">           
  <thead>
    <tr>
      <th scope="col">CPF</th>  
      <th scope="col">Professor</th>
      <th scope="col">Data</th>
    </tr>
  </thead>
  <tbody>
<?php
    $acessoss = mysqli_query($connect,"SELECT * FROM acessos WHERE data LIKE '$dataAcessar2%' AND acesso = 'professor'");
    if (mysqli_num_rows($acessoss)==''){
    }else{
        while($resAcc = mysqli_fetch_array($acessoss)){
            $codeAlunoy = $resAcc['codigo'];
            $alunoy = $resAcc['nome'];
            $datasdx = $resAcc['data'];
   ?>       
    <tr>
      <td><?php echo $codeAlunoy;?></td>
      <td><?php echo $alunoy;?></td>
      <td><?php echo $datasdx;?></td>
<?php }}?>        
  </tbody>
</table> 
    </th> 
</table>                     
</div>
</div>
</div>       <!-- Content Row -->

<div class="row">
              
            

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
