<?php /**/

/* add post class too ajax grid*/
// add category nicenames in body and post class
/*  function category_id_class($classes) {
    if( !is_page_template('fool-grid-template.php') ) 
    return $classes;
      global $post;
          $classes[] = 'post-grid';
          return $classes;
  }
  add_filter('post_class', 'category_id_class');*/

function theme_name_scripts() {
  wp_enqueue_script( 'ajax-panda',  get_template_directory_uri()  . '/js/ajax.js', array('jquery'), '1.0.0', true );
  wp_localize_script( 'ajax-panda', 'MyAjax', array(
    // URL to wp-admin/admin-ajax.php to process the request
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
 
    // generate a nonce with a unique ID "myajax-post-comment-nonce"
    // so that you can check it later when an AJAX request is sent
    'security' => wp_create_nonce( 'my-special-string' )
  ));
}
add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );



function my_action_callback(){
    check_ajax_referer( 'my-special-string', 'security' );
    # Load the posts
    $paged = $_POST['pageNumber'];
    echo $paged;
    $args = array(
        'paged' => $paged
    );

   $ajax_query = new WP_Query( $args ); 

    if ( $ajax_query->have_posts() ) :

			 /* Start the Loop */ 
			 while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
   
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'content', get_post_format() );
					get_template_part( 'content', 'grid' );
	 endwhile; 
			 blorium2_paging_nav();

		 else : 

			 get_template_part( 'content', 'none' );

		 endif; 
		 wp_reset_query();
				
    die();
}

add_action('wp_ajax_my_action', 'my_action_callback');           // for logged in user
add_action('wp_ajax_nopriv_my_action', 'my_action_callback');    // if user not logged in