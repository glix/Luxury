<?php
/*
RT-Theme Dynamic Sidebar Function 
*/

//widgetized home page area and footer layout class 
function home_page_layout_class($params) {
   global $widget_num,$footer_count,$home_contents_count;
    $reset = "";    

    //which one
    $id= $params[0]['id'];

 
    if($id=="home-page-contents"){
        //home page content boxes width				    
        if(get_option("rttheme_home_box_width")){
            $box_width=get_option("rttheme_home_box_width");  
        }else{
            $box_width=4;
        }
    }else{
        //footer boxes width				    
        if(get_option("rttheme_footer_box_width")){
            $box_width=get_option("rttheme_footer_box_width");  
        }else{
            $box_width=4;
        }        
    }

    if($box_width==5){ 
        $box_class="five";     
    }elseif($box_width==4){ 
        $box_class="four"; 
    }elseif($box_width==3){ 
        $box_class="three"; 
    }elseif($box_width==2){
        $box_class="two";  
    }elseif($box_width==1){
        $box_class="one"; 								    
    }
     
    // Widget class
    $class = array();
    
    // Iterated class
    if($id=="footer-content"):
        $footer_count++;
        $widget_num=$footer_count;     
    endif;
    
    if($id=="home-page-contents"):
        $home_contents_count++;
        $widget_num=$home_contents_count;        
    endif;
    
    // Alt class
    if($widget_num==1 || fmod($widget_num,$box_width)==1 || $box_width==1):
        $class[] = $box_class. ' first';
    elseif(fmod($widget_num,$box_width) == 0):
        $class[] = $box_class. ' last';
    else:
        $class[] = $box_class;
    endif;
    
    // clear
    if(fmod($widget_num,$box_width) == 0 || $box_width==1):
        $reset = '<div class="clear"></div>';
    endif;
    
   
   // Join the classes in the array
   $class = join(' ', $class);
   
   // Interpolate the 'my_widget_class' placeholder
   $params[0]['before_widget'] = str_replace('home_page_layout_class', $class, $params[0]['before_widget']);
   $params[0]['after_widget'] = str_replace('reset', $reset, $params[0]['after_widget']);
   return $params;
}


function rt_sidebar($sidebar_id,$sidebar_name,$place){

    //home page contents
    if ($sidebar_name=='Widgetized Home Page Area'){
    register_sidebar(array(
        'id'=> $sidebar_id,
        'name' => $sidebar_name,
        'before_widget' => '<div class="box  home_page_layout_class margin-bottom">', 
        'after_widget' => '</div> reset ',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    }elseif ($sidebar_name=='Footer Content'){
    register_sidebar(array(
        'id'=> $sidebar_id,
        'name' => $sidebar_name,
        'before_widget' => '<div class="box home_page_layout_class margin-bottom">', 
        'after_widget' => '</div> reset ',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
    }else{
    register_sidebar(array(
        'id'=> $sidebar_id,
        'name' => $sidebar_name,
        'before_widget' => '<div class="box four">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));		
    }
    add_filter('dynamic_sidebar_params', 'home_page_layout_class'); 
} 
 

//pre defined sidebars
function rt_widgets_init(){
    $rt_sidebars=array( 
	   "home-page-contents" => "Widgetized Home Page Area" ,
	   "footer-content" => "Footer Content",  
	   "common-sidebar" => "Common Sidebar",	
	   "sidebar-for_pages" => "Sidebar For Pages" ,	
	   "sidebar-for_blog" => "Sidebar For Blog",
	   "sidebar-for-products" => "Sidebar For Products",
	   "sidebar-for-product-categories" => "Sidebar For Product Categories",    
	   "sidebar-for-product-detail-page" => "Sidebar For Product Detail Page",
	   "sidebar-for-portfolio-detail-page" => "Sidebar For Portfolio Detail Page",	   
    );
    foreach ($rt_sidebars as $k => $v) {
	   rt_sidebar($k,$v,@$place);
    } 
}
add_action( 'widgets_init', 'rt_widgets_init' );


//user defined sidebars
function rt_ud_widgets_init(){
        global $rt_ud_sidebars;
    if(get_option('rttheme_ud_sidebars')){
	   $rt_ud_sidebars= split(';',substr(get_option('rttheme_ud_sidebars'), 0, -1));
	   
	   foreach ($rt_ud_sidebars as $k) {
		  $parameters = split(',',$k);
		  $ud_sidebar_id = trim(preg_replace('/\*/','',$parameters[0].'-'.$parameters[1]));
		  rt_sidebar($ud_sidebar_id,$parameters[2],'ud');		  
	   } 
    }
}
add_action( 'widgets_init', 'rt_ud_widgets_init' );

function rt_ud_sidebars($type,$id){
    global $rt_ud_sidebars;
    if ($rt_ud_sidebars){
        foreach ($rt_ud_sidebars as $k) {
            $parameters = explode(',',$k); 
            $item_ids = explode('**',$parameters[0]); 
            foreach ($item_ids as $v){
                if (trim($v)==trim($id) && $parameters[1]==$type){
                    if (function_exists('dynamic_sidebar') && dynamic_sidebar($parameters[2]));
                }
            }
        }
    }
}




//Get embeded and user defined sidebars
function rt_get_sidebar(){
    global $taxonomy,$post;
     

    //Dynamic Sidebars
    if (function_exists('dynamic_sidebar')){
		
        // Home Page
        if(is_home()){	
            dynamic_sidebar('Widgetized Home Page Area');
        }
        
        // Regular Pages
        if(is_page() && $post->ID != wpml_page_id(get_option('rttheme_blog_page')) && $post->ID != wpml_page_id(get_option('rttheme_portf_page'))  && $post->ID != wpml_page_id(get_option('rttheme_product_list'))){	
            dynamic_sidebar('Sidebar For Pages');	
            rt_ud_sidebars('page',$post->ID); 
        }
        
        // Regular Categories - Regular Posts - Blog Sidebar
        if(is_category()  || $post->ID == wpml_page_id(get_option('rttheme_blog_page')) || is_single() && !$taxonomy){
            dynamic_sidebar('Sidebar For Blog');
            
            if (is_category()) rt_ud_sidebars('cat',get_query_var('cat')); // dynamic catgories
            if (is_single()) rt_ud_sidebars('post',$post->ID); // single posts
        }

        // Product Sidebars
        if($post->ID == wpml_page_id(get_option('rttheme_product_list')) || $taxonomy=="product_categories" || get_query_var("product_categories")){		
            dynamic_sidebar('Sidebar For Products');
            
            if (is_tax() || $post->ID == wpml_page_id(get_option('rttheme_product_list'))) {
                dynamic_sidebar('Sidebar For Product Categories');
            }
            
            if (is_tax()) rt_ud_sidebars('product_cat',get_query_var("product_categories"));//product categories user defined sidebars			
            
            if (is_single()) {
                dynamic_sidebar('Sidebar For Product Detail Page');
                rt_ud_sidebars('post',$post->ID);//product detail page user defined sidebars
            }	
        }
        
        // Portfolio Sidebars
        if($post->ID == wpml_page_id(get_option('rttheme_portf_page')) || $taxonomy=="portfolio_categories" || get_query_var("portfolio_categories")){		
             dynamic_sidebar('Sidebar For Portfolio');			
             if (is_tax()) rt_ud_sidebars('portf_cat',get_query_var("portfolio_categories"));//portfolio categories user defined sidebars			
             
             if (is_single()) {
                dynamic_sidebar('Sidebar For Portfolio Detail Page');
                rt_ud_sidebars('post',$post->ID);//portfolio detail page user defined sidebars
             }	
        }
        
        // Common Sidebar - For all site
        dynamic_sidebar('Common Sidebar');
    }
}
?>