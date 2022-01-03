<?php


namespace vendor\core;

use PDO;
use vendor\core\base\TSingletone;

/**
 * Implementation of the singleton pattern
 * Class Db
 * @package vendor\core\base
 */
class Db
{
    use TSingletone;
    protected $pdo;

    protected function __construct()
    {
        $db = require ROOT . '/config/Config.php';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        $this->pdo = new PDO ($db['host'], $db['user'], $db['password'], $options);
    }

    /**
     * Проверка на выполнение запроса(если вдруг мне надо просто получить данные или изменить структуру таблицы или создать ее)
     * можно вызвать этот метод и написать нужный запрос
     * @param $sql
     * @return bool
     */
    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $res = $stmt->execute($params);
        if ($res !== false) {
         return $stmt->fetchAll();
        }
        return [];
    }

}