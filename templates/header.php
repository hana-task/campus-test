
<header>
    <div class="container">
        <a class="brand" href="<?= esc_url(home_url('/')); ?>">
            <?php
            // Site Logo - Set it in
//            $custom_logo_id = get_theme_mod( 'custom_logo' );
            $custom_logo_url = 'https://campus.gov.il/wp-content/uploads/2022/02/Campus-logo.png';
            echo '<img src="' . esc_url( $custom_logo_url ) . '" alt="'. get_bloginfo('name') .'" />';
            ?>
        </a>
<!--        <nav role="navigation" aria-label="תפריט ראשי">-->
<!--            --><?php
//            if (has_nav_menu('primary_navigation')) :
//                wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
//            endif;
//            ?>
<!--        </nav>-->
        <?php
        // Displays search form, from the file "searchform.php".
      //  get_search_form(); ?>
    </div>
</header>