<?php


namespace vendor\core\base;

use vendor\core\Db;

abstract class Model
{
    protected $pdo;
    protected $table;
    protected $pk = 'id';
    public $attributes = [];


    public function __construct()
    {
        $this->pdo = Db::instance();
    }

    /**
     * Функция загрузки данных с формы в базу, проерка получение на данные пост массива и проверка по ключам пост массива
     * @param $data
     */
    public function load($data)
    {
        foreach ($data as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    /**
     * Сохранение пользователя в базу
     */
    public function save($data)
    {
        $sult = "test";
        $data['password'] = md5($data['password'] . $sult);
        $data['password_confirmation'] = md5($data['password_confirmation'] . $sult);
        $que = "INSERT INTO `users`(`user`, `email`, `password`,`password_confirm`) 
VALUES(:name,:email,:password,:confirmpassword)";
        Db::instance()->execute($que, [':name' => $data['name'], ':email' => $data['email'], ':password' => $data['password'], ':confirmpassword' => $data['password_confirmation']]);
    }


    /**
     * Обвертка над методом execute() в классе Db
     * Проверка на выполнение запроса(если вдруг мне надо просто получить данные или изменить структуру таблицы или создать ее)
     * можно вызвать этот метод и написать нужный запрос
     * @param $sql
     * @return mixed
     */
    public function query($sql)
    {
        return $this->pdo->execute($sql);
    }

    /**
     * Get all records in a table
     * @return array
     */
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->query($sql);
    }

    /**
     * Search by one records in table
     * @param $id
     * @param string $field
     * @return array
     */
    public function findOne($id, $field = '')
    {
        $field = $field ?: $this->pk;
        $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1"; //? - неименованный параметр  - $id
        return $this->pdo->query($sql, [$id]);
    }

    public function getRecordsInTable($nameLine)
    {
        $sql = "SELECT COUNT(*) as $nameLine FROM {$this->table}";
        $res = $this->pdo->query($sql);
        return $res[0][$nameLine];
    }

    /**
     * Access to the database on own request
     * @param $sql
     * @param array $params
     * @return array
     */
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->query($sql, $params);
    }

    public function findLike($str, $field, $table = '')
    {
        $table = $table ?: $this->table;
        $sql = "SELECT * FROM {$table} WHERE {$field} LIKE ?";
        return $this->pdo->query($sql, ['%' . $str . '%']);
    }

    public function getUserId()
    {
        $email = $_SESSION['email'];
        $que = "SELECT {$this->pk} from `users` where email = '".$email."'";
        return $this->pdo->query($que);
    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            $errors .= "<li>$error</li>";
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }
}