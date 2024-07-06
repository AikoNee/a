
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>E-Wall-8</title>
    <script src="../assets/jquery-3.7.1.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family:cursive;
        }
        .main-section {
            width: 100%;
            height: auto;
        }
        .top-section {
            background-color: #0A8E81;
            width: 90%;
            height: 20%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 2%;
            padding-right: 9%;
        }
       
        .container {
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            align-items: top;
            justify-content: center;
            border: solid 2px #0A8E81;
            border-radius: 5px;
            background-image: url("../assets/000.png");
            background-size:cover;
            background-repeat: no-repeat;
            background-position: 0;
            width: 90%;
            height: 260%;
            
        }    
        h1 {
            color:#F8EA65;
            font-size: 50px;
        }
        button {
            width: 90%;
            height: 30%;
            background-color:#99D83E;
            margin-top: 5px;
            border: solid 5px #50761E;
            border-radius: 5px;
            color: #50761E;
            font-weight:900;
        }
        button:hover {
            background-color: #7aae31;
            cursor: pointer;
        }

        form {
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        
        .register-div , .login-div {
            background-color: #99D83E;
            width: 80%;
            height: 90%;
            border: solid 5px #50761E;
            border-radius: 5px;
            display: none;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
            position: absolute;
        }
        .register-div div , .login-div div {
            margin-top: 20px;
            margin-bottom: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        input[type='text'] , input[type="password"] {
            background-color:#bcff5f;
            margin-top: 5px;
            border: solid 5px #50761E;
            border-radius: 5px;
            color: #50761E;
            font-weight:900;
            width: 33%;
            height: 50px;
            padding: 5px;
        }
        input[type="submit"] {
            background-color:#f5d543;
            margin-top: 5px;
            border: solid 5px #50761E;
            border-radius: 5px;
            color: #50761E;
            font-weight:900;
            width: 30%;
            height: 50px;
            padding: 5px;
        }
        input[type="submit"]:hover {
            background-color: #cfb438;
            cursor: pointer;
        }
       .close {
        position: absolute;
        top: 0;
        right: 0;
       }

    </style>
</head>
<body>
    <section class="top-section">
        <h1>E-Wall-8</h1>
        <?php 
            if(isset($_GET["params"])){
                if(!empty($_GET['params'])){
                    echo $_GET['params'];
                }
            }
        ?>
        <div>
            <button type="button" id="registerButton">Register</button>
            <button type="button" id="loginButton">Login</button>
        </div>
    </section> 
    <section class="main-section">
    <div class="container">
        <div id="login-div" class="login-div">
            <img src="../assets/close.png" alt="close" id="close2" class="close">
            <form action="../controller/login.php" method="post">
                <h2>Welcome back! </h2>
            
                <input name="username" placeholder="Username" type="text" required>
                <input name="password" placeholder="Password" type="password" required>
             
                <input type="submit" value="Login">
                
            </form>
        </div>


        <div id="register-div" class="register-div">
            <img src="../assets/close.png" alt="close" id="close" class="close">
            <form action="../controller/register.php" method="post">
                <h2>Welcome , It's nice to see a new face! </h2>
              <div>
                <input name="username" placeholder="Username" type="text" required>
                <input name="password" placeholder="Password" type="password" required>
                <input name="confirm_password" placeholder="Confirm Password" type="password" required>
              </div>
               <div>
                <input name="Fname" placeholder="First Name" type="text" required>
                <input name="Lname" placeholder="Last Name" type="text" required>
                <input name="Mname" placeholder="Middle Name" type="text" required>
                </div>
                <div>
                    <input type="checkbox" required><p>I Agree that I am 18 years old or above, and entered the informations correctly.</p>
                    
                </div>
                <input type="submit" value="Register">
                
            </form>
        </div>



    </div>
    </section>

    <script>
        $(document).ready(()=>{
        $("#loginButton").click(()=>{
           if(document.getElementById("login-div").style.display == "none"){
            $("#login-div").css("display" , "flex");
           } else {
            $("#login-div").css("display" , "none");
           }
        })
        $("#registerButton").click(()=>{
           if(document.getElementById("register-div").style.display == "none"){
            $("#register-div").css("display" , "flex");
           } else {
            $("#register-div").css("display" , "none");
           }
        })
     $("#close").click(()=>{
            $("#login-div").css("display" , "none");
            $("#register-div").css("display" , "none");
       })
    })
    $("#close2").click(()=>{
            $("#login-div").css("display" , "none");
            $("#register-div").css("display" , "none");
       })
   
    </script>

</body>
</html>