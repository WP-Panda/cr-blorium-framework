<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $format = cr_post_format_icon(); ?>
		<span class="icon-post-format fa <?php echo $format;?> fa-2x"></span>
		<?php /* if( has_post_thumbnail()) { 
			the_post_thumbnail( array( 500, 'bfi_thumb' => true ) );
		} else {
			echo "<div class='none-img fa fa-camera fa-5x'></div>";
		} ?>
		<? /* if ( !get_post_format() ) {
				get_template_part( 'loop', 'standard' );
				} else { 
				get_template_part( 'loop', get_post_format() );
			} */ ?>
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php blorium2_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
<div class="entry-content">
	<?php the_content(); ?>
		<?php //the_excerpt(); ?>
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