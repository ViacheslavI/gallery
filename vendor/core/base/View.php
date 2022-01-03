<?php


namespace vendor\core\base;


class View
{
    /**
     * Current route
     * @var array
     */
    public $route = [];

    /**
     * Current view
     * @var string
     */
    public $view;

    /**
     * Current template
     * @var string
     */
    public $layout;

    public static $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

    public function __construct($route, $layout = '', $view = '')
    {
        $this->route = $route;
        if ($this->layout === false) {
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }

    public function render($data)
    {
        if (is_array($data)) extract($data);
        $file_view = APP . "/Views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if(empty($_SESSION['email'])){
            $condition = true;
        }else{
            $condition = false;
        }
        if (is_file($file_view)) {
            require $file_view;
        } else {
            throw  new \Exception('error view', 404);
        }
        $content = ob_get_clean();
        if (false !== $this->layout) {
            $file_layout = APP . "/Views/layouts/{$this->layout}.php";
            if (is_file(($file_layout))) {
                require $file_layout;
            } else {
                throw  new \Exception('error layout', 404);

            }
        }
    }

    public static function getMeta()
    {
        echo '<title>' . self::$meta['title'] . '</title>
<meta name="description" content="' . self::$meta['desc'] . '">
<meta name="keywords" content="' . self::$meta['keywords'] . '">';
    }

    public static function setMeta($title = '', $desc = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;

    }
}