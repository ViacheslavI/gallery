<?php


namespace app\Models;


use vendor\core\base\Model;

class View extends Model
{
    public function getUId($data)
    {
        $sql = "SELECT `user_id` from `gallery_image` WHERE `id` = $data ";
        return $this->pdo->query($sql);
    }

}