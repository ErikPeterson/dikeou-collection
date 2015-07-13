<?php
$context = Timber::get_context();
$context['page_type'] = 'contact';
Timber::render('contact.twig', $context);
