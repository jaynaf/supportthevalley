<?php get_header(); ?>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="wrapper">
			<div class="content-box">
				<?php the_content(); ?>
				
			</div>
		</div>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>