<?php
/* 
* rt-theme archive 
*/
get_header();
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
    <!-- /Page navigation-->
 
    <!--  page contents -->
    <div class="content sub"> 
        <div class="left">
     
        <!-- Page Title -->
            <h2><?php wp_title(''); ?></h2>
            <div class="line"></div>
        <!-- / Page Title -->
    
        <?php get_template_part( 'loop', 'archive' );?>
    
        <div class="clear"></div>
        </div>
        
    
    
        <!-- side bar -->
        <div class="sidebar"><div class="sidebar_back">
        <?php include(get_template_directory()."/sidebar.php"); ?>
        </div></div><div class="clear"></div>
        <!-- / side bar -->
    </div>
    <!-- / page contents  -->
<?php get_footer();?>