<?php get_header(); ?>
	
	<?php while(have_posts()): ?>
		<div class="main-homepage g-24">
			<div class="main-homepage__toshop">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/img/home/yasmine-home.png" alt="">
			</div>
			<div class="main-homepage__glassmorph">
				<div class="main-homepage__glassmorph-presentation">
					<div class="wrap-presentation">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
			
		</div>
	
		<?php the_post(); ?>
		

	<?php endwhile; ?>

<?php get_footer(); ?>