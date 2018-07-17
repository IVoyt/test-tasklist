<?php

    class MainController extends Controller {

        function indexAction() {
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

        function addAction()
        {
            if (!empty($_POST)) {
                require_once parent::DIR_MODEL.'Tasks.php';
                move_uploaded_file(
                    $_FILES['img']['tmp_name'], dirname(__DIR__.'..').'/web/img/tmp/'.$_FILES['img']['name']
                );
                $task = new Tasks();
                try {
                    if (!$task->addTask($_POST['username'], $_POST['email'], $_POST['content'], $_FILES['img']['name'])) {
                        throw new PDOException();
                    }
                } catch (PDOException $e) {
                    echo 'Code: ' . $e->getCode() . '<br/>Message: '. $e->getMessage();
                    die;
                }


                $this->Resize_image(320, 240, 90, dirname(__DIR__.'..').'/web/img/tmp/'.$_FILES['img']['name'], dirname(__DIR__.'..').'/web/img/'.$_FILES['img']['name']); //makes file_thumb.ext
                unlink(dirname(__DIR__.'..').'/web/img/tmp/'.$_FILES['img']['name']);

                header('Location: index');
                die;
            }
            else {
                $this->render();
            }
        }

        function previewAction() {
            $this->layout = 'empty';

            $this->data['username'] = $_GET['username'];
            $this->data['email'] = $_GET['email'];
            $this->data['content'] = $_GET['content'];

            return $this->render();
        }

        public function phpinfoAction()
        {
            phpinfo();
        }

    }