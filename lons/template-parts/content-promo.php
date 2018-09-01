<?php
/**
 * The template part for displaying user callouts
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.1
 */
	$dir = get_template_directory_uri() . '/assets/img/';
	
	$users = get_users(array( 'role' => 'author', 'order' => 'DESC' ) );
	if( $users ) :
?>
<article id="portfolios" class="entry-content callout relative" data-background>
	<div class="feature">
		<img alt="" src="<?php echo $dir; ?>hero-users_mobile.jpg" data-src-medium="<?php echo $dir;?>hero-users_tablet.jpg" data-src-large="<?php echo $dir;?>hero-users.jpg" data-src-xlarge="<?php echo $dir;?>hero-users.jpg">
	</div>
	<header class="table text-center">
		<h2>Who are we?</h2>
	</header>
	<div class="table row">
	<?php 
		$u = 0;
		foreach( $users as $user ) :
			$desc = get_user_meta( $user->ID, 'description' );
			if( $u%2 == 0 ){
				$style = ' text-left';
			}else{
				$style = ' text-right';
			}
	?>
		<div class="column small-12 medium-4 large-3<?php echo $style; ?>">
			<h4><?php echo $user->display_name; ?></h4>
			<p><?php echo $desc[0]; ?></p>
			<p><a href="<?php echo $user->user_url;?>" class="button">What Else?</a></p>
		</div>
	<?php $u++; endforeach; ?>
	</div>
</article>
<?php endif; ?>