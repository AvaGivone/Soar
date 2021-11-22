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
        <?php
            session_start();
            session_destroy();
          
            echo "<div class = form>
                        <div class = contents>
                            <div style = 'top:50px' class = 'submit'>
                                <h3>Sign Out Successful</h3>
                            </div>
                   
                            <div style = 'width:100%; text-align:center;'><a style = 'text-algin:center' href = 'login.php'>Login</a></div>
                            <div style = 'width:100%; text-align:center;'><a style = 'text-algin:center' href = 'welcome.php'>Welcome Page</a></div>
                            
                        </div>
                    </div>";
        
        ?>
    </body>
</html>

