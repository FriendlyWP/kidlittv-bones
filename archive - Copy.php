<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="main-content cf" role="main">

							<header class="page-header">
								<?php if ( function_exists('yoast_breadcrumb') ) {
								yoast_breadcrumb('<p id="breadcrumbs">','</p>');
							} ?>
							
								<?php if (is_category()) { ?>
									<h1 class="page-title">
										<?php single_cat_title(); ?>
									</h1>

								<?php } elseif (is_tag()) { ?>
									<h1 class="page-title">
										<span><?php _e( 'Posts Tagged:', 'bonestheme' ); ?></span> <?php single_tag_title(); ?>
									</h1>

								<?php } elseif (is_author()) {
									global $post;
									$author_id = $post->post_author;
								?>
									<h1 class="page-title">

										<span><?php _e( 'Posts By:', 'bonestheme' ); ?></span> <?php the_author_meta('display_name', $author_id); ?>

									</h1>
								<?php } elseif (is_day()) { ?>
									<h1 class="page-title">
										<span><?php _e( 'Daily Archives:', 'bonestheme' ); ?></span> <?php the_time('l, F j, Y'); ?>
									</h1>

								<?php } elseif (is_month()) { ?>
										<h1 class="page-title">
											<span><?php _e( 'Monthly Archives:', 'bonestheme' ); ?></span> <?php the_time('F Y'); ?>
										</h1>

								<?php } elseif (is_year()) { ?>
										<h1 class="page-title">
											<span><?php _e( 'Yearly Archives:', 'bonestheme' ); ?></span> <?php the_time('Y'); ?>
										</h1>
								<?php } elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
								$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  ?>
								    		<h1 class="page-title">
								    	    		KiLit Kibbles
								        	</h1>
								<?php } elseif ( is_tax( 'post_format', 'post-format-video' ) ) { 
									$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
								    		<h1 class="page-title">
								    	    		KLTV Exclusives
								        	</h1>
								<?php } elseif ( is_tax() || is_category() ) { ?>
								    	<?php 
								    	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
								    	$title = $term->name; ?>
								    		<h1 class="page-title">
								    	    		<?php echo $title; ?>
								        	</h1>
								        	<?php if ( $term->description !== '' ) { ?>
							                   	<div class="cat-desc"><?php echo $term->description; ?></div>
						                    <?php } ?>

						                    <?php 
						                    $current_cat_id = get_query_var('cat');
											echo '<ul class="subcat-list">';
											wp_list_categories('orderby=name&title_li=&use_desc_for_title=0&show_option_none=&child_of=' . $current_cat_id );
											echo '</ul>';
											?>
								    <?php } elseif ( is_post_type_archive() ) { ?>
								    	<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
								    <?php } ?>

								<?php if (is_category() && category_description()) { ?>
				                   	<div class="cat-desc"><?php echo category_description(); ?></div>
				                <?php } ?>

				                
			                </header>

							<?php if (have_posts()) :  ?>
							
							<?php 

							if ( !(is_tax( 'post_format', 'post-format-aside' ) || is_tax( 'post_format', 'post-format-video' ) ) ) {
								$current_cat_id = get_query_var('cat');
											echo '<ul class="subcat-list">';
											wp_list_categories('orderby=name&title_li=&use_desc_for_title=0&show_option_none=&child_of=' . $current_cat_id );
											echo '</ul>';
							}
							?>
								<div id="masonry-loop">

								<?php while (have_posts()) : the_post(); ?>

									<?php // get_template_part( 'content', 'masonry'); ?>
									<?php
										get_template_part( 'post-formats/format', get_post_format() );
									?>

								<?php endwhile; ?>
								</div>

									<?php bones_page_navi(); ?>

							<?php else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the archive.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
