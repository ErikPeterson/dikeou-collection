<?php
$post = Timber::get_post();
$context = Timber::get_context();
$context['page_type'] = 'popup';
$context['post'] = $post;
Timber::render('page-pop-up.twig', $context);
