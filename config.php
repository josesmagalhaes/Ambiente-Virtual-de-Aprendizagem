<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
</head>
<body>
<?php if(@$_GET['pg'] == 'sair'){
	
session_destroy();
$_SESSION['code'];
$_SESSION['nome'];
$_SESSION['password'];
$_SESSION['painel'];
    
echo "<script language='javascript'>window.location='index.php';</script>";

}?>    
    
<?php    
require 'conexao.php';
    
    session_start();
    $code = $_SESSION['code'];
    $nome = $_SESSION['nome'];
    $password = $_SESSION['password'];
    $painel = $_SESSION['painel'];

    if($code == ''){
        echo "<script language='javascript'>window.location='../index.php';</script>";
    }else if ($nome == ''){
        echo "<script language='javascript'>window.location='../index.php';</script>";
    }else if ($password == ''){
        echo "<script language='javascript'>window.location='../index.php';</script>";
    }else{
        $sql = "SELECT * FROM acesso_ao_sistema WHERE code = '$code' AND senha = '$password'";
        $sql_1 = mysqli_query($connect,$sql);
        
        $conta_sql_1 = mysqli_num_rows($sql_1);
        
        if($conta_sql_1 == ''){
            echo "<script language='javascript'>window.location='../index.php;</script>";
        }else{
            if($painel_atual != $painel){
                echo "<script language='javascript'>window.location='../index.php';</script>";
            }else{
                
            }
        }
    }
?>  
    
<?php if(@$_GET['acao'] == 'quebra'){
	
session_destroy();
$_SESSION['code'];
$_SESSION['nome'];
$_SESSION['password'];
$_SESSION['painel'];

echo "<script language='javascript'>window.location='index.php';</script>";

}?>    
</body>
</html>