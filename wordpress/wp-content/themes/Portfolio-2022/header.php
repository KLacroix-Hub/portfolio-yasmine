<?php get_template_part('components/header/part', 'head'); ?>

    <header id="header" class="header" >
        <div class="header__wrap">

            <a class="header__wrap__logo" href="<?php bloginfo('url'); ?>">
                <img src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" alt="">
            </a>

            <?php wp_nav_menu(array(
    			'theme_location' => 'header',
    			'container'      => 'nav',
            )); ?> 

        </div>   
    </header>

    <main id="main" class="main">
        