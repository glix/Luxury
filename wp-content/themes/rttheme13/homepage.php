<?php  /*Template Name: Home Page */?>
<?php
/* 
* rt-theme home page 
*/
get_header();

$default_attr = "";
?>


<?php
if(!get_option("rttheme_remove_slider")):?>

<?php
/*
*
* CYCLE SLIDER
*
*/
if ($home_page_slider== "cycle"):
?>
    <!-- Slider -->	
<style type="text/css">
	#slider{
		height:402px !important;
	}
    #slider_area{
        height:400px !important;
    }
</style>
    <div id="slider">
	   <div id="slider_area" class="cycle">

            <?php
                 $slides=array(
                 'post_type'=> 'slider',
                 'post_status'=> 'publish',
                 'ignore_sticky_posts'=>1,
                 'showposts' => 1000,
                 'cat' => -0,
            );

            query_posts($slides);
            
            if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <!-- slide-->
                <div class="slide <?php if ( get_post_meta($post->ID, 'rt_right_side_video', true)):echo "video";endif;?>">
                    
                    <?php if (!get_post_meta($post->ID, 'rt_hide_titles', true)): ?>
                    
                        <!-- slide description -->
                        <div class="desc   <?php if ( get_post_meta($post->ID, 'rt_text_background', true)!="none" &&  has_post_thumbnail() ): ?>transparent_background <?php echo get_post_meta($post->ID, 'rt_text_background', true);?><?php endif;?> ">
                   
                         <b class="title"><?php if(get_post_meta($post->ID, 'rt_custom_link', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_custom_link', true); ?>" title="<?php the_title(); ?>"><?php endif;?><?php the_title(); ?><?php if(get_post_meta($post->ID, 'rt_custom_link', true)):?></a><?php endif;?></b><br /> 
                         <b class="subtitle"><?php echo get_post_meta($post->ID, 'rt_second_title', true); ?></b><br />                      
                         <?php if(get_post_meta($post->ID, 'rt_slide_text', true)):?><?php echo get_post_meta($post->ID, 'rt_slide_text', true); ?><?php endif;?>
                         
                         <?php if(get_post_meta($post->ID, 'rt_custom_link_text', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_custom_link', true); ?>" title="<?php the_title(); ?>"><?php echo get_post_meta($post->ID, 'rt_custom_link_text', true) ?></a><?php endif;?>
                   
                         
                        </div>
                        <!-- /slide description -->
                        
                        <?php if ( get_post_meta($post->ID, 'rt_right_side_image', true)): ?>
                        <!-- slide right-side image -->
                        <img src=" <?php echo ( get_post_meta($post->ID, 'rt_right_side_image', true)) ?>" width="320" class="right_image" alt="" />
                        <!-- /slide right-side image -->
                        <?php endif;?>

                        <?php if ( get_post_meta($post->ID, 'rt_right_side_video', true)): ?>
                        <!-- slide right-side video -->
                        <div class="right_image">
                        <?php echo ( get_post_meta($post->ID, 'rt_right_side_video', true)) ?>
                        </div>
                        <!-- /slide right-side video -->
                        <?php endif;?>                        
                        
                    <?php endif;?>
            
                        <!-- slide background image -->
                        
                        <?php if(get_post_meta($post->ID, 'rt_custom_link', true) && has_post_thumbnail()):?><a href="<?php echo get_post_meta($post->ID, 'rt_custom_link', true); ?>" title="<?php the_title(); ?>"><?php endif;?>
        
                        <?php if ( has_post_thumbnail() ) the_post_thumbnail( 'slider-big' ); ?>			
                        
                        <?php if(get_post_meta($post->ID, 'rt_custom_link', true) && has_post_thumbnail()):?></a><?php endif;?>
    
                        <!-- /slide background image -->
                </div>
                <!--/ slide-->
          
            <?php endwhile;endif;?>
	    </div>
	</div>
    
    <!-- / slider buttons -->
    <div id="numbers"></div>
            
    <!-- / slider area-->
<?php endif;?>




<?php
/*
*
* NIVO SLIDER
*
*/
if ($home_page_slider == "nivo"):
?>
    <!-- Slider Nivo-->		
    <div id="slider" class="nivo">

        <div id="slider_area" class="nivo">

         <!-- slides -->
         <div id="nivo-slider">
            <?php
                $slides=array(
                'post_type'=> 'slider',
                'post_status'=> 'publish',
                'ignore_sticky_posts'=>1,
                'showposts' => 1000,
                'cat' => -0,
            );

            query_posts($slides);
            
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            if ( has_post_thumbnail() ):
            
            $custom_link = get_post_meta($post->ID, 'rt_custom_link', true);
            $custom_link_text = get_post_meta($post->ID, 'rt_custom_link_text', true);
            $title = get_the_title();
            $slide_text = get_post_meta($post->ID, 'rt_slide_text', true);
            
            ?>
            
                    <!-- slide background image -->
                    
                    <?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>
    
                    <?php
                    if (!get_post_meta($post->ID, 'rt_hide_titles', true)):
                        $default_attr = array(
                        'title' => '#slide_'.$post->ID.'_caption',
                        'alt'   => trim(strip_tags($title)),
                        );
                    else:
                        $default_attr = array(
                        'title' => '',
                        'alt'   => trim(strip_tags($title)),
                        );                    
                    endif;
                    
                    if ( has_post_thumbnail() ) echo get_the_post_thumbnail($post->ID,'slider-big',$default_attr); 
                    ?>			
                    
                    <?php if($custom_link):?></a><?php endif;?>

                    <!-- /slide background image -->
                    
            <?php
            if (!get_post_meta($post->ID, 'rt_hide_titles', true)):
            
            $captions.="";
            $captions.='<div id="slide_'.$post->ID.'_caption" class="nivo-html-caption">'."\n"; 
            $captions.='<b class="nivo-title">'."\n"; 
            if($custom_link)  $captions.='<a href="'.$custom_link.'" title="'.$title.'">'."\n"; 
            $captions.= $title."\n"; 
            if($custom_link) $captions.='</a>'."\n";
            $captions.= "</b>\n"; 
            $captions.= $slide_text."\n"; 
            if($custom_link && $custom_link_text) $captions.='<a href="'.$custom_link.'" title="'.$title.'">'.$custom_link_text.'</a>'."\n"; 
            $captions.='</div>'."\n";
            
            endif;
            ?>         
              
            <?php endif;endwhile;endif;?>  
         </div>
         <!-- / slides -->
         

        <!-- captions  -->
        <?php echo $captions;?>
        <!-- /captions -->
        </div>
        
	   <div id="#nivo-controlNav"></div>
        
    </div>
    <!-- / Slider -->
<?php endif;?>

<?php
/*
*
* ACCORDION SLIDER
*
*/
if ($home_page_slider == "accordion"):
?>
    <!-- Accordion Slider -->	
    <div id="slider" class="accordion_slider">    
        <div id="slider_area" class="accordion_slider">    
        <ul class="kwicks">
            <?php
                $slides=array(
                'post_type'=> 'slider',
                'post_status'=> 'publish',
                'ignore_sticky_posts'=>1,
                'cat' => -0,
                'showposts' => 1000,
            );

            query_posts($slides);
            $count=1;
            if ( have_posts() ) : while ( have_posts() ) : the_post();
            
            
            $custom_link = get_post_meta($post->ID, 'rt_custom_link', true);
            $custom_link_text = get_post_meta($post->ID, 'rt_custom_link_text', true);
            $title = get_the_title();
            $slide_text = get_post_meta($post->ID, 'rt_slide_text', true);
            $sub_title  = get_post_meta($post->ID, 'rt_second_title', true);
            ?>
            
            <!-- slide -->	
            <li <?php if($count==1):?>class="kwicks_first"<?php endif;?>>
          
                <!-- slide image -->
                
                <?php if($custom_link):?><a href="<?php echo $custom_link; ?>" title="<?php echo $title; ?>"><?php endif;?>

                <?php   
                if ( has_post_thumbnail() ) echo get_the_post_thumbnail($post->ID,'slider-big',$default_attr); 
                ?>			
                
                <?php if($custom_link):?></a><?php endif;?>

                <!-- /slide image -->
                 
                <?php if (!get_post_meta($post->ID, 'rt_hide_titles', true)):?>
                <!-- slide description -->
                <div class="desc_accordion">
                
                <!-- slide title -->	
                <b class="title"><?php if($custom_link):?><a href="<?php echo $custom_link;?>" title=""><?php endif;?><?php echo $title;?><?php if($custom_link):?></a><?php endif;?></b>
                
                <!-- slide title - hidden  -->
                <b class="title_hidden"><?php if($custom_link):?><a href="<?php echo $custom_link;?>" title=""><?php endif;?><?php echo $title;?><?php if($custom_link):?></a><?php endif;?></b>
                
                <!-- sub title -->
                <?php if($sub_title):?><b class="subtitle"><?php echo $sub_title;?></b><?php endif;?>
                
                <!-- text -->
                <?php if($slide_text):?><p><?php echo $slide_text;?>
                <?php if($custom_link && $custom_link_text): echo '<a href="'.$custom_link.'" title="'.$title.'">'.$custom_link_text.'</a>'."\n";endif;?> 
                </p><?php endif;?>
                
                </div>
                <!-- /slide description -->
                <?php endif;?>
                
                <div class="shadow"></div>
            </li>
            <!-- / slide  -->
            <?php $count++;endwhile;endif;?> 
             
        </ul>
        </div>
    </div>
    
    <!-- / slider buttons -->
    <div id="numbers"></div>
    <!-- / Accordion Slider -->	
<?php endif;?>


  <img src="<?php echo get_template_directory_uri(); ?>/images/home_content_top.png" alt="" class="home_content_top" />
<?php endif;?>

    

    <!-- Home Page Content -->	
    <div class="content home">
        
	  
	 <!-- First Row - White -->	
	 <div class="row white "> 
       
           <!-- widgetized home page area -->
           <?php if (function_exists('dynamic_sidebar')){  dynamic_sidebar('Widgetized Home Page Area'); } ?>
           <div class="clear"></div>
           <!-- / widgetized home page area -->
       
           <?php
           //home pae content
           $home_page=array(
               'post_type'=> 'home_page',
               'post_status'=> 'publish',
               'ignore_sticky_posts'=>1,
               'showposts' => 1000,
               'orderby'=> 'date',
               'order' => 'ASC',
               'cat' => -0,
           );
       
          get_template_part( 'home_content_loop', 'home_page' ); 
          ?> 

	 <div class="clear"></div>  
	 </div>
	 <!--/ First Row -->	
	 
	
	<?php
        //check second row contents
        $home_page_posts_str = " SELECT ID  FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id   AND wposts.post_status = 'publish'  AND wpostmeta.meta_key = 'rt_second_row'   AND wposts.post_type = 'home_page' ";
        $home_page_posts = $wpdb->get_results($home_page_posts_str, OBJECT);
        
        if($home_page_posts):
     ?>
	 <!-- Second Row - Silver -->
	 <div class="row silver">
             
           <?php
           $row="second";
           //home pae content
           $home_page=array(
               'post_type'=> 'home_page',
               'post_status'=> 'publish',
               'ignore_sticky_posts'=>1,
               'showposts' => 1000,
               'orderby'=> 'date',
               'order' => 'ASC',               
               'cat' => -0,
           );
   
          get_template_part( 'home_content_loop', 'home_page' ); 
          ?>
              
	   <div class="clear"></div>
	 
	 </div>
	 <!-- / Second Row -->
    <?php endif;?>
    
    </div>
    <!-- / Home Page Content -->
    
<?php get_footer();?>