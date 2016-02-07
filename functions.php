<?php
/**
 ** File: functions.php
 ** Author: CBMcARthur via Upwork
 ** Date: 01/31/2016
 **
 ** This file contains functions for processing user input, DB interaction, etc.
 ** It's really just to keep index.php cleaner and everything more readable. (I hope)
 **/

require_once("config.php");

/**
 ** Function: validate_full_url()
 ** Return: string containing validation error 
 **		-OR- FALSE if valid URL provided.
 **
 ** This function should be called to validate the user's input for
 ** a full URL (that will eventually be shortened). 
 **/
function validate_full_url() {
	// Form for shortening URL submitted.  Validate input.
	if (empty(trim($_POST['full_url']))):
		// No input provided. Create error message and display the form again.
		$error['full_url'] = "URL field is required.";
		return $error;
	endif;

	// If the user did not include display an error in the form.
	if (stripos($_POST['full_url'], "http://") === FALSE):
		$error['full_url'] = "URLs must include 'http://' at the beginnning.";
		return $error;
	endif;

	$headers = get_headers($_POST['full_url'], 1);
	if ($headers === FALSE):
		// Invalid URL or failure acessing the URL.  Create error and display form again.
		$error['full_url'] = "Invalid URL was provided.";
		return $error;
	endif;

	// $response array will include redirects and lots of extra info.
	// This will look nasty, if there is time I can clean this up.
	$rheaders = array_reverse($headers, TRUE);
	foreach ($rheaders as $key => $value):
		// Find the first key that is numeric
		if (is_numeric($key)):
			$response = substr($value, 9, 3);
			
			if (strcmp($response, "200") === FALSE):
				$error['full_url'] = "Invalid URL was provided.";
				return $error;
			endif;
		endif;
	endforeach;

	
	// URL seems to be valid.
	return FALSE;
}

/**
 **	Function: shorten_url
 ** Input: (string) valid URL
 ** Output: string with shortened URL
 **
 ** This function performs a quick and dirty shortening of the provided URL.
 ** The domain name comes from config.php.  The shortening is a substring
 ** of a SHA1 hash.  Duplicates are possible so there's a check for that.
 **/
function shorten_url($url, $short = NULL) {
	global $short_domain, $short_length, $dsn, $db_username, $db_password;
	$autogenerate = FALSE;

	if ($short == NULL):
		$autogenerate = TRUE;
		$hash = SHA1($url);
		$short = $short_domain.substr($hash, ($short_length *-1));
	endif;

	// Create connection to the DB via PDO
	$db = new PDO($dsn, $db_username, $db_password);

	// Get count of URLs with this shortened form.
	$query = "SELECT * FROM `urls` WHERE `short_url` LIKE ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($short));
	$rows = $stmt->fetchAll();

	if (count($rows) > 0):
		// Make sure that the long_url matches the provided URL.
		if (strcasecmp($url, $rows[0]['long_url']) === 0):
			return $short;
		else:
			// Collision found.  Need to modify short url if auto generated
			if ($autogenerate == TRUE):
				echo "<pre>";
				echo "Collision found!\n";
				echo "Long URL: $url\n";
				echo "Short URL: $short\n";
				var_dump($rows);

				exit();
			else:
				$error['error_short_url'] = "That short form already exists.  Try another one.";
				return $error;
			endif;
		endif;
	else:
		// Insert this shortened URL into the DB
		$query = "INSERT INTO `urls` (`long_url`, `short_url`) VALUES (?, ?)";
		$stmt = $db->prepare($query);
		$result = $stmt->execute(array($url, $short));

		return $short;
	endif;
}

/**
 ** Function: get_long_url
 ** Input: (string) short_url to reteive long version of
 ** Return: (string) valid URL
 **		-OR- (array) error(s)
 **/
function get_long_url($short_url) {
	global $dsn, $db_username, $db_password;

	// Make sure a short form was provided
	if (strlen(trim($short_url)) == 0):
		$error['error_short_url'] = "Short URL is required.";
		return $error;
	endif;

	// Create connection to the DB via PDO
	$db = new PDO($dsn, $db_username, $db_password);

	// Get count of URLs with this shortened form.
	$query = "SELECT * FROM `urls` WHERE `short_url` LIKE ?";
	$stmt = $db->prepare($query);
	$stmt->execute(array($short_url));
	$rows = $stmt->fetchAll();

	if (count($rows) > 0):
		return $rows[0]['long_url'];
	else:
		echo "<pre>";
		echo "Rows: ";
		var_dump($rows);
	endif;
}
