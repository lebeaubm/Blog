<?php


function load_css()
{

        // points to bootstrap
		wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false, 'all' );
		wp_enqueue_style('bootstrap');

        wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), false, 'all' );
		wp_enqueue_style('main');

	
}

add_action('wp_enqueue_scripts','load_css');



function load_js()
{	
		wp_enqueue_script('jquery');

		wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', 'jquery', false, true);
		wp_enqueue_script('bootstrap');


}
add_action('wp_enqueue_scripts', 'load_js');

//Theme options


function my_first_post_type()
{

	$args = array(


		'labels' => array(

					'name' => 'Cars',
					'singular_name' => 'Car',
		),
		'hierarchical' => true,  //makes it like pages
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-images-alt2',
		'supports' => array('title', 'editor', 'thumbnail','custom-fields'),
		//'rewrite' => array('slug' => 'cars'),	

	);


	register_post_type('cars', $args);


}
add_action('init', 'my_first_post_type');





