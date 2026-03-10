<?php
/**
 * Header Component
 *
 * Рендер через render_component('Layout.Header')
 */
?>

<header id="masthead" class="site-header flex flex-col gap-5 py-4 sticky top-0 z-50 bg-blue-400 shadow">
    <div class="container flex items-center justify-between">

        <div class="site-branding flex items-center gap-6">
            <div class="max-w-[50px] aspect-square shrink-0">
                <?php the_custom_logo(); ?>
            </div>
            <?php if (is_front_page() && is_home()): ?>
                <h1 class="site-title text-h1 text-heading text-white">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
            <?php else: ?>
                <p class="site-title h1 text-h1 text-heading text-white">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </p>
            <?php endif; ?>
        </div>

        <?php

        render_component('Spec.NavDesktop', [
            'location' => 'primary'
        ]);

        ?>

        <div class="flex items-center gap-5">
            <!-- Бургер (мобильная версия) -->
            <button class="header__burger">
                <?php svg_icon('burger', 'w-8 h-8 text-white icon--burger'); ?>
            </button>

            <?php
            render_component('Spec.DarkModeToggle');
            ?>
        </div>
        
    </div>
</header>

<?php render_component('Spec.NavMobile', [
    'location' => 'primary'
]);