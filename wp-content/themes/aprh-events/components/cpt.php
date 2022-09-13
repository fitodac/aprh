<?php 


function cptui_register_my_cpts(){

	
	$cpt_supports = array("title", "editor");


	/**
	 * Post Type: Eventos.
	 */

	$labels = array(
		"name" => __( 'Eventos', 'aprh' ),
		"singular_name" => __( 'Evento', 'aprh' ),
	);

	$args = array(
		"label" => __( 'Eventos', 'aprh' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "eventos", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-tickets-alt",
		"supports" => $cpt_supports,
	);

	register_post_type( "eventos", $args );

	/**
	 * Post Type: Congresos.
	 */

	$labels = array(
		"name" => __( 'Congresos', 'aprh' ),
		"singular_name" => __( 'Congreso', 'aprh' ),
	);

	$args = array(
		"label" => __( 'Congresos', 'aprh' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "congresos", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 6,
		"menu_icon" => "dashicons-businessman",
		"supports" => $cpt_supports,
	);

	register_post_type( "congresos", $args );

	/**
	 * Post Type: Boletines.
	 */

	$labels = array(
		"name" => __( 'Boletines', 'aprh' ),
		"singular_name" => __( 'Boletín', 'aprh' ),
	);

	$args = array(
		"label" => __( 'Boletines', 'aprh' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "boletines", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 7,
		"menu_icon" => "dashicons-media-default",
		"supports" => $cpt_supports,
	);

	register_post_type( "boletines", $args );



	/**
	 * Post Type: Galeria.
	 */

	$labels = array(
		"name" => __( 'Galerias', 'aprh' ),
		"singular_name" => __( 'Galeria', 'aprh' ),
	);

	$args = array(
		"label" => __( 'Galerias', 'aprh' ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "galerias", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 5,
		"menu_icon" => "dashicons-images-alt2",
		"supports" => $cpt_supports,
	);

	register_post_type( "galerias", $args );

}

add_action( 'init', 'cptui_register_my_cpts' );





