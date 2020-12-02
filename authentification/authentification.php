<?php
    include("connection.php");

    include("utils.php");

    try{
        $db = OpenCon();        
    }catch(PDOException $e){
        echo("Connection can't be established to the BD");
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
        $do = $_POST['do'];
        /*
            $matricule = $_GET['matricule'];
            $name = $_GET['name'];
            $department = $_GET['department'];
            $level = intval($_GET['level']);
            $email = $_GET['email'];
            $password = $_GET['pass'];
            $do = $_GET['do'];        
        */
        if($do == "Create"){
            signup($db);
        }else if($do == "Login"){
            signin($db);
        }

    }else{
        header('HTTP/1.0 403 Forbidden');
    }

    function signup($db){
        $matricule = strtoupper($_POST['matricule']);
        $name = $_POST['name'];
        $department = $_POST['department'];
        $level = intval($_POST['level']);
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $query = "INSERT INTO student(matricule, name , email, password, department, level,creationdate) VALUES(?,?,?,?,?,?,NOW())";
        $stmt = $db->prepare($query);
        $insert = $stmt->execute([$matricule, $name, $email,$password,$department,$level]);

        if($insert){
            echo('Success');
        }else{
            reportError($db,"Create",$matricule,"Duplicate entry with the same 'Matricule'","POST");
            echo("[Error]: Another account has the same 'Matricule'");
        }
    }

    function signin($db){
        $matricule = strtoupper($_POST["matricule"]);  
        $password = $_POST['pass'];
        $query = "SELECT password , name , email, department , level , lastconnection FROM student WHERE matricule=?";
        $stmt = $db->prepare($query);
        $stmt->execute([$matricule]);
        $result = $stmt->fetchAll();
        //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if(sizeof($result) == 0){
            echo("Empty");
        }else if( sizeof($result) > 0){
            $row = $result[0];
            if($row['password'] == $password){
                echo("{matricule:".$matricule.",name:".$row['name'].",email:".$row['email'].",department:".$row['department'].",level:".$row['level'].",lastconnection:".$row['lastconnection']."}");
                $update = "UPDATE student SET lastconnection=NOW() WHERE matricule = ?";
                $stmt = $db->prepare($update);
                if($stmt->execute([$matricule])){
                    reportError($db,"LOGIN",$matricule,"Cannot update lastconnection field","POST");
                }
            }else{
                echo("[Error]:Wrong Password");
            }
        }else{
            reportError($db,"LOGIN",$matricule,"Select request failed","POST");
            echo('[Error]:Internal error. We are resolving this mistake. Try again later');
        }
    }
?>