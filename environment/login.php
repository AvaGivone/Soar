<html>
    <head>
        <style>
            .form{
                font-family: 'Helvetica', 'Arial', sans-serif;
                margin: auto;
                width: 50%;
                border:3px;
                padding:20px;
                border-color: #8d9db6;
                border-style:double;
                background:#f1e3dd;
                border-radius:10px;
            }
            .contents{
                margin:auto;
            }
            input[type=text], input[type=password]{
              font-family: 'Helvetica', 'Arial', sans-serif;
              border-color:#bccad6;  
              margin:auto;
              width:60%;
              height:30px;
              position:relative;
              left:20%;
            }
            h3{
                margin:auto;
                position:relative;
                top:0px;
                text-align:center;
            }
            .submit{
                padding: 8px 20px;
                border-color:black;  
                border:3px;
                background-color:#f1e3dd;
                margin: auto;
                text-align:center;
                font-family: 'Helvetica', 'Arial', sans-serif;
            }
            .errorMessage{
                color:red;
                height:2px;
                margin:0px;
                padding:0px;
                font-size:12;
                position:static;
                text-align:center;
                left:50%;
                top:-12px;
                display:block;
            }
            #button {
                  background-color: #bccad6;
                  border: none;
                  color: white;
                  padding: 15px 32px;
                  text-align: center;
                  text-decoration: none;
                  display: inline-block;
                  font-size: 16px;
                  font-family: 'Helvetica', 'Arial', sans-serif;
            }
        </style>
    </head>
    <body style = "background-color:#bccad6">
        <?php
            session_start();
            $validLogin = true;
            $continue = true;
            $mysqli = new mysqli("localhost","root","oxbridgeacademy","Twitter");
 
            if ($mysqli->connect_errno) {
              echo "Failed to connect to MySQL: " . $mysqli->connect_error;
              exit();
            } else{
                if(isset($_POST["submit"]) && strcmp($_POST["submit"], "Login") == 0){
                
                    $query = "SELECT * FROM Users WHERE username='{$_POST["username"]}'AND password='{$_POST["password"]}'";
                    $results = $mysqli->query($query);
                    
                    $row = $results->fetch_array(MYSQLI_ASSOC);
                
                    if($row!=NULL){
                        $validLogin = true;
                        $_SESSION["userid"] = $row["pk_userid"];
                        $_SESSION["username"] = $row["username"];
                        $_SESSION["firstName"] = $row["firstName"];
                        //echo("You are logged in as: " . $_SESSION["userid"]);
                        $continue = false;
                        header("Location: home.php");
                    }
                    else{
                        $validLogin = false;
                        $continue = true;
                    }
                }
            }
        if($continue == true){
            echo
           "<div class = 'form'>
                <form action = 'login.php' method='POST'>
                    <div class = 'contents'>
                        <div style ='top:50px' class = 'submit'>
                            <h3>Login</h3>
                        </div>";
                        
                        if($validLogin == false){
                            echo "<div class = 'errorMessage'><p>*Invalid username and/or password</p></div>";
                        }
                        
                        echo "<p><!--Username--><input type = 'text' name = 'username' placeholder = 'Username'/></p>
    
                        <p><!--Password--><input type = 'password' name = 'password' placeholder = 'Password'/></p>";
    
                        echo "<div class = 'submit'>
                            <input style = 'font-style:bold; font-family:ariel' id = 'button' name = 'submit' type = 'submit' value = 'Login' />
                        </div>
                        
                    </div>
                </form>
            </div>";
        }
        ?>
    </body>
</html>

