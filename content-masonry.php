<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry'); ?> >
    <?php foreach((get_the_category()) as $category) {
                //if ($category->slug !== 'kid-lit-tv') {
                    if ($category->slug == 'gribbles-scribbles') { ?>
                   <h4 class="cat-title"><?php echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> '; ?></h4>
            <?php } elseif ($category->slug == 'kltv-exclusive') { ?>
                    <h4 class="kltv-exclusive"><?php echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> '; ?></h4>
            <?php }
            // }
        } ?>
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
        
        <h3><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
        <div class="masonry-post-excerpt">
            <?php the_excerpt(); ?>
            <?php //the_tags('<ul class="tags"><li>','</li><li>','</li></ul>'); ?>
            <?php
            $posttags = get_the_tags();
            if ($posttags) {
                echo '<ul class="tags">';
              foreach($posttags as $tag) {
                echo '<li><a class="' . $tag->slug . '" href="' . home_url('/tag/') . $tag->slug . '">';
                echo $tag->name . '</a></li>'; 
              }
              echo '</ul>';
            }
            ?>
            
            <div class="byline"><?php
  comments_popup_link( 'Comment', '1 comment', '% comments', 'comments-link', 'Comments off');
?> | <?php printf( get_the_time(get_option('date_format')) . ', ' . get_the_time('g:i a')); ?></div>
        </div><!--.masonry-post-excerpt-->
    </div><!--/.masonry-entry-details -->  
</article><!--/.masonry-entry-->