<?php 
//Session Start
session_start();
//open connection with db
$db = new SQLite3("chirpbase.sq3");

?> 
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
        <div>

        <form action="register.php" method="POST">
        username: <input type="text" name="name" maxlength="32" required>
        <br>
        email: <input type="text" name="email" maxlength="64" required> 
        <br>
        password: <input type="password" name="password" maxlength="32" required> 
        <br>
        confirm password: <input type="password" name="confirmPassword" maxlength="32" required>
        <input type="submit">
        </form>
        </div>
  

        <a href="login.php">
            <h4>Already have an account?</h4>
        </a>
     
    </body>

</html>

<?php

//get all the posted account information. and use escape to prevent SQL injections.
$email = $db->escapeString($_POST["email"]);
$password = $db->escapeString($_POST["password"]);
$username = $db->escapeString($_POST['username']);
$confirmPassword = $db->escapeString($_POST["confirmPassword"]);



//prepare query for username search 
$inputQuery = "Select * from Accounts where Name = '".$username."';";
//execute query
$output = $db->query($inputQuery);
//check if there is already existing account for username
if($output == $username)
{
    
}
//check if there is already existing account for email
//prepare and execute query again but with email
$inputQuery = "Select * from Accounts where Email = '".$email. "';";
$output = $db->query($inputQuery);
if($output == $email)
{
    header("Location: register.php");
}
//check if confirm password is the same as password.
if($confirmPassword != $password)
{
    header("Location: register.php");
}
// passed all checks. create account

$db -> exec("Insert Into Accounts (Name, Email, password) values ('".$username. "', '" .$email. "', '" .$password.  "');"); 
//debug test next time
?>

