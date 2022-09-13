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
