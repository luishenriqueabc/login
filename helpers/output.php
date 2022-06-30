<?php
class Output{
    function out ($result = [], $code = 200){
        header('Content-type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        http_response_code($code);
        echo json_encode($result);
        die;
    }

    function allowedMethod($method){
        if($method != $_SERVER['REQUEST_METHOD']){
            http_response_code(405);
            $result['message'] = "Method not allowed for this route.";
            echo json_encode($result);
            die;
        }
    }
}
?>