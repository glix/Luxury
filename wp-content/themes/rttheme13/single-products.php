<?php
/* 
* rt-theme product detail page
*/
global $which_theme;

//taxonomy
$taxonomy = 'product_categories';

//page link
$link_page=get_permalink(get_option('rttheme_product_list'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
    foreach ($terms as $taxindex => $taxitem) {
    if($i==0){
        $link_cat=get_term_link($taxitem->slug,$taxonomy);
        $term_slug = $taxitem->slug;
        $term_id = $taxitem->term_id;
        }
    $i++;
    }
}

//check tabbed page?

$embeded_tabs=array('rt_product_video','rt_chart_file_url','rt_excel_file_url','rt_pdf_file_url','rt_word_file_url');

foreach ($embeded_tabs as $tab_id) {
    if(trim(get_post_meta($post->ID, $tab_id, true))) $tabbed_page="yes";
}

//free tabs count
$tab_count=2;
for($i=0; $i<$tab_count+1; $i++){
    if (trim(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true)))  $tabbed_page="yes";
}

get_header();
wp_reset_query();
if ($terms) {    
?>

    <!-- Page navigation-->
        <div class="breadcrumb"><?php  rt_breadcrumb($post->ID); ?></div>
    <!-- /Page navigation-->
   
    <!--  page contents -->
    <div class="content sub">
       <div class="left">

        <!-- Page Title -->
             <h2><?php the_title(); ?></h2>
             <div class="line"></div>
        <!-- / Page Title -->





                
                <?php
                //photos
                
                //default photo
                if(get_post_meta($post->ID, 'rt_product_image_url', true)):
                    $default_photo  = get_post_meta($post->ID, 'rt_product_image_url', true);
                    $total_photo = 1;
                endif;
                
                
                //other photos
                if(trim(get_post_meta($post->ID, 'rt_other_images', true))):
                    $other_photos = trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", get_post_meta($post->ID, 'rt_other_images', true)));  
                    $total_photo=$total_photo + count( explode("\n", $other_photos) );
                endif;
                
                
                //merge all
                $product_photos=$default_photo ."\n".$other_photos;    

                ?>   
                    
                <?php if($total_photo>1 || (!$default_photo && $total_photo==1) ):?>
                <!-- image slider with scroller -->
                
                <div class="thumbs product_detail">
                 
                                 
                    <!-- "previous page" action -->
                    <?php if($total_photo>3):?><a class="prev browse _left"></a><?php endif;?>
                    
                        <!-- root element for scrollable -->
                        <div class="scrollable <?php if($total_photo<=3):?>noarrow<?php endif;?>">   
                        
                            <!-- root element for the items -->
                            <div class="items"> 
 
                              
                              <?php
						//Product Photos
                        $photo_count = 0;      
						if (trim($product_photos)){
                              $product_photos_split=explode("\n", $product_photos);  
						foreach ($product_photos_split as &$photo_url) {
						?>
                              <div>


                                    <?php
                                    // Resize Portfolio Image
                                    $imgURL = find_image_org_path($photo_url);
                                    $crop 	= true;
                                    if($imgURL) $image_thumb = @vt_resize( '', $imgURL, 0, 150, ''.$crop.'' );
                                    ?>
                                    <a href="<?php echo $photo_url; ?>" title="" rel="prettyPhoto[product]" class="imgeffect plus"><img src="<?php echo $image_thumb["url"];?>" alt="" /></a>
                                    
                               </div>
						<?php $photo_count++;}}?>
                               
                            </div>
                        </div>
                
                    <!-- "next page" action -->
                    <?php if($total_photo>4):?><a class="next browse _right"></a><?php endif;?> 
                </div>
                <!-- image slider with scroller -->

                <div class="line"></div>
                <?php endif;?>
    
    
    <?php 
    $product_video = trim(get_post_meta($post->ID, 'rt_product_video', true)); 
    $rt_other_images = trim(get_post_meta($post->ID, 'rt_other_images', true));
    $rt_chart_file_url  =  get_post_meta($post->ID, 'rt_chart_file_url', true);
    $rt_excel_file_url  =get_post_meta($post->ID, 'rt_excel_file_url', true);
    $rt_pdf_file_url  =get_post_meta($post->ID, 'rt_pdf_file_url', true);
    $rt_word_file_url  =get_post_meta($post->ID, 'rt_word_file_url', true);
    ?>
    
    <?php if($tabbed_page):?>
    <div class="taps_wrap">
        <!-- the tabs -->
        <ul class="tabs">
            <?php if(get_the_content()):?><li><a href="#"><?php _e('General Details','rt_theme');?></a></li><?php endif;?>
            <?php if($product_video):?><li><a href="#"><?php _e('Product Video','rt_theme');?></a></li><?php endif;?>
            <?php if($rt_chart_file_url || $rt_excel_file_url || $rt_pdf_file_url ||$rt_word_file_url ):?><li><a href="#"><?php _e('Documents','rt_theme');?></a></li><?php endif;?>
            <?php
            /*
            *
            *	Free Tabs
            *	
            */				
            for($i=0; $i<$tab_count+1; $i++){ 
                if (trim(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true))){
                  echo '<li><a href="#">'.get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true).'</a></li>';
                }
            }
            ?>
        </ul>
    <?php endif;?>
    
        
        <?php if(get_the_content()):?>
        <!-- General Details -->
        <div class="pane">

                    <?php
                    // Resize Portfolio Image
                    $imgURL = find_image_org_path($default_photo);
                    $crop 	= true;
                    if($imgURL){
                        $singlethumb_1 = @vt_resize( '', $imgURL, 200, 0, ''.$crop.'' ); //200px
                        $singlethumb_2 = @vt_resize( '', $imgURL, 180, 0, ''.$crop.'' );  //180px
                    }
                    ?>
                  
                    
              <!--product image-->
              <?php if($default_photo && $total_photo==1 && !$tabbed_page):?>
              <span class="border alignleft">
              <a href="<?php echo $default_photo;?>" title="<?php the_title(); ?>" class="plus imgeffect" rel="prettyPhoto[product]"><img src="<?php echo $singlethumb_1["url"];?>" alt="<?php the_title(); ?>" /></a>
              </span>
		    <?php elseif($default_photo && $total_photo==1):?>
		    <a href="<?php echo $default_photo;?>" title="<?php the_title(); ?>" class="plus imgeffect" rel="prettyPhoto[product]"><img src="<?php echo $singlethumb_2["url"];?>" alt="<?php the_title(); ?>" class="alignleft" /></a>
              <?php endif;?>
                                   
            <?php the_content(); ?>
            <div class="clear"></div>
        </div>
        <?php endif;?>


        <?php if($product_video):?>
        <!-- Product Video -->
        <div class="pane">
            <?php echo $product_video; ?>
            <div class="clear"></div>
        </div>
        <?php endif;?>

        <?php if($rt_chart_file_url || $rt_excel_file_url || $rt_pdf_file_url ||$rt_word_file_url ):?>
        <!-- Documents -->
        <div class="pane">
        
            <!--doc icons-->
            <ul class="doc_icons">
               <?php if(get_post_meta($post->ID, 'rt_chart_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_chart_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Chart_1.png" alt="" class="png" /><?php _e('Donwload Charts','rt_theme');?></a></li><?php endif;?>
               <?php if(get_post_meta($post->ID, 'rt_excel_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_excel_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/File_Excel.png" alt="" class="png" /><?php _e('Download Excel File','rt_theme');?></a></li><?php endif;?>
               <?php if(get_post_meta($post->ID, 'rt_pdf_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_pdf_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/File_Pdf.png" alt="" class="png" /><?php _e('Download PDF File','rt_theme');?></a></li><?php endif;?>
               <?php if(get_post_meta($post->ID, 'rt_word_file_url', true)):?><li><a href="<?php echo get_post_meta($post->ID, 'rt_word_file_url', true); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/Word.png" alt="" class="png" /><?php _e('Download Word File','rt_theme');?></a></li><?php endif;?>								
            </ul>
            <div class="clear"></div>
        </div>
        <?php endif;?>
        
        <?php
        /*
        *
        *	Free Tabs' Content
        *	
        */				
        for($i=0; $i<$tab_count+1; $i++){ 
            if (trim(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_title', true))){
              echo '<div class="pane">'.do_shortcode(get_post_meta($post->ID, 'rt_free_tab_'.$i.'_content', true)).'<div class="clear"></div></div>';
            }
        }
        ?>
    
    
    <?php if($tabbed_page):?>        
    </div>
    <?php else:?>
    <div class="line"></div>
    <?php endif;?>

    <?php
    /*  Related Products */
    
    if (trim(get_post_meta($post->ID, 'rt_related_products', true))):?>
    <!-- Related Products -->         
    
     
	<div class="related_products">
        <h5><?php _e('Related Products','rt_theme');?></h5>
        <div class="line"></div>
	</div>

 
		<!-- Related Products -->                    

			<?php
               $related_products = true;
			$product_ids=explode("\n",  get_post_meta($post->ID, 'rt_related_products', true));
			
                $p_id_list = "";
			    foreach ($product_ids as $k => $product_id) {
				if (trim($product_id)):
				    $p_id_list.=$product_id.",";  
				endif;
			    }
			    
			    $p_id_list = explode(',',$p_id_list);

				//taxonomy 
				$args=array(
				'post_type'=> 'products', 
				'post_status'=> 'publish',
				'orderby'=> 'menu_order', 
				'ignore_sticky_posts'=>1, 
				'post__in' =>$p_id_list
				);
			    get_template_part( 'product_loop', 'product_categories' );
			?>

		<!-- / Related Products -->
		<?php endif;?>

    <div class="clear"></div>
    </div>

 
    <!-- side bar -->
    <div class="sidebar"><div class="sidebar_back">
    <?php include(get_template_directory()."/sidebar.php"); ?>
    </div></div><div class="clear"></div>
    <!-- / side bar -->
    
    
  

<?php }else{ echo "<h3>No category has been selected for this product, please go Wordpress Admin -> Products -> (This Product) and select at least one category for this product!</h3>";} ?>
    
    </div>
<?php get_footer();?>