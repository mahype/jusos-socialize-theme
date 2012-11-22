<?php

// Stop if WP is not loaded
if( !defined( 'ABSPATH' ) ) exit;

class Jusos_Socialize_Theme{
	
	function jusos_socialize_theme(){
		$this->__construct();
	}
	
	function __construct(){
		$this->constants(); // Setting general Constants
		$this->includes(); // Getting includes
		
		// Scripts for Frontent
		add_action( 'after_setup_theme', array( $this, 'load_textdomain' ) ); // Loading Textdomain
		add_action( 'after_setup_theme', array( $this, 'post_thumbnails' ) ); // Loading Framework
		add_action( 'after_setup_theme', array( $this, 'sidebars' ) ); // Loading Sidebars
		add_action( 'after_setup_theme', array( $this, 'widgets' ) ); // Adding Widgets
		
		add_theme_support( 'post-thumbnails' ); // Adding post Thumbnail support to Theme
		add_action( 'init', array( $this, 'cpt' ) ); // Adding Custom Post Types
		add_action( 'init', array( $this, 'shortcodes' ) ); // Adding Shortcodes
		add_action( 'init', array( $this, 'nav_menus' ) ); // Adding Navigation Menus
		
		add_action( 'upload_mimes', array( $this, 'upload_mimes' ) );
		
		// Front page
		if( !is_admin() ):
			add_action( 'after_setup_theme', array( $this, 'load_framework' ) ); // Loading Framework
			add_action( 'wp_enqueue_scripts', array( $this, 'css' ), 20 );
			add_action( 'wp_enqueue_scripts', array( $this, 'js' ) );
			add_action( 'wp_head',  array( $this, 'js_vars' )); // Setting global JS Vars for Backend	
				
		else:
			// Admin Scripts
			if( 'theme-options' == $_GET['page'] || 'options.php' == basename( $_SERVER['REQUEST_URI'] ) || 'post.php' == array_shift( explode( '?', basename( $_SERVER['REQUEST_URI'] ) ) ) || 'post-new.php' == array_shift( explode( '?', basename( $_SERVER['REQUEST_URI'] ) ) ) )
				add_action( 'after_setup_theme', array( $this, 'admin_load_framework' ) ); // Loading Framework
				
			add_action( 'admin_menu',  array( $this, 'admin_menu' ) ); // Adding admin Menu
			add_action( 'admin_head', array( $this, 'meta_boxes' ) ); // Changing Meta Boxes
			
			// add_action( 'add_meta_boxes', 'add_pp_slider_metabox' );  // Adding Slider Meta Box
			// add_action( 'save_post', 'save_pp_slider_metabox' ); // Adding Slider Save Meta Box
			
			// Just add it if Settings Page is displayed
			if( 'theme-options' == $_GET['page'] ):
				add_action( 'admin_init',  array( $this, 'admin_css' )); // Admin CSS
				add_action( 'admin_init',  array( $this, 'admin_js' )); // Admin JS
			endif;
		endif;
	}
	
	public function admin_menu(){
		add_theme_page( __( 'Theme Options' ), __( 'Theme Options' ) , 'edit_theme_options', 'theme-options', array( $this, 'options_page' ) );
	}
	
	public function nav_menus(){
		register_nav_menu( 'footer', __( 'Footer Menu', 'jusos-socialize-theme' ) );
	}
	
	public function sidebars(){
		$args = array(
			'name'          => sprintf( __( 'Sidebar %d', 'jusos-socialize-theme' ), 1 ),
			'id'            => 'sidebar-1',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget'  => '</li>',
			'before_title'  => '<h2 class="widgettitle">',
			'after_title'   => '</h2>' 
		);
		register_sidebar( $args ); 
	}

	public function widgets(){
		register_widget( 'Jusos_Socialize_Social_Widget' );
	}


	public function cpt(){
		/**
		 * References
		 */
		register_taxonomy( 'pp-reference-categories', array('pp-references'), array(
			'show_in_nav_menus' => FALSE,
		    'hierarchical' => TRUE,
		    'labels' => array(
				'name' => _x( 'Categories', 'taxonomy general name', 'jusos-socialize-theme' ),
			    'singular_name' => _x( 'Category', 'taxonomy singular name', 'jusos-socialize-theme' ),
			    'search_items' =>  __( 'Search Categories', 'jusos-socialize-theme' ),
			    'all_items' => __( 'All Categories', 'jusos-socialize-theme' ),
			    'parent_item' => __( 'Parent Category', 'jusos-socialize-theme' ),
			    'parent_item_colon' => __( 'Parent Category:', 'jusos-socialize-theme' ),
			    'edit_item' => __( 'Edit Category', 'jusos-socialize-theme' ), 
			    'update_item' => __( 'Update Category', 'jusos-socialize-theme' ),
			    'add_new_item' => __( 'Add New Category', 'jusos-socialize-theme' ),
			    'new_item_name' => __( 'New Category', 'jusos-socialize-theme' ),
			    'menu_name' => __( 'Categories', 'jusos-socialize-theme' ),
			),	
		    'show_ui' => TRUE,
		    'query_var' => TRUE,
		    'rewrite' => TRUE,
		    'show_in_nav_menus' => TRUE
		));
		
		register_post_type( 'pp-references',
			array(
				'labels' => array(
					'name' => __( 'References', 'jusos-socialize-theme' ),
					'singular_name' => __( 'Reference', 'jusos-socialize-theme' ),
					'all_items' => __( 'All References', 'jusos-socialize-theme' ),
					'add_new_item' => __( 'Add new Reference', 'jusos-socialize-theme' ),
					'edit_item' => __( 'Edit Reference', 'jusos-socialize-theme' ),
					'new_item' => __( 'Add new Reference', 'jusos-socialize-theme' ),
					'view_item' => __( 'View Reference', 'jusos-socialize-theme' ),
					'search_items' => __( 'Search References', 'jusos-socialize-theme' ),
					'not_found' => __( 'No Reference found', 'jusos-socialize-theme' ),
					'not_found_in_trash' => __( 'No Reference found', 'jusos-socialize-theme' )
				),
				'public' => TRUE,
				'has_archive' => TRUE,
				'supports' => array( 'title', 'editor', 'thumbnail',  'page-attributes' ),
				'taxonomies' => array( 'pp-reference-categories' ),
				'menu_position' => 5,
				'rewrite' => array(
		            'slug' => 'references',
		            'with_front' => FALSE
	            )
					
			)
		);
	}
	
	public function meta_boxes(){
		// Sliders - Removing Featured image box and adding it with new title and position
		// remove_meta_box( 'postimagediv', 'pp_sliders', 'side' );
		// add_meta_box( 'postimagediv', __( 'Slider Image', 'jusos-socialize-theme' ), 'post_thumbnail_meta_box', 'pp_sliders', 'normal', 'high' );
	}

	public function shortcodes(){
		// add_shortcode( 'list_posts', 'rs_list_posts' );
	}
	
	public function post_thumbnails(){
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'header-page', 550, 250, TRUE );
	}
	
	public function options_page(){
		include( JUSOS_SOCIALIZE_THEME_FOLDER . '/core/theme-options.php' ); // Theme options Page file
	}
	
	private function includes(){
		/**
		 * General
		 */
		include( JUSOS_SOCIALIZE_THEME_FOLDER . '/includes/tkf/loader.php' ); // Framework
		
		/**
		 * Widgets
		 */
		include( JUSOS_SOCIALIZE_THEME_FOLDER . '/core/widgets/social.php' ); 
		
		/**
		 * Meta Boxes
		 */
		// include( JUSOS_SOCIALIZE_THEME_FOLDER . '/core/meta-boxes/slider.php' ); // Slider
				
		/**
		 * Shortcodes
		 */
		// include( JUSOS_SOCIALIZE_THEME_FOLDER . '/core/shortcodes/list-posts.php' ); // Slider
	}
	
	public function css(){
		// wp_deregister_style( 'jquery-ui-css' ); // Not  working at the moment
	}
	
	public function js(){
		wp_enqueue_script( 'jquery' );
		
		wp_register_script( 'jst-theme-js', JUSOS_SOCIALIZE_THEME_URLPATH . 'theme.js' ); // General Theme JS
		wp_enqueue_script( 'jst-theme-js' );		
	}
	
	public function js_vars(){
		
	}
	
	public function admin_css(){
		wp_register_style( 'jst-theme-admin-css', JUSOS_SOCIALIZE_THEME_URLPATH . 'core/theme-options.css' );
		wp_enqueue_style( 'jst-theme-admin-css' );	
	}
	
	public function admin_js(){
	}

	public function load_textdomain(){
		load_theme_textdomain( 'jusos-socialize-theme', get_template_directory() . '/languages' );
	}
	
	public function admin_load_framework(){
		/* Not needed yet
		$args['forms'] = array( 'jusos-socialize-theme-config' );
		$args['jqueryui_components'] = array( 'jquery-cookies', 'jquery-fileuploader', 'jquery-ui-tabs', 'jquery-colorpicker' );
		tk_framework( $args );
		*/
	}
	
	public function load_framework(){
		$args['jqueryui_components'] = array( 'jquery-cookies', 'jquery-ui-accordion' );
		tk_framework( $args ); 
	}
	
	private function constants(){
		define( 'JUSOS_SOCIALIZE_THEME_FOLDER', 	$this->get_folder() );
		define( 'JUSOS_SOCIALIZE_THEME_URLPATH', $this->get_url_path() );
	}
	
	public function upload_mimes( $mimes ){
		// Adding filetypes allowed for upload
		// $mimes['psd'] = 'application/x-photoshop';
		return $mimes;
	}
	
	/**
	* Getting URL Path of theme
	*
	* @package WP Zliders
	* @since 0.1.0
	*
	*/
	private function get_url_path(){
		$sub_path = substr( JUSOS_SOCIALIZE_THEME_FOLDER, strlen( ABSPATH ), ( strlen( JUSOS_SOCIALIZE_THEME_FOLDER ) - 11 ) );
		$script_url = get_bloginfo( 'wpurl' ) . '/' . $sub_path;
		return $script_url;
	}
	
	/**
	* Getting URL Path of theme
	*
	* @package WP Zliders
	* @since 0.1.0
	*
	*/
	private function get_folder(){
		$sub_folder = substr( dirname(__FILE__), strlen( ABSPATH ), ( strlen( dirname(__FILE__) ) - strlen( ABSPATH ) - 4 ) );
		$script_folder = ABSPATH . $sub_folder;
		return $script_folder;
	}
}

$jusos_socialize_theme = new Jusos_Socialize_Theme();