<!doctype html>
<html>
<head>
<?php require "../conexao.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />     
<title>E-Escolar | Admin | Relatórios</title> 
</head>
<br>
<br>

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
<h5 align="center">RELATÓRIO DE PROFESSORES</h5>

<body>
<script language="javascript">
window.print() 
</script>
<br>



<?php

$s = base64_decode($_GET['s']);

$sql_1 = mysqli_query($connect,$s);
if(mysqli_num_rows($sql_1) == ''){
	echo "Não existe resultado para o filtro selecionado!";
}else{
?>

<div class="table-responsive-md" align="center">
<table class="table table-bordered">
  <thead>
  <tr>
    <td><strong>Disciplina/Curso:</strong></td>
    <td><strong>Código:</strong></td>
    <td><strong>Nome</strong></td>
    <td><strong>Formação:</strong></td>
    <td><strong>CPF:</strong></td>
  </tr>
</thead>
<?php while($res_1 = mysqli_fetch_array($sql_1)){ ?>  
  <tr>
    <td><?php
			echo $res_1['disciplina'];
			echo " - ";
			echo $res_1['curso'];
			
	?></td>
    <td><?php echo $res_1['professor']; ?></td>
    <td><?php
    $sql_1_extra = mysqli_query($connect,"SELECT * FROM professores WHERE code = ".$res_1['professor']."");
		while($res_extra = mysqli_fetch_array($sql_1_extra)){
	
	?>
    <?php echo $res_extra['nome']; ?></td>
    <td><?php echo $res_extra['formacao']; ?>/<?php echo $res_extra['graduacao']; ?></td>
    <td><?php echo $res_extra['cpf']; ?></td>
  </tr>
  <?php } ?>
<?php } ?>  
</table>
<?php } ?>

</div><!-- box -->
</body>
</html>