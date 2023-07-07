<?php



class Usuario{

    private $pdo;

    public function conectar(){
        
        try{

            $db_name = "teste";
            $host = "localhost";
            $user = 'root';
            $pwd = '$uP0rT3@22';
            $this->pdo = new PDO("mysql:dbname=".$db_name.";host=".$host, $user, $pwd);
            return true;

        }catch(PDOException $erro){
             
            echo ($erro->getMessage());

        }
        

    }

    public function cadastrar_user($nome,$email,$senha){
        
        $sql = $this->pdo->prepare("SELECT * FROM user WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0){

            return false;
        }else{


            $sql = $this->pdo->prepare("INSERT INTO user(email,senha,nome) VALUES(:e,:s,:n)");
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",$senha);
            $sql->bindValue(":n",$nome);
            $sql->execute();
            
            return true;
            
        }



    }
    public function get_dados(){

        $sql = $this->pdo->query("SELECT * FROM user");
        $sql -> execute();
        $dados = array();
        $dados = $sql -> fetchAll(PDO::FETCH_ASSOC); //recebendo varios dicionarios equivalentes a cada linha no banco

        if($sql->rowCount() > 0){

            return $dados; 

        }else{
            
            return false;
        }
    }



}