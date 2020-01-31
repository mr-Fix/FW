<?php

namespace vendor\core;

/**
 * Класс обработчика ошибок
 */
class ErrorHandler
{

  public function __construct()
  {
    if(DEBUG){
      error_reporting(-1);
    }else{
      error_reporting(0);
    }
    set_error_handler([$this, 'errorHandler']);
    ob_start();
    register_shutdown_function([$this, 'fatalErrorHandler']);
    set_exception_handler([$this, 'exceptionHandler']);
  }

  /**
  * Обработчик не фатальных ошибок
  *
  * @param int $errno - код ошибки
  * @param string $errstr - текст ошибки
  * @param string $errfile - имя файла в котором ошибка
  * @param int $errline - строка в которой ошибка
  * @return bool
  */
  public function errorHandler($errno, $errstr, $errfile, $errline){
    $this->logErrors($errstr, $errfile, $errline);
    $this->displayError($errno, $errstr, $errfile, $errline);
    return true;
  }

  /**
  * Обработчик фатальных ошибок
  * Логирует ошибку
  * Подключает и вsводит соответствующий view с параметрами ошибки через метод displayError
  */
  public function fatalErrorHandler(){
    $error = error_get_last();
    if( !empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR) ){
      $this->logErrors($error['message'], $error['file'], error['line']);
      ob_end_clean();
      $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
    }else{
      ob_end_flush();
    }
  }

  /**
  * Обработчик исключений
  * Логирует ошибку
  * Подключает и вsводит соответствующий view с параметрами ошибки через метод displayError
  * @param object $e - object с информацией о ошибке\]
  */
  public function exceptionHandler($e){
    $this->logErrors( $e->getMessage(), $e->getFile(), $e->getLine() );
    $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
  }

  /**
  * Функция логирования ошибки в файла
  * @param string $message - текст ошибки
  * @param string $file - имя файла в котором ошибка
  * @param int $line - Номер строки в которой ошибка
  */
  protected function logErrors($message = '', $file = '', $line = ''){
    error_log('['. date('Y-m-d H:i:s') . "] \n Текст ошибки: {$message} \n Файл: {$file} \n Строка: {$line}\n===================================================================================================================================\n", 3, ROOT . '/tmp/errors.log');
  }

  /**
  * Подключает и выводит соответствующий view для ошибки с параметрами или без(для продакшина)
  * @param int $errno - Код ошибки
  * @param string $errstr - текст ошибки
  * @param string $errfile - имя файла в котором ошибка
  * @param int $errline - Номер строки в которой ошибка
  * @param int $responce - код ответа сервера (500 - поумолчанию)
  */
  protected function displayError($errno, $errstr, $errfile, $errline, $responce = 500){
    http_response_code($responce);
    if($responce == 404){
      require WWW . '/errors/views/404.html';
      die;
    }
    if(DEBUG){
      require WWW . '/errors/views/dev.php';
    }else{
      require WWW . '/errors/views/prod.php';
    }
    die;
  }
}
