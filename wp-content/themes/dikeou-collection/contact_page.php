<?php
$post = Timber::get_post();
$context = Timber::get_context();
$context['page_type'] = 'contact';
$context['post'] = $post;

Timber::render('contact.twig', $context);
