<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */



date_default_timezone_set('UTC');

$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'schedule'
);

$the_query = new WP_Query( $args );


if( $the_query->have_posts() ): ?>

	<div id="programa"></div>

	<div class="container">
		<div id="schedule">
			<div class="h2">PROGRAMA</div>

			<?php 
			while( $the_query->have_posts() ) : $the_query->the_post(); 
				$date = explode('/', get_field('date'));
				$start = get_field('start');
				$ends = get_field('ends');
				?>

				<div class="card" data-aos="fade-up">
					<div class="clearfix">
						<div class="date">
							<small><?php echo $date[0]; ?></small>
							<span><?php echo $date[1]; ?></span>
							<small><?php echo $start; ?> a <?php echo $ends; ?></small>
						</div><!-- date end -->

						<a href="#program-<?php the_ID(); ?>" data-toggle="collapse" data-parent="#schedule" class="h4"><?php the_title(); ?></a>
					</div><!-- clearfix end -->


					<div id="program-<?php the_ID(); ?>" class="panel-collapse collapse">
						<div class="card-block"><?php the_content(); ?></div><!-- card-block end -->

						<div class="card-block">
							<div class="row">
								<div class="col-sm-8 col-sm-push-2 p-b-lg">
									<div class="row">
										<div class="col-sm-6 clearfix">
											<a href="#inscripciones" class="btn btn-success btn-join">QUIERO ASISTIR</a>
										</div><!-- col end -->

										<div class="col-sm-6">
											<a href="mailto:<?php echo get_field('main_email','option'); ?>?subject=Quiero recibir información&body=<?php echo htmlspecialchars(get_field('main_email_body','option')); ?>" class="btn btn-link">
												<i class="icon-envelope-letter"></i> 
												<span>Quiero recibir más información</span>
											</a>
										</div><!-- col end -->
									</div><!-- row end -->
								</div><!-- col end -->
							</div><!-- row end -->
						</div><!-- card-block end -->
					</div><!-- program end -->

				</div><!-- card end -->

			<?php endwhile; ?>
		</div><!-- schedule end -->
	</div><!-- container end -->
<?php endif; 

wp_reset_query();
?>




<?php 
if( get_page_by_title('Archivos') ):
	$archivos = get_page_by_title('Archivos');
	$downloads = get_page_link($archivos->ID);
	?>

	<a href="<?php echo $downloads ?>" class="downloads-banner" data-aos="zoom-out">

		<div class="container">
			<div class="banner">
				<svg class="download-icon"><use xlink:href="#downloads"></use></svg>
				<div class="h3"><?php the_field('download_title'); ?></div>
				<?php the_field('download_text'); ?>
			</div>
		</div><!-- container end -->

		<video class="" poster="<?php echo get_template_directory_uri(); ?>/assets/images/cloud-2.png" playsinline autoplay muted loop>
			<source src="<?php echo get_template_directory_uri(); ?>/assets/video/clouds.webm" type="video/webm">
			<source src="<?php echo get_template_directory_uri(); ?>/assets/video/clouds.mp4" type="video/mp4">
		</video>

	</a><!-- downloads-banner end -->


<?php endif; ?>






