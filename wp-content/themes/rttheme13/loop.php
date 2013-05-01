<?php
/* 
* rt-theme loop
*/

global $args,$which_theme,$more;

add_filter('excerpt_more', 'no_excerpt_more'); 
				
if ($args) query_posts($args);

if ( have_posts() ) : while ( have_posts() ) : the_post();

$blog_full_width = get_post_meta($post->ID, 'rt_blog_full_width', true);
if($blog_full_width):
$width=654;
else:
$width=272;
endif;
?>

 
    <!-- blog box-->
    <div id="post-<?php the_ID(); ?>" <?php post_class('blog'); ?>>
        

        <?php if(has_post_thumbnail()):?>
        
        <?php if(!$blog_full_width):?>
        <div class="box blog_left first">
        <?php endif;?>
        
       
        <!-- blog image-->
        <?php if($blog_full_width):?><span class="aligncenter"><?php endif;?>
        <span class="border  <?php if(!$blog_full_width):?>alignleft<?php endif;?>"> 
        <?php
             //get the image url
             $image_id = get_post_thumbnail_id();
             $image_url = wp_get_attachment_image_src($image_id,'large', true);
             $image_url = $image_url[0];                        
        ?>
        <a href="<?php echo $image_url;?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_blog_<?php echo $post->ID;?>]" class="imgeffect plus">
        <!-- blog image-->
             <?php				
             if(!get_option('rttheme_blog_resize'))://RT-Theme resize option is enabled
             ?>
			 <?php
			 // Resize Blog Image
			 $imgURL  = ($image_url);
			 $crop 	= true;
			 if($imgURL) $image_thumb = vt_resize( '', $imgURL, $width, 0, ''.$crop.'' );
			 ?>
			 <img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" />
		  
			
		   
             <?php else://use the post thumbnail ?>
                  <?php
                  $default_attr = array();
                  echo get_the_post_thumbnail($post->ID,array($width, 1000),$default_attr);
                  ?>					
             <?php endif;?>
        <!-- / blog image -->
        </a>
        </span>
        <?php if($blog_full_width):?></span><?php endif;?>
        
        <!-- / blog image -->

        <div class="clear"></div>
        
        <?php if(!$blog_full_width):?>
        <div class="tags">
        <!-- tags -->
        <?php echo the_tags( '<span>', '</span><span>', '</span>');?>  
        <!-- / tags -->
        </div>
        
        </div>
        <?php endif;?>
        
        <?php endif;?> 
            

        
        <?php if(!has_post_thumbnail() || $blog_full_width):?>
        <div class="box blog_full first">
        <?php else:?>
        <div class="box blog_right last">
        <?php endif;?>
        <!-- blog headline-->
           <h3><a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
           <div class="line nomargin"></div>
        <!-- / blog headline--> 
        
        <?php if(!has_post_thumbnail() || $blog_full_width):?>
        
        <!-- tags -->
        <?php echo the_tags( '<div class="tags no-top-padding"><span>', '</span><span>', '</span></div>');?>  
        <!-- / tags -->
        <?php endif;?>
        
        <!-- date and cathegory bar -->
           <div class="dateandcategories">
                <?php _e('On','rt_theme'); ?> <?php the_time('F jS, Y') ?>, <b><?php _e('posted in:','rt_theme'); ?></b> <?php the_category(', ') ?> <?php _e('by','rt_theme'); ?> <?php the_author_posts_link(); ?><span class="comment"><?php comments_popup_link(__('0 Comment','rt_theme'), __('1 Comment','rt_theme'), __('% Comments','rt_theme')); ?></span>
           </div>
        <!-- / date and cathegory bar -->

        
        <?php if(get_the_excerpt()):?>
        <!-- blog text-->
        <?php

        echo "<p>".do_shortcode(get_the_excerpt())."</p>";
        
        if(!empty($post->post_content)): echo ' <a href="'. get_permalink($post->ID) . ' " class="small_button" >'.__('read more','rt_theme').'</a>';endif;

        ?> 
        <!-- /blog text-->
        <?php endif;?>
        

                                
        </div>

    
        
        <div class="clear"></div>             
    </div>
    <!-- blog box-->
            
<?php endwhile; ?>
            
        
    <?php
    //get page and post counts
    $page_count=get_page_count();
    
    //show pagination if page count bigger then 1
    if ($page_count['page_count']>1):
    ?>  
    <!-- paging-->
    <ul class="paging blog"><?php get_pagination(); ?></ul>
    <!-- / paging-->
    <?php endif;?>
            
<div class="clear"></div>
<?php wp_reset_query();?>

<?php else: ?>
<p><?php _e( 'Sorry, no posts matched your criteria.', 'rt_theme' ); ?></p> 
<?php endif; ?>




	 