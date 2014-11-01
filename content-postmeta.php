<?php //printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>

<footer class="post-footer cf">
	
	<div class="site-meta"><?php the_tags( '<p class="tagged"><span class="tags-title">' . __( 'Tagged:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

		<span class="post-meta-date"><?php printf( get_the_time(get_option('date_format')) . ', ' . get_the_time('g:i a')); ?></span>
	</div>

	<?php echo do_shortcode('[ssba]');  ?>
</footer>