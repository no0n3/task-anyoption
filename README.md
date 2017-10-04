All the issues from 'tasks.txt' are implemented (including the bosus one).

Changes and improvements implemented
-------------

* Minor refactoring of class files location to match the use case
* Most classes are documented
* added 'backend/conf/params.php' with configuration parameters
* All files are inaccessible except 'backend/index.php', which now serves as a front controller for the app
* The view files are made inaccessible and instead the views are rendered by the controller class which is accessed by the index.php and the user data is passed to the view by the controller

Description
-------------

* Change the database params in 'backend/conf/params.php'
* Run 'php init.php' to create the users table and populate it with dummy data
* access the accounts page from the url 'backend/accounts?uid=1'
