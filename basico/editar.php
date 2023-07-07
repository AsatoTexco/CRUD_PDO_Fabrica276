<?php

require 'Usuario.php';
$user = new Usuario;
$user->conectarr();



if(isset($_GET['id_user'])){

    $id_user = $_GET['id_user'];

}else{

    header("Location: listar_user.php");

}
 
$dados_usuario = $user->get_by_id($id_user)[0];
// var_dump($dados_usuario); 



if(isset($_POST['btn_sub'])){


    if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['telefone']) ){

        if($user->editarr($id_user,$_POST['nome'],$_POST['email'],$_POST['senha'],$_POST['telefone'])){

            header("Location: listar_users.php");
            echo("uga");

        }else{

            echo("Erro ao editar");

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

        <input type="text" name="nome" value="<?=$dados_usuario['nome']?>" placeholder="Nome"><br>
        <input type="email" name="email" value="<?=$dados_usuario['email']?>" placeholder="E-Mail"><br>
        <input type="text" name="telefone" value="<?=$dados_usuario['telefone']?>" placeholder="Telefone"><br>
        <input type="password" name="senha" value="<?=$dados_usuario['senha']?>" placeholder="Senha"><br>
        <br><br>
        <input type="submit" name="btn_sub" value="Cadastrar">

    </form>
    
</body>
</html>


