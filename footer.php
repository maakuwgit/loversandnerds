<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.4
 */

$template_uri = get_template_directory_uri();
?>
<footer id="colophon" class="collapsed" data-menu id="footer_menu">
<?php
	$users = get_users(array( 'role' => 'author', 'order' => 'ASC' ) );
	if( $users ) :
		
		foreach( $users as $user ) :
			//Thumbnail
			$photo = get_user_meta($user->ID, 'photo', true);
			$xlphoto = wp_get_attachment_image_src($photo, 'fullsize' );
			$mphoto = wp_get_attachment_image_src($photo, 'medium' );
			$tphoto = wp_get_attachment_image_src($photo, 'thumbnail');
			$dphoto = wp_get_attachment_image_src($photo, 'large' );
 
			if(!$photo) $photo = 'http://placehold.it/2560x700';
			
			//General Info
			$gender = get_user_meta($user->ID, 'gender', true);
			$nickname = get_user_meta($user->ID, 'nickname', true);
			if($user->user_nicename === 'maakuw') $nickname = '真ー久W';
			$job_title = get_user_meta($user->ID, 'job_title', true);
			$job_description = get_user_meta($user->ID, 'job_description', true);
			$description = get_user_meta($user->ID, 'description', true);
?>
	<div>
		<article style="background-image: url(<?php echo $dphoto[0];?>);">
			<figure class="th">
				<div>
					<img alt="" src="<?php echo $tphoto[0]; ?>" data-src-medium="<?php echo $mphoto[0];?>" data-src-large="<?php echo $dphoto[0];?>" data-src-xlarge="<?php echo $xlphoto[0];?>">
				</div>
				<figcaption>
					<h5 data-href="<?php echo $user->user_url;?>" data-target="_self"><?php echo $nickname;?></h5>
				<?php if ($job_title !== '' ) : ?>
					<h6 data-href="<?php echo $user->user_url;?>" data-target="_self"><?php echo $job_title;?></h6>
				<?php endif; ?>
					<p data-href="<?php echo $user->user_url;?>" data-target="_self"><?php echo $description;?></p>
					<?php include(locate_template( 'template-parts/nav-social.php')); ?>
				</figcaption>
			</figure>
		</article>
		<?php
			$args = array(
				'posts_per_page' => 9,
				'author' => $user->ID,
			);
			
			$categories = new WP_Query( $args );
			
			if ( have_posts() ) :
		?>
			<?php if ( $user->ID === 2 ) : ?>
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
			<?php else : ?>
		<dl data-journal>
			<?php
				$cc = 0;
				$col1 = array();
				$col2 = array();
				
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
			<?php endif; ?>
		<?php endif; ?>
	</div>
<?php
		endforeach;
			
		wp_reset_postdata();
	
	endif;
?>
</footer>
<?php wp_footer(); ?>
</body>
</html>