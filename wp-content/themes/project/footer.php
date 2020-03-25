
    </main>
    </div>
    <footer>
		<?php if (get_field('information', 9)) : ?>
			<div class="wrapper">
				<div class="content-box">
					<div class="content">
						<?php the_field('information', 9); ?>
					</div>
				</div>
			</div>
	    <?php endif; ?>
    </footer>
    
    <?php wp_footer(); ?>
</body>
</html>