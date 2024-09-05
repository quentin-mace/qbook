<?php

namespace lib\controllers;

class HomeController
{
    public function showHome(): void
    {
        $title = "Home";
        ob_start();
        require "views/templates/home.php";
        $content = ob_get_clean();
        require "views/templates/main.php";
    }

    public function showError(): void
    {
        $title = "Erreur 404";
        ob_start();
        require "views/templates/error.php";
        $content = ob_get_clean();
        require "views/templates/main.php";
    }
}