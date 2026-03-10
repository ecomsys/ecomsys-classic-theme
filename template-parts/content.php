<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ecomsys Classic Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('typography mb-10'); ?>>

	<header class="entry-header mb-6">

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="text-3xl font-bold mb-4">', '</h1>' );
		else :
			the_title(
				'<h2 class="text-2xl font-semibold mb-4"><a class="hover:text-blue-400 transition" href="' . esc_url( get_permalink() ) . '" rel="bookmark">',
				'</a></h2>'
			);
		endif;

		if ( 'post' === get_post_type() ) :
		?>

		<div class="entry-meta flex flex-wrap items-center gap-4 text-sm text-gray-500">
			<?php
			ecomsys_classic_posted_on();
			ecomsys_classic_posted_by();
			?>
		</div>

		<?php endif; ?>

	</header>

	<?php ecomsys_classic_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links mt-6">',
				'after'  => '</div>',
			)
		);
		?>
	</div>

	<footer class="entry-footer mt-6 pt-4 border-t border-gray-200 text-sm text-gray-500">
		<?php ecomsys_classic_entry_footer(); ?>
	</footer>

</article>