      
    </main>
    
    <footer id="footer" class="footer">
        <div class="footer-information">
            <a href="<?php bloginfo("url") ?>"><img src="<?php echo get_template_directory_uri();?>/assets/img/logo.png" alt="Logo Yasmine khattabi"></a>
            <div class="footer-information__contact">
            Yasmine Khattabi
            <?php wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container'      => 'nav',
                )); 
            ?>
            </div> 
        </div>
        <div class="footer-social">
                <h1 class="footer-social__title">Retrouvez moi sur mes réseaux :</h1>
                <div class="footer-social__link">
                    <a target="_blank"href="https://www.linkedin.com/in/yasmine-khattabi-b9939a199/">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a target="_blank"href="https://www.instagram.com/yasmine_ktb/">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
