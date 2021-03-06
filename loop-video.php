<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $format = cr_post_format_icon(); ?>
		<span class="icon-post-format fa <?php echo $format;?> fa-2x"></span>
		
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php blorium2_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
<div class="entry-content">
	<?php $video_url = get_post_meta( $post->ID, 'cr_bl2_video_url', true); ?>
	<?php if( $video_url ) { ?>
	<iframe src="<?php echo $video_url; ?>" width="500" height="281" ></iframe>
	<?php } else { ?>
		<?php _e('Отсутствует ссылка на видеофайл','wp_panda'); ?>
	<?php } ?>
	<?php //the_content(); ?>
		<?php the_excerpt(); ?>
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