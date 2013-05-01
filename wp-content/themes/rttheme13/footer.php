   
</div>
</div>

<!-- Footer --> 
<div id="footer"><div class="bottom_corners"></div>
    
    
    <?php // Footer Banner
    
    //wp_query hack on taxonomies for 404 issue 
    
    if(is_tax()){ 
        $wp_query = new WP_query();
    }
    
    if(function_exists('icl_register_string')){
        $banner_text = do_shortcode(icl_t( 'rt_theme', 'Footer Banner Text', get_option('rttheme_banner_slogan')));
        $banner_button_text = do_shortcode(icl_t( 'rt_theme', 'Footer Banner Button Text', get_option('rttheme_banner_button_text')));
        $banner_button_link = do_shortcode(icl_t( 'rt_theme', 'Footer Banner Button Link', get_option('rttheme_banner_button_link')));
    }else{
        $banner_text = do_shortcode(get_option('rttheme_banner_slogan'));
        $banner_button_text = do_shortcode(get_option('rttheme_banner_button_text'));
        $banner_button_link = do_shortcode(get_option('rttheme_banner_button_link'));
    }

    if($banner_text || $banner_button_text):
    ?>

    <!-- banner bar with button -->
    <div class="banner"><div class="banner_content">
     
     <?php if($banner_button_link) $b_link=$banner_button_link; else $b_link="#"; //button link ?>
     <?php if($banner_button_text):?>
         <a href="<?php echo $b_link;?>" title="" class="banner_button alignright"><?php echo $banner_button_text;?></a>
     <?php endif;?>
     
     <span class="cufon"><?php echo $banner_text;?></span>
    </div></div>
    <!-- / banner bar with button -->
    <?php endif;?>
 
    
    <!-- First Row -->
    <?php /* ?>
    <div class="row footer">
           <!-- widgetized home page area -->
           <?php if (function_exists('dynamic_sidebar')){  dynamic_sidebar('Footer Content'); } ?>
           <div class="clear"></div>
           <!-- / widgetized home page area -->			
	 <div class="clear"></div>
    </div>
    <?php */ ?>
    <!-- / First Row -->
    
    <!-- Second Row -->
    <div class="second_footer">
	   <div class="row sfooter">
            <?php
            if(function_exists('icl_register_string')){
                echo do_shortcode(icl_t( 'rt_theme', 'Footer Copyright Text', get_option('rttheme_footer_copy')));
            }else{
                echo do_shortcode(get_option('rttheme_footer_copy'));
            }
            ?>  
            
            <?php if ( has_nav_menu( 'rt-theme-footer-navigation' ) ): // check if user created a custom menu and assinged to the rt-theme's location ?>
                <?php
                //footer menu parameters
                $footer_menu=array(
                    'depth'=> 1,
                    'echo' => false,
                    'menu_class'      => 'footer_menu', 
                    'menu_id'         => '',
                    'container'       => '', 
                    'container_class' => '', 
                    'container_id'    => '', 
                    'fallback_cb' => '',
                    'theme_location'=> 'rt-theme-footer-navigation'
                );
                
                echo wp_nav_menu($footer_menu);				    
                ?>
            <?php else:?>
               <?php
                //footer menu parameters
                $footer_menu=array(
                    'menu'            => 'RT Theme Footer Navigation Menu', 
                    'depth'=> 1,
                    'echo' => false,
                    'menu_class'      => 'footer_menu', 
                    'menu_id'         => '',
                    'container'       => '', 
                    'container_class' => '', 
                    'container_id'    => '', 
                    'fallback_cb' => '',
                    'theme_location'=> 'rt-theme-footer-navigation'
                );
                
                echo wp_nav_menu($footer_menu);                 
                ?>            
            <?php endif;?>
		   
            <!-- social media icons -->
            <?php
            if(function_exists('icl_register_string')){
                echo do_shortcode(icl_t( 'rt_theme', 'Social Media', get_option('rttheme_footer_social_media')));
            }else{
                echo do_shortcode(get_option('rttheme_footer_social_media'));
            }
            ?>
            <!-- / social media icons -->
	   </div>
    </div>
    <!-- / Second Row -->

</div>
<!-- /footer -->
<?php wp_footer();?>
<?php echo get_option('rttheme_anayltics');?> 

</body>
</html> 