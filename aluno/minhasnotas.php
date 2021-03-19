<?php require "header.php"; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-1 text-gray-800">Minhas Notas</h1>
          <p class="mb-4">No espaço abaixo, você aluno pode conferir as notas das avaliações feitas por você.</p>
 <?php 
        $nome_curso= mysqli_query($connect,"SELECT serie FROM estudantes WHERE code = '$code'");
            if (mysqli_num_rows($nome_curso)==''){
                $curso = "";
            }else{
                while($resultadosDis = mysqli_fetch_array($nome_curso)){
                    $curso = $resultadosDis['serie'];
                }
            }
?>   
 
          <!-- Content Row -->
        <form name="saber_nota" action="" method="post">
            <select class="custom-select custom-select-sm" name="disciplinaEnviar">
              <option >Selecione a disciplina</option>
<?php 
        $nome_dis = mysqli_query($connect,"SELECT disciplina FROM disciplinas WHERE curso = '$curso'");
            if (mysqli_num_rows($nome_dis)==''){
                $dsciplina = "";
            }else{
                while($resultadosDis = mysqli_fetch_array($nome_dis)){
                    $disciplina = $resultadosDis['disciplina'];
?>                 
              <option><?php echo $disciplina;?></option>
<?php }}?>                  
            </select>
            
            <br><br><button class="btn btn-success" type="submit" name="verificarNota">Verificar Nota</button>
        </form>
            
<?php
    if (isset($_POST['verificarNota'])){
        $aluno = $code;
        $disciplina = $_POST['disciplinaEnviar'];
        
        
?>
            <br><div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Confira suas notas!</h4>
              <p><?php echo "Suas notas em ".$disciplina." são:";?></p>
              <hr>
<?php            
        $nota = mysqli_query($connect,"SELECT mes, nota FROM notas WHERE aluno = '$aluno' and disciplina='$disciplina' ORDER BY `notas`.`mes` DESC");
        if (mysqli_num_rows($nota)==''){
            $notaAluno = "";
            }else{
            while($resultadosNotas = mysqli_fetch_array($nota)){
                $notaAluno = $resultadosNotas['nota'];
                $mesAluno = $resultadosNotas['mes'];

?>
              <p class="mb-0"><?php echo $mesAluno." - ".$notaAluno;?></p>
<?php }}?>              
<?php 
          $notaTrabalho = mysqli_query($connect,"SELECT date, nota FROM envio_de_trabalhos_extras WHERE aluno = '$aluno' and disciplina='$disciplina'");
        if (mysqli_num_rows($notaTrabalho)==''){
            $notaAlunoTrab = "";
            }else{
            while($resultadosNotasTrab = mysqli_fetch_array($notaTrabalho)){
                $notaAlunoTrab = $resultadosNotasTrab['nota'];
                $mesAlunoTrab = $resultadosNotasTrab['date'];  
    ?>            
              <p class="mb-0"><?php echo "Trabalho enviado em: ".$mesAlunoTrab." - ".$notaAlunoTrab;?></p>
    <?php }}}?>             
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
