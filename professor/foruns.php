<?php require "header.php"; ?>

  <title>E-Escolar | Professor | Fóruns</title>
<?php
            $dis = base64_decode($_GET['dis']);
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
                    $idForum = $resfor['id'];
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
                        <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                        <textarea name="resposta_<?php echo $i;?>"></textarea>
                        <script>
                        CKEDITOR.replace( 'resposta_<?php echo $i;?>' );
                        </script> <br>                          

                        <div class="h7 mb-0 font-weight-bold text-gray-800"><img width="280" src="../foruns/<?php echo $fotoanexo ;?>" onerror="this.src='../foruns/none.png'" ></div>  
                        <button name="responder_<?php echo $i;?>" type="submit" class="btn btn-primary">Comentar para Todos</button>
                        <a href="../professor/editar_foruns.php?idForum=<?php echo base64_encode($idForum); ?>&" type="button" class="btn btn-warning">Editar Fórum</a>
                        <button name="deletar_<?php echo $i;?>" type="submit" class="btn btn-danger">Excluir Fórum</button><br>  
                        <h8><strong>Limite de resposta: </strong><?php echo $entrega;?></h8>
                    </form>      
                    </div>
                  </div><br>
                <!-- Respostas-->
<?php        
            $j = 1;            
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
?>                       <form method="post">
                        <div class="col-xl-9 col-md-6 mb-4">
                          <div class="card border-success mb-3" style="max-width: 100rem;">
                            <div class="card-body">
                              <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">CÓDIGO DO COMENTÁRIO<input name="id_forum_<?php echo $j;?>" type="text" value="<?php echo $idd;?>" class="form-control sm" style="border: 0 none;" readonly=“true”></div>
                                    <h9><strong>Respondido por: </strong><?php echo $nome_do_aluno;?> em: <?php echo $datas;?></h9> 
                                  <div class="h7 mb-0 font-weight-bold text-gray-800"><?php echo $respostass;?></div>
                                    <div class="h7 mb-0 font-weight-bold text-gray-800"><img width="280"  src="../foruns/<?php echo $fotoanexo ;?>" onerror="this.src='../foruns/none.png'"></div>
                                </div>
                                  <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
                                    <textarea name="comentario_<?php echo $j;?>"></textarea>
                                    <script>
                                            CKEDITOR.replace( 'comentario_<?php echo $j;?>' );
                                    </script>
                                    </div><br>
                                  <input type="submit" class="btn btn-success btn-sm" name="coment_<?php echo $j;?>" value="Comentar">
                                 <?php
                                    if ($code==$codigo_aluno){
                                        $esseCodeAluno = $codigo_aluno;
                                        $esseResposta = $respostass;
                                ?>
                                <input type="submit" class="btn btn-danger btn-sm" name="excluir" value="Excluir">
                                <?php }?>
                                  
                              
                                
                            </div>
                        <div class="col-xl-9 col-md-6 mb-4">
                          <div class="card border-success mb-3" style="max-width: 80rem;">
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
                    <?php $j++; }}?>
                </div>
              </div>
            </div>
             
<hr>
<?php $i++; }}?>
              
 <?php
   if (isset($_POST['coment_1'])){     
       $id_forum = $_POST['id_forum_1'];
       $comentarioForum = $_POST['comentario_1'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
   
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_2'])){     
       $id_forum = $_POST['id_forum_2'];
       $comentarioForum = $_POST['comentario_2'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_3'])){     
       $id_forum = $_POST['id_forum_3'];
       $comentarioForum = $_POST['comentario_3'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_4'])){     
       $id_forum = $_POST['id_forum_4'];
       $comentarioForum = $_POST['comentario_4'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_5'])){     
       $id_forum = $_POST['id_forum_5'];
       $comentarioForum = $_POST['comentario_5'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_6'])){     
       $id_forum = $_POST['id_forum_6'];
       $comentarioForum = $_POST['comentario_6'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_7'])){     
       $id_forum = $_POST['id_forum_7'];
       $comentarioForum = $_POST['comentario_7'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_8'])){     
       $id_forum = $_POST['id_forum_8'];
       $comentarioForum = $_POST['comentario_8'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_9'])){     
       $id_forum = $_POST['id_forum_9'];
       $comentarioForum = $_POST['comentario_9'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_10'])){     
       $id_forum = $_POST['id_forum_10'];
       $comentarioForum = $_POST['comentario_10'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_11'])){     
       $id_forum = $_POST['id_forum_11'];
       $comentarioForum = $_POST['comentario_11'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_12'])){     
       $id_forum = $_POST['id_forum_12'];
       $comentarioForum = $_POST['comentario_12'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_13'])){     
       $id_forum = $_POST['id_forum_13'];
       $comentarioForum = $_POST['comentario_13'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_14'])){     
       $id_forum = $_POST['id_forum_14'];
       $comentarioForum = $_POST['comentario_14'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_15'])){     
       $id_forum = $_POST['id_forum_15'];
       $comentarioForum = $_POST['comentario_15'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_16'])){     
       $id_forum = $_POST['id_forum_16'];
       $comentarioForum = $_POST['comentario_16'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_17'])){     
       $id_forum = $_POST['id_forum_17'];
       $comentarioForum = $_POST['comentario_17'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_18'])){     
       $id_forum = $_POST['id_forum_18'];
       $comentarioForum = $_POST['comentario_18'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_19'])){     
       $id_forum = $_POST['id_forum_19'];
       $comentarioForum = $_POST['comentario_19'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_20'])){     
       $id_forum = $_POST['id_forum_20'];
       $comentarioForum = $_POST['comentario_20'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_21'])){     
       $id_forum = $_POST['id_forum_21'];
       $comentarioForum = $_POST['comentario_21'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_22'])){     
       $id_forum = $_POST['id_forum_22'];
       $comentarioForum = $_POST['comentario_22'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_23'])){     
       $id_forum = $_POST['id_forum_23'];
       $comentarioForum = $_POST['comentario_23'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_24'])){     
       $id_forum = $_POST['id_forum_24'];
       $comentarioForum = $_POST['comentario_24'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_25'])){     
       $id_forum = $_POST['id_forum_25'];
       $comentarioForum = $_POST['comentario_25'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_26'])){     
       $id_forum = $_POST['id_forum_26'];
       $comentarioForum = $_POST['comentario_26'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_27'])){     
       $id_forum = $_POST['id_forum_27'];
       $comentarioForum = $_POST['comentario_27'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_28'])){     
       $id_forum = $_POST['id_forum_28'];
       $comentarioForum = $_POST['comentario_28'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_29'])){     
       $id_forum = $_POST['id_forum_29'];
       $comentarioForum = $_POST['comentario_29'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_30'])){     
       $id_forum = $_POST['id_forum_30'];
       $comentarioForum = $_POST['comentario_30'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_31'])){     
       $id_forum = $_POST['id_forum_31'];
       $comentarioForum = $_POST['comentario_31'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_32'])){     
       $id_forum = $_POST['id_forum_32'];
       $comentarioForum = $_POST['comentario_32'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_33'])){     
       $id_forum = $_POST['id_forum_33'];
       $comentarioForum = $_POST['comentario_33'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_32'])){     
       $id_forum = $_POST['id_forum_32'];
       $comentarioForum = $_POST['comentario_32'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_33'])){     
       $id_forum = $_POST['id_forum_33'];
       $comentarioForum = $_POST['comentario_33'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_34'])){     
       $id_forum = $_POST['id_forum_34'];
       $comentarioForum = $_POST['comentario_34'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_35'])){     
       $id_forum = $_POST['id_forum_35'];
       $comentarioForum = $_POST['comentario_35'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_36'])){     
       $id_forum = $_POST['id_forum_36'];
       $comentarioForum = $_POST['comentario_36'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_37'])){     
       $id_forum = $_POST['id_forum_37'];
       $comentarioForum = $_POST['comentario_37'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_38'])){     
       $id_forum = $_POST['id_forum_38'];
       $comentarioForum = $_POST['comentario_38'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_39'])){     
       $id_forum = $_POST['id_forum_39'];
       $comentarioForum = $_POST['comentario_39'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_40'])){     
       $id_forum = $_POST['id_forum_40'];
       $comentarioForum = $_POST['comentario_40'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_41'])){     
       $id_forum = $_POST['id_forum_41'];
       $comentarioForum = $_POST['comentario_41'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_42'])){     
       $id_forum = $_POST['id_forum_42'];
       $comentarioForum = $_POST['comentario_42'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_43'])){     
       $id_forum = $_POST['id_forum_43'];
       $comentarioForum = $_POST['comentario_43'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_44'])){     
       $id_forum = $_POST['id_forum_44'];
       $comentarioForum = $_POST['comentario_44'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_45'])){     
       $id_forum = $_POST['id_forum_45'];
       $comentarioForum = $_POST['comentario_45'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_46'])){     
       $id_forum = $_POST['id_forum_46'];
       $comentarioForum = $_POST['comentario_46'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_47'])){     
       $id_forum = $_POST['id_forum_47'];
       $comentarioForum = $_POST['comentario_47'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_48'])){     
       $id_forum = $_POST['id_forum_48'];
       $comentarioForum = $_POST['comentario_48'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_49'])){     
       $id_forum = $_POST['id_forum_49'];
       $comentarioForum = $_POST['comentario_49'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }else if (isset($_POST['coment_50'])){     
       $id_forum = $_POST['id_forum_50'];
       $comentarioForum = $_POST['comentario_50'];
       $dataX = date('d/m/yy');
       
       $prof_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $prof_nome = $resfor_nomess['nome'];
                    }
                }       
       
       $inserir_forum_resposta = mysqli_query($connect,"INSERT INTO resposta_forum (id_forum, professor, data, comentario) VALUES ('$id_forum','$prof_nome','$dataX','$comentarioForum')");
       
       
       echo "<script language='javascript'>window.alert('Seu comentário foi submetido!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
 
   }
?>

              
 <?php
   if (isset($_POST['deletar_1'])){             

       $dis = $dis;
       $temax = $_POST['tema_1'];   
       
       $sqlexcluir = mysqli_query($connect,"DELETE FROM foruns WHERE professor = '$code' AND disciplina = '$dis' and tema = '$temax'");
       
       echo "<script language='javascript'>window.alert('Seu fórum foi excluído!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
       
   }else if (isset($_POST['deletar_2'])){             

       $dis = $dis;
       $temax = $_POST['tema_2'];   
       
       $sqlexcluir = mysqli_query($connect,"DELETE FROM foruns WHERE professor = '$code' AND disciplina = '$dis' and tema = '$temax'");
       
       echo "<script language='javascript'>window.alert('Seu fórum foi excluído!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
       
   }else if (isset($_POST['deletar_3'])){             

       $dis = $dis;
       $temax = $_POST['tema_3'];   
       
       $sqlexcluir = mysqli_query($connect,"DELETE FROM foruns WHERE professor = '$code' AND disciplina = '$dis' and tema = '$temax'");
       
       echo "<script language='javascript'>window.alert('Seu fórum foi excluído!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
       
   }else if (isset($_POST['deletar_4'])){             

       $dis = $dis;
       $temax = $_POST['tema_4'];   
       
       $sqlexcluir = mysqli_query($connect,"DELETE FROM foruns WHERE professor = '$code' AND disciplina = '$dis' and tema = '$temax'");
       
       echo "<script language='javascript'>window.alert('Seu fórum foi excluído!');</script>";
       echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
       
   }
?>               
              
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
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_1']; 
       $resposta = "PROFESSOR: ".$_POST['resposta_1'];
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>
<?php
   if (isset($_POST['responder_2'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_2']; 
       $resposta = "PROFESSOR: ".$_POST['resposta_2'];
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>
<?php
   if (isset($_POST['responder_3'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_3']; 
       $resposta = "PROFESSOR: ".$_POST['resposta_3'];
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta')");
       
      echo "<script language='javascript'>window.alert('Comentário submetido!');</script>";
      echo "<meta HTTP-EQUIV='refresh' CONTENT='0'>";
  
   }
          
?>                            
<?php
   if (isset($_POST['responder_4'])){
       
       $aluno_code = $code;
       
        $nomess = mysqli_query($connect,"SELECT nome FROM professores WHERE code = '$code'");
                if (mysqli_num_rows($nomess)==''){
                    
                }else{
                    while($resfor_nomess = mysqli_fetch_array($nomess)){
                    $aluno_nome = $resfor_nomess['nome'];
                    }
                }
                                                                        
                        
                        
       $data = date('d/m/yy');
       $dis = $dis;
       $temax = $_POST['tema_4']; 
       $resposta = "PROFESSOR: ".$_POST['resposta_4'];
       
       $inserir_forum = mysqli_query($connect,"INSERT INTO envio_de_foruns (aluno_code,aluno_nome,data,disciplina,tema,resposta) VALUES ('$aluno_code','$aluno_nome','$data','$dis','$temax','$resposta')");
       
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
