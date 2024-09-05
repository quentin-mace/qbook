<?php
use config\Autoloader;

require "config/Autoloader.php";

Autoloader::register();

$title = "Home";
$content = '<h1 class="text-center">Hello, world!</h1>';
require "views/templates/main.php";
