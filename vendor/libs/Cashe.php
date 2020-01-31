<?php

namespace vendor\libs;
/**
 * Класс кеширования данных
 */
class Cashe
{

/**
* Сеттер для записи данных в файл кеша
*
* @param string $key - имя будущего файла
* @param string $data - имя будущего файла
* @param int $seconds - время актульности данных(по умолчанию - 3600)
* @return bool
*/
  public function set($key, $data, $seconds = 3600){
    $content = null;
    $content['data'] = $data;
    $content['end_time'] = time() + $seconds;
    if ( file_put_contents(CASHE . '/' . md5($key) . '.txt', serialize($content)) ){
      return true;
    }
    return false;
  }

  /**
  * Геттер для получения данных из файла кеша
  *
  * @param string $key - имя файла
  * @return bool|string
  */
  public function get($key){
    $file = CASHE . '/' . md5($key) . '.txt';
    if( file_exists($file) ){
      $content = unserialize( file_get_contents($file) );
      if(time() <= $content['end_time']){
        return $content['data'];
      }else{
        unlink($file); //удаляет файл
      }
    }
    return false;
  }

  /**
  * Функция для удаления файла кеша по имени
  *
  * @param string $key - имя файла
  * @return void
  */
  public function delete($key){
    $file = CASHE . '/' . md5($key) . '.txt';
    if( file_exists($file) ){
        unlink($file); //удаляет файл
      }
  }
}
