<?php

$query = "SELECT * FROM contacts";

$data = pg_query($db_conn,$query);

if(!$data)
{
die("Error getting data");
}

?>
