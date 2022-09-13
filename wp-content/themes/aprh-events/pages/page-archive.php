<?php
/**

	Template name: Archivos

 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */

get_header();

date_default_timezone_set('UTC');

$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'files'
);

$the_query = new WP_Query( $args );

?>



<div class="container">
	<h1 class="upper"><?php the_title(); ?></h1>
	<?php the_content(); ?>
</div><!-- container end -->


<?php if( $the_query->have_posts() ): ?>
	<div class="downloads container">			
		<div class="row">
			<?php 
			while( $the_query->have_posts() ) : $the_query->the_post(); 
			?>

				<div class="col-lg-3 col-md-4 col-sm-6 col-ms-6">
					<div class="card">
						<header class="card-block">
							<small class="date">Subido el <?php echo get_the_date('j').'.'.get_the_date('m').'.'.get_the_date('Y'); ?></small>
							<?php if( get_field('file') ): 
								echo extensionFile(get_field('file')['filename']); 
							else:
								echo extensionFile('*.video'); 
							endif; ?>
							<h3><?php the_title(); ?></h3>
						</header><!-- card-block end -->

						<div class="card-block text-center">
							<?php if( get_field('file') ): ?>
								<a href="<?php echo get_field('file')['url']; ?>" class="btn" target="_blank">Descargar</a>
							<?php endif; ?>

							<?php if( get_field('link') ): ?>
								<a href="<?php echo get_field('link'); ?>" class="btn" target="_blank">Descargar</a>
							<?php endif; ?>
						</div><!-- card-block end -->


					</div><!-- card end -->
				</div><!-- col end -->

			<?php endwhile; ?>
		</div><!-- row end -->
	</div><!-- container end -->
<?php endif; ?>


<?php get_footer();







