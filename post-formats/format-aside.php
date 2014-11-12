              
              <?php $alttext = the_title_attribute('echo=0'); ?>

              <article id="post-<?php the_ID(); ?>" <?php post_class('masonry-entry cf'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                      <h4 class="cat-title"><a href="<?php echo get_term_link( 'kidlit-kibbles', 'posttype' ); ?>">KiLit Kibbles</a></h4>
                  

                   <?php if (is_archive() || is_tax() || is_category() || is_search() ) { ?>
                    <h3><a href="<?php the_permalink(' ') ?>"><?php the_title(); ?></a></h3>
                  <?php } else { ?>
                    <?php 
                      // list of cats
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
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                  <?php } ?>

                </header> <?php // end article header ?>

                <section class="entry-content cf" itemprop="articleBody">
                  <?php if ( has_post_thumbnail() ) { ?>
                        <div class="masonry-thumbnail">
                            <a href="<?php the_permalink(' ') ?>"><?php the_post_thumbnail('masonry-thumb', array( 'alt' =>  $alttext )); ?></a>
                        </div><!--.masonry-thumbnail-->
                        <?php } /* elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                            $video_thumbnail = get_video_thumbnail();   
                            ?>
                            <div class="masonry-thumbnail">
                            <a href="<?php the_permalink(' ') ?>"><img src="<?php echo $video_thumbnail; ?>" alt="<?php echo $alttext; ?>" /></a>
                        </div><!--.masonry-thumbnail-->
                  <?php } */  ?>
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