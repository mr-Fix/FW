<?php

namespace fw\core\base;
use fw\core\Db;
use Valitron\Validator;
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

  /**
  * массив с данными полей формы поля которой мы можем определять в потомке
  * @var array
  */
  public $attributes = [];

  /**
  * Свойство для записи ошибок валидации
  * @var array
  */
  public $errors = [];

  /**
  * Правила для валидации форм
  * @var array
  */
  public $rules = [];


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
  * Метод для записи только тех полей(с формы) которые у нас определены
  * @param array $data - массив с данными
  * @return void
  */
  public function load($data){
    foreach($this->attributes as $name => $value){
      if( isset($data[$name]) ){
        $this->attributes[$name] = $data[$name];
      }
    }
  }

  /**
  * Метод для валидации данных из форм
  * @param array $data - массив с данными
  * @return bool
  */
  public function validate($data){
    Validator::lang('ru');
    $v = new Validator($data);
    $v->rules($this->rules);
    if( $v->validate() ){
      return true;
    }
    $this->errors = $v->errors();
    return false;
  }

  /**
  * Записывает ошибки в массив $_SESSION['error']
  * @return void
  */
  public function getErrors(){
    $errors = '<ul>';
    foreach ($this->errors as $error) {
      foreach ($error as $item) {
        $errors .= "<li>$item</li>";
      }
    }
    $errors .= '</ul>';
    $_SESSION['error'] = $errors;
  }

  /**
  * Записывает данные в массив $table
  * @param string $table - имя таблицы для записи
  * @return void
  */
  public function save($table){
    $tbl = \R::dispense($table);
    foreach($this->attributes as $name => $value){
      $tbl->$name = $value;
    }
    return \R::store($tbl);
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
