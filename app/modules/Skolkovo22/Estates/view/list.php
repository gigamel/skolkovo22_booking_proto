<?php /** @var \Modules\Skolkovo22\Estates\Entity\Estate[] $estates */ ?>
<div class="estates-outer">
  <div class="estates-filter">
    <form action="" method="GET" autocomplete="off">
      <div class="input-field">
        <input type="number" name="min_price" placeholder="Макс. цена"/>
      </div>
      <div class="input-field">
        <input type="number" name="max_price" placeholder="Мин. цена"/>
      </div>
      <button class="btn">Применить</button>
    </form>
  </div>
  <div class="estates-list">
    <div class="estates">
      <?php foreach ($estates as $estate): ?>
      <div class="estate">
        <div class="estate-inner">
          <h3><?= $estate->title; ?></h3>
          <p><?= $estate->summary; ?></p>
          <p>id: <?= $estate->id; ?></p>
          <p><strong>Цена:</strong> <?= $estate->price; ?> <?= $estate->currency; ?></p>
          <a href="<?= $router->getRouteUrl('estate', ['entity_id' => (string)$estate->id]); ?>" class="btn">Смотреть</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <?php
    $pages = ceil($count / $limit);
    if ($pages < 2) {
        return;
    }
    ?>

    <?php for ($page = 1; $page <= $pages; $page++): ?>
    <a href="/page/<?=$page;?>" class="page-number"><?= $page; ?></a>
    <?php endfor; ?>

  </div>
</div>
