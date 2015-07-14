<?php
$post = Timber::get_post();
$context = Timber::get_context();
$context['page_type'] = 'about';
$context['post'] = $post;

Timber::render('about.twig', $context);
