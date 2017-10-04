<?php

namespace framework;

class App {
    const DEFAULT_CONTROLLER = 'accounts';
    const DEFAULT_ACTION = 'index';

    /**
     * @var array
     */
    private $config;
    /**
     * @var \framework\App
     */
    private static $inst;

    private function __construct(array $config = []) {
        $this->config = $config;
    }

    /**
     * @param array $config
     */
    public function init(array $config = []) {
        if (null === self::$inst) {
            self::$inst = new self($config);
        }
    }

    /**
     * @return \framework\App
     */
    public function getInst() {
        if (!empty(self::$inst)) {
            return self::$inst;
        }

        return null;
    }

    /**
     * @return array
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * @param string|array $targetRoute
     */
    public function dispatch($targetRoute) {
        $controllerData = $this->getControllerAndActtionNames($targetRoute);
        $controllerClass = 'backend\controllers\\' . ucfirst($controllerData['controller']);
        $actionMethod = $controllerData['action'] . 'Action';

        if (!class_exists($controllerClass)) {
            echo '';
            return;
        }
        $controllerInst = new $controllerClass();

        if (!method_exists($controllerInst, $actionMethod)) {
            echo '';
            return;
        }
        echo $controllerInst->$actionMethod();
    }

    /**
     * @param string|array $targetRoute
     * @return array
     */
    private function getControllerAndActtionNames($targetRoute) {
        if (is_string($targetRoute)) {
            $explodedRoute = explode('/', $targetRoute);
            $route = $this->clearEmptyElements($explodedRoute);
        } else if (is_array($targetRoute)) {
            $route = $this->clearEmptyElements(array_values($targetRoute));
        } else {
            $route = ['accounts', 'index'];
        }

        $result = [
            'controller' => empty($route[0]) ? null : $route[0],
            'action' => empty($route[1]) ? null : $route[1],
        ];
        if (empty($route[0]) && empty($route[1])) {
            $result['controller'] = self::DEFAULT_CONTROLLER;
            $result['action'] = self::DEFAULT_ACTION;
        } else if (empty($route[0])) {
            $result['controller'] = self::DEFAULT_CONTROLLER;
        } else if (empty($route[1])) {
            $result['action'] = self::DEFAULT_ACTION;
        }

        return $result;
    }

    /**
     * @param array $array
     * @return array
     */
    private function clearEmptyElements(array $array) {
        $result = [];
        foreach ($array as $item) {
            if (!empty($item)) {
                $result[] = $item;
            }
        }

        return $result;
    }
}
