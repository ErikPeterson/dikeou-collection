<?php
require plugin_dir_path(__FILE__).'../../vendor/autoload.php';

global $params;
$page = array_key_exists('p', $params) ? $params['p'] : 0;

$context = Timber::get_context();

$client = new Tumblr\API\Client('1nPJnQOWjlbFkFt7Mp8ihWSE1CkDJrorHEA2gOj7IqqNlV0eQb');
$response = $client->getBlogPosts('dikeoucollection.tumblr.com', array('limit' => 5, 'offset' => $page * 5, 'filter' => 'html'));
$context['posts'] = $response->posts;
$context['next_page'] = ($page * 5) + 5 >= $response->blog->posts ? false : $page + 1;
$context['prev_page'] = $page > 0 ? $page - 1 : false;
$context['page_type'] = 'blog';

Timber::render('blog-page.twig', $context);