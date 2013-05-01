<?php
/* 
* rt-theme portfolio list
*/
//taxonomy
$taxonomy = 'portfolio_categories';
$term = get_query_var($taxonomy);
$portf_term = get_terms($taxonomy, 'slug='.$term.''); 
$term_slug = $portf_term[0]->slug;
get_header();
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb(); ?></div>
    <!-- /Page navigation-->
    
    <!--  page contents -->
        <div class="content">
            
            <div class="row titlebar">
            <!-- Page Title -->
                <h2><?php echo $portf_term[0]->name;?></h2>
                <div class="line nomargin"></div>
            <!-- / Page Title -->
            </div>

            <?php if($portf_term[0]->description):?>			
            <div class="full vertical-padding">
            <?php echo do_shortcode($portf_term[0]->description);?> 
           </div>
            <?php endif;?>
  
        
        <!-- Start Porfolio Items -->

	       
            <?php
                 //page
                 if (get_query_var('paged') ) {$paged = get_query_var('paged');} elseif ( get_query_var('page') ) {$paged = get_query_var('page');} else {$paged = 1;}
                 //taxonomy
                 $this_term = get_query_var('portfolio_categories');
                                
                 $args=array(
                 'post_type'=> 'portfolio',
                 'portfolio_categories'=> $this_term,
                 'post_status'=> 'publish',
                 'orderby'=> get_option('rttheme_portf_list_orderby'),
                 'order'=> get_option('rttheme_portf_list_order'),
                 'posts_per_page'=>get_option('rttheme_portf_pager'), 
                 'ignore_sticky_posts'=>1,
                 'paged'=>$paged,
                 'cat' => -0,
            );
            ?>
            <?php get_template_part( 'portfolio_loop', 'portfolio_categories' );?>
     
        
        <!-- End Porfolio Items -->
        
	</div>
	<!-- / page contents  -->
      
<?php get_footer();?>