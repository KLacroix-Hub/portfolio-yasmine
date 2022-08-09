<?php

add_action('wp_enqueue_scripts', 'wami_theme_enqueue_script');
function wami_theme_enqueue_script(){
	$in_footer = true;
	$theme_dir = get_template_directory_uri();

	/*** Styles ***/
	wp_enqueue_style('theme', get_stylesheet_uri());
	wp_enqueue_style('main', $theme_dir.'/assets/css/main.css');

	/*** Scripts ***/
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', $theme_dir.'/assets/js/jquery.min.js', false, '', $in_footer);

	wp_enqueue_script('wami_main', $theme_dir.'/assets/js/main.js', array('jquery'), '', $in_footer);
	wp_localize_script('wami_main', 'wami_js', array(
		'themeurl' => $theme_dir,
		'ajaxurl'  => admin_url('admin-ajax.php'),
		'siteurl'  => site_url()
	));
}

//add_action('admin_enqueue_scripts', 'wami_admin_enqueue_script');
function wami_admin_enqueue_script(){
	$theme_dir = get_template_directory_uri();

	/*** Styles ***/
	wp_enqueue_style('wami_bo', $theme_dir.'/assets/css/wami_bo.css');

}