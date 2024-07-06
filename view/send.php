<?php
    session_start();
    if(empty($_SESSION['ID'])){
        header("location: login.php?params=<p>You must login first</p>");
        exit();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Wall-8</title>
    <script src="../assets/jquery-3.7.1.min.js"></script>
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
            padding-top:5px;
            width: 200px;
            height: 30px;
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
            text-align:center;
        }
        form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap:10px;
        }
        input {
            text-align:center;
            width: 200px;
            height: 50px;
            background-color:#99D83E;
            border: solid 5px #50761E;
            border-radius: 5px;
            color: #50761E;
            font-weight:500;
        }
        input:focus {
            background-color: #74a530;
        }
        input:hover {
            background-color: #74a530;
        }

        /* REMOVE ADD AND DECREASE BUTTON */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
    <a href='./home.php'>Back to home</a>
        <div>
            <?php
            
            echo "<h2>" . $_SESSION['username'] . "</h2>";

            ?>
            <a href="../controller/logout.php" >Logout</a>
        </div>
    </header>
    <section id="container" class="container">
        <div class="subdiv">
                <div>
                    <?php 
                    if(isset($_GET["params"])){
                        if(!empty($_GET["params"])){
                            echo "<h4>Instant Send</h4>";
                            echo $_GET["params"];
                        }
                    }else {
                        echo "<h4>Instant Send</h4>";
                    }
                    ?>
                </div>
                <div>
                    <form action="../controller/send.php" method="post" >
                    <div>
                        <label for="ID">User ID:</label>
                        <input type="number" name="ID" id="ID" required>
                    </div> 
                    <div>
                        <label for="username">User:</label>
                        <input name="username" disabled id="username" value="Enter Id to show user">
                    </div>
                    <div>
                        <label for="ID">Ammount:</label>
                        <input type="number" name="Ammount" id="Ammount" required>
                    </div>
                        <input type="submit" value="Send">
                    
                    </form>

                </div>
                <div>
                    <p>
                        To send money to other user, You must get their ID which can be located at the top of their balance.<br>
                        Sent money will not and cannot be refunded. Please recheck your details to ensure they are correct before submitting.
                    </p>

                </div>
        </div>
    </section>
    <script>
            
            $("#ID").change(async ()=>{
               await getUser();
            })

            async function getUser(){
                let value = $("#ID").val();
                if(!value) return;
                let res = await fetch(`http://localhost/Ewall8/controller/getuser.php?userID=${value}`);
                let parsedData = await res.text();
                
                $("#username").val(parsedData)
            } 
        </script>
</body>
</html>