<?php
/*
Template Name: Full Width Page
*/
get_header();
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
    <!-- /Page navigation-->
    
 

    <!-- Content -->
    <div class="content sub">
    
        <!--Full Width Sub Page -->
        <div class="full">
         <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <!-- Page Title -->
            <h2><?php the_title(); ?></h2>
            <div class="line"></div>
            <!-- / Page Title -->
            <?php //echo do_shortcode('[easy_contact_forms fid=2]'); ?>
            <!--<div style="float:right"><iframe width="240" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Unlocked+Nokia+Store+United+States&amp;aq=&amp;sll=40.759062,-73.918723&amp;sspn=0.018561,0.042014&amp;ie=UTF8&amp;hq=Unlocked+Nokia+Store+United+States&amp;hnear=&amp;t=m&amp;ll=40.772196,-73.948943&amp;spn=0.031522,0.072529&amp;output=embed"></iframe></div>-->
            <?php the_content(); ?>
        <?php endwhile;?>
        <?php else: ?>
             <p><?php _e( 'Sorry, no page found.', 'rt_theme' ); ?></p>
        <?php endif; ?>  

        </div>
        <!-- / Full Width Sub Page -->
    <div class="clear"></div>
    </div> 
    <!-- / Content -->
<?php get_footer(); ?>