<?php
/* RT-Theme Shortcodes */ 


/*using shortcodes in widgets*/

add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//shortcodes 

/*
* ------------------------------------------------- *
*		Fix shortcodes
* ------------------------------------------------- *
*/

function fixshortcode($content){

     //fix

	//remove invalid p
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	
	//fix line shortcode
     $content = preg_replace('#<p>\n<div class="line top #', '<div class="line top ', trim($content));

     $content = preg_replace('#<p>\n<div class="line"></div>\n</p>#', '<div class="line"></div>', trim($content)); 
     $content = preg_replace('#<p>\n<div class="line">#', '<div class="line">', trim($content));
    
	return $content;
}




/*
* ------------------------------------------------- *
*		twitter feeds		
* ------------------------------------------------- *		
*/

//Social Media Holder 
function rt_twitter( $atts, $content = null ) {
	//[twitter username="" count=""]
	$username = $atts['username'];
    $count = $atts['count'];
	$rt_twitter = do_shortcode(strip_tags($content));
	$rt_twitter.='<img src="'.get_template_directory_uri().'/images/social_media/twitter_32.png" class="title_icon" /><h4><a href="http://twitter.com/'.$username.'">'.__('Twitter Feeds','rt_theme').'</a></h4><div class="tweets"><script type="text/javascript">jQuery(document).ready(function(){if (jQuery(\'.tweets\').length>0){jQuery(\'.tweets\').tweet({count: '.$count.', username:"'.$username.'",loading_text: "..."});}});</script></div>';
	return $rt_twitter;
}
add_shortcode('twitter', 'rt_twitter');


/*
* ------------------------------------------------- *
*		flickr feeds		
* ------------------------------------------------- *		
*/

//Social Media Holder 
function rt_flickr( $atts, $content = null ) {
    //[flickr userid="" count=""]
    $userid = $atts['userid'];
    $count = $atts['count'];
    $rt_flickr .= do_shortcode(strip_tags($content));
    $rt_flickr.='<h4><a href="http://www.flickr.com/photos/'.$userid.'/"><img src="'.get_template_directory_uri().'/images/social_media/flickr_32.png" class="title_icon" />'.__('Flickr','rt_theme').'</a></h4><ul id="flickr" class="thumbs"></ul><script type="text/javascript">jQuery(document).ready(function(){if (jQuery(\'#flickr\').length>0){jQuery(\'#flickr\').jflickrfeed({limit: '.$count.',qstrings: {id: \''.$userid.'\' }, itemTemplate: \'<li><span class="border"><a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></span></li>\'}); }});</script>';
    return $rt_flickr;
}
add_shortcode('flickr', 'rt_flickr');


/*
* ------------------------------------------------- *
*		Latest Posts		
* ------------------------------------------------- *		
*/

function rt_posts( $atts, $content = null ) {
    //[posts count="" categories=""] 
    $categories = $atts['categories'];
    $count = $atts['count']; if(!$count) $count = 5;
    
    
    $rt_posts .= do_shortcode(strip_tags($content));    
    $postargs=array('post_type'=>'post','showposts'=>$count,'cat'=>$categories);    
    $post_query = new WP_Query($postargs); 
    
    $rt_posts .= '<ul class="popular_posts">';
    
    if ($post_query->have_posts()) : while ($post_query->have_posts()) : $post_query->the_post();
    				    
        $post_title=get_the_title();
        $link=get_permalink();
        $date=get_the_time('d M Y');
                        
        $rt_posts .='<li>';
        
        if ( has_post_thumbnail() ) :
            $rt_posts .='<span class="border alignleft thumb">'.get_the_post_thumbnail($post->ID,'sidebar-thumb').'</span>';
        endif;
        
        $rt_posts .='<span class="date">'.$date.'</span><br />';
        $rt_posts .='<a href="'.$link.'">'.$post_title.'</a>';
        $rt_posts .='<div class="clear"></div></li>';
                     
    endwhile;endif;wp_reset_query();
    $rt_posts .= '</ul>';
      
    return $rt_posts;
}

add_shortcode('posts', 'rt_posts');



/*
* ------------------------------------------------- *
*		social media		
* ------------------------------------------------- *		
*/

//Social Media Holder 
function rt_social_media( $atts, $content = null ) {
	//[social_media]
	$rt_photo_gallery='<div class="social_media_icons">';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='<div class="clear"></div></div>';
	return $rt_photo_gallery;
}

//Social Media Icons
function rt_social_media_links( $atts, $content = null ) {
	//[media name="" url="" alt_text=""]
	
     //alt text
     if($atts["alt_text"]):
     $alt_text = $atts["alt_text"];
     else:
     $alt_text = $atts["name"];
     endif;
     
	//clear p tag
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));	 
	return '<a href="'.trim($atts["url"]).'" class="j_ttip" title="'.trim($alt_text).'"><img src="'.get_template_directory_uri().'/images/social_media/'.trim($atts["name"]).'_16.png" alt="'.trim($atts["name"]).'" /></a>';
}

add_shortcode('social_media', 'rt_social_media');
add_shortcode('media', 'rt_social_media_links');


/*
* ------------------------------------------------- *
*		logos		
* ------------------------------------------------- *		
*/

//logo Holder 
function rt_logos( $atts, $content = null ) {
	//[logos]
	$rt_logos='<ul class="logos">';
	$rt_logos .= do_shortcode(strip_tags($content));
	$rt_logos.='</ul>';
	return $rt_logos;
}

//logos
function rt_logo_links( $atts, $content = null ) {
	//[logo image="" url="" alt_text=""]

	//clear p tag
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
     
     //alt text 
     $alt_text = $atts["alt_text"];
     $image_link=$atts["url"];
     $image=$atts["image"];
     
     $logo="<li>";
     
     if($image_link) $logo .= '<a href="'.trim($atts["url"]).'" class="j_ttip" title="'.trim($alt_text).'" >';     
     $logo .= '<img src="'.trim($atts["image"]).'" alt="'.trim($atts["alt_text"]).'" />';
     if($image_link) $logo .= '</a>';
 
     return $logo;
}

add_shortcode('logos', 'rt_logos');
add_shortcode('logo', 'rt_logo_links');

/*
* ------------------------------------------------- *
*		highlights
* ------------------------------------------------- *		
*/
function rt_highlights( $atts, $content = null ) {
	// [hlight red - yellow - black][/hlight]
	
	//class
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);		
	}else{
		$class="htext";
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = '<span class="'.$class.'">'.trim($content).'</span>';
	 
	return $content;
}
add_shortcode('hlight', 'rt_highlights');


/*
* ------------------------------------------------- *
*		pull qoutes		
* ------------------------------------------------- *		
*/
function rt_pull_quotes( $atts, $content = null ) {
	// [pullquote align=""][/pullquote]
	
	//class
	if (isset($atts["align"]) && trim($atts["align"])){
		$align='align'.trim($atts["align"]);		
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = '<blockquote class="border pullquote '.$align.'">'.trim($content).'</blockquote>';
	 
	return $content;
}
add_shortcode('pullquote', 'rt_pull_quotes');


/*
* ------------------------------------------------- *
*		dropcaps		
* ------------------------------------------------- *		
*/
function rt_dropcaps( $atts, $content = null ) {
	// [dropcap style=""][/dropcap]
	
	//class
	if (isset($atts["style"]) && trim($atts["style"])){
		$style=trim($atts["style"]);		
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = '<span class="dropcap '.$style.' cufon">'.trim($content).'</span>';
	 
	return $content;
}
add_shortcode('dropcap', 'rt_dropcaps');
/*
* ------------------------------------------------- *
*		lists		
* ------------------------------------------------- *		
*/
function rt_lined_list( $atts, $content = null ) {
	// [list lined - red_arrow - silver_arrow -  blue_arrow - check - star][/list]
	
	//class
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);		
	}
  
	//fix shortcode
	$content = fixshortcode($content);  
	$content = preg_replace('#<ul>#', '<ul class="'.$class.'">', trim($content));
	 
	return $content;
}

add_shortcode('list', 'rt_lined_list');


/*
* ------------------------------------------------- *
*		PHOTO GALLERY		
* ------------------------------------------------- *		
*/ 
function rt_photo_gallery( $atts, $content = null ) {
	//[photo_gallery]
	$rt_photo_gallery='<div class="photo_gallery"><ul>';
	$rt_photo_gallery .= do_shortcode(strip_tags($content));
	$rt_photo_gallery.='</ul><div class="clear"></div></div>';
	return $rt_photo_gallery;
}

function rt_photo_gallery_lines( $atts, $content = null ) {
	//[image url="" thumb_width="" thumb_height="" lightbox="" tooltip=""]
 
 	//defaults
	extract(shortcode_atts(array(  
		"thumb_width" 			=> '130',
		"thumb_height"			=> '130', 
		"lightbox"=> "",
		"title"=>"",
		"tooltip"=>"",
		"url"=>"",
		"photo_link" =>""
	), $atts));
	
	$rt_photo_gallery_lines = "";

 	//lightbox = default is true
	if($lightbox=="" || $lightbox=="yes") $lightbox='rel="prettyPhoto[rt_theme_thumb]"';

	//tooltip - default is true	
	$title ='title="'.$title.'"';
	
 
	$photo=trim($content);
	
	//link - default is image
	if (!$photo_link) $photo_link=trim($content);

                      
	// Resize Image
	$imgURL 	= ($photo);
	$crop 	= true;
	if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $thumb_width, $thumb_height, ''.$crop.'' ); 
				    
	$rt_photo_gallery_lines.='<li><span class="border"><a href="'.$photo_link.' " '.$title.'  '.$lightbox.' class="imgeffect plus"><img src="'.$image_thumb["url"].'" '.$tooltip.' /></a></span></li>';
	
	return $rt_photo_gallery_lines;
}	

add_shortcode('photo_gallery', 'rt_photo_gallery');
add_shortcode('image', 'rt_photo_gallery_lines');


                       
/*
* ------------------------------------------------- *
*	Sidebar Testimonial	
* ------------------------------------------------- *		
*/ 
function rt_testimonial( $atts, $content = null ) {
//[testimonial client_name=""][/testimonial]

    //clear p and br tags     
    $content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
    $content = preg_replace('#^<p>|<\/p>$#', '', trim($content));
    $content = preg_replace('#^<br />$#', '', trim($content));


    //fix shortcode
    $content = fixshortcode($content);     
    
    $rt_testimonial = '<blockquote class="testimonial"><p>';
    $rt_testimonial .= $content;
    $rt_testimonial .= '</p></blockquote>';
    
    if($atts["client_name"]):
    $rt_testimonial .= '<div class="testimonial_name">'.$atts["client_name"].'</div>';
    endif;
    
    return $rt_testimonial;
}

add_shortcode('testimonial', 'rt_testimonial');

/*
* ------------------------------------------------- *
*	Auto Thumbnails & Lightboxes	
* ------------------------------------------------- *		
*/ 
function rt_auto_thumb( $atts, $content = null ) {
	//[auto_thumb width="" height="" link="" lightbox="" align="" title="" alt="" iframe="" tooltip="" frame=""]
 	$rt_auto_thumb  = "";
 	$border_open = "";
 	$border_close = "";

	//clear p and br tags
	$content = preg_replace('#^<\/p>|<p>$#', '', trim($content));
	$content = preg_replace('#^<p>|<\/p>$#', '', trim($content));
	$content = preg_replace('#^<br />$#', '', trim($content));	
     
     
	//lightbox
	$lightbox=trim($atts["lightbox"]);
	if($lightbox!="no") $lightbox="yes";
	if($lightbox=="yes") $lightbox='rel="prettyPhoto[rt_theme_thumb]"';	
	
	//link
	$link= isset ($atts["link"]) ? trim($atts["link"]) : "";	
		
 	//if it's not a video
	if($link=="") $link=$content;
	
	/* icon */
	if (preg_match("/(png|jpg|gif)/",  trim($link) )) {
		$icon="plus";
	} else {
		$icon="play";
	}
 
	
	//other attiributes
	$width=isset ($atts["width"]) ? trim($atts["width"]): "";  
	$height=isset ($atts["height"]) ? trim($atts["height"]) : "";  

	$align=isset ($atts["align"]) ? trim($atts["align"]) : "";
	if(!$align) $align='left';
	
	$alt=isset ($atts["alt"]) ?  trim($atts["alt"]) : "";
	$title=isset ($atts["title"]) ?  trim($atts["title"]) : "";

     //frame
	$frame=isset($atts["frame"]) ? trim($atts["frame"]) : "";
	if($frame!="no" && !empty($frame)) $frame="yes";
	if($frame=="yes"){
        
      if($align=="left"):  $border_open='<span class="border alignleft">';  $border_close='</span>'; endif;
      if($align=="right"):  $border_open='<span class="border alignright">';  $border_close='</span>'; endif;
      if($align=="center"):  $border_open='<span class="aligncenter"><span class="border">';  $border_close='</span></span>'; endif;
     
       $align="";
     }	
	
	//tooltip
	$tooltip=isset($atts["tooltip"]) ? trim($atts["tooltip"]) : "";
	if($tooltip): $tooltip ='title="'.$title.'"'; $title ='title=""';
	else: $title ='title="'.$title.'"';
	endif;
	
	//iframe
	$iframe = isset ($atts["iframe"]) ? trim($atts["iframe"]) : "";
	if ($iframe && $iframe!="false") $iframe= "?iframe=true&width=100%&height=100%";
	if (preg_match("/(mov|avi|swf|vimeo|youtube|screenr)/",  trim($link))): $iframe= ""; else: if($iframe && trim($atts["link"])) $icon="";endif;
	
	//fix the width for center align
 
	//result
  
	if (trim($content)):
	// Resize Image
	$imgURL 	= ($content);
	$crop 	= true;
	if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $width, $height, ''.$crop.'' );
	
	$rt_auto_thumb.='<a href="'.$link.''.$iframe.' " '.$title.'  '.$lightbox.' class="imgeffect '.$icon.'"><img src="'. $image_thumb["url"] .'" alt="'.$alt.'"   class="align'.$align.'" /></a>';	
	else:
	$rt_auto_thumb.='<a href="'.$link.''.$iframe.' " title="'.trim($atts["title"]).'"  '.$lightbox.' >'.trim($atts["title"]).'</a>';
	endif;
 	$rt_auto_thumb = $border_open . $rt_auto_thumb . $border_close;
 
	
	return $rt_auto_thumb;
}

add_shortcode('auto_thumb', 'rt_auto_thumb'); 


/*
* ------------------------------------------------- *
*
*
*		COLUMNS
*		
* ------------------------------------------------- *		
*/


 
/*
* ------------------------------------------------- *
*		two column
* ------------------------------------------------- *
*/

function rt_shortcode_two_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content); 
 
	return '<div class="box two '.$class.'">' . $content . '</div>'.$clear;
	
}

add_shortcode('two_column', 'rt_shortcode_two_column');

/*
* ------------------------------------------------- *
*		three column
* ------------------------------------------------- *
*/

function rt_shortcode_three_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}

	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content); 	
 
	return '<div class="box three '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('three_column', 'rt_shortcode_three_column');



/*
* ------------------------------------------------- *
*		four column
* ------------------------------------------------- *
*/

function rt_shortcode_four_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";	
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content);
	
	return '<div class="box four '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('four_column', 'rt_shortcode_four_column');


/*
* ------------------------------------------------- *
*		five column
* ------------------------------------------------- *
*/

function rt_shortcode_five_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";	
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content);
	
	return '<div class="box five '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('five_column', 'rt_shortcode_five_column');


/*
* ------------------------------------------------- *
*		2:3 column
* ------------------------------------------------- *
*/

function rt_shortcode_2_3_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";	
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content);
	
	return '<div class="box two-three '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('twothird_column', 'rt_shortcode_2_3_column');

/*
* ------------------------------------------------- *
*		3:4 column
* ------------------------------------------------- *
*/

function rt_shortcode_3_4_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";	
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content);
	
	return '<div class="box three-four '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('threefourth_column', 'rt_shortcode_3_4_column');

/*
* ------------------------------------------------- *
*		4:5 column
* ------------------------------------------------- *
*/

function rt_shortcode_4_5_column( $atts, $content = null ) {
	//left side
	$class = "";
	$clear = "";	
	if (isset($atts[0]) && trim($atts[0])){
		$class=trim($atts[0]);
		if (trim($atts[0])=="last") $clear='<div class="clear"></div>';
	}
	
	$content  = apply_filters('the_content',$content);
 
	//fix shortcode
	$content = fixshortcode($content);
	
	return '<div class="box four-five '.$class.'">' . do_shortcode($content) . '</div>'.$clear;
	
}

add_shortcode('fourfith_column', 'rt_shortcode_4_5_column');


/*
* ------------------------------------------------- *
*		Lines
* ------------------------------------------------- *
*/

function rt_shortcode_lines( $atts, $content = null ) {
	//[line toplink="true"]
     global $which_theme;
	if (isset($atts["toplink"]) && trim($atts["toplink"])){
		$line='<div class="line"><span class="top">['.trim($atts["toplink"]).']</span></div>';
	}else{
		$line = '<div class="line"></div>';
	}
	
	return $line;
	
}

add_shortcode('line', 'rt_shortcode_lines');





/*
* ------------------------------------------------- *
*		Contact Form Pages
* ------------------------------------------------- *
*/
function rt_shortcode_contact_form( $atts, $content = null ) {
 
if(isset($atts['title'])) $contact_form= '<h3>'.$atts['title'].'</h3>';
if(isset($atts['text'])) $contact_form.= '<p><i>'.$atts['text'].'</i></p>';

if(isset($atts['email'])){

$contact_form.= "".    
	'<!-- contact form -->'.
	'<div id="result"></div>'.
	'<div id="contact_form">'.
	'	<form class="showtextback" action="'.get_template_directory_uri().'/contact_form.php" name="contact_form" id="validate_form" method="post"><fieldset>'.
	'		<ul>'.
	'			<li><label for="name"></label><input id="name" type="text" title=" " name="name" value="'.__('Your Name: (*)','rt_theme').'" class="required" /> </li>'.
	'			<li><label for="email"></label><input id="email" type="text" title="'.__('Please enter a valid email address','rt_theme').'" name="email" value="'.__('Your Email: (*)','rt_theme').'" class="required email"	 /> </li>'.
	'			<li><label for="phone"></label><input id="phone" type="text" title=" " name="phone" value="'.__('Phone Number','rt_theme').'"  /> </li>'.
	'			<li><label for="company_name"></label><input id="company_name" title=" " type="text" name="company_name" value="'.__('Company Name','rt_theme').'" /> </li>'.
	'			<li><label for="company_url"></label><input id="company_url" title="'.__('Please enter a valid URL.','rt_theme').'" type="text" name="company_url" value="'.__('Company URL','rt_theme').'" /> </li>'.
	'			<li><label for="message"></label><textarea  id="message" title=" " name="message" rows="8" cols="40"	class="required">'.__('Your message (*)','rt_theme').'</textarea></li>'.
	'			<li>'.
	'			<input type="hidden" name="your_email" value="'.trim($atts['email']).'" />'.
	'			<input type="hidden" name="your_web_site_name" value="'.get_bloginfo('name').'" />'.

	'			<input type="hidden" name="text_1" value="'.__('Thanks','rt_theme').'">'.	
	'			<input type="hidden" name="text_2" value="'.__('Your email was successfully sent. We will be in touch soon.','rt_theme').'">'.	
	'			<input type="hidden" name="text_3" value="'.__('There was an error submitting the form.','rt_theme').'">'.	
	'			<input type="hidden" name="text_4" value="'.__('Please enter a valid email address!','rt_theme').'">'.	
	'			<input type="submit" class="button" value="'.__('Send','rt_theme').'"  /><span class="loading"></span></li>'.
	'		</ul>'.
	'	</fieldset></form>'.
	'</div>'.
	'<!-- /contact form -->';
 
	
	
}else{
	$contact_form="ERROR: This shortcode is not contains an email attribute!";
}

return $contact_form;
}

add_shortcode('contact_form', 'rt_shortcode_contact_form');



/*
* ------------------------------------------------- *
*		Contact Form Footer
* ------------------------------------------------- *
*/
function rt_shortcode_contact_form_footer( $atts, $content = null ) {

$contact_form = "";

if(isset($atts['text'])) $contact_form.= '<p><i>'.$atts['text'].'</i></p>';

if(isset($atts['email'])){

$contact_form.= "".    
	'<!-- contact form -->'.
	'<div id="result_footer"></div>'.
	'<div id="contact_form_footer">'.
	'	<form class="showtextback" action="'.get_bloginfo('template_directory').'/contact_form_footer.php"   id="validate_form_footer" method="post"><fieldset>'.
	'		<ul>'.
	'			<li><label for="name"></label><input id="name" type="text" title="*" name="name" value="'.__('Your name: (*)','rt_theme').'" class="required" /> </li>'.
	'			<li><label for="email"></label><input id="email" type="text" title="*" name="email" value="'.__('Your Email: (*)','rt_theme').'" class="required email"	 /> </li>'.
     '			<li><label for="message"></label><textarea  id="message" title="*" name="message" rows="8" cols="40" class="required">'.__('Your message: (*)','rt_theme').'</textarea></li>'.
	'			<li>'.
	'			<input type="hidden" name="your_email" value="'.trim($atts['email']).'" />'.
	'			<input type="hidden" name="your_web_site_name" value="'.get_bloginfo('name').'" />'.

	'			<input type="hidden" name="text_1" value="'.__('Thanks','rt_theme').'">'.	
	'			<input type="hidden" name="text_2" value="'.__('Your email was successfully sent. We will be in touch soon.','rt_theme').'">'.	
	'			<input type="hidden" name="text_3" value="'.__('There was an error submitting the form.','rt_theme').'">'.	
	'			<input type="hidden" name="text_4" value="'.__('Please enter a valid email address!','rt_theme').'">'.
	
	'			<input type="submit" class="submitbutton" value="'.__('Send','rt_theme').'"  /><span class="loading"></span></li>'.
	'		</ul>'.
	'	</fieldset></form>'.
	'</div>'.
	'<!-- /contact form -->';
}else{
	$contact_form="ERROR: This shortcode is not contains an email attribute!";
}

return $contact_form;
}

add_shortcode('contact_form_footer', 'rt_shortcode_contact_form_footer');


/*
* ------------------------------------------------- *
*		Image Slider
* ------------------------------------------------- *
*/
    	


function rt_shortcode_slider( $atts, $content = null ) {
	//[slider][/slider]

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	
 	$content = wpautop(do_shortcode($content));
	$content = fixshortcode($content);
	
	return '<div class="photo_gallery_cycle"><span class="aligncenter"><span class="border"><ul>' . trim($content) . '</ul></span></span><div class="pager"></div><div class="clear"></div></div>';
}

function rt_shortcode_slider_slides( $atts, $content = null ) {
 
	//[slide image_width="" image_height="" link="" alt_text="" auto_resize=""]


	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));	
	
	//dimensions
	$image_width=trim($atts["image_width"]);
	$image_height=trim($atts["image_height"]);
	$link=trim($atts["link"]);
	$alt_text=trim($atts["alt_text"]);
	$auto_resize=trim($atts["auto_resize"]);
 
	if($link){
		$link1='<a href="'.$link.'">';
		$link2='</a>';
	}
	
	
	$slide='<li>';	
	
	if($auto_resize=="true"){
		// Resize Image
		$imgURL 	= ($content);
		$crop 	= true;
		if($imgURL) $image_thumb = @vt_resize( '', $imgURL, $image_width, $image_height, ''.$crop.'' );		
		$slide.=$link1.'<img src="'.$image_thumb["url"].'" width="'.$image_width.'" height="'.$image_height.'" alt="'.$alt_text.'" />'.$link2;
	}else{
		$slide.=$link1.'<img src="'.$content.'" width="'.$image_width.'" height="'.$image_height.'" alt="'.$alt_text.'" />'.$link2;
	}
	$slide.='</li>';
	
	return $slide;
}





add_shortcode('slider', 'rt_shortcode_slider');
add_shortcode('slide', 'rt_shortcode_slider_slides');




/*
* ------------------------------------------------- *
*		Image Slider width thumbnail scroller
* ------------------------------------------------- *
*/
    	


function rt_shortcode_thubm_slider( $atts, $content = null ) {
	//[slider][/slider]

	//fix content
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	
 	$content = wpautop(do_shortcode($content));
	$content = fixshortcode($content);
	
	return '<div class="scrollable_border"><div id="image_wrap" class="aligncenter"><img src="images/pixel.gif" class="aligncenter" /></div><div class="clear"></div><a class="prev browse _left"></a><div class="scrollable"><div class="items big_image">' . trim($content) . '</div></div><a class="next browse _right"></a></div>';
}

function rt_shortcode_thubm_slider_slides( $atts, $content = null ) {
 
    //[thumb_slide link=""]


    //fix content
    $content = preg_replace('#<br \/>#', "",trim($content));
    $content = preg_replace('#<p>#', "",trim($content));
    $content = preg_replace('#<\/p>#', "",trim($content));	
    
    //dimensions
    $image_width=80;
    $image_height=80;

    
    $slide='<div>';	
    
    //max image width
    if(is_page_template( 'full_width_page.php' ))://full width page
    $max_width = 920;
    else:
    $max_width = 660;
    endif;

		// Resize Image
		$imgURL 	= ($content);
		$crop 	= true;
		if($imgURL) {
			$image_thumb = @vt_resize( '', $imgURL, $image_width, $image_height, ''.$crop.'' );
			$image_thumb_2 = @vt_resize( '', $imgURL, $max_width, 0, ''.$crop.'' );			
		}
		
	$slide.='<img src="'.$image_thumb["url"].'" alt="'.$image_thumb_2["url"].'" />';

	$slide.='</div>';
	
	return $slide;
}



add_shortcode('thumb_slider', 'rt_shortcode_thubm_slider');
add_shortcode('thumb_slide', 'rt_shortcode_thubm_slider_slides');



/*
* ------------------------------------------------- *
*		buttons
* ------------------------------------------------- *
*/

function rt_shortcode_buttons( $atts, $content = null ) {
	//[button size="" link="" title="" align=""][/button]
	
	//parameters
	
	$size=trim($atts["size"]);
	if(!$size || $size=="big")  $size="banner_button";
	else $size="small_button";
	
	$link=trim($atts["link"]);
	if(!$link)  $link="#";
	
	$align='align'.trim($atts["align"]);
	
	$title=trim($atts["title"]);

	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

 
	return '<a href="'.$link.'" title="'.$title.'" class="'.$size.' '.$align.'">' . wpautop(do_shortcode($content)) . '</a>';
}

add_shortcode('button', 'rt_shortcode_buttons');



/*
* ------------------------------------------------- *
*		Tabular Content
* ------------------------------------------------- *
*/

function rt_shortcode_tabs( $atts, $content = null ) {
	//[tabs tab1="" tab2="" tab3=""][/tabs]
 
	//fix shortcode
	$content  = apply_filters('the_content',$content);	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 
    
    $tabs ="";
    $tab_name ="";
    for($i=1;$i<10;$i++){
        $tab_name =  isset($atts['tab'.$i]) ? $atts['tab'.$i] : "";
        if($tab_name){
            $tabs .=   '<li><a href="#">'.$tab_name.'</a></li>';
        }
    }

	return '<div class="taps_wrap"><ul class="tabs">'.$tabs.'</ul>'.apply_filters('the_content',$content).'</div>';
}

function rt_shortcode_tab( $atts, $content = null ) {
	//[tab][/tab]
 
	
	//fix shortcode
    $content  = apply_filters('the_content',$content);	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	return ' <div class="pane">' . $content . '</div>';
}

add_shortcode('tabs', 'rt_shortcode_tabs');
add_shortcode('tab', 'rt_shortcode_tab');

/*
* ------------------------------------------------- *
*		Accordions
* ------------------------------------------------- *
*/

function rt_shortcode_accordion( $atts, $content = null ) {
    //[accordion align=""][/accordion]

    //align
    $align = isset($align) ? $atts['align'] : "";
    if($align) $align =  'small _'.$align;
   
    //fix shortcode
    $content  = apply_filters('the_content',$content);	
    $content = fixshortcode($content);
    $content = preg_replace('#<br \/>#', "",trim($content));
    $content = preg_replace('#<p>#', "",trim($content));
    $content = preg_replace('#<\/p>#', "",trim($content)); 
    
    return '<div class="accordion '.$align.'">'.apply_filters('the_content',$content).'</div>';
}

function rt_shortcode_accordion_panel( $atts, $content = null ) {
	//[pane title=""][/pane]
    
    $pane_title=$atts['title'];
	
    //fix shortcode
    $content  = apply_filters('the_content',$content);	
    $content = fixshortcode($content);
    $content = preg_replace('#<br \/>#', "",trim($content));
    $content = preg_replace('#<p>#', "",trim($content));
    $content = preg_replace('#<\/p>#', "",trim($content)); 

    return '<h3>'.$pane_title.'</h3><div class="pane">' . $content . '<div class="clear"></div></div>';
}

add_shortcode('accordion', 'rt_shortcode_accordion');
add_shortcode('pane', 'rt_shortcode_accordion_panel');


/*
* ------------------------------------------------- *
*		frames
* ------------------------------------------------- *
*/

function rt_shortcode_frame( $atts, $content = null ) {
    //[frame align=""][/frame]

    //align
    $align = $atts['align'];

   
    //fix shortcode
    $content = wpautop(do_shortcode($content));	
    $content = fixshortcode($content);
    $content = preg_replace('#<br \/>#', "",trim($content));
    $content = preg_replace('#<p>#', "",trim($content));
    $content = preg_replace('#<\/p>#', "",trim($content)); 
    
    if($align) $align =  'small align'.$align;
    if(!$align) $align =  'fullborder';
    
    return $before.'<span class="border '.$align.'">'.$content.'</span>'.$end;
} 

add_shortcode('frame', 'rt_shortcode_frame'); 



/*
* ------------------------------------------------- *
*		Info Box
* ------------------------------------------------- *
*/

function rt_shortcode_infobox( $atts, $content = null ) {
    //[infobox title="" align=""][/infobox]

    //align
    $align = $atts['align'];
    if($align) $align =  'small _'.$align;
    
    //Title
    $title=$atts['title'];
    
   
    //fix shortcode
    $content  = apply_filters('the_content',$content);	
    $content = fixshortcode($content);
    $content = preg_replace('#<br \/>#', "",trim($content));
    $content = preg_replace('#<p>#', "",trim($content));
    $content = preg_replace('#<\/p>#', "",trim($content)); 
    
    return '<div class="info_box '.$align.'"><div class="info_box_title"><h3>'.$title.'</h3></div><div class="info_box_content">'.$content.'<div class="clear"></div></div></div>';
} 

add_shortcode('infobox', 'rt_shortcode_infobox'); 



/*
* ------------------------------------------------- *
*		Info Table
* ------------------------------------------------- *
*/

function rt_shortcode_info_table( $atts, $content = null ) {
	//[infotable][/infotable]
 
	//fix shortcode
	$content  = apply_filters('the_content',$content);	
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	return '<table class="product_data">' . $content . '</table>';
}

function rt_shortcode_info_table_rows( $atts, $content = null ) {
	//[row label="" value=""] 
 
	//parameters
 	$label=trim($atts["label"]);
	$value=trim($atts["value"]);
	
	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content)); 

	return '<tr><td class="left">' . $label . '</td><td>:</td><td>' . $value . '</td></tr>';
}

add_shortcode('infotable', 'rt_shortcode_info_table');
add_shortcode('row', 'rt_shortcode_info_table_rows');



/*
* ------------------------------------------------- *
*		show shortcode :)
* ------------------------------------------------- *
*/

function rt_shortcode_show_shortcode( $atts, $content = null ) {
 
	//convert html [] spacial chars  

	//fix shortcode
	$content = fixshortcode($content);
	$content = preg_replace('#<br \/>#', "",trim($content));
	$content = preg_replace('#<p>#', "",trim($content));
	$content = preg_replace('#<\/p>#', "",trim($content));
	$content = preg_replace('#\[\/braket_close\]#', "[/show_shortcode]",trim($content));

	
	return '<code>' . htmlspecialchars($content) . '</code>';
}

add_shortcode('show_shortcode', 'rt_shortcode_show_shortcode');



/*
* ------------------------------------------------- *
*		RT-Theme editor shortcodes button 
* ------------------------------------------------- *
*/


/// add the shorcode button
function rt_theme_shortcode_button() {
	if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		return;

	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "rt_theme_add_shortcode_tinymce_plugin");
		add_filter('mce_buttons', 'rt_theme_register_shortcode_button');
	}
}
 
function rt_theme_register_shortcode_button($buttons) {
	array_push($buttons, "|", "rt_themeshortcode");
	return $buttons;
}

// load the js file
function rt_theme_add_shortcode_tinymce_plugin($plugin_array) {
   $plugin_array['rt_themeshortcode'] = get_template_directory_uri() . '/rttheme_options/shortcodes.js';
   return $plugin_array;
}

//refresh the editor 
function refresh_editor($ver) {
  $ver += 3;
  return $ver;
}

// init process for button control
add_filter( 'tiny_mce_version', 'refresh_editor');
add_action( 'init', 'rt_theme_shortcode_button' );


?>