<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ecomsys Classic Theme
 */

get_header();
?>

<div class="container typo flex flex-1 flex-col lg:flex-row gap-8 py-8">
	<main id="primary" class="site-main w-full">

		<?php
		while (have_posts()):
			the_post();

			get_template_part('template-parts/content', get_post_type());
		
			render_component('Spec.PostNavigation');

			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()):
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>

<?php get_footer();
