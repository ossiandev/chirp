<?php
//connect to db

$db = new SQLite3("chirpbase.sq3");
echo $db->exec("Select * from Accounts;")

?>