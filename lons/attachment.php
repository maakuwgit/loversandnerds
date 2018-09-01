<?php
/**
 * The template for displaying image attachments
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 0.1
 */

get_header(); ?>
	<main id="content" class="content-area off-canvas-content" data-off-canvas-content>
	<?php get_template_part( 'template-parts/content', 'user' ); ?>
	<?php 
		if ( have_posts() ) {
			$first = true;
			$prev = get_previous_posts_link();
			$next = get_next_posts_link();

			if(!empty($prev)) previous_posts_link('<em class="fa fa-angle-left"></em>', 5);
			// Start the loop.
			while ( have_posts()) : the_post();
				
				get_template_part( 'template-parts/content', 'image' );
				
				$first = false;
			// End the loop.
			endwhile;
		
		// If no content, include the "No posts found" template.
		
			if(!empty($next)) next_posts_link('<em class="fa fa-angle-right"></em>', 5);
		} else {
			get_template_part( 'template-parts/content', 'none' );
		
		}
			
			wp_reset_postdata();
	?>
	</main>
<?php get_footer(); ?>