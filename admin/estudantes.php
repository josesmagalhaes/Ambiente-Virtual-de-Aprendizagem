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
          <h1 class="h3 mb-2 text-gray-800">Estudantes</h1>
          <p class="mb-4">Abaixo todos os estudantes do ano letivo de 2020. </p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-success">Lista de Estudantes</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
               <?php
                  $sql_1 = mysqli_query($connect,"SELECT * FROM estudantes WHERE nome != ''");
                  if(mysqli_num_rows($sql_1) == ''){
                    echo "No momento não existe estudantes cadastrados!";
                  }else{
              ?> 
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                      <td><h4>Status</td></h4>
                      <td><h4>Código</td></h4>
                      <th><h4>Nome</th></h4>
                      <th><h4>Série</th></h4>
                      <th><h4>Ações</th></h4>
                    </tr>
                    <?php while($res_1 = mysqli_fetch_array($sql_1)){ ?>
                    <tr>
                    <tr>
                    <td><h5><?php echo $code = $res_1['status']; ?></h5></td>
                    <td><h5><?php echo $res_1['code']; ?></h5></td>
                    <td><h5><?php echo $res_1['nome']; ?></h5></td>
                    <td><h5><?php echo $res_1['serie']; ?></h5></td>
                    <td>
                    <a class="a" href="estudantes.php?pg=todos&func=deleta&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><i title="Excluir Estudante" class="fas fa-trash-alt"></i></a>
                    <?php if($res_1['status'] == 'Inativo'){?>
                    <a class="a" href="estudantes.php?pg=todos&func=ativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><i title="Ativar Estudante" class="fas fa-check-circle"></i></a>
                    <?php } ?>
                    <?php if($res_1['status'] == 'Ativo'){?>
                    <a class="a" href="estudantes.php?pg=todos&func=inativa&id=<?php echo $res_1['id']; ?>&code=<?php echo $res_1['code']; ?>"><i title="Inativar Estudante" class="fas fa-ban"></i></a>
                    <?php } ?>
                    <a class="a" href="estudantes.php?pg=todos&func=edita&id=<?php echo $res_1['id']; ?>"><i title="Editar Estudante" class="fas fa-edit"></i></a>

                    <a class="a" rel="superbox[iframe][930x500]" href="mostrar_resultado.php?q=<?php echo $res_1['code']; ?>&s=aluno&curso=<?php echo $res_1['serie']; ?>"><i title="Histórico deste Estudante" class="fas fa-eye"></i></a></td>
                  </tr>
                  <?php } ?> 
                  <?php }?>
<!-- Todo o bloco PHP ficará neste espaço-->
                  <!--Função deleta-->
                  <?php if(@$_GET['func'] == 'deleta'){

                  $id = $_GET['id'];
                  $code = $_GET['code'];

                  mysqli_query($connect,"DELETE FROM estudantes WHERE id = '$id'");
                  mysqli_query($connect,"DELETE FROM acesso_ao_sistema WHERE code = '$code'");
                  echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
                  }?>

                  <!--Função Ativa-->
                  <?php if(@$_GET['func'] == 'ativa'){

                  $id = $_GET['id'];
                  $code = $_GET['code'];

                  mysqli_query($connect,"UPDATE estudantes SET status = 'Ativo' WHERE id = '$id'");
                  mysqli_query($connect,"UPDATE acesso_ao_sistema SET status = 'Ativo' WHERE code = '$code'");
                  echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
                  }?>

                  <!--Função Inativa-->
                  <?php if(@$_GET['func'] == 'inativa'){

                  $id = $_GET['id'];
                  $code = $_GET['code'];

                  mysqli_query($connect,"UPDATE estudantes SET status = 'Inativo' WHERE id = '$id'");
                  mysqli_query($connect,"UPDATE acesso_ao_sistema SET status = 'Inativo' WHERE code = '$code'");
                  echo "<script language='javascript'>window.location='estudantes.php?pg=todos';</script>";
                  }?>

                  <?php if(@$_GET['func'] == 'edita'){ ?>
                  <?php
                  $id = $_GET['id'];

                  $sql_1 = mysqli_query($connect,"SELECT * FROM estudantes WHERE id = '$id'");
                    while($res_1 = mysqli_fetch_array($sql_1)){
                  ?>

                  <?php if(isset($_POST['button'])){
                  $id = $_GET['id'];
                  $nome = $_POST['nome'];
                  $cpf = $_POST['cpf'];
                  $rg = $_POST['rg'];
                  $nascimento = $_POST['nascimento'];
                  $mae = $_POST['mae'];
                  $pai = $_POST['pai'];
                  $atendimento_especial = $_POST['atendimento_especial'];
                  $estado = $_POST['estado'];
                  $cidade = $_POST['cidade'];
                  $bairro = $_POST['bairro'];
                  $endereco = $_POST['endereco'];
                  $complemento = $_POST['complemento'];
                  $tel_residencial = $_POST['tel_residencial'];
                  $cep = $_POST['cep'];
                  $celular = $_POST['celular'];
                  $obs = $_POST['obs'];
                  $serie = $_POST['serie'];        


                  $sql_2 = mysqli_query($connect,"UPDATE estudantes SET nome = '$nome', cpf = '$cpf', rg = '$rg', nascimento = '$nascimento', mae = '$mae', pai = '$pai', estado = '$estado', cidade = '$cidade', bairro = '$bairro', endereco = '$endereco', complemento = '$complemento', tel_residencial = '$tel_residencial', cep = '$cep', celular = '$celular', serie = '$serie', atendimento_especial = '$atendimento_especial', obs = '$obs' WHERE id = '$id'");
                          
                        
                  if($sql_2 == ''){
                    echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
                      
                  }else{
                    echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='estudantes.php?pg=todos';</script>";

                  }}?>
                  <div>
                    <div>
                      <div>
                  <form name="form1" method="post" action="" enctype="multipart/form-data">
                    <table class="table table-striped">
                      <tr>
                        <th scope="col">Nome:</th>
                        <th scope="col">CPF</th>
                        <th scope="col">RG:</th>
                      </tr>
                      <tr>
                        <td><label for="textfield2"></label>
                        <input class="form-control form-control-sm" type="text" name="nome" id="textfield2" value="<?php echo $res_1['nome']; ?>"></td>
                        <td><label for="textfield3"></label>
                        <input class="form-control form-control-sm" type="text" name="cpf" id="textfield3" value="<?php echo $res_1['cpf']; ?>"></td>

                        <td><label for="textfield3"></label>
                          <input class="form-control form-control-sm" type="text" name="rg" id="textfield8" value="<?php echo $res_1['rg']; ?>"></td>
                      </tr>
                      <tr>
                        <th scope="col">Data de nascimento:</th>
                        <th scope="col">Mãe:</th>
                        <th scope="col">Pai:</th>
                      </tr>
                      <tr>
                        <td><label for="textfield4"></label>
                        <input class="form-control form-control-sm" type="text" name="nascimento" id="textfield4" value="<?php echo $res_1['nascimento']; ?>"></td>
                        <td><label for="textfield4"></label>
                        <input class="form-control form-control-sm" type="text" name="mae" id="textfield4" value="<?php echo $res_1['mae']; ?>"></td>
                         <td><label for="textfield4"></label>
                        <input class="form-control form-control-sm" type="text" name="pai" id="textfield4" value="<?php echo $res_1['pai']; ?>"></td>                       
                      </tr>
                      <tr>
                        <th scope="col">Telefone residencial: </th>
                        <th scope="col">Celualar:</th>
                        <th scope="col">Serie:</th>
                      </tr>
                      <tr>
                        <td><input class="form-control form-control-sm" type="text" name="tel_residencial" id="textfield6" value="<?php echo $res_1['tel_residencial']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="celular" id="textfield7" value="<?php echo $res_1['celular']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="serie" id="textfield8" value="<?php echo $res_1['serie']; ?>"></td>
                      </tr>
                        <th scope="col">Estado: </th>
                        <th scope="col">Cidade:</th>
                        <th scope="col">Bairro:</th>
                      </tr>
                      <tr>
                        <td><input class="form-control form-control-sm" type="text" name="estado" id="textfield6" value="<?php echo $res_1['estado']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="cidade" id="textfield7" value="<?php echo $res_1['cidade']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="bairro" id="textfield8" value="<?php echo $res_1['bairro']; ?>"></td>
                      </tr>
                      </tr>
                        <th scope="col">Endereco: </th>
                        <th scope="col">Complemento:</th>
                        <th scope="col">CEP:</th>
                      </tr>
                      <tr>
                        <td><input class="form-control form-control-sm" type="text" name="endereco" id="textfield6" value="<?php echo $res_1['endereco']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="complemento" id="textfield7" value="<?php echo $res_1['complemento']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="cep" id="textfield8" value="<?php echo $res_1['cep']; ?>"></td>
                      </tr>
                      </tr>
                        <th scope="col">Atendimento Especial: </th>
                        <th scope="col">Observações:</th>
                      </tr>
                      <tr>
                        <td><input class="form-control form-control-sm" type="text" name="atendimento_especial" id="textfield6" value="<?php echo $res_1['atendimento_especial']; ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" name="obs" id="textfield7" value="<?php echo $res_1['obs']; ?>"></td>
                      </tr>
                      <tr>
                        <td><input class="btn btn-success" type="submit" name="button" id="button" value="Atualizar"></td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
                  <?php } ?>
                  </form>
                  <?php } ?>
                  <br />
                  </div>
                  </div>
                  </div>
                </div><!-- box_professores -->
                <a class="btn btn-success" href="/admin/estudantes.php" role="button">Home</a>
                <a class="btn btn-success" href="estudantes.php?pg=cadastra&bloco=1" role="button" >Cadastrar novo estudante</a>
                <!-- Fim do bloco de cadastro-->
                <?php if(@$_GET['pg'] == 'cadastra'){ ?>
                <?php if(@$_GET['bloco'] == '1'){ ?>
                <div id="cadastra_estudante">

                <?php if(isset($_POST['button'])){

                $code = $_POST['code'];
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $rg = $_POST['rg'];
                $nascimento = $_POST['nascimento'];
                $mae = $_POST['mae'];
                $pai = $_POST['pai'];
                $estado = $_POST['estado'];
                $cidade = $_POST['cidade'];
                $bairro = $_POST['bairro'];
                $endereco = $_POST['endereco'];
                $complemento = $_POST['complemento'];
                $tel_residencial = $_POST['tel_residencial'];
                $cep = $_POST['cep'];
                $celular = $_POST['celular'];
                $tel_amigo = $_POST['tel_amigo'];

                $sql_2 = mysqli_query($connect,"INSERT INTO estudantes (code, status, nome, cpf, rg, nascimento, mae, pai, estado, cidade, bairro, endereco, complemento, cep, tel_residencial, celular, tel_amigo) VALUES ('$code', 'Ativo', '$nome', '$cpf', '$rg', '$nascimento', '$mae', '$pai', '$estado', '$cidade', '$bairro', '$endereco', '$complemento', '$cep', '$tel_residencial', '$celular', '$tel_amigo')");
                mysqli_query($connect,"INSERT INTO acesso_ao_sistema (status, code, senha, nome, painel) VALUES ('Ativo', '$code', '$cpf', '$nome', 'Aluno')");

                echo "<script language='javascript'>window.alert('Dados cadastrados com sucesso! Click em OK para avançar');window.location='estudantes.php?pg=cadastra&bloco=2&code=$code';</script>";

                }?> 
                 <div>
                  <div>
                    <div>
                <form name="form1" method="post" action="">
                  <table class="table table-striped">
                  <tr>
                     <td></td>
                     <td colspan="2"><strong><h5>Código único do aluno</h5></strong></td>
                     <td></td>
                    </tr>
                    <tr>
                     <td></td>
                     <?php 
                   $sql_1 = mysqli_query($connect,"SELECT * FROM estudantes ORDER BY id DESC LIMIT 1");
                   if(mysqli_num_rows($sql_1) == ''){
                     $novo_code = "587418";
                  ?>
                      <td><input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                      <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />    
                    <?php
                     }else{
                   
                    while($res_1 = mysqli_fetch_array($sql_1)){
                      $novo_code = $res_1['code']+741+$res_1['id'];
                   ?>
                      <td><input class="form-control form-control-sm" type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_code; ?>"></td>
                      <input type="hidden" name="code" value="<?php echo $novo_code; ?>" />
                     <?php } } ?>
                     <td></td>
                    </tr>    
                    <tr>
                      <th scope="col">Nome:</th>
                      <th scope="col">CPF:</th>
                      <th scope="col">RG:</th>
                    </tr>
                      <td><label for="celular"></label>
                      <input class="form-control form-control-sm" type="text" name="nome" id="textfield2"></td>
                      <td><label for="tel_amigo"></label>
                      <input class="form-control form-control-sm" type="text" name="cpf" id="textfield3"></td>
                      <td><label for="tel_amigo"></label>
                      <input class="form-control form-control-sm" type="text" name="rg" id="textfield3"></td>
                    </tr>
                    <tr>
                      <th scope="col">Data de nascimento:</th>
                      <th scope="col">Nome da mãe:</th>
                      <th scope="col">Nome do Pai:</th>
                    </tr>
                    <tr>
                      <td><label for="nascimento"></label>
                      <input class="form-control form-control-sm" type="text" name="nascimento" id="textfield4"></td>
                      <td><label for="mae"></label>
                      <input class="form-control form-control-sm" type="text" name="mae" id="textfield12"></td>
                      <td><label for="pai"></label>
                      <input class="form-control form-control-sm" type="text" name="pai" id="textfield5"></td>
                    </tr>
                    <tr>
                      <th scope="col">Estado:</th>
                      <th scope="col">Cidade:</th>
                      <th scope="col">Bairro:</th>
                    </tr>
                    <tr>
                      <td><input class="form-control form-control-sm" type="text" name="estado" id="textfield6"></td>
                      <td><input class="form-control form-control-sm" type="text" name="cidade" id="textfield7"></td>
                      <td><input class="form-control form-control-sm" type="text" name="bairro" id="textfield8"></td>
                    </tr>
                    <tr>
                      <th scope="col">Endereço:</th>
                      <th scope="col">Complemento:</th>
                      <th scope="col">Cep:</th>
                    </tr>
                    <tr>
                      <td><input class="form-control form-control-sm" type="text" name="endereco" id="textfield8"></td>
                      <td><input class="form-control form-control-sm" type="text" name="complemento" id="textfield8"></td>
                      <td><input class="form-control form-control-sm" type="text" name="cep" id="textfield8"></td>
                    </tr>
                    <tr>
                      <th scope="col">Telefone residencial:</th>
                      <th scope="col">Telefone Celular:</th>
                      <th scope="col">Telefone de um amigo:</th>
                    </tr>
                    <tr>
                      <td><input class="form-control form-control-sm" type="text" name="tel_residencial" id="textfield9"></td>
                      <td><input class="form-control form-control-sm" type="text" name="celular" id="textfield10"></td>
                      <td><input class="form-control form-control-sm" type="text" name="tel_amigo" id="textfield11"></td>
                    </tr>
                    <tr>
                      <td><input class="btn btn-success" type="submit" name="button" id="button" value="Avançar"></td>
                      <td>&nbsp;</td>
                      <td>&nbsp;</td>
                    </tr>
                  </table>
                </form>
                <br /> 
                </div>
                </div>
                </div>
                </div><!-- cadastra_estudante -->

                <?php }}?>
                <?php if(@$_GET['bloco'] == '2'){ ?>
                <div id="cadastra_estudante">
                <h1>Cadastrar novo estudante</h1>
                <?php if(isset($_POST['button'])){

                $code = $_GET['code'];
                $serie = $_POST['serie'];
                $turno = $_POST['turno'];
                $cuidado_especial = $_POST['cuidado_especial'];
                $obs = $_POST['obs'];

                $sql_2 = mysqli_query($connect,"UPDATE estudantes SET serie = '$serie', turno = '$turno', atendimento_especial = '$cuidado_especial', obs = '$obs' WHERE code = '$code'");

                echo "<script language='javascript'>window.alert('Cadastro concluído com sucesso! Click em OK para retornar');window.location='estudantes.php?pg=todos';</script>";

                }?> 

                <div>
                  <div>
                    <div>
              <form name="form1" method="post" action="">
                <table class="table table-striped">
                  <tr>
                    <th scope="col">Série que este aluno vai se matricular:</th>
                    <th scope="col">Turno:</th>
                    <th scope="col">Cuidado Especial</th>
                  </tr>
                  <tr>
                    <td><label for="serie"></label>
                    <select name="serie" id="serie" class="form-control form-control-sm">
                    <?php
                    $sql_1 = mysqli_query($connect,"SELECT * FROM cursos");
                    while($res_1 = mysqli_fetch_array($sql_1)){
                  ?>  
                      <option value="<?php echo $res_1['curso']; ?>"><?php echo $res_1['curso']; ?></option>
                    <?php } ?>
                    </select>
                    </td>
                    <td><label for="turno"></label>
                      <select name="turno" class="form-control form-control-sm">
                        <option value="Manhã">Manhã</option>
                        <option value="Tarde">Tarde</option>
                        <option value="Noite">Noite</option>
                    </select></td>
                    <td><label for="cuidado_especial"></label>
                      <select name="cuidado_especial" class="form-control form-control-sm">
                        <option value="SIM">SIM</option>
                        <option value="NÃO">NÃO</option>
                    </select></td>
                  </tr>
                  <tr>
                    <th scope="col">Observações para este(a) aluno(a)</th>
                    <th scope="col">&nbsp;</th>
                    <th scope="col">&nbsp;</th>
                  </tr>
                  <tr>
                    <td colspan="3"><label for="obs"></label>
                    <textarea name="obs" class="form-control z-depth-1" name="obs" rows="8" style="height:auto !important;"></textarea></td>
                  </tr>
                  <tr>
                    <td><input class="btn btn-success" type="submit" name="button" id="button" value="Finalizar"></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
              </form>
              <br />
               
              </div>
              </div>
              </div>
              </div>
              <!-- cadastra_estudante -->


              <?php }// aqui fecha o bloco 2 ?>


              <?php if(@$_GET['bloco'] == '3'){ ?>
              <div id="cadastra_estudante">
               <table>
              <tr>
              <td>
              <h4>Este(a) Estudante foi cadastrado perfeitamente no sistema!<h4></h4>
              <ul>
               <li>Este estudante já tem acesso ao sistema usando seu código e seu CPF como senha!</li>
              </ul>
              <a href="estudantes.php?pg=todos">Clique aqui para voltar para página inicial</a>
              </h4>
              </td>
              </tr>
              </table>
              <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
              </div><!-- cadastra_estudante -->


              <?php }// aqui fecha o bloco 3 ?>


            

<!-- Fim dos blocos de PHP.-->


                  <tfoot>
                  </tbody>
                </table>
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
