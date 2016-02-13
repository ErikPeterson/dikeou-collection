<?php
$posts = Timber::get_posts();
$context = Timber::get_context();
$context['posts'] = $posts;
$context['page_type'] = 'art-co';
$context['page'] = Timber::get_post(array('pagename'=>'artco-page'));

Timber::render('artco-posts.twig', $context);
