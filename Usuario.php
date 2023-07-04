<?php

class Usuario {
    private $pdo;
    public $error;

    public function conectar($db_name, $host, $user, $pwd) {
        try {
            $this->pdo = new PDO("mysql:dbname=".$db_name.";host=".$host, $user, $pwd);
        } catch (PDOException $erro) {
            $this->error = $erro->getMessage();
        }
    }
    
    public function cadastrar($email, $senha,$nome,$img_name) {
        if ($this->pdo) {
            $sql = $this->pdo->prepare("SELECT * FROM user WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();

            if($sql->rowCount() > 0){
    
                return false;

            }else{

                $sql = $this->pdo->prepare("INSERT INTO user(email,senha,nome,img_perfil) VALUES(:e,:s,:n,:img)");
                $sql->bindValue(":e",$email); 
                $sql->bindValue(":s",$senha);                
                $sql->bindValue(":n",$nome);
                $sql->bindValue(":img",$img_name);

                $sql->execute();
                
                return true;
            
            }
            
            // Resto do código para cadastrar o usuário...
        } else {
            $this->error = "Erro: conexão com o banco de dados não estabelecida.";
        }
    }

    public function get_dados(){

        $sql = $this->pdo->query("SELECT * from user");
        
        $dados = [];
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
       
        return $dados;

    }
    public function get_dados_by_id($id){

        $sql = $this->pdo->prepare("SELECT * from user WHERE id_user = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);

        if($sql->rowCount() > 0){

            return $dados; 

        }else{
            
            return false;
        }

    }
    public function editar($id_user, $nome,$email,$senha,$img_perfil){
        try{

            $sql = $this->pdo->prepare("SELECT img_perfil FROM user WHERE id_user = :id");
            $sql->bindValue(":id",$id_user);
            $sql->execute();

            $ft_perfil = $sql->fetchAll(PDO::FETCH_ASSOC)[0]['img_perfil'];
            unlink('imgs_perfil/'.$ft_perfil);

            $sql = $this->pdo->prepare("UPDATE user SET nome = :n, email = :e, senha = :s, img_perfil = :img WHERE id_user = :id");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",$senha);
            $sql->bindValue(":img",$img_perfil);
            $sql->bindValue(":id",$id_user);
            $sql->execute();

            
            return true;
        }
        catch(PDOException $erro){

            $error = $erro->getMessage();
            return false;
        }



    }
    public function deletar_user($id){

        $sql = $this->pdo->prepare("SELECT * from user WHERE id_user = :id");
        $sql->bindValue(":id",$id);
        $sql->execute();

        if($sql->rowCount() > 0 ){
            
            $dados = [];
            $dados = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
            $img_nome = $dados['img_perfil'];

            unlink('imgs_perfil/'.$img_nome);
            
            $sql = $this->pdo->prepare('DELETE FROM user WHERE id_user = :id');
            $sql->bindValue(":id",$id);
            $sql->execute();

            return true;
        }
        else{

            return false;

        }
        



    }
}
