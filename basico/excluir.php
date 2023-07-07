<?php
require 'Usuario.php';
$user = new Usuario;
$user->conectarr();


if(isset($_GET['id_user'])){

    $id_user = $_GET['id_user'];

    if($user->deletar($id_user)){

        // mensagem deletado com sucesso
        header("Location: listar_users.php");   

    }else{
        // mensagem erro ao deletar 
    }
}else{

    header("Location: listar_users.php");

}
