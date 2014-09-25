<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry'); ?> >

	<?php if ( has_post_thumbnail() ) { ?>
    <div class="masonry-thumbnail">
        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
    </div><!--.masonry-thumbnail-->
<?php } elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
		$video_thumbnail = get_video_thumbnail(); 	
		?>
		<div class="masonry-thumbnail">
        <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $video_thumbnail; ?>" /></a>
    </div><!--.masonry-thumbnail-->
		<?php
	} else {
		//do nothing;
	} ?>
    <div class="masonry-details">
    	<h4><?php the_category(' '); ?></h4>
        <h3><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><span class="masonry-post-title"> <?php the_title(); ?></span></a></h3>
        <div class="masonry-post-excerpt">
            <?php the_excerpt(); ?>
        </div><!--.masonry-post-excerpt-->
    </div><!--/.masonry-entry-details -->  
</article><!--/.masonry-entry-->