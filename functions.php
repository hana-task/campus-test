<?php
require_once locate_template('acf-fields/course-fields.php');
require_once locate_template('acf-fields/tag-fields.php');



add_action('wp_enqueue_scripts', 'site_styles', 200);
 function site_styles(){

//     wp_enqueue_style( 'bootstrap', get_bloginfo('stylesheet_directory')  . '/assets/css/bootstrap.min.css', array(), null, true );
//     wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
     wp_enqueue_style('style.css', get_bloginfo('stylesheet_directory') . '/assets/css/style.css');
     wp_enqueue_script('ready', get_bloginfo('stylesheet_directory') . '/assets/js/ready.js', array(), null, true);

     wp_localize_script('ready', 'globalVars', array(
         'ajaxurl' => admin_url('admin-ajax.php')
     ));
 }




add_action('init', 'create_post_types');
function create_post_types()
{
register_post_type(
    'course',
    array(
        'labels' => return_labels('קורס', 'קורסים'),
        'public' => true,
        'show_in_rest' => false,
        'menu_icon' => 'dashicons-image-filter',
        'hierarchical' => true,
        'supports' => array('title', 'thumbnail', 'excerpt'),
    )
);

register_taxonomy(
        'tag',
        'course',
        array(
            'labels' => return_labels('תג', 'תגיות'),
            'show_in_rest' => true,
            'hierarchical' => true,
        )
    );
}
function courses_filter(){
  $tags = $_POST['tags'];
    $args = array(
        'post_type' => 'course',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'tag',
                'terms' => $tags,
                'field' => 'term_id',
            )
        ),
        'taxonomy'  => 'tag',
    );

    $courses = get_posts($args);
    $html = '';
    foreach ($courses as $course){
        $html.=draw_course($course);
    }
    echo $html;
    die();
}

add_action('wp_ajax_courses_filter', 'courses_filter');
add_action('wp_ajax_nopriv_courses_filter', 'courses_filter');

function draw_course($course){
    $bgImage = get_field('image',$course->ID);
    $tags = get_the_terms( $course->ID, 'tag' );

    $tagNames ='';
    foreach ($tags as $tag){
        $tagNames.=$tag->name.',';
    }
    $tagNames = substr($tagNames, 0, -1) ;
    $output='<div class="course-item col-12 col-sm-4"> <div class="course-inner">
    <a href="'.get_permalink($course->ID).'" class="course-img" style="background-image: url('.$bgImage.')"></a>
    <a href="'.get_permalink($course->ID).'" class="course-item-details">
    <h3>'.$course->post_title.'</h3>
    <p class="course-items">'.$tagNames.'</p>
    </a>
    </div>
    </div>';

    return $output;
}