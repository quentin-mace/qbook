<?php
    
    // Depending on the routes used, we might need the session ; we start it anyway.
    session_start();

    // Here we define the useful constants,
    // db connexion data
    // and everything we need to configure.

    define('TEMPLATE_VIEW_PATH', './views/templates/'); // The path to views templates.
    define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php'); // The path to main template.

    define('DB_HOST', 'yourdbhost');
    define('DB_NAME', 'yourdbname');
    define('DB_USER', 'yourdbuser'); //Replace with your own user and password (Match with docker-compose.yaml)
    define('DB_PASS', 'yourdbpassword');

