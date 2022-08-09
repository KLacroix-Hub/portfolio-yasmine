<?php
add_action('wp_ajax_wami_loadmore_and_filter', 'wami_loadmore_and_filter');
add_action('wp_ajax_nopriv_wami_loadmore_and_filter', 'wami_loadmore_and_filter');
function wami_loadmore_and_filter(){
    if ($_REQUEST) :
        
        global $post;        
        $response = '';
        $pid                  = $_REQUEST['pid'];
        $nb_post_to_display   = $_REQUEST['nb_post_to_display'];   
        $exclude              = explode(',', $_REQUEST['exclude_post']); 

        $args = array(
            'post_type'     => 'post',
            'post_status'   => 'publish',   
            'posts_per_page' => $nb_post_to_display,
            'post__not_in'   => $exclude,
        ); 
        $myquery = new WP_Query($args); 

        if($myquery->have_posts()): 
            while($myquery->have_posts()):
                $myquery->the_post(); 
                $exclude[] = $post->ID; 
                $response .= load_template_part('template-parts/loop', 'bloc');                                             
            endwhile; 
            wp_reset_postdata();       
        endif;  

        echo json_encode(array(
            'content'           => $response,
            'nb_post_displayed' => count($exclude),
            'auteur'            => $pid,
            'post_to_exclude'   => implode(',', $exclude),
        ));     

    endif;
    die(); 
}