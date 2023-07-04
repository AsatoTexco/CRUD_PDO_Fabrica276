<?php
require 'Usuario.php';

if(isset($_GET['id_user'])){

    $id_user = $_GET['id_user'];
    $user = new Usuario;

    $user->conectar('teste','localhost','root','');


    if($user->deletar_user($id_user)){

        header("Location: listar_usuarios.php");

    }else{
        echo("Erro ao deletar");
    }
    


}else{
    header("Location: listar_usuarios.php");
}