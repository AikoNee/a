<?php
    include "conn.php";
    session_start();

    if( isset( $_SESSION['username']) && isset( $_SESSION['password'])){
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
    
        if(empty($username) || empty($password)){
            header("Location: ../login.php?params=<p style='color:red;'>Please Login Again</p>");
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