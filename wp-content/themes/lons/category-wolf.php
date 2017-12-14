<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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

			if(!empty($prev)) previous_posts_link('<em class="fa fa-chevron-left"></em>', 5);
			// Start the loop.
			while ( have_posts()) : the_post();
				
				get_template_part( 'template-parts/content-wolf', get_post_format() );
//				require( locate_template('template-parts/content-category.php') );
				
				$first = false;
			// End the loop.
			endwhile;
		
		// If no content, include the "No posts found" template.
		
			if(!empty($next)) next_posts_link('<em class="fa fa-chevron-right"></em>', 5);
		} else {
			get_template_part( 'template-parts/content', 'none' );
		
		}
			
			wp_reset_postdata();
	?>

	<?php 
		if ( shortcode_exists( 'nu_tweets' ) ) {
			echo do_shortcode("[nu_tweets]");
		}
	?>
		<button id="nextBtn" data-href=""><em class="fa fa-chevron-down"></em></button>
	</main>
<?php get_footer(); ?>
