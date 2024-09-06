<?php

namespace lib\controllers;

use views\View;

/**
 * Controller that manages all the pages linked with the home page
 */
class HomeController
{
    /**
     * Method to display the homepage
     *
     * @return void
     */
    public function showHome(): void
    {
        $view = new View("Home");
        $view->render("home");
    }
}