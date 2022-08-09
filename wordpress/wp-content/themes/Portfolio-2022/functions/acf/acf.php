<?php
/* Créer une page d'options ACF */
if( function_exists('acf_add_options_page') ) {	
	acf_add_options_page(array(
        'page_title'    => 'Options du site',
        'menu_title'    => 'Options du site',
        'menu_slug'     => 'theme-options',
        'capability'    => 'edit_posts',
        'redirect'      => true,
        'position'      => 2,
        'icon_url'      => 'dashicons-star-filled'
    ));
	// Créer une sous-page d'options ACF
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Menus',
		'menu_title'	=> 'Menus',
		'parent_slug'	=> 'theme-options',
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Généralités',
		'menu_title'	=> 'Généralités',
		'parent_slug'	=> 'theme-options',
	));
	// acf_add_options_sub_page(array(
	// 	'page_title' 	=> 'Sidebar',
	// 	'menu_title'	=> 'Sidebar',
	// 	'parent_slug'	=> 'theme-options',
	// ));
}

function my_acf_init() {
	acf_update_setting('google_api_key', 'AIzaSyBPb_X9XMtjwp534rqPG5ii5q88o9Z7kk4');
}

add_action('acf/init', 'my_acf_init');

/* On associe un champs ACF par sa clé à l'image à la une */
// add_action('acf/save_post', 'kodex_acf_save_post_thumbnail', 1);
// add_action('acf/save_post', 'kodex_acf_save_post_thumbnail', 20);
function kodex_acf_save_post_thumbnail($post_id){
	$post = get_post($post_id);

	// tableau associatif post_type => Clé du champs ACF
	$images = array(
		'post'      => 'field_56372905c6183',
	);

	if(!array_key_exists($post->post_type, $images)) return;
	
	if( isset($_POST['fields']) && !empty($_POST['fields']) ){
		$fields = $_POST['fields'];	// ACF 4
	}elseif( isset($_POST['acf']) && !empty($_POST['acf']) ){
		$fields = $_POST['acf'];	// ACF Pro 5
	}else{
		return;
	}

	//on met le champs image en image à la une
	$acf_key = $images[$post->post_type];
	$illu_id = $fields[$acf_key];

	if($illu_id && !empty($illu_id) && is_numeric($illu_id)){
		set_post_thumbnail($post_id, $illu_id);
	}
}



function wami_bien_save_post($post_id) {

	die($post_id.'plop');

	$user = wp_get_current_user();
	
	/*if( get_field('field_597872816a779',  $post_id) )
		$title = get_field('field_597872816a779',  $post_id);*/
	
	$bien = array(
		'ID'         	=> $post_id,
		'post_title' 	=> 'test fonction',//$_POST['acf']['field_597872816a779'],
		//'post_content'	=> $_POST['acf']['field_597872b76a77a'],
		'author'     	=> $user->ID,
	);

	//if(post('action_pending')) $bien['post_status'] = 'pending';

	//update_field('bien_agent', $user->ID, $post_id);
	//update_field('bien_ref', strtoupper('P' . $post_id), $post_id);
	//update_field('is_bien_front', true, $post_id);
	
	/** latlng => retrouver la ville */
	/*if(isset($_POST['acf']['field_56e17a7124cd6'])){
		$address = $_POST['acf']['field_56e17a7124cd6']['address'];
		$geocode = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&key=AIzaSyBAJvniglIbexoXNEuq3hOGfukVBWaEOkM&sensor=false');			
    	$output  = json_decode($geocode);			
		$address_components = $output->results[0];
		$ville = $address_components->address_components[2];
		$zip = $address_components->address_components[6];
		$ville_post = get_page_by_title($ville->long_name, OBJECT, 'ville');
		$ville_id = null;
		// Si la ville n'éxiste pas là créer
		if(empty($ville_post)){				
			$the_ville = array(
				'post_title'   => $ville->long_name,
				'post_content' => '',
				'post_status'  => 'publish',
				'post_author'  => 1,
				'post_type'    => 'ville'
			);				 
			$ville_id = wp_insert_post($the_ville);
			update_field('field_5693ae8e96331', $zip->long_name, $ville_id);
		}else{
			$ville_id = $ville_post->ID;
		}
		update_field('field_56684ccbadea8', $ville_id, $post_id);
	}*/

	//if(get_post_status($post_id) == 'publish') $bien['post_status'] = 'draft';

  	wp_update_post($bien);
	
	wp_redirect(home_url('tableau-de-bord/ajouter-annonce/' . $post_id));
	//wp_redirect(home_url('mon-espace/vendeur'));
	return $post_id;
}


function get_terms_order_by_acf($tax, $args, $field){
	$terms = get_terms( $tax, $args );
	$new_t = array();
	foreach ($terms as $t):
    	$sort_order = get_field($field, $tax.'_'.$t->term_id);
   	 	$new_t[$sort_order] = $t;
   	endforeach; 
	ksort($new_t);
	return $new_t;
}