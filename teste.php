<?php

require_once 'Usuario.php';
$user = new Usuario;
$user->conectar('teste','localhost','root','');

if($user->cadastrar("awheauihdaw","123123","arthur")){

    echo("Cadastrado com Sucesso!");


}
else{
    echo("erro ao cadastrar");
}


