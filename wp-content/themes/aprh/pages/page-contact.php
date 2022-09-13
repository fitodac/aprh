<?php 
// Template Name: contacto

get_header();

?>


<div 
	class="gmap" 
	data-lat="<?php echo get_field('map')['lat']; ?>" 
	data-lng="<?php echo get_field('map')['lng']; ?>" 
	data-zoom="16"></div>


<section class="container container-sm">
	<div class="row">
		<div class="col-md-5 col-md-push-7 col-sm-5 col-sm-push-7 col-ms-8 col-ms-offset-2">

			<div class="contact-form" data-aos="fade-up">
				<h2><?php the_title(); ?></h2>
				
				<?php the_field('form_id'); ?>
			</div><!-- contact-form end -->

		</div><!-- col end -->
	</div><!-- row end -->
</section>


<?php get_footer(); ?>