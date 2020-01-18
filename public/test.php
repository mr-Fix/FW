<?php
require 'rb.php';
$db = require '../config/config_db.php';
R::setup($db['dsn'], $db['user'], $db['pass'], $options);
// var_dump(R::testConnection());
//create
// $cat = R::dispense('category');
// $cat->title = 'Категория 1';
// $id = R::store($cat);
// var_dump($id);

// Read
//$cat = R::load('category', 1);
//echo $cat->title; //$cAR['title']

// Update
//$cat = R::load('category', 1);
// $cat->title = ' Категория 2';
// R::store($cat);

// Delete
// $cat = R::load('category', 1);
// R::trash($cat);
//R::wipe('category');
