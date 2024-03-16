<?php 
	 add_action( 'wp_enqueue_scripts', 'ikonic_assessment_enqueue_styles' );
	 function ikonic_assessment_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 



// Block 77.29 ip Address from website
add_action('init', 'redirect_users_by_ip');

function redirect_users_by_ip() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    print_r($user_ip);
    if (strpos($user_ip, '77.29') == 0) {
        wp_redirect('https://ikonicsolution.com/');
        exit;
    }
}



 ?>