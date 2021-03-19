<?php date_default_timezone_set('America/Fortaleza');?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/sistema.css">
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php require 'conexao.php' ?>
<!------ Itens inclusos acima do cabeçalho ---------->
<title>E-Escolar | Hesíchia de Sousa Brito</title>
<!--Bloco PHP  de requisição do login-->
    <?php if (isset($_POST['button'])){
        $code = $_POST['code'];
        $password = $_POST['password'];
    
    if($code == ''){
        echo "<h2>Por favor, digite seu CPF ou código de acesso!</h2>";
    }else if($password == ''){
        echo "<h2>Por favor, digite sua senha!</h2>";
    }else{
        $sql = "SELECT * FROM acesso_ao_sistema WHERE code = '$code' AND senha = '$password'";
        $sql_1 = mysqli_query($connect,$sql);
        
        $conta_sql_1 = mysqli_num_rows($sql_1);
        
        if($conta_sql_1 == ''){
            echo "<h2>O código de acesso, CPF ou senha não correspondem!</h2>";
        }else{
            
            while($res_1 = mysqli_fetch_array($sql_1)){
                $status = $res_1['status'];
                $code = $res_1['code'];
                $senha = $res_1['senha'];
                $nome = $res_1['nome'];
                $painel = $res_1['painel'];
                $datax = date('d/m/yy h:m:s');
                
                
            if($status == 'Inativo'){
                echo "<h2>Atenção aluno, você está inativo. Procure a coordenação.</h2>";
              }else{
                session_start();
                
                $_SESSION['code'] = $code;
                $_SESSION['nome'] = $nome;
                $_SESSION['password'] = $senha;
                $_SESSION['painel'] = $painel;
                
                if($painel == 'admin'){
                    $inserirAcesso = mysqli_query($connect,"INSERT INTO acessos (codigo,nome,acesso,data) VALUES ('$code','$nome','$painel','$datax')");
                    echo "<script language='javascript'>window.location='admin';</script>";
                }else if ($painel == 'Aluno'){
                    $inserirAcesso = mysqli_query($connect,"INSERT INTO acessos (codigo,nome,acesso,data) VALUES ('$code','$nome','$painel','$datax')");
                    echo "<script language='javascript'>window.location='aluno';</script>";
                }else if($painel == 'professor'){
                    $inserirAcesso = mysqli_query($connect,"INSERT INTO acessos (codigo,nome,acesso,data) VALUES ('$code','$nome','$painel','$datax')");
                    echo "<script language='javascript'>window.location='professor';</script>";
                }else{
                    echo "<h2>Acesso negado ao seu painel. Procure a coordenação. </h2>";
                }
            }    
           }
          }
         }
        }
        
        
?>
<style>
input[type=password] {
    background-color: #f6f6f6;
    border: none;
    color: #0d0d0d;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 5px;
    width: 85%;
    border: 2px solid #f6f6f6;
    -webkit-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -ms-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    -webkit-border-radius: 5px 5px 5px 5px;
    border-radius: 5px 5px 5px 5px;
}
input[type=password]:focus {
    background-color: #fff;
    border-bottom: 2px solid #5fbae9;
}

input[type=password]:placeholder {
    color: #cccccc;
}
</style>

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Título da tabela -->

    <!-- Ícone -->
    <div class="fadeIn first">
      <img src="imagens/logo4.png" id="icon" alt="User Icon" />
    </div>

    <!-- Formulário login -->
    <form name = "form" method="post">
      <input type="text" id="login" class="fadeIn second" name="code" placeholder="Usuário">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Senha">
      <button type="submit" name="button" class="btn btn-success mb-2">Entrar</button>
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="/index.php">Retornar ao painel?</a>
    </div>
  
  </div><br>
<div class="alert alert-success" role="alert">
    <strong>Problemas no acesso?</strong> Comunique nossa central:<br>
   <a href="https://web.whatsapp.com/send?phone=5586995978180">Atendente 1</a> | <a href="https://web.whatsapp.com/send?phone=5586994497569">Atendente 2</a> | <a href="https://web.whatsapp.com/send?phone=5586998501465">Atendente 3</a> | <a href="https://web.whatsapp.com/send?phone=5586999130035">Atendente 4</a>
</div>
</div>
<div class="alert alert-success" role="alert">
<a name="form-anchor"></a>
<div class="text-xs font-weight-bold text-success text-uppercase mb-1">&nbsp;&nbsp;&nbsp;Caro aluno, Encontre sua matrícula aqui</div>
    <div class="card-body">
 <form action="<?php echo $_SERVER["REQUEST_URI"];?>#form-anchor" method="post">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Escolha sua turma</label>
    <select name="tuma" class="form-control" id="exampleFormControlSelect1">
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
    </select>
  </div>
      <button type="submit" name="escolher" class="btn btn-success mb-2">Escolher Turma</button>
</form>  
    </div>
    
<?php 
    if (isset($_POST['escolher'])){
    $turmabuscar = $_POST['tuma'];
?>
  <div class="card-body">  
 <form action="<?php echo $_SERVER["REQUEST_URI"];?>#form-anchor" method="post">
  <div class="form-group">
    <label for="exampleFormControlSelect1">Escolha seu nome</label>
    <select name="alunoss" class="form-control" id="exampleFormControlSelect1">
<?php
              $sql_1 = mysqli_query($connect,"SELECT nome,serie FROM estudantes WHERE serie = '$turmabuscar'");
            
              if(mysqli_num_rows($sql_1) == ''){
              }else{
               while($res_1 = mysqli_fetch_array($sql_1)){
                 $aluno = $res_1['nome'];
                 $serie = $res_1['serie'];  
              ?>        
        
?>        
      <option><?php echo $aluno;?></option>
  <?php }}?>
    </select>
  </div>
      <button type="submit" name="escolherNome" class="btn btn-success mb-2">Escolher Nome</button>
</form>
    </div>
<?php }?>    

<?php 
    if (isset($_POST['escolherNome'])){
    $alunoNome = $_POST['alunoss'];

    $sql_2 = mysqli_query($connect,"SELECT cpf FROM estudantes WHERE nome = '$alunoNome' ");
            
        if(mysqli_num_rows($sql_2) == ''){
        }else{
            while($res_2 = mysqli_fetch_array($sql_2)){
                $alunocode = $res_2['cpf'];
                echo "<label for='exampleFormControlSelect1'>&nbsp;&nbsp;&nbsp;Sua matrícula é: <strong>".$alunocode."</strong>, use-a como usuário e senha.</label>";
                
            }
        }
    }
        
?>    
    
    </div> 





