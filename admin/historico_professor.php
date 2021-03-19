<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<?php $painel_atual = "admin";?>
<?php require "../conexao.php"; ?>
<?php include '../config.php';?>
<title>E-Escolar | Admin | Histórico</title> 
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
      <td><h5><font face="arial"></font><?php echo $resuldados['nome']; ?><br>
          <?php echo $resuldados['endereco']; ?><br>
          <?php echo $resuldados['cidade_estado']; ?></h5><br>
      </td>
<?php }}?>         
    </tr>
  </table>
</div>

  <div class="table-responsive">
    <br>
    <h3 align="center">Informações Gerais do Professor</h3>
    <br>
    <table class="table table-bordered">
      <thead>
        <tr>
      <th>Código: </th>
      <th>Nome: </th>
      <th>CPF: </th>
      <th>Nascimento: </th>
      <th>Graduações: </th>
      <th>Pós-Graduações: </th>
      <th>Mestrado: </th>
      <th>Doutorado: </th>
      <th>Remuneração: </th>      
        </tr>
      </thead>
      <tbody>
    <?php
    $id = $_GET['id'];

        $sql ="SELECT * FROM professores WHERE id = '$id'";
        $resultado = mysqli_query($connect,$sql);
        if (mysqli_num_rows($resultado) > 0):
          while ($res_1 = mysqli_fetch_array($resultado)):
        ?>
    
        <tr>
          <td><?php echo $res_1['code'];?></td>
          <td><?php echo $res_1['nome'];?></td>
          <td><?php echo $res_1['cpf']; ?></td>
          <td><?php echo $res_1['nascimento'];?></td>
          <td><?php echo $res_1['graduacao'];?></td>
          <td><?php echo $res_1['pos_graduacao'];?></td>
          <td><?php echo $res_1['mestrado'];?></td>     
          <td><?php echo $res_1['doutorado'];?></td>
          <td><?php echo $res_1['salario'];?></td>          
          </div>
        </div>
        </tr>
        <?php
      endwhile;
      else: ?>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <?php
      endif;
        ?>
      </tbody>
    </table>
    <br>
  </div>