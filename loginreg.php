<?php

$db = new SQLite3("chirpbase.sq3");
$password = $_POST["password"];
$name = $_POST["username"];
if(isset($_POST['submit']))
{

    if($row['Email']==$_POST['username'])
    {
        if($row['password']==$_POST['password'])
        {
            echo"<h1> Welcome Jim</h1>";
        }
        else
        {
            header("Location:login.php");
        }
    }
}
?>


