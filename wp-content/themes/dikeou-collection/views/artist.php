<?php

global $artist_slug;

$args = array(
	'name' => $artist_slug,
	'post_type' => 'artist',
	'posts_per_page' => 1,
	'caller_get_posts' => 1
);

$content = array();

$content['post'] = Timber::get_post(args);
