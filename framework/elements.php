<?php 
if ( !function_exists( cr_top_panel ) ) {
	function cr_top_panel() {
	global $smof_data; ?>
		<div id="cr-top-panel">
			<?php do_action( 'cr_top_panel_content' ); ?>
		</div>
		<p class="cr-slide-label">
			<a class="cr-btn-slide fa fa-caret-down" href="#"></a>
		</p>
	<?php }
	
	if( $smof_data['top_widgets_panel'] )
		add_action( 'cr_top_head','cr_top_panel' );
}

/* кнопка наверх */

if ( !function_exists( cr_scroll_top_button ) ) {
	function cr_scroll_top_button() { 
		global $smof_data; ?>
		<a class="scrollTop fa fa-chevron-up fa-4x" href="#" style="z-index: 9999; position: fixed; bottom: 0; right:0;"></a>
	<?php }

	if( $smof_data['scroll_top_button'] )
		add_action( 'cr_bottom_footer','cr_scroll_top_button' );
}

if ( !function_exists( 'cr_contacts' ) ) {
	function cr_contacts() { ?>
		<i class="fa fa-fax fa-1_3x"></i>
		<i class="fa fa-map-marker fa-1_3x"></i>
		<i class="fa fa-mobile fa-1_3x"></i>
		<i class="fa fa-phone fa-1_3x"></i>
		<i class="fa fa-envelope-o fa-1_3x"></i>
		<i class="fa fa-user fa-1_3x"></i>
	<?php }	
}

/* социальные иконки */

if ( !function_exists( 'cr_social_icon' ) ) {
	function cr_social_icon() { 
		global $smof_data;
		$social_array = array(
			'facebook'=>'facebook',
			'twitter'=>'twitter',
			'vk'=>'vk',
			'flickr'=>'flickr',
			'instagram'=>'instagram',
			'pinterest'=>'pinterest',
			'dribbble'=>'dribbble',
			'youtube'=>'youtube',
			'vimeo'=>'vimeo-square',
			'google'=>'google-plus',
			'soundcloud'=>'soundcloud',
			'deviantart'=>'deviantart',
			'linkedin'=>'linkedin',
			'tumblr'=>'tumblr',
			'steam'=>'steam',
			'github'=>'github',
			'behance'=>'behance',
			'digg'=>'digg',
			'reddit'=>'reddit',
			);
		$n=0;
		foreach ($social_array as $key => $value) {
			$slide_speed = ( $n%2 === 0 ) ? 'speed-1500' : 'speed-1000';
			if( $smof_data[$key .'_link'] && $smof_data[ $key .'_on_follow'] ) { ?> 
			<a class="slide-bottom <?php echo $slide_speed; ?>" href="<?php echo $smof_data[ $key .'_link']; ?>" title="deviantart"><i class="fa fa-<?php echo $value; ?> fa-1_3x"></i></a>
		<?php $n++;
			}
		 
		 } ?>
		
	<?php }	
}

add_action( 'cr_header_left_panel','cr_social_icon' );
add_action( 'cr_header_right_panel','cr_contacts' );

/* блок поделиться */
if ( !function_exists( 'cr_share_box' ) ) {
	function cr_share_box() {	
		global $smof_data;
		global $post;
		$link = get_permalink( $post->ID );
		$title = get_the_title( $post->ID );
		$desc = get_the_excerpt( $post->ID );
		$img = get_cr_post_thumb_url( $post->ID );

		$social_share_array = array(
			'facebook' => htmlentities('http://www.facebook.com/sharer.php?m2w&s=100&p&#91;url&#93;=' . urlencode( $link ) . '&p&#91;title&#93;=' . urlencode( $title ) ),
			'twitter' => htmlentities('http://twitter.com/home?status=' . urlencode( $title ) . '- ' . urlencode( $link ) ),
			'vk' => htmlentities('http://vkontakte.ru/share.php?url=' . urlencode( $link ) ),
			'google' => htmlentities('https://plus.google.com/share?url=' . urlencode( $link ) ),
			'pinterest' => htmlentities('http://pinterest.com/pin/create/button/?url=' . urlencode( $link ) . '&amp;description=' . urlencode( $title ) . '&amp;media=' . urlencode( $img ) ),
			'linkedin' => htmlentities('http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode( $link ) . '&amp;title=' . urlencode( $title ) ),
			'reddit' => htmlentities('http://reddit.com/submit?url=' . urlencode( $link ) . '&amp;title=' . urlencode( $title ) ),
			'tumblr' => htmlentities('http://www.tumblr.com/share/link?url=' . urlencode( $link ) . '&amp;name=' . urlencode( $title ) .'&amp;description=' . urlencode( $desc ) ),
			'envelope' => htmlentities("mailto:?subject=" . urlencode( $title ) . "&body=" . urlencode( $link ) .""),
		);	

		$n=0;
		foreach ($social_share_array as $key => $value) {
			$slide_speed = ( $n%2 === 0 ) ? 'speed-1500' : 'speed-1000';
			if( $smof_data[ $key .'_on_share'] ) { 
				$preff = ($key == 'google') ? '-plus' : '';  ?>
				<a class="slide-bottom <?php echo $slide_speed; ?>" href="<?php echo htmlspecialchars( $value ); ?>" title="deviantart"><i class="fa fa-<?php echo $key . $preff; ?> fa-1_3x"></i></a>
		<?php $n++;
			}
		}
	}

	add_action( 'cr_after_post','cr_share_box' );
}


// Register widgetized locations
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => __('Левая область виджетов','wp_panda'),
		'id' => 'cr-left-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s grid_3">',
		'after_widget' => '</div>',
		'before_title' => '<div class="heading"><h3>',
		'after_title' => '</h3></div>',
	));

	register_sidebar(array(
		'name' => __('Правая область виджетов','wp_panda'),
		'id' => 'cr-right-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s grid_3">',
		'after_widget' => '</div>',
		'before_title' => '<div class="heading"><h3>',
		'after_title' => '</h3></div>',
	));

	register_sidebar(array(
		'name' => __('Левая область виджетов футера','wp_panda'),
		'id' => 'cr-left-footer-sidebar',
		'before_widget' => '<div id="%1$s" class="slide-left footer-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Левая центральная область виджетов футера','wp_panda'),
		'id' => 'cr-left-center-footer-sidebar',
		'before_widget' => '<div id="%1$s" class="slide-bottom footer-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Правая центральная область виджетов футера','wp_panda'),
		'id' => 'cr-right-center-footer-sidebar',
		'before_widget' => '<div id="%1$s" class="slide-bottom footer-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Правая область виджетов футера','wp_panda'),
		'id' => 'cr-right-footer-sidebar',
		'before_widget' => '<div id="%1$s" class="slide-right footer-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Левая область виджетов верхней панели','wp_panda'),
		'id' => 'cr-left-top-sidebar',
		'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Левая центральная область виджетов верхней панели','wp_panda'),
		'id' => 'cr-left-center-top-sidebar',
		'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Правая центральная область виджетов верхней панели','wp_panda'),
		'id' => 'cr-right-center-top-sidebar',
		'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => __('Правая область виджетов верхней панели','wp_panda'),
		'id' => 'cr-right-top-sidebar',
		'before_widget' => '<div id="%1$s" class="slidingbar-widget-col %2$s grid_3">',
		'after_widget' => '<div style="clear:both;"></div></div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

/* виджеты верхней панели */
if ( !function_exists( 'top_panel_sidebars' ) ) {
	function top_panel_sidebars(){
		global $smof_data; 
		echo '<div class="widget-area-top-panel">';
			echo '<div class="container_12" role="complementary">';
			if ( is_active_sidebar( 'cr-left-top-sidebar' ) ) 
				dynamic_sidebar( 'cr-left-top-sidebar' ); 
			if ( is_active_sidebar( 'cr-left-center-top-sidebar' ) ) 
				dynamic_sidebar( 'cr-left-center-top-sidebar' ); 
			if ( is_active_sidebar( 'cr-right-center-top-sidebar' ) ) 
				dynamic_sidebar( 'cr-right-center-top-sidebar' ); 
			if ( is_active_sidebar( 'cr-right-top-sidebar' ) ) 
				dynamic_sidebar( 'cr-right-top-sidebar' );
			echo '</div>';
		echo '</div>';  
	}
	if( $smof_data['top_widgets_panel'] && $smof_data['show_widgets_top_panel'] )
		add_action('cr_top_panel_content','top_panel_sidebars');
}

/* произвольный контент в верхней всплывабщей панели */

if ( !function_exists( 'top_panel_text' ) ) {
	function top_panel_text(){
		global $smof_data; 
		echo '<div class="widget-area-top-panel">';
			echo '<div class="container_12" role="complementary">';
				echo '<div class="grid_12">';
					if( $smof_data['show_top_text_panel'] ) echo $smof_data['show_top_text_panel'];
				echo '</div>';
			echo '</div>';
		echo '</div>';  
	}

	if( $smof_data['top_widgets_panel'] && $smof_data['show_top_text_panel'] )
		add_action('cr_top_panel_content','top_panel_text');
}

/* виджеты футера */

if ( !function_exists( 'footer_panel_sidebars' ) ) {
	function footer_panel_sidebars() {
		global $smof_data; 
		echo '<div class="widget-area-footer">';
			echo '<div class="container_12" role="complementary">';
			if ( is_active_sidebar( 'cr-left-footer-sidebar' ) ) 
				dynamic_sidebar( 'cr-left-footer-sidebar' ); 
			if ( is_active_sidebar( 'cr-left-center-footer-sidebar' ) ) 
				dynamic_sidebar( 'cr-left-center-footer-sidebar' ); 
			if ( is_active_sidebar( 'cr-right-center-footer-sidebar' ) ) 
				dynamic_sidebar( 'cr-right-center-footer-sidebar' ); 
			if ( is_active_sidebar( 'cr-right-footer-sidebar' ) ) 
				dynamic_sidebar( 'cr-right-footer-sidebar' );
			echo '</div>';
		echo '</div>';  
	}

	if( $smof_data['footer_widgets_panel'] && $smof_data['show_widgets_footer_panel'] )
		add_action( 'cr_widgets_footer','footer_panel_sidebars' );
}

/* произвольный текст в футере */

if ( !function_exists( 'footer_panel_text' ) ) {
	function footer_panel_text(){
		global $smof_data; 
		echo '<div class="widget-area-footer-panel">';
			echo '<div class="container_12" role="complementary">';
				echo '<div class="grid_12">';
					if( $smof_data['show_footer_text_panel'] ) echo $smof_data['show_footer_text_panel'];
				echo '</div>';
			echo '</div>';
		echo '</div>';  
	}

	if( $smof_data['footer_widgets_panel'] && $smof_data['show_footer_text_panel'] )
		add_action('cr_widgets_footer','footer_panel_text');
}



if ( !function_exists('cr_footer_copyright') ){
	function cr_footer_copyright() {
		global $smof_data;
		if ( $smof_data['show_footer_copyright_panel'] ) {
			echo $smof_data['show_footer_copyright_panel'];
		} else { ?>
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'blorium2' ) ); ?>"><?php printf( __( '<i class="fa fa-wordpress"></i> Сайт работает на %s', 'blorium2' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Тема: %1$s авторства %2$s.', 'blorium2' ), 'blorium2', '<a href="http://wordpress-creative.com/" title="">Creative World</a>' ); ?>
			</div><!-- .site-info -->
		<?php }
	}

	if( $smof_data['footer_copyright_panel'] )
		add_action( 'cr_copyright_footer','cr_footer_copyright' );
}