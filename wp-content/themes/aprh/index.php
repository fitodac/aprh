<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */

get_header(); ?>


<main id="main" role="main">

<?php
if( have_posts() ):

	/* Start the Loop */
	while ( have_posts() ) : the_post(); ?>
	<div class="container">
		<?php 
			/*
			 * Include the Post-Format-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'components/post/content', get_post_format() ); ?>
	</div><!-- container end -->

	<?php endwhile;

	numeric_pagination();


else :

	get_template_part( 'components/post/content', 'none' );

endif; ?>

</main>

<?php
get_footer();



