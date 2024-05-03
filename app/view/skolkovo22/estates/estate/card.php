<?php

/** @var \Booking\Service\Currency\Converter $converter */
/** @var \Modules\Skolkovo22\Estates\Service\Estate\Estate $estate */
/** @var \App\Common\Routing\RouterInterface $router */
/** @var \Booking\Service\File\File[] $files */

?>

<div class="estate-page">
    <h1><?= $estate->title; ?></h1>

    <?php foreach ($files as $file): ?>
    <div class="image">
      <img src="/<?= $file->source; ?>" alt="<?= $file->alt; ?>"/>
    </div>
    <?php endforeach; ?>

    <p><?= $estate->summary; ?></p>
    <p><strong>Price:</strong> <?= $converter->convertToMajors($estate->price, $estate->currency); ?> <?= $estate->currency; ?></p>
    <p><a href="<?= $router->getRouteUrl('estates'); ?>" class="btn">Go to list</a></p>
</div>
