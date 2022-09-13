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

	<?php if(is_front_page()):
		get_template_part( 'pages/page', 'frontpage' );

	else: ?>

		<div class="container">
			<h1 class="upper"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>

	<?php endif; ?>

</main>


<?php get_footer();




