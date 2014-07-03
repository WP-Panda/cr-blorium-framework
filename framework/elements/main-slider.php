<?php if ( !function_exists( 'cr_DrSlider' ) ) { 
	function cr_DrSlider() {
		global $smof_data;
		 $slides =  $smof_data['pingu_slider'];
		 $out=''; 
		 if( $slides ) {
			$out .='<div class="example-progressbar">';
		 	foreach ($slides as $slide) {
		 		$url = $slide['url'];
		 		$title = $slide['title'] ? $slide['title'] : '';
		 		if( $slide['link'] ) {
		 			$out .='<a data-lazy-background="' . $url .'" href="' . $slide['link'] . '" title="' . $title . '">';
		 		} else {
		 			$out .='<div data-lazy-background="' . $url .'">';
		 		}
		 		if( $slide['title'] )
		 			$title_pos ="['5%', '110%', '5%', '5%']";
		 			$out .='<span class="slide-title" data-pos="' . $title_pos . '" data-duration="700" data-effect="move">' . $title . '</span>';
		 		if( $slide['description'] )
		 			$title_pos ="['20%', '-120%', '20%', '15%']";
		 			$out .='<span class="slide-description" data-pos="' . $title_pos . '" data-duration="700" data-effect="move">' . $slide['description'] . '</span>';
	          	if( $slide['link'] ) {
		 			$out .='</a>';
		 		} else {
		 			$out .='</div>';
		 		}
			}
			$out .='</div>';
	  	}

	  	echo $out;
	}

	//add_action( 'cr_main_slider' , 'cr_DrSlider' );
}

/* последние записи */

if ( !function_exists( 'cr_releted_posts' ) ) {
	function cr_releted_posts() {

		/**
		 * The WordPress Query class.
		 * @link http://codex.wordpress.org/Function_Reference/WP_Query
		 *
		 */

		$args = array(	
			'post_status' => 'publish',
			'order'               => 'DESC',
			'orderby'             => 'title',
			'ignore_sticky_posts' => true,
			'posts_per_page'         => 10,	
		);
	
		$query = new WP_Query( $args );
		return $query;

	}
}

/* слайдер постов */

if ( !function_exists( 'cr_post_main_slider' ) ) {
	function cr_post_main_slider() {
		global $post;
		$query = cr_releted_posts();
		$out=''; 
		if ( have_posts() ) : 
			$out .='<div class="example-progressbar">';
		 	while ( have_posts() ) : the_post();
		 		$url = get_cr_bfi_thumb_url( $post->ID,1920,550,true );
		 		$url = bfi_thumb( $url, array('grayscale' => true,'color' => '#ff0000')  );
		 			$out .='<a data-lazy-background="' . $url .'" href="' . get_permalink() . '" title="' . get_the_title() . '">';
		 			$title_pos ="['5%', '110%', '5%', '5%']";
		 			$out .='<span class="slide-title" data-pos="' . $title_pos . '" data-duration="700" data-effect="move">' . get_the_title() . '</span>';
		 			$title_pos ="['20%', '-120%', '20%', '5%']";
		 			$content = get_the_excerpt();
					$content = wp_trim_words( $content, 50, '...' );
		 			$out .='<span class="slide-description" data-pos="' . $title_pos . '" data-duration="800" data-effect="move">' . $content . '</span>';
		 			$url = get_cr_bfi_thumb_url( $post->ID,500, '' ,true );
		 			$title_pos ="['10%', '180%', '10%', '60%']";
		 			$out .='<img data-pos="' . $title_pos . '" data-duration="900" data-effect="move" src="' . $url . '" alt="">';
		 			$out .='</a>';
		 	endwhile; 
			$out .='</div>';
	  	endif;

	  	echo $out;

	}

	add_action( 'cr_main_slider' , 'cr_post_main_slider' );
}