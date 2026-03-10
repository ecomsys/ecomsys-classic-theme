<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ecomsys Classic Theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()):
		?>
		<h2 class="comments-title typo text-2xl font-semibold mb-6">
			<?php
			$ecomsys_classic_comment_count = get_comments_number();
			if ('1' === $ecomsys_classic_comment_count) {
				printf(
					/* translators: 1: title. */
					esc_html__('One thought on &ldquo;%1$s&rdquo;', 'ecomsys-classic'),
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html(_nx('%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $ecomsys_classic_comment_count, 'comments title', 'ecomsys-classic')),
					number_format_i18n($ecomsys_classic_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post(get_the_title()) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list typo mt-10 space-y-6">
			<?php
			wp_list_comments([
				'style' => 'ol',
				'short_ping' => true,
				'avatar_size' => 48,
				'callback' => 'ecomsys_comment',
			]);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if (!comments_open()):
			?>
			<p class="no-comments"><?php esc_html_e('Comments are closed.', 'ecomsys-classic'); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().
	

	comment_form([
		'class_container' => 'comment-form Типа w-full mt-8',
		'class_form' => 'w-full space-y-4',

		'comment_field' => '
		<p class="comment-form-comment w-full">
			<label for="comment" class="block mb-2 font-medium">Комментарий</label>
			<textarea id="comment" name="comment" rows="6"
				class="w-full rounded-xl border border-gray-300 p-4 
				focus:border-blue-400 focus:ring-0 outline-none 
				placeholder:text-gray-400"
				placeholder="Напишите комментарий..." required></textarea>
		</p>
	',

		'fields' => [
			'author' => '
			<p class="comment-form-author w-full">
				<label for="author" class="block mb-2 font-medium">Имя</label>
				<input id="author" name="author" type="text"
					class="w-full rounded-xl border border-gray-300 p-3
					focus:border-blue-400 focus:ring-0 outline-none"
					required>
			</p>
		',

			'email' => '
			<p class="comment-form-email w-full">
				<label for="email" class="block mb-2 font-medium">Email</label>
				<input id="email" name="email" type="email"
					class="w-full rounded-xl border border-gray-300 p-3
					focus:border-blue-400 focus:ring-0 outline-none"
					required>
			</p>
		',
		],

		'class_submit' => 'bg-blue-400 text-white px-6 py-3 rounded-xl hover:opacity-90 transition cursor-pointer',

		'label_submit' => 'Отправить комментарий',
	]);

	?>

</div><!-- #comments -->