<!doctype html>
<html>
<head>
<?php require "../conexao.php"; ?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<link rel="shortcut icon" href="../imagens/logoEscola.png" type="image/x-icon" />
<title>E-Escolar | Admin | Relatórios</title> 
</head>

<tbody>
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

<?php if($_GET['s'] == 'aluno'){ ?>
<?php
$q = $_GET['q'];
$sql_1 = mysqli_query($connect,"SELECT * FROM estudantes WHERE code = '$q'");
  while($res_1 = mysqli_fetch_array($sql_1)){
?>
<table class="table table-bordered">
    <br>
    <h3 align="center">Informações Gerais do Aluno</h3>
    <br>
  <tr>
    <td><strong>Nome:</strong></td>
    <td><strong>CPF:</strong></td>
    <td><strong>RG:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['nome']; ?></td>
    <td><?php echo $res_1['cpf']; ?></td>
    <td><?php echo $res_1['rg']; ?></td>
  </tr>
  <tr>
    <td><strong>Nascimento:</strong></td>
    <td><strong>Mãe:</strong></td>
    <td><strong>Pai:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['nascimento']; ?></td>
    <td><?php echo $res_1['mae']; ?></td>
    <td><?php echo $res_1['pai']; ?></td>
  </tr>
  <tr>
    <td><strong>Estado:</strong></td>
    <td><strong>Cidade:</strong></td>
    <td><strong>Bairro:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['estado']; ?></td>
    <td><?php echo $res_1['cidade']; ?></td>
    <td><?php echo $res_1['bairro']; ?></td>
  </tr>
  <tr>
    <td><strong>Endereço:</strong></td>
    <td><strong>Complemento:</strong></td>
    <td><strong>Cep:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['endereco']; ?></td>
    <td><?php echo $res_1['complemento']; ?></td>
    <td><?php echo $res_1['cep']; ?></td>
  </tr>
  <tr>
    <td><strong>Telefone Residêncial:</strong></td>
    <td><strong>Celular:</strong></td>
    <td><strong>Telefone do amigo:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['tel_residencial']; ?></td>
    <td><?php echo $res_1['celular']; ?></td>
    <td><?php echo $res_1['tel_amigo']; ?></td>
  </tr>
  <tr>
    <td><strong>Série:</strong></td>
    <td><strong>Turno:</strong></td>
    <td><strong>Atendimento Especial:</strong></td>
  </tr>
  <tr>
    <td><?php echo $res_1['serie']; ?></td>
    <td><?php echo $res_1['turno']; ?></td>
    <td><?php echo $res_1['atendimento_especial']; ?></td>
  </tr>

  <tr>
    <td><strong>Observações:</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><?php echo $res_1['obs']; ?></td>
  </tr>
</table>
<?php }} ?>
    <br>

</div><!--box  -->
</body>
</html>