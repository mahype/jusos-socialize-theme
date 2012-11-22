<?php
/**
 * Jusos Socialize Theme Header
 *
 * @package WordPress
 * @subpackage Free
 * @since 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php

	global $page, $paged;

	wp_title( '|', true, 'right' );

	bloginfo( 'name' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'pp-theme' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php /* General CSS */ ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php /* Tablet CSS */ ?>
<link rel="stylesheet" type="text/css" media="only screen and (min-device-width:768px) and (max-device-width:1024px)" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-tablet.css" />
<?php /* Mobile CSS */ ?>
<link rel="stylesheet" type="text/css" media="only screen and (max-device-width:720px)" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-mobile.css" />
<link href='http://fonts.googleapis.com/css?family=Average+Sans|Open+Sans:700,400,800,400italic' rel='stylesheet' type='text/css'>
<?php 

?>
<style type="text/css">
<!--
/*
 * Skeleton
 */
body{
}
</style>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php

	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
	
?>

</head>

<body <?php body_class(); ?>>
	<div id="page">
		<div id="wrapper">
			<header id="branding" role="banner">
				<h1 id="blog_name"><?php bloginfo( 'name' ); ?></h1>
				<hgroup>
					<a href="<?php bloginfo( 'wpurl' ); ?>" title="<?php bloginfo( 'name' ); ?>"><h1 id="logo"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/jusos-logo-117x48.png" alt="<?php bloginfo( 'name' ); ?>" /></h1></a>
				</hgroup>
			</header>