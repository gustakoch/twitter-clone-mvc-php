<?php
 
namespace GK\Controller;

abstract class Action {
  
    protected $view;

    public function __construct() {
        $this->view = new \stdClass();
    }

    protected function render($view, $layout = "Layout") {
        $this->view->page = $view;

        if (file_exists("../App/Views/".$layout.".php")) {
            require_once "../App/Views/".$layout.".php";
        } else {
            $this->content();
        }
    }

    public function content() {
        $actualClass = get_class($this);
        $actualClass = str_replace('App\\Controllers\\', '', $actualClass);
        $actualClass = strtolower(str_replace('Controller', '', $actualClass));

        require_once "../App/Views/".$actualClass."/".$this->view->page.".php";
    }
}
