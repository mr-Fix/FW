<h1>Вид Main - index</h1>

<?php //new fw\widgets\menu\Menu([
  // 'tpl' => WWW . '/menu/my_menu.php',
  //'tpl' => WWW . '/menu/select.php',
  //'container' => 'select',
//  'class' => 'my-menu',
//  'table' => 'categories',
//  'cashe' => 60,
//  'cacheKey' => 'menu_select',
//]);
?>

  <!-- <button class="btn btn-default" id="send">Кнопка</button> -->
  <?php if( !empty($posts) ): ?>
    <?php foreach($posts as $post): ?>
      <!-- <div class="card">
        <h5 class="card-header"><?php echo $post['title']; ?></h5>
        <div class="card-body">
          <p class="card-text"><?php echo $post['text']; ?></p>
          <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
        </div>
      </div> -->

      <div class="content-grid-info">
        <img src="/public/blog/images/post1.jpg" alt=""/>
        <div class="post-info">
        <h4><a href="<?php echo $post->id; ?>"><?php echo $post->title; ?></a>  July 30, 2014 / 27 Comments</h4>
        <p><?php echo $post->excerpt; ?></p>
        <a href="<?php echo $post->id; ?>"><span></span><?php __('read_more'); ?></a>
        </div>
      </div>
      <?php endforeach; ?>
      <div class="text-center">
        <p>Статей: <?php echo count($posts); ?> из <?php echo $total; ?></p>
        <?php if($pagination->countPages > 1): ?>
          <?php echo $pagination; ?>
        <?php endif; ?>
      </div>
  <?php else: ?>
    <h3>Posts not found...</h3>
  <?php endif; ?>
