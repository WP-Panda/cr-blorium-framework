<?php
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

get_header(); 
global $smof_data; ?>

<?php if ( $smof_data['layout_style'] == 3 || $smof_data['layout_style'] == 4 ) get_sidebar('left'); ?>
	<div id="primary" class="content-area <?php if ( function_exists( 'cr_content_width' ) ) echo cr_content_width();?>">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content' );
				?>

			<?php endwhile; ?>

			<?php blorium2_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php if ( $smof_data['layout_style'] == 2 || $smof_data['layout_style'] == 4 ) get_sidebar('right'); ?>
<?php get_footer(); ?>
