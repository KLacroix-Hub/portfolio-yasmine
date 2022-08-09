<?php

/* Fonction de débug (à utiliser à la place du var_dump/print_r) */
if(!function_exists('debug')){
	function debug($var, $info=''){
		echo '<div style="padding:5px 10px; margin-bottom:8px; font-size:13px; background:#FACFD3; color:#8E0E12; line-height:16px; border:1px solid #8E0E12; text-transform:none; overflow:auto;">';
		if( !empty($info) ){
		    echo '<h3 style="color:#8E0E12; font-size:16px; padding:5px 0;">'.$info.'</h3>';
		}
		echo '<pre style="white-space:pre-wrap;">'.print_r($var,true).'</pre>
		</div>';
	}
}


/* On retire les accents sur les fichiers uploadés */
add_filter('sanitize_file_name', 'remove_accents');


function load_template_part($template_name, $part_name=null) {
    ob_start();
    get_template_part($template_name, $part_name);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}


function check_email_form($email){
	//if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) { 
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
	  return 1; 
	} 
	else { 
	  return 0; 
	} 
}


function email_as_string($email){
    list($text) = explode('@', $email);
    $text = preg_replace('/[^a-z0-9]/i', ' ', $text);
    $text = ucwords($text);
    return $text;
}
