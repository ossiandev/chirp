<?php
//connect to db

$db = new SQLite3("chirpbase.sq3");

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