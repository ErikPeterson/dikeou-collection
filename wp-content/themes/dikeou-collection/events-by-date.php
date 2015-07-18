<?php

$posts = Timber::get_posts();
$context = Timber::get_context();

$context['posts'] = $posts;
$context['page_type'] = 'events';

$count = count($posts);
$context['column_size'] = $count > 30 ? $count / 3 : 10;

if( $count > 20 ){
	$context['column_count'] = 3;
} else if($count > 10){
	$context['column_count'] = 2;
} else {
	$context['column_count'] = 1;
}

Timber::render('events-by-date.twig', $context);
