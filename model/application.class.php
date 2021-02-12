<?php
/**
 * @author Taras Shkodenko
 * Created by PhpStorm.
 * Date: 11.02.2021
 * Time: 13:46
 */

class Application
{
    private $action = 'default';

    public function run()
    {
        if (isset($_REQUEST['action']) && !empty($_REQUEST['action'])) {
            $this->action = $_REQUEST['action'];
        }
        include_once dirname(dirname(__FILE__)) . '/controller/default.php';
        $controller = new DefaultController();
        $fnName = $this->action . 'Action';
        if (is_callable([$controller, $fnName])) {
            $controller->$fnName();
        }
    }
}
