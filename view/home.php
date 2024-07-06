<?php
    include "../controller/functions.php";
    session_start();
    if(empty($_SESSION['ID'])){
        header("location: login.php?params=<p>You must login first</p>");
        exit();
    }
    if(expiredSessionTime($_SESSION["SessionStartTime"])){
        header("Location: ../controller/logout.php?params=Session expired");
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='../assets/jquery-3.7.1.min.js'></script>
    <title>E-Wall-8</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            font-family:cursive;
            text-decoration: none;
        }
        body {
            background: url("../assets/bg.jpg");
            background-position: 0;
            background-size: cover;
            background-repeat: no-repeat;
        }
        header {
            background-color: #0A8E81;
            width: 90%;
            height: 15%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 2%;
            padding-right: 9%;
        }
        header div {
            display: flex;
            flex-direction: row;
            gap: 60px;
        }
        h2 {
            color: #4ef58e;
            font-weight: 900;
        }
        h1 {
            color:#F8EA65;
            font-size: 50px;
        }
        h4 {
            font-weight: 900;
            font-size: 30px;
        }
        a {
            text-align: center;
            padding-top:10px;
            width: 200px;
            height: 28px;
            background-color:#99D83E;
            border: solid 5px #50761E;
            border-radius: 5px;
            color: #50761E;
            font-weight:500;
        }
        a:hover {
            background-color: #7eb334;
        }
        .container {
            margin-top: 3%;
            height: 75%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container .subdiv {
            background-color : #7EDAEF;
            border: solid 10px #50761E;
            border-radius: 10px;
            width: 90%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 50px;
            padding-bottom: 20px;
        }
        .subdiv div {
            width: 80%;
        }
        .recentTransactionDiv {
            width: 80%;
            height: 70%;
            overflow-y: scroll;
            border: solid 4px #50761E;
            border-radius: 5px;
        }
        .recentTransactionTable {
            border: solid 2px #F8EA65;
            width: 100%;
        }
         td {
            text-align: center;
            border: solid 2px #F8EA65;
            color: #1c2214;
            font-weight: 800;
            font-size: large;
        }
        th {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #6AC937;
            border: solid 2px #000000;
        }
        tr{
            background-color: #F8EA65 ;
        }
        tr:nth-child(odd){
            background-color: #6AC937;
        }
        button {
            width: 200px;
            height: 50px;
            border:solid 5px #50761E;
            background-color:#99D83E;
            margin-top: 5px;
            border: solid 5px #50761E;
            border-radius: 5px;
            color: #50761E;
            font-weight:900;
            border-radius: 5px;
            font-weight: 900;
        }
        .transactionButtonDiv {
            display: flex;
            align-items: center;
            justify-content: space-between ;
        }
        .balance {
            margin-top: 40px;
            width: 50px;
            text-align: center;
            border:solid 4px #17ce5d;
            background-color: #17ce5d;
            border-radius: 25px;
            height: 15%;
        }
    </style>
</head>
<body>
    <header>
        <div>
        <h1>E-WALL-8</h1>
    </div>
    

        <div>
            <?php
            
            echo "<h2>" . $_SESSION['Fname'] . "</h2>";

            ?>
            <a href="../controller/logout.php" >Logout</a>
        </div>
    </header>
    <section id="container" class="container">
        <div class="subdiv">
                <div class="balance">
                   <?php
                echo "<h3>My ID: " . $_SESSION['ID'] . "</h3>";
                echo "<h4>Balance: P" . $_SESSION['Balance'] . "</h4>";
                ?>
                </div>
                <div class="transactionButtonDiv">
                    <a href="./send.php">Send Money</a>
                    <a href="../controller/refresh.php">Refresh</a>
                    <button type="button" id="toggleTransactions">Show / Hide Transactions</button>
                    
                </div>
               <div class="recentTransactionDiv">
                    <table class="recentTransactionTable" >
                        <tr><th>Date</th><th>Transaction ID</th><th>Type</th><th>To/From</th><th>Ammount</th></tr>
                      <?php
                        include "../controller/conn.php";
                        $userID = $_SESSION['ID'];
                        $res = $conn->query("SELECT * FROM transactions WHERE recieverID = $userID OR senderID = $userID");
                        if($res->num_rows > 0 ){
                            while($row = $res->fetch_assoc()){
                                if($row['recieverID'] == $userID){
                                echo "<tr><td>" . $row['Date'] . "</td><td>" . $row["transactionID"]  . "</td><td>" . "Recieved" . "</td><td>" . $row["senderFullName"] . "</td><td>" . $row["Ammount"] . "</td></tr>";
                            }else {
                                echo "<tr><td>" . $row['Date'] . "</td><td>" . $row["transactionID"]  . "</td><td>" . "Sent" . "</td><td>" . $row["receiverFullName"] . "</td><td>" . $row["Ammount"] . "</td></tr>";
                            }
                        }
                        }
                      ?>
                    </table>
                </div>
                </div>
        </div>
    </section>
    <script>
        $("#toggleTransactions").click(()=>{
            $(".recentTransactionDiv").toggle();
        })
    </script>
</body>
</html>