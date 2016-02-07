<?php
/**
 ** File: display_url.view.php
 ** Author: CBMcARthur via Upwork
 ** Date: 01/31/2016
 **
 ** This view will display the shortened URL information to the user once
 ** everything happens successfully.
 **/
?>
<html>
<head>
	<title>URL Shortener for Upwork</title>
</head>
<body>
	<p>Your URL shortening information is:</p>
	<ul>
		<li>Original URL: <a href="<?= $long_url ?>" target="_blank"><?= $long_url ?></a></li>
		<li>Shortened URL: <?= $short_url ?></li>
	</ul>
</body>
</html>
