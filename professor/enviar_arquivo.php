<?php require "header.php"; ?>
<?php $dis = base64_decode($_GET['dis']);
      $curso = base64_decode($_GET['curso']);
?>


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
                <a class="dropdown-item d-flex align-items-center" href="../aluno/notificacoes.php">
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
                <img class="img-profile rounded-circle" src="../../img_professores/<?php echo $code; ?>" onerror="this.src='../../img_professores/ico_professor.png'">
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
          <h1 class="h3 mb-1 text-gray-800">Enviar arquivos</h1>
          <p class="mb-4">No espaço abaixo, você professor pode enviar arquivos para serem baixados pelos seus alunos.</p>

          <!-- Content Row -->
          <div class="row">
<?php if($_GET['pg'] == 'envio_arquivos'){ ?>
<div id="box">

<?php if(isset($_POST['button'])){
	
@$trabalho = $_FILES['trabalho']['name'];
if($trabalho == ''){
	echo "<script language='javascript'>window.alert('Selecione o arquivo para enviar!');</script>";
}else{

if(file_exists("../trabalhos_alunos/$trabalho")){
			$a = 1;
			while(file_exists("../arquivos_professores/[$a]$trabalho")){
				$a++;
			}
			
			$trabalho = "[".$a."]".$trabalho;
			
		}	  
$date = date("d/m/Y H:i:s");


$sql_2 = mysqli_query($connect,"INSERT INTO arquivos_professor (date, disciplina, curso,arquivo) VALUES ('$date', '$dis', '$curso', '$trabalho')");

	(move_uploaded_file($_FILES['trabalho']['tmp_name'], "../arquivos_professores/".$trabalho));

    echo "<script language='javascript'>window.alert('Arquivo enviado com sucesso!');</script>";
    echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 }
}?>

<strong>ATENÇÃO:</strong> Estes arquivos irão aparecer no mural dos seus alunos.
<form name="" method="post" action="" enctype="multipart/form-data">
<table class="table table-bordered">
  <tr>
    <td>Clique na caixa abaixo para selecionar o arquivo</td>
  </tr>
  <tr>
    <td><label for="fileField"></label>
    <input type="file" name="trabalho" id="fileField"></td>
  </tr>
  <tr>
    <td><input class="btn btn-success" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
    
    
    
 <form action="" method="post">
<table class="table table-bordered">
    <tr>
    <td><strong>ID</strong></td>    
    <td><strong>Seus arquivos enviados para esta disciplina</strong></td>
    <td><strong>Ação</strong></td>
   </tr>
   <tr>
<?php 
            $trab = mysqli_query($connect,"SELECT * FROM arquivos_professor WHERE disciplina = '$dis'");
                if (mysqli_num_rows($trab)==''){
                    
                }else{
                    while($restrab = mysqli_fetch_array($trab)){
                        $id_t = $restrab['id'];
                        $arqiuvos = $restrab['arquivo'];
                        
    ?>  
    <td><input name ="id_t" class="form-control" type="text" value="<?php echo $id_t;?>"></td> 
    <td><a href="../arquivos_professores/<?php echo $arqiuvos;?>" target="_blank"><?php echo $arqiuvos;?></a></td>    
    <td><input class="btn btn-danger" type="submit" name="exc" id="button" value="Excluir"></td>
   </tr>

 <?php }}?>    
</table>    
</form>
<?php 
  if (isset($_POST['exc'])){
      $idtrab = $_POST['id_t'];
      $sql_3 = mysqli_query($connect,"DELETE FROM arquivos_professor WHERE id = '$idtrab'");
      
        echo "<script language='javascript'>window.alert('Arquivo deletado com sucesso!');</script>";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";   
  
  }                                        
                                          
?>

</div><!-- box -->
<?php } ?>
              

          </div>

        </div>
        <!-- /.container-fluid -->

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
