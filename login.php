<?php


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
          <?php
          if(isset($_POST['submit'])){
              echo "Wrong name or password!";
          } ?> 
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



if(isset($_POST['submit']))
{
    echo "Button pressed! <br>";

    $password = ($_POST["password"]);
    $username = ($_POST["username"]);
    //prepare sql statement because it protects the application from SQL injections.
    $stmt = $db->prepare('SELECT * FROM ACCOUNTS WHERE  Name = :name AND Password = :password');
    //bind the parameters with the input from user.i made in the prepare.
    $stmt -> bindParam(':name',$username);
    $stmt -> bindParam(':password',$password);

    $result = $stmt->execute();
    $row = $result->fetchArray();
    if($row != false)
    {
        $name = $row['Name'];
        if($name)
        {
            echo "Name was found! <br>";
            // name matches!
            if($password)
            {
                // exists with username 
                echo "Password matches! <br>";

              // Login is successful and set $_SESSION['accountid']
                session_start();
                $_SESSION['accountid'] = $row['AccountID'];
                header("Location: index.php");
                echo "Success!";
            }
        
        }
        else
        {
            // username doesnt exist or wrong name 
            echo "Username doesn't exist! <br>";
    
        }
    
    }


}
?>


