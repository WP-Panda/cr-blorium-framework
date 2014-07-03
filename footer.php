<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package blorium2
 */
?>

		</div><!-- .conteiner 12 -->
	</div><!-- #content -->
	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php do_action('cr_widgets_footer'); ?>

		<?php do_action( 'cr_copyright_footer'); ?>
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<?php do_action('cr_bottom_footer'); ?>
</body>
</html>
