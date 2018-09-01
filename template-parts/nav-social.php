<?php
/**
 * The template part for displaying the next button
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.4
 */
 
	//Social
	$github = get_user_meta($user->ID, 'github', true);
	$bitbucket = get_user_meta($user->ID, 'bitbucket', true);
	$linkedin = get_user_meta($user->ID, 'linkedin', true);
	$twitter = get_user_meta($user->ID, 'twitter', true);
	$instagram = get_user_meta($user->ID, 'instagram', true);
	$facebook = get_user_meta($user->ID, 'facebook', true);
	$medium = get_user_meta($user->ID, 'medium', true);
?>
	<?php if( $linkedin || $github || $bitbucket || $twitter || $instagram || $facebook || $medium ) : ?>
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
	<?php endif; ?>