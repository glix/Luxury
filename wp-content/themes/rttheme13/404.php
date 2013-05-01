<?php
/* 
* rt-theme 404 
*/
get_header();  
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
    <!-- /Page navigation-->
    
    <div class="clear extra_space"></div>

    <!--  page contents -->
    <div class="content left">  
 
    <!-- Page Title -->
        <h2>404 <?php wp_title(''); ?></h2>
        <div class="line"></div>
    <!-- / Page Title -->

        <h6><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'rt_theme' ); ?></h6>

    <div class="clear"></div>
    </div>
    <!-- / page contents  -->


    <!-- side bar -->
    <div class="sidebar_right">
    <?php include(get_template_directory()."/sidebar.php"); ?>
    </div>
    <!-- / side bar -->

<?php get_footer();?>