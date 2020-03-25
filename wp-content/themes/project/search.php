<?php get_header(); ?>
     
    <div class="entry main-column page-<?php the_ID(); ?>"> 
    
        <h2>Search Results</h2>
            
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                            
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - <?php the_date('F jS, Y'); ?></a></h3>
                            <?php the_excerpt(); ?>                                  
                                    
                        <?php endwhile; endif; ?>
            
            <?php include (TEMPLATEPATH . '/inc/nav.php' ); ?> 
                                
    </div><!-- .main-column -->
    
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>

