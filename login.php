<!DOCTYPE html>
<html>
    <head>
        <title>Login Takterassen</title>
        <link rel="stylesheet" href="loginstyle.css?v=1.1">
        <?php include 'db.php';
        include 'Databaseinfo.php';
        session_start();
        ?>
    </head>
    <body>
        <div class="header">
            <h1>TAKTERASSEN</h1>
        </div>
        <div class="topnav">
            <a class="home" href="#home">Home</a>
            <a href="#profile">Profile</a>
            <a href="Logout.php">Log Out</a>
          </div>
        <div class="background">
            <div class="form-box">
                <div class="button-box">
                    <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Log In</button>
                    <button type="button" class="toggle-btn" onclick="register()">Register</button>
                    

                

                </div>
                <form id="LoginForm" class="formclass" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="text" class="input-field" placeholder="Enter Username" name="uid" required>
                    <input type="password" class="input-field" placeholder="Enter Password"  name="pwd" required>
                    <input type="submit" class="submit-btn" name ="btnLoginAccount" value="Login"></input>
                    <div class="section-action-container">
                    <a href="#" class="a-fb">
                    <div class="fb-button-container">
                    Login with Facebook(PHP)
                    </div>
                    </a>

                    </div>
                </form>
              
                <form id="CreateUserForm" class="formclass" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <input type="text" placeholder="Enter E-mail" name="email" class="input-field" required>
                    <input type="text" placeholder="Enter Username" name="username" class="input-field" required>
                    <input type="password" placeholder="Enter Password" name="password" class="input-field" required>
                    <input type="submit" class="submit-btn" name ="btnCreateAccount" value="Create Account"></input>

                </form>
            
            </div>
        </div>
        
        <spasscript>
            var x = document.getElementById("LoginForm");
            var y = document.getElementById("CreateUserForm");
            var z = document.getElementById("btn");
            function register(){
                x.style.left ="-400px";
                y.style.left ="50px";
                z.style.left ="110px";
            }
            function login(){
                x.style.left ="50px";
                y.style.left ="450px";
                z.style.left ="0";
            }
        </script>
    </body>
</html>