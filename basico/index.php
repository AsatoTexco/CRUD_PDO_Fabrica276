<?php

require 'Usuario.php'; 

$user = new Usuario;
$user->conectar();
if($_POST['btn_sub']){


    if(isset($_POST['nome']) and isset($_POST['email']) && isset($_POST['senha'])){
    
        $nome  = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    
        if($user->cadastrar_user($email,$senha,$nome)){
            
            echo("Usuario cadastrado com Sucesso!");
            
        }else{
    
            echo("erro ao cadastrar usuario");
        }
    
    
    
    }else{
        echo("preencha todos os dados");
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">

        <input type="text" name="nome" placeholder="nome" id="">
        <input type="text" name="email" placeholder="email" id="">
        <input type="text" name="senha" placeholder="senha" id="">

        <input type="submit" value="Cadastrar" name="btn_sub">

    </form>
    
</body>
</html>