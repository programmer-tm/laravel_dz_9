<?php foreach($categories as $category): ?>
  <div>
      <h2><a href="<?=route('news', ['idCategory' => $category['id']])?>"><?=$category['title']?></a></h2>
  </div><br>
<?php endforeach; ?>
