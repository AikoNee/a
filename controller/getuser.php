<?php
    
    include "conn.php";
    session_start();
    if(!isset($_GET['userID'])) exit();

    $id = $_GET['userID'];
    $ownID = $_SESSION["ID"];
    if($id == $ownID) {
        echo "Cannot send money to yourself.";
        exit();
    }
        if(empty($id)) exit();
  
    $res = $conn->query("SELECT Fname , Lname FROM users WHERE ID = $id");
    if($res->num_rows == 1){
        $row = $res->fetch_assoc();
        $Lname = $row["Lname"];
        $Fname = $row["Fname"];
        echo $Fname . " " . $Lname[0] . "."; 
    }else {
        echo "User not found";
    }