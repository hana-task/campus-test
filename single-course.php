<?php
global $post;
get_header();
?>
<div class="banner" style='background-image: url(<?= get_field('image') ?>)'>
    <div class="container">
    <h1 class="title"><?php echo $post->post_title; ?></h1>
        <div class="dates">
            <span class="inner"><?= get_field('end_date') ?></span> - <span class="inner"><?= get_field('start_date') ?></span>
        </div>
    </div>
</div>
<div class="container">
    <div class="content">
        <div class="content-title">תיאור:</div>
        <?php echo $post->post_excerpt;  ?>
    </div>

    <div class="trailer">
        <?php $youtubeID = get_field('trailer') ?>
        <iframe src="<?= 'https://www.youtube.com/embed/'.$youtubeID ?>"   style="width: 100%; height:400px"></iframe>


    </div>
</div>
<?php
//var_dump($post);

get_footer();