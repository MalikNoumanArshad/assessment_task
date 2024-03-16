<?php 
	 add_action( 'wp_enqueue_scripts', 'ikonic_assessment_enqueue_styles' );
	 function ikonic_assessment_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 



// Block 77.29 ip Address from website
add_action('init', 'redirect_users_by_ip');

function redirect_users_by_ip() {
    $user_ip = $_SERVER['REMOTE_ADDR'];
    if (strpos($user_ip, '77.29') == 0) {
        // wp_redirect('https://ikonicsolution.com/');
        // exit;
    }
}


// Create a  post type Projects
add_action('init', function() {
    register_post_type('projects', [
        'labels' => ['name' => __('Projects'), 'singular_name' => __('Project')],
        'public' => true,
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions', 'page-attributes', 'post-formats', 'paged' ),
        'taxonomies' => ['project_type'],
        'rewrite' => ['slug' => 'projects']
    ]);
});

// Create a taxonomy of post type Projects
add_action('init', function() {
    register_taxonomy('project_type', 'projects', [
        'label' => __('Project Type'),
        'hierarchical' => true,
        'public' => true,
        'rewrite' => ['slug' => 'project-type']
    ]);
});



 ?>