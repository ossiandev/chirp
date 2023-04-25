<?php
//get all the posted account information.
$email = $_POST["email"];
$password = $_POST["password"];
$username = $_POST["name"];
$confirmPassword = $_POST["confirmPassword"];
//open connection with db

$db = new SQLite3("chirpbase.sq3");
$inputQuery = "Select * from Accounts where Name like $username;";
$output = $db->query($inputQuery);
//check if there is already existing account for username
if($output == $username)
{
    header("register.php");
}
//check if there is already existing account for email
$inputQuery = "Select * from Accounts where Email like " + $email + ";";
$output = $db->query($inputQuery);
if($output == $email)
{
    header("register.php");
}
//check if confirm password is the same as password.
if($confirmPassword != $password)
{
    header("register.php");
}
// passed all checks. create account

$db -> exec("Insert Into Accounts (Name, Email, password) values ('"+$username + "', '" +  $email+ "', '" +$password +  "');"); 
//debug test next time
?>
