<?php
/**
 ** File: config.php
 ** Author: CBMcARthur via Upwork
 ** Date: 01/31/2016
 **
 ** This file contains configuration variables and settings for operation URL shortener  
 **/

// MySQL settings
$mysql_server	= 'localhost';
$db_name		= 'cbmcarth_url_shortener';
$db_username 	= 'cbmcarth_tester';
$db_password	= 'password123$';
$dsn			= "mysql:host=$mysql_server;dbname=$db_name";

// URL shortener base settings
$short_domain = "http://up.up/";  // Domain name of shortening service
$short_length = 8;  // How many characters to include in the shortened URL
