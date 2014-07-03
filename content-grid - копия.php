<?php
/**
 * @package blorium2
 */
?>
<div class="post-grid data-effect">
	<article id="post post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $format = cr_post_format_icon(); ?>
		<span class="icon-post-format fa <?php echo $format;?> fa-2x"></span>
		<?php if( has_post_thumbnail()) { 
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

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php // the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blorium2' ) ); ?>
			<?php the_excerpt(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'blorium2' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-footer">
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'blorium2' ) );
					if ( $categories_list && blorium2_categorized_blog() ) :
				?>
				<span class="cat-links">
					<?php printf( __( '<span class="fa fa-folder-o"></span> %1$s', 'blorium2' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'blorium2' ) );
					if ( $tags_list ) :
				?>
				<span class="tags-links">
					<?php printf( __( 'Tagged %1$s', 'blorium2' ), $tags_list ); ?>
				</span>
				<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'blorium2' ), __( '1 Comment', 'blorium2' ), __( '% Comments', 'blorium2' ) ); ?></span>
			<?php endif; ?>

			<?php edit_post_link( __( 'Edit', 'blorium2' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-footer -->
	</article><!-- #post-## -->
</div>