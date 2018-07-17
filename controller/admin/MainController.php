<?php
    session_start();

    class MainController extends Controller {

        function __construct () {
            if (!isset($_SESSION['logged']) || $_SESSION['logged'] != 1) {
                if (!empty($_REQUEST) && isset($_REQUEST['username']) && isset($_REQUEST['pass'])) {
                    $_SESSION['username'] = $_REQUEST['username'];
                }
                header('Location: /admin/login');
                die;
            }

            parent::__construct($_SERVER['REQUEST_URI']);
        }

        public function indexAction() {
            try {
                Controller::isModelExists(parent::DIR_MODEL.'Tasks.php');
            }
            catch (Exception $e) {
                echo 'Поймано исключение: ',  $e->getMessage(), "\n";
                Controller::ThrowNotFound();
            }
            require_once parent::DIR_MODEL.'Tasks.php';

            $tasksModel = new Tasks();
            $this->data['pages'] = $tasksModel->getTasksCount();

            if (isset($_GET['page'])) $offset = (($_GET['page'] - 1) * 3);
            else $offset = 0;
            if (!empty($_GET) && isset($_GET['sort']) && isset($_GET['order'])) {
                $this->data['tasks'] = $tasksModel->getTasksOrderBy($_GET['sort'], $_GET['order'], $offset);
            }
            else {
                $this->data['tasks'] = $tasksModel->getTasks($offset);
            }

            $this->render();
        }


        public function viewAction() {
            try {
                Controller::isModelExists(parent::DIR_MODEL.'Tasks.php');
            }
            catch (Exception $e) {
                echo 'Поймано исключение: ',  $e->getMessage(), "\n";
                Controller::ThrowNotFound();
            }
            require_once parent::DIR_MODEL.'Tasks.php';

            if (!empty($_GET)) {
                $tasksModel = new Tasks();
                $task = $tasksModel->getTaskById($_GET['id']);
                $this->data['task'] = $task;

                $this->render();
            }
            else {
                Controller::ThrowNotFound();
            }
        }

        public function updateAction()
        {
            if (!empty($_GET)) {
                require_once parent::DIR_MODEL.'Tasks.php';
                $task = new Tasks();
                $task->updateTask($_GET['id'], $_GET['content'], $_GET['status']);
            }
            header('Location: index');
            die;
        }

        public function deleteAction()
        {
            if (!empty($_GET)) {
                require_once parent::DIR_MODEL.'Tasks.php';
                $task = new Tasks();
                $task->deleteTask($_GET['id']);
            }
            header('Location: index');
            die;
        }

    }