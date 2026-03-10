<?php

if (!isset($location)) return;

$locations = get_nav_menu_locations();
if (!isset($locations[$location])) return;

$menu_id = $locations[$location];
$items = wp_get_nav_menu_items($menu_id);

if (!$items) return;


// строим дерево
$tree = [];
$refs = [];

foreach ($items as $item) {
    $item->children = [];
    $refs[$item->ID] = $item;

    if ($item->menu_item_parent == 0) {
        $tree[$item->ID] = $item;
    } else {
        $refs[$item->menu_item_parent]->children[] = $item;
    }
}

?>

<div class="offcanvas" id="mobileMenu">

    <div class="offcanvas__inner">

        <button class="offcanvas__close">
            <?php svg_icon('close', 'w-4 h-4 icon icon--canvas-close'); ?>
        </button>

        <div class="offcanvas__overflow scrollbar-none">

            <ul class="offcanvas__menu">

                <?php foreach ($tree as $item): ?>

                    <?php $hasChildren = !empty($item->children); ?>

                    <li class="offcanvas__item <?= $hasChildren ? 'offcanvas__item--has-children' : '' ?>">

                        <?php if ($hasChildren): ?>

                            <div class="offcanvas__link">

                                <a href="<?= esc_url($item->url) ?>">
                                    <?= esc_html($item->title) ?>
                                </a>

                                <?php svg_icon('caret', 'w-4 h-4 offcanvas__caret'); ?>

                            </div>

                            <ul class="offcanvas__sub">

                                <?php foreach ($item->children as $child): ?>

                                    <li>
                                        <a href="<?= esc_url($child->url) ?>">
                                            <?= esc_html($child->title) ?>
                                        </a>
                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        <?php else: ?>

                            <a href="<?= esc_url($item->url) ?>">
                                <?= esc_html($item->title) ?>
                            </a>

                        <?php endif; ?>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

    </div>

</div>