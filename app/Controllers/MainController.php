<?php


namespace app\Controllers;

use vendor\core\base\View;
use vendor\core\Registry;
use vendor\libs\Pagination;

class MainController extends BaseController
{
    /**
     * Данная пременная даст возможность подключить свой шаблон  на страницу
     * @var string
     */
    // public $layout = "main";


    public function indexAction()
    {
        if (empty($_SESSION['email'])) {
            redirect('user/login');
        }

        /**
         * если данная переменная будет false отключится шаблон и будут выводиться одни лишь данные
         * такое может понадобиться при выводе ajax данных на страницу
         */

        //$this->layout=false;
        //$model = new Main();
        // $images = $model->findAll();
        //$data =$model->findBySql("select * from {$model->table} order  by `id` desc  limit 2");

        //$images = $model->findAll();
        $model = Registry::instance();
        //$images =App::$app->cache->get('images');
        // if(!$images){
        $total = $model->main->getRecordsInTable('file_name');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 6;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        /**
         * использование геттера реестра
         */
        //$images = $model->main->findAll("LIMIT $start,$perpage");

        /**
         * Получить картинку с именем владельца и лайки
         */
        $objImage = $model->main->getDataImage();

        /**
         * Кэширование картинок, запись в кэш
         */
        // App::$app->cache->set('images', $images);
        //  }

        /**
         * использование сеттера реестра
         */
        //$model->cabinet='app\Models\Cabinet';
        //$title = 'title';
        // $menu = $this->menu;
        View::setMeta('Main page', 'description page', 'site keywords');
        $this->set(compact('objImage', 'pagination', 'total'));
    }

    public function ajaxdataAction()
    {

        if ($this->isAjax()) {
            $like = $_POST['likes']+1;
            $Id = $_POST['user_id'];

            $model = Registry::instance();
            $model->main->setLike($like,$Id);
            $item['it']=$model->main->getLike($Id);
           //extract($item);
             //dd($item);die;
//echo json_encode($item);die;
           // header('Content-Type: text/json; charset=utf-8');
            echo(json_encode($item));die;
           // $this->loadView('test',compact('item'));
            //die;
        }
        else{

                redirect('/');
        }
    }
}
