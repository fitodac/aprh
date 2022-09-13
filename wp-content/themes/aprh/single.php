<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package aprh
 */

get_header(); ?>

<main id="main" role="main">
	<div class="container">

	<?php 
	while ( have_posts() ) : the_post(); 
		
		if( get_post_type() === 'eventos' ): 
			get_template_part( 'components/post/content', 'events' ); 
		else: ?>

			<div class="nav-posts">
			<?php 
			previous_post_link('%link', '<i class="ti-angle-left"></i>');
			next_post_link('%link', '<i class="ti-angle-right"></i>');
			?>
			</div>

			<?php get_template_part( 'components/post/content', get_post_format() ); 
		endif;

	endwhile; // End of the loop.
	?>

	</div><!-- container end -->
</main>

<?php
// get_sidebar();
get_footer();
