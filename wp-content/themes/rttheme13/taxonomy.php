<?php
/* 
* rt-theme product detail page
*/
//echo "hello1";
//global $which_theme;

//taxonomy
$link_page=get_permalink(get_option('rttheme_blog_page'));
//category link
$category_id = get_the_category($post->ID);
$category_id = $category_id[0]->cat_ID;//only one category can be show in the list  - the first one
$link_cat=get_category_link($category_id); 
//redirect to home page if user tries to view slider or home page contents by clicking the view link on admin
$home_page=get_bloginfo('url');
if (get_query_var('home_page') || get_query_var('slider')){ header( 'Location: '.$home_page.'/ ' ) ;} 
get_header();

$blog_full_width = get_post_meta($post->ID, 'rt_blog_full_width', true);
if($blog_full_width):
$width=660;
else:
$width=272;
endif;
$taxonomy = get_query_var('taxonomy'); 
//echo $taxonomy;
$current_posttype = strtoupper(tax_.$taxonomy);
$post_type = constant($current_posttype);
//echo $post_type;
//$post_type = get_post_type( $posttype ); 
//echo $post_type;
//page link
$link_page=get_permalink(get_option('rttheme_product_list'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
  //print_r('<pre>');
 // print_r($terms);
  //print_r('</pre>');
$i=0;
if($terms){
    foreach ($terms as $taxindex => $taxitem) {
    if($i==0){
        $link_cat=get_term_link($taxitem->slug,$taxonomy);
        $term_slug = $taxitem->slug;
        $term_id = $taxitem->term_id;
        //echo $term_id;
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
             <!--<h2><?php //the_title(); ?></h2>
             <div class="line"></div>-->
        <!-- / Page Title -->





                <?php  $args = array( 'hide_empty' => 0 );
                      $terms = get_terms($taxonomy, $args);
                      //print_r($terms);
                      ?>
                      <?php 
                            $term_slug = get_query_var('term');
                            //print_r($term_slug);
                            $taxonomy = get_query_var('taxonomy');
                            $current_term = get_term_by('slug', $term_slug, $taxonomy);
                            //print_r($current_term);
                      ?>
                      <?php ?>
                      <a href="<?php echo $category_link; ?>" title="" class="imgeffect plus">
                        <img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" width="188" height="144" >
                      </a>
                     <div class="pane" style="float:right; width:455px; padding-bottom:20px;">
                      <h2 style="padding-top:0;"><?php echo $current_term->name;?></h2>
                      <?php echo $current_term->description; ?>
                      </div>
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
                                    <!--<a href="<?php //echo $category_link; ?>" title="" class="imgeffect plus">
                                     <img src="<?php //echo z_taxonomy_image_url($category->term_id); ?>" width="188" height="144" >
                                    </a>-->
                                  <a href="<?php //echo $photo_url; ?>" title="" rel="prettyPhoto[product]" class="imgeffect plus"><img src="<?php //echo $image_thumb["url"];?>" alt="" /></a>
                                    
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
    
    <?php //if($tabbed_page):?>
    <div class="line"></div>
    <div class="taps_wrap">
        <!-- the tabs -->
        <ul class="tabs">
            <?php if(get_the_content()):?><li><a href="#"><?php _e('Details','rt_theme');?></a></li><?php endif;?>
            <?php if(get_the_post_thumbnail()):?><li><a href="#"><?php _e('Images','rt_theme');?></a></li><?php endif;?>
            <?php if(get_the_id()):?><li><a href="#"><?php _e('Location','rt_theme');?></a></li><?php endif;?>
            <?php if(get_the_excerpt()):?><li><a href="#"><?php _e('Booking','rt_theme');?></a></li><?php endif;?>
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
    <?php //endif;?>
    
        
        <?php if(get_the_content()):?>
        <!-- Details -->
        <div class="pane">
          <?php echo do_shortcode('[xy_luxury_taxonomy field="text-area"]'); ?>
          <?php echo do_shortcode('[xy_destinations_taxonomy field="text-area-field"]'); ?>
           <?php echo do_shortcode('[xy_personalconcierge_taxonomy field="custom-text"]'); ?>
          <!--Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. <br />

          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. <br />

          Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. <br />-->
                    <?php /* ?>
                    <?php
                    // Resize Portfolio Image
                    $imgURL = find_image_org_path($default_photo);
                    $crop 	= true;
                    if($imgURL){
                        $singlethumb_1 = @vt_resize( '', $imgURL, 200, 0, ''.$crop.'' ); //200px
                        $singlethumb_2 = @vt_resize( '', $imgURL, 180, 0, ''.$crop.'' );  //180px
                    }
                    ?>
                    <?php */ ?>
                    
              <!--product image-->
              <?php if($default_photo && $total_photo==1 && !$tabbed_page):?>
              <span class="border alignleft">
              <a href="<?php echo $default_photo;?>" title="<?php the_title(); ?>" class="plus imgeffect" rel="prettyPhoto[product]"><img src="<?php echo $singlethumb_1["url"];?>" alt="<?php the_title(); ?>" /></a>
              </span>
		    <?php elseif($default_photo && $total_photo==1):?>
		    <a href="<?php echo $default_photo;?>" title="<?php the_title(); ?>" class="plus imgeffect" rel="prettyPhoto[product]"><img src="<?php echo $singlethumb_2["url"];?>" alt="<?php the_title(); ?>" class="alignleft" /></a>
              <?php endif;?>
                                   
            <?php //the_content(); ?>
            <div class="clear"></div>
        </div>
        <?php endif;?>

        
         <!--Images -->
        <?php if(get_the_post_thumbnail()): ?>
          <div class="pane">
            <?php $args = array( 'hide_empty' => 0 );
            $terms = get_terms($taxonomy, $args); 
              //print_r($terms);
              foreach( $terms as $category ): 
             ?>
               
               <span class="border alignleft" style="margin:15px 4px 0 0;">
               <?php $category_link = get_term_link( $category->slug, $taxonomy ); ?>
               <a href="<?php echo $category_link; ?>" title="" class="">
                  <img src="<?php echo z_taxonomy_image_url($category->term_id); ?>" width="188" height="144" >
               </a>
               </span>
          <?php endforeach; ?>
            <div class="clear"></div>
        </div>
        <?php endif; ?>
         <!-- /Images -->

          <!-- Location -->
        <?php if(get_the_id()): ?>
          <div class="pane">
            <?php echo do_shortcode('[xy_luxury_taxonomy field="rich-text-box"]'); ?>
            <?php echo do_shortcode('[xy_destinations_taxonomy field="text"]'); ?>
            <?php echo do_shortcode('[xy_personalconcierge_taxonomy field="custom-textarea"]'); ?>
                  
            <!--<iframe width="630" height="330" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Nokia+i-phones+New+York,+NY,+USA&amp;aq=&amp;sll=40.757512,-73.984418&amp;sspn=0.148494,0.336113&amp;ie=UTF8&amp;hq=Nokia+i-phones&amp;hnear=New+York,+United+States&amp;ll=40.838434,-74.060184&amp;spn=0.435106,0.814756&amp;t=m&amp;output=embed"></iframe>-->
            <div class="clear"></div>
        </div>
        <?php endif; ?>

         <!-- /Location -->
         <?php if(get_the_excerpt()):?>
              <div class="pane">
                <?php echo do_shortcode('[contact-form-7 id="567" title="Contact form 1"]'); ?>
              </div>
              <div class="clear"></div>
         <?php endif; ?>
  <script type="text/javascript">
    myJq(function(){
        //console.debug('hello');
        myJq('.datepick-trigger').click(function(){
            //console.log($(this).parent().find('input'));
            myJq(this).parent().find('input').datepick('show');
        });

        myJq('#startPicker,#endPicker').datepick({ 
        onSelect: customRange, showTrigger: '#calImg'}); 
        function customRange(dates) { 
        if (this.id == 'startPicker') { 
            myJq('#endPicker').datepick('option', 'minDate', dates[0] || null); 
        } 
        else { 
            myJq('#startPicker').datepick('option', 'maxDate', dates[0] || null); 
        } 
    }
});
</script>       
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
    
    //if (trim(get_post_meta($post->ID, 'rt_related_products', true))):?>
    <!-- Related Products -->         
    
  
	<div class="related_products">
        <h5><?php _e('Related Products','rt_theme');?></h5>
        <div class="line"></div>
	</div>
  <?php $answers = new WP_Query(
                array(
                    'post_type' => $post_type, 
                    'tax_query' => array(
                        array(
                            'taxonomy' => $taxonomy, 
                            'field' => 'id', 
                            'terms' => $term_id
                         )
                     )
                  )
            );
            //print_r('<pre>');
            //print_r($answers);
            //print_r('</pre>');
            ?>
            <div class="product_list">
            <?php $box_counter = 0; ?>
            <?php
              if ($answers->have_posts()) : while ($answers->have_posts()) : $answers->the_post();
                      $i++;
      ?>
                  <?php if (fmod($box_counter,3)==0) :?>
                  <div class="box products three first">
                  <?php elseif (fmod($box_counter,3)==2) :?>
                      <div class="box three products last">        
                  <?php else:?>
                      <div class="box three products">
                  <?php endif;?>
                          <div class="product_image">
                            <span class="border alignleft">
                              <?php //$category_link = get_term_link( $category->slug, $taxonomy_name ); ?>
                                <a href="<?php echo get_permalink(); ?>" title="" class="imgeffect plus">
                                  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
                                  <img src="<?php echo $url; ?>" alt="" width="188" height="144" />
                                  <?php //the_post_thumbnail(); ?>
                                </a>
                            </span>
                            <div class="clear"></div>
                        </div>
                        <h6><a href="<?php the_title(); ?>" title="<?php echo the_title(); ?>"><?php the_title(); ?></a></h6>

                        <p>
                        <!-- text-->
                            <?php  the_excerpt(); ?> 
                        </p>
                  </div>
                      <?php
                  
                  endwhile;
              else:
                  ?>
                  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
              <?php endif;
               ?>
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
		<?php //endif;?>

    <div class="clear"></div>
    </div>

 </div>
    <!-- side bar -->
    <div class="sidebar"><div class="sidebar_back">
    <?php include(get_template_directory()."/sidebar.php"); ?>
    </div></div>
    <div class="clear"></div>
    <!-- / side bar -->
    
    <div style="clear:both"></div>
  

<?php }else{ echo "No Post Found";} ?>
    </div>
    <div style="clear:both"></div>
<?php get_footer();?>