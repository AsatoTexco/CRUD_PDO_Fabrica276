<?php
require './Usuario.php';
$user = new Usuario;
$user->conectarr();

if(isset($_POST['btn_sub'])){

    if(isset($_POST['nome']) and isset($_POST['email']) && isset($_POST['senha']) and isset($_POST['telefone']) ){

    
        if($user->cadastrarr($_POST['email'],$_POST['senha'],$_POST['nome'],$_POST['telefone'])){

            echo("Usuario cadastrado");


        }else{
            echo("Erro ao cadastrar");
        }
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

    <form action="" method="post">

        <input type="text" name="nome" placeholder="Nome"><br>
        <input type="email" name="email" placeholder="E-Mail"><br>
        <input type="text" name="telefone" placeholder="Telefone"><br>
        <input type="password" name="senha" placeholder="Senha"><br>
        <br><br>
        <input type="submit" name="btn_sub" value="Cadastrar">

    </form>
    <br>
    <a href="listar_users.php">Listar Users</a>
    
</body>
</html>