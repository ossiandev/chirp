<?php
$db = new SQLITE3 ('chirpbase.sq3');
$i = 0;
$accountList = $db -> query("SELECT * FROM ACCOUNTS");
while($row = $accountList ->fetchArray(SQLITE3_ASSOC))
{
    $email[$i] = $row['Email'];
    $name[$i] = $row['Name'];
    $password[$i] = $row['Password'];
}
?>


<html>
    <head>
<link rel="stylesheet" href="standardstyle.css">
<link rel="stylesheet" href="loginstyle.css">
    </head>
    <body>
            <header>
            <div>
                <a href="index.php">
                <h1>CHIRP</h1>
                </a>
                
            </div>

        </header>
        <form action="loginreg.php" method="POST">
        username/email: <input type="text" name="username">
        <br>
        password: <input type="password" name="password">
        <input type="submit" name ="submit" value="continue">
        <!--send all the users to loginreg.php-->
        <input type="hidden" name="nameList" value=<?php echo $name?>>
        </form>
        <h4>Don't have an account yet?</h4>
        <a href="register.php">
            Register here!
        </a>
    </body>

</html>

