<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $format = cr_post_format_icon(); ?>
		<span class="icon-post-format fa <?php echo $format;?> fa-2x slide-bottom"></span>
		
		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="slide-right speed-900-distance-300 entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php blorium2_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
<div class="entry-content">

	<div class='cr-audio-player'>

		<?php 

		$audio_soundcloud_type = get_post_meta( $post->ID, 'cr_bl2_audio_soundcloud_type', true);
		$audio_file = get_post_meta( $post->ID, 'cr_bl2_audio_file', true);
		$audio_title = get_post_meta( $post->ID, 'cr_bl2_audio_title', true);
		$audio_singer = get_post_meta( $post->ID, 'cr_bl2_audio_singer', true);
		$audio_album = get_post_meta( $post->ID, 'cr_bl2_audio_album', true);
		$audio_year = get_post_meta( $post->ID, 'cr_bl2_audio_year', true);
		$out="";

		//изображение для локального видео
		if( !$audio_soundcloud_type ) {
			if( has_post_thumbnail() ) { 
				global $smof_data;
				$width = $smof_data['content_width'] ? $smof_data['content_width'] : '1940';
				the_post_thumbnail( array( $width, 'bfi_thumb' => true ) );
			} else {
				echo "<div class='none-img fa fa-camera fa-5x'></div>";
			}
		}

		if( !empty( $audio_file ) && empty( $audio_soundcloud_type ) ){
			if( !empty( $audio_title ) ) { 
				$out .= "<span class='audio_title'>" . $audio_title . "</span>";
			} else {
				$out .= "<span class='audio_title'>" . get_the_title() . "</span>";
			}
			if( !empty( $audio_singer ) ) $out .= "<span class='audio_singer'>" . $audio_singer . "</span>";
			if( !empty( $audio_album ) ) $out .= "<span class='audio_album'>" . $audio_album . "</span>";
			if( !empty( $audio_year ) ) $out .= "<span class='audio_year'>" . $audio_year . "</span>";
			$out .= do_shortcode( '[audio src="' . $audio_file . '"]' ); 
	 	} elseif ( !empty( $audio_file ) && !empty( $audio_soundcloud_type ) ) {
	 		if ( is_single() ) {
	 			$out .= do_shortcode( '[soundcloud params="auto_play=false&show_comments=false&visual=false&hide_related=true"  height="166"]'. $audio_file .'[/soundcloud]' );
	 		} else {
	 			$out .= do_shortcode( '[soundcloud params="auto_play=false&show_comments=false&visual=true&hide_related=true"  height="250"]'. $audio_file .'[/soundcloud]' );
	 		}
	 	} else {
	 		$out .= __( "Аудио файл не загружен", "wp_panda" );
	 	} 
	 	echo $out;?>
   	</div>
   		<?php  if( is_single() ) {
			the_content(); 
		}?>
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