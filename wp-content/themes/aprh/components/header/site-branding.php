<?php
if ( is_front_page() || is_home() ) : ?>
	<h1 class="navbar-brand">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<svg><use xlink:href="#brand"></use></svg>
			<span class="sr-only"><?php bloginfo( 'name' ); ?></span>
		</a>
	</h1>
<?php else : ?>
	<p class="navbar-brand">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<svg><use xlink:href="#brand"></use></svg>
			<span class="sr-only"><?php bloginfo( 'name' ); ?></span>
		</a>
	</p>
<?php
endif;

$description = get_bloginfo( 'description', 'display' );
if ( $description || is_customize_preview() ) : ?>
	<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
<?php
endif; ?>