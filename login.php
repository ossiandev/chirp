<?php
//start session so i can move data between the pages.
session_start();
//connect to database
$db = new SQLITE3 ('chirpbase.sq3');
//set index
$i = 0;
//prepare the account table
$accountList = $db -> query("SELECT * FROM ACCOUNTS");
//Fetch all the nesscesary information from the database.
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
        <div>
          <form action="login.php" method="POST">
            username/email: <input type="text" name="username" maxlength="64" required>
          <br>
             password: <input type="password" name="password" maxlength="32" required>
          <br>
           <input type="submit" name ="submit" value="continue" >
          </form>
        </div>

        <h4>Don't have an account yet?</h4>
        <a href="register.php">
            Register here!
        </a>
    </body>

</html>

<?php


$password = $_POST["password"];
$name = $_POST["username"];
if(isset($_POST['submit']))
{
    

}
?>

