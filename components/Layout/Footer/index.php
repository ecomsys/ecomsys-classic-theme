<?php
/**
 * Footer Component
 *
 * Рендер через render_component('Layout.Footer')
 */
?>

<footer id="colophon" class="site-footer bg-blue-400 mt-auto py-6">
    <div class="container">

        <div class="site-info font-body text-use text-white">
            <a href="<?php echo esc_url(__('https://wordpress.org/', 'ecomsys-classic')); ?>">
                <?php
                /* translators: %s: CMS name, i.e. WordPress. */
                printf(esc_html__('Proudly powered by %s', 'ecomsys-classic'), 'WordPress');
                ?>
            </a>
            <span class="sep"> | </span>
            <?php
            /* translators: 1: Theme name, 2: Theme author. */
            printf(esc_html__('Theme: %1$s by %2$s.', 'ecomsys-classic'), 'ecomsys-classic', '<a href="http://ecomsys.ru">Ecomsys.ru</a>');
            ?>
        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->

<?php render_component('Spec.Modal', [
    'id' => 'modal-1',
    'title' => 'Привет !',
    'description' => 'Это простая модалка с крестиком и overlay.',
]); ?>
