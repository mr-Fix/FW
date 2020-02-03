<?php

namespace fw\core;
/**
 *
 */
class Db
{
  use TSingletone;

  /**
  * Свойство для хранения объекта PDO подключения к БД
  * @var object
  */
  //protected $pdo;

  protected function __construct()
  {
    $db = require ROOT . '/config/config_db.php';
    require LIBS . '/rb.php';
    \R::setup($db['dsn'], $db['user'], $db['pass']);

    //запрещаю отладку структуры таблицы на лету
    \R::freeze();

    // \R::fancyDebug(TRUE);
  }


    /**
    * Свойство для хранения колчества исполненых запросов к БД
    * @var int
    */
    //public static $countSql = 0;

    /**
    * Свойство для хранения строк запросов к БД
    * @var array
    */
    //public static $queries = [];

    /*
    * установка настроек вывода ошибок и результатов выборки из БД
    */
    // $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    //             \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,];
    // $this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options);

    /**
    * Запрос в таблицу по переданному запросу и параметрам.
    * @param string $sql - строка SQL запроса
    * @param array $params - параметры для выборки
    * @return array
    */
  // public function execute($sql, $params = []){
  //   self::$countSql++;
  //   self::$queries[] = $sql;
  //   $stmt = $this->pdo->prepare($sql);
  //   return $stmt->execute($params);
  // }
  //
  /**
  * Запрос в таблицу на выборку по переданному запросу и параметрам.
  * @param string $sql - строка SQL запроса
  * @param array $params - параметры для выборки
  * @return array
  */
  // public function query($sql, $params = []){
  //   self::$countSql++;
  //   self::$queries[] = $sql;
  //   $stmt = $this->pdo->prepare($sql);
  //   $res = $stmt->execute($params);
  //   if($res !== false){
  //     return $stmt->fetchAll();
  //   }else{
  //     return [];
  //   }
  // }
}
