<?php
    session_start();
    include "conn.php";
    include "functions.php";

    if(isset($_POST["ID"]) && isset($_POST["Ammount"]) && isset($_SESSION["ID"])){
        $ID = $_POST["ID"];
        $Ammount = $_POST["Ammount"];

        if(empty($Ammount) || empty($ID)){
            header("location: ../view/send.php?params=<p style='color:red;'>Please Enter Ammount and Id</p>");
            exit();
        }
        if($ID == $_SESSION['ID']){
            header("location: ../view/send.php?params=<p style='color:red;'>You cannot send money to yourself</p>");
            exit(); 
        }
        if($_SESSION['Balance'] < $Ammount){
            header("location: ../view/send.php?params=<p style='color:red;'>Insufficient Balance, Try again.</p>");
            exit();
        }
        $res1 = $conn->query("SELECT  ID , Fname , Lname , Mname  FROM users WHERE ID = $ID");
        if($res1->num_rows == 1){
                    $row1 = $res1->fetch_assoc();
                    $recieverFullname = $row1['Fname'] . " " . $row1['Mname'] . " " . $row1['Lname']; 
                    $senderFullname = $_SESSION['Fname'] . " " . $_SESSION['Mname'] . " " . $_SESSION['Lname'];
                    $senderID = $_SESSION['ID'];
                    $recieverID = $row1['ID'];
                    $transactionID = getCurrentMilliseconds();
                    $conn->query("INSERT INTO transactions (  recieverID ,senderID ,  `type` ,  receiverFullName , senderFullName ,  `Date` ,    ammount , transactionID ) VALUES ( $recieverID , $senderID , 'send' , '$recieverFullname'  , '$senderFullname' , NOW() , $Ammount , $transactionID); ");
                    $conn->query("UPDATE users SET Balance = Balance + $Ammount WHERE ID = $recieverID");
                    $conn->query("UPDATE users SET Balance = Balance - $Ammount WHERE ID = $senderID");
                    $_SESSION['Balance'] = $_SESSION['Balance'] - $Ammount;
                    header("location: ../view/send.php?params=<p style='color:green;'>Successfully Sent to " . $recieverFullname . " <br> Transaction ID: " . $transactionID . "</p> ");
                    exit();

            } else{
            header("location: ../view/send.php?params=<p style='color:red;'>User not found, Please check the ID</p>");
        }
    }