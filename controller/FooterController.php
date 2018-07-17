<?php

    class FooterController extends Controller {

        function __construct ($template_name, $restart) {
            if ($restart == 0) {
                parent::__construct($template_name);
                $this->index();
            }
        }

        function index() {

            $this->render();

        }
    }