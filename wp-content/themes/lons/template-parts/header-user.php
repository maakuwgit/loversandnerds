<?php
/**
 * The template part for displaying the project footer navigation
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3
 */
 global $user, $first;

 $nickname = get_user_meta($user->ID, 'nickname', true);
 $description = get_user_meta($user->ID, 'description', true);
?>
<div class="cell small-6 medium-6 large-4 text-center">		
<?php if($first == true) :?>
	<h1><?php echo $nickname;?></h1>
<?php else: ?>
	<h2><?php echo $nickname;?></h2>
<?php endif; ?>
	<p><?php echo $description;?></p>
</div>