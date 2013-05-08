<?php get_header(); ?>

			<div id="content" role="main" class="clear home-content">
				
				<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/jusos-gerecht-titelbild.jpg" />
				
				<?php while ( have_posts() ) : the_post(); // loop entries ?>
					
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<div id="icon-page">&nbsp;</div>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
					
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					
				</article>
				
				<?php comments_template(); ?>
				
				<?php endwhile; // end of the loop. ?>
				
			</div>
			
			<?php get_sidebar(); ?>

<?php get_footer(); ?>