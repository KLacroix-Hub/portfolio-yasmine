<?php

/* Déclaration des menus du thème */
add_action('init', 'wami_theme_menu');
function wami_theme_menu(){
	register_nav_menu('header', 'Menu header');
	register_nav_menu('footer', 'Menu footer');
}