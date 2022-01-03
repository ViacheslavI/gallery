<?php


namespace app\Controllers;


use vendor\core\base\Controller;
use vendor\core\base\View;
use vendor\core\Registry;
use vendor\libs\Pagination;

class ViewController extends Controller
{
    public function indexAction()
    {
        foreach ($_GET as $key => $item)
            $data = $key;
        $name = explode('/', $data);
        $model = Registry::instance();
        $UId = $model->view->getUId($name[1]);
        $imagesUser = $model->main->getImagesUser($UId);
        $total = $model->main->getRecordsInTable('file_name');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 6;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        View::setMeta('User Page', 'description page', 'site keywords');
        $this->set(compact('imagesUser', 'pagination', 'total'));
    }


}