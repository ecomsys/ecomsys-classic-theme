<?php
/**
 * Template comment
 *
 * @package Ecomsys Classic Theme
 */

?>

<?php
function ecomsys_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
?>

<li <?php comment_class('comment flex flex-col gap-5 sm:gap-10'); ?> id="comment-<?php comment_ID(); ?>">

	<div class="flex gap-4">

		<div class="flex-shrink-0">
			<?php echo get_avatar($comment, 48, '', '', ['class' => 'rounded-full']); ?>
		</div>

		<div class="flex-1 bg-gray-50 rounded-xl p-4">

			<div class="flex items-center gap-3 mb-2">

				<span class="font-semibold text-gray-900">
					<?php comment_author(); ?>
				</span>

				<span class="text-sm text-gray-500">
					<?php comment_date(); ?>
				</span>

			</div>

			<div class="text-gray-700 leading-relaxed">
				<?php comment_text(); ?>
			</div>

			<div class="mt-3 text-sm">
				<?php
				comment_reply_link(array_merge($args, [
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'class'     => 'text-blue-400 hover:underline'
				]));
				?>
			</div>

		</div>

	</div>

<?php
}