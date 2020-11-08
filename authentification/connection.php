<?php
    function OpenCon()
     {
        $dbhost = "mysql:host=localhost;dbname=authentification";
        $dbuser = "test";
        $dbpass = "password";
        $db = "authentification";
        //$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
         $conn = new PDO($dbhost,$dbuser,$dbpass);
        return $conn;     
    }
        
    function CloseCon($conn)
    {
        $conn -> close();
    }
       
 ?>