<?php

/* Déclaration des formats d'image du thème */
add_image_size('wami_small', 232, 232, true);
add_image_size('wami_big', 482, 482, true);


/* formats à l'afficher lors de l'intégration dans le wysiwyg */
add_filter('image_size_names_choose', 'wami_image_size_choose');
function wami_image_size_choose($sizes){
	return array_merge($sizes, array(
		// identifiant du format => Nom du format
		//'wami_small' => __("Petit"),
	));
}


/* On retire les formats d'image par défaut pour éviter le stockage des fichiers */
add_filter('intermediate_image_sizes_advanced', 'wami_remove_image_sizes');
function wami_remove_image_sizes($sizes){
	unset($sizes['thumbnail'], $sizes['medium'], $sizes['large']);
	return $sizes;
}


/* Permet d'ajouter en BO une colonne avec la miniature de l'image à la Une du post */
add_action('manage_posts_custom_column', 'custom_columns_data', 10, 2); 
function custom_columns_data($column, $post_id){
	switch($column){
		case 'image':
			$image_data = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'wami_small');
			if($image_data[0]){
				echo '<img src="'.$image_data[0].'" style="display:block;max-width:110px;" />';
			}
			break;
	}
}
add_filter('manage_posts_columns' , 'custom_columns');
function custom_columns($columns){
	return array_merge(array(
		'cb'    => '<input type="checkbox" />',
		'image' => 'Image',
	), $columns);
}



add_filter('sanitize_file_name', 'wpc_sanitize_french_chars', 10);
function wpc_sanitize_french_chars($filename) {	
	// Force the file name in UTF-8 (encoding Windows / OS X / Linux) 
	$filename = mb_convert_encoding($filename, "UTF-8");

	$char_not_clean = array('/À/','/Á/','/Â/','/Ã/','/Ä/','/Å/','/Ç/','/È/','/É/','/Ê/','/Ë/','/Ì/','/Í/','/Î/','/Ï/','/Ò/','/Ó/','/Ô/','/Õ/','/Ö/','/Ù/','/Ú/','/Û/','/Ü/','/Ý/','/à/','/á/','/â/','/ã/','/ä/','/å/','/ç/','/è/','/é/','/ê/','/ë/','/ì/','/í/','/î/','/ï/','/ð/','/ò/','/ó/','/ô/','/õ/','/ö/','/ù/','/ú/','/û/','/ü/','/ý/','/ÿ/', '/©/', '/@/');
	$clean = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','u','u','u','u','y','a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','o','o','o','o','o','o','u','u','u','u','y','y','copy', 'at');

	$friendly_filename = preg_replace($char_not_clean, $clean, $filename);

	// After replacement, we destroy the last residues 
	$friendly_filename = utf8_decode($friendly_filename);
	$friendly_filename = preg_replace('/\?/', '', $friendly_filename);

	// Lowercase 
	$friendly_filename = strtolower($friendly_filename);

	return $friendly_filename;
}

function get_my_thumbnail_obj($post_id){
	
	$ptid  			= get_post_thumbnail_id($post_id);
	$attached_file  = get_attached_file($ptid); 
	$attachment 	= get_post($ptid);
	$datas 			= get_post_meta($ptid); 
	$formats 		= (is_array($datas) && !empty($datas) && array_key_exists('_wp_attachment_metadata', $datas)) ? unserialize($datas['_wp_attachment_metadata'][0]) : false;

	$img_obj = array(
		'ID' 			=> $ptid,
		'id' 			=> $ptid,
		'title' 		=> get_the_title($ptid),//icon-rejoindre
		'filename' 		=> basename($attached_file),//icon-rejoindre.png
		'filesize'  	=> filesize($attached_file),//1804
		'url' 			=> wp_get_attachment_url($ptid),
		'link' 			=> get_permalink($ptid),//http://192.168.0.101/ca_idf/siteweb/homepage/icon-rejoindre/
		'alt' 			=> get_post_meta($ptid, '_wp_attachment_image_alt', TRUE),
		'author' 		=> '',//1
		'description' 	=> $attachment && is_object($attachment) ? $attachment->post_content : false,
		'caption' 		=> wp_get_attachment_caption($ptid),
		'name' 			=> get_the_title($ptid),//icon-rejoindre
		'status' 		=> '',//inherit
		'uploaded_to' 	=> $post_id,//91
		'date' 			=> '',//2020-02-03 09:42:55
		'modified' 		=> '',//2020-02-03 09:42:55
		'menu_order' 	=> '',//0
		'mime_type' 	=> get_post_mime_type($ptid),//image/png
		'type' 			=> '',//image
		'subtype' 		=> '',//png
		'icon' 			=> '',//http://192.168.0.101/ca_idf/siteweb/wp-includes/images/media/default.png
		'width' 		=> $formats && is_array($formats) ? $formats['width'] : '',//101
		'height' 		=> $formats && is_array($formats) ? $formats['height'] : '',//101
		'sizes' 		=> array()
	);

	$sizes = get_intermediate_image_sizes();
	if($sizes && !empty($sizes)) : 
		foreach ( $sizes as $size ) : 
			$datas = wp_get_attachment_image_src( $ptid, $size );
			if($datas && is_array($datas) && !empty($datas)) $img_obj['sizes'][$size] = $datas[0];
		endforeach;
	endif; 

    return $img_obj;
}