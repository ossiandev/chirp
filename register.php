<?php 
//Session Start
session_start();
//Create and connect to database
$db = new SQLite3("chirpbase.sq3");
//Create account table if it doesn't already exist
$db -> exec(
    "CREATE TABLE IF NOT EXISTS Accounts (
    AccountID INTEGER PRIMARY KEY AUTOINCREMENT,
    Name TEXT,
    Email TEXT,
    Password TEXT,
    FollowerCount INTEGER,
    FollowedCount INTEGER
  )");
  //Account ID is used to keep track of what the user does. and make it easy to find the right user.

//Create Posts table
$db->exec('CREATE TABLE IF NOT EXISTS Posts (
    PostID INTEGER PRIMARY KEY AUTOINCREMENT,
    AccountID INTEGER,
    Content TEXT,
    Likes INTEGER,
    FOREIGN KEY (AccountID) REFERENCES Accounts(AccountID)
)');
//PostID and CommentID is used for moderation and organization.
//Create Comments Table
$db->exec('CREATE TABLE IF NOT EXISTS Comments (
    CommentID INTEGER PRIMARY KEY AUTOINCREMENT,
    PostID INTEGER, 
    AccountID INTEGER,
    Content TEXT,
    Likes INTEGER,
    FOREIGN KEY (AccountID) REFERENCES Accounts(AccountID)
    FOREIGN KEY (PostID) REFERENCES Posts(PostID)
)'); 
$db->exec('CREATE TABLE IF NOT EXISTS Notifications (
    PostID INTEGER, 
    PosterID INTEGER,
    MentionedID INTEGER,
    Content TEXT,
    FOREIGN KEY (PosterID) REFERENCES Accounts(AccountID),
    FOREIGN KEY (PostID) REFERENCES Posts(PostID),
    FOREIGN KEY (MentionedID) REFERENCES Accounts(AccountID),
    FOREIGN KEY (Content) REFERENCES Posts(Content)
    
)');

$matchingPasswords = false;
$usedEmail = true;
$usedUsername = true;


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
        <?php
        //make sure $usedusername isn't null before moving on.
        if(isset($usedUsername))
        if($usedUsername){
           echo "Username in use!";
       }?>
        <br>
        email: <input type="text" name="email" maxlength="64" required> 

        <?php
        // same with email
         if(isset($usedEmail))
         if($usedEmail){
            echo "Email in use!";
        }?>
        <br>
        password: <input type="password" name="password" maxlength="32" required> 
        <br>
        <?php
        // same with matching password
         if(isset($matchingPasswords))
         if(!$matchingPasswords){
            echo "Passwords don't match! <br>";
        }?>
        confirm password: <input type="password" name="confirmPassword" maxlength="32" required>
        <input type="submit" name="post">
        </form>
        </div>
  

        <a href="login.php">
            <h4>Already have an account?</h4>
        </a>
     
    </body>

</html>

<?php

//get all the posted account information. and use escape to prevent SQL injections.
if(isset($_POST["email"])){

    $email = $db->escapeString($_POST["email"]);
    $password = $db->escapeString($_POST["password"]);
    $username = $db->escapeString($_POST['username']);
    $confirmPassword = $db->escapeString($_POST["confirmPassword"]);
 
// Remove any leading or trailing whitespace from the inputs
$email = trim($email); 
$password = trim($password); 
$confirmPassword = trim($confirmPassword); 
$username = trim($username); 
if(!($password == $confirmPassword)){
    $matchingPasswords = false;
}

//prepare query for username search 
$inputQuery = "Select * from Accounts where Name = '".$username."';";
//execute query
$output = $db->query($inputQuery);
//check if there is already existing account for username

$db -> exec("Insert Into Accounts (Name, Email, password) values ('".$username. "', '" .$email. "', '" .$password.  "');"); 
//debug test next time
}

?>

