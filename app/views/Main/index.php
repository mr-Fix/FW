<h1>Вид Main - index</h1>

<?php new fw\widgets\menu\Menu([
  // 'tpl' => WWW . '/menu/my_menu.php',
  'tpl' => WWW . '/menu/select.php',
  'container' => 'select',
  'class' => 'my-menu',
  'table' => 'categories',
  'cashe' => 60,
  'cacheKey' => 'menu_select',
]); ?>

<div class="container">
  <button class="btn btn-default" id="send">Кнопка</button>
  <?php foreach($posts as $post): ?>

  <?php endforeach; ?>
</div>
