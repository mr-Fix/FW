<option value="<?php echo $id; ?>">
  <?php echo $tab . $category['title']; ?>
</option>
<?php if( isset($category['childs']) ): ?>
  <?php echo $this->getMenuHtml($category['childs'], '&nbsp;' . $tab . '-'); ?>
<?php endif; ?>
