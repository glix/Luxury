<?php
global $link_page,$link_cat,$which_theme,$home_page_slider,$backgrounds;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php if(get_option('rttheme_effect_options')){?>
<meta name="rttheme_effect_options" content="<?php echo get_option('rttheme_effect_options');?>" />
<?php }else{?>
<meta name="rttheme_effect_options" content="fade" />
<?php }?>
<?php if(get_option('rttheme_slider_time_out')){?>
<meta name="rttheme_slider_time_out" content="<?php echo get_option('rttheme_slider_time_out')*1000;?>" />
<?php }else{?>
<meta name="rttheme_slider_time_out" content="6000" />
<?php }?>
<meta name="rttheme_template_dir" content="<?php echo get_template_directory_uri(); ?>" />
<?php if(get_option('rttheme_disable_cufon')){?>
<meta name="rttheme_disable_cufon" content="<?php echo get_option('rttheme_disable_cufon');?>" />
<?php }?>
<meta name="rttheme_slider" content="<?php echo get_option('rttheme_slider');?>" />

<title><?php if (is_home()): bloginfo('name'); else: wp_title('');endif; ?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $which_theme;?>.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/prettyPhoto.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.datepick.css" />
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-1.8.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.datepick.js"></script>


<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); //thread comments?>		   
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/ie-fix.css" />
<![endif]-->
 
<?php
//Custom Slider Heigth
if(get_option('rttheme_slider_height')):

$new_heigth=get_option('rttheme_slider_height');
$new_heigth=trim(preg_replace('#px#', "",$new_heigth));
?>
<style type="text/css"> 
    #slider, #slider_area, .slide{ height:<?php echo $new_heigth;?>px !important; }     
    
    <?php if($home_page_slider=="accordion"):?>
    /* Accordion Slider Height */    
    .accordion_slider#slider, .accordion_slider#slider_area, .kwicks li,.kwicks li .shadow{ height:<?php echo $new_heigth;?>px !important; }
    <?php endif;?>
    
    <?php if($home_page_slider=="nivo"):?>
    /* Nivo Slider Height */    
    .nivo#slider, .nivo#slider_area{  height:<?php echo $new_heigth+30;?>px !important;  } 
    #nivo-slider,#nivo-slider img{ height:<?php echo $new_heigth;?>px !important;  } 
    .nivo-controlNav { top:<?php echo $new_heigth;?>px !important;  }
    <?php endif;?>
</style>
<?php endif;?>

<?php
//Accordion Slider Slide Width
if($home_page_slider=="accordion"):
    $total_width = 980;    
    
    $slides=array('post_type'=> 'slider','post_status'=> 'publish','ignore_sticky_posts'=>1,'cat' => -0,'showposts' => 1000,);                   
    $count_slides = count(query_posts($slides));
    wp_reset_query();
    
    if ($count_slides>0):
        $accordion_width = $total_width / $count_slides; 
        echo '<style type="text/css">.kwicks li{  width: '.$accordion_width.'px; }</style>';    
    endif;
endif;
?>

<?php get_template_part( 'backgrounds', 'static_backgrounds' ); // load background options ?>

<?php
#
#   Custom CSS Codes
#
echo '<style type="text/css"> '. get_option('rttheme_custom_css') .' </style>';
?>

<?php wp_head(); ?>  
</head>
<body <?php body_class(); ?>>
    
    
<div id="container">
    
  <!-- Bakcground Slider --> 
  <div class="background_holder"><?php echo $backgrounds;?></div>
  <!-- / Bakcground Slider -->
  
    <!-- Top Bar -->	
    <div id="top_bar">
      <div class="top_content">                
                
        <!-- Search -->
        <div class="search_bar">
          <form action="<?php echo home_url(); ?>" method="get" class="showtextback">
            <fieldset>
              <input type="text" class="search_text" name="s" id="s" value="<?php _e('search','rt_theme');?>" />
              <input type="image" src="<?php echo get_template_directory_uri(); ?>/images/pixel.gif" class="searchsubmit" alt="" />
            </fieldset>
          </form>
        </div>
        <!-- / Search-->
        
        
        <!-- Top Links -->
        <?php
       //find first a tag and add id
       function add_class_top($output){ 
           $bul="\"><a ";
           $degistir=" first\"><a ";
           return preg_replace('/'.$bul.'/', $degistir, $output, 1); 		 
       }
        

      //top menu parameters
      if ( has_nav_menu( 'rt-theme-top-navigation' ) ){                     
         $top_menu=array(
          'depth'=> 1,
          'echo' => false,
          'menu_class'      => 'top_links', 
          'menu_id'         => '',
          'container'       => '', 
          'container_class' => '', 
          'container_id'    => '', 
          'fallback_cb' => '',
          'theme_location'=> 'rt-theme-top-navigation'
         );
      }else{
         $top_menu=array(
          'menu' => 'RT Theme Top Navigation Menu',
          'depth'=> 1,
          'echo' => false,
          'menu_class'      => 'top_links', 
          'menu_id'         => '',
          'container'       => '', 
          'container_class' => '', 
          'container_id'    => '', 
          'fallback_cb' => '',
          'theme_location'=> 'rt-theme-top-navigation'
         );        
      }
       
       add_filter('wp_nav_menu', 'add_class_top');
       echo wp_nav_menu($top_menu);
       
       ?>
        <!-- / Top Links -->


        <!-- / flags -->	
            <?php if(function_exists("icl_get_languages")){ languages_list(); } ?>
        <!-- / flags -->
        
        
      </div>
    </div>
    <!-- / Top Bar -->
    
    
<div id="wrapper">
	 
    <!-- Header -->
    <div id="header">
 
        <!-- logo -->
        <div id="logo"><a href="<?php echo home_url(); ?>" title="<?php echo bloginfo('name');?>"><?php if(get_option('rttheme_logo_url')):?><img src="<?php echo get_option('rttheme_logo_url'); ?>" alt="<?php echo bloginfo('name');?>" class="png" /><?php else:?><h1 class="cufon logo"><?php echo bloginfo('name');?></h1><?php endif;?></a></div>
        <!-- /logo -->
	 
        <!-- header slogan -->
        <div class="top_slogan">
            <?php
                if(function_exists('icl_register_string')){
                    $header_text = icl_t( 'rt_theme', 'Header Text', get_option('rttheme_header_text'));
                }else{
                    $header_text = get_option('rttheme_header_text');
                }
                
                if($header_text)    echo do_shortcode($header_text);
            ?>
        </div>
        <!-- /header slogan -->
	 
        <div class="clear"></div>  
    </div>
    <!-- / Header -->

    <!--  navigation bar --> 
    <?php rt_nav($link_page,$link_cat); ?> 
    <!-- / navigation bar -->
        
 