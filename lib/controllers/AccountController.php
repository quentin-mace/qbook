<?php

namespace lib\controllers;

use Exception;
use views\View;

class AccountController
{
    /**
     * @throws Exception
     */
    public function showAccount(string $infoMessage = null, string $errorMessage = null): void
    {
        $view = new View("Mon Compte");
        $view->render("account");
    }
}