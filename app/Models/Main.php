<?php


namespace app\Models;


use vendor\core\base\Model;

class Main extends Model
{
    /**
     * Name table with for work
     * @var string
     */
    public $table = 'gallery_image';

    /**
     * Name private by which the record is chosen
     * @var string
     */
    public $pk = 'id';

    /**
     * Получить имя пользователя который загрузил фото
     */
    public function getNameUser($data)
    {
        $sql = "SELECT `user` FROM `users` WHERE $this->pk = $data";
        return $this->pdo->query($sql);
    }

    /**
     * Запрос на получение данных по (картинка, лайки, владелец)
     */
    public function getDataImage()
    {
        $sql = "SELECT `gallery_image`.`file_name`, `users`.`user`,`gallery_image`.`id`,`gallery_image`.`likes`,`gallery_image`.`user_id` from gallery_image INNER join users on `gallery_image`.`user_id` =`users`.`id`";
        return $this->pdo->query($sql);
    }

    public function getId($data)
    {
        $que = "SELECT {$this->pk} from `users` where user = '" . $data . "'";
        return $this->pdo->query($que);
    }

    public function getImagesUser($data)
    {
        $data = $data[0]['user_id'];
        $sql = "SELECT `file_name`,`likes` from {$this->table} where `user_id` = $data";
        return $this->pdo->query($sql);
    }

    public function setLike($like,$Id)
    {
        $sql = "UPDATE {$this->table} SET `likes` = $like  WHERE `id` = $Id";
        return $this->pdo->query($sql);
    }
    public function getLike($Id)
    {
        $sql = "SELECT `likes` FROM {$this->table} WHERE `id` = $Id";
        return $this->pdo->query($sql);
    }

}