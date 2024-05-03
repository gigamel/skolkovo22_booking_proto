<?php

/** @var \App\Common\Routing\RouterInterface $router */
/** @var \Modules\Skolkovo22\Estates\Service\Estate\Estate[] $estates */
/** @var \Booking\Service\File\File[] $files */
/** @var \Booking\Service\Currency\Converter $converter */
/** @var int $count */
/** @var int $limit */

?>
<div class="estates-outer">
    <div class="estates-filter">
        <form action="" method="GET" autocomplete="off">
            <div class="input-field">
                <input type="number" name="min_price" placeholder="Max price"/>
            </div>
            <div class="input-field">
                <input type="number" name="max_price" placeholder="Min price"/>
            </div>
            <button class="btn">Apply filter</button>
        </form>
    </div>
    <div class="estates-list">
        <div class="estates">
            <?php foreach ($estates as $estate): ?>
            <div class="estate">
                <div class="estate-inner">
                    <h3><?= $estate->title; ?></h3>

                    <?php if (is_array($files[$estate->id] ?? null)): ?>
                    <div class="estate-images">
                      <?php foreach ($files[$estate->id] as $file): ?>
                      <div class="estate-image">
                        <img src="/<?= $file->source; ?>" alt="<?= $file->alt; ?>">
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <p><?= $estate->summary; ?></p>
                    <p><strong>Price:</strong> <?= $converter->convertToMajors($estate->price, $estate->currency); ?> <?= $estate->currency; ?></p>
                    <a href="<?= $router->getRouteUrl('estate', ['entity_id' => (string)$estate->id]); ?>" class="btn">Show more</a>
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
        <a href="<?= $router->getRouteUrl('estates_pages', ['page_attr_name' => 'page', 'page_number' => (string)$page]); ?>" class="page-number"><?= $page; ?></a>
        <?php endfor; ?>

    </div>
</div>
