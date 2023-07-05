<?php

require 'Usuario.php';

$user = new Usuario;

$user->conectar("teste",'localhost','root','ZZ');

if($_GET['id_user']){

    $id_user = $_GET['id_user'];

}else{

    header("Location: listar_usuarios.php");

}

$dados = $user->get_dados_by_id($id_user)[0];
$aceitados = ['.jpg','.jpeg','.gif','.png'];
 //=========================== UPDATE ==================================
if(isset($_FILES['image'])){

     
 
   if(strlen($_FILES['image']['name']) > 0){
       
       $nome_img = $_FILES['image']['name'];
   
       $extensao = substr($nome_img, strrpos($nome_img, '.')); 
       if(in_array($extensao,$aceitados)){

           $num = rand(1,5123971287128947198);
           $num2 = rand(1,51231251231226349);
        
           $num3 = $num.$num2;
           
       
           $nome_img_of = $num3.$extensao;
       
           $dir_img = $_FILES['image']['tmp_name'];
        
       }else{

           header("Location: editar.php?id_user=".$id_user);
           exit;
       }
       
   
    
   
   }else{
      
       $nome_img_of = $dados['img_perfil'];
      
   }


} 
 

if(isset($_POST['email']) && isset($_POST['senha']) && isset($_POST['nome'])){

    if($user->editar($dados['id_user'],$_POST['nome'],$_POST['email'],$_POST['senha'], $nome_img_of  )){
         
        if(strlen($_FILES['image']['name']) > 0){

            move_uploaded_file($dir_img, "imgs_perfil/".$nome_img_of);

        }

        // -------------------------------- adicionar novamente  ---------------------------------------
        header("Location: editar.php?id_user=".$dados['id_user']);

        // echo("Editado com sucesso!!!");

    }else{

        // echo("erro ao cadastrar!!!");

    };
}

// =================================================








$form_editar = '<form class="form_editar" action="" method="post"  enctype="multipart/form-data">
<h1>Editar Usuário</h1>

<div class="area_input_img">

<div class="area_img">
    <img src="imgs_perfil/'.$dados['img_perfil'].'" alt="" class="img_perfil" id="img_preview">
    <input type="file" name="image" id="input_img" class="input_img">
</div>

</div>


<div class="area_input">

    <input class="input_form" type="text" required="" value="'.$dados['nome'].'" name="nome">
    <label for="" class="label_input">Nome</label> 
    <div class="line"></div>

</div>
<div class="area_input">

    <input class="input_form" type="text" required=""value="'.$dados['email'].'" name="email">
    <label for="" class="label_input">E-Mail</label> 
    <div class="line"></div>

</div>

<div class="area_input">

    <input class="input_form"  type="text" required="" value="'.$dados['senha'].'" name="senha">
    <label for="" class="label_input">Senha</label> 
    <div class="line"></div>

</div>

<div class="area_input_img">

    <input class="btn_sub" type="submit" value="Editar">
     
</div>


</form>';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/editar.css">
</head>
<body>
<a href="listar_usuarios.php" class="nav_link">Lista Usuarios</a>
    <?=$form_editar?>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    $('#input_img').on('change', function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            var fileExtension = file.name.split('.').pop().toLowerCase();
            var aceitados = ['jpg', 'jpeg', 'gif', 'png'];
            if (aceitados.includes(fileExtension)) {
                $('#img_preview').attr('src', e.target.result);
            } else {
                // Caso a extensão do arquivo não seja suportada, você pode adicionar um comportamento específico aqui, como exibir uma mensagem de erro.
                console.log('Extensão de arquivo não suportada.');
            }
        }
        reader.readAsDataURL(file);
    });
});

</script>
</body>
</html>

 