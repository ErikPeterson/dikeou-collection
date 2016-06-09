<?php
$posts = Timber::get_posts();
$context = Timber::get_context();

// shuffle($posts);
$context['posts'] = $posts;
$context['page_type'] = 'artists';

$count = count($posts);
$cols = $count > 1 ? 2 : 1;
$context['cols'] = Array();

if($cols == 1){
	$context['cols'][0] = $context['posts'];
} else{
	$first_half = round($count / 2);
	$second_half = floor($count / 2);
	$context['cols'][0] = array_slice($context['posts'], 0, $first_half);
	$context['cols'][1] = array_slice($context['posts'], $first_half, $second_half);
}

Timber::render('artists.twig', $context);
