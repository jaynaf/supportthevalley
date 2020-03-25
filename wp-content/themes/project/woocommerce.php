<?php get_header(); ?>
    <section class="home-buy">
	    <div class="wrapper">
	        <div class="content-box">
	
				<div class="content-wrapper">
					<?php woocommerce_content(); ?>
				</div>
				<div id="cart">
				<?php
				    if (! function_exists ( 'dynamic_sidebar' ) || ! dynamic_sidebar ( 'Widget Area 1' )) :
				
				endif;?>
				</div>
	        </div>
	    </div>
    </section>

    
<?php get_footer(); ?>