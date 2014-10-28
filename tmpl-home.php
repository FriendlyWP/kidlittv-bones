<?php
/*
Template Name: Home Page
*/

get_header(); 
?>
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="main-content cf" role="main">

						<?php get_template_part('content', 'flexslider'); ?>

						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
