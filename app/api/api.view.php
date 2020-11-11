<?php

class api_view{

    private $status;

    function __construct(){
       
        $this->status = array (
            200 => "OK",
            201 => "Created",
            204 => "No Content",
            400 => "Bad Request",
            401 => "Unautorized",
            403 => "Forbidden",
            404 => "Not Found",
            418 => "I'm a teapot",
            500 => "Internal Server Error"
        );
        
    }

    function response($data,$code){

        header("Content-Type: application/json");
        header("HTTP/1.1 " . $code . " " . $this->requestStatus($code));
        echo json_encode($data);

    }

    private function requestStatus($code){
        try{
            $state = $this->status[$code];
        } catch (Exception $e){
            $state = $this->status[500];
        }
        return $state;
    }

}