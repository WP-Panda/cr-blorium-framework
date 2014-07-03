<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blorium2
 */

if ( ! function_exists( 'blorium2_paging_nav' ) ) {
/**
 * Display navigation to next/previous set of posts when applicable.
 */
	function blorium2_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'blorium2' ); ?></h1>
			<div class="nav-links">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'blorium2' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'blorium2' ) ); ?></div>
				<?php endif; ?>

			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'blorium2_post_nav' ) ) {
/**
 * Display navigation to next/previous post when applicable.
 */
	function blorium2_post_nav() {
		global $post;
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		} ?>
		<nav class="navigation post-navigation" role="navigation">
			<!--h1 class="screen-reader-text"><?php /*_e( 'Post navigation', 'blorium2' ); */ ?></h1-->

			<!--div id="prev-next"-->

						<div class="prev-link">
							<i class="fa fa-chevron-left fa-3x shower"></i>
							<?php;
							if( has_post_thumbnail($previous->ID)) { 
								$url = get_cr_bfi_thumb_url( $previous->ID, 100, 100, true );
								$prevthumbnail = '<img class="img-post-nav left-nav" src="' . $url . '" alt="">';
							} else {
								$prevthumbnail = '<span class="none-img-post-nav left-nav fa fa-camera fa-2x"></span>';
							} ?>
	        				<div class="prevnext-url">
								<?php previous_post_link( '%link', "$prevthumbnail <span class='nav-post-title left-title'>%title</span>" ); ?>
							</div>
	    				</div>

	    				<div class="next-link">
	    					<i class="fa fa-chevron-right fa-3x shower"></i>
	    					<?php
	    					if( has_post_thumbnail($next->ID)) { 
	    						$url = get_cr_bfi_thumb_url( $next->ID, 100, 100, true );
								$nextthumbnail = '<img class="img-post-nav right-nav" src="' . $url . '" alt="">';
							} else {
								$nextthumbnail = '<span class="none-img-post-nav right-nav fa fa-camera fa-2x"></span>';
							} ?>
	   					 	<div class="prevnext-url">
								<?php next_post_link('%link',"$nextthumbnail  <span class='nav-post-title right-title'>%title</span>"); ?>
			 				</div>
	    				</div>

			<!--/div><.nav-links -->
		</nav><!-- .navigation -->
	<?php }	
}
 

if ( ! function_exists( 'blorium2_posted_on' ) ) {
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
	function blorium2_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			_x( '<span class="fa fa-calendar-o"></span> %s', 'post date', 'blorium2' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			_x( '<span class="fa fa-user"></span> %s', 'post author', 'blorium2' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="slide-left speed-700 posted-on ">' . $posted_on . '</span><span class="slide-right speed-800 byline"> ' . $byline . '</span>';

	}
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blorium2_categorized_blog() {

	if ( false === ( $all_the_cool_cats = get_transient( 'blorium2_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blorium2_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blorium2_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blorium2_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in blorium2_categorized_blog.
 */
function blorium2_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'blorium2_categories' );
}

add_action( 'edit_category', 'blorium2_category_transient_flusher' );
add_action( 'save_post',     'blorium2_category_transient_flusher' );


if (!function_exists( 'blorium2_posted_in' ) ) {
	function blorium2_posted_in() {

		if ( is_search() ) {  // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php // the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php } else { ?>
			<div class="entry-content">
				<?php // the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blorium2' ) ); ?>
				<?php // the_excerpt(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'blorium2' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
		<?php } ?>

		<footer class="entry-footer">
			<?php if ( 'post' == get_post_type() ) { // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'blorium2' ) );
					if ( $categories_list && blorium2_categorized_blog() ) {
				?>
				<span class="slide-left speed-900 cat-links">
					<?php printf( __( '<span class="fa fa-folder-o"></span> %1$s', 'blorium2' ), $categories_list ); ?>
				</span>
				<?php } // End if categories ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'blorium2' ) );
					if ( $tags_list ) {
				?>
				<span class="slide-right speed-600 tags-links">
					<?php printf( __( 'Tagged %1$s', 'blorium2' ), $tags_list ); ?>
				</span>
				<?php } // End if $tags_list ?>
			<?php } // End if 'post' == get_post_type() ?>

			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'blorium2' ), __( '1 Comment', 'blorium2' ), __( '% Comments', 'blorium2' ) ); ?></span>
			<?php } ?>

			<?php edit_post_link( __( 'Edit', 'blorium2' ), '<span class="edit-link">', '</span>' ); ?> 
		</footer><!-- .entry-footer -->
	<?php }
}