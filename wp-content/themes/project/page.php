<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="wrapper medium-wrapper">
        <div class="content-box">
			<div class="content-wrapper">
				<?php the_content(); ?>
			</div>

        </div>
    </div>
    <?php endwhile; endif; ?>
    
<?php get_footer(); ?>