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
			$('.flexslider').flexslider({
        		animation: "slide",
        		controlNav: false,
        		prevText: "",
        		nextText: "",
  		    });
		});
		</script>
    	<div class="flexslider">
        <ul class="slides">
    	<?php while ( $featured_query->have_posts() ) { 

         	$featured_query->the_post(); 
         	echo '<li>';
            echo '<h2><a href="'. get_permalink() . '">' . get_the_title() . '</a></h2>';
        	echo '</li>';
			}
        ?>
        </ul>
		<?php } ?>
    </div>