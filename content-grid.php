<?php
/**
 * @package blorium2
 */
?>
<div class="post-grid data-effect">
	<?php if ( !get_post_format() ) {
		get_template_part( 'loop', 'standard' );
		} else { 
		get_template_part( 'loop', get_post_format() );
	} ?>
</div>