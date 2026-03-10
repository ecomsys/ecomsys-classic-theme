<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Ecomsys Classic Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside id="secondary" class="typo widget-area w-full lg:w-64 shrink-0 lg:sticky lg:top-31 self-start flex-col flex gap-6">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>		
</aside><!-- #secondary -->
