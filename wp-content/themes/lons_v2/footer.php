<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

$template_uri = get_template_directory_uri();
?>
<footer class="collapsed" data-menu id="footer_menu">
<?php
		
	$args = array(
		'posts_per_page' => 9,
		'cat' => 7,
	);
	
	$categories = new WP_Query( $args );
	
	if ( have_posts() ) : ?>
	<div>
		<article>
			<figure class="th">
				<img alt="" src="<?php echo $template_uri; ?>/assets/img/IMG_0024.jpg">
				<figcaption>
					<h5>Mark Williamson</h5>
				</figcaption>
			</figure>
			<p>I am the determined conductor of a spontaneous semantic symphony, bringing a positive attitude, excellence in collaboration and a thirst for bug-less, hack-free sites to small and medium-sized teams.</p>
			<nav>
				<ul>
					<li>in</li>
					<li>indeed</li>
					<li>git</li>
				</ul>
			</nav>
		</article>
		<dl data-gallery>
			<?php
					// Start the loop.
					while ( $categories->have_posts()) : $categories->the_post();
				
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/thumbnail', 'small' );
				
					// End the loop.
					endwhile;
			?>
		</dl>
	</div>
<?php
	endif;
		
	wp_reset_postdata();
?>
<?php 
	$args = array(
		'posts_per_page' => 9,
		'cat' => 25,
	);
	
	$categories = new WP_Query( $args );
	
	if ( have_posts() ) : ?>
	<div>
		<article>
			<figure class="th">
				<img alt="" src="<?php echo $template_uri; ?>/assets/img/IMG_0023.jpg">
				<figcaption>
					<h5>Tina Johnson</h5>
				</figcaption>
			</figure>
			<p>Part-time writer, full-time inspired. Learning is my greatest passion and empathy is my greatest strength. I think freely and laugh often. Calling out captivating copy is my hobby and sometimes I even write it.</p>
			<nav>
				<ul>
					<li>in</li>
					<li>indeed</li>
					<li>git</li>
				</ul>
			</nav>
		</article>
		<dl data-journal>
			<?php
				$cc = 0;
				$col1 = [];
				$col2 = [];
				
					// Start the Loop.
					while ( $categories->have_posts() ) : $categories->the_post();
		
						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						if ( $cc%2==0 ) {
							ob_start();
							get_template_part( 'template-parts/journal', 'small' );
							$col1[] = ob_get_contents();
							ob_end_clean();
						}else{
							ob_start();
							get_template_part( 'template-parts/journal', 'small' );
							$col2[] = ob_get_contents();
							ob_end_clean();
						}
					// End the loop.
					$cc++;
					endwhile;
			?>
			<div>				
			<?php 
				foreach($col1 as $content1) {
					echo $content1;
				}
			?>
			</div>
			<div>
			<?php 
				foreach($col2 as $content2) {
					echo $content2;
				}
			?>
			</div>
		</dl>
	</div>
</footer>
<?php
	endif;
		
	wp_reset_postdata();
?>
<?php wp_footer(); ?>
</body>
</html>
