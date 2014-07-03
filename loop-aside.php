<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $format = cr_post_format_icon(); ?>
		<span class="icon-post-format fa <?php echo $format;?> fa-2x"></span>
		
		<header class="entry-header">
			<?php if ( 'post' == get_post_type() ) { ?>
			<div class="entry-meta">
				<?php blorium2_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php } ?>
		</header><!-- .entry-header -->

<div class="entry-content">
		<?php the_content(); ?>
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