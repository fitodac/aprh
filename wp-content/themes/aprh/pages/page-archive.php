<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */

// Template Name: archive

get_header(); 



if( get_field('post_type') ):
	$args = array(
		'post_type' => get_field('post_type')
	);

else:
	$args = array();
endif;


$the_query = new WP_Query( $args );
?>


<main id="main" role="main">
<?php //the_field('layout'); ?>

<?php if( $the_query->have_posts() ): 

	/*----------------------------------------------*/
	/*	LIST
	/*----------------------------------------------*/
	if( get_field('layout') === 'list' ):

		/* Start the Loop */
		while( $the_query->have_posts() ) : $the_query->the_post(); 
			$d = get_the_date('d');
			$m = get_the_date('F');
			$y = get_the_date('Y'); 
			?>

			<article id="post-<?php the_ID(); ?>" data-aos="fade-up">
				<div class="container">

					<div class="row">
						<?php if( get_field('image') ) : ?>
						<div class="col-md-3 col-sm-5">
							<a class="post-thumbnail" href="<?php the_permalink(); ?>">
								<img src="<?php echo get_field('image')['sizes']['medium']; ?>" class="img-responsive">
							</a><!-- post-thumbnail end -->
						</div><!-- col end -->
						<?php endif; ?>


						<div class="<?php echo get_field('image') ? 'col-md-9 col-sm-7' : 'col-sm-12'; ?>">
							
							<h3 class="post-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>


							<div class="post-date">
								<span class="ti-calendar"></span>
								<?php echo $d .' de '. $m .', '. $y; ?>
							</div><!-- post-date end -->


							<div class="post-content">
								<?php the_excerpt(); ?>
							</div><!-- post-content end -->

						</div><!-- col end -->
					</div><!-- row end -->
					
				</div><!-- container end -->
			</article>

		<?php endwhile;



	/*----------------------------------------------*/
	/*	2 COLUMNS
	/*----------------------------------------------*/
	elseif( get_field('layout') === 'cols_2' ): ?>

	<div class="container">
		<div class="row archive-2-columns">
		<?php /* Start the Loop */
		while( $the_query->have_posts() ) : $the_query->the_post(); 
			// $d = get_the_date('d');
			// $m = get_the_date('F');
			// $y = get_the_date('Y'); 
			?>

			<div class="col-sm-6">
				<article id="post-<?php the_ID(); ?>">

					<?php if( get_field('image') ) : ?>
					<a class="post-thumbnail" href="<?php the_permalink(); ?>">
						<img src="<?php echo get_field('image')['sizes']['medium_large']; ?>">
					</a><!-- post-thumbnail end -->
					<?php endif; ?>

					<h3 class="post-title">
						<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</h3>

					<div class="post-content">
						<?php the_excerpt(); ?>
					</div><!-- post-content end -->

				</article>
			</div><!-- col end -->

		<?php endwhile; ?>
		</div><!-- row end -->
	</div><!-- container end -->




	<?php 
	/*----------------------------------------------*/
	/*	GALERIA
	/*----------------------------------------------*/
	elseif( get_field('layout') === 'gallery_grid' ): ?>

	<div class="container gallery-page">
		<div class="row masonry-layout">
		<?php /* Start the Loop */
		while( $the_query->have_posts() ) : $the_query->the_post();

			$counter = 0;
			$gallery = get_field('gallery');

			foreach($gallery as $img): 

				if( $counter === 0 ): ?>
				<div class="col-md-3 col-sm-4 col-ms-6">
					<article id="post-<?php the_ID(); ?>" class="gallery-item">
						<a href="<?php the_ID(); ?>">
							<img src="<?php echo $img['sizes']['medium']; ?>" alt="<?php echo $img['title'] ?>" class="img-responsive">
						</a>

						<h5><a href="<?php the_ID(); ?>"><?php the_title(); ?></a></h5>

						<?php the_content(); ?>
					</article>
				</div><!-- col end -->
				<?php endif;
			
			$counter++;
			endforeach; ?>


			<!-- <pre> -->
			<?php 
			// var_dump( get_field('gallery') ); 
			?>
			<!-- </pre> -->


		<?php endwhile; ?>
		</div><!-- row end -->
	</div><!-- container end -->


	<div class="gallery-lightbox"></div>

	<?php endif;

else :

	get_template_part( 'components/post/content', 'none' );

endif; ?>

</main>

<?php
get_footer();
