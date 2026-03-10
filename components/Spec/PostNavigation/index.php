<?php
/**
 * Post Navigation Component
 *
 * Рендер через render_component('Spec.PostNavigation')
 */
?>

<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<nav class="post-navigation typo my-5 sm:my-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- PREVIOUS POST -->
        <div>
            <?php if ($prev_post): ?>
                <a href="<?php echo get_permalink($prev_post); ?>"
                    class="group block h-full rounded-2xl bg-blue-400 p-8 text-white transition hover:opacity-90">

                    <div class="text-sm opacity-80 mb-3">
                        ← Предыдущая статья
                    </div>

                    <div class="text-2xl font-semibold leading-snug">
                        <?php echo esc_html(get_the_title($prev_post)); ?>
                    </div>

                </a>
            <?php endif; ?>
        </div>

        <!-- NEXT POST -->
        <div class="text-right">
            <?php if ($next_post): ?>
                <a href="<?php echo get_permalink($next_post); ?>"
                    class="group block h-full rounded-2xl bg-blue-400 p-8 text-white transition hover:opacity-90">

                    <div class="text-sm opacity-80 mb-3">
                        Следующая статья →
                    </div>

                    <div class="text-2xl font-semibold leading-snug">
                        <?php echo esc_html(get_the_title($next_post)); ?>
                    </div>

                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>