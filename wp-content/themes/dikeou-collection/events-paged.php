<?php
global $params;

$context = Timber::get_context();
$context['posts'] = Timber::get_posts();
$context['pagination'] = array(
	'this_page' => $params['this_page'],
	'next_page' => $params['next_page'],
	'prev_page' => $params['prev_page']
);
$context['page_type'] = 'events';

Timber::render('events-paged.twig', $context);