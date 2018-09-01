<?php
/**
 * The template for displaying all single posts and attachments
 * 
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 1
 */

get_header(); ?>
	<main id="content" class="content-area off-canvas-content" data-off-canvas-content>
<?php 
		$prev = get_previous_posts_link();
		$next = get_next_posts_link();
		if(!empty($prev)) previous_posts_link('<em class="fa fa-angle-left"></em>', 5);
		
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			get_template_part( 'template-parts/content', 'single' );

			// End of the loop.
		endwhile;
		
		if ( shortcode_exists( 'nu_tweets' ) ) {
			echo do_shortcode("[nu_tweets]");
		}
		
		if(!empty($next)) next_posts_link('<em class="fa fa-angle-right"></em>', 5);
?>
	</main>
<?php get_footer(); ?>
