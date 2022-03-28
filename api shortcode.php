<?php
/**
 * Plugin Name: Custom API Plugin
 * Description: Handle the custom functions for site.
 */

 defined( 'ABSPATH' ) || die( 'Unauthorized access' );

// Action when user logs into admin panel
add_shortcode('external_data', 'callback_function_name');

function callback_function_name() {
	

	 $url = 'https://jsonplaceholder.typicode.com/users';

	 $arguments = array(
		'method' => 'GET',
	 );

	 $response = wp_remote_get( $url, $arguments, );

	 if ( is_wp_error( $response ) ) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	 }

	$results = json_decode( wp_remote_retrieve_retrieve_body( $response ) );
	 var_dump($response);

	$html = '';
	$html = '<table>';

	$html = '<tr>';
	$html = '<td>id</td>';
	$html = '<td>Name</td>';
	$html = '<td>Username</td>';
	$html = '<td>Email</td>';
	$html = '</tr>';

	 foreach( $results as $result ) {
		 
		$html = '<tr>';
		$html = '<td>' . $result->id . '</td>';
		$html = '<td>' . $result->name . '</td>';
		$html = '<td>' . $result->username . '</td>';
		$html = '<td>' . $result->email . '</td>';
		$html = '</tr>';
		$html = '</table>';
	 }
	

	
	return $html;
}