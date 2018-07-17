<?php
session_start();
    /**
     * Class LoginController
     */
    class LoginController extends Controller {

        /**
         *  test login admin
         *  test pass admin
         */
        public function indexAction()
        {

            if (!empty($_REQUEST)) {
                $_SESSION['username'] = $_REQUEST['username'];
                $_SESSION['pass'] = $_REQUEST['pass'];
                require_once parent::DIR_MODEL . 'Users.php';
                $usersModel = new Users();
                $user = $usersModel->getUserPass($_REQUEST['username']);
                $_SESSION['db'] = $user;
                if ($user['pass'] == sha1($_REQUEST['pass'])) {
                    $_SESSION['logged'] = 1;
                    header('Location: /admin/main');
                    die;
                }
            }
            $this->render();
        }

    }