<?php
/* 
* rt-theme static backgrounds
*/
global $backgrounds;
$static_background=get_option('rttheme_static_backgrounds');
$random_background=get_option('rttheme_random_background');

if(!$static_background) $static_background = 1; 
$background_slider= get_option('rttheme_background_slider');


//worpdress background
$background = get_background_image();
$background_color = get_background_color();

//check wordpress background
$wp_background_defined="";
if($background) $wp_background_defined=True;
?>

<?php if(!$wp_background_defined):?>

<?php if(!$random_background && !$background_slider): ?>
    <?php
    //100% Static Background Images
    if($static_background==1)   $background_image="home_background1.jpg";
    if($static_background==2)   $background_image="home_background2.jpg";
    if($static_background==3)   $background_image="home_background3.jpg";
    if($static_background==4)   $background_image="home_background4.jpg";
    if($static_background==15):  $background_image="sunset.jpg"; echo '<style type="text/css">body {background:#000 !important}</style>';endif;
    if($static_background==16):  $background_image="sunset2.jpg"; echo '<style type="text/css">body {background:#000 !important}</style>';endif;
    ?>    
    
    <?php
    //Bacground css codes
    ?>
    <?php if($static_background==5): ?> <style type="text/css">body {background:#676767 url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background1.jpg) top center no-repeat !important;}</style><?php endif;?>
    <?php if($static_background==6): ?> <style type="text/css">body {background:#9C9D9B url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background2.jpg) top center no-repeat !important;}</style><?php endif;?>
    <?php if($static_background==7): ?> <style type="text/css">body {background:#000 url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background3.jpg) top center no-repeat !important;}#footer {background:#101010 !important;border-top:1px solid #292929 !important;}</style><?php endif;?>
    <?php if($static_background==8): ?> <style type="text/css">body {background:#b3b0ab url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background4.jpg) top center no-repeat !important;}</style><?php endif;?>
    <?php if($static_background==9): ?> <style type="text/css">body {background:#cfcaaa url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background5.jpg) top center no-repeat !important;}</style><?php endif;?>
    <?php if($static_background==10): ?> <style type="text/css">body {background:#C8C8C8 url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background6.png) top center no-repeat !important;}</style><?php endif;?>
    <?php if($static_background==11): ?> <style type="text/css">body {background:#C8C8C8 url(<?php echo get_template_directory_uri(); ?>/images/background_images/abstract_background7.jpg) top center no-repeat !important;}</style><?php endif;?>
    <?php if($static_background==12): ?> <style type="text/css">body {background:#222222 url(<?php echo get_template_directory_uri(); ?>/images/background_images/background_texture_1.png)  !important;} </style><?php endif;?>
    <?php if($static_background==13): ?> <style type="text/css">body {background:#222222 url(<?php echo get_template_directory_uri(); ?>/images/background_images/background_texture_2.png)  !important;} </style><?php endif;?>
    <?php if($static_background==14): ?> <style type="text/css">body {background:#000 url(<?php echo get_template_directory_uri(); ?>/images/background_images/wood-pattern.jpg)  !important;}</style><?php endif;?>
<?php endif;?>

<?php


//100% Static Background
if($background_image){ $backgrounds = '<img src="'.get_template_directory_uri().'/images/background_images/'.$background_image.'" alt="" />';}


//Randomized Background 
if($random_background){
    $random_background = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $random_background)); 
    $images=explode("\n",  $random_background);    
    $random_number = rand(0, count($images)-1);    
    $backgrounds = '<img src="'.$images[$random_number].'" alt="" />'; 
}



//Bacground Slider
if($background_slider){

    $images=explode("\n",  $background_slider);
    
    $the_slider = '<ul class="background_slider">';
        foreach ($images as $k => $image_url) {
         if (trim($image_url)):
             $the_slider .= '<li><img src="'.trim($image_url).'" alt="" /></li>';
         endif;
        }
     $the_slider .= '</ul>';
     $backgrounds = $the_slider;
}

 $random_number = rand(0, 4);   

?>

<?php endif;?>