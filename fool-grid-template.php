<?php
/*
Template Name: Grid
*/
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package blorium2
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main grid-blog" role="main">
		<?php 
			/**
			  * The WordPress Query class.
			  * @link http://codex.wordpress.org/Function_Reference/WP_Query
			  *
			  */
			$args = array( 
				//'orderby' => 'menu_order',
				//'order' =>'ASC',
				'post_type'   => 'post',
				'post_status' => 'publish',
				);

			$query_n = new WP_Query( $args );

		 	if ( $query_n->have_posts() ) : ?>
				<div id="key" data-key="<?php echo $query_n ->max_num_pages;?>" data-effect="zoomOut"></div>
				<?php /* Start the Loop */ ?>
				<?php while ( $query_n->have_posts() ) : $query_n->the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'grid' );
				
				endwhile;

					blorium2_paging_nav();

				else :

					get_template_part( 'content', 'none' );

				endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php //get_sidebar(); ?>
<?php get_footer(); ?>