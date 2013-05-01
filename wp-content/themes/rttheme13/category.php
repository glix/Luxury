<?php /*Template Name: Luxury Travel */ ?>
<?php
//page link
$link_page=get_permalink(get_option('rttheme_blog_page'));

//category link
$category_id = get_the_category($post->ID);
$category_id = $category_id[0]->cat_ID;//only one category can be show in the list  - the first one
$link_cat=get_category_link($category_id); 

//redirect to home page if user tries to view slider or home page contents by clicking the view link on admin
$home_page=get_bloginfo('url');
if (get_query_var('home_page') || get_query_var('slider')){ header( 'Location: '.$home_page.'/ ' ) ;} 
get_header();

$blog_full_width = get_post_meta($post->ID, 'rt_blog_full_width', true);
if($blog_full_width):
$width=660;
else:
$width=272;
endif;

?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
    <!-- /Page navigation-->
     
    
    <!--  page contents -->
    <div class="content sub"> 
        <div class="left">
        
          <?php
            if (is_category( )) {
                $cat_id = get_query_var('cat');
                $term = get_term( $cat_id,'luxury_taxonomy' );
                //echo $term;
                                //print_r($term);
                //print_r($cat_id);
            }
            ?>   
        <?php /* ?>
    <?php $query = new WP_Query('post_type=luxury_travel'); ?>
              <?php while( $query->have_posts() ) : $query->the_post(); ?>
        <?php */ ?>
    
            <!-- blog box-->
           <div class="blog single">
               
       
               <?php //if(has_post_thumbnail()):?>
               
               <?php if(!$blog_full_width):?>
               <div class="box blog_left first" style="width:340px;">
               <?php endif;?>
               
              
               <!-- blog image-->
               <?php if($blog_full_width):?><span class="aligncenter"><?php endif;?>
               <span class="border  <?php if(!$blog_full_width):?>alignleft<?php endif;?>"> 
               <!--<?php
                    //get the image url
                    //$image_id = get_post_thumbnail_id();
                    //$image_url = wp_get_attachment_image_src($image_id,'large', true);
                    //$image_url = $image_url[0];                        
               ?>-->
               <!--<a href="<?php //echo $image_url;?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_blog_<?php //echo $post->ID;?>]" class="imgeffect plus">-->
               <?php $category_link = get_category_link( $category->term_id ); ?>
               <img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" />
                <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->cat_name; ?></a>
               <!-- blog image-->
               
                    <?php               
                    if(!get_option('rttheme_blog_resize'))://RT-Theme resize option is enabled
                    ?>
                    <?php /* ?>
                        <?php
                        // Resize Portfolio Image
                        $imgURL = find_image_org_path($image_url);
                        $crop   = true;
                        if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $width, 0, ''.$crop.'' );
                        ?>
                        <img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" />
                         
                    <?php else://use the post thumbnail ?>
                         <?php
                         $default_attr = array();
                         echo get_the_post_thumbnail($post->ID,array($width, 1000),$default_attr);
                         ?>     
                      <?php */ ?>           
                    <?php endif;?>
               <!-- / blog image -->
               </a>
               </span>
             
               <?php if($blog_full_width):?></span><?php endif;?>
               <div class="clear"></div>
               
               <!-- / blog image -->
       
               
               
               <?php if(!$blog_full_width):?>
               </div>
               <?php endif;?>
               
               <?php //endif;?> 
                   
       
               
               <?php if(!has_post_thumbnail() || $blog_full_width):?>
               <div class="box blog_full first" style="width:320px;">
               <?php else:?>
               <div class="box blog_right last">
               <?php endif;?>
                
               <!-- blog headline-->
                  <h2><a title="<?php echo $term->name; ?>"><?php echo $term->name; ?></a></h2>

                  <div class="line nomargin"></div>
               <!-- / blog headline--> 
               
               <!-- date and cathegory bar -->
                  <!--<div class="dateandcategories nomargin">
                       <?php //_e('On','rt_theme'); ?> <?php //the_time('F jS, Y') ?>, <b><?php //_e('posted in:','rt_theme'); ?></b> <?php the_category(', ') ?> <?php //_e('by','rt_theme'); ?> <?php the_author_posts_link(); ?><span class="comment"><?php //comments_popup_link(__('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme')); ?></span>
                  </div>-->
               <!-- / date and cathegory bar -->
               <div class="line nomargin"></div>
               <?php  echo $term->description; ?> 
               </div>
                <div class="clear"></div>
               <!-- blog text-->
               
               <?php //wp_link_pages(); ?>
               <!-- /blog text-->
               
               <!-- tags -->
               <?php //echo the_tags( '<div class="tags no-top-padding"><span>', '</span><span>', '</span></div>');?>  
               <!-- / tags -->
                               
           </div>
           <!-- blog box-->
    
            <div class="clear"></div>
            
            <?php //if(!get_option("rttheme_hide_author_info")):?>
            <!-- Info Box -->
            
            <!--<div class="info_box about">
                <div class="info_box_title"><h3><?php //_e( 'About the Author', 'rt_theme' ); ?></h3></div>
                <div class="info_box_content">
                        <span class="border alignleft thumb"><?php //if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '60' ); }?>  </span>
                            
                           <p>
                            <strong><?php the_author_posts_link(); ?></strong><br />
                              <?php //the_author_meta('description'); ?>
                           </p>
                    <div class="clear"></div>       
                </div>
            </div>-->
            <?php //endif;?>

            
             
    <?php //endwhile;?>
            <div class="post-images"><?php
            $answers = new WP_Query(
                array(
                    'post_type' => 'luxury_travel', 
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'luxury_taxonomy', 
                            'field' => 'id', 
                            'terms' => $cat_id
                         )
                     )
                  )
            );
            if ($answers->have_posts()) : while ($answers->have_posts()) : $answers->the_post();
                    $i++;
                    //echo the_category();

                    ?>
                        
                        <a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail(); ?></a>

                    <?php
                endwhile;
            else:
                ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif;
             ?>
</div>
     
    </div>
    <!-- / page contents  -->

 
        <!-- side bar -->
        <div class="sidebar"><div class="sidebar_back">
        <?php include(get_template_directory()."/sidebar.php"); ?>
        </div></div><div class="clear"></div>
        <!-- / side bar -->
   </div> 
<?php get_footer();?>