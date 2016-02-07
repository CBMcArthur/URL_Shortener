<?php
/**
 ** File: form.view.php
 ** Author: CBMcARthur via Upwork
 ** Date: 01/31/2016
 **
 ** This file contains the view of the web page to display to the user
 ** for the URL shortener. 
 **/
?>
<html>
<head>
	<title>URL Shortener for Upwork</title>
</head>
<body>
	<form method="post">
		<fieldset>
			Use the field below to create a shortened form of a URL:<br />
			URL to shorten: <input type="text" length="255" name="full_url" style="width:255;" <?php
				if (isset($_POST['full_url']))  echo 'value="'.$_POST['full_url'].'"' ?>/><br />
			<?php if (isset($error['full_url'])): ?>
				<span style="color:red;"><?= $error['full_url'] ?></span><br />
			<?php endif; ?>
			<input type="hidden" name="get_short" value="true" />
			<button>Get short URL</button>
		</fieldset>
	</form>

	<form method="post">
		<fieldset>
			Use the field below to specify a shortened form of a URL:<br />
			URL to shorten: <input type="text" length="255" name="full_url" style="width:255;" <?php
				if (isset($_POST['full_url']))  echo 'value="'.$_POST['full_url'].'"' ?>/><br />
			<?php if (isset($error['full_url'])): ?>
				<span style="color:red;"><?= $error['full_url'] ?></span><br />
			<?php endif; ?>
			Desired short form: <?= $short_domain ?><input type="text" length="50" name="short_url" style="width:50;" <?php
				if (isset($_POST['short_url']))  echo 'value="'.$_POST['short_url'].'"' ?>/><br />
			<?php if (isset($error['short_url'])): ?>
				<span style="color:red;"><?= $error['short_url'] ?></span><br />
			<?php endif; ?>
			<input type="hidden" name="specify_short" value="true" />
			<button>Specify short URL</button>
		</fieldset>
	</form>

	<form method="post">
		<fieldset>
			Retrieve the full URL from a shortened form:<br />
			Short URL: <input type="text" length="50" name="short_url" style="width:150;" /><br />
			<?php if (isset($error['short_url'])): ?>
				<span style="color:red;"><?= $error['short_url'] ?></span><br />
			<?php endif; ?>
			<input type="hidden" name="retrieve_short" value="true" />
			<button>Retrieve short URL</button>
		</fieldset>
	</form>
</body>
</html>
