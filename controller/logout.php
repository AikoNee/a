<?php

    session_start();

    if(isset($_SESSION["ID"])){
        unset($_SESSION["ID"]);
        unset($_SESSION["username"]);
        unset($_SESSION["Fname"]);
        unset($_SESSION["Lname"]);
        unset($_SESSION["Mname"]);
        unset($_SESSION["Balance"]);
        unset($_SESSION["SessionID"]);
        session_destroy();
        if(isset($_GET["params"])){
            if(!empty($_GET["params"])){
        header("location: ../view/login.php?params=" . $_GET["params"]);
            }
        }else {
        header("location: ../view/login.php");
        }
        exit();
    }