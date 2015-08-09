<?php
$posts = Timber::get_posts();
$context = Timber::get_context();

$context['posts'] = $posts;
$context['page_type'] = 'art-co';

Timber::render('artco-posts.twig', $context);
