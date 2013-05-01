<?php
/* 
* rt-theme product loop
*/

global $args,$related_products,$product_page_content;
query_posts($args);

$box_counter = 0;
if ( have_posts() ) : while ( have_posts() ) : the_post();

//get page and post counts
$page_count=get_page_count();

?>
        
    <!-- box -->
    <?php if (fmod($box_counter,3)==0) :?>
        <div class="box products three first">
    <?php elseif (fmod($box_counter,3)==2) :?>
        <div class="box three products last">        
    <?php else:?>
        <div class="box three products">
    <?php endif;?>
    
        <!-- product image -->
        <?php if(get_post_meta($post->ID, 'rt_product_image_url', true)):?>
        <div class="product_image">
        <span class="border alignleft">
            <a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>" class="imgeffect plus">
		  <?php
		  // Resize Portfolio Image
		  $imgURL = find_image_org_path(get_post_meta($post->ID, 'rt_product_image_url', true));
		  $crop 	= true;
		  if($imgURL) $image_thumb = @vt_resize( '', $imgURL, 188, 0, ''.$crop.'' );
		  ?>
            <img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" />		              
            </a>
        </span><div class="clear"></div>
        </div>
        <?php endif;?>
        
        <!-- product title-->
        <h6><a href="<?php echo get_permalink() ?>" title=""><?php the_title(); ?></a></h6>
        
        <?php if(get_post_meta($post->ID, 'rt_short_description', true)):?>
        <p>
        <!-- text-->
        <?php echo get_post_meta($post->ID, 'rt_short_description', true);?>
        </p>
        <?php endif;?>
        
    </div>
    <!-- /box -->

<?php
      $box_counter++;
      if (fmod($box_counter,3)==0 || $box_counter==$page_count['post_count']){
	      echo "<div class=\"line\"></div>"; 
      }
?>

<?php endwhile?>
<?php
//show pagination if page count bigger then 1
if ($page_count['page_count']>1):
?>
	<!-- paging-->
	<ul class="paging blog"><?php get_pagination(); ?></ul>
	<!-- / paging-->
<?php endif;?>	
<?php endif; wp_reset_query();?>
	 