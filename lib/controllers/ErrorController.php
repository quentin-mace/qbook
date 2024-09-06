<?php

namespace lib\controllers;

use views\View;

/**
 * Controller used to load all the different flavors of errors pages
 */
class ErrorController
{
    /**
     * Method used to display a 404 error, when the page is not found
     *
     * @return void
     */
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

    /**
     * Method used to display the errors messages that are thrown
     *
     * @param string $errorMessage
     * @return void
     */
    public function showException(string $errorMessage): void
    {
        $errorType = "";
        $view = new View("Erreur");
        $view->render(
            "error",
            [
                'errorType' => $errorType,
                'errorMessage' => $errorMessage
            ]);
    }
}
