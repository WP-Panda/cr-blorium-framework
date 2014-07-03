<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) { ?>
		<div class="entry-meta">
			<?php blorium2_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php } ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
		$link_title = get_post_meta( $post->ID, 'cr_bl2_link_title', true );
		$link_title = $link_title ? $link_title : '';
		$link_ankor = get_post_meta( $post->ID, 'cr_bl2_link_ankor', true );
		$link_ankor = $link_ankor ? $link_ankor : get_the_title();
		$link_url = get_post_meta( $post->ID, 'cr_bl2_link_url', true );
		$link_url = $link_url ? $link_url : ''; 
		$link_color = get_post_meta( $post->ID, 'cr_bl2_link_color', true );
		$link_color = $link_color ? 'color:' . $link_color . ';' : '';
		?>
		<div class="link fooll-background" style="<?php echo $link_color; ?>background-image:url(<?php echo get_cr_post_thumb_url($post->ID);?>)"><i class="fa fa-link fa-3x"></i>
			<a class="link-link" style="<?php echo $link_color; ?>" href="<?php echo $link_url; ?>" title="<?php echo $link_title; ?>"><?php echo $link_ankor; ?></a>
		</div>
		<?php if ( is_single() ) the_content(); ?>
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