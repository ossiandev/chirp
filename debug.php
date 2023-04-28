<?php
//connect to db

$db = new SQLite3("chirpbase.sq3");
$db -> exec("DELETE FROM ACCOUNTS WHERE ACCOUNTID = 4;");

$i = 0;
$nameList = $db->query("Select * from Accounts;");
while($row = $nameList->fetchArray(SQLITE3_ASSOC))
{
   $names[$i]= $row['Name'];
   
   $i++;
}



for($i = 0; $i < sizeof($names); $i++)
{
    echo $names[$i];
    echo "<br>";
}

// log: 2 of the same name can exist.
?>