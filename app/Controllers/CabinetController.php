<?php

namespace app\Controllers;


use Requests\ChoiseFile;
use vendor\core\base\View;
use vendor\core\Registry;
use vendor\libs\Pagination;


class CabinetController extends BaseController
{
    public function indexAction()
    {
        if (empty($_SESSION['email'])) {
            redirect('../user/login');
        }
        $model = Registry::instance();
        $total = $model->main->getRecordsInTable('file_name');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 6;
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();
        $images[1] = $model->cabinet->getAllMyImages("LIMIT $start,$perpage");
        $urlimage = $images[1];
        $this->choiseFile();
        View::setMeta('Person cabinet', 'description page', 'site keywords');
        $this->set(compact('urlimage', 'pagination', 'total'));

    }

    public function deleteAction()
    {
        foreach ($_GET as $key => $item)
            $data = $key;
        $IdImage = explode('/', $data);
        $model = Registry::instance();
        $model->cabinet->deletedImage($IdImage[1]);
        redirect('/cabinet');

    }

    /**
     * Проерка выбран ли файл
     * @param $file
     * @return bool|string
     */
    public function canUpload($file)
    {
        if ($file['name'] == '')
            return $_SESSION['error'] = 'Вы не выбрали файл';
        if ($file['size'] == 0)
            return $_SESSION['error'] = 'Файл слишком большой';
        $getMime = explode('.', $file['name']);
        $mime = strtolower(end($getMime));
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
        if (!in_array($mime, $types))
            return $_SESSION['error'] = 'Недопустимый тип файла';

        return true;
    }

    /**
     * Загрузка файла
     * @param $file
     */
    public function makeUpload($file)
    {
        //путь для бд где лежит картинка
        $path = "http://gallery.local/public/images/";
        //путь кда сохранить картинку
        $save_path = "C://xampp/htdocs/Gallery/public/images/";
        $name = mt_rand(0, 10000) . $file['name'];
        copy($file['tmp_name'], $save_path . $name);
        $data['file_name'] = $path . $name;
        $model = Registry::instance();
        return $model->cabinet->UploadImage($data['file_name']);
    }

    /**
     * Загрузка файла с редиректом
     */
    public function choiseFile()
    {
        if (isset($_FILES['image'])) {
            $check = $this->canUpload($_FILES['image']);
            if ($check === true) {
                $this->makeUpload($_FILES['image']);
                return header('Location: http://gallery.local/cabinet/index');
                exit;
            } else {
                return $_SESSION['error'] = 'Не удалось загрузить файл';
            }
        }
    }

    public function viewPhoto()
    {

    }

    public function deletedPhoto()
    {

    }

}
