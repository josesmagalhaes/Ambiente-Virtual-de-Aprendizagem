<!doctype html>
<html>
<head>
<?php require "../conexao.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<title>E-Escolar | Professor | Alunos</title>
</head>

<div align="center">
  <table class="table-responsive">
    <tr>
      <td><img src="../imagens/logoEscola.png"></td>
<?php 
            $dados = mysqli_query($connect,"SELECT * FROM dados_escola");
                if (mysqli_num_rows($dados)==''){
                    
                }else{
                    while($resuldados = mysqli_fetch_array($dados)){

?>         
      <td><h6><font face="arial"></font><?php echo $resuldados['nome']; ?><br>
          <?php echo $resuldados['endereco']; ?><br>
          <?php echo $resuldados['cidade_estado']; ?>
          </h6><br>
<?php }}?>          
      </td>
    </tr>
  </table>
</div>
<br>
<h5 align="center">RELATÓRIO DE ALUNOS</h5>

<body>
<div align="center">
<script language="javascript">
window.print() 
</script>
<br>


<?php 
$s = base64_decode($_GET['s']);
$sql_1 = mysqli_query($connect,$s);
?>
<div class="table-responsive-md" align="center">
<table class="table table-bordered">
  <tr>
    <td width="200"><strong>Nome:</strong></td>
    <td width="130"><strong>Nº de matricula:</strong></td>
    <td width="155"><strong>Série:</strong></td>
    <td width="194"><strong>Turno:</strong></td>
    <td width="149"><strong>Nascimento:</strong></td>
  </tr>
  <?php while($res_1 = mysqli_fetch_array($sql_1)){ ?>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
    <td><?php echo $res_1['code']; ?></td>
    <td><?php echo $res_1['serie']; ?></td>
    <td><?php echo $res_1['turno']; ?></td>
    <td><?php echo $res_1['nascimento']; ?></td>
  </tr>
  <?php } ?>
  <tr>
  </tr>
</table>
</div><!-- box -->
</body>
</html>