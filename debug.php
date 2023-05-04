<?php
//connect to db

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

$i = 0;
$nameList = $db->query("Select * from Accounts;");
while($row = $nameList->fetchArray(SQLITE3_ASSOC))
{
   $names[$i]= $row['Name'];
   $id[$i] = $row['AccountID'];
   $i++;
}



for($i = 0; $i < sizeof($names); $i++)
{
    echo "$names[$i], $id[$i] "; 
    echo "<br>";
}

// log: 2 of the same name can exist.
?>