<?php
$post = Timber::get_post();
$context = Timber::get_context();
$context['post'] = $post;

Timber::render('artist.twig', $context);
