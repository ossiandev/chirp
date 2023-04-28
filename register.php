<html>
    <head>
<link rel="stylesheet" href="standardstyle.css">
<link rel="stylesheet" href="registerstyle.css">
    </head>
    <body>
        <header>
            <div>
                <a href="index.php">
                <h1>CHIRP</h1>
                </a>
                
            </div>

        </header>
        
        <form action="registerreg.php" method="POST">
        username: <input type="text" name="name" method="GET">
        <br>
        email: <input type="text" name="email"> 
        <br>
        password: <input type="password" name="password">
        <br>
        confirm password: <input type="password" name="confirmPassword">
        <input type="submit">
        </form>

        <a href="login.php  ">
            <h4>Already have an account?</h4>
        </a>
     
    </body>

</html>