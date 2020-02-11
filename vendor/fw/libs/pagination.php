<?php


namespace fw\libs;
/**
 *
 */
class Pagination
{
  /**
  * Текущий номер страницы
  */
  public $currentPage;

  /**
  * Количество записей на одну страницу
  */
  public $perpage;

  /**
  * Общее количество записей
  */
  public $total;

  /**
  * Общее количество страниц
  */
  public $сountPages;

  /*
  * Базовый адрес для добавления пагиации
  */
  public $uri;

  public function __construct($page, $perpage, $total){
    $this->perpage = $perpage;
    $this->total = $total;
    $this->countPages = $this->getCountPages();
    $this->currentPage = $this->getCurrentPage($page);
    $this->uri = $this->getParams();
  }

  public function __toString(){
    return $this->getHtml();
  }

  /**
  * Метод возвращает общее количество страниц
  * @return int
  */
  public function getCountPages(){
    return ceil($this->total / $this->perpage) ?: 1;
  }

  /**
  * Метод возвращает текущий номер страницы
  * @param int $page - номер страницы
  * @return int
  */
  public function getCurrentPage($page){
    if(!$page || $page < 1){
      $page = 1;
    }
    if($page > $this->countPages){
      $page = $this->countPages;
    }
    return $page;
  }

  /**
  * Метод номера для выборки из бд
  * @return int
  */
  public function getStart(){
    return ($this->currentPage -1) * $this->perpage;
  }

  /**
  * Метод вырезает строку "#page=#" из uri и возвращает строку uri без этого параметра
  * @return string
  */
  public function getParams(){
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('?', $url);
    $uri = $url[0] . '?';
    if(isset($url[1]) && $url[1] != ''){
      $params = explode('&', $url[1]);
      foreach($params as $param){
        if( !preg_match("#page=#", $param) ){
          $uri .= "{$param}&amp;";
        }
      }
    }
    return $uri;
  }

  /**
  * Метод формирует HTML код пагинации и возвращает
  * @return string
  */
  public function getHtml(){
      $back = null; // ссылка НАЗАД
      $forward = null; // ссылка ВПЕРЕД
      $startpage = null; // ссылка В НАЧАЛО
      $endpage = null; // ссылка В КОНЕЦ
      $page2left = null; // вторая страница слева
      $page1left = null; // первая страница слева
      $page2right = null; // вторая страница справа
      $page1right = null; // первая страница справа

      if( $this->currentPage > 1 ){
          $back = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .($this->currentPage - 1). "'>&lt;</a></li>";
      }

      if( $this->currentPage < $this->countPages ){
          $forward = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .($this->currentPage + 1). "'>&gt;</a></li>";
      }

      if( $this->currentPage > 3 ){
          $startpage = "<li class='page-item'><a class='page-link' href='{$this->uri}page=1'>&laquo;</a></li>";
      }
      if( $this->currentPage < ($this->countPages - 2) ){
          $endpage = "<li class='page-item'><a class='page-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
      }
      if( $this->currentPage - 2 > 0 ){
          $page2left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .($this->currentPage-2). "'>" .($this->currentPage - 2). "</a></li>";
      }
      if( $this->currentPage - 1 > 0 ){
          $page1left = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .($this->currentPage-1). "'>" .($this->currentPage-1). "</a></li>";
      }
      if( $this->currentPage + 1 <= $this->countPages ){
          $page1right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .($this->currentPage + 1). "'>" .($this->currentPage+1). "</a></li>";
      }
      if( $this->currentPage + 2 <= $this->countPages ){
          $page2right = "<li class='page-item'><a class='page-link' href='{$this->uri}page=" .($this->currentPage + 2). "'>" .($this->currentPage + 2). "</a></li>";
      }

      return '<nav aria-label="Page navigation example"><ul class="pagination">' . $startpage.$back.$page2left.$page1left.'<li class="page-item active"><a class="page-link">'.$this->currentPage.'</a></li>'.$page1right.$page2right.$forward.$endpage . '</ul></nav>';
  }

}
