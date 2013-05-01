<?php
$options = array (

		array(    "name" => "Stlye Options",
				"desc" => "Please choose a style for your theme.",
				"id" => $shortname."_style",
				"options" =>  array(
                                    1 => "Style 1",
                                    2 => "Style 2",
                                    3 => "Style 3",
                                    4 => "Style 4",
                                    5 => "Style 5",
                                ),
				"type" => "select"),
                
		array(
				"name" => "Logo",
				"desc" => "Please enter file URL of your logo",
				"id" => $shortname."_logo_url",
				"type" => "rttheme_upload"),
 		array(
				"name" => "Header Text",
				"desc" => "You can write a text for right of header<br /> e.g. Call Us Free: +01 555 55 55",
				"id" => $shortname."_header_text",
				"type" => "text"),

		array(
				"name" => "Main Navigation Menu",
				"type" => "heading"),
          
 		array(
				"name" => "Show menu item descriptions",
                    "desc" => "Check this box if you want to show description lines under top level menu items.",
				"id" => $shortname."_menu_show_desc",
				"type" => "checkbox"),

		array(
				"name" => "Background Options",
				"type" => "heading"),
          
		array(    "name" => "Pre Defined Backgrounds",
                    "desc" => "You can choose a pre-defined background for your web site.",
                    "id" => $shortname."_static_backgrounds",
                    "options" =>  array(
                                    1 => "Farm (Default)",
                                    2 => "Landscape",
                                    3 => "City",
                                    4 => "Tunnel",
                                    15 => "Sunset",
                                    16 => "Sunset 2 B/W",
                                    5 => "Abstract 1",
                                    6 => "Abstract 2",
                                    7 => "Abstract 3",
                                    8 => "Abstract 4",
                                    9 => "Abstract 5",
                                    10 => "Abstract 6",
                                    11 => "Abstract 7",
                                    12 => "Pattern 1",
                                    13 => "Pattern 2",
                                    14 => "Pattern 3",                                                                               
                                ),
                    "type" => "select"),
          
 		array(
				"name" => "Background Slider",
				"desc" => "To activate the background slider enter image urls line by line. Please note, you can't use background slider and random background option at the same time.  
				
						<blockquote style=\"font-size:11px;\"><u>example</u></blockquote>
						<blockquote style=\"-moz-border-radius: 6px;-khtml-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background:#F8F8F8;font-size:11px;padding:10px;\">
									http://www.myblog.com/images/image_1.png<br />
                                             http://www.myblog.com/images/image_2.png<br />
                                             http://www.myblog.com/images/image_3.png<br />
                            </blockquote> 
				",
 				"id" => $shortname."_background_slider",
				"type" => "textarea"),

 		array(
				"name" => "Random Background Images",
				"desc" => "To activate the random background images enter image urls line by line. 
				
						<blockquote style=\"font-size:11px;\"><u>example</u></blockquote>
						<blockquote style=\"-moz-border-radius: 6px;-khtml-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background:#F8F8F8;font-size:11px;padding:10px;\">
									http://www.myblog.com/images/image_1.png<br />
                                             http://www.myblog.com/images/image_2.png<br />
                                             http://www.myblog.com/images/image_3.png<br />
                            </blockquote> 
				",
 				"id" => $shortname."_random_background",
				"type" => "textarea"),                 



		array(
				"name" => "Widgetized Part of Home Page",
				"type" => "heading"),
 
 		array(
				"name" => "Layout",
				"desc" => "Select the layout of widgetized home page content area.",
				"id" => $shortname."_home_box_width",
				"options" =>  array(
                                    5 => "1/5", 
                                    4 => "1/4",
                                    3 => "1/3",
                                    2 => "1/2",
                                    1 => "1/1"
                                ),
				"type" => "select"),

                
		array(
				"name" => "Footer",
				"type" => "heading"),

 
 		array(
				"name" => "Footer Left Area",
				"desc" => "You can enter a text, html or social media shortcodes for this field. You can find the shortcodes in the documentation file.
				
						<blockquote style=\"font-size:11px;\"><u>example</u></blockquote>
						<blockquote style=\"-moz-border-radius: 6px;-khtml-border-radius: 6px;-webkit-border-radius: 6px;border-radius: 6px;background:#F8F8F8;font-size:11px;padding:10px;\">
									Copyright &copy; 2009 Company Name, Inc.
</blockquote>



				",
 				"id" => $shortname."_footer_copy",
				"type" => "textarea"), 

 		array(
				"name" => "Social Media",
				"desc" => "Use social media shortcodes to add your social media links with icons. Please read \"Shortcodes / Social Media\" section of the documentation file for further details.",
 				"id" => $shortname."_footer_social_media",
				"type" => "textarea"),

 		array(
				"name" => "Layout",
				"desc" => "Select the layout of widgetized home page content area.",
				"id" => $shortname."_footer_box_width",
				"options" =>  array(
                                    5 => "1/5",
                                    4 => "1/4",
                                    3 => "1/3",
                                    2 => "1/2",
                                    1 => "1/1"
                                ),
				"type" => "select"),
          
		array(
				"name" => "Footer Banner",
				"type" => "heading"),
 		array(
				"name" => "Footer Banner Text",
				"desc" => "",
 				"id" => $shortname."_banner_slogan",
				"type" => "text"),

 		array(
				"name" => "Button Text",
				"desc" => "",
 				"id" => $shortname."_banner_button_text",
				"type" => "text"),

 		array(
				"name" => "Button Link",
				"desc" => "",
 				"id" => $shortname."_banner_button_link",
				"type" => "text"),
          
 		array(
				"name" => "Sidebar menu for pages",
				"type" => "heading"),
		
		array(  "name" => "Same Lavel Sub Pages",
				"desc" => "Show same lavel pages on sub page sidebar menu.",
				"id" => $shortname."_same_lavel",
				"type" => "checkbox",
				"std" => "false"),

		array(
				"name" => "Don't show sub pages on page's sidebar",
				"id" => $shortname."_hide_sub_pages",
				"type" => "checkbox"),
		
 		array(
				"name" => "Miscellaneous",
				"type" => "heading"),
				
                
		array(  "name" => "Disable Cufon?",
				"desc" => "Check this box if you want to disable the Cufon Font Replacement Plugin",
				"id" => $shortname."_disable_cufon",
				"type" => "checkbox",
				"std" => "false"),
                                

		array("name" => "Google Analytics Tracking Code",
				"id" => $shortname."_anayltics",
				"type" => "textarea"),

 		
		array(
		"name" 		=> __("Customization",'rt_theme_admin'), 
		"type" 		=> "heading"),	
		

		array(
				"name"      => __("Custom CSS Codes",'rt_theme_admin'),
				"desc"      => __("Paste your css codes. Do not include &lt;stlye&gt;&lt;/stlye&gt; tags or any html tag in this field.",'rt_theme_admin'),
				"id"        => $shortname."_custom_css",
				"hr"        => "true", 
				"type"      => "textarea"
		),
 
                
);
$this_file="controlpanel.php";




if (  isset($_REQUEST['action']) &&  isset($_REQUEST['page'])  && 'save' == $_REQUEST['action'] & 'controlpanel.php' == $_REQUEST['page']) {
		foreach ($options as $value) {
            
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

            //reset menu descriptions if user selected first time
            if($_REQUEST['rttheme_menu_show_desc']!=""){ 
                if(!get_option( "rttheme_first_time")){
                   update_option( "rttheme_first_time", "yes");
                   //reset descriptions of the menu items
                   $reset_desc = " UPDATE $wpdb->posts SET post_content='' WHERE post_type = 'nav_menu_item' ";
                   $wpdb->query($reset_desc, OBJECT);
                }     
            } 

		  header("Location:?page=".$_REQUEST['page'] ."&saved=true");

		die;
}
?>