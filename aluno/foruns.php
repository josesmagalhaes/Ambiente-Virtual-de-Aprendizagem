<?php require "header.php"; ?>
<?php
            $dis = base64_decode($_GET['dis']);
?>
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
                  <a class="dropdown-item text-center small text-gray-500" href="../aluno/mensagens.php">Ler todas as mensagens</a>
              </div>
              </li>
    <!-- Nav Item - Messages 2-->
<?php 
            $quant_men = mysqli_query($connect,"SELECT serie FROM estudantes WHERE code = '$code'");
                if (mysqli_num_rows($quant_men)==''){
                            $turmaPegar = "";
                }else{
                    while($resultados = mysqli_fetch_array($quant_men)){
                        $turmaPegar = $resultados['serie'];
                        }
                    }
?> 
              
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope-open-text"></i>
                <!-- Counter - Messages -->
                     <?php 
                    $quant_men = mysqli_query($connect,"SELECT COUNT(id) AS mensagem FROM central_agenda WHERE status = 'Aguarda resposta' and receptor = '$turmaPegar'");
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
                  Mensagens em Grupo
                </h6>
<?php
$sql_1 = mysqli_query($connect,"SELECT * FROM central_agenda WHERE status = 'Aguarda resposta' and receptor = '$turmaPegar'");

if(mysqli_num_rows($sql_1) == ''){
  $mensagem = "Não existe nenhuma mensagem."; 
}else{
  while($res_1 = mysqli_fetch_array($sql_1)){

?>                
                <a class="dropdown-item d-flex align-items-center" href="../aluno/agenda.php">
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
                  <a class="dropdown-item text-center small text-gray-500" href="../aluno/agenda.php">Ler todas as mensagens em grupo</a>
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
                <img class="img-profile rounded-circle" src="../../img_alunos/<?php echo $code; ?>" onerror="this.src='../../img_alunos/ico_aluno.png'">
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
            <h1 class="h3 mb-0 text-gray-800">Fóruns de : <?php echo $dis;?></h1>

          </div>

          <!-- Content Row -->
          <div class="row">
<?php 
            $i=1;  
            $foruns = mysqli_query($connect,"SELECT * FROM foruns WHERE disciplina = '$dis'");
                if (mysqli_num_rows($foruns)==''){
                    
                }else{
                    while($resfor = mysqli_fetch_array($foruns)){
                    $tema = $resfor['tema'];
                    $date = $resfor['date']; 
                    $status = $resfor['status']; 
                    $detalhes = $resfor['detalhes'];  
                    $entrega =  $resfor['data_entrega'];
                    $fotoanexo = $resfor['anexo'];  
    ?>                     


            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-4">
              <div class="card border-success mb-3" style="max-width: 100rem;">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <form method="post">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Fórum: <?php echo $i;?></div>
                        <input name="tema_<?php echo $i;?>" type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="<?php echo $tema;?>" readonly=“true”>
                          
                       <h8><strong>Lançado em: </strong><?php echo $date;?></h8> 
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $detalhes;?></div>
                        <td colspan="3">
                        <script src="https://cdn.ckeditor.com/4.14.0/full/ckeditor.js"></script>
                                    <textarea name="resposta_<?php echo $i;?>"></textarea>
                                    <script>
                                            CKEDITOR.replace( 'resposta_<?php echo $i;?>' );
                                    </script>       

                        </td>                          
<br>
                        <h8><strong>Limite de resposta: </strong><?php echo $entrega;?></h8><br>
                        <div class="h7 mb-0 font-weight-bold text-gray-800"><img width="280" src="../foruns/<?php echo $fotoanexo ;?>" onerror="this.src='../foruns/none.png'"></div><br> 
                        <button name="responder_<?php echo $i;?>" type="submit" class="btn btn-success">Responder com Texto</button> 
                    </form> 
                    </div>
                  </div><br>
              <form method="POST" enctype="multipart/form-data"> 
            <button type="submit" class="btn btn-info">Responder com Imagem</button>    
                <input type="file" name="pic" accept="image/*">    
         
</form> <br>         
    <?php
 if(isset($_FILES['pic']))
 {
    $ext = strtolower(substr($_FILES['pic']['name'],-4)); //Pegando extensão do arquivo
    $new_name = date("Y.m.d-H.i.s") .$code.$ext; //Definindo um novo nome para o arquivo 

    $dir = '../foruns/'; //Diretório para uploads 
    move_uploaded_file($_FILES['pic']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo

       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM estudantes WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $tema; 
       $resposta = "Envio de imagem em ".$data;
       $anexo = $new_name;
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta,anexo) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta','$anexo')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";     
 
 } 
?>                
                <!-- Respostas-->
<?php                     
            $respostas = mysqli_query($connect,"SELECT * FROM envio_de_foruns WHERE disciplina = '$dis' AND tema = '$tema'");
                if (mysqli_num_rows($respostas)==''){
                    
                }else{
                    while($resrespos = mysqli_fetch_array($respostas)){ 
                        $idd = $resrespos['id'];
                        $codigo_aluno = $resrespos['aluno_code'];
                        $nome_do_aluno = $resrespos['aluno_nome'];
                        $respostass = $resrespos['resposta'];
                        $datas = $resrespos['data'];
                        $fotoanexo = $resrespos['anexo'];
?>                       
                       <form method="post">
                        <div class="col-xl-9 col-md-6 mb-4">
                          <div class="card border-success mb-3" style="max-width: 100rem;">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">COMENTÁRIOS</div>
                                    <h9><strong>Respondido por: </strong><?php echo $nome_do_aluno;?> em: <?php echo $datas;?></h9> 
                                  <div class="h7 mb-0 font-weight-bold text-gray-800"><?php echo $respostass;?></div>
                                  <div class="h7 mb-0 font-weight-bold text-gray-800"><img width="280" src="../foruns/<?php echo $fotoanexo ;?>" onerror="this.src='../foruns/none.png'"></div>
                                </div>
                                 <?php
                                    if ($code==$codigo_aluno){
                                        $esseCodeAluno = $codigo_aluno;
                                        $esseResposta = $respostass;
                                ?>
                                <input type="submit" class="btn btn-danger btn-sm" name="excluir" value="Excluir">
                                <?php }?>
                              </div>
                            </div>
                        <div class="col-xl-9 col-md-6 mb-4">
                          <div class="card border-success mb-3" style="max-width: 100rem;">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
<?php                                    
                      
            $resFo = mysqli_query($connect,"SELECT * FROM resposta_forum WHERE id_forum = '$idd'");
                if (mysqli_num_rows($resFo)==''){
                    echo "<h9><strong>Não comentado</strong>";
                }else{
                    while($resFos= mysqli_fetch_array($resFo)){ 
                        $dataFo = $resFos['data'];
                        $prof = $resFos['professor'];
                        $coment = $resFos['comentario'];
?>                                    
                                    <h9><strong>Comentado por: <?php echo $prof;?></strong> em: <?php echo $dataFo;?></h9> 
                                  <div class="h7 mb-0 font-weight-bold text-gray-800"><?php echo $coment;?></div>
<?php }}?>                                    
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>                               
                          </div>
                        </div> 
                    </form> 
                    <?php }}?>
                </div>
              </div>
            </div>
             
<hr>
<?php $i++;}}?>            

<?php
   if (isset($_POST['excluir'])){
       

       $sqlDeletar = mysqli_query($connect,"DELETE FROM envio_de_foruns WHERE aluno_code = '$esseCodeAluno' AND resposta = '$esseResposta'");
       
       echo "<script language='javascript'>window.alert('Sua resposta foi excluída!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
       
   }             
?>              
              
              <!-- Content Row -->
<?php
   if (isset($_POST['responder_1'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM estudantes WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_1']; 
       $resposta = $_POST['resposta_1'];
       $anexo = "";
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta,anexo) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta','$anexo')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>
<?php
   if (isset($_POST['responder_2'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM estudantes WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_2']; 
       $resposta = $_POST['resposta_2'];
       $anexo = "";
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta,anexo) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta','$anexo')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>
<?php
   if (isset($_POST['responder_3'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM estudantes WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_3']; 
       $resposta = $_POST['resposta_3'];
       $anexo = "";
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta,anexo) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta','$anexo')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>                            
<?php
   if (isset($_POST['responder_4'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM estudantes WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_4']; 
       $resposta = $_POST['resposta_4'];
       $anexo = "";
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta,anexo) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta','$anexo')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>                            
              
          <div class="row">

            <!-- Area Chart -->


          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">


              </div>

            </div>
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
