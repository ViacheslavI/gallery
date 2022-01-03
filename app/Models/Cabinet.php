<?php


namespace app\Models;


use Models\UploadImage;
use vendor\core\base\Model;

class Cabinet extends Model
{
    public $table = 'gallery_image';
    public $email;

    public function getAllMyImages()
    {
        $this->email = $_SESSION['email'];
        $userId = $this->getUserId();
        $userId = $userId[0]['id'];

        $sql = "SELECT * FROM {$this->table} where `user_id` ='" . $userId . "' AND `deleted_at` = 0";
        return $this->pdo->query($sql);
    }

    public function uploadImage($data)
    {
        $userId = $this->getUserId();
        $userId = $userId[0]['id'];
        $sql = "INSERT INTO {$this->table}(`file_name`, `user_id`) VALUES ('" . $data . "',' " . $userId . "')";
        return $this->pdo->query($sql);
    }

    public function deletedImage($Id){
            $sql = "UPDATE {$this->table} SET `deleted_at` = 1  WHERE `id` = $Id";
            return $this->pdo->query($sql);

    }

}