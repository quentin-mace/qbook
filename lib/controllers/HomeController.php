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

    public function showError(): void
    {
        $view = new View("Erreur 404");
        $view->render("error");
    }
}