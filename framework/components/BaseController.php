<?php

namespace framework\components;

class BaseController {

    /**
     * Default controller action
     * @return string
     */
    public function indexAction() {
        return '';
    }

    /**
     * Returns the rendered view.
     * @param string $viewName The target view name.
     * @param array $vars The variables to be passed to the view.
     * @return string The rendered view.
     */
    protected function renderView($viewName, array $vars = []) {
        if (empty($viewName) || !is_string($viewName)) {
            return '';
        }

        ob_start();
        ob_implicit_flush(false);
        extract($vars, EXTR_OVERWRITE);
        include ROOT_DIR . '/backend/views/' . $viewName . '.php';

        return ob_get_clean();
    }

}
