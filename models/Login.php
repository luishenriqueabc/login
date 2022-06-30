<?php 
class Login{
    public $id;
    public $email;
    public $senha;
    

    function __construct($id, $email, $senha) {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;
    }
    function create(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("INSERT INTO login (email, senha)
            VALUES (:email, :senha);");
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();
            $id = $db->conn->lastInsertId();
            return $id;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All User: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function delete(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("DELETE FROM login WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt->rowCount();
        }catch(PDOException $e) {
            $result['message'] = "Error Delete User: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
    function update(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("UPDATE login SET email = :email, senha = :senha WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->execute();
            return true;
        }catch(PDOException $e) {
            $result['message'] = "Error Update User: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function selectAll(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT id,email FROM login;");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select All User: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function selectById(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT id,email FROM login WHERE id = :id;");
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error Select User By Id: " . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }

    function login(){
        $db = new Database();
        try {
            $stmt = $db->conn->prepare("SELECT id, email FROM login WHERE email = :email AND senha = :senha;");
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':tipo', $this->tipo);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e) {
            $result['message'] = "Error User Login:" . $e->getMessage();
            $response = new Output();
            $response->out($result, 500);
        }
    }
}
?>