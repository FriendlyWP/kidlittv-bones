<?php
/**
 * Flexible Posts Widget: KiLit Kibbles widget template
 * 
 * @since 3.4.0
 *
 * This template was added to overcome some often-requested changes
 * to the old default template (widget.php).
 */

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');

echo $before_widget;

if ( !empty($title) )
	echo $before_title . $title . $after_title;

if( $flexible_posts->have_posts() ):
?>
<?php $alttext = the_title_attribute('echo=0'); ?>
	<ul class="dpe-flexible-posts gribbles-widget">
	<?php while( $flexible_posts->have_posts() ) : $flexible_posts->the_post(); global $post; ?>
		<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h5 class="grib-title"><a href="<?php the_permalink(' ') ?>"><?php the_title(); ?></a></h5>
				<?php
					if( $thumbnail == true ) {
						if( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(' ') ?>"><?php the_post_thumbnail($thumbsize, array( 'alt' =>  $alttext )); ?></a>
						<?php } elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
							 $video_thumbnail = get_video_thumbnail();  ?>
							 <a href="<?php the_permalink(' ') ?>"><img src="<?php echo $video_thumbnail; ?>" alt="<?php echo $alttext; ?>" /></a>
						<?php }
					}
				?>
			<?php the_excerpt(); ?>
		</li>
	<?php endwhile; ?>
	</ul><!-- .dpe-flexible-posts -->
<?php	
endif; // End have_posts()
	
echo $after_widget;
