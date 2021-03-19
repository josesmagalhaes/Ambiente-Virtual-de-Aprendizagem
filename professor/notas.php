<?php require "header.php"; ?>
<?php $dis = base64_decode($_GET['dis']);?>
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
                <a class="dropdown-item d-flex align-items-center" href="../professor/mensagens.php">
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
                  <a class="dropdown-item text-center small text-gray-500" href="../professor/mensagens.php">Ler todas as mensagens</a>
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
                <img class="img-profile rounded-circle" src="../imagens/ico_professor.png">
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
            <h1 class="h3 mb-0 text-gray-800">Insira as notas nos campos abaixo</h1>
          </div>
            

        <div>
        <form method="post">
            <h5>Turma: <strong><?php echo $curso = base64_decode($_GET['curso']); ?></strong> | Data de Hoje <strong><?php echo date("d/m/Y"); ?> </strong></h5>
            
              <?php
              $sql_1 = mysqli_query($connect,"SELECT disciplina FROM disciplinas WHERE professor = '$code' AND curso = '$curso'");

              if(mysqli_num_rows($sql_1) == ''){
                $mensagem = "Não existe nenhuma turma."; 
              }else{
                while($res_1 = mysqli_fetch_array($sql_1)){
                $disciplina = $res_1['disciplina'];
                }}
              ?> 
      

    <form method="post">
        <table>
        <tr>
        <th>
    <select class="form-control" name="meses">
        <option >Fórum 1</option>
      </select>
        </th>
        <th>
        <input type="submit" name="verificar" value="Verificar" class="btn btn-success"></th>  
        </tr>
    </table>


     
            
<?php
    $mes = "Fórum 1";
    if (isset($_POST['verificar'])){
         $mes = $_POST['meses'];
    }
?>            
            
<br>
          <!-- Content Row -->
              <?php
              $date = date("d/m/Y H:i:s");
              $date_hoje = date("d/m/Y");
              ?>
                
              <table class="table table-striped">
                <tr>
                  <th scope="col"><strong>Código:</strong></th>
                  <th scope="col"><strong>Nome:</strong></th>
                  <th scope="col"><strong>Nota</strong></th>
                  <th scope="col"><strong>Mes</strong></th>  
                </tr>

<?php
              $i = 1;
              $sql_1 = mysqli_query($connect,"SELECT * FROM estudantes WHERE serie = '$curso'");
            
              if(mysqli_num_rows($sql_1) == ''){
                 echo "<h2>Não existe nenhum aluno cadastro nesta disciplina!</h2>";
              }else{
               while($res_1 = mysqli_fetch_array($sql_1)){
                 $code_aluno = $res_1['code'];
              ?> 

 <?php
              //$i = 1;
              $turma = $dis;
              $aluno = $res_1['code'];
                   
              $sql_1i = mysqli_query($connect,"SELECT nota FROM notas WHERE aluno = '$aluno' and disciplina = '$turma' and mes = '$mes'");
            
              if(mysqli_num_rows($sql_1i) == ''){
                 $nota = 0.0;
              }else{
               while($res_1i = mysqli_fetch_array($sql_1i)){
                 $nota = $res_1i['nota'];
               }}?>          
                  
                  

                <tr>
                  <th scope="col"><?php echo $res_1['code']; ?><input type="hidden" name="code_aluno" value="<?php echo $res_1['code']; ?>" /></th>

                  <th scope="col"><?php echo $res_1['nome']; ?><input type="hidden" name="nome" value="<?php echo $res_1['nome']; ?>" /></th>
                 <th scope="col"><input type="text" class="form-control" name="notaAluno_<?php echo $i; ?>" value="<?php echo $nota?>"/></th>
                 <th scope="col"><?php echo $mes; ?><input type="hidden" name="mes" /></th>      
                  <?php
                  $i++;
               }}?></th>
              </tr>
            </form>
                <input type="submit" name="inserir" value="Inserir ou Atualizar" class="btn btn-success">
            </table>
                </form>
            </table>
            <a class="btn btn-success" href="../professor">Retornar</a></td><br>
</div><br>
</div>

     
        
    
<?php
    if (isset($_POST['inserir'])){
        
        $i = 1;
        $turma = $dis;
        $professor = $code;
        
         
        
        $mes = $_POST['meses'];//resolver problema do mes
        
        $sql_1 = mysqli_query($connect,"SELECT * FROM estudantes WHERE serie = '$curso'");
            if(mysqli_num_rows($sql_1) == ''){
                 echo "<h2>Não existe nenhum aluno cadastro nesta disciplina!</h2>";
            }else{
             while($res_1 = mysqli_fetch_array($sql_1)){
                 $code_aluno = $res_1['code'];
                 $nota = $_POST['notaAluno_'.$i];
                                  
             
                    $sqlNotinha = mysqli_query($connect,"DELETE FROM notas WHERE aluno='$code_aluno' AND mes='$mes' AND disciplina='$dis' AND professor='$professor'");
                 
                    $sql_4 = mysqli_query($connect,"INSERT INTO notas (nota, aluno, mes, disciplina, professor) VALUES ('$nota','$code_aluno','$mes','$dis','$professor')");
                    
                    //$executar = mysqli_query($connect,$sqlNotinha); 
                    //$executar2 = mysqli_query($connect,$sql_4);

                    $i++;

             }

                }
                echo "<script language='javascript'>window.alert('Notas inseridas com sucesso!');</script>";
                echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";

            }
    
    ?>
  
  

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">


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
