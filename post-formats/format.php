              <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry cf'); ?>  role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <?php if (is_archive() || is_tax() ) { ?>
                    <div class="masonry-thumbnail">

                  <?php 
                  // sub-cat links on top of images
                    if( (is_category() || is_tax()) && !is_tax( 'post_format', 'post-format-video') ) { 
                      $current_cat_id = get_query_var('cat');
                      if (!category_has_parent($current_cat_id)) {
                        echo '<ul class="subcat-list post-subcats">';
                      wp_list_categories('orderby=name&title_li=&use_desc_for_title=0&show_option_none=&child_of=' . $current_cat_id );
                      echo '</ul>';
                    }
                  }
                  ?>

                    <?php if( is_archive() || is_tax() ) { ?>

                          <?php if ( has_post_thumbnail() ) { ?>
                            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
                          <?php } elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                              $video_thumbnail = get_video_thumbnail(); ?>
                              <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $video_thumbnail; ?>" /></a>
                           <?php } ?>
                        
                    <?php } ?>
                  </div>
                    <h3><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
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

                      <?php if( is_archive() || is_tax() ) { ?>

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

                  <?php if ( is_single() && has_post_thumbnail() ) { ?>
                        <div class="masonry-thumbnail">
                            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
                        </div><!--.masonry-thumbnail-->
                        <?php } elseif ( is_single() && function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                            $video_thumbnail = get_video_thumbnail();   
                            ?>
                            <div class="masonry-thumbnail">
                            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $video_thumbnail; ?>" /></a>
                        </div><!--.masonry-thumbnail-->
                  <?php } ?>

                  <?php
                   // if on an archive, taxonomy or post-format archive page, show excerpt, otherwise full content
                    if(is_archive()) {
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

                <?php if (is_archive() || is_tax() ) { ?>

                  <div class="byline cf"><?php
  comments_popup_link( 'Comment', '1 comment', '% comments', 'comments-link', 'Comments off');
?> | <?php printf( get_the_time(get_option('date_format')) . ', ' . get_the_time('g:i a')); ?></div>

                <?php } else { ?>

                    <footer class="article-footer">

                    <?php printf( __( 'Filed under: %1$s', 'bonestheme' ), get_the_category_list(', ') ); ?>

                    <?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

                    <?php printf( get_the_time(get_option('date_format')) . ', ' . get_the_time('g:i a')); ?>

                  </footer> <?php // end article footer ?>

                  <?php comments_template(); ?>
                <?php } ?>

              </article> <?php // end article ?>