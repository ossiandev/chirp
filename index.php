
<html>

<head>
    <title>

    Chirp
    </title>
    <link rel="stylesheet" href="indexstyle.css">
    
</head>

<body>
    <header class="headerStyle">
       <div>
            <h1 class="headerTextTitle">Chirp</h1>  
            <button class="headerTextLogin">Login</button>

        </div>
    </header>
    <div>

    </div>
    <footer>

    </footer>

</body>
</html>
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




 /* 
  $sql = "INSERT INTO Accounts (Name, Email, Password, FollowerCount, FollowedCount) VALUES ('$name', '$email', '$password', $follower_count, $followed_count)";
   */
// close the database connection
$db->close(); 

?>