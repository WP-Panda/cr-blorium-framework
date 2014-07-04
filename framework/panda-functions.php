<?php 
/*  отключение стилей по учолчанию для плеера */
    // remove WordPress css file
   function remove_mediaelement_styles() {

        wp_dequeue_style('wp-mediaelement');
        wp_deregister_style('wp-mediaelement');
        
    }
    add_action( 'wp_print_styles', 'remove_mediaelement_styles' );


/* get the post thumbnail url */
if( !function_exists( 'get_cr_post_thumb_url' ) ) :
	function get_cr_post_thumb_url($id) {
		global $post;
		$thumb_id = get_post_thumbnail_id($id);
		$thumb_url = wp_get_attachment_image_src($thumb_id, 'full');
		$url = $thumb_url[0];
		return $url;
	}
endif;

/* get the bfi crop img */
if( !function_exists( 'get_cr_bfi_thumb_url' ) ) :
	function get_cr_bfi_thumb_url( $id,$w,$h,$crop ) {
		$thumb = get_cr_post_thumb_url( $id );
		$params = array( 'width' => $w, 'height' => $h, 'crop'=>$crop );
		$img_url = bfi_thumb( $thumb, $params );
		return $img_url;
	}
endif;

/* post_format_icon */
if( !function_exists( 'cr_post_format_icon' ) ) :	
	function cr_post_format_icon() {
		$format = get_post_format();
		if ( false === $format ) {
			$out ='fa-pencil';
		} else {
			switch ( $format ) {
				case 'link':
				$out = 'fa-link';
				break;
				case 'aside':
				$out = 'fa-file-text-o';
				break;
				case 'gallery':
				$out = 'fa-th';
				break;
				case 'image':
				$out = 'fa-picture-o';
				break;
				case 'quote':
				$out = 'fa-quote-left ';
				break;
				case 'status':
				$out = 'fa-comment-o';
				break;
				case 'video':
				$out = 'fa-film';
				break;
				case 'audio':
				$out = 'fa-music';
				break;
			}
		}
		return $out;
	}
endif;

/* post content width */
if( !function_exists( 'cr_content_width' ) ) {
	function cr_content_width() {
		global $smof_data;
		switch( $smof_data['layout_style'] ) {
			case 1:
				$out = 'grid_12';
			break;
			case 2:
				$out = 'grid_9';
			break;
			case 3:
				$out = 'grid_9';
			break;
			case 4:
				$out = 'grid_6';
			break;
		}

	return $out;
	}
}	
