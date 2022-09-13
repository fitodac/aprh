<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */

get_header(); ?>


<main id="main" role="main">
	<div class="container">

	<?php while( have_posts() ) : the_post(); ?>


		<?php the_content(); ?>
		<div class="section-spacer"></div>



		<?php if( have_rows('page_sections') ):
			while ( have_rows('page_sections') ) : the_row();

				if( get_row_layout() == 'gallery' ):
					get_template_part( 'components/pages/content', 'gallery' );

				// the_sub_field('text');

				elseif( get_row_layout() == 'spacer' ): 
					get_template_part( 'components/pages/content', 'spacer' );

				elseif( get_row_layout() == 'section_tabs' ): 
					get_template_part( 'components/pages/content', 'tabs' );

				elseif( get_row_layout() == 'section_title' ): 
					get_template_part( 'components/pages/content', 'title' );

				elseif( get_row_layout() == 'textarea' ): 
					get_template_part( 'components/pages/content', 'wysiwyg' );

				// $file = get_sub_field('file');

				endif;

			endwhile;
		endif;



	endwhile; // End of the loop.


	// echo '<pre>';
	// var_dump( get_field('page_sections') );
	// echo '</pre>';
	?>

	</div><!-- container end -->
</main>


<?php get_footer();




