<?php require "header.php"; ?>
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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Abaixo segue seu histórico de trabalhos de suas turmas!</h1>

          </div>

          <!-- Content Row -->
          <div class="row">
<div id="box">

<?php if(isset($_POST['button'])){

$code_aluno = $_POST['code_aluno'];
$nota = $_POST['nota'];
$id_trabalho = $_POST['id_trabalho'];
$disciplina = $_POST['disciplina'];

$sql_3 = mysqli_query($connect,"UPDATE envio_de_trabalhos_extras SET status = 'Aceito', nota = '$nota' WHERE aluno = '$code_aluno' AND id_trabalho = '$id_trabalho' AND disciplina = '$disciplina'");

$sql_4  = mysqli_query($connect,"INSERT INTO notas_trabalhos (code, bimestre, disciplina, nota) VALUES ('$code_aluno', 'Trabalho extra', '$disciplina', '$nota')");

$sql_5 = mysqli_query($connect,"SELECT * FROM pontos_extras WHERE code = '$code_aluno' AND disciplina = '$disciplina'");
if(mysqli_num_rows($sql_5) == ''){
	mysqli_query($connect,"INSERT INTO pontos_extras (code, disciplina, nota) VALUES ('$code_aluno', '$disciplina', '$nota')");

	echo "<script language='javascript'>window.location='';</script>";		

}else{
	while($res_5 = mysqli_fetch_array($sql_5)){
			$nova_nota = $res_5['nota']+$nota;
			
	mysqli_query($connect,"UPDATE pontos_extras SET nota = '$nova_nota' WHERE code = '$code_aluno' AND disciplina = '$disciplina'");
			
	echo "<script language='javascript'>window.location='';</script>";		
			
		}
	
	}

}?>


<?php

$id = $_GET['id'];

$sql_1 = mysqli_query($connect,"SELECT * FROM envio_de_trabalhos_extras WHERE id_trabalho = '$id'");
if(mysqli_num_rows($sql_1) == ''){
	 echo "<h3>No momento não existe nenhum trabalho enviado para ser corrigido!</h3>";	 
}else{
	while($res_1 = mysqli_fetch_array($sql_1)){
		
$sql_extra = mysqli_query($connect,"SELECT * FROM trabalhos_extras WHERE id = '$id'");
	while($res_extra = mysqli_fetch_array($sql_extra)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table class="table table-bordered">
  <tr>
    <td><strong>Código:</strong></td>
    <td><strong>Nome do aluno:</strong></td>
    <td><strong>Trabalho:</strong></td>
    <td><strong>Data de envio:</strong></td>
    <td><strong>Nota máxima&nbsp;( <strong><em><?php echo $res_extra['pontos']; ?></em></strong> ):</strong></td>
    <td><strong>Ação</strong></td>
  </tr>
  <tr>
  <input type="hidden" name="code_aluno" value="<?php echo $res_1['aluno']; ?>" />
  <input type="hidden" name="disciplina" value="<?php echo $res_1['disciplina']; ?>" />
  <input type="hidden" name="id_trabalho" value="<?php echo $res_1['id_trabalho']; ?>" />
  <input type="hidden" name="bimestre" value="<?php echo $res_1['aluno']; ?>" />
    <td><?php echo $code_aluno = $res_1['aluno']; ?></td>
    <td>
    
    <?php
	$sql_2 = mysqli_query($connect,"SELECT * FROM estudantes WHERE code = '$code_aluno'");
		while($res_2 = mysqli_fetch_array($sql_2)){
				echo $res_2['nome'];
			}
	?>
    
    </td>
    <td><a class="btn btn-success" href="../trabalhos_alunos/<?php echo $res_1['trabalho']; ?>" target="_blank">Ver</a></td>
    <td><?php echo $res_1['date']; ?></td>
    
    <?php if($res_1['nota'] == ''){ ?>
    
    <td><input class="form-control" name="nota" type="text" id="textfield" size="2"></td>
    <td><input class="btn btn-success" type="submit" name="button" id="button" value="Concretizar">
    <a class="btn btn-danger" href="alunos_que_mostraram_trabalho_extra.php?pg=excluir&id=<?php echo $res_1['id']; ?>&id_t=<?php echo $_GET['id']; ?>">Excluir</a></td>
   <?php }else{ $nota = $res_1['nota']; echo "<td>Corrigido - Nota: <strong>$nota</strong></td>"; ?>
   <td>
       
    <a class="btn btn-warning" href="alterar_nota_trabalho.php?pg=trabalho_extra&id=<?php echo $res_1['id']; ?>&id_trabalho=<?php echo $_GET['id']; ?>&aluno=<?php echo $res_1['aluno']; ?>&disciplina=<?php echo $res_1['disciplina']; ?>&nota=<?php echo $res_1['nota']; ?>" rel="superbox[iframe][400x100]">Alterar Nota</a></td>
   <?php } ?>
  </tr>
</table>
</form>
<?php }}} ?>



<?php if(@$_GET['pg'] == 'excluir'){
	
$id = $_GET['id'];
$id_t = $_GET['id_t'];

mysqli_query($connect,"DELETE FROM envio_de_trabalhos_extras WHERE id = '$id' AND id_trabalho = '$id_t'");
echo "<script language='javascript'>window.location='alunos_que_mostraram_trabalho_extra.php?id=$id_t';</script>";


}?>


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

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
