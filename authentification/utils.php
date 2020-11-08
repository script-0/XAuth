<?php
    function getIPAddress(){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
        if( empty($ip) ){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if(empty($ip)){
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        return $ip;
    }

    function getAllServerVariables(){
        foreach($_SERVER as $key => $value){
            echo '$_SERVER["'.$key.'"]='.$value.'<br />';
        }
    }

    function reportError($db,$operation,$matricule,$error,$requestType){
        $clientAddress = $_SERVER['REMOTE_ADDR'];
        $clientSoftware = $_SERVER['HTTP_USER_AGENT'];
        $errors = "INSERT INTO errors(ip, operation, student_matricule, description,client,request) VALUES(?,?,?,?,?,?)";
        $stmt = $db->prepare($errors);
        $insert = $stmt->execute([$clientAddress,$operation, $matricule,$error,$clientSoftware,$requestType]);
    }
