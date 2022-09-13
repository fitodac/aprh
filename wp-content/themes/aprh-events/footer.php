<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aprh
 */

$address = get_field('address', 'options');
?>


	<div id="inscripciones"></div>

	<div class="container" data-aos="fade-up">
		<div class="row">
			<div class="col-sm-8 col-sm-push-2">

				<div class="form-join">
					<div class="h1">INSCRIPCIÓN</div>
					<header>
						<?php the_field('join_form_text', 'option'); ?>
					</header>
					<div data-aos="fade-up">
					<?php echo do_shortcode('[contact-form-7 id="34"]'); ?>
					</div>
				</div><!-- form-join end -->

			</div>
		</div><!-- row end -->
	</div><!-- container end -->





	<footer class="main-footer" role="contentinfo" data-aos="fade-up">
		<div class="container">
			<svg class="brand"><use xlink:href="#brand-gray"></use></svg>
			<div class="address">
				<?php echo $address; ?>
				&copy;2013 APRH. Todos los Derechos Reservados
			</div><!-- address end -->
		</div><!-- container end -->
	</footer>

</main>

<?php wp_footer(); ?>

</body>
</html>
