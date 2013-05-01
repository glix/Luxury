<?php
/* 
* rt-theme portfolio detail page
*/

//taxonomy
$taxonomy = 'portfolio_categories';

//page link
$link_page=get_permalink(get_option('rttheme_portf_page'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
    foreach ($terms as $taxindex => $taxitem) {
    if($i==0){
        $link_cat=get_term_link($taxitem->slug,$taxonomy);
        $term_slug = $taxitem->slug;
        $term_id = $taxitem->term_id;    
        }
    $i++;
    }
}

// portfolio image size 
$w=660;

get_header();
if ($terms) {    
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
    <!-- /Page navigation-->
     
    
    <!--  page contents -->
    <div class="content sub"> 
        <div class="left">
             
    <!-- Page Title -->
        <h2><?php the_title(); ?></h2>
        <div class="line"></div>
    <!-- / Page Title -->
 
        <?php if (have_posts()) : while (have_posts()) : the_post();?>
 

            <?php
            /* Getting image type */
            if (preg_match("/(png|jpg|gif)/", get_post_meta($post->ID, 'rt_portfolio_image', true))) {
                 $button="plus";
            } else {
                 $button="play";
            }
            ?>
            
            <!-- portfolio image -->
            <?php
            if(($button=="play" && get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)) || $button=="plus" || get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?>
            <span class="aligncenter"><span class="border">
               <!-- portfolio image -->
               <?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_portfolio_image', true);?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_portfolio]" class="imgeffect <?php echo $button;?>"><?php endif;?>
               <?php if(get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?><img src="<?php echo get_post_meta($post->ID, 'rt_portfolio_thumb_image', true);?>" alt="<?php the_title(); ?>" /><?php else:?>

                    <?php
                    // Resize Portfolio Image
                    $imgURL = find_image_org_path(get_post_meta($post->ID, 'rt_portfolio_image', true));
                    $crop 	= true;
                    if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $w, $h, ''.$crop.'' );
                    ?>
                    <img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" />
             
             
               <?php endif;?>
               <?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?></a><?php endif;?>
            </span></span>
            <?php endif;?>

            <!-- text-->
            <?php the_content();?>
            <!-- text -->
        
        <?php endwhile; endif;?>  
 
    
    <?php if ($post->comment_status == 'open') : ?>

    <div class='entry commententry'>
        <?php comments_template(); ?>
    </div>
    <?php endif;?>

    <div class="clear"></div>
    </div>    
    <!-- / page contents  -->

    <!-- side bar -->
    <div class="sidebar"><div class="sidebar_back">
    <?php get_template_part("sidebar"); ?>
    </div></div><div class="clear"></div>
    <!-- / side bar -->

<?php
}else{
    echo "<h3>No category has been selected for this portfolio item, please go Wordpress Admin -> Portfolio -> (This Post) and select at least one category for this entry!</h3>";
}
?>
    
    </div>
    
<?php get_footer();?>