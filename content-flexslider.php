<?php 
    // define query parameters based on attributes
    $options = array(
        'post_type' => 'post',
        'order' => 'menu_order',
        'posts_per_page' => -1,
        'meta_key' => 'featured_item',
		'meta_value' => true,
    );
    
    $featured_query = new WP_Query( $options );
    // run the loop based on the query
    if ( $featured_query->have_posts() ) { 
        ?>
    	<script type="text/javascript" language="javascript">
        jQuery(document).ready(function($) {
            var n = 1;
			$('.flexslider').flexslider({
        		animation: "slide",
        		controlNav: false,
        		prevText: "",
        		nextText: "",
                after: function(slider) {
                   if (slider.currentSlide == slider.count - 1) { // is last slide
                      n--;
                      if(n==0) {
                        slider.pause();
                      }
                   }
                }
  		    });
		});
		</script>
    	<div class="flexslider">
        <ul class="slides">
    	<?php while ( $featured_query->have_posts() ) { 
         	$featured_query->the_post(); 
            $alttext = the_title_attribute('echo=0');

            $category = get_the_category($featured_query->post->ID); 
         	echo '<li>';
            if ( has_post_thumbnail() ) { 
                echo '<a class="slideimg" href="' . get_permalink('') . '">' .  get_the_post_thumbnail($featured_query->post->ID, 'masonry-thumb', array( 'alt' =>  $alttext )) . '</a>';
            } elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
                $video_thumbnail = get_video_thumbnail($featured_query->post->ID);   
                echo '<a class="slideimg" href="' . get_permalink('') . '"><img src="'. $video_thumbnail . '" alt="' . $alttext . '" /></a>';
            }
            echo '<div class="slidetext">';
            if ( has_term('kltv-exclusives' , 'posttype' ) ) {
                echo '<a class="slidecat" href="' . get_term_link('kltv-exclusives','posttype') . '">KLTV Exclusives</a>';
            }  elseif($category[0]) {
                echo '<a class="slidecat" href="' . get_category_link($category[0]->term_id ) . '">' . $category[0]->cat_name . '</a>';   
            }        
            echo '<h2><a href="'. get_permalink() . '">' . get_the_title() . '</a></h2>';
            echo '<a class="slidemore" href="'. get_permalink() . '">More &hellip;</a>';
            echo '</div>';
        	echo '</li>';
			}
        ?>
        </ul>
		<?php } ?>
    </div>