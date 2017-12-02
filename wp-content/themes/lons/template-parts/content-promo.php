<?php
	$dir = get_template_directory_uri() . '/assets/img/';
	$callout_header = get_option('lans_callout_header');
	$callout_copy = get_option('lans_callout_copy');
	
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
		<div class="column small-12 medium-4 large-2<?php echo $style; ?>">
			<p><?php echo $desc[0]; ?></p>
			<p><a href="<?php echo $user->user_url;?>" title="See what Mark has been doing" class="button">Learn More</a></p>
		</div>
	<?php $u++; endforeach; ?>
	</div>
</article>
<?php endif; ?>