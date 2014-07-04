<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package blorium2
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php  do_action( 'cr_top_head' ); ?>
<div id="page" class="hfeed site">
	<!--a class="skip-link screen-reader-text" href="#content"><?php //_e( 'Skip to content', 'blorium2' ); ?></a-->
<? //global $smof_data; print_r($smof_data) ;?>
	<?php do_action( 'cr_header_main'); ?>
	<?php do_action( 'cr_main_slider' ); ?>
	<div id="content" class="site-content">
		<div class="container container_12">