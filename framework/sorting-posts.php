<?php add_action( 'admin_menu', 'sneek_register_product_menu' );

function sneek_register_product_menu() {
	add_submenu_page(
		'edit.php',
		'Order Slides',
		'Cортировка',
		'edit_pages', 'posts-order',
		'sneek_product_order_page'
	);
}

function sneek_product_order_page() {
?>
	<div class="wrap">
		<h2>Sort Products</h2>
		<p>Simply drag the product up or down and they will be saved in that order.</p>
	<?php $products = new WP_Query( array( /*'post_type' => 'product',*/ 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) ); ?>
	<?php if( $products->have_posts() ) : ?>

		<table class="wp-list-table widefat fixed posts" id="sortable-table">
			<thead>
				<tr>
					<th class="column-order">Order</th>
					<th class="column-thumbnail">Thumbnail</th>
					<th class="column-title">Title</th>
				</tr>
			</thead>
			<tbody data-post-type="product">
			<?php while( $products->have_posts() ) : $products->the_post(); ?>
				<tr id="post-<?php the_ID(); ?>">
					<td class="column-order"><div class ="icon dashicons dashicons-editor-justify"></div></td>
					<td class="column-thumbnail"><?php the_post_thumbnail( 'thumbnail' ); ?></td>
					<td class="column-title"><strong><?php the_title(); ?></strong><div class="excerpt"><?php the_excerpt(); ?></div></td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="column-order">Order</th>
					<th class="column-thumbnail">Thumbnail</th>
					<th class="column-title">Title</th>
				</tr>
			</tfoot>

		</table>

	<?php else: ?>

		<p>No products found, why not <a href="post-new.php">create one?</a></p>

	<?php endif; ?>
	<?php wp_reset_postdata(); // Don't forget to reset again! ?>

	<style>
		/* Dodgy CSS ^_^ */
		#sortable-table td { background: white; }
		#sortable-table .column-order { padding: 3px 10px; width: 50px; }
			#sortable-table .column-order img { cursor: move; }
		#sortable-table td.column-order { vertical-align: middle; text-align: center; }
		#sortable-table .column-thumbnail { width: 160px; }
	</style>

	</div><!-- .wrap -->

<?php

}



function sneek_admin_enqueue_scripts() {
	wp_enqueue_script( 'jquery-ui-sortable' );
	//wp_enqueue_script( 'sneek-admin-scripts', get_template_directory_uri() . '/js/sneek-admin-scripts.js' );
}
add_action( 'admin_enqueue_scripts', 'sneek_admin_enqueue_scripts' );

function cr_admin_ordring_posts(){ ?>
<script type="text/javascript">
	jQuery(function($) {

	$('#sortable-table tbody').sortable({
		axis: 'y',
		handle: '.column-order .icon',
		placeholder: 'ui-state-highlight',
		forcePlaceholderSize: true,
		update: function(event, ui) {
			var theOrder = $(this).sortable('toArray');

			var data = {
				action: 'sneek_update_post_order',
				postType: $(this).attr('data-post-type'),
				order: theOrder
			};

			$.post(ajaxurl, data);
		}
	}).disableSelection();

});
</script>
<?php }

add_action('admin_footer','cr_admin_ordring_posts');

add_action( 'wp_ajax_sneek_update_post_order', 'sneek_update_post_order' );

function sneek_update_post_order() {
	global $wpdb;

	$post_type     = $_POST['postType'];
	$order        = $_POST['order'];

	
	foreach( $order as $menu_order => $post_id )
	{
		$post_id         = intval( str_ireplace( 'post-', '', $post_id ) );
		$menu_order     = intval($menu_order);
		wp_update_post( array( 'ID' => $post_id, 'menu_order' => $menu_order ) );
	}

	die( '1' );
}