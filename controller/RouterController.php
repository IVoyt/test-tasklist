<?php

    /**
     * Class RouterController
     */
    class RouterController {

        public $controllerPath = '';
        public $controllerAction = 'indexAction';
        public $controllerName = '';

        public function __construct () {

            if ($_SERVER['REQUEST_URI'] == '/') $_SERVER['REQUEST_URI'] = 'main';
            if (in_array($_SERVER['REQUEST_URI'],['/admin','/admin/'])) $_SERVER['REQUEST_URI'] = '/admin/main';
            $preroute   = preg_replace('/\//','', $_SERVER['REQUEST_URI'], 1);
            $route      = preg_replace('/\?+.*/si','', $preroute, 1);

            $_SERVER['REQUEST_URI'] = preg_replace('/\?+.*/si','', $_SERVER['REQUEST_URI'], 1);
            if ($route[mb_strlen($route) - 1] == '/') $route = substr($route,0,-1);

            $tmppath = explode('/', $route);

            if (count($tmppath) > 0 && $tmppath[0] != '') {
                foreach ($tmppath as $k => $elm) {
                    if (is_dir(__DIR__.'/'.$this->controllerPath.$elm)) {
                        if (file_exists(__DIR__.'/'.$this->controllerPath.$elm.'/'.ucwords($tmppath[$k+1]) .
                                        'Controller.php')) {
                            $this->controllerPath .= $elm . '/';
                            continue;
                        }
                    }
                    if (file_exists(__DIR__.'/'.$this->controllerPath . ucwords($elm) . 'Controller.php')) {
                        $this->controllerPath .=    ucwords($elm) . 'Controller';
                        $this->controllerName =     ucwords($elm) . 'Controller';
                    }
                    else {
                        $this->controllerAction = $elm . 'Action';
                    }
                }
            }

            $controllerName = $this->controllerName;
            $actionName = $this->controllerAction;

//            Controller::debug([
//                'tmppath' => $tmppath,
//                'route' => $route,
//                'controller path' => $this->controllerPath,
//                'controller name' => $controllerName,
//                'controller action' => $this->controllerAction,
//                $_SERVER['REQUEST_URI']
//            ], 'print_r');


            switch ($route) {
                case $route == '':
                    Controller::ThrowNotFound();
                    break;

                case (file_exists(__DIR__ . '/' . $this->controllerPath.'.php')):
                    include_once __DIR__ . '/' . $this->controllerPath.'.php';
                    try {
                        Controller::isMethodExists($this->controllerName, $this->controllerAction);
                        $controller = new $controllerName($_SERVER['REQUEST_URI']);
                        $controller->$actionName();
                    }
                    catch (Exception $e) {
//                        echo 'Поймано исключение: ',  $e->getMessage(), "\n";
                        Controller::ThrowNotFound();
                    }
                    $controller = new $controllerName($_SERVER['REQUEST_URI']);
                    $controller->$actionName();
                    break;

                default:
                    Controller::ThrowNotFound();
            }
        }

    }