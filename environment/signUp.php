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
                position:relative;
                left:20%;
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
            a:link{
                text-align:center;
                text-decoration:none;
                color:#667292;
            }
            
        </style>
    </head>
    <body style = "background-color:#bccad6">
        <div class = "nab">
            <p></p>
        </div>
        <?php
            $mysqli = new mysqli("localhost","root","oxbridgeacademy","Twitter");
           # $infoFields = array("username", "password", "firstName", "lastName", "passwordCheck", "email", "sumbit");
            $submitToUsers = false;
            $passwordsMatch = true;
            $submitPassword = false;
            
            
            // Check connection
            if ($mysqli->connect_errno) {
              echo "Failed to connect to MySQL: " . $mysqli->connect_error;
              exit();
            } else{
                if(isset($_POST["submit"]) && strcmp($_POST["submit"], "Create Account") == 0){
                        if($_POST["password"] != '' && isset($_POST["password"]) && isset($_POST["passwordCheck"])){
                            if(strcmp($_POST["password"], $_POST["passwordCheck"]) == 0){
                                $submitPassword = true;
                            }
                        }
            
                        if($submitPassword == true && isset($_POST["firstName"]) && $_POST["firstName"]!='' && isset($_POST["lastName"]) && $_POST["lastName"]!='' && isset($_POST["email"]) && $_POST["email"]!='' && isset($_POST["birthdate"]) && $_POST["birthdate"]!='' && isset($_POST["username"]) && $_POST["username"]!=''){
                            $submitToUsers = true;
                        }
                        else{
                            $submitToUsers = false;
                        }
                    
                    if($submitToUsers == true){   
                        //insert into the database
                        $query = "INSERT INTO Users (username, password, firstName, lastName, email, birthdate) 
                        VALUES ('{$_POST["username"]}', '{$_POST["password"]}', '{$_POST["firstName"]}', 
                        '{$_POST["lastName"]}', '{$_POST["email"]}', '{$_POST["birthdate"]}')";
                        
                        $results = $mysqli->query($query);
                        
                        if($results == false){
                            $submitToUsers = false;
                            echo "<p>{$mysqli->error}</p>";
                        }
                    }
                }
            }
        
            if($submitToUsers == true){
                //Confirmation Page
                echo "<div class = form>
                        <div class = contents>
                            <div style = 'top:50px' class = 'submit'>
                                <h3>Sign Up Successful</h3>
                            </div>
                            <p style = 'text-align:center'>Welcome to Soar!</p>
                            <div style = 'width:100%; text-align:center;'><a style = 'text-algin:center' href = 'login.php'>Login</a></div>
                        </div>
                    </div>";
            }
        
        if($submitToUsers == false){
            $_POST["submit"] = '';
        echo "<div class = 'form'>";
            echo "<form action = 'signUp.php' method='POST'>";
                echo "<div class = 'contents'>";
                    echo "<div style ='top:50px' class = 'submit'>";
                        echo "<h3>Sign Up</h3>";
                    echo"</div>";
                    if(isset($_POST["firstName"])){
                        if($_POST["firstName"] != ''){
                            echo"<p><!--First Name--><input type = 'text' name = 'firstName' value ='" .$_POST["firstName"]. "'/></p>";
                        }
                        else{
                            echo"<p><!--First Name--><input type = 'text' name = 'firstName' placeholder = 'First Name'/></p>";
                        }
                    }
                    else{
                        echo"<p><!--First Name--><input type = 'text' name = 'firstName' placeholder = 'First Name'/></p>";
                    }
                        if(isset($_POST["firstName"]) && (strcmp($_POST["firstName"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }
                    
                    if(isset($_POST["lastName"])){
                        if($_POST["lastName"] != ''){
                            echo"<p><!--Last Name--><input type = 'text' name = 'lastName' value ='" .$_POST["lastName"]."'/></p>";
                        }
                        else{
                            echo "<p><!--Last Name--><input type = 'text' name = 'lastName' placeholder = 'Last Name'/></p>";
                        }
                    }
                    else{
                        echo "<p><!--Last Name--><input type = 'text' name = 'lastName' placeholder = 'Last Name'/></p>";
                    }
                        if(isset($_POST["lastName"]) && (strcmp($_POST["lastName"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }
                    
                    if(isset($_POST["email"])){
                        if($_POST["email"] != ''){
                            echo"<p><!--Email--><input type = 'text' name = 'email' value ='" .$_POST["email"]."'/></p>";
                        }
                        else{
                            echo "<p><!--Email--><input type = 'text' name = 'email' placeholder = 'Email'/></p>";
                        }
                    }
                    else{
                        echo "<p><!--Email--><input type = 'text' name = 'email' placeholder = 'Email'/></p>";
                    }
                        if(isset($_POST["email"]) && (strcmp($_POST["email"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }
                        
                    if(isset($_POST["username"])){
                        if($_POST["username"] != ''){
                            echo"<p><!--Username--><input type = 'text' name = 'username' value ='" .$_POST["username"]."'/></p>";
                        }
                        else{
                            echo "<p><!--Username--><input type = 'text' name = 'username' placeholder = 'Username'/></p>";
                        }
                    }
                    else{
                        echo "<p><!--Username--><input type = 'text' name = 'username' placeholder = 'Username'/></p>";
                    }
                        if(isset($_POST["username"]) && (strcmp($_POST["username"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }

                    echo "<p><!--Password--><input type = 'password' name = 'password' placeholder = 'Password'/></p>";

                        if(isset($_POST["password"]) && (strcmp($_POST["password"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }

                    echo "<p><!--Password--><input type = 'password' name = 'passwordCheck' placeholder = 'Confirm Password'/></p>";
                    
                        if(isset($_POST["passwordCheck"]) && (strcmp($_POST["passwordCheck"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }
                        
                        else if(isset($_POST["password"]) && isset($_POST["passwordCheck"]) && (strcmp($_POST["password"], $_POST["passwordCheck"]) != 0)){
                            $passwordsMatch = false;
                            if($passwordsMatch == false){
                                echo "<div class = 'errorMessage'><p>*Passwords don't match</p></div>";
                            }
                        }
                    
                    if(isset($_POST["birthdate"])){
                        if($_POST["birthdate"] != ''){
                            echo"<p><!--Birthdate--><input type = 'text' name = 'birthdate' value ='" .$_POST["birthdate"]."'/></p>";
                        }
                        else{
                            echo "<p><!--Birthdate--><input type = 'text' name = 'birthdate' placeholder = 'Birthdate (YYYY-MM-DD)'/></p>";
                        }
                    }
                    else{
                        echo "<p><!--Birthdate--><input type = 'text' name = 'birthdate' placeholder = 'Birthdate (YYYY-MM-DD)'/></p>";
                    }
                        if(isset($_POST["birthdate"]) && (strcmp($_POST["birthdate"], "") == 0)){
                            echo "<div class = 'errorMessage'><p>*Field must be completed</p></div>";
                        }
                    
                    echo "<div class = 'submit'>";
                        echo "<input style = 'font-style:bold; font-family:ariel' id = 'button' name = 'submit' type = 'submit' value = 'Create Account' />";
                    echo"</div>";
                    
                echo "</div>";
            echo "</form>";
        echo "</div>";
       } ?>
    </body>
</html>
