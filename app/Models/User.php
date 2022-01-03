<?php

namespace app\Models;

//include('..\Observers\CheckMailObserver.php');


//use Gallery\DB\Config;
//use Observers\CheckMailObserver;
//use Observers\CreateUserObserver;
//use PDO;

use vendor\core\base\Model;

class User extends Model
{
    public $table = "users";
    public $fillable = [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ];
    public $errors = [];

    public function checkMailAndName($data)
    {
        $result = Model::findOne($this->attributes['email'], "user ='" . $this->attributes['name'] . "' OR email='" . $this->attributes['email'] . "'");
         if ($result) {
              if ($data['name'] == $result[0]['user']) {
                  $this->errors['unique'] = 'this login already used';
              }
              if ($data['email'] == $result[0]['email']) {
                  $this->errors['unique'] = 'this email already used';
              }
              return false;
          }

        return true;
    }

    public function login()
    {
        $sult = "test";
        $login = !empty(trim($_POST['email'])) ? trim($_POST['email']) : null;
        $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
        $password = md5($password . $sult);
        if ($login && $password) {
                $result = Model::findOne($this->attributes['email'],"email ",$this->attributes['email']);
            if ($result) {

                if ($password ===$result[0]['password']) {
                    foreach ($result as $k => $v) {
                        if ($k != 'password')
                            $_SESSION['user'][$k] = $v;
                    }
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Валидация данных
     */
    public function validate($data)
    {
        foreach ($data as $key => $val) {
            if (isset($key['name'])) {
                $this->errors[] = "field name must be required";
            }
            if (!preg_match("/^[a-zA-Z-']*$/", $data['name'])) {
                $this->errors[] = "Only letters";
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = "Invalid email format";
            }
            if (iconv_strlen($data['password'], 'UTF-8') < 6) {
                $this->errors[] = "password must be more than 6 letters";
                return false;
            } else {
                $data[$key] = trim($val);
                $data[$key] = stripslashes($val);
                $data[$key] = htmlspecialchars($val, ENT_QUOTES);
                return true;
            }
        }
    }


    public static function isUser(){

     return isset($_SESSION['email']);
    }
    public static function isAdmin(){
        return (isset($_SESSION['email']) && $_SESSION['email']['role']=='admin');
    }


//    public function Register($data)
//    {
//        $checkmail = CheckMailObserver::checkMail($data);
//        if (!$checkmail) {
//            CreateUserObserver::createUser($data);
//        }
//        else{
//            header('Location: http://gallery.local/Register.php');
//            exit;
//        }
//    }
//
//    public function login($data)
//    {
//        $checkpassword = User::passwordVerification($data);
//        $checkmail = CheckMailObserver::checkMail($data);
//        if ($checkpassword && $checkmail) {
//            session_start();
//            $_SESSION['email']=$data['email'];
//            header('Location: http://gallery.local/index.php');
//            exit;
//        }
//    }
//
//    public function passwordVerification($data)
//    {
//        $sult = "test";
//        $data['password'] = md5($data['password'] . $sult);
//        //$con = new Config;
//        $stmt = Config::connect();
//        $que = "SELECT * FROM `users` WHERE :password = `users`.`password` LIMIT 1";
//        $query = $stmt->prepare($que);
//        $query->execute([':password' => $data['password']]);
//        $result = $query->fetch(PDO::FETCH_ASSOC);
//        return $result;
//    }
}
