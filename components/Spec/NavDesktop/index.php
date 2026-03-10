<?php

if (!isset($location))
    return;

// locations
$locations = get_nav_menu_locations();
if (!isset($locations[$location]))
    return;

// menu id
$menu_id = $locations[$location];

// items
$items = wp_get_nav_menu_items($menu_id);
if (!$items)
    return;


// строим дерево
$tree = [];
$refs = [];

foreach ($items as $item) {

    $item->children = [];
    $refs[$item->ID] = $item;

    if ($item->menu_item_parent == 0) {

        $tree[$item->ID] = $item;

    } else {

        if (isset($refs[$item->menu_item_parent])) {
            $refs[$item->menu_item_parent]->children[] = $item;
        }

    }

}

?>

<nav class="header__nav nav">
    <ul class="nav__list">

        <?php foreach ($tree as $item): ?>

            <?php $hasChildren = !empty($item->children); ?>

            <li class="nav__item <?= $hasChildren ? 'nav__item--has-dropdown' : '' ?>">

                <a href="<?= esc_url($item->url) ?>">

                    <span>
                        <?= esc_html($item->title) ?>
                    </span>

                    <?php if ($hasChildren): ?>
                        <?php svg_icon('caret', 'w-4 h-4 icon--header-caret nav__caret'); ?>
                    <?php endif; ?>

                </a>

                <?php if ($hasChildren): ?>

                    <ul class="nav__dropdown scrollbar-none">

                        <?php foreach ($item->children as $child): ?>

                            <?php $hasSub = !empty($child->children); ?>

                            <li class="nav__item <?= $hasSub ? 'nav__item--has-children' : '' ?>">

                                <a href="<?= esc_url($child->url) ?>">

                                    <span>
                                        <?= esc_html($child->title) ?>
                                    </span>

                                    <?php if ($hasSub): ?>
                                        <?php svg_icon('right-chevron', 'w-4 h-4 icon--canvas-caret-right'); ?>
                                    <?php endif; ?>

                                </a>

                                <?php if ($hasSub): ?>

                                    <ul class="nav__sub-dropdown scrollbar-none">

                                        <?php foreach ($child->children as $sub): ?>

                                            <li class="nav__item">
                                                <a href="<?= esc_url($sub->url) ?>">
                                                    <?= esc_html($sub->title) ?>
                                                </a>
                                            </li>

                                        <?php endforeach; ?>

                                    </ul>

                                <?php endif; ?>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>

            </li>

        <?php endforeach; ?>

    </ul>
</nav>