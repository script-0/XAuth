<?php
    function OpenCon()
     {
        $dbhost = "mysql:host=localhost;dbname=cesa_authentification";
        $dbuser = "test";
        $dbpass = "password";
        $db = "cesa_authentification";
        //$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);
         $conn = new PDO($dbhost,$dbuser,$dbpass);
        return $conn;     
    }
        
    function CloseCon($conn)
    {
        $conn -> close();
    }
       
 ?>