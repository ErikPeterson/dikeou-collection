<?php
$posts = Timber::get_posts();
$context = Timber::get_context();

$context['posts'] = $posts;
$context['page_type'] = 'artists';

$count = count($posts);
$context['columns'] = max(1, round($count / 10));

Timber::render('artists.twig', $context);
