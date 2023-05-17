<?php
session_start();

if (isset($_SESSION['accountid'])) {
    // User is logged in, display logged-in content
    $db = new SQLite3("chirpbase.sq3");
    $accountID = $_SESSION['accountid'];
    $result = $db->query("SELECT * FROM ACCOUNTS WHERE AccountID = $accountID;");
    
    $row = $result->fetchArray();
    if ($row && isset($row['Name'])) {
        $name = $row['Name'];
     
    } 
}
?>
<html>
<head>
    <title>

    Chirp
    </title>
    <link rel="stylesheet" href="indexstyle.css">
    
</head>

<body style="    background: linear-gradient(120deg, #2980b9,#8e44ad);">
    <header class="headerStyle">
       <div>
            <h1 class="headerTextTitle">
                Chirp
            </h1>  
            <?php
            if(!isset($_SESSION['accountid'])){
            ?>
            <a href="login.php"class="headerTextLogin">
                Login
            </a>
            <a href="register.php"class="headerTextLogin">
                Register
            </a>
            
                
        </div>
        <div>
        <?php }
            else{
                ?>
                <h2>Welcome <?php echo $name ;}?></h2>
        </div>
        <div class = "signout">
            <form action="index.php" method="POST">
            <input type="submit" value="submit" name="submit">
                <?php if(isset($_POST['submit'])) {
                    $_SESSION = array();
                    session_destroy();
                    header("Location: exit.php");
                    exit;
                } ?>
            </form>
            
        </div>
    </header>
    <div>

    </div>
    <footer>
    <div>
        
    </div>
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



 /* 
  $sql = "INSERT INTO Accounts (Name, Email, Password, FollowerCount, FollowedCount) VALUES ('$name', '$email', '$password', $follower_count, $followed_count)";
   */
// close the database connection
$db->close(); 

?>