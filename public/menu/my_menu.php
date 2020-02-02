<li>
  <hr>
  <a href="?id=<?=$id;?>"><?php echo $category['title']; ?></a>
  <?php if( isset($category['childs']) ): ?>
    <ul><?php echo $this->getMenuHtml($category['childs']); ?></ul>
  <?php endif; ?>
</li>
