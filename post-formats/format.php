              <?php $alttext = the_title_attribute('echo=0'); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry cf'); ?>  role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <?php if ( !is_single() ) {

                    if (has_post_thumbnail() ) { ?>
                      <div class="masonry-thumbnail">

                      <?php 
                       $category = get_the_category(); 
                      if($category[0]) {
                        echo '<ul class="subcat-list post-subcats">';
                        foreach((get_the_category()) as $category) { 
                          if ( $category->parent !== 0 ) {
                          echo '<li><a href="' . get_category_link($category->term_id ) . '">' . $category->cat_name . '</a></li>';   
                           }
                        } 
                        echo '</ul>';
                      }
                      ?>

                            <?php if ( has_post_thumbnail() ) { ?>
                              <a href="<?php the_permalink(' ') ?>"><?php the_post_thumbnail('masonry-thumb', array( 'alt' =>  $alttext )); ?></a>
                            <?php } /*elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                                $video_thumbnail = get_video_thumbnail(); ?>
                                <a href="<?php the_permalink(' ') ?>"><img alt="<?php echo $alttext; ?>" src="<?php echo $video_thumbnail; ?>" /></a>
                             <?php } */ ?>
                        
                  </div>
                  <?php } ?>
                    <h3><a href="<?php the_permalink(' ') ?>"><?php the_title(); ?></a></h3>
                  <?php } elseif ( is_single() ) { // is single 
                    // list of cats
                    echo '<ul class="subcat-list">';
                    $categories = get_the_category();
                    //$separator = '</li><li>';
                    $output = '';
                    if($categories){
                      foreach($categories as $category) {
                        $output .= '<li><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
                      }
                    //echo trim($output, $separator);
                    echo $output;
                    echo '</ul>';
                    } else {
                      //do nothing
                    }
                      //wp_list_categories('orderby=name&title_li=&use_desc_for_title=0&show_option_none=&depth=2&hierarchical=0' );
                      
                      ?>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="masonry-thumbnail">

                      <?php if( is_archive() || is_tax() || is_search() ) { ?>

                            <?php if ( has_post_thumbnail() ) { ?>
                              <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
                            <?php } elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                                $video_thumbnail = get_video_thumbnail(); ?>
                                <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $video_thumbnail; ?>" /></a>
                             <?php } ?>
                          
                      <?php } ?>
                    </div>
                  <?php } ?>
                  
                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">

                  <?php if ( is_single() && has_post_thumbnail() ) { 
                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
                      ?>
                        <div class="masonry-thumbnail">
                            <a rel="lightbox" href="<?php echo $large_image_url[0]; ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
                        </div><!--.masonry-thumbnail-->
                        <?php } /* elseif ( is_single() && function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                            $video_thumbnail = get_video_thumbnail();   
                            ?>
                            <div class="masonry-thumbnail">
                            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $video_thumbnail; ?>" /></a>
                        </div><!--.masonry-thumbnail-->
                  <?php } */ ?>

                  <?php
                   // if on an archive, taxonomy or post-format archive page, show excerpt, otherwise full content
                    if(is_archive() || is_search()) {
                      the_excerpt();
                    } else {
                      the_content();
                    }

                    wp_link_pages( array(
                      'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
                      'after'       => '</div>',
                      'link_before' => '<span>',
                      'link_after'  => '</span>',
                    ) );
                  ?>
                </section> <?php // end article section ?>

                <?php if (is_archive() || is_tax() || is_search() ) { ?>

                  <div class="byline cf"><?php
  comments_popup_link( 'Comment', '1 comment', '% comments', 'comments-link', 'Comments off');
?> | <?php printf( get_the_time(get_option('date_format')) . ', ' . get_the_time('g:i a')); ?></div>

                <?php } else { ?>
                    
                    <?php get_template_part('content', 'postmeta'); ?>

                  <?php comments_template(); ?>
                <?php } ?>

              </article> <?php // end article ?>