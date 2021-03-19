<?php require "header.php"; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Suas Mensagens</h1>
          <p class="mb-4">Neste espaço, você têm acesso a todas as suas mensagens!</p>

          <!-- Content Row -->
          <div class="row">

            <!-- First Column -->
            <div class="col-lg-12">
            <?php
            $sql_1 = mysqli_query($connect,"SELECT * FROM central_mensagem WHERE receptor = '$code' ORDER BY `id` DESC");

            if(mysqli_num_rows($sql_1) == ''){
            }else{
              while($res_1 = mysqli_fetch_array($sql_1)){
            ?>    

              <!-- Custom Font Size Utilities -->
              <form method="post" action="">
                <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <?php
            $testar = $res_1['emissor'];
            $sqlCODENome = mysqli_query($connect,"SELECT nome FROM acesso_ao_sistema WHERE code = '$testar'");
            if (mysqli_num_rows($sqlCODENome)==''){
                $nomeCode = "";
                }else{
                while($resultadoss = mysqli_fetch_array($sqlCODENome)){
                $nomeCode= $resultadoss['nome'];
                }
            }                    
                 ?>       
                  <h6 class="m-0 font-weight-bold text-success"><?php echo $nomeCode;?></h6>
                </div>
                <div class="card-body">
                  <p class="text-xs"><?php echo $res_1['date'];?></p>
                <p class="text-xs"><?php echo "Situação: ".$res_1['status'];?></p> 
                  <p class="text-lg mb-0"><?php echo $res_1['mensagem'];?></p>
                  <textarea class="sr-only" name="id_enviar"><?php echo $res_1['id'];?></textarea>
                 <button type="submit" class="btn btn-warning mb-2" name="marcarLida">Marcar como Lida</button>
            <a href="responderprofessor.php?aluno_x=<?php echo base64_encode($testar);?>" type="button" class="btn btn-success mb-2" name="submeterNotificacaoTurma">Responder Mensagem</a>                    
                </div>
              </div>
<?php }}?></form>
            </div>
              
<?php
    if (isset($_POST['marcarLida'])){
        $id = $_POST['id_enviar'];

        $sql_4 = mysqli_query($connect,"UPDATE central_mensagem SET status ='Lida' WHERE receptor = '$code' and id='$id'");
        $executar = mysqli_query($connect,$sql_4);
        echo "<script language='javascript'>window.alert('Mensagem Marcada com Lida!');</script>";
        
    }
?> 



          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
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
