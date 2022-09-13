<?php get_header(); ?>


<section class="hero" data-aos="fade-down" data-aos-delay="900">
	<svg class="brand-white"><use xlink:href="#brand-white"></use></svg>
	
	<div class="discover">
		<span>conocé más</span>
		<i class="ti-angle-down"></i>
	</div><!-- discover end -->

	<video class="hue-1" poster="<?php echo get_template_directory_uri(); ?>/assets/images/water.jpg" playsinline autoplay muted loop>
		<source src="<?php echo get_template_directory_uri(); ?>/assets/video/water.webm" type="video/webm">
		<source src="<?php echo get_template_directory_uri(); ?>/assets/video/water.mp4" type="video/mp4">
	</video>

</section><!-- hero end -->




<?php 
$args = array(
	'posts_per_page'   => 10,
	'post_type'        => 'post'
);

$the_query = new WP_Query( $args );

if( $the_query->have_posts() ): ?>

<section id="news" data-aos="zoom-in-up">
	<div class="container container-sm">
		<div class="row">
			<div class="col-sm-6">
				<figure class="news-static-image">
					<div class="h3">Noticias</div>
				</figure>				
			</div><!-- col end -->


			<div class="col-sm-6">
				<div class="news-slider owl-carousel owl-controls-dark">
				<?php while( $the_query->have_posts() ) : $the_query->the_post(); 

					$d = get_the_date('d');
					$m = get_the_date('M');
					$y = get_the_date('Y');
					?>
					
					<div>
						<header>
							<div class="title"><?php the_title(); ?></div>
							<div class="date">
								<span class="d"><?php echo $d; ?></span>
								<span class="m"><?php echo $m; ?></span>
								<span class="y"><?php echo $y ?></span>
							</div><!-- date end -->
						</header>

						<div class="excerpt">
							<?php echo wp_trim_words(get_the_content(), 50); ?>

							<footer>
								<a href="<?php the_permalink(); ?>" class="read-more btn btn-link btn-sm">
									<i class="ti-plus"></i> SEGUIR LEYENDO</a>
							</footer>

						</div><!-- excerpt end -->
					</div>

				<?php endwhile; ?>

				</div><!-- news-slider end -->
				
				<a href="<?php echo get_page_link(69); ?>" class="btn btn-default link-to-news">NOTICIAS</a>
			</div><!-- col end -->
		</div><!-- row end -->
	</div><!-- container end -->
</section>

<?php endif;

wp_reset_query(); ?>




<?php 
$the_query = new WP_Query( 'pagename=aprh' ); 
?>

<section id="about" data-aos="zoom-in-up">
	<div class="container container-sm">
		<div class="row">
			<div class="col-md-10 col-md-push-1">
				<div class="row">

					<div class="col-lg-7 col-md-6 col-sm-8">
						<div class="h2">Que es la APRH?</div>

						<div class="content">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post();
								the_content();
							endwhile; ?>
						</div><!-- content end -->
					</div><!-- col end -->

				</div><!-- row end -->
			</div><!-- col end -->
		</div><!-- row end -->
	</div><!-- container end -->
</section>

<?php wp_reset_query(); ?>






<?php 
$args = array(
	'posts_per_page'   => 12,
	'post_type'        => 'eventos'
);

$the_query = new WP_Query( $args );


if( $the_query->have_posts() ): ?>

<section id="events" data-aos="zoom-in-up">
	<div class="container-fluid">
		<div class="events-slider-wrapper">
			<div class="h2">EVENTOS</div>

			<div class="events-slider owl-carousel owl-controls-dark">
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); 

				$image = get_field('image');
				$date = explode('/', get_field('fecha_del_evento'));
				$d = $date[0];
				$m = getShortMonth($date[1]);
				$y = $date[2];
				?>
				
				<div class="item">
					<div class="img-featured">
						<header>
							<div class="title"><?php the_title(); ?></div>
							<a href="<?php the_permalink(); ?>" class="btn btn-block">VER MÁS</a>
						</header>
						<div class="date">
							<span class="d"><?php echo $d; ?></span>
							<span class="m"><?php echo $m; ?></span>
							<span class="y"><?php echo $y; ?></span>
						</div>
						<img src="<?php echo $image['sizes']['medium']; ?>" alt="<?php echo $image['title'] ?>">
					</div>
					<div class="excerpt">
						<?php echo wp_trim_words(get_the_content(), 30); ?>
					</div><!-- excerpt end -->
				</div>

				<?php endwhile; ?>

			</div><!-- events-slider end -->

		</div><!-- events-slider-wrapper end -->
	</div><!-- container end -->
</section>

<?php endif;

wp_reset_query(); ?>




<?php get_footer(); ?>








