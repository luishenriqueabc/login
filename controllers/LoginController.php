<?php
class LoginController{
    function update(){
        // somente o usuário logado pode editar seu perfil
        $response = new Output();
        $response->allowedMethod('POST');
        $id = $_POST['id'];
        $email = $_POST['email']; 
        $senha = $_POST['senha'];
        $login = new login($id, $email, sha1($senha),null);
        $login->update();
        $result['message'] = "login atualizado com sucesso!";
        $result['login']['id'] = $id;
        $result['login']['email'] = $email;
        $response->out($result);
    }
}
?>