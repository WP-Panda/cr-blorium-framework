<?php
/**
 * @package blorium2
 */
?>

	<?php if ( !get_post_format() ) {
		get_template_part( 'loop', 'standard' );
		} else { 
		get_template_part( 'loop', get_post_format() );
	} ?>
