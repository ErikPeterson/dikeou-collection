<?php
$post = Timber::get_post();

$context = Timber::get_context();
$context['post'] = $post;
$context['page_type'] = 'event';

Timber::render('event.twig', $context);
