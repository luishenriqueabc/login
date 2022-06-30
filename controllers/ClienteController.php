<?php

class ClienteController{

    function create(){
        $response= new Output();
        $response->allowedMethod('POST');
        //Entradas
        $nome= $_POST['nome'];
        $email= $_POST['email'];
       

        $login = new Login(null,$nome, $email, sha1($senha));
        $id = $login->create();
        
        //Processamento ou Persistencia
        $cliente = new Cliente($id, $nome, $email);       
        $cliente->create();   

        //Saída
        $result['message'] = "O Cadastro Foi Feito Com Sucesso!";
        $result['cliente']['id'] = $id;
        $result['cliente']['nome'] = $nome;
        $result['cliente']['email'] = $email;
        
        $response->out($result);
    }

    function delete(){
        $response= new Output();
        $response->allowedMethod('POST');

        $id = $_POST['id'];

        $cliente = new Cliente($id, null, null);         
        $cliente->delete();

        $result['message'] = "O Cliente foi Deletado Com Sucesso!";
        $result['cliente']['id'] = $id;
        $response->out($result);
    }

    function update(){
        $response= new Output();
        $response->allowedMethod('POST');
        
        $id = $_POST['id'];
        $nome= $_POST['nome'];
        $email= $_POST['email'];
     
        
        $cliente = new Cliente($id, $nome, $email);   
        $cliente->update();

        $result['message'] = "A Edição Foi Feita Com Sucesso!";
        $result['cliente']['id'] = $id;
        $result['cliente']['nome'] = $nome;
        $result['cliente']['email'] = $email;
 
        $response->out($result); 
    }

    function selectAll(){
        $response= new Output();
        $response->allowedMethod('GET');
        $cliente = new Cliente(null, null, null);       
        $result= $cliente->selectAll();

        $response->out($result);
    }

    function selectById(){
        $response= new Output();
        $response->allowedMethod('GET');
        $id = $_GET['id'];
        $cliente = new Cliente($id, null, null);       
        $result= $cliente->selectById();

        $response->out($result);
    }
}

?>