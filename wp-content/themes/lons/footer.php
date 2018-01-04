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
 * @since Lovers + Nerds 2.3.3
 */

$template_uri = get_template_directory_uri();
$uploads_dir 	= home_url() . '/wp-content/uploads/';
?>
<footer id="colophon" class="collapsed" data-menu id="footer_menu">
<?php
	$users = get_users(array( 'role' => 'author', 'order' => 'ASC' ) );
	if( $users ) :
		
		foreach( $users as $user ) :
			//Thumbnail
			$photo = get_user_meta($user->ID, 'photo', true);
			$mphoto = $tphoto = $dphoto = substr($photo,0, strpos($photo, '.'));
			$dphoto = $dphoto . '-1920x525' . substr($photo, strpos($photo, '.'));
			$mphoto = $mphoto . '-640x175' . substr($photo, strpos($photo, '.'));
			$tphoto = $tphoto . '-1024x280' . substr($photo, strpos($photo, '.'));
			if(!$photo) $photo = 'http://placehold.it/2560x700';
			$photo = $uploads_dir . $photo;
			$mphoto = $uploads_dir . $mphoto;
			$tphoto = $uploads_dir . $tphoto;
			$dphoto = $uploads_dir . $dphoto;
			
			//General Info
			$gender = get_user_meta($user->ID, 'gender', true);
			$nickname = get_user_meta($user->ID, 'nickname', true);
			$job_title = get_user_meta($user->ID, 'job_title', true);
			$job_description = get_user_meta($user->ID, 'job_description', true);
			$description = get_user_meta($user->ID, 'description', true);
			
			//Social
			$github = get_user_meta($user->ID, 'github', true);
			$bitbucket = get_user_meta($user->ID, 'bitbucket', true);
			$linkedin = get_user_meta($user->ID, 'linkedin', true);
			$twitter = get_user_meta($user->ID, 'twitter', true);
			$instagram = get_user_meta($user->ID, 'instagram', true);
			$facebook = get_user_meta($user->ID, 'facebook', true);
			$medium = get_user_meta($user->ID, 'medium', true);
			
	 ?>
	<div>
		<article>
			<figure class="th">
					<img alt="" src="<?php echo $mphoto; ?>" data-src-medium="<?php echo $tphoto;?>" data-src-large="<?php echo $dphoto;?>" data-src-xlarge="<?php echo $photo;?>">
				<figcaption>
					<h5><?php echo $nickname;?></h5>
					<h6><?php echo $job_title;?></h6>
					<p><?php echo $description;?></p>
				</figcaption>
			</figure>
			<nav>
				<ul>
				<?php if( $linkedin ) : ?>
					<li><a target="_blank" href="https://www.linkedin.com/in/<?php echo $linkedin; ?>/"><em class="fa fa-linkedin-square"></em></a></li>
				<?php endif; ?>
				<?php if( $github ) : ?>
					<li><a target="_blank" href="https://github.com/<?php echo $github; ?>"><em class="fa fa-github-square"></em></a></li>
				<?php endif; ?>
				<?php if( $bitbucket ) : ?>
					<li><a target="_blank" href="https://bitbucket.org/<?php echo $bitbucket; ?>/"><em class="fa fa-bitbucket-square"></em></a></li>
				<?php endif; ?>
				<?php if( $twitter ) : ?>
					<li><a target="_blank" href="https://twitter.com/<?php echo $twitter; ?>"><em class="fa fa-twitter-square"></em></a></li>
				<?php endif; ?>
				<?php if( $instagram ) : ?>
					<li><a target="_blank" href="https://www.instagram.com/<?php echo $instagram; ?>/"><em class="fa fa-instagram"></em></a></li>
				<?php endif; ?>
				<?php if( $facebook ) : ?>
					<li><a target="_blank" href="https://facebook.com/<?php echo $facebook; ?>"><em class="fa fa-facebook-square"></em></a></li>
				<?php endif; ?>
				<?php if( $medium ) : ?>
					<li><a target="_blank" href="https://medium.com/@<?php echo $medium; ?>"><em class="fa fa-medium"></em></a></li>
				<?php endif; ?>
				</ul>
			</nav>
		</article>
		<?php
			$cat = ( $user->ID === 2 ? 7 : 25 );
			
			$args = array(
				'posts_per_page' => 9,
				'cat' => $cat,
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