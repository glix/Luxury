<?php
$shortname="rttheme";

/*
RT-Theme Admin Arrays 
*/
 
//Categories
$categories = get_categories(array('hide_empty'=>false));
$rt_getcat = array();

foreach ($categories as $category_list ) {
       $rt_getcat[$category_list->cat_ID] = $category_list->cat_name;
}

//Pages
$pages = get_pages();
$rt_getpages = array();
foreach ($pages as $page_list ) {
       $rt_getpages[$page_list ->ID] = $page_list ->post_title;
}

//Top Level Pages
$pages_top_level = get_pages('sort_column=menu_order&depth=0');
$rt_gettoplevelpages = array();
foreach ($pages_top_level as $page_list ) {
	if ($page_list->post_parent == "0") {
       $rt_gettoplevelpages[$page_list ->ID] = $page_list ->post_title;
       }
}

//posts
$posts=query_posts('posts_per_page=-1');
$rt_getposts = array();
foreach ($posts as $page_list ) {
       $rt_getposts[$page_list ->ID] = $page_list ->post_title;
}

//all posts
$allposts=query_posts('posts_per_page=-1&post_type=any');
$rt_getallposts = array();
foreach ($allposts as $page_list ) {
       $rt_getallposts[$page_list ->ID] = $page_list ->post_title;
}

//Portfolio Categories
$porf_terms = get_terms('portfolio_categories', 'orderby=count&hide_empty=0');
$rt_getportfterm = array();

foreach ($porf_terms as $portf_term_list ) {
       $rt_getportfterm[$portf_term_list->slug] = $portf_term_list->name;
}

//Product Categories
$prod_terms = get_terms('product_categories', 'orderby=count&hide_empty=0');
$rt_getprodterm = array();

foreach ($prod_terms as $prod_term_list ) {
       $rt_getprodterm[$prod_term_list->slug] = $prod_term_list->name;
}


wp_reset_query();


add_action('admin_print_scripts','rttheme_admin_scripts');
add_action('admin_print_styles', 'admin_head_addition');
add_action('admin_menu', 'rt_theme_option_menu');

require_once(get_template_directory() . '/rttheme_options/rt_theme_functions.php');  
require_once(get_template_directory() . '/rttheme_options/product_custom_fields.php');
require_once(get_template_directory() . '/rttheme_options/portfolio_custom_fields.php');
require_once(get_template_directory() . '/rttheme_options/slider_custom_fields.php');
require_once(get_template_directory() . '/rttheme_options/home_page_custom_fields.php');
require_once(get_template_directory() . '/rttheme_options/post_custom_fields.php');
require_once(get_template_directory() . '/rttheme_options/controlpanel.php'); 
require_once(get_template_directory() . '/rttheme_options/controlpanel2.php'); 
require_once(get_template_directory() . '/rttheme_options/controlpanel3.php');
require_once(get_template_directory() . '/rttheme_options/controlpanel4.php'); 
require_once(get_template_directory() . '/rttheme_options/controlpanel5.php');  
require_once(get_template_directory() . '/rttheme_options/controlpanel7.php');
?>