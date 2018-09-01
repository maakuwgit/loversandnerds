<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
		<div id="no-results-content" <?php post_class('entry-content active'); ?>>
			<header class="entry-header"  id="fourofour-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentysixteen' ); ?></h1>
			</header>
			<div id="no-results-body" class="entry-body">
			<?php if ( is_search() ) : ?>
				<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentysixteen' ); ?></p>
			<?php else : ?>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentysixteen' ); ?></p>
			<?php endif; ?>
				<?php get_search_form(); ?>
			</div>
		</div>