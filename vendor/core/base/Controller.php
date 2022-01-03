<?php


namespace vendor\core\base;


abstract class Controller
{
    /**
     * Current route and parameters
     * @var array
     */
    public $route = [];

    /**
     * View
     * @var mixed
     */
    public $view;

    /**
     * Current template
     * @var string
     */
    public $layout;

    /**
     * Users data
     * @array
     */
    public $data = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = $route['action'];
    }

    /**
     * Получение названия шаблона, вида и пути к нему
     */
    public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->data);
    }

    /**
     *
     */
    public function set($data)
    {
        $this->data = $data;
    }

    /**
     * Проверка каким способом поступили данные
     * @return bool
     */
    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
      extract($vars);
      require APP."/views/{$this->route['controller']}/{$view}.php";
    }

}