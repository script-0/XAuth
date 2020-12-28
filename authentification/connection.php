<?php
    function OpenCon()
     {
        $dbhost = "mysql:host=localhost;dbname=authentification";
        $dbuser = "root";
        $dbpass = "";
        $db = "authentification";
        //$conn = new mysqli('localhost', $dbuser, $dbpass,$db);
        $conn = new PDO($dbhost,$dbuser,$dbpass);
        return $conn;     
    }
        
    function CloseCon($conn)
    {
        $conn-> close();
    }
       
 ?>