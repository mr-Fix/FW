<select class="" name="lang" id="lang">
  <option value="<?php echo $this->language['code']; ?>"><?php echo $this->language['title']; ?></option>
  <?php foreach($this->languages as $k => $v): ?>
    <?php if($this->language['code'] != $k): ?>
    <option value="<?php echo $k; ?>"><?php echo $v['title']; ?></option>
    <?php endif; ?>
  <?php endforeach; ?>
</select>
