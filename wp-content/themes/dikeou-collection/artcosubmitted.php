<?php
global $params;

$context = Timber::get_context();

try{
	extract($params);	

	update_field('field_55b45a0477044', $artist_content, $post_id);

	foreach( $image_ids as $id){
		$value = array(array("field_55b45afb7704a" => $id));
		update_field('field_55b45a2577045', $value, $post_id);
	}


	Timber::render('success.twig', $context);

} catch(Execption $e){
	Timber::render('fail.twig', $context);
}