<?php
/*
RT-Theme Custom Post Types Function 
*/ 
	
function rt_theme_custom_posts(){

	//Portfolio
	$labels = array(
	  'name' => _x('Portfolio', 'portfolio'),
	  'singular_name' => _x('portfolio', 'portfolio'),
	  'add_new' => _x('Add New', 'portfolio item'),
	  'add_new_item' => __('Add New portfolio item'),
	  'edit_item' => __('Edit Portfolio Item'),
	  'new_item' => __('New Portfolio Item'),
	  'view_item' => __('View Portfolio Item'),
	  'search_items' => __('Search Portfolio Item'),
	  'not_found' =>  __('No portfolio item found'),
	  'not_found_in_trash' => __('No portfolio item found in Trash'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'rewrite' => array('slug'=>'portfolio','with_front'=>false),
	  'supports' => array('title','editor','author','thumbnail','comments')
	); 
	register_post_type('portfolio',$args);
	
	// Portfolio Categories
	$labels = array(
	  'name' => _x( 'Portfolio Categories', 'taxonomy general name' ),
	  'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Portfolio Category' ),
	  'all_items' => __( 'All Portfolio Categories' ),
	  'parent_item' => __( 'Parent Portfolio Category' ),
	  'parent_item_colon' => __( 'Parent Portfolio Category:' ),
	  'edit_item' => __( 'Edit Portfolio Category' ), 
	  'update_item' => __( 'Update Portfolio Category' ),
	  'add_new_item' => __( 'Add New Portfolio Category' ),
	  'new_item_name' => __( 'New Genre Portfolio Category' ),
	); 	
	
	register_taxonomy('portfolio_categories',array('portfolio'), array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'query_var' => true,
	  '_builtin' => false,
	  'paged'=>true,
	  'rewrite' => array('slug'=>'portfolios','with_front'=>false),
	));
	
	
	//Products
	$labels = array(
	  'name' => _x('Products', 'product'),
	  'singular_name' => _x('product', 'product'),
	  'add_new' => _x('Add New', 'product'),
	  'add_new_item' => __('Add New Product'),
	  'edit_item' => __('Edit Product'),
	  'new_item' => __('New Product'),
	  'view_item' => __('View Product'),
	  'search_items' => __('Search Product'),
	  'not_found' =>  __('No product found'),
	  'not_found_in_trash' => __('No product found in Trash'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'rewrite' => array('slug'=>'product','with_front'=>false),
	  'supports' => array('title','editor','author','thumbnail')
	); 
	register_post_type('products',$args);
	
	// Product Categories
	$labels = array(
	  'name' => _x( 'Product Categories', 'taxonomy general name' ),
	  'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
	  'search_items' =>  __( 'Search Product Category' ),
	  'all_items' => __( 'All Product Categories' ),
	  'parent_item' => __( 'Parent Product Category' ),
	  'parent_item_colon' => __( 'Parent Product Category:' ),
	  'edit_item' => __( 'Edit Product Category' ), 
	  'update_item' => __( 'Update Product Category' ),
	  'add_new_item' => __( 'Add New Product Category' ),
	  'new_item_name' => __( 'New Genre Product Category' ),
	); 	
	
	register_taxonomy('product_categories',array('products'), array(
	  'hierarchical' => true,
	  'labels' => $labels,
	  'show_ui' => true,
	  'query_var' => true,
	  '_builtin' => false,
	  'paged'=>true,
	  'rewrite' => array('slug'=>'products','with_front'=>false),
	));
     

	//Home Page Slider
	$labels = array(
	  'name' => _x('Home Page Slider', 'slider'),
	  'singular_name' => _x('slider', 'slider'),
	  'add_new' => _x('Add New', 'slider'),
	  'add_new_item' => __('Add New Slide'),
	  'edit_item' => __('Edit Slide'),
	  'new_item' => __('New Slide'),
	  'view_item' => __('View Slide'),
	  'search_items' => __('Search Slide'),
	  'not_found' =>  __('No slide found'),
	  'not_found_in_trash' => __('No slide found in Trash'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'rewrite' => array('slug'=>'slide','with_front'=>false),
	  'supports' => array( 'title', 'thumbnail' )
	); 
	register_post_type('slider',$args);
	
	//Home Page Contents
	$labels = array(
	  'name' => _x('Home Page Contents', 'home_page'),
	  'singular_name' => _x('home_page', 'home_page'),
	  'add_new' => _x('Add New Box', 'home_page'),
	  'add_new_item' => __('Add New Box'),
	  'edit_item' => __('Edit Content'),
	  'new_item' => __('New Content'),
	  'view_item' => __('View Content'),
	  'search_items' => __('Search Content'),
	  'not_found' =>  __('No result found'),
	  'not_found_in_trash' => __('No result found in Trash'), 
	  'parent_item_colon' => ''
	);
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true, 
	  'query_var' => true, 
	  'capability_type' => 'post', 
	  'menu_position' => null,
	  'supports' => array( 'title','editor','author','thumbnail')
	); 
	register_post_type('home_page',$args); 
	
}

/* RT-Theme Custom Paging for portfolio and products */
function rt_custom_post_limits( $limits )
{
	if(is_tax()){
		if(get_query_var('product_categories') || get_query_var('taxonomy')=="product_categories"){
			$post_per_page=get_option('rttheme_product_list_pager');
		}elseif(get_query_var('portfolio_categories') || get_query_var('taxonomy')=="portfolio_categories"){
			$post_per_page=get_option('rttheme_portf_pager');
		}else{
			$post_per_page=0;
		}
		
		if($post_per_page>0){	
			$page=get_query_var('paged');
			
			$start=0;
			$end=0;
	 
			if($page=="" || $page<0){
				$start=0;
				$end=$post_per_page;
			}
			
			elseif($page && $page>1){
				$start=$post_per_page*$page-1;
				$end=$start;
			}else{
				$start=0;
				$end=1;
			}
			
			//  offset
			$offset = ($page - 1) * $post_per_page;
			//new limits
			$limits = " LIMIT $offset,$post_per_page";
		}
	}
	
  return $limits;
}

add_filter('post_limits', 'rt_custom_post_limits' );

?>