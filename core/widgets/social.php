<?php
/**
 * Adds Foo_Widget widget.
 */
class Jusos_Socialize_Social_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'jusos_socialize_social_widget', // Base ID
			__( 'Social Widget', 'jusos-socialize-theme' ), // Name
			array( 'description' => __( 'Add Social share Buttons for Facebook, Google+ and Twitter', 'jusos-socialize-theme' ), )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $wp_slider_widget;
		
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		
		$url = get_bloginfo('wpurl') . $_SERVER['REQUEST_URI']; 
		$url_encoded = urlencode( $url ); 
		
		?>
		<div class="social-bottons">
			
			<!-- Facebook //-->
			<div class="social-button">
				<iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $url_encoded; ?>&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=recommend&amp;colorscheme=light&amp;font=arial&amp;height=21&amp;appId=222384077820870" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
			</div>
			
			<!-- Twitter //-->
			<div class="social-button">
				<a href="https://twitter.com/share" class="twitter-share-button" data-lang="de">Twittern</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			</div>
			
			<!-- Google + //-->
			<div class="social-button">
				<div class="g-plusone" data-size="medium"></div>
			
				<script type="text/javascript">
				  window.___gcfg = {lang: 'de'};
				
				  (function() {
				    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				    po.src = 'https://apis.google.com/js/plusone.js';
				    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
			</div>
		
		</div>
		<?
		echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ):
			$title = $instance[ 'title' ];
		else:
			$title = __( 'Slider title', 'jusos-socialize-theme' );
		endif;
		
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Social title:', 'jusos-socialize-theme' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
		
	}

} // class Foo_Widget