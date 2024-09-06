<?php

namespace lib\controllers;

use views\View;

class ErrorController
{
    public function show404(): void
    {
        $errorType = "404";
        $errorMessage = "La page demandée n'existe pas !";
        $view = new View("Erreur 404");
        $view->render(
            "error",
            [
                'errorType' => $errorType,
                'errorMessage' => $errorMessage
            ]);
    }
}
