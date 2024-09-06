<?php

namespace views;
use Exception;

/**
 * This class generate views depending on what each controller passes as parameters.
 */
class View
{
    private string $title;

    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * This method returns a full page.
     * @param string $viewName : name of the view file passed by the controller
     * @param array $params : parameters passed by the controller to the view.
     * @return void
     * @throws Exception
     */
    public function render(string $viewName, array $params = []): void
    {
        // We build the view path from the view name
        $viewPath = $this->buildViewPath($viewName);

        $content = $this->_renderViewFromTemplate($viewPath, $params);
        $title = $this->title;
        ob_start();
        require(MAIN_VIEW_PATH);
        echo ob_get_clean();
    }

    /**
     * Method to render the specific view.
     * @param $viewPath : path to the view file
     * @param array $params : parameters passed by the controller to the view.
     * @return string : content of the view
     * @throws Exception : if this view doesn't exist
     */
    private function _renderViewFromTemplate(string $viewPath, array $params = []): string
    {
        if (file_exists($viewPath)) {
            extract($params); // We transform array indexes into variables
            ob_start();
            require($viewPath);
            return ob_get_clean();
        } else {
            throw new Exception("La vue '$viewPath' est introuvable.");
        }
    }

    /**
     * This method build the path to the asked view.
     * @param string $viewName : name of the asked view.
     * @return string : path to the view.
     */
    private function buildViewPath(string $viewName): string
    {
        return TEMPLATE_VIEW_PATH . $viewName . '.php';
    }
}
