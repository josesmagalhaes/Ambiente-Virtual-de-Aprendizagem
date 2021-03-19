<!doctype html>
<html>
<head>
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
  <title>E-Escolar | Admin | Relatórios</title>    
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" /> 
<?php $painel_atual = "admin"; ?>
<?php require "../config.php"; ?>

</head>

<body>

<div id="caixa_preta">
</div><!-- caixa_preta -->

<div id="box" align="center">
<?php if(@$_GET['tipo'] == 'alunos'){ ?>
<h1>Relatório de alunos</h1> 
<?php if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
$serie = $_POST['serie'];

$s = base64_encode("SELECT * FROM estudantes WHERE status = '$tipo' AND serie = '$serie'");

echo "<script language='javascript'>window.location='relatorios.php?tipo=alunos&s=$s';</script>";

}?>
<form name="button" method="post" action="" enctype="multipart/form-data">
<table>
  <tr>
    <td width="267"><strong>Status</strong></td>
    <td width="248"><strong>Série</strong></td>
    <td width="180">&nbsp;</td>
  </tr>
  <tr>
    <td><select name="tipo" size="1" id="select" class="form-control">
      <option value="Ativo">Alunos Ativos</option>
      <option value="Inativo">Alunos Inativos</option>
    </select></td>
    <td>
      <select name="serie" id="select2" class="form-control">
      <?php
      $sql_2 = mysqli_query($connect,"SELECT * FROM cursos");
	  	while($res_2 = mysqli_fetch_array($sql_2)){
	  ?>
       <option value="<?php echo $res_2['curso']; ?>"><?php echo $res_2['curso']; ?></option>      
       <?php } ?>
      </select>
    </td>
    <td><input class="btn btn-success" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
</table>
</form>
<br>

<?php 
$s = base64_decode($_GET['s']);
$sql_1 = mysqli_query($connect,$s);
if(mysqli_num_rows($sql_1) == ''){
	echo "Não existe resultados para o filtro selecionado";
}else{
?>
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
   <td align="center" colspan="5"><a target="_blank" href="alunos_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprimir relação completa do aluno</a></td>
  </tr>
</table>
<?php } ?>



<?php }// aqui fecha a pg alunos ?>



<?php if(@$_GET['tipo'] == 'professores'){ ?>
<h1>Relatório de professores</h1> 

<?php if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
$serie = $_POST['serie'];

$sql_3 = mysqli_query($connect,"SELECT * FROM professores WHERE status = '$tipo'");
if(mysqli_num_rows($sql_3) == ''){
echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=nao_encontrado';</script>";
}else{
	while($res_3 = mysqli_fetch_array($sql_3)){

$s = base64_encode("SELECT * FROM disciplinas WHERE curso = '$serie'");

echo "<script language='javascript'>window.location='relatorios.php?tipo=professores&s=$s';</script>";

}}}?>

<form name="button" method="post" action="" enctype="multipart/form-data">
<table>
  <tr>
    <td width="330"><strong>Status</strong></td>
    <td width="151"><strong>Curso:</strong></td>
    <td width="244">&nbsp;</td>
  </tr>
  <tr>
    <td><select name="tipo" size="1" id="select" class="form-control">
      <option value="Ativo">Professores Ativos</option>
      <option value="Inativo">Professores Inativos</option>
    </select></td>
    <td><select name="serie" id="serie" class="form-control">
      <?php
      $sql_2 = mysqli_query($connect,"SELECT * FROM disciplinas");
	  	while($res_2 = mysqli_fetch_array($sql_2)){
	  ?>
      <option value="<?php echo $res_2['curso']; ?>"><?php echo $res_2['curso']; ?></option>
      <?php } ?>
    </select></td>
    <td><input class="btn btn-success" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
</table>
</form>
<br>

<?php

$s = base64_decode($_GET['s']);

$sql_1 = mysqli_query($connect,$s);
if(mysqli_num_rows($sql_1) == ''){
	echo "Não existe resultado para o filtro selecionado!";
}else{
?>
<table class="table table-bordered">
  <tr>
    <td width="200"><strong>Disciplina/Curso:</strong></td>
    <td width="70"><strong>Código:</strong></td>
    <td width="150"><strong>Nome</strong></td>
    <td width="180"><strong>Formação:</strong></td>
  </tr>
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
  </tr>
  <?php } ?>

<?php } ?>  
  <tr>
   <td align="center" colspan="6"><a target="_blank" href="professores_pg_impressao.php?s=<?php echo $_GET['s']; ?>">Imprir relação completa</a></td>
  </tr>
</table>
<?php } ?>


<?php }// aqui a fecha a pg professor ?>

</div><!-- box -->

</body>
</html>