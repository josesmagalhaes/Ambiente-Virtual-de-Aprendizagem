<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<title>E-Escolar | Admin | Cursos e Disciplinas</title>
    
    
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Fonts -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

<?php $painel_atual = "admin";?>
<?php
include '../conexao.php'; 
include '../config.php';
 ?>
<!-- Fim dos blocos de imports-->
<?php if(@$_GET['pg'] == 'curso'){ ?>
 
<?php if(@$_GET['cadastra'] == 'sim'){?>  
<?php if(isset($_POST['cadastra'])){

$curso = $_POST['curso'];

$cd = mysqli_query($connect,"INSERT INTO cursos (curso) VALUES ('$curso')");
if($cd == ''){
  echo "<script language='javascript'>window.alert('Ocorreu um erro, ao cadastrar o curso!');</script>";
}else{
  echo "<script language='javascript'>window.alert('Curso cadastrado com sucesso!');window.location='cursos_e_disciplinas.php?pg=curso';</script>";
}
}?> 
<div class="table-responsive-md" align="center">
<form method="post" action="">
  <table class="table" align="center">
    <tr>
      <td><h3>Curso</h3></td>
    </tr>

    <tr>
      <td><input type="text" name="curso" class="form-control" placeholder="Digite o nome do curso aqui" aria-label="Username" aria-describedby="basic-addon1"></td>
      <td><input class="btn btn-success #2196f3 blue" type="submit" name="cadastra" value="Cadastrar"></td>
      </tr>
      <td><a class="btn btn-success" href="cursos_e_disciplinas.php?pg=curso">Retornar</a></td>
  </table>
</form>
</div> 
 <br />
<?php die;} ?>
<?php
$sql_1 = mysqli_query($connect,"SELECT * FROM cursos");
 if(mysqli_num_rows($sql_1) == ''){
   echo "<br><br>No momento não existe nenhum curso cadastrado!<br><br>";
 }else{
?>



<div class="table-responsive-md" align="center">
  <h1 class="page-header">Cursos</h1>
   <a class="btn btn-success" href="cursos_e_disciplinas.php?pg=curso&cadastra=sim">Cadastrar novo curso</a>
   <a class="btn btn-success" href="../admin">Retornar</a>
</div>
<br>   
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><h5>Curso</h5></th>
          <th><h5>Total de Disciplinas deste Curso</h5</th>
          <th><h5>Ações</h5</th>
          <?php while($res_1 = mysqli_fetch_array($sql_1)){ ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $curso = $res_1['curso']; ?></td>
          <td><?php echo mysqli_num_rows(mysqli_query($connect,"SELECT * FROM disciplinas WHERE curso = '$curso'")); ?></td>
          <td><a class="a" href="cursos_e_disciplinas.php?pg=curso&deleta=cur&id=<?php echo @$res_1['id']; ?>"><i title="Excluir este curso" class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php }} ?> 
    </div>
</div>
<br>
        <?php if(@$_GET['deleta'] == 'cur'){

        $id = $_GET['id'];

        mysqli_query($connect,"DELETE FROM cursos WHERE id = '$id'");

        echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";

        }?>



<!-- aqui inicia-->

<?php if(@$_GET['pg'] == 'disciplina'){ ?>
 
<?php if(@$_GET['cadastra'] == 'sim'){?>  
<?php if(isset($_POST['cadastra'])){

$curso = $_POST['curso']; 
$disciplina = $_POST['disciplina']; 
$professor = $_POST['professor']; 
$sala = $_POST['sala']; 
$turno = $_POST['turno'];

if($disciplina == ''){
  echo "<script language='javascript'>window.alert('Digite o nome da disciplina');</script>";
}else if($sala == ''){
  echo "<script language='javascript'>window.alert('Digite o nº da sala');</script>";
}else{
$sql_5 = mysqli_query($connect,"INSERT INTO disciplinas (curso, disciplina, professor, sala, turno) VALUES ('$curso', '$disciplina', '$professor', '$sala', '$turno')");
if($sql_5 == ''){
  echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
}else{
  echo "<script language='javascript'>window.alert('Disciplina cadastrada com sucesso!');window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";
  }
}
}?> 

<div class="table-responsive">
<form method="post" action="">
  <table class="table">
    <tr>
      <td><h4>Curso:</h4></td>
      <td><h4>Disciplina:</h4></td>
      <td><h4>Professor:</h4></td>
      <td width="128"><h4>Sala: </h4></td>
      <td width="128"><h4>Turno:</h4></td>
      <td width="128"><h4>Ação:</h4></td>
    </tr>
    <tr>
      <td>
      <select name="curso" class="browser-default custom-select">
      <?php
      $sql_3 = mysqli_query($connect,"SELECT * FROM cursos");
      while($res_3 = mysqli_fetch_array($sql_3)){
    ?>
        <option value="<?php echo $res_3['curso']; ?>"><?php echo $res_3['curso']; ?></option>
      <?php } ?>
      </select>
      </td>
      <td>
      <input class="form-control" type="text" name="disciplina" id="textfield"></td>
      <td>
      <select name="professor" class="browser-default custom-select">
      <?php
      $sql_4 = mysqli_query($connect,"SELECT * FROM professores WHERE nome != ''");
      while($res_4 = mysqli_fetch_array($sql_4)){
    ?>
       <option value="<?php echo $res_4['code']; ?>"><?php echo $res_4['nome']; ?></option>
      <?php } ?>
      </select>
      </td>
      <td>
      <input class="form-control" type="text" name="sala" id="textfield"></td>
      <td>
        <select name="turno" size="1" id="turno" class="browser-default custom-select">
          <option value="Manhã">Manhã</option>
          <option value="Tarde">Tarde</option>
          <option value="Noite">Noite</option>
          <option value="Noite">Integral</option>
      </select></td>
      <td width="126"><input class="btn btn-success #2196f3 blue" type="submit" name="cadastra" id="button" value="Cadastrar"></td>
    </tr>
    <td><a class="btn btn-success" href="cursos_e_disciplinas.php?pg=disciplina">Retornar</a></td>
  </table>
</form>
</div>

<br /><br />




<?php die;} ?>
<?php
$sql_1 = mysqli_query($connect,"SELECT * FROM disciplinas");
 if(mysqli_num_rows($sql_1) == ''){
   echo "<br><br>No momento não existe nenhuma disciplina cadastrada!<br><br>";
 }else{
?>



<div class="table-responsive-md" align="center">
  <h3>Disciplinas</h3>
   <a class="btn btn-success" href="cursos_e_disciplinas.php?pg=disciplina&cadastra=sim">Cadastrar nova disciplina</a>
   <a class="btn btn-success" href="../admin">Retornar</a>
</div><br>

  <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><h5>Curso</h5></th>
          <th><h5>Disciplina</h5></th>
          <th><h5>Professor</h5></th>
          <th><h5>Sala</h5></th>
          <th><h5>Turno</h5></th>
          <th><h5>Ações</h5></th>
          <?php while($res_1 = mysqli_fetch_array($sql_1)){ ?>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><?php echo $res_1['curso']; ?></td>
          <td><?php echo $res_1['disciplina']; ?></td>
          <td><?php
    $professor = $res_1['professor'];
    
    $sql_2 = mysqli_query($connect,"SELECT * FROM professores WHERE code = '$professor'");
      while($res_2 = mysqli_fetch_array($sql_2)){
        echo $res_2['nome']; echo " - "; echo $res_1['professor'];
      }
        
    ?></td>
        <td><?php echo $res_1['sala']; ?></td>
        <td><?php echo $res_1['turno']; ?></td>
          <td><a class="a" href="cursos_e_disciplinas.php?pg=disciplina&deleta=sim&id=<?php echo $res_1['id']; ?>"><i title="Excluir este curso" class="fas fa-trash-alt"></i></a></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php }} ?> 
    </div>
</div>
<br>
        <?php if(@$_GET['deleta'] == 'cur'){

        $id = $_GET['id'];

        mysqli_query($connect,"DELETE FROM cursos WHERE id = '$id'");

        echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=curso';</script>";

        }?>
<div class="container">

<?php if(@$_GET['deleta'] == 'sim'){

$id = $_GET['id'];

mysqli_query($connect,"DELETE FROM disciplinas WHERE id = '$id'");

echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=disciplina';</script>";

}?> 
</div><!-- box_disciplinas -->

<!-- Cursos e disciplinas-->
<?php if(@$_GET['pg'] == 'cursoedisciplinas'){ ?>
<div class="container">
<h1 align="center">Formação de turmas e disciplinas</h1>
<div>
<a class="btn btn-success #2196f3 blue" href="../admin">Retornar</a>
</div>

<br>
<?php
$sql_1 = mysqli_query($connect,"SELECT * FROM cursos");
if(mysqli_num_rows($sql_1) == ''){
  echo "Não existe nenhum curso cadastrado no momento!";
}else{
?>
<table class="table table-bordered">
<?php while($res_1 = mysqli_fetch_array($sql_1)){ ?>
  <tr>
    <td width="614"><h5>Curso: <?php echo $curso = $res_1['curso']; ?></h5></td>
  </tr>
  <tr>
    <td>
    <textarea class="form-control z-depth-1" name="item_description" rows="8" style="height:auto !important;" disabled="disabled">

    <?php
     $sql_2 = mysqli_query($connect,"SELECT * FROM disciplinas WHERE curso = '$curso'");
    while($res_2 = mysqli_fetch_array($sql_2)){
    
      $professor = $res_2['professor'];
            
      echo $res_2['disciplina']; 
      echo " - ";
  $sql_3 = mysqli_query($connect,"SELECT * FROM professores WHERE code = '$professor'");
    while($res_3 = mysqli_fetch_array($sql_3)){
      echo $res_3['nome'];
      echo " - ";
      echo $res_3['code'];
      echo " | ";
     }
    }
  ?>
    </textarea>
    </td>
  </tr>
<?php } ?>
</table>
<br />  
<?php } ?>

</div><!-- box_curso_e_disciplinas -->
<?php } ?>
</div>