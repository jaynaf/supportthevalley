<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <div class="wrapper">
        <div class="content-box">
			<div class="content-wrapper">
				<?php if (!is_wc_endpoint_url() && is_checkout()) : ?>
					<h1>Checkout</h1>
				<?php else : ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>
				<?php the_content(); ?>
			</div>

        </div>
    </div>
    <?php endwhile; endif; ?>
    
<?php get_footer(); ?>