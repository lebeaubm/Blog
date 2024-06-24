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

function my_first_taxonomy()
{

			$args = array(

					'labels' => array(
							'name' => 'Brands',
							'singular_name' => 'Brand',
					),

					'public' => true,
					'hierarchical' => true,

			);


			register_taxonomy('brands', array('cars'), $args);

}
add_action('init', 'my_first_taxonomy');






// Hook to handle AJAX requests for logged-in users
add_action('wp_ajax_enquiry', 'enquiry_form');
// Hook to handle AJAX requests for non-logged-in users
add_action('wp_ajax_nopriv_enquiry', 'enquiry_form');

function enquiry_form()
{
if(  !wp_verify_nonce( $_POST['nonce'], 'ajax-nonce' )  )
{
wp_send_json_error('Nonce is incorrect', 401);
die();
}


// Parse the form data
$formdata = [];
wp_parse_str($_POST['enquiry'], $formdata);

// Admin email
$admin_email = get_option('admin_email');


// Email headers
$headers[] = 'Content-Type: text/html; charset=UTF-8';
$headers[] = 'From: My Website <' . $admin_email . '>';
$headers[] = 'Reply-to:' . $formdata['email'];

// Who are we sending the email to?
$send_to = $admin_email;

// Subject
$subject = "Enquiry from " . $formdata['fname'] . ' ' . $formdata['lname']; 

// Message
$message = '';

// Try to send the email and handle any exceptions
foreach($formdata as $index => $field)
{
$message .= '<strong>' . $index . '</strong>: ' . $field . '<br />';
}


try {

if( wp_mail($send_to, $subject, $message, $headers) )
{
wp_send_json_success('Email sent');
}
else {
wp_send_json_error('Email error');
}
} catch (Exception $e)
{
wp_send_json_error($e->getMessage());
}
wp_send_json_success( $formdata['fname'] );
}


