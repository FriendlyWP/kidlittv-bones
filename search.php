<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="main-content cf" role="main">
							
						<h1 class="archive-title"><span><?php _e( 'Search Results for:', 'bonestheme' ); ?></span> <?php echo esc_attr(get_search_query()); ?></h1>

						<?php if (have_posts()) :  ?>
							
								<div id="masonry-loop">

								<?php while (have_posts()) : the_post(); ?>

									<?php // get_template_part( 'content', 'masonry'); ?>
									<?php
									if ( has_term( 'kidlit-kibbles','posttype' ) ) {
										get_template_part( 'post-formats/format', 'aside' );
									} elseif ( has_term('kltv-exclusives' , 'posttype' ) ) {
										get_template_part( 'post-formats/format', 'video' );
									} else {
										get_template_part( 'post-formats/format', '' );
									}

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
												<p><?php _e( 'This is the error message in the search.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

							<?php get_sidebar(); ?>

					</div>

			</div>

<?php get_footer(); ?>
