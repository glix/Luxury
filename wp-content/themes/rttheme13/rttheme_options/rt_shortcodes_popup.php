<?php
 
file_exists('../../../../wp-load.php') ? require_once('../../../../wp-load.php') : require_once('../../../../../wp-load.php');
header('Content-Type: text/html; charset=' . get_bloginfo('charset'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<title>RT-THEME SHORTCODES</title>



<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>  
<script type="text/javascript" src="tiny_mce_popup.js?ver=3223"></script>
<?php
wp_admin_css( 'global', true );
wp_admin_css( 'wp-admin', true );
?>
<style type="text/css">
	#wphead {
		font-size: 80%;
		border-top: 0;
		color: #555;
		background-color: #f1f1f1;
	}
	#wphead h1 {
		font-size: 24px;
		color: #555;
		margin: 0;
		padding: 10px;
	}
	#tabs {
		padding: 15px 15px 3px;
		background-color: #f1f1f1;
		border-bottom: 1px solid #dfdfdf;
	}
	#tabs li {
		display: inline;
	}
	#tabs a.current {
		background-color: #fff;
		border-color: #dfdfdf;
		border-bottom-color: #fff;
		color: #d54e21;
	}
	#tabs a {
		color: #2583AD;
		padding: 6px;
		border-width: 1px 1px 0;
		border-style: solid solid none;
		border-color: #f1f1f1;
		text-decoration: none;
	}
	#tabs a:hover {
		color: #d54e21;
	}
	.wrap h2 {
		border-bottom-color: #dfdfdf;
		color: #555;
		margin: 5px 0;
		padding: 0;
		font-size: 18px;
	}
	#user_info {
		right: 5%;
		top: 5px;
	}
	h3 {
		font-size: 1.1em;
		margin-top: 10px;
		margin-bottom: 0px;
	}
	#flipper {
		margin: 0;
		padding: 5px 20px 10px;
		background-color: #fff;
		border-left: 1px solid #dfdfdf;
		border-bottom: 1px solid #dfdfdf;
	}
	* html {
        overflow-x: hidden;
        overflow-y: scroll;
    }
	#flipper div p {
		margin-top: 0.4em;
		margin-bottom: 0.8em;
		text-align: justify;
	}
	th {
		text-align: center;
	}
	.top th {
		text-decoration: underline;
	}
	.top .key {
		text-align: center;
		width: 5em;
	}
	.top .action {
		text-align: left;
	}
	.align {
		border-left: 3px double #333;
		border-right: 3px double #333;
	}
	.keys {
		margin-bottom: 15px;
	}
	.keys p {
		display: inline-block;
		margin: 0px;
		padding: 0px;
	}
	.keys .left { text-align: left; }
	.keys .center { text-align: center; }
	.keys .right { text-align: right; }
	td b {
		font-family: "Times New Roman" Times serif;
	}
	#buttoncontainer {
		text-align: center;
		margin-bottom: 20px;
	}
	#buttoncontainer a, #buttoncontainer a:hover {
		border-bottom: 0px;
	}
     
     .rt_button{
        padding:3px;
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;  
        border:1px solid #B7B7B7;
        background:#EBEBEB;
        display:inline-block;
        position:relative;
        margin-left:2px;
        text-shadow: 1px 1px 0px #fff;
        cursor: pointer;
     }
     
     td{
        padding:4px 0;
     }
     
     td p {
        font-style: italic;
        color: #989898;
        font-size:10px;
     }
</style>
<script type="text/javascript">
    function rt_send_shortcode(shortcode) {
        window.tinyMCE.execInstanceCommand(window.tinyMCE.activeEditor.editorId, 'mceInsertContent', false, shortcode);
        window.tinyMCE.activeEditor.execCommand('mceRepaint');
        tinyMCEPopup.close();
    }

	function d(id) { return document.getElementById(id); }

	function flipTab(n) {
		for (i=1;i<=6;i++) {
			c = d('content'+i.toString());
			t = d('tab'+i.toString());
			if ( n == i ) {
				c.className = '';
				t.className = 'current';
			} else {
				c.className = 'hidden';
				t.className = '';
			}
		}
	}

    function init() {
        document.getElementById('version').innerHTML = tinymce.majorVersion + "." + tinymce.minorVersion;
        document.getElementById('date').innerHTML = tinymce.releaseDate;
    }
    tinyMCEPopup.onInit.add(init);
</script>
</head>

  
<ul id="tabs">
    <li><a id="tab1" href="javascript:flipTab(1)" title="<?php _e('Layouts') ?>" accesskey="1" tabindex="1" class="current"><?php _e('Layouts') ?></a></li>
    <li><a id="tab2" href="javascript:flipTab(2)" title="<?php _e('Sliders') ?>" accesskey="2" tabindex="2"><?php _e('Images and Sliders') ?></a></li>
    <li><a id="tab3" href="javascript:flipTab(3)" title="<?php _e('humbnails and Lightboxes') ?>" accesskey="3" tabindex="3"><?php _e('Thumbnails and Lightboxes') ?></a></li>
    <li><a id="tab4" href="javascript:flipTab(4)" title="<?php _e('Contents') ?>" accesskey="4" tabindex="4"><?php _e('Contents') ?></a></li>
    <li><a id="tab5" href="javascript:flipTab(5)" title="<?php _e('Contact Forms') ?>" accesskey="5" tabindex="5"><?php _e('Contact Forms') ?></a></li>     
    <li><a id="tab6" href="javascript:flipTab(6)" title="<?php _e('Other Shortcodes') ?>" accesskey="6" tabindex="6"><?php _e('Other Shortcodes') ?></a></li>
</ul>

<div id="flipper" class="wrap">

<div id="content1">
    
   <table>
       
   <tr>
       <td><label for="rt_button_1">Two Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[two_column first] Left Column Content [/two_column] <p></p> [two_column last] Right Column Content [/two_column]')" id="rt_button_1" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_2">Three Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[three_column first] First Column Content [/three_column] <p></p> [three_column] Column Content [/three_column] <p></p> [three_column last] Last Column Content [/three_column]')" id="rt_button_2" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_3">Four Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[four_column first] First Column Content [/four_column] <p></p> [four_column]  Column Content [/four_column] <p></p> [four_column]  Column Content [/four_column] <p></p> [four_column last] Last Column Content [/four_column]')" id="rt_button_3" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_4">Five Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[five_column first] First Column Content [/five_column] <p></p> [five_column]  Column Content [/five_column] <p></p> [five_column]  Column Content [/five_column] <p></p> [five_column]  Column Content [/five_column] <p></p> [five_column last] Last Column Content [/five_column]')" id="rt_button_4" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_5">2:3 and 1:3 Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[twothird_column first] 2:3 Column Content [/twothird_column] <p></p> [three_column last] 1:3 Column Content [/three_column]')" id="rt_button_5" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_6">3:4 and 1:4 Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[threefourth_column first] 3:4 Column Content [/threefourth_column] <p></p> [four_column last] 1:4 Column Content [/four_column]')" id="rt_button_6" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_7">4:5 and 1:5 Columns : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[fourfith_column first] 4:5 Column Content [/fourfith_column] <p></p> [five_column last] Five Column Content [/five_column]')" id="rt_button_7" class="rt_button"></td>
   </tr>
    
   </table>    
 
    
</div>
 


<div id="content2" class="hidden">
    
   <table>
       
   <tr>
       <td><label for="rt_button_8">Image Slider : </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("[slider] <p></p> [slide image_width=\"940\" image_height=\"230\" link=\"your_link\" alt_text=\"check it out\" auto_resize=\"true\"] full path of your image [/slide] <p></p> [slide image_width=\"940\" image_height=\"230\" link=\"your_link\" alt_text=\"check it out\" auto_resize=\"true\"] full path of your image [/slide] <p></p> [/slider]")' id="rt_button_8" class="rt_button"></td>
   </tr>
   
   <tr>
       <td><label for="rt_button_10">Slider with Thumbnail Scroller : </label></td>
       <td><input type="button" value="+ insert" onclick="rt_send_shortcode('[thumb_slider] <p></p> [thumb_slide] full path of your image [/thumb_slide] <p></p> [thumb_slide] full path of your image [/thumb_slide] <p></p> [/thumb_slider]')" id="rt_button_10" class="rt_button"></td>
   </tr>
    
   <tr>
       <td><label for="rt_button_11">Photo Gallery : </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("[photo_gallery] <p></p> [image title=\"sample image\"]full path of your image[/image] <p></p> [image title=\"sample image\"]full path of your image[/image] <p></p> [image title=\"sample image\"]full path of your image[/image] <p></p> [/photo_gallery]")' id="rt_button_11" class="rt_button"></td>
   </tr> 

   </table>     
    
</div> 
 
 <div id="content3" class="hidden">
    
   <table>
        
   <tr>
       <td><label for="rt_button_12">Thumbnail and Lightbox: </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("[auto_thumb width=\"\" height=\"\" link=\"\" lightbox=\"\" align=\"\" title=\"\" alt=\"\" iframe=\"\" frame=\"\"] full path of your image [/auto_thumb]")' id="rt_button_12" class="rt_button"></td><td>  </td>
   </tr>
   
   </table>    
 
   <h4>Parameters of this shortcode</h4>
   <ul>
    <li> <b>link:</b> you can enter different url of the thumbnail image </li>
    <li> <b>width:</b> thumbnail width</li>
    <li> <b>height:</b> thumbnail height</li>
    <li> <b>lightbox:</b> (yes/no) default is yes, enter no to disable lightbox feature</li>
    <li> <b>title:</b> link title text.</li>
    <li> <b>align:</b> (left/right/center) default is left, image alignment</li>
    <li> <b>alt:</b> alt tag for image</li>
    <li> <b>iframe:</b> (true/false) use this paramater if you want to open a page or an external url in a lightbox.</li>
    <li> <b>frame:</b> (yes/no) use this paramater if you want to add a frame to the thubmnail.</li>
    </ul>
   
    
</div> 
 

<div id="content4" class="hidden">
    
   <table>
       
   <tr>
       <td><label for="rt_button_8">Tabs: </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("   [tabs tab1=\"Tab 1\" tab2=\"Tab 2\" tab3=\"Tab 3\"]  <p></p>  [tab]Tab 1 Content [/tab]  <p></p>  [tab]Tab 2 Content[/tab]  <p></p>  [tab]Tab 3  Content [/tab] <p></p> [/tabs]")' id="rt_button_8" class="rt_button"></td>
   </tr>
   

   
   <tr>
       <td><label for="rt_button_10">Accordions: </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode(" [accordion align=\"\"] <p></p> [pane title=\"Accordion Pane 1\"] content [/pane] <p></p> [pane title=\"Accordion Pane 2\"] content [/pane] <p></p> [pane title=\"Accordion Pane 3\"] content [/pane] <p></p> [/accordion]")' id="rt_button_10" class="rt_button"></td>
   </tr>
    
   <tr>
       <td><label for="rt_button_11">Info Box : </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("[infobox title=\"Info Box\"  align=\"\"] content [/infobox]")' id="rt_button_11" class="rt_button"></td>
   </tr> 

   <tr>
       <td><label for="rt_button_11">Content Frame : </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("[frame align=\"\"] content [/frame]")' id="rt_button_11" class="rt_button"></td>
   </tr>
   
   </table>     
    
</div>

<div id="content5" class="hidden">
    
   <table>
       
   <tr>
       <td><label for="rt_button_8">Contact Form: </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("  [contact_form title=\"Form Title\" email=\"youremail@yoursite.com\" text=\"Form description\"] ")' id="rt_button_8" class="rt_button"></td>
   </tr>
  
   <tr>
       <td><label for="rt_button_8">Contact Form for Footer: </label></td>
       <td><input type="button" value="+ insert" onclick='rt_send_shortcode("  [contact_form_footer title=\"Form Title\" email=\"youremail@yoursite.com\" text=\"Form description\"] ")' id="rt_button_8" class="rt_button">
       </td>
       <td>
        <p><< use it only in "Footer Content" widgets.</p>
       </td>
   </tr> 
  
   </table>     
    
</div>

   
<div id="content6" class="hidden">
 
            
       <table>
           
       <tr>
           <td><label>Pullquotes: </label></td>
           <td>
            <input type="button" value="+ insert left" onclick='rt_send_shortcode(" [pullquote align=\"left\"]   <p></p>   content   <p></p>  [/pullquote] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert right" onclick='rt_send_shortcode(" [pullquote align=\"right\"]  <p></p>   content   <p></p>  [/pullquote] ")' id="rt_button_8" class="rt_button">
           </td>
       </tr>
       
    
       <tr>
           <td><label>Lists: </label></td>
            <td>
           <input type="button" value="+ insert lined list" onclick='rt_send_shortcode(" [list lined]<p></p><ul><p></p><li> ...</li><p></p><li> ...</li><p></p><li> ...</li><p></p></ul><p></p>[/list] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert red arrow list" onclick='rt_send_shortcode(" [list red_arrow]<p></p><ul><p></p><li> ...</li><p></p><li> ...</li><p></p><li> ...</li><p></p></ul><p></p>[/list] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert blue arrow list" onclick='rt_send_shortcode(" [list blue_arrow]<p></p><ul><p></p><li> ...</li><p></p><li> ...</li><p></p><li> ...</li><p></p></ul><p></p>[/list] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert red arrow list" onclick='rt_send_shortcode(" [list silver_arrow]<p></p><ul><p></p><li> ...</li><p></p><li> ...</li><p></p><li> ...</li><p></p></ul><p></p>[/list] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert star icon list" onclick='rt_send_shortcode(" [list star]<p></p><ul><p></p><li> ...</li><p></p><li> ...</li><p></p><li> ...</li><p></p></ul><p></p>[/list] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert check icon list" onclick='rt_send_shortcode(" [list check]<p></p><ul><p></p><li> ...</li><p></p><li> ...</li><p></p><li> ...</li><p></p></ul><p></p>[/list] ")' id="rt_button_8" class="rt_button">
           </td>
       </tr>
  
       <tr>
           <td><label for="rt_button_8">Line: </label></td>
           <td><input type="button" value="+ insert" onclick='rt_send_shortcode(" [line] ")' id="rt_button_8" class="rt_button"></td>
       </tr>
       
       <tr>
           <td width="150"><label for="rt_button_8">Line With Top Link: </label></td>
           <td><input type="button" value="+ insert" onclick='rt_send_shortcode(" [line toplink=\"go to top\"] ")' id="rt_button_8" class="rt_button"></td>
       </tr>   
    
       <tr>
           <td><label for="rt_button_8">Show Code: </label></td>
           <td><input type="button" value="+ insert" onclick='rt_send_shortcode(" [show_shortcode] <p></p> [/show_shortcode] ")' id="rt_button_8" class="rt_button"></td>
       </tr>   
    
       <tr>
           <td><label>Highlights: </label></td>
           <td>
           <input type="button" value="+ insert blue" onclick='rt_send_shortcode(" [hlight blue] lorem ipsum [/hlight] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert red" onclick='rt_send_shortcode(" [hlight red] lorem ipsum [/hlight] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert yellow" onclick='rt_send_shortcode(" [hlight yellow] lorem ipsum [/hlight] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert black" onclick='rt_send_shortcode(" [hlight black] lorem ipsum [/hlight] ")' id="rt_button_8" class="rt_button">
           </td>
       </tr>   
     
    
       <tr>
           <td><label>Dropcaps: </label></td>
           <td>
           <input type="button" value="+ insert style 1" onclick='rt_send_shortcode(" [dropcap style=\"style1\"]A[/dropcap] ")' id="rt_button_8" class="rt_button">
           <input type="button" value="+ insert style 2" onclick='rt_send_shortcode(" [[dropcap style=\"style2\"]A[/dropcap] ")' id="rt_button_8" class="rt_button">
           </td>
       </tr>
    
       </table>     
    
</div>

 
</div>

<div class="mceActionPanel">
	<div style="margin: 8px auto; text-align: center;padding-bottom: 10px;">
		<input type="button" id="cancel" name="cancel" value="<?php _e('Close'); ?>" title="<?php _e('Close'); ?>" onclick="tinyMCEPopup.close();" />
	</div>
</div>

