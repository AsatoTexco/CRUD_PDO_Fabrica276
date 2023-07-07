<?php
require 'Usuario.php';

$user = new Usuario;
$user->conectarr();



$tr = "";

$dados = $user->get_users();

foreach($dados as $row_user){
   
    $tr .= " <tr>

                <td>".$row_user['nome']."</td>
                <td>".$row_user['email']."</td>
                <td>".$row_user['telefone']."</td>
                <td>".$row_user['senha']."</td>
                <td><a href='editar.php?id_user=".$row_user['id_user']."'>|Editar|</a></td>
                <td><a href='excluir.php?id_user=".$row_user['id_user']."'>|Excluir|</a></td>
                 

            </tr>";

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
    
<table border="1">

    <tr>
        <th>Nome</th>
        <th>E-Mail</th>
        <th>Senha</th>
        <th>Telefone</th>
        <th>Editar</th>
        <th>Excluir</th>

    </tr>

    <?=$tr?>

</table> 
<br>
<a href="cadastrar.php">Cadastrar</a>

</body>
</html>