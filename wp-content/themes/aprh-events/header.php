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

?>

<!DOCTYPE html>
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
					wp_nav_menu( array(
						'menu' 							=> 'main-menu',
						'theme_location' 		=> 'main-menu',
						'container' 				=> 'ul',
						'menu_class'     		=> 'nav navbar-nav',
						'container_class'   => 'collapse navbar-collapse',
						'container_id'      => 'site-header-menu',
						'walker' 						=> new aprh_navbar_walker()
					) );
					?>
				</div><!-- collapse end -->
			</div><!-- container end -->
		</nav><!-- navbar end -->
	</header>




<?php 
$heroBg = get_field('main_header_image','option'); 

if(!$heroBg){
	$heroBg['url'] = get_template_directory_uri().'/assets/images/summer-rocks-trees-river.jpg';
} 
?>


<section class="hero">

	<div class="hero-parallax" data-parallax="scroll" data-image-src="<?php echo $heroBg['url']; ?>"></div>

	<div class="container">
		<div class="row">

			<div class="col-md-5">
				<?php if(is_front_page()): ?>
					<h1 class="site-title">
				<?php else: ?>
					<div class="site-title">
				<?php endif; ?>
					<div class="header clearfix">
						<span class="event-num"><?php the_field('event_num','options'); ?></span>
						<span class="event-ordinal"><?php the_field('ordinal','options'); ?></span>
						<span class="event-supertitle"><?php the_field('supertitle','options'); ?></span>
						<span class="event-title"><?php the_field('title','options'); ?></span>
					</div><!-- header end -->
					<span class="event-date"><?php the_field('event_date','options'); ?></span>
					<span class="event-location"><?php the_field('event_location','options'); ?></span>
					<span class="event-city"><?php the_field('event_city','options'); ?></span>
				<?php if(is_front_page()): ?>
					</h1>
				<?php else: ?>
					</div>
				<?php endif; ?>
			</div><!-- col end -->

		</div><!-- row end -->
	</div><!-- container end -->
</section><!-- hero end -->



<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-push-6">
			<div class="social">
				<span>Compartí este evento</span>
				<div class="addthis_inline_share_toolbox_py18"></div>
			</div><!-- social end -->
		</div><!-- col end -->
	</div><!-- row end -->
</div><!-- container end -->





<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4db8b2021421c01a"></script> 




