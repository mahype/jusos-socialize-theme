<?php get_header(); ?>

			<div id="content" role="main" class="clear home-content">
				
				<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/header-content-start.jpg" />
				
				<article id="facebook-fanpage-stream" >
					<header class="entry-header">
						<div id="icon-page">&nbsp;</div>
						<h1 class="entry-title"><?php _e( 'Facebook Page', 'jusos-socialize-theme' ); ?></h1>
					</header>
					
					<div class="entry-content">
						<div class="fb-like-box" data-href="https://www.facebook.com/JusosHilden" data-width="500" data-height="1000" data-show-faces="false" data-border-color="#FFF" data-stream="true" data-header="false"></div>
					</div>
					
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
					  var js, fjs = d.getElementsByTagName(s)[0];
					  if (d.getElementById(id)) return;
					  js = d.createElement(s); js.id = id;
					  js.src = "//connect.facebook.net/de_DE/all.js#xfbml=1&appId=112837072138028";
					  fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
				</article>
				
			</div>
			
			<?php get_sidebar(); ?>

<?php get_footer(); ?>