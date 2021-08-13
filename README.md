# kamsware001
Kamsware is a small distribution system API made using core PHP.
To test the endpoints and view necessary data, ensure that your system has apache2 and MySQL already installed.
1. clone the application into your localhost
2. create the database in your MySQL . You can either use PHPMyAdmin or a terminal to do the same.
3. Inside the application files , there is an sql dump file called kamsware.sql . Import the file into your already created database.
4. Your cloned app has an API folder which also has an objects folder , config, and endpoints. inside the config folder, there is a database.php file that you can edit the database connection variables. Once that is done and your server and MySQL is on , you can test the API endpoints using the links below

ENDPOINTS
localhost/kamsware/clients/read.php
localhost/kamsware/clients/read_children.php
localhost/kamsware/clients/create.php
localhost/kamsware/products/create.php
localhost/kamsware/products/read.php
localhost/kamsware/centers/read.php
localhost/kamsware/centers/create.php

