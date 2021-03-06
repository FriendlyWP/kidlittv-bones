<?php
/*
Template Name: Home Page
*/

get_header(); 
?>
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="main-content cf" role="main">
							<?php if ( wp_is_mobile() && is_active_sidebar( 'mobile-home' ) ) { ?>

								<?php dynamic_sidebar( 'mobile-home' ); ?>

							<?php } ?>

						<?php get_template_part('content', 'flexslider'); ?>

						<?php // KLTV EXCLUSIVES
						 // define query parameters based on attributes
					    $kltv_options = array(
					        'post_type' => 'post',
					        'order' => 'menu_order',
					        'posts_per_page' => 6,
					        'posttype' => 'kltv-exclusives'
					    );
					    
					    $exclusives_query = new WP_Query( $kltv_options );
					    // run the loop based on the query
					    if ( $exclusives_query->have_posts() ) { 
					    	$alttext = the_title_attribute('echo=0');
					    	echo '<div class="kltv-featurebox">';
					    	echo '<h3 class="kltvtitle"><a href="' . get_term_link( 'kltv-exclusives', 'posttype' ) . '">KLTV Exclusives</a></h3>';
					    	echo '<ul>';
						    	while ( $exclusives_query->have_posts() ) { 
		         					$exclusives_query->the_post(); 
		         					echo '<li>';
		         					if ( has_post_thumbnail() ) { 
						                echo '<a class="smallplay" href="' . get_permalink('') . '">' .  get_the_post_thumbnail($exclusives_query->post->ID, 'thumbnail', array( 'alt' =>  $alttext )) . '</a>';
						            } /*elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
						                $video_thumbnail = get_video_thumbnail($exclusives_query->post->ID);   
						                echo '<a class="smallplay" href="' . get_permalink('') . '"><img src="'. $video_thumbnail . '" alt="' . $alttext . '" /></a>';
						            } */
						            echo '<h4><a href="'. get_permalink() . '">' . get_the_title() . '</a></h4>';
		         					echo '</li>';
		         				}
	         				echo '</ul>';
	         				echo '</div>';
	         			}
						?>

						<?php // LATEST FROM EACH CATEGORY
						$idObj = get_category_by_slug('community'); 
  						$id = $idObj->term_id;
  						$exclude = $id . ',1'; // exclude community and uncategorized categories
						$selected_categories = array(
						 //'cat_name' => 'book-craft,interviews,technology,trailers,business-marketing',
						 'exclude' => $exclude,
						 'order_by' => 'menu_order',
						 'order' => 'ASC',
						 'parent' => '0'
						 );

						$categories=get_categories($selected_categories);
						if ($categories) {
							echo '<div class="latestfromeach cf">';
							echo '<ul>';

							foreach($categories as $category) {
								$post_args=array(
									'showposts' => 1, // you can fetch number of articles from each category
									'category__in' => array($category->term_id),
									'tax_query' => array(
										array(
											'taxonomy' => 'posttype',
											'field'    => 'slug',
											'terms'    => array( 'kidlit-kibbles', 'kltv-exclusives'),
											'operator' => 'NOT IN',
										),
									),
								);

								$posts=get_posts($post_args);
								
								if ($posts) {
									
									echo '<li class="blocks">';
									echo '<div class="ctnr">';
									echo '<h3 class="cattitle"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></h3>';
								
									foreach($posts as $post) {
										setup_postdata($post);
										$format = get_post_format( $post->ID );
										if ("video" === $format) {
											$class = 'smallplay';
										} else {
											$class = '';
										}

										if ( has_post_thumbnail() ) { 
							                echo '<a class="' . $class  . '" href="' . get_permalink('') . '">' .  get_the_post_thumbnail($post->ID, 'thumbnail', array( 'alt' =>  $alttext )) . '</a>';
							            } /*elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
							                $video_thumbnail = get_video_thumbnail($post->ID);   
							                echo '<a class="smallplay" href="' . get_permalink('') . '"><img src="'. $video_thumbnail . '" alt="' . $alttext . '" /></a>';
							            } */
							            echo '<h4><a href="'. get_permalink() . '">' . get_the_title() . '</a></h4>';
									}
									echo '</div>';
									echo '</li>';
									
								}
								
							}
							//echo '<li class="blocks"><h3 class="cattitle all"><a href="' . get_home_url( '/kltv-exclusives' ) . '">All Videos</a></h3></li>';
							echo '</ul></div>';
						}
						?>

						<?php // COMMUNITY: LATEST FROM EACH CHILD CATEGORY OF COMMUNITY
						$idObj = get_category_by_slug('community'); 
  						$id = $idObj->term_id;
  						$description = $idObj->description;
						$selected_categories = array(
						 'order' => 'ASC',
						 'order_by' => 'menu_order',
						 'parent' => $id,
						 );
						$categories=get_categories($selected_categories);
						if ($categories) {
							echo '<div class="latestcommunity">';
							echo '<ul>';
							echo '<li class="commtitle"><h3 class="cattitle"><a href="' . get_category_link( $idObj->term_id ) . '">' . $idObj->name . '</a></h3>';
							echo '<p>' . $description . '</p></li>';

							foreach($categories as $category) {
								$post_args=array(
									'numberposts' => 1, // you can fetch number of articles from each category
									'posts_per_page' => 1,
									'post_status' => 'publish',
									'category__in' => array($category->term_id),
									'tax_query' => array(
										array(
											'taxonomy' => 'posttype',
											'field'    => 'slug',
											'terms'    => array( 'kidlit-kibbles', 'kltv-exclusives'),
											'operator' => 'NOT IN',
										),
									),
								);

								$posts=get_posts($post_args);
								
								if ($posts) {									
								
									foreach($posts as $post) {
										setup_postdata($post);
										$format = get_post_format( $post->ID );
										if ("video" === $format) {
											$class = 'smallplay';
										} else {
											$class = '';
										}
										echo '<li class="blocks">';
										if ( has_post_thumbnail() ) { 
							                echo '<a class="' . $class . '" href="' . get_permalink('') . '">' .  get_the_post_thumbnail($post->ID, 'thumbnail', array( 'alt' =>  $alttext )) . '</a>';
							            } /* elseif ( function_exists('get_video_thumbnail') && get_video_thumbnail() ) {
							                $video_thumbnail = get_video_thumbnail($post->ID);   
							                echo '<a class="smallplay" href="' . get_permalink('') . '"><img src="'. $video_thumbnail . '" alt="' . $alttext . '" /></a>';
							            } */
							            echo '<h3 class="cattitle"><a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a></h3>';
							            echo '<h4><a href="'. get_permalink() . '">' . get_the_title() . '</a></h4>';
							            echo '</li>';
									}
									
								}
								
							}
							echo '</ul></div>';
						}
						?>

						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
