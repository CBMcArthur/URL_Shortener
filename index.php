<?php
/**
 ** File: index.php
 ** Author: CBMcARthur via Upwork
 ** Date: 01/31/2016
 **
 **  
 **/

require_once("config.php");
require_once("functions.php");

if (empty($_POST)):
	// No $_POST vars at all.  Display URL shortening form with no preprocessing.
	require('form.view.php');
elseif (isset($_POST['get_short'])):
	// Validate the full URL input via functions.php
	$error = validate_full_url();

	if ($error == FALSE):
		// Attempt to shorten the URL via functions.php
		$short_url = shorten_url($_POST['full_url']);
		$long_url = $_POST['full_url'];
		require('display_url.view.php');
	else:
		require('form.view.php');
	endif;
elseif (isset($_POST['specify_short'])):
	// Validate the full URL input via functions.php
	$error = validate_full_url();

	// Make sure user specified a short form
	if (strlen(trim($_POST['short_url'])) == 0)
		$error['short_url'] = "You must specify a shortened form of the URL.";

	if ($error == FALSE):
		// Attempt to shorten the URL via functions.php
		$short_url = shorten_url($_POST['full_url'], $short_domain.$_POST['short_url']);

		// UGLY!!!
		if (is_array($short_url) && array_key_exists('error_short_url', $short_url)):
			$error['short_url'] = $short_url['error_short_url'];
			require('form.view.php');
			exit();
		endif;

		$long_url = $_POST['full_url'];
		require('display_url.view.php');
	else:
		require('form.view.php');
	endif;
elseif (isset($_POST['retrieve_short'])):
	$long_url = get_long_url($_POST['short_url']);

	if (is_array($long_url) && array_key_exists('error_short_url', $long_url)):
		$error['short_url'] = $long_url['error_short_url'];
		require('form.view.php');
		exit();
	endif;

	$short_url = $_POST['short_url'];
	require('display_url.view.php');
endif;

