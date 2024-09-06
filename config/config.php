<?php
    
    // Depending on the routes used, we might need the session ; we start it anyway.
    session_start();

    // Here we define the useful constants,
    // db connexion data
    // and everything we need to configure.

    define('TEMPLATE_VIEW_PATH', './views/templates/'); // The path to views templates.
    define('MAIN_VIEW_PATH', TEMPLATE_VIEW_PATH . 'main.php'); // The path to main template.

    define('DB_HOST', 'mysql');
    define('DB_NAME', 'qbook');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');

