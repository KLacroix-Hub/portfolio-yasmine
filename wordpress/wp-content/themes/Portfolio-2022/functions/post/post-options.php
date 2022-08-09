<?php
/* Pour transformer le titre "article" en "actualité" */
// add_action( 'init', 'change_post_object_label' );
// add_action( 'admin_menu', 'change_post_menu_label' );
function change_post_menu_label() {
    global $menu;
    global $submenu;
    //$menu[10][0] = 'Image et Docs';
    $menu[5][0] = 'Actualité';
    $submenu['edit.php'][5][0] = 'Actualités';
    $submenu['edit.php'][10][0] = 'Ajouter une actualité';
    $submenu['edit.php'][15][0] = 'Catégories'; // Change name for categories
    $submenu['edit.php'][16][0] = 'Etiquettes'; // Change name for tags
    echo '';
}
function change_post_object_label() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Actualités';
    $labels->singular_name = 'Actualité';
    $labels->add_new = 'Ajouté une actualité';
    $labels->add_new_item = 'Ajouté une actualité';
    $labels->edit_item = 'Voir les actualités';
    $labels->new_item = 'Actualité';
    $labels->view_item = 'Voir l\'actualité';
    $labels->search_items = 'Rechercher une actulité';
    $labels->not_found = 'Pas d\'actualité trouvée';
    $labels->not_found_in_trash = 'Pas d\'actualité trouvée dans la poubelle';
}



/* Gestion des noms des formats dans l'editeur de text des articles et pages */
// add_filter('tiny_mce_before_init', 'wami_restrict_wysiwyg_tags');
function wami_restrict_wysiwyg_tags($arr){
	$arr['block_formats'] = 'Paragraphe=p; Sous-titre=h2;';
	return $arr;
}


/* Fonctions permettant de géré la forme des extraits de WP */
// add_filter( 'excerpt_length', 'wamitheme_excerpt_length' );
function wamitheme_excerpt_length( $length ) {
    return 42;
}
// add_filter( 'excerpt_more', 'wami_continue_reading' );
function wami_continue_reading() {
    return ' ...<br /><a href="'.get_permalink().'" class="voir_plus suite">'.__('> Lire la suite', 'wami').'</a>';
}


/* Fonction pour retourner un extrait personnalisé */
// via le post_id
function wami_return_extrait($post_id, $longueur=250){
    $post = get_post($post_id);
    $monextrait = strip_tags($post->post_content);
    $monextrait = strip_shortcodes($monextrait);
    if(strlen($monextrait) > $longueur){
        $monextrait = substr($monextrait, 0, $longueur);
        $monextrait = substr($monextrait, 0,  strrpos($monextrait," "))." ...";
    }
    return $monextrait;
}
// via le contenu (à n'utiliser que si celle par ID n'est pas utilisable)
function wami_return_small($contenu, $longueur=250){
    $monextrait = strip_tags($contenu);
    $monextrait = strip_shortcodes($monextrait);
    if(strlen($monextrait) > $longueur){
        $monextrait = substr($monextrait, 0, $longueur);
        $monextrait = substr($monextrait, 0,  strrpos($monextrait," "))." ...";
    }
    return $monextrait;
}


/* Fonction permettant d'afficher des post d'un même type et d'une même taxonomie */
function articles_lies($post_id, $post_type, $type_taxonomy, $tax, $tax_parent, $nb_post_to_display){
	$i = 0;
	$ids_to_exclude = array($post_id);

	if($tax != "") :

		$medias_query = new WP_Query(array(
			'post_type' 	=> $post_type,
			$type_taxonomy	=> $tax,
			'post__not_in'  => $ids_to_exclude,
			'showposts'		=> $nb_post_to_display
			));
			if($medias_query->have_posts()):
				while($medias_query->have_posts()):
					$medias_query->the_post();	$i++;
						$ids_to_exclude[] = get_the_id();
						get_template_part('loop', 'postconnect');
				endwhile;
			endif; wp_reset_postdata();

	; elseif($tax_parent != "" && $i<4) :

		$nb_post_to_display =$nb_post_to_display - $i;
		$medias_query = new WP_Query(array(
		'post_type' 	=> $post_type,
		$type_taxonomy	=> $tax_parent,
		'post__not_in'  => $ids_to_exclude,
		'showposts'		=> $nb_post_to_display
		));
		if($medias_query->have_posts()):
			while($medias_query->have_posts()):
				$medias_query->the_post();	$i++;
					get_template_part('loop', 'postconnect');
			endwhile;
		endif; wp_reset_postdata();

	endif;
}
