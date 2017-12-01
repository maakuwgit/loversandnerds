<?php
	$dir = get_template_directory_uri() . '/images/';
	$callout_header = get_option('lans_callout_header');
	$callout_copy = get_option('lans_callout_copy');
	
	$users = get_users(array( 'role' => 'author') );
	if( $users ){
		foreach( $users as $user ){
			$user_arr[] = $user;
		}
	}
	if( sizeof($user_arr) > 0 ) :
?>
<article id="portfolios" class="entry-content callout relative table" data-background>
	<div class="feature">
		<img alt="" src="<?php echo $dir; ?>hero-users_mobile.jpg" data-src-medium="<?php echo $dir;?>hero-users_tablet.jpg" data-src-large="<?php echo $dir;?>hero-users.jpg" data-src-xlarge="<?php echo $dir;?>hero-users.jpg">
	</div>
	<div class="cell small-4 medium-4 large-4 text-center">
		<h2>Who are we?</h2>
		<p><a href="<?php echo $user_arr[0]->user_url;?>">Mark is a developer by day<br class="hide-for-large"> and a curator of ridable art<br class="hide-for-large"> by&nbsp;night.</a></p>
		<p><a href="<?php echo $user_arr[1]->user_url;?>">Tina spends her time<br class="hide-for-large"> being a sucker for cats<br class="hide-for-large"> and creating catchy&nbsp;copy.</a></p>
	</div>
</article>
<?php endif; ?>