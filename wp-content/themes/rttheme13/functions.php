<?php


//sidebars
include(get_template_directory().'/functions/rt_ud_sidebars.php');

//custom post types - taxonomies
include(get_template_directory().'/functions/rt_custom_posts.php');
rt_theme_custom_posts(); //call custom post types


//admin panel options

if(is_admin()):
include(get_template_directory().'/rttheme_options/includes.php');
endif;

if(!is_admin()):
//vt resize
include(get_template_directory().'/rttheme_options/plugins/vt_resize.php');

//breadcrumb function
include(get_template_directory().'/functions/rt_breadcrumb.php');

//comments
include(get_template_directory().'/functions/rt_comments.php');
endif;

//shortcodes
include(get_template_directory().'/functions/rt_shortcodes.php');


//Custom background support
add_theme_support( 'custom-background');

// Load text domain
load_theme_textdomain('rt_theme', get_template_directory().'/languages' );

// Content Width
if ( ! isset( $content_width ) ) $content_width = 680;

/*
*
* Remove html strips from term descriptions
*
*/

function rt_theme_remove_term_filter(){
	remove_filter('pre_term_description', 'wp_filter_kses');
}
add_action('init', 'rt_theme_remove_term_filter');

/*
*
* Loading Theme Scripts
*
*/

function rt_theme_load_scripts(){
    global $home_page_slider;
    
    $template_directory = get_template_directory_uri();
    
    if (!is_admin()) {//load theme scripts
	   wp_enqueue_script( 'jquery' ); 
	   wp_enqueue_script('jquery-easing', $template_directory  . '/js/jquery.easing.1.3.js', array('jquery') );	   
	   wp_enqueue_script('jquery-cycle', $template_directory  . '/js/jquery.cycle.all.min.js', array('jquery') );
	   wp_enqueue_script('jquery-validate', $template_directory  . '/js/jquery.validate.js', array('jquery') );
	   wp_enqueue_script('jquery-prettyphoto', $template_directory  . '/js/jquery.prettyPhoto.js', array('jquery') );
	   
	   if(!get_option('rttheme_disable_cufon')){//if cufon is active
		  wp_enqueue_script('cufon', $template_directory  . '/js/cufon.js', array('jquery') );
		  wp_enqueue_script('aller-cufon-fonts', $template_directory  . '/js/aller.cufonfonts.js', array('jquery') ); 
	   }
	   
	   wp_enqueue_script('jflickrfeed', $template_directory  . '/js/jflickrfeed.min.js', array('jquery') );
	   wp_enqueue_script('jquery-tweet', $template_directory  . '/js/jquery.tweet.js', array('jquery') );
	   wp_enqueue_script('jquery-tools', $template_directory  . '/js/jquery.tools.min.js', array('jquery') ); 
	   
	   if($home_page_slider=="nivo"){ // Nivo slider
		  wp_enqueue_script('nivo-slider', $template_directory  . '/js/jquery.nivo.slider.pack.js', array('jquery') );	   
	   }
	   
	   if($home_page_slider=="accordion"){ // Accordion slider
		  wp_enqueue_script('kwicks-slider', $template_directory  . '/js/jquery.kwicks-1.5.1.pack.js', array('jquery') );
	   }
	   
	   wp_enqueue_script('rt-theme-scripts', $template_directory  . '/js/script.js', array('jquery') );
	   wp_enqueue_script('inner-fade', $template_directory  . '/js/jquery.innerfade.js', array('jquery') );
	   wp_enqueue_script('jquery-form');
	   wp_enqueue_script( 'jquery' ); 
    }
}

add_action('init', 'rt_theme_load_scripts');


/*
*
* Theme color selection
* 
*/

if (get_option('rttheme_style')){
    $which_theme=get_option('rttheme_style');
}else{
    $which_theme="1";		
}


/*
*
* Post Thumbnails Support
* 
*/
//add_theme_support( 'post-thumbnails', array( 'post','slider','home_page','destinations') ); 
add_theme_support('post-thumbnails');

add_image_size( 'sidebar-thumb', 50, 50 ,true);
add_image_size( 'slider-big', 980, 1000, true ); 
//add_theme_support( 'post-thumbnails' );
 





/*
*
* Automatic Feed Links
* 
*/         
add_theme_support( 'automatic-feed-links' );

/*
*
* WP 3.0  custom menus
* 
*/

add_action( 'init', 'rt_theme_navigations' );

function rt_theme_navigations() {
    register_nav_menu( 'rt-theme-main-navigation', __( 'RT Theme Main Navigation' ) );
    register_nav_menu( 'rt-theme-top-navigation', __( 'RT Theme Top Navigation' ) );
    register_nav_menu( 'rt-theme-footer-navigation', __( 'RT Theme Footer Navigation' ) );
    register_nav_menu( 'rt theme custom menus', __( 'RT Theme Custom Menus' ) );
}

wp_create_nav_menu( 'RT Theme Main Navigation Menu', array( 'slug' => 'rt-theme-main-menu' ) );
wp_create_nav_menu( 'RT Theme Top Navigation Menu', array( 'slug' => 'rt-theme-top-menu' ) );
wp_create_nav_menu( 'RT Theme Footer Navigation Menu', array( 'slug' => 'rt-theme-footer-menu') );
wp_create_nav_menu( 'RT Theme Custom Menus', array( 'slug' => 'rt-theme-custom-menus') );
  

/* 
*
*	Pagination
*
*/

function get_page_count(){
    global $wp_query;	
    $count=array('page_count'=>$wp_query->max_num_pages,'post_count'=>$wp_query->post_count);
    return $count;
}

function get_pagination($range = 7){
  global $paged, $wp_query;
  
  if ( !isset($max_page) ) {
    $max_page = $wp_query->max_num_pages;
  }
  if($max_page > 1){
    if(!$paged){
      $paged = 1;
    }
	
    if ($paged > 1){
        echo "<li class=\"arrowleft\">";
            previous_posts_link('&nbsp;');
        echo "</li>\n";
    }
    if($max_page > $range){
    if($paged < $range){
      for($i = 1; $i <= ($range + 1); $i++){
          echo "<li";
          if($i==$paged) echo " class='active'";
          echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
        echo "</li>\n";
      }
    }
    elseif($paged >= ($max_page - ceil(($range/2)))){
      for($i = $max_page - $range; $i <= $max_page; $i++){
          echo "<li";
          if($i==$paged) echo " class='active'";
          echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
        echo "</li>\n";
      }
    }
    elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
      for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
    
        echo "<li";
        if($i==$paged) echo " class='active'";
        echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
        echo "</li>\n";
    
      }
    }
    }
    else{
    for($i = 1; $i <= $max_page; $i++){
        echo "<li";
        if($i==$paged) echo " class=\"active\" ";
        echo "><a href='" . get_pagenum_link($i) ."'>$i</a>";
        echo "</li>\n";
    }
    }
    if ($paged != $max_page){
        echo "<li class=\"arrowright\">";
        next_posts_link('&nbsp;');
        echo "</li>\n";
    }

  }
}


/*
*
*  add a class to active product and portolio links
*  
*/

function rt_nav($link_page,$link_cat){
global $current_page_link,$current_cat_link;
	
    $current_page_link=$link_page;
    $current_cat_link=$link_cat;

         
    //page
    function add_class_page($output) {
        global $current_page_link,$current_cat_link;
        $bul=str_replace('/','\\/','"><a href="'.$current_page_link.'">');
        $bul=str_replace('?','\\?',$bul);
        $degistir=' current-menu-item"><a href="'.$current_page_link.'">';
        return preg_replace('/'.$bul.'/', $degistir, $output, 20); 
    }
     

    //term in page
    function add_class_cat2($output) {
        global $current_page_link,$current_cat_link; 
        $bul=str_replace('/','\\/','"><a href="'.$current_cat_link.'">');
        $bul=str_replace('?','\\?',$bul); 
        $degistir=' current-menu-item"><a href="'.$current_cat_link.'">'; 
        return preg_replace('/'.$bul.'/', $degistir, $output, 20); 
    }

    //check descriptions
    function check_description($output) {
        $check_description  = "";
        if (!preg_match("/\balt-description\b/i", $output)) { 
            $bul='id="rt-theme-menu"'; 
            $degistir='id="rt-theme-menu" class="nodescrtion" ';
            $check_description  = preg_replace('/'.$bul.'/', $degistir, $output, 20);  
        }
        if(!$check_description) $check_description = $output;
        return $check_description; 
    }    
              
              
    //call the main menu
    if ( has_nav_menu( 'rt-theme-main-navigation' ) ){     
        $menuVars = array(
            'menu_id'         => 'rt-theme-menu',
            'menu_class'         => '',
            'echo'            => false,
            'container'       => 'div', 
            'container_class' => '', 
            'container_id'    => 'navigation',
            'theme_location'  => 'rt-theme-main-navigation',
            'walker' => new description_walker()
        );
    }else{
        $menuVars = array(
            'menu'            => 'RT Theme Main Navigation Menu',  
            'menu_id'         => 'rt-theme-menu',
            'menu_class'         => '',
            'echo'            => false,
            'container'       => 'div', 
            'container_class' => '', 
            'container_id'    => 'navigation',
            'theme_location'  => 'rt-theme-main-navigation',
            'walker' => new description_walker()
        );        
    }
    
    if($link_page && $link_cat){
         
        if (!is_attachment()){ 
            $dd = add_filter('wp_nav_menu', 'add_class_page'); 
            $dd = add_filter('wp_nav_menu', 'add_class_cat2');
        }
    }
    
    $dd = add_filter('wp_nav_menu', 'check_description');
    echo wp_nav_menu($menuVars);
}

/*
*
* Navigation descriptions
*
* source http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
*
*/

class description_walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    
        $class_names = $value = '';
    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';
    
        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
    
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    
        $prepend = '';
        $append = '';
        
        if ( trim( esc_attr( $item->description )) != "" && get_option('rttheme_menu_show_desc'))
        {
            $description  =  '<span class="alt-description" >'.esc_attr( $item->description ).'</span>';
        }
        else{
            $description =  '<span></span>' ;
        }
    
        if($depth != 0)
        {
            $description = $append = $prepend = "";
        }
    
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= '</a>';        
        $item_output .= $description.$args->link_after;
        $item_output .= $args->after;
   
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }
}

/*
*
* Find top level item of the current taxonomy
*
*/
function find_top_level_tax($term_id,$taxonomy){
	
    $parent_term = get_term_by('term_id',$term_id, $taxonomy);
    
    if ($parent_term->parent){ 
         
        return find_top_level_tax($parent_term -> parent,$taxonomy);
         
    }else{

        return $term_id;
    }
    
    return;
}


/*
*
* replace [...] more in excerpts 
*
*/
function new_excerpt_more($more) {
    global $post;
    return ' .. <a href="'. get_permalink($post->ID) . ' " class="small_button" >'.__('read more','rt_theme').'</a>';
} 

/*
*
* remove more link in excerpts 
*
*/

function no_excerpt_more($more) {
		return '.. ';
}


/*
*
* replace current-cat as active
*
*/
function category_class($output){
	return preg_replace('/current-cat/', 'current_page_item', $output, 20);
}

/*
*
* replace top-level parent cat as active
*
*/
function category_top_class($output){
	global $term_id,$taxonomy;

	//get top level parent term id 
	$top_level_parent_id=find_top_level_tax($term_id,$taxonomy);
     
     if($top_level_parent_id):
	$term_link=get_term_link(intval($top_level_parent_id),$taxonomy);
	
	//find and replace 	
	$bul=str_replace('/','\\/','"><a href="'.$term_link.'"');
	$bul=str_replace('?','\\?',$bul);
	$degistir=' current_page_item"><a href="'.$term_link.'"';
     return preg_replace('/'.$bul.'/', $degistir, $output, 20);
     else:
     return $output;
	endif;	
	
}


/*
*
*  get the post thumbnail url
*  
*/
function get_post_thumbnail() {
$files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image');
if($files) :
	$keys = array_reverse(array_keys($files));
	$j=0;
	$num = $keys[$j];
	$image=wp_get_attachment_image($num, 'large', false);
	$imagepieces = explode('"', $image);
	$imagepath = $imagepieces[1];
	$url=wp_get_attachment_thumb_url($num);
	return $url; 
endif;
}


//installing RT-THEME WIDGETS
require_once(get_template_directory() . '/rttheme_options/widgets/rt-theme-news-widget.php');


//Get the search bar
function rt_search_form(){
$s_form='<div class="search_bar">';
$s_form.='<form action="'.get_bloginfo('url').'" method="get">';
$s_form.='<fieldset><input type="text" class="search_text" name="s" id="s" value="' . __('SEARCH', 'rt_theme') . '" /><input type="image" src="'.get_bloginfo('template_directory').'/images/pixel.gif" class="searchsubmit" alt="" /></fieldset>';
$s_form.='</form>';
$s_form.='</div>';

echo $s_form;
}

//Get WPML Plugin Flags

function languages_list(){
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)){
        echo '<ul class="flags">';
        foreach($languages as $l){
            echo '<li>';
            if($l['country_flag_url']){
                echo '<a href="'.$l['url'].'" title="'.$l['native_name'].'" class="j_ttip"><img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" /></a>';
            }
            echo '</li>';
        }
        echo '</ul>';
    }
} 

// function my_language_switcher(){
 
//   $languages = icl_get_languages('skip_missing=0&orderby=code');
 
//   if(!empty($languages)){
//     echo '<ul>';
//     foreach($languages as $l){
//       if($l['active'])
//       {
//         $class = 'class="active"';
//       }
//       else
//       {
//         $class = '';
//       }
//       $langs .= '<li><a href="'.$l['url'].'" '.$class.'>'.$l['translated_name'].'</a></li>';
 
//     }
 
//     echo $langs;
//     echo '</ul>';
//   }
 
// }
 
//WPML String Registration 
if(function_exists('icl_register_string')){
    icl_register_string("rt_theme", "Header Text", get_option('rttheme_header_text')); 
    icl_register_string("rt_theme", "Footer Copyright Text", get_option('rttheme_footer_copy'));                        
    icl_register_string("rt_theme", "Social Media", get_option('rttheme_footer_social_media'));
    icl_register_string("rt_theme", "Footer Banner Text", get_option('rttheme_banner_slogan')); 
    icl_register_string("rt_theme", "Footer Banner Button Text", get_option('rttheme_banner_button_text'));                        
    icl_register_string("rt_theme", "Footer Banner Button Link", get_option('rttheme_banner_button_link'));    
}

//the slider
$home_page_slider = get_option("rttheme_slider");
if (!$home_page_slider) $home_page_slider = "cycle";


#
# WPML match post id
#
function wpml_post_id($id){
	if(function_exists('icl_object_id')) {
		return icl_object_id($id,'post',false);
	} else {
		return $id;
	}
}

#
# WPML match page id
#
function wpml_page_id($id){
	if(function_exists('icl_object_id')) {
		return icl_object_id($id,'page',true);
	} else {
		return $id;
	}
}

#
# WPML match categories
#
function wpml_lang_object_ids($ids_array, $type) {
	if(function_exists('icl_object_id')) {
		$res = array();
		
		if(!empty($ids_array) && is_array($ids_array)){
			foreach ($ids_array as $id) {
				$xlat = icl_object_id($id,$type,false);
				if(!is_null($xlat)) $res[] = $xlat;
			}
		}
		
		return $res;
	} else {
		return $ids_array;
	}
}
 



#
# gets orginal paths of images when multi site mode active
#
function find_image_org_path($image) {
	if(is_multisite()){
		global $blog_id;
		if (isset($blog_id) && $blog_id > 0) {
			if(strpos($image,get_bloginfo('wpurl'))!==false){//image is local
				$the_image_path = get_current_site(1)->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$image);
			}else{
				$the_image_path = $image;
			}
		}else{
			$the_image_path = $image;
		}
	}else{
		$the_image_path = $image;
	}
	
	return $the_image_path;
}


#
# returns a post ID from a url
#

function rt_get_attachment_id_from_src ($image_src) { 
		global $wpdb; 
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id    = $wpdb->get_var($query);
		return $id; 
}


?>
<?php //add_theme_support( 'post-thumbnails', array( 'post', 'luxury_travel' ) ); ?>
<?php function luxury_travel() {
    $args = array( 'public' => true, 
        'supports' => array('title','editor','thumbnail', 'excerpt','trackbacks','custom-fields','revisions','author','page-attributes'),
    'label' => 'Luxury_Travel',  );
    register_post_type( 'luxury_travel', $args );
    flush_rewrite_rules();
}
//$pts = get_post_types( array( 'public'=>true, '_builtin'=>false ) );
//print_r($pts);
add_action( 'init', 'luxury_travel' ); 
?>
<?php //add_theme_support( 'post-thumbnails', array( 'post', 'destinations' ) ); ?>
<?php function destinations() {
    $args = array( 'public' => true, 
        'supports' => array('thumbnail','title','editor','excerpt','trackbacks','custom-fields','revisions','author','page-attributes'),
    'label' => 'Destinations' );
    register_post_type( 'destinations', $args );
}
add_action( 'init', 'destinations' ); 
?>
<?php //add_theme_support( 'post-thumbnails', array( 'post', 'personal_concierge' ) ); ?>
<?php function personal_concierge() {
    $args = array( 'public' => true, 
        'supports' => array('thumbnail','title','editor','excerpt','trackbacks','custom-fields','revisions','author','page-attributes'),
    'label' => 'Personal_Concierge' );
    register_post_type( 'personal_concierge', $args );
}
add_action( 'init', 'personal_concierge' ); 
?>
<?php add_action( 'init', 'luxury' );

function luxury() 
{
   register_taxonomy(
      'luxury_taxonomy',
      'luxury_travel',
      array(
         'label' => __( 'Luxury Categories' ),
         'query_var' => false,
         'rewrite' => false,
         'hierarchical' => true
      )
   );
}
?>
<?php add_action( 'init', 'destination' );

function destination() 
{
   register_taxonomy(
      'destinations_taxonomy',
      'destinations',
      array(
         'label' => __( 'Destination Categories' ),
         'rewrite' => false,
         'hierarchical' => true
      )
   );
}
?>
<?php add_action( 'init', 'personalconcierge' );

function personalconcierge() 
{
   register_taxonomy(
      'personalconcierge_taxonomy',
      'personal_concierge',
      array(
         'label' => __( 'Personal Concierge Categories' ),
         'rewrite' => false,
         'hierarchical' => true
      )
   );
}

function define_conts(){
    define('TAX_PERSONALCONCIERGE_TAXONOMY','personal_concierge',false);
    define('TAX_DESTINATIONS_TAXONOMY','destinations',false);
    define('TAX_LUXURY_TAXONOMY','luxury_travel',false);
}
add_action('init','define_conts');
?>
<?php register_sidebar(array(
  'name' => __( 'Custom Sidebar' ),
  'id' => 'right-sidebar',
  'description' => __( 'Widgets in this area will be shown on the right-hand side.' ),
  'before_title' => '<h1>',
  'after_title' => '</h1>'
)); ?>