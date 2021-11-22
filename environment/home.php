<html>
    <head>
        <style>
            .tweet{
                font-family: 'Helvetica', 'Arial', sans-serif;
                margin: auto;
                width: 50%;
                border:3px;
                height:auto;
                padding:auto;
                border-color: #8d9db6;
                border-style:double;
                background:#f1e3dd;
                border-radius:10px;
            }
            .contents{
                margin:auto;
                border-bottom-left-radius: 2px;
            }
            
            h3, h1{
                margin:auto;
                position:relative;
                top:0px;
                text-align:center;
            }
            .timestamp{
                color:#667292;
                height:2px;
                margin:0px;
                padding:0px 5px;
                font-size:14;
                position:static;
                top:-12px;
                display:block;
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
        $tweets = array();
        
        if(isset($_SESSION['userid'])){
            //echo "You are signed in as" . $_SESSION["userid"];
        $mysqli = new mysqli("localhost", "root", "oxbridgeacademy", "Twitter");
        
        if($mysqli->connect_errno){
            echo "Failed to connect to MySQL:" . $mysqli->connect_error;
            exit();
        }else{
            $query = "SELECT * FROM Posts WHERE fk_userid = {$_SESSION["userid"]} ORDER BY created DESC";
            $results = $mysqli -> query($query);
            echo "<br />";
            for($i=0; $i < $results->num_rows; $i++){
                $row = $results->fetch_array(MYSQLI_ASSOC);
                $tweets[$i] = array($row['tweet'], $row['created']);
                //echo "<li>{$row['tweet']} at {$row['created']}</li>";
                //echo "<li>{$tweets[$i][0]} at {$tweets[$i][1]}</li>";
            }
            
        } 
        }
        
    
        echo "<h1>Welcome back, " . $_SESSION['firstName'] . "</h1>
        <div style = 'float:left;margin:1px 1px 1px 1px; padding: 0px; border-color: #8d9db6; display:inline-block; width:20%; height:80%; background-color:#bccad6; border-radius:10px;'>
            <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'discover.php'>Discover Users</a></div>
            <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'newtweet.php'>Post</a></div>
            <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'logout.php'>Sign Out</a></div>
        </div>";
    
    for($i= 0; $i < sizeof($tweets); $i++){
        echo "<div class = 'tweet'>
            <div class = 'contents'>
                <div class = 'timestamp'><p>". $_SESSION['username'] . " tweeted on ". $tweets[$i][1] . "</p></div>
                <h6 style = 'font-size:16; padding:20px 5px; margin:auto; font-weight:normal;'>{$tweets[$i][0]}</h6>
            </div>
            </div>";
    }
    if(sizeof($tweets) == 0){
        echo "<div class = 'tweet'>
            <div class = 'contents'>
                <h6 style = 'font-size:16; padding:20px 5px; margin:auto; font-weight:normal;'>You don't have any posts yet...</h6>
            </div>
            </div>";
    }
        ?>
        
        
    </body>
</html>
