<?php


namespace vendor\libs;


class Pagination
{
    /**
     * Текущая страница
     * @var $currentPage
     */
    public $currentPage;
    /**
     * Количесто элементов на странице
     * @var $perpage
     */
    public $perpage;
    /**
     * Общее количество записей
     * @var $total
     */
    public $total;
    /**
     * Общее количество страниц
     * @var $countPages
     */
    public $countPages;
    /**
     * Сыылка
     * @var $uri
     */
    public $uri;

    public function __construct($page, $perpage, $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    /**
     * Полчение количества страниц
     * @return false|float|int
     */
    public function getCountPages()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    /**
     * Получение текущей страницы (проерка)
     * @param $page
     * @return false|float|int|mixed
     */
    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) $page = 1;
        if ($page > $this->countPages) $page = $this->countPages;
        return $page;
    }

    /**
     * полчение номера записи с которого будут загружаться они на страницу
     * @return float|int
     */
    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getParams()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?', $uri);
        $uri = $uri[0] . '?';
        if (isset($uri[1]) && $uri != '') {
            $params = explode('&', $uri[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) $uri .= "{$param}&amp;";
            }
        }
        return $uri;
    }

    public function __toString()
    {
        return $this->getHtml();
    }

    public function getHtml()
    {
        $back = null; // ссылка назад
        $forward = null; //ссылка вперед
        $startpage = null; //ссылка в начало
        $endpage = null; // ссылка в конец
        $page2left = null; // вторая страница слева
        $pageleft = null; // первая страница слева
        $page2right = null; // вторая страница справа
        $pageright = null; // первая страница справа

        if ($this->currentPage > 1) {
            $back = "<li><a class='nav-link' href='{$this->uri} page=" . ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        if ($this->currentPage < $this->countPages) {
            $forward = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>&gt;</a></li>";
        }
        if ($this->currentPage > 3) {
            $startpage = "<li><a class='nav-link' href='{$this->uri}page=1'>&laqo</a></li>";
        }
        if ($this->currentPage < ($this->countPages - 2)) {
            $endpage = "<li><a class='nav-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if ($this->currentPage - 2 > 0) {
            $page2left = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        }
        if ($this->currentPage - 1 > 0) {
            $pageleft = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }
        if ($this->currentPage + 1 <= $this->countPages) {
            $pageright = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        }
        if ($this->currentPage + 2 <= $this->countPages) {
            $page2right = "<li><a class='nav-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";
        }
        return '<ul class="pagination">' . $startpage . $back . $page2left . $pageleft . '<li class="active"><a>' . $this->currentPage . '</a></li>' . $pageright . $page2right . $forward . $endpage . '</ul>';

    }
}