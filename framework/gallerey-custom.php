<?php  
/* Вывод галлереи без контента */
if ( !function_exists( 'cr_gallerey_not_singular' ) ) {
    function cr_gallerey_not_singular( $content ) {

        global $post;

        // если одиночная запись
        if( ! is_singular() )
            return $content;

        // если галлереи нет
        if( ! has_shortcode( $post->post_content, 'gallery' ) )
            return $content;

        //  только галлерея
        $content =  get_post_gallery();

        return $content;

    }

    add_filter( 'the_content', 'cr_gallerey_not_singular' );

}


/* галерея в виде Pinterst сетки */
if ( !function_exists( 'cr_grid_gallery' ) ) {
    function cr_grid_gallery($output, $attr) {

        global $post;

        if (isset($attr['orderby'])) {
            $attr['orderby'] = sanitize_sql_orderby($attr['orderby']);
            if (!$attr['orderby'])
                unset($attr['orderby']);
        }

        extract(shortcode_atts(array(
            'order' => 'ASC',
            'orderby' => 'menu_order ID',
            'id' => $post->ID,
            'itemtag' => 'dl',
            'icontag' => 'dt',
            'captiontag' => 'dd',
            'columns' => 3,
            'size' => 'thumbnail',
            'include' => '',
            'exclude' => ''
        ), $attr));

        $id = intval($id);
        if ('RAND' == $order) $orderby = 'none';

        if (!empty($include)) {
            $include = preg_replace('/[^0-9,]+/', '', $include);
            $_attachments = get_posts(array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby));

            $attachments = array();
            foreach ($_attachments as $key => $val) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        }

        if (empty($attachments)) return '';

        $output = "</p><div class='popup-gallery slide-bottom'>\n";

        foreach ($attachments as $id => $attachment) {
            $img = wp_get_attachment_image_src($id, 'full');
            $thumb = $img[0];
            $params = array( 'width' => 350 );
            $img_url = bfi_thumb( $thumb, $params );

            $output .= '<a class="cr-img-gallery post-grid slide-bottom" href="' . $img[0] . '" title="The Cleaner"><img src="'. $img_url . '"  alt=""></a>';
        }

        $output .= "</div><p>\n";

        return $output;
    }

    add_filter('post_gallery', 'cr_grid_gallery', 10, 2);

}