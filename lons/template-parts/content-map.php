<?php
/**
 * The template part for displaying user callouts
 *
 * @package WordPress
 * @subpackage Lovers_and_nerds
 * @since Lovers + Nerds 3.0
 */
	$dir = get_template_directory_uri() . '/assets/img/';
?>
<article id="where-are-we" class="entry-content relative">
	<header class="table text-center">
		<h2>Where are we?</h2>
		<h3>We can't say precisely, our location changes with our mood. Here are some of the places we've been, though.</h3>
	</header>
	<div class="table row">
		<div id="map" data-locations="">[map goes here]</div>
	</div>
</article>