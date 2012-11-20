<?php get_header(); ?>

			<div id="content" role="main" class="clear">
				
				<?php while ( have_posts() ) : the_post(); // loop entries ?>
				
				
				<?php endwhile; // end of the loop. ?>
				
			</div>
			
			<?php get_sidebar(); ?>

<?php get_footer(); ?>