# znix-panel-millionware
znix panel v2 millionware themed.

edit incomplete

to do
- add discord linking
- reseller panel?? maybe...
- add landing page (must go to login.php and register.php manually for now.)

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
- login admin:admin

credits: znix, Jasmisek (pull requests)

original project: https://github.com/znixbtw/panel-v2

preview login:
![image](https://user-images.githubusercontent.com/98117900/150399428-6a3f3e1d-8df0-4039-a6d6-420eb296e170.png)


preview panel: (ss by Jasmisek)
![image](https://user-images.githubusercontent.com/98117900/150622664-57da83ea-9b3b-46d0-acee-d5090b4b9847.png)
