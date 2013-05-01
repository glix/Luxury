<?php
/*
Plugin Name: RT-THEME NEWS WIDGET
Plugin URI: http://themeforest.net/user/stmcan?ref=stmcan
Description: This widget developed for RT- Wordpress Themes. Adds latest blog posts.
Version: 1.0
Author: Tolga can
Author URI: http://themeforest.net/user/stmcan?ref=stmcan
*/

/* RT_THEME_NEWS_WIDGET Class */
class RT_THEME_NEWS_WIDGET extends WP_Widget {
    function RT_THEME_NEWS_WIDGET() {
        $widget_ops = array( 'classname' => 'rt-theme-news-widget', 'description' => 'Adds a latest blog posts.' );
        parent::WP_Widget( 'css-rt-theme-news-widget', 'RT-THEME NEWS WIDGET', $widget_ops );
    }

    function widget($args, $instance) {
    extract( $args );
    
    if ($id=="home-page-contents"){$home_page=1;}
    if ($id=="footer-content"){$footer=1;}
    
    
    //Find this widget order 	
    $wp_get_sidebars_widgets=wp_get_sidebars_widgets();
    $this_widget_id=$args['widget_id'];
    
    if( isset( $home_page ) ) $this_sidebar_widgets=$wp_get_sidebars_widgets['home-page-contents'];	
    if( isset( $footer ) ) $this_sidebar_widgets=$wp_get_sidebars_widgets['footer-content'];
    
    if(is_array($this_sidebar_widgets)){
	    foreach ($this_sidebar_widgets as $k=>$value){    
		   if ($value==$this_widget_id){
		    $this_widget_order=$k+1;	
		   } 	  	    
	    }
	}
    
	
    $title = apply_filters('title', $instance['title']);
    $rt_news_id= apply_filters('rt_news_id', $instance['rt_news_id']);
    $rt_news_number= apply_filters('rt_news_number', $instance['rt_news_number']);
    $hide_date= isset($instance['hide_date']) ?  apply_filters('hide_date', $instance['hide_date']) : "" ;
    
    $sub_page_class="four";
    $box_image_width="220";		

   
    if(!$rt_news_number){
	   $rt_news_number="10";		
    }	
    ?>
	
 
    <?php
    //boxes width 	
    if($home_page && get_option("rttheme_home_box_width")){//home page      
	   $box_width=get_option("rttheme_home_box_width");
    }elseif(isset( $footer ) && get_option("rttheme_footer_box_width")){//footer     
	   $box_width=get_option("rttheme_footer_box_width");  	    
    }else{
	   $box_width=4;
    }
    
    if($box_width==4){
					   
	   if(fmod($this_widget_order,4)==0){
	    $box_class="four last";
	    $clear=true;
	   }elseif(fmod($this_widget_order,4)==1){
	    $box_class="four first";  
	   }else{
	    $box_class="four";					
	   }
	   
    }elseif($box_width==3){
	   
	   if(fmod($this_widget_order,3)==0){
	    $box_class="three last"; 
	    $clear=true;
	   }elseif(fmod($this_widget_order,3)==1){
	    $box_class="three first";  		
	   }else{
	    $box_class="three"; 					
	   }
	   
    }elseif($box_width==2){
	   
	   if(fmod($this_widget_order,2)==0){
	    $box_class="two last"; 
	    $clear=true;
	   }elseif(fmod($this_widget_order,2)==1){
	    $box_class="two first";  			
	   }else{
	    $box_class="two"; 					
	   }

    }elseif($box_width==5){
	   
	   if(fmod($this_widget_order,5)==0){
	    $box_class="five last"; 
	    $clear=true;
	   }elseif(fmod($this_widget_order,5)==1){
	    $box_class="five first";  			
	   }else{
	    $box_class="five"; 					
	   }	    
	   
    }elseif($box_width==1){ 
	   $box_class="one"; 								    
    }
    
	
	//sidebar case
	if(!$home_page && !$footer){
	    $box_class="four"; 				    
	}
	
	?>
				
		<div class="box <?php echo $box_class;?>">

			<?php if($title):?>
			<!-- box title-->					
			    <h4><?php echo $title;?></h4>
			<?php endif; ?>
  
			<ul class="latest_news sub_navigation">  

			    <?php

			    wp_reset_query();
		     
			    $args=array(
			       'post_type'=>'post',
			       'showposts'=>$rt_news_number,
			       'cat'=>$rt_news_id
			    );
			    
			    
			    $the_query = new WP_Query($args);
			    $more = 0;
			    $i=1;
			    $count_posts = $the_query->post_count;
			    ?>
			    
			   <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post();
			   
				    $title=get_the_title();
				    $link=get_permalink();
				    $date=get_the_time('d M Y');
				    $more = 0;			
			    ?>
					<li>
					<!-- text-->
					<?php if(!$hide_date):?><span class="news_date"><?php echo $date;?></span><?php endif;?>
                         <a href="<?php echo $link;?>"  title="<?php echo $title;?>"><?php echo $title; ?> </a> 
					</li>
			    <?php $i++; endwhile; endif;wp_reset_query();?>
			
			</ul>
		</div>
		<?php if( isset ( $clear ) ):?> <div class="clear"></div><?php endif;?>
	<!-- /news box -->
     
     
    <?php
    }

    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    function form($instance) {
	global $rt_getcat;
	$title = isset($instance['title']) ? esc_attr($instance['title']) : "";
	$rt_news_number= isset($instance['rt_news_number']) ? esc_attr($instance['rt_news_number']) : "";
	$rt_news_id = isset($instance['rt_news_id']) ? esc_attr($instance['rt_news_id']) : "";
	$hide_date= isset($instance['hide_date']) ? esc_attr($instance['hide_date']) : ""; 
    ?>
	<div class="rt-theme-widget">

 	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
 
	Choose a category<br />
	<p>	
		<select name="<?php echo $this->get_field_name('rt_news_id'); ?>">  id="<?php echo $this->get_field_id('rt_news_id'); ?>" >
			<?php foreach ($rt_getcat as $op_val=>$option) { ?>
				<option value="<?php echo $op_val;?>" <?php if ( $rt_news_id  == $op_val) { echo ' selected="selected" '; }?>><?php echo $option; ?></option>
			 <?php } ?>
		</select>
		
		</label>
	</p>
 
	<p> <label for="<?php echo $this->get_field_id('hide_date'); ?>"><?php _e('Hide Dates:'); ?></label> <input  id="<?php echo $this->get_field_id('hide_date'); ?>"   <?php if($hide_date=='on') echo "checked";?> name="<?php echo $this->get_field_name('hide_date'); ?>" type="checkbox"></p>

	<p><label for="<?php echo $this->get_field_id('rt_news_number'); ?>"><?php _e('Number Posts (default: \'10\'):'); ?> <input class="widefat" id="<?php echo $this->get_field_id('rt_news_number'); ?>" name="<?php echo $this->get_field_name('rt_news_number'); ?>" type="text" value="<?php echo $rt_news_number; ?>" /></label></p>

	</div>

<?php // end class
}
}
?>
<?php // register RT_THEME_NEWS_WIDGET widget
add_action('widgets_init', create_function('', 'return register_widget("RT_THEME_NEWS_WIDGET");'));
?>