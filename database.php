<?php
$db_conn = pg_connect("host=localhost port=5432 dbname=users_contacts user=gdev password=' '");

if(!$db_conn)
{
die("Error: Connection to database failed");
}

?>
