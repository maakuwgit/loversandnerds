<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 0.1
 */
?>
				<footer id="colophon" class="site-footer sticky hide" data-sticky data-stick-to="bottom">	
					<div class="site-info">
						<?php
							/**
							 * Fires before the twentysixteen footer text for footer customization.
							 *
							 * @since Twenty Sixteen 1.0
							 */
							do_action( 'twentysixteen_credits' );
						?>
						<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentysixteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentysixteen' ), 'WordPress' ); ?></a>
					</div><!-- .site-info -->
				</footer><!-- .site-footer -->
			</div>
		</div>
	<?php wp_footer(); ?>
	</body>
</html>
