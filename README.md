# znix-panel-millionware
znix panel v2 with millionware theme

project incomplete

to do
- add discord linking
- add admin panel redirect button for staff
- reseller panel?? maybe...

the project is still useable but is missing some features from millionware
- viewing other user profiles
- commenting on profiles
- viewing invites
- discord linking

how to use?

1. upload files to web host.

2. replace website.cc in all .php files within the main directory.

ex.
- faq.php
- index.php
- login.php
- profile.php
- purchase.php
- register.php

3. upload db.sql to database and set the sql login info in "app\core\database.php".

ex.
- private $dbHost = "localhost";
-	private $dbUser = "user";
-	private $dbPass = "pass";
-	private $dbName = "dbname";

4. done... go to your domain and enjoy?

credits: znix
original project: https://github.com/znixbtw/panel-v2

preview login:
https://imgur.com/VxC0miP

preview panel:
https://imgur.com/TKCDSGX
