<?php
class AuthController{

    function login(){
        $response = new Output();
        $response->allowedMethod('POST');

        $email = $_POST['email'];
        $pass = $_POST['pass'];

        $description = $_SERVER['HTTP_USER_AGENT'];

        $user = new User(null, null, $email, sha1($pass));
        $userLogged = $user->login();
        
        if($userLogged){
            $token = md5(uniqid($userLogged['id'], true));
            $session = new Session($userLogged['id'], $token, $description);
            if($session->create()){
                $result['session']['token'] = $token;
                $result['session']['email'] = $userLogged['email'];
                $result['session']['roles'] = $userLogged['roles'];
                $response->out($result);
            }
        }else{
            $result['message'] = "Usuário ou Senha Inválidos!";
            $response->out($result, 403);
        }
    }

    function logout(){
        $response = new Output();
        $response->allowedMethod('POST');

        $token = $_POST['token'];

        $session = new Session(null, $token, null);
        
        if($session->delete()){
            $result['message'] = "Sessão encerrada! Volte sempre!";
            $response->out($result);
        }else{
            $result['message'] = "Sessão não encontrada!";
            $response->out($result, 403);
        }
    }
}
?>