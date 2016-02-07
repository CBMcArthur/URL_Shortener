# URL_Shortener
Simple project to create short URLs

## About
This project was used as a coding test, the details of which can be found below.  This was a timed test with a maximum of three hours.  The initial commit of this code is what I wrote at the end of those three hours.  Commits beyond the initial one is progress I'm making to clean up and finish the code.

**This is a quick and dirty web project that will:**
  * Shorten a valid URL provided by the user.
  * Create a shortened URL specified by the user for a valid URL provided by the user.
  * Allow a user to look up a shortened URL

**Files:**
  * create_db.sql: SQL script to create the DB tables and example data.
  * config.php: A small configuration file for DB and URL shortening settings.  
  * display_url.view.php: View after after the form contents are processed successfully.
  * form.view.php: View containig forms for performing the options listed above.
  * functions.php: File containing functions to clean up index.php and attempt at modularization
  * index.php: Index file... users should be directed to this page via web browser

**NOTES:**
  * Items not currently implemented:
  	 * Redirection of short URL.  Due to using an invalid domain name for the shortened
  	 	form of the URL in config.php, attempting redirection of the shortened URL is 
  	 	useless.  Instead a look-up form is provided to get the full URL from the
  	 	shortened form.
  	 * Short-form collisions.  It is possible that two full URLs would collide into the
  	 	same shortened form. Functionality to clean up that collision is not implemented.
  	 	This is for auto-generated shortened URLS.  If a user specifies a shortened URL that
  	 	already exists, an error is returned as specified.
