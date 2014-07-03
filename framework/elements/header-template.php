<?php if (!function_exists( 'cr_header_templates' ) ) {
	function cr_header_templates(){ ?>
		<header id="masthead" class="site-header" role="banner">
			<div id="top-header">
				<div id="header-left-panel"><?php do_action( 'cr_header_left_panel' );?></div>
				<div id="header-right-panel"><?php do_action( 'cr_header_right_panel' );?></div>
			</div>
			<div class="site-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="site-title" src="<?php echo CR_THEME_IMG_URL; ?>logo.png" alt="<?php bloginfo( 'name' ); ?>"></a>
				<!--h2 class="site-description"><?php /*bloginfo( 'description' ); */?></h2-->
			</div>

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
		</header>
	<?php }

	add_action( 'cr_header_main', 'cr_header_templates' );
}