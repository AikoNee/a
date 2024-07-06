<?php
    include "conn.php";
    session_start();

    if( isset( $_POST['username']) && isset( $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmpassword = $_POST['confirm_password'];
        $Fname = $_POST["Fname"];
        $Lname = $_POST["Lname"];
        $Mname = $_POST["Mname"];
        if(empty($username) || empty($password)){
            header("Location: ../view/login.php?params=<p style='color:red;'>Enter username and password</p>");
            exit();
        }
        if($password != $confirmpassword){
            header("Location: ../view/login.php?params=<p style='color:red;'>Password doesn't match</p>");
            exit();
        }
        $res = $conn->query("SELECT * FROM users WHERE username='$username'");
        if ($res->num_rows == 1) {
            header("Location: ../view/login.php?params=username already exist");
            exit();
        }

        if($conn->query("INSERT INTO users( username , `password` , Fname , Lname , Mname , Balance ) VALUES ( '$username' , '$password' , '$Fname' , '$Lname' , '$Mname' , 0.0 )")){


        header("Location: ../view/login.php?params=Successfully created account");
        exit();
        
    }   else {
        header("Location: ../view/login.php?params=Error please insert correct details.");
        exit();
    }
}