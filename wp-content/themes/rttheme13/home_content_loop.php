<?php
/* 
* rt-theme home page content loop
*/

global $home_page,$which_theme,$row;
$total_width ="";
$size="";
$line_clear="";
query_posts($home_page);
 
            $box_counter=1;
            
            if (have_posts() ) : while ( have_posts() ) : the_post();
            
            if ($row && get_post_meta($post->ID, 'rt_second_row', true)):
                $show=true;
            elseif (!$row && !get_post_meta($post->ID, 'rt_second_row', true)):
                $show = true;
            else:
                $show = false;
            endif;
            
            
            if ($show):
            
                /*
                *
                * Box Properties
                *   
                */
                
                // Layout
                $home_layout_names=array("9"=>"four-five","8"=>"three-four","7"=>"two-three","6"=>"full-box","5"=>"five","4"=>"four","3"=>"three","2"=>"two");
                $home_layout=get_post_meta($post->ID, 'rt_layout_options', true);
                if($home_layout==0 || !$home_layout) $home_layout=3;
              
                
                // Thumbnail sizes
              
                switch ($home_layout) {
                    case 9:
                        $w=700;
                    break;                       
                    case 8:
                        $w=700;
                    break;                       
                    case 7:
                        $w=620;
                    break;                    
                    case 6:
                        $w=960;
                    break;     
                    case 5:
                        $w=172;
                    break;                
                    case 4:
                        $w=220;
                    break;
                    case 3:
                        $w=300;
                    break;
                    case 2:
                        $w=460;
                    break;
                }
                
                $total_width=$total_width+$w+20; 
             
             if($box_counter==1):
                    $box_class="first";
                elseif($total_width>799):
                $box_class="last"; 
                else:
                    $box_class="";
                endif;
            ?>
           
          <?php
          if($total_width>960){
           echo "<div class=\"clear\"></div>";
           $box_class="first";
           $total_width=$w;
            }
          ?>
                <!-- box -->
                
                     <div class="box <?php echo $home_layout_names[$home_layout];?> <?php echo $box_class;?>">
                     <?php
                    
                    //featured image alignment 
                    if(get_post_meta($post->ID, 'rt_image_align', true))    $align = get_post_meta($post->ID, 'rt_image_align', true);
                    else    $align = "alignleft";
                    
                    if($attachment) $alt = trim(strip_tags( $attachment->post_title));
                    else $alt = "";

                        $default_attr = array( 
                        'class' => "attachment-$size $align ",
                        'alt'   => $alt,
                        );

                    //if ( has_post_thumbnail() ) ?>
                    <!--<a href="<?php //echo get_permalink(); ?>">
                        <?php //echo get_the_post_thumbnail($post->ID,array(1000,940),$default_attr); ?>    
                        <div style="clear:both;"> </div>
                    <?php //print_r($default_attr); ?>
                    </a>-->
                    <?php if( get_field('custom_image') ): ?>
                        <a href="<?php echo get_permalink(); ?>" >
                            <img src="<?php the_field('custom_image'); ?>" alt="" hover-img="<?php the_field('custom_image_hover'); ?>" normal-img="<?php the_field('custom_image'); ?>" />
                        </a>
                    <?php endif; ?>                                    
                   
                         <!-- box title-->
                         <h4 style="padding:0;"><?php if(get_post_meta($post->ID, 'rt_custom_link', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_custom_link', true); ?>" title="<?php the_title(); ?>"><?php endif;?>
                         <a href="<?php echo get_permalink(); ?>"><?php the_title();?></a>
                         <?php if(get_post_meta($post->ID, 'rt_custom_link', true)):?></a><?php endif;?></h4>                       
                         <!-- text-->
                         <?php the_content(); ?> 
                         
                         <?php
                       
                            if (get_post_meta($post->ID, 'rt_custom_link', true) && get_post_meta($post->ID, 'rt_custom_link_text', true)):
                                echo "<a href=\"". get_post_meta($post->ID, 'rt_custom_link', true) ."\" title=\"". get_the_title() ."\" class=\"small_button\">". get_post_meta($post->ID, 'rt_custom_link_text', true) ."</a>";
                            endif;
                         ?>
                         
                     </div>
                <!-- /box -->
      
            <?php
            $box_counter++;
            
            if ($line_clear){
              //   echo "<div class=\"clear\"></div>";
            }
            ?>
      
        <?php endif; endwhile;endif;?>            
<?php wp_reset_query();?>
<div class="clear"></div>
<script>
    jQuery(function($){
       $('.home .silver .box a img').hover(function(){
        var hover_img = $(this).attr('hover-img');
        $(this).attr('src',hover_img);
       }).mouseleave(function(){
           var hover_img = $(this).attr('normal-img');
            $(this).attr('src',hover_img);
       });
    });
</script>