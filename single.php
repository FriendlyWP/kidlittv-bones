<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

					<div id="main" class="main-content cf" role="main">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php
								get_template_part( 'post-formats/format', get_post_format() );
							?>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

						<div class="postnav cf">
							<?php $prev_post = get_previous_post(TRUE);
								if (!empty( $prev_post )) { ?>
								<div class="prevpost">
									<?php if (has_post_thumbnail($prev_post->ID) ) { ?>
										<a class="thumbimg" href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo get_the_post_thumbnail($prev_post->ID, 'tiny-thumb'); ?></a>
										<span>
											<h6>Previous</h6>
											<a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a>
										</span>
									<?php } ?>
 								</div>
 							<?php } ?>

							<?php $next_post = get_next_post(TRUE);
								if (!empty( $next_post )) { ?>
								<div class="nextpost">
									<?php if (has_post_thumbnail($next_post->ID) ) { ?>
										<a class="thumbimg" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo get_the_post_thumbnail($next_post->ID, 'tiny-thumb'); ?></a>
										<span>
											<h6>Next</h6>
											<a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a>
										</span>
									<?php } ?>
 								</div>
 							<?php } ?>
							
						</div><!-- .postnav -->

					</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
