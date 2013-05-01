<?php
$options5 = array (
		/*blog*/
		array(
				"name" => "Select Blog Categories",
				"id" => $shortname."_blog_ex_cat[]",
				"options" => $rt_getcat,
				"desc" => "If you don't select any category the blog start page will display all categories.",
				"type" => "selectmultiple"),

		array(
				"name" => "Select Your Blog Page",
				"id" => $shortname."_blog_page",
				"options" => $rt_getpages,
				"type" => "select"),

 		array(
				"name" => "Don't show blog categories on sidebar of blog page and single blog posts",
				"id" => $shortname."_blog_hide_categories",
				"type" => "checkbox"),		

 		array(
				"name" => "Disable autoresize function for featured images",
				"id" => $shortname."_blog_resize",
				"type" => "checkbox"),

 		array(
				"name" => "Hide \"About the Author\" box under the posts.",
				"id" => $shortname."_hide_author_info",
				"type" => "checkbox"),          
);

$this_file5="controlpanel5.php";
if (  isset($_REQUEST['action']) &&  isset($_REQUEST['page'])  && 'save' == $_REQUEST['action'] & 'controlpanel5.php' == $_REQUEST['page'] ) {
 
		foreach ($options5 as $value) {

				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }
				 header("Location:?page=".$_REQUEST['page'] ."&saved=true");

						//rttheme_blog_ex_cat[]
						if($_REQUEST['rttheme_blog_ex_cat']!=""){
							$slider_category_final="";
							foreach($_REQUEST['rttheme_blog_ex_cat']  as $slider_category) {
									$slider_category_final .= $slider_category .",";
							}
							update_option( "rttheme_blog_ex_cat[]", $slider_category_final);
						}
		die;
}
?>