<?php

namespace fw\core\base;
use fw\core\Db;

/**
 * Базовый класс модели
 */
abstract class Model
{
  /**
  * Объек с подключение к БД
  * @var objectPDO
  */
  protected $pdo;

  /**
  * Имя таблицы
  * @var string
  */
  protected $table;

  /**
  * Имя поля с перевичным ключом
  * @var string
  */
  protected $pk = 'id';

  public function __construct()
  {
    $this->pdo = Db::instance();
  }

  /**
  *  Запускает подготовленный запрос на выполнение
  * @return bool
  */
  public function query($sql){
    return $this->pdo->execute($sql);
  }

  /**
  * Выборка всех записей из таблицы указанной в $this->table
  * @return object PDOStatement
  */
  // public function findAll(){
  //   $sql = "SELECT * FROM {$this->table}";
  //   return $this->pdo->query($sql);
  // }

  /**
  * Выборка записей по полю из таблицы указанной в $this->table
  * @param string|int $id - значения поля для выборки
  * @param string $field - Имя поля для выборки. По умолчанию id. берется из $this->pk
  * @return object PDOStatement
  */
  // public function findOne($id, $field = ''){
  //   $field = $field ?: $this->pk;
  //   $sql = "SELECT * FROM {$this->table} WHERE $field = ? LIMIT 1";
  //   return $this->pdo->query($sql, [$id]);
  // }

  /**
  * Запрос в таблицу по переданному запросу и параметрам.
  * @param string $sql - строка SQL запроса
  * @param array $params - параметры для выборки
  * @return object PDOStatement
  */
  // public function findBySql($sql, $params = []){
  //   return $this->pdo->query($sql, $params);
  // }

  /**
  * Запрос в таблицу на выборку по содержащейся строке.
  * @param string $str - строка для поиска
  * @param string  $field - поле для выборки
  * @param string  $table - таблица для выборки (по умолчанию указанной в $this->table)
  * @return object PDOStatement
  */
  // public function findLike($str, $field, $table= ''){
  //   $table = $table ?: $this->table;
  //   $sql = "SELECT * FROM $table WHERE $field LIKE ?";
  //   return $this->pdo->query($sql, ['%' . $str . '%']);
  // }
}
