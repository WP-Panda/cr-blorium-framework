<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) { ?>
		<div class="entry-meta">
			<?php blorium2_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
	</header><!-- .entry-header -->

<?php
	$status_color = get_post_meta( $post->ID, 'cr_bl2_status_color', true );
	$status_color = $status_color ? 'color:' . $status_color . ';' : '';
?>
<div class="entry-content">
	<div class="status fooll-background fa fa-slack" style="<?php echo $status_color; ?>background-image:url(<?php echo get_cr_post_thumb_url($post->ID);?>);">
		<span class="status-text fa fa-slack fa-2x">
			<?php $text = get_the_content(); 
			$text = strip_tags( $text );
			echo $text; ?>
		</span>
	</div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'blorium2' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php blorium2_posted_in();?>
	<?php do_action('cr_after_post' ); ?>

	</article><!-- #post-## -->