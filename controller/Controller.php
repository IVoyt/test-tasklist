<?php

    /**
     * Class Controller
     */
    class Controller {

        protected $data = array();
        protected $view;
        const DIR_VIEW  = __DIR__ . '/../view/';
        const DIR_WEB   = '/web/';
        const DIR_MODEL = __DIR__ . '/../model/';
        const DIR_LANG  = 'lang/';
        const DIR_CSS   = self::DIR_WEB . 'css/';
        const DIR_JS    = self::DIR_WEB . 'js/';

        public $layout = 'main';
        public $action;
        public $route;

        function __construct ($route = null) { $this->route = $route; }

        static function isMethodExists($controller, $actionName) {
            if (!method_exists($controller, $actionName) || $controller == '') {
                throw new Exception('Unknown method...');
            }
        }

        static function isViewExists($view) {
            if (!file_exists($view)) {
                throw new Exception('View not found...');
            }
        }

        static function isModelExists($model) {
            if (!file_exists($model)) {
                throw new Exception('Model not found...');
            }
        }

        /**
         * If Model/View/Controller not found
         * Show 404
         */
        static function ThrowNotFound() {
            require_once __DIR__ . '/Controller404.php';
            $controller = new Controller404('404');
            $controller->indexAction();

//            die('Something went wrong...');
            die();
        }

        /**
         * @param null $route
         */
        private function beforeRender($route = null)
        {
            if ($route != null) {
                $this->route = $route;
            }
            if ($this->route[mb_strlen($this->route) -1] == '/') {
                $this->route = substr($this->route, 0, -1);
            }
            $path = explode('/', $this->route);
            $this->view = '';

            if (count($path) == 1) {
                $this->view = $this->route . '/index.php';
            }
            else {
                $len = count($path);
                for ($i = 0; $i < $len; $i++) {
                    if ($len - $i == 1) {
                        if (file_exists(self::DIR_VIEW.$this->view. $path[$i].'.php')) {
                            $this->view .= $path[$i].'.php';
                        }
                        else {
                            $this->view .= $path[$i].'/index.php';
                        }
                    }
                    else {
                        $this->view .= $path[$i] . '/';
                    }
                }
            }

//            Controller::debug([
//                'route expected' => $this->route,
//                'path expected' => $path,
//                'view expected' => $this->view
//            ], 'print_r');

        }

        /**
         * @param null $template
         * @return string
         */
        protected function render($template = null)
        {
            $this->beforeRender($template);
            $this->data['css_dir'] = self::DIR_CSS;
            $this->data['js_dir'] = self::DIR_JS;
            $this->data['web_dir'] = self::DIR_WEB;

            try {
                $this->isViewExists(self::DIR_VIEW .$this->view);
                extract($this->data);
                ob_start();
                require(self::DIR_VIEW . $this->view);
                $body_content = ob_get_clean();

                if ($this->layout != null) {
                    require_once self::DIR_VIEW . 'layouts/' . $this->layout . '.php';
                }
            }
            catch (Exception $e) {
//                echo 'Поймано исключение: ',  $e->getMessage(), "\n";
                $this->ThrowNotFound();
            }
            return $body_content;
        }

        /**
         * @param $what_to_dbg
         * @param $dbg_type
         */
        public static function debug($what_to_dbg, $dbg_type)
        {
            if ($dbg_type != 'print_r' && $dbg_type != 'var_dump') {
                echo 'Illegal debug type!!!';
            }
            else {
                echo '<pre>';
                    $dbg_type($what_to_dbg);
                echo '</pre>';
            }
        }

        /**
         * @param int $width
         * @param int $height
         * @param int $quality
         * @param null $filename_in
         * @param null $filename_out
         */
        public function Resize_image($width = 0, $height = 0, $quality = 90, $filename_in = null, $filename_out = null)
        {
            $file = $filename_in;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            $size = getimagesize($file);
            $ratio = $size[0] / $size[1];
            if ($ratio >= 1){
                $scale = $width / $size[0];
            } else {
                $scale = $height / $size[1];
            }
            // make sure its not smaller to begin with!
            if ($width >= $size[0] && $height >= $size[1]){
                $scale = 1;
            }

            // echo $fileext;
            switch ($ext)
            {
                case "jpg":
                    $im_in = imagecreatefromjpeg($file);
                    $im_out = imagecreatetruecolor($size[0] * $scale, $size[1] * $scale);
                    imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $size[0] * $scale, $size[1] * $scale, $size[0], $size[1]);
                    imagejpeg($im_out, $filename_out, $quality);
                    break;
                case "gif":
                    $im_in = imagecreatefromgif($file);
                    $im_out = imagecreatetruecolor($size[0] * $scale, $size[1] * $scale);
                    imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $size[0] * $scale, $size[1] * $scale, $size[0], $size[1]);
                    imagegif($im_out, $filename_out, $quality);
                    break;
                case "png":
                    $im_in = imagecreatefrompng($file);
                    $im_out = imagecreatetruecolor($size[0] * $scale, $size[1] * $scale);
                    imagealphablending($im_in, true); // setting alpha blending on
                    imagesavealpha($im_in, true); // save alphablending setting (important)
                    imagecopyresampled($im_out, $im_in, 0, 0, 0, 0, $size[0] * $scale, $size[1] * $scale, $size[0], $size[1]);
                    imagepng($im_out, $filename_out, 9);
                    break;
            }
            imagedestroy($im_out);
            imagedestroy($im_in);
        }

    }