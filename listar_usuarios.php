<?php
require 'Usuario.php';

$user = new Usuario;

$user->conectar('teste','localhost','root','');
$dados = $user->get_dados();
$cards = "";


foreach($dados as $row_user){

    $cards .= '<div class="area_card">

    <div class="card">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <div class="area_img">

            <img src="imgs_perfil/'.$row_user['img_perfil'].'" class="img_user" alt="">
        </div>
        <h4>'.$row_user['nome'].'</h4>
        
        <a class="btn_editar" href="editar.php?id_user='.$row_user['id_user'].'">Editar</a>
        <a class="btn_excluir" href="excluir.php?id_user='.$row_user['id_user'].'">Excluir</a>
    </div> 

</div>';

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/cards.css">
</head>
<body>
<a href="cadastrar.php" class="nav_link">Cadastrar</a>


    <?=$cards?>

</body>
</html>