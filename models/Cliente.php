<?php
class Cliente{
    public $id;
    public $nome;
    public $sobrenome;
    

    function __construct($id, $nome, $sobrenome){
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
    }

    function create(){
        $db = new Database();
        try{
            $stmt = $db->conn->prepare("INSERT INTO cliente (id_login, nome, sobrenome) VALUES (:id_login, :nome, :sobrenome);");
            $stmt->bindParam(':id_login' , $this->id);
            $stmt->bindParam(':nome' , $this->nome);
            $stmt->bindParam(':sobrenome' , $this->sobrenome);
            $stmt->execute();
            
            return true;  

        }catch(PDOException $e) {
            $result['message'] = "Error Create: " . $e->getMessage();
            $response= new Output();
            $response->out($result, 500); 
        }
    }

    function delete(){
        $db = new DataBase();
        try{
            $stmt = $db->conn->prepare("DELETE FROM login WHERE id= :id;");
            $stmt->bindParam(':id' , $this->id);
            $stmt->execute();

            return true;

        }catch(PDOException $e) {
            $result['message'] = "Error Delete: " . $e->getMessage();
            $response= new Output();
            $response->out($result, 500); 
        }
    }

    function update(){
        $db = new DataBase();
        try{
            $stmt = $db->conn->prepare("UPDATE cliente SET nome=:nome,sobrenome=:sobrenome WHERE id_login= :id_login;");
            $stmt->bindParam(':id_login' , $this->id);
            $stmt->bindParam(':nome' , $this->nome);
            $stmt->bindParam(':sobrenome' , $this->sobrenome);
            $stmt->execute();
            return true;

        }catch(PDOException $e) {
            $result['message'] = "Error Update: " . $e->getMessage();
            $response= new Output();
            $response->out($result, 500); 
        }
    }

    function selectAll(){
        $db = new DataBase();
        try{
            $stmt = $db->conn->prepare("SELECT * FROM cliente");
            $stmt->execute();
            $result= $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;

        }catch(PDOException $e) {
            $result['message'] = "Error Select All User: " . $e->getMessage();
            $response= new Output();
            $response->out($result, 500);        
        }
    }

    function selectById(){
        $db = new DataBase();
        try{
            $stmt = $db->conn->prepare("SELECT * FROM cliente WHERE id_login=:id_login;");
            $stmt->bindParam(':id_login' , $this->id);
            $stmt->execute();
            $result= $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select By ID: " . $e->getMessage();
            $response= new Output();
            $response->out($result, 500); 
        }
    }

}
?>