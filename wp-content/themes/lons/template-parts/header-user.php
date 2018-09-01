<?php
/**
 * The template part for displaying the project footer navigation
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 2.3.5
 */
 global $user, $first;

 $nickname = get_user_meta($user->ID, 'nickname', true);
 $job_title = get_user_meta($user->ID, 'job_title', true);
 $job_description = get_user_meta($user->ID, 'job_description', true);
 $description = get_user_meta($user->ID, 'description', true);
 $link = ' data-href="' . $user->user_url . '" data-target="_self"';
?>
<div class="cell small-6 medium-6 large-4 text-center">		
<?php if($first == true) :?>
	<h1<?php if(!is_archive()) echo $link;?>><?php echo $nickname;?></h1>
<?php else: ?>
	<h2<?php if(!is_archive()) echo $link;?>><?php echo $nickname;?></h2>
<?php endif; ?>
	<p<?php if(!is_archive()) echo $link;?>><?php echo $job_description;?></p>
	<?php include(locate_template( 'template-parts/nav-social.php')); ?>
</div>