              <?php $alttext = the_title_attribute('echo=0'); ?>
              <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                <?php if( has_term( 'kltv-exclusives', 'posttype' ) ) { ?>
                  <h4 class="kltv-exclusive"><a href="<?php echo get_term_link( 'kltv-exclusives', 'posttype' ); ?>">KLTV Exclusive</a></h4>
                <?php } ?>

                <div class="masonry-thumbnail">
                  <?php if ( is_archive() || is_tax() ) { ?>
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
                          <a href="<?php the_permalink(' ') ?>"><img src="<?php echo $video_thumbnail; ?>" alt="<?php echo $alttext; ?>" /></a>
                       <?php } */ ?>
                    
                <?php } elseif (is_single()) { 

                         if ( function_exists('get_field') && get_field('add_video_url') ) {
                              $videourl = get_field('add_video_url');
                              echo '<figure class="video-container">';
                                echo  wp_oembed_get($videourl);
                              echo '</figure>';
                          } elseif ( function_exists('get_field') && get_field('new_video_url') ) {
                             $videourl = get_field('new_video_url');
                             echo '<figure class="video-container">';
                                echo  $videourl;
                              echo '</figure>';
                          } else {
                           
                            // do nothing
                          } 


               } ?>
              </div><!--.masonry-thumbnail-->

                <section class="entry-content cf" itemprop="articleBody">

                  <?php 
                  if ( is_single() ) {
                      // list of cats
                    echo '<ul class="subcat-list">';
                    $categories = get_the_category();
                    $output = '';
                    if($categories) {
                      foreach($categories as $category) {
                        $output .= '<li><a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a></li>';
                      }
                    }
                    echo $output;
                    echo '</ul>';
                  }
                    ?>

                   <h3><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                  <?php
                    // if on an archive, taxonomy or post-format archive page, show excerpt, otherwise full content
                    if( is_archive() || is_tax() ) {
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

                    <?php get_template_part('content', 'postmeta'); ?>

                  <?php comments_template(); ?>
                <?php } ?>

              </article> <?php // end article ?>