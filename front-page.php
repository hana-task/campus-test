<?php
get_header();
global $wp_query, $post;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'course',
    'post_status' => 'publish',
    'posts_per_page' => 10,
    'paged' =>$paged,
);
$results = new WP_Query($args);

$num_pages = $results->max_num_pages;
$htmlCourses='';
if($results->have_posts()) {
    while($results->have_posts())  :
        $results->the_post();
        $htmlCourses.=draw_course($post);
    endwhile;


$total_pages = $results->max_num_pages;

if ($total_pages > 1){

    $current_page = max(1, get_query_var('paged'));

    $pagination =  paginate_links(array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => '?paged=%#%',
        'current' => $current_page,
        'total' => $total_pages,
        'prev_text'    => __('« הקודם'),
        'next_text'    => __('הבא »'),
    ));
}
}


$args = array(
    'hide_empty' => false, // also retrieve terms which are not used yet
    'meta_query' => array(
        array(
            'key'       => 'type',
            'value'     => 'external',
            'compare'   => '='
        )
    ),
    'taxonomy'  => 'tag',
);
$tag_terms = get_terms( $args );
$html_form = '<form id="filter">
<input type="hidden" name="action" value="courses_filter">';
foreach ($tag_terms as $tag_term){
    $id = 'tag'.$tag_term->term_id;
    $html_form .= '<label class="term-filter-search" for="'.$id.'">
<input class="checkbox-filter-search" type="checkbox" data-name="tags" data-value="'.$tag_term->term_id.'" name="tags[]" value="'.$tag_term->term_id.'" id="'.$id.'">
<div class="wrap-term-and-sum"><span class="term-name">'.$tag_term->name.'</span>
        <span class="sum">('.$tag_term->count.')</span></div></label>';
}

$html_form .= '</form>';

?>
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-sm-12 filter">
            <?php echo $html_form;?>
        </div>
        <div class="col-xl-9 col-sm-12 wrap-courses">
            <div class="row">
               <?php echo $htmlCourses;?>
            </div>
            <div class="pagination-wrap"><?php echo $pagination ?></div>
        </div>
    </div>
</div>
<?php
get_footer();
