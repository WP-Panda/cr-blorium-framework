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
		$quote_source = get_post_meta( $post->ID, 'cr_bl2_quote_source', true );
		$quote_source = $quote_source ? '<span class="quote-source">' . $quote_source . '</span>': '';
		$quote_autor = get_post_meta( $post->ID, 'cr_bl2_quote_autor', true );
		$quote_autor = $quote_autor ? $quote_autor : get_the_title();
		$quote_year = get_post_meta( $post->ID, 'cr_bl2_quote_year', true );
		$quote_year = $quote_year ? '<span class="quote-year"> - ' . $quote_year . '</span>': ''; 
		$quote_color = get_post_meta( $post->ID, 'cr_bl2_quote_color', true );
		$quote_color = $quote_color ? 'color:' . $quote_color . ';' : '';
		?>
		<div class="quote fooll-background" style="<?php echo $quote_color; ?>background-image:url(<?php echo get_cr_post_thumb_url($post->ID);?>)"><i class="fa fa-quote-left fa-3x"></i>
			<?php the_content(); ?>
			<span class="quote-autor"><?php echo $quote_autor; ?></span>
			<?php if( $quote_source || $quote_year ) echo '<div class="quote-param">';
				echo $quote_source;
				echo $quote_year;
			if( $quote_source || $quote_year ) echo '</div>'; ?>
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