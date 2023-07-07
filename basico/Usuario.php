<?php


class Usuario{


    private $pdo;
    public $error;

    public function conectarr(){

        $db_name = "teste";
        $host = 'localhost';
        $pwd  = '';
        $db_user = 'root';

        try{
            $this->pdo = new PDO("mysql:dbname=".$db_name.";host=".$host, $db_user, $pwd);
           
      
        }catch(PDOException $erro){

            $this->error = $erro->getMessage();

        }
    
    }
    public function cadastrarr($email,$senha,$nome,$telefone){

        $sql = $this->pdo->prepare("SELECT * from user1 WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0 ){
             
            return false;
        }else{

            $sql = $this->pdo->prepare("INSERT INTO user1(nome,email,senha,telefone) VALUES(:n,:e,:s,:t)");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",$senha);
            $sql->bindValue(":t",$telefone);
            $sql->execute();

            return true;

        }


    }
    public function editarr($id_user,$nome,$email,$senha,$telefone){


        $sql = $this->pdo->prepare("SELECT * from user1 WHERE id_user = :id");
        $sql->bindValue(":id",$id_user);
        $sql->execute();

        if($sql->rowCount() > 0){

           
            $sql = $this->pdo->prepare("UPDATE user1 SET nome = :n, email = :e, senha = :s, telefone = :t WHERE id_user = :id");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",$senha);
            $sql->bindValue(":t",$telefone);
            $sql->bindValue(":id",$id_user);
            $sql->execute();
            return true;
        
        }else{

            return false;

        }


    }

    public function get_users(){

        $sql = $this->pdo->query("SELECT * from user1");
        
        $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $dados;

    }

    public function get_by_id($id_user){

        $sql = $this->pdo->prepare("SELECT * from user1 WHERE id_user = :id");
        $sql->bindValue(":id",$id_user);
        $sql->execute();

        if($sql->rowCount() > 0){

            $dados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $dados;

        }else{
            return false;

        }

    }

    public function deletar($id_user){

        $sql = $this->pdo->prepare("SELECT * from user1 WHERE id_user = :id");
        $sql->bindValue(":id",$id_user);
        $sql->execute();

        if($sql->rowCount() > 0){

            $sql = $this->pdo->prepare("DELETE FROM user1 WHERE id_user = :id");
            $sql->bindValue(":id",$id_user);
            $sql->execute();
            
            return true;


        }else{
            return false;
        }

    }


}
