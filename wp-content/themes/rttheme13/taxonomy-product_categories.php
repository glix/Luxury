<?php
/* 
* rt-theme product list
*/
//taxonomy
$taxonomy = 'product_categories';
$term = get_query_var($taxonomy);
$prod_term = get_terms($taxonomy, 'slug='.$term.''); 
$term_slug = $prod_term[0]->slug;
$term_id = $prod_term[0]->term_id; 
get_header();
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php rt_breadcrumb(); ?></div>
    <!-- /Page navigation-->
   
    <!--  page contents -->
    <div class="content sub">
       <div class="left">

        <!-- Page Title -->
             <h2><?php echo $prod_term[0]->name;?></h2>
             <div class="line"></div>
        <!-- / Page Title -->
 
        <?php if($prod_term[0]->description):?>			
           <?php if (preg_match("/\[slider\]/", $prod_term[0]->description)):?>
                <?php echo do_shortcode($prod_term[0]->description);?> 
           <?php else:?>
                <?php echo apply_filters('the_content',$prod_term[0]->description);?>
           <?php endif;?>
        <div class="line"></div>
        <?php endif;?>
    
        <?php
             //page
             if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
             //this term
             $this_term = get_query_var('product_categories');
                            
             $args=array(
                'post_type'=> 'products',
                'product_categories'=> $this_term ,
                'post_status'=> 'publish',
                'orderby'=> get_option('rttheme_product_list_orderby'),
                'order'=> get_option('rttheme_product_list_order'),             
                'posts_per_page'=>get_option('rttheme_product_list_pager'),
                'ignore_sticky_posts'=>1,
                'paged'=>$paged,
                'cat' => -0,
        );
        ?>
        <?php get_template_part( 'product_loop', 'product_categories' );?>

    <div class="clear"></div>
    </div>
    <!-- / page contents  -->


    <!-- side bar -->
    <div class="sidebar"><div class="sidebar_back">
    <?php include(get_template_directory()."/sidebar.php"); ?>
    </div></div><div class="clear"></div>
    <!-- / side bar -->
    
    
    </div>
    
<?php get_footer();?>