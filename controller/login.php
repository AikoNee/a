<?php
    include "conn.php";
    session_start();

    if( isset( $_POST['username']) && isset( $_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        if(empty($username) || empty($password)){
            header("Location: ../view/login.php?params=<p style='color:red;'>Enter username and password</p>");
            exit();
        }

        $res = $conn->query("SELECT * FROM users WHERE username='$username' AND `password`='$password'");
        if ($res->num_rows == 1) {
            $row = $res->fetch_assoc();
            $_SESSION['ID'] = $row["ID"];
            $_SESSION["username"] = $row['username'];
            $_SESSION["password"] = $row['password'];
            $_SESSION["Fname"] = $row['Fname'];
            $_SESSION["Lname"] = $row['Lname'];
            $_SESSION["Mname"] = $row['Mname'];
            $_SESSION["SessionStartTime"] = time();
            $_SESSION["Balance"] = $row['Balance'];
            header("Location: ../view/home.php?user=" . $username);
            exit();
        }
        header("Location: ../view/login.php?params=<p style='color:red;'>User not found.</p>");
        

    }

    