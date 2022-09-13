<?php 
if( !defined('ABSPATH') ) exit; 

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lhmoney
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
	</head>

<body <?php body_class(); ?>>
	<?php get_template_part('assets/svg/inline','sprite.svg'); ?>

	<header class="main-header" role="banner">
		<nav class="navbar">
			<div class="container-fluid">

				<div class="navbar-header">
					<button 
					type="button" 
					class="navbar-toggle collapsed" 
					data-toggle="collapse" 
					data-target="#main-navbar">
						<span class="fa fa-bars"></span>
					</button>

					<h1 class="navbar-brand">
						<a href="<?php echo esc_url( home_url('/') ); ?>">
							
							<svg class="brand"><use xlink:href="#brand"></use></svg>

							<span class="sr-only"><?php echo bloginfo( 'name' ); ?></span>
						</a>
					</h1><!-- navbar-brand end -->
				</div><!-- navbar-header end -->



				<div id="main-navbar" class="collapse navbar-collapse">
					<?php 
					// smpx_navbar_left_sidebar(); 

					wp_nav_menu( array(
						'menu' 							=> 'main-menu',
						'theme_location' 		=> 'main-menu',
						'container' 				=> 'ul',
						'menu_class'     		=> 'nav navbar-nav',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'site-header-menu',
						'walker' 						=> new aprh_navbar_walker()
					) );

					// smpx_navbar_right_sidebar(); 
					?>
				</div><!-- collapse end -->


				<!-- <table id="pronostico" style="display:none; text-align:center; width:100%;">
					<tbody>
						<tr><td id="cellDia1" ></td><td id="cellDia2" ></td></tr>
						<tr><td id="cellIcono1"></td><td id="cellIcono2"></td></tr>
						<tr><td id="cellPronostico1"></td><td id="cellPronostico2"></td></tr>
						<tr><td id="cellMinima1"></td><td id="cellMinima2"></td></tr>
						<tr><td id="cellMaxima1"></td><td id="cellMaxima2"></td></tr>
					</tbody>
				</table> -->

				<div class="clima_module">
					
				</div><!-- clima_module end -->

				<div id="climaContent" style="display:none;">
					<?php
					// $página_inicio = file_get_contents('http://www.meteorologia.gov.py/interior.php?depto=11');
					// echo utf8_encode($página_inicio);
					?>
				</div>
				<!-- <p style="font-size:12px;text-align:right;color:blue;font-style:italic"> <a href="http://www.meteorologia.gov.py">Datos provistos por la DMH</a></p> -->

			</div><!-- container end -->
		</nav><!-- navbar end -->
	</header>




<?php if(!is_front_page() && !is_404() && $post->post_name != 'contacto' && get_post_type() != 'eventos' ): ?>
<div class="page-header" 
	<?php 
	if( get_post_type() === 'post' )
		echo 'style="background-image:url('. get_field('news_header_img', 'options')['url'] .');"';
	elseif( get_post_type() === 'eventos' || get_field('post_type') === 'eventos' )
		echo 'style="background-image:url('. get_field('events_header_img', 'options')['url'] .');"'; 
	elseif( get_post_type() === 'boletines' || get_field('post_type') === 'boletines' )
		echo 'style="background-image:url('. get_field('boletines_header_img', 'options')['url'] .');"';
	elseif( get_post_type() === 'congresos' || get_field('post_type') === 'congresos' ) 
		echo 'style="background-image:url('. get_field('congresos_header_img', 'options')['url'] .');"';
	elseif( get_post_type() === 'galerias' || get_field('post_type') === 'galerias' ) 
		echo 'style="background-image:url('. get_field('gallery_header_img', 'options')['url'] .');"'; 
	elseif( is_page() )
		if( get_the_post_thumbnail_url() )
			echo 'style="background-image:url('. get_the_post_thumbnail_url() .');"'; 
	?>>

	<div class="container">
		<h1>
			<?php if( get_post_type() === 'post' ): ?>
				<span>Noticias</span>
			<?php elseif( get_post_type() === 'eventos' ): ?>
				<span>Eventos</span>
			<?php elseif( get_post_type() === 'boletines' ): ?>
				<span>Boletines</span>
			<?php elseif( get_post_type() === 'congresos' ): ?>
				<span>Congresos</span>
			<?php else: ?>
				<span><?php the_title(); ?></span>
			<?php endif; ?>
		</h1>
	</div><!-- container end -->

</div><!-- page-header end -->
<?php endif; ?>





