<?php
/**
 ** File: cron_cleanup.php
 ** Author: CBMcArthur
 ** Date: 03/08/2016
 **
 ** This is a script that should be run once per day via cron job.  It will remove
 ** all shortened URLs from the DB that are older than 15 days.
 **/

require_once("config.php");

// Create connection to the DB via PDO
$db = new PDO($dsn, $db_username, $db_password);

// Delete entries older than 15 days
$count = $db->exec("DELETE FROM `urls` WHERE `date_created` < NOW() - INTERVAL 15 DAY");
echo "Total URLs deleted: $count\n";
