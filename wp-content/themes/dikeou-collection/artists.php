<?php
$posts = Timber::get_posts();
$context = Timber::get_context();

$context['posts'] = $posts;
$context['page_type'] = 'artists';

$count = count($posts);
$context['columns'] = 1 + floor($count / 3);

Timber::render('artists.twig', $context);
