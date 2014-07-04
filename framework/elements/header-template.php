<?php if (!function_exists( 'cr_header_templates' ) ) {
	function cr_header_templates(){ ?>
		<header id="masthead" class="site-header container_12" role="banner">
			<div id="top-header">
				<div id="header-left-panel" class="grid_6"><?php do_action( 'cr_header_left_panel' );?></div>
				<div id="header-right-panel" class="grid_6"><?php do_action( 'cr_header_right_panel' );?></div>
			</div>
			<div class="grid_3">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'description' ); ?>"><img class="site-title" src="<?php echo CR_THEME_IMG_URL; ?>logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
			</div>
			<div class="grid_9">
				<nav id="site-navigation" class="main-navigation" role="navigation">
					<?php // wp_nav_menu( array( 'theme_location' => '','container' => '' ) ); 
						   /**
							* Displays a navigation menu
							* @param array $args Arguments
							*/
							$args = array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_id' => 'cr_main_menu',
							);
						
							wp_nav_menu( $args );
					?>
				</nav><!-- #site-navigation -->
		</div>
		</header>
	<?php }

	add_action( 'cr_header_main', 'cr_header_templates' );
}