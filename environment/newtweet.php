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
            input[type=textarea]{
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
            .errorMessage{
                color:red;
                height:2px;
                margin:0px;
                padding:0px;
                font-size:12;
                position:relative;
                top:-12px;
                display:block;
                font-family: 'Helvetica', 'Arial', sans-serif;
            }
            a:link{
                position: relative;
                top:50%;
                text-align:center;
                text-decoration:none;
                color:#667292;
            }
            </style>
    </head>
    <body style = "background-color:#bccad6">
        <?php session_start();
        $confirmation = false;
        $invalidTweet = false;
            if(isset($_SESSION['userid'])){
                    //echo "You are signed in as" . $_SESSION["userid"];
                $mysqli = new mysqli("localhost", "root", "oxbridgeacademy", "Twitter");
                
                if($mysqli->connect_errno){
                    echo "Failed to connect to MySQL:" . $mysqli->connect_error;
                    exit();
                }else{
                    if(isset($_POST['submit']) && isset($_POST['tweet']) && strlen($_POST['tweet']) <= 140){
                        $query = "INSERT INTO Posts (tweet, fk_userid) 
                                    VALUES ('{$_POST["tweet"]}', '{$_SESSION["userid"]}')";
                                    
                        $results = $mysqli -> query($query);
                        if($results == true){
                            $confirmation = true;
                        }
                        //echo "<br />";
                    }
                    else{
                        $invalidTweet = true;
                    }
                } 
            }
        if($confirmation == false){
            echo "<div style = 'height:50px; width: 100%;'></div>";
            echo "<div style = 'float:left;margin:1px 1px 1px 1px; padding: 0px; border-color: #8d9db6; display:inline-block; width:20%; height:80%; background-color:#bccad6; border-radius:10px;'>
                <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'home.php'>Home</a></div>
                <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'discover.php'>Discover Users</a></div>
                <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'logout.php'>Sign Out</a></div>
            </div>";
            echo "<div class = 'form'>
                <form action = 'newtweet.php' method='POST'>
                    <div class = 'contents'>
                        <div style ='top:50px' class = 'submit'>
                            <h3>Share with your followers</h3>
                        </div>";
                        
                        if(isset($_POST['tweet']) && $confirmation == false){
                            echo "<p class = 'errormessage'>*Did not post (remove any apostrophes)";
                        }
                        echo "<p><!--Tweet--><textarea style = ' font-size:16px; left:10%; width:100%; height:200px' type = 'textarea' name = 'tweet' placeholder = 'What do you want to say, " .$_SESSION['firstName']."?'></textarea></p>";
                        if(isset($_POST['tweet']) && $invalidTweet == true){
                            echo "<p class = 'errormessage'>*Tweet cannot exceed 140 characters";
                        }
                        
                        else{
                            echo "<p style = 'color:black;' class = 'errormessage'>*Limited to 140 characters";
                        }
                        echo "<div class = 'submit'>
                            <input id = 'button' name = 'submit' type = 'submit' value = 'Post' />
                        </div>
                    
                        
                    </div>
                </form>
                </div>
    </body>
</html>";}
        if($confirmation == true){
            header("Location: home.php");
        }
?>
