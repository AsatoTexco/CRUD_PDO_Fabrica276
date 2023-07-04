<?php
require 'Usuario.php';

$user = new Usuario;
$user->conectar('teste','localhost','root','');
 
if(isset($_FILES['image'])){

    $nome_img = $_FILES['image']['name'];

    $extensao = substr($nome_img, strrpos($nome_img, '.')); 
    $num = rand(1,5123971287128947198);
    $num2 = rand(1,51231251231226349);
    $num3 = $num.$num2;

    $nome_img_of = $num3.$extensao;

    $dir_img = $_FILES['image']['tmp_name'];

     

}
if(isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome']) && isset($_FILES['image']) ){


    if($user->cadastrar($_POST['email'],$_POST['senha'], $_POST['nome'],$nome_img_of)){

        move_uploaded_file($dir_img, "imgs_perfil/".$nome_img_of);
        echo("Cadastrado com sucesso!!!");

    }else{

        echo("erro ao cadastrar!!!");

    };
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">

</head>
<body> 

    <a href="listar_usuarios.php" class="nav_link">Listar Usuários</a>
    <form action="" method="post" class="form_input" enctype="multipart/form-data">
        <div class="content_form">

            <div class="area_input">
    
                <input autocomplete="off" required="" type="text" class="input_form" name="nome">
                <label for="" class="label_input">Nome</label>
                <div class="line"></div> 
    
            </div>

            <div class="area_input">
    
                <input autocomplete="off" required="" type="text" class="input_form" name="email">
                <label for="" class="label_input">E-Mail</label>
                <div class="line"></div> 
    
            </div>
    
    
            <div class="area_input">
    
                <input autocomplete="off" required="" type="password" class="input_form" name="senha">
                <label for="" class="label_input">Senha</label>
                <div class="line"></div> 
    
            </div>

            <div class="area_input">
                
            
            
                <!-- INPUT IMG  -->
                <input type="file" accept="image/*" class="input_form" name='image'>
                  
    
            </div>


        </div>
        
        <input type="submit" value="Enviar" class="btn_sub">

    </form>
</body>
</html>