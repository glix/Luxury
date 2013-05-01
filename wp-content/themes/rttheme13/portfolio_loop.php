<?php
/* 
* rt-theme portfolio loop
*/

global $args,$which_theme;

query_posts($args);

$reset_row_count = 0; 
$counter = 0;                   
/*
* portfolio layout
*/
$portfolio_layout_names=array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"two");
$layout_values=array("5"=>"20","4"=>"25","3"=>"33","2"=>"50","1"=>"100");



//close row function
function reset_row(){
    echo "</div> <!-- / row --><div class=\"clear\"></div> ";
}


if ( have_posts() ) : while ( have_posts() ) : the_post();
 
// Box Width
if(get_post_meta($post->ID, 'rt_layout_options', true)){
	$rttheme_portfolio_layout=get_post_meta($post->ID, 'rt_layout_options', true);
}else{
	$rttheme_portfolio_layout=4;
}

// Image width and headlines for box sizes
switch ($rttheme_portfolio_layout) {
    case 5:
        $w=144;
        $h=100;
        $t=array('<h6>','</h6>');
    break;
    case 4:
        $w=194;
        $h=100;
        $t=array('<h5>','</h5>');
    break;
    case 3:
        $w=272;
        $h=120;
        $t=array('<h5>','</h5>');        
    break;
    case 2:
        $w=434;
        $h=180;
        $t=array('<h4>','</h4>');               
    break;
    case 1:
        $w=434;
        $h=180;
        $t=array('<h3>','</h3>');               
    break;
}

?>

<?php
//Row capacity
$reset_row_count =  $reset_row_count + $layout_values[$rttheme_portfolio_layout];
if (!isset($box_counter)) $box_counter = 1;


    //close row
    if ($reset_row_count  > 100):
        $box_counter=1; 
        $reset_row_count = $layout_values[$rttheme_portfolio_layout];
        reset_row();
    endif;
     
    
    //start row
    if ($box_counter == 1){
        echo "<!-- row --><div class=\"row white\">";
    }
    
    //remove the link
    $remove_link = get_post_meta($post->ID, 'rt_portf_no_detail', true);
?>
    
    
<!-- box -->
<div class="box <?php echo $portfolio_layout_names[$rttheme_portfolio_layout];?> portfolio">

    <?php if($rttheme_portfolio_layout!=1):?>
    <!-- portfolio title-->
    <?php echo $t[0];?><?php if(!$remove_link): ?><a href="<?php echo get_permalink() ?>" title=""><?php endif; ?><?php the_title(); ?><?php if(!$remove_link): ?></a><?php endif; ?><?php echo $t[1];?>
    <?php endif;?>
     
	<?php
	/* Getting image type */
	if (preg_match("/(png|jpg|gif)/", get_post_meta($post->ID, 'rt_portfolio_image', true))) {
		$button="plus";
	} else {
		$button="play";
	}
	?>

    <!-- portfolio image -->	
    <?php if(($button=="play" && get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)) || $button=="plus" || get_post_meta($post->ID, 'rt_portfolio_thumb_image', true)):?>
    <span class="aligncenter"><span class="border">
        <?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?><a href="<?php echo get_post_meta($post->ID, 'rt_portfolio_image', true);?>" title="<?php the_title(); ?>" rel="prettyPhoto[rt_theme_portfolio]" class="imgeffect <?php echo $button;?>"><?php endif;?>
        
        <?php if(get_post_meta($post->ID, 'rt_portfolio_thumb_image', true))://auto resize active?>
            <img src="<?php echo get_post_meta($post->ID, 'rt_portfolio_thumb_image', true);?>" alt="<?php the_title(); ?>" width="<?php echo $w;?>" height="<?php echo $h;?>" />
        <?php else:?>
		  <?php
		  // Resize Portfolio Image
		  $imgURL = find_image_org_path(get_post_meta($post->ID, 'rt_portfolio_image', true));
		  $crop 	= true;
		  if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $w, $h, ''.$crop.'' );
		  ?>
            <img src="<?php echo $image_thumb["url"];?>" alt="<?php the_title(); ?>" />
        <?php endif;?>
        
        <?php if(get_post_meta($post->ID, 'rt_portfolio_image', true)):?></a><?php endif;?>
    </span></span>
    <?php endif;?>
    <!-- / portfolio image -->
    
    <?php if($rttheme_portfolio_layout!=1):?>
    <?php if(get_post_meta($post->ID, 'rt_portfolio_desc', true)):?>
        <p>
        <!-- text-->
        <?php echo get_post_meta($post->ID, 'rt_portfolio_desc', true);?>
        
        <?php if(!$remove_link):?>
             <a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>"><?php _e( 'read more', 'rt_theme' ); ?></a>
        <?php endif;?>
        </p>
    <?php endif;?>
    <?php endif;?>
    
</div>


<?php if($rttheme_portfolio_layout==1):// Full Width Box - Right Side?>
<div class="box two">

    <!-- title-->
    <?php echo $t[0];?><?php if(!$remove_link): ?><a href="<?php echo get_permalink() ?>" title=""><?php endif; ?><?php the_title(); ?><?php if(!$remove_link): ?></a><?php endif; ?><?php echo $t[1];?>
    
    <!-- text-->
    <?php if(get_post_meta($post->ID, 'rt_portfolio_desc', true)):?>
       <p>
       <!-- text-->
       <?php echo get_post_meta($post->ID, 'rt_portfolio_desc', true);?>
       </p>
    <?php endif;?>
    
    <?php if(!$remove_link):?>
    <a href="<?php echo get_permalink() ?>" title="<?php the_title(); ?>" class="small_button nomargin"><?php _e( 'Read More', 'rt_theme' ); ?></a>
    <?php endif;?>
    
</div>
<?php endif;?>                    

<!-- /box -->
 
<?php
//get page and post counts
$page_count=get_page_count();
$post_count=$page_count['post_count'];
    
    $counter++; 
    $box_counter++;
   
    
    //close row
    if ($post_count==$counter): 
        reset_row();
    endif;
?>

<?php endwhile;?>
<?php if($page_count['page_count']>1):?> 
<div class="row silver no-vertical-padding">
	<!-- paging-->
	<ul class="paging portfolio"><?php get_pagination(); ?></ul>
	<!-- / paging-->
</div>
<?php endif;?>


<?php endif; wp_reset_query(); ?>