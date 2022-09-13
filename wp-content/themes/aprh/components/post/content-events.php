<?php
/**
 * Template part for displaying events posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aprh
 */

$date = explode('/', get_field('fecha_del_evento'));
$d = $date[0];
$m = getFullMonth($date[1]);
$y = $date[2];
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row">


			<div class="col-sm-6 col-sm-push-6">
				<h1><?php the_title(); ?></h1>

				<?php if( get_field('image') ): ?>
					<figure class="featured-image">
						<img src="<?php echo get_field('image')['url']; ?>" class="img-responsive">
					</figure><!-- featured-image end -->
				<?php endif; ?>

				<div class="content"><?php the_content(); ?></div>

				<footer>
					<div class="addthis_sharing_toolbox"></div>
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-511b90fd67e9a7b9"></script> 
				</footer>
			</div><!-- col end -->





			<div class="col-sm-6 col-sm-pull-6">
				<div class="row row-date">

					<div class="col-md-4">
						<!-- DATE -->
						<div class="date">
							<span class="m"><?php echo $m; ?></span>
							<span class="d"><?php echo $d; ?></span>
							<span class="y"><?php echo $y; ?></span>
						</div><!-- date end -->
					</div><!-- col end -->

				</div><!-- row end -->



				<!-- DETAILS -->
				<?php if( have_rows('details') ): ?>
					<div class="details">
						<div class="h5">DETALLES</div>
	    			
	    			<dl class="dl-horizontal">
							<?php while( have_rows('details') ) : the_row(); ?>
								<dt><?php the_sub_field('item'); ?></dt>
	  						<dd><?php the_sub_field('description'); ?></dd>
	    				<?php endwhile; ?>
	    			</dl>
	    		</div><!-- details end -->
				<?php endif; ?>



				
				<!-- ADDRESS -->
				<?php if( get_field('address') || get_field('map') ): ?>
					<div class="h5">DIRECCIÓN</div>
				<?php endif ?>

				<?php if( get_field('address') ): ?>
					<div class="address">
						<span class="ti-location-pin"></span>
						<?php the_field('address'); ?>
					</div><!-- address end -->
				<?php endif ?>




				<!-- MAP -->
				<?php if( get_field('map') ): ?>
				<div class="gmap" data-lat="<?php echo get_field('map')['lat']; ?>" data-lng="<?php echo get_field('map')['lng']; ?>" data-zoom="<?php echo get_field('map_zoom'); ?>"></div>
				<?php endif ?>
			</div><!-- col end -->


		</div><!-- row end -->


	</div><!-- container end -->
</article>









