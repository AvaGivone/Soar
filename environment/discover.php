<html>
    <head>
        <style>
            .tweet{
                font-family: 'Helvetica', 'Arial', sans-serif;
                margin: auto;
                width: 50%;
                border:3px;
                height:56px;
                padding:auto;
                border-color: #8d9db6;
                border-style:double;
                background:#f1e3dd;
                border-radius:10px;
            }
            .contents{
                margin:auto;
                border-bottom-left-radius: 2px;
                height:56px;
                width:100%;
            }
            
            h3, h1{
                margin:auto;
                position:relative;
                top:0px;
                text-align:center;
                
            }
            p{
                font-size:16px;
                font-weight:normal;
                text-align:center;
                font-weight:normal;
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
        
        $users = array();
        
        $mysqli = new mysqli("localhost", "root", "oxbridgeacademy", "Twitter");
        
        if($mysqli->connect_errno){
            echo "Failed to connect to MySQL:" . $mysqli->connect_error;
            exit();
        }else{
            $query = "SELECT DISTINCT username, firstName, lastName, COUNT(tweet) AS numPosts FROM Users LEFT JOIN Posts ON Users.pk_userid = Posts.fk_userid 
                            WHERE NOT username='{$_SESSION['username']}' GROUP BY pk_userid";
            $results = $mysqli -> query($query);
            
            for($i=0; $i < $results->num_rows; $i++){
                $row = $results->fetch_array(MYSQLI_ASSOC);
                $users[$i] = array($row['username'], $row['firstName'], $row['lastName'], $row['numPosts']);
            }
            
        } 
        echo "<h1>Discover other users</h1>
        <div style = 'float:left;margin:1px 1px 1px 1px; padding: 0px; border-color: #8d9db6; display:inline-block; width:20%; height:80%; background-color:#bccad6; border-radius:10px;'>
            <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'home.php'>Home</a></div>
            <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'newtweet.php'>Post</a></div>
            <div style = 'border-color: #8d9db6; margin:0px auto; background-color:#f1e3dd; width:80%; height: 33%; text-align:center;'><a style = 'text-algin:center' href = 'logout.php'>Sign Out</a></div>
        </div>";
        echo 
        "<div class = 'tweet'>
            <div class = 'contents'>
                <div class = 'col' style = 'float:left; margin:auto 0px; width:33%; height:56px;'><p style = 'font-size:20px; font-weight:bold;'>User</p></div>
                <div class = 'col' style = 'float:left; margin:auto 0px; width:33%; height:56px;'><p style = 'font-size:20px; font-weight:bold;'>Name</p></div>
                <div class = 'col' style = 'float:right; margin:auto 0px; width:33%; height:56px;'><p style = 'font-size:20px; font-weight:bold;'># of Posts</p></div>
                
            </div>
        </div>";
    for($i= 0; $i < sizeof($users); $i++){
        echo 
        "<div class = 'tweet'>
            <div class = 'contents'>
                <div class = 'col' style = 'float:left; margin:auto 0px; width:33%; height:56px;'><p>{$users[$i][0]}</p></div>
                <div class = 'col' style = 'float:left; margin:auto 0px; width:33%; height:56px;'><p>{$users[$i][1]} {$users[$i][2]}</p></div>
                <div class = 'col' style = 'float:right; margin:auto 0px; width:33%; height:56px;'><p>{$users[$i][3]}</p></div>
                
            </div>
        </div>";
    }
        ?>
            
    </body>
</html>