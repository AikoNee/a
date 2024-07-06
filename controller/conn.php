<?php
    $conn = new mysqli("localhost" , "root" , '' , 'ewall8');

    if($conn->connect_error)
        die('Connection Error' . $conn->error);