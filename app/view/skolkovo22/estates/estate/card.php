<div class="estate-page">
    <h1><?= $estate->title; ?></h1>
    <p><?= $estate->summary; ?></p>
    <p><strong>Цена:</strong> <?= $estate->price; ?> <?= $estate->currency; ?></p>
    <p><a href="<?= $router->getRouteUrl('estates'); ?>" class="btn">Вернуться в список</a></p>
</div>
