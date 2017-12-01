<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 0.7
 */

get_header(); ?>
	<main id="content" class="content-area off-canvas-content" data-off-canvas-content>
		<div id="fourofour-content" <?php post_class('entry-content active'); ?>>
			<header class="entry-header"  id="fourofour-header">
				<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'lons' ); ?></h1>
			</header>
			<div id="fourofour-body" class="entry-body">
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'lons' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div>
	</main>
<?php get_footer(); ?>
