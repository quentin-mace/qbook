<?php

namespace lib\controllers;

use views\View;

class HomeController
{
    public function showHome(): void
    {
        $view = new View("Home");
        $view->render("home");
    }
}