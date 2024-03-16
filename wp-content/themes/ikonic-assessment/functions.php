<?php 
	 add_action( 'wp_enqueue_scripts', 'ikonic_assessment_enqueue_styles' );
	 function ikonic_assessment_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
 		  } 
         
        
           function my_enqueue() {
            wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', array(), null, true);
            wp_localize_script('jquery', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
            wp_enqueue_script( 'ajax-call', '/wp-content/themes/ikonic-assessment/ajax-call.js', array('jquery') );
           
       }
       add_action( 'wp_enqueue_scripts', 'my_enqueue' );
  
    
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

//Create an Ajax endpoint that will output the last three published "Projects" that belong in the "Project Type" 
add_action( 'wp_ajax_nopriv_get_projects', 'get_projects_ajax' );
add_action( 'wp_ajax_get_projects', 'get_projects_ajax' );

function get_projects_ajax() {
    $projects_count = is_user_logged_in() ? 6 : 3;
    $projects_args = array(
        'post_type'      => 'projects',
        'posts_per_page' => $projects_count,
        'tax_query'      => array(
            array(
                'taxonomy' => 'project_type',
                'field'    => 'slug',
                'terms'    => 'architecture',
            ),
        ),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $projects_query = new WP_Query( $projects_args );

    $projects = array();
    if ( $projects_query->have_posts() ) {
        while ( $projects_query->have_posts() ) {
            $projects_query->the_post();
            $projects[] = array(
                'id'    => get_the_ID(),
                'title' => get_the_title(),
                'link'  => get_permalink(),
            );
        }
        wp_reset_postdata();
    }

    wp_send_json_success( array( 'success' => true, 'data' => $projects ) );
}



 ?>