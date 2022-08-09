<?php

/* On inclue tous les fichiers du répertoire functions */
$functions_directory = get_template_directory().'/functions';
if( is_dir($functions_directory) ){
	$dossiers = array_diff(scandir($functions_directory), array('..', '.'));
	if(!empty($dossiers)) :
		foreach($dossiers as $d) : 
			$d_name = $functions_directory.'/'.$d;
			$dossier = opendir($d_name);
			while($fichier = readdir($dossier)){
				if(is_file($d_name.'/'.$fichier) && $fichier !='/' && $fichier !='.' && $fichier != '..'){
					require_once($d_name.'/'.$fichier);
				}
			}
			closedir($dossier);			
		endforeach;
	endif;
}