USER-MGT AJAX + JSON PRACTICE PROJECT

How to run:
1. Copy the folder user-mgt-ajax-json into your XAMPP htdocs folder.
2. Start Apache from XAMPP.
3. Open this URL in browser:
   http://localhost/user-mgt-ajax-json/

Demo login:
Username: abc
Password: 123

Main concept:
- View files contain HTML forms.
- JavaScript collects form data.
- JavaScript converts the data into JSON using JSON.stringify().
- AJAX sends the JSON to PHP controller files without page reload.
- PHP decodes JSON using json_decode().
- PHP sends JSON response using json_encode().
- JavaScript receives the response and updates the page.

Important files:

Recommended folder idea:
- ajax/ = all AJAX JavaScript files
- controller/ = PHP backend files that receive JSON and return JSON
- data/ = JSON file used as simple storage
- view/ = HTML/PHP pages shown to user

File list:
- view/login.php
- view/signup.php
- view/home.php
- view/user_list.php
- ajax/login.js
- ajax/signup.js
- ajax/users.js
- controller/loginCheck.php
- controller/signupCheck.php
- controller/userController.php
- data/users.json

This is for beginner academic practice only. Passwords are stored in plain text to keep the code easy to understand.
