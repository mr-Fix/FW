<?php

namespace app\controllers;

use fw\core\App;
use fw\widgets\language\Language;
/**
 *Для добавляния общего функционала контроллерам
 */
class AppController extends \fw\core\base\Controller
{

 public function __construct($route){
   parent::__construct($route);
   new \app\models\Main();
     App::$app->setProperty('langs', Language::getLanguages());
     App::$app->setProperty('lang', Language::getLanguage(App::$app->getProperty('langs')) );
     App::$app->getProperties();

 }

}
