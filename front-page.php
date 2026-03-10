<?php
/**
 * The front-page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ecomsys Classic Theme
 */

get_header();
?>

<div class="container flex flex-1 flex-col lg:flex-row gap-8 py-8">
    <main id="primary" class="site-main w-full">

        <!-- кртейнер с кнопкой -->
        <div class="flex items-center gap-10 justify-center">
            <?php
            render_component('UI.Button', [
                'variant' => 'primary',
                'slot' => 'Открыть модалку',
                'attrs' => [
                    'type' => 'button',
                    'data-action-id' => 'modal',
                    'data-action' => 'openModal',
                    'onclick' => 'actions({selector: "#modal-1", action: "openModal"})'
                ],
            ]); ?>           

        </div>
    </main><!-- #main -->
</div>

<?php get_footer();
