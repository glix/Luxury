<?php
$options4 = array (
		/*gallery*/
		array(
				"name" => "Select Your Product List Page",
				"id" => $shortname."_product_list",
				"options" => $rt_getpages,
				"type" => "select"),

		/*product category for start page */
		array(
				"name" => "Select Product Page Start Category",
				"desc" => "If you don't select a category the product start page will display all products.",
				"id" => $shortname."_product_start_cat",
				"options" => $rt_getprodterm,
				"type" => "select"),
		
		array(  "name" => "Don't Show Products On Start Page",
				"desc" => "Check this box if you don't want to show products when clicked your products page on navigation bar.",
				"id" => $shortname."_products_first_page_hide",
				"type" => "checkbox",
				"std" => "false"),
		array(
				"name" => "Don't show product categories on sidebar of single product items and product lists",
				"id" => $shortname."_product_hide_categories",
				"type" => "checkbox"),
		
 		array(
				"name" => "How many products do you want to display per page?",
				"id" => $shortname."_product_list_pager",
				"type" => "text"),

		array(
				"name" => "OrderBy Parameter",
				"desc" => "sort your products by this parameter",
				"id" => $shortname."_product_list_orderby",
				"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
				"type" => "select"),

		array(
				"name" => "Order",
				"desc" => "Designates the ascending or descending order of the ORDERBY parameter",
				"id" => $shortname."_product_list_order",
				"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
				"type" => "select"),		

);

$this_file4="controlpanel4.php";
if (  isset($_REQUEST['action']) &&  isset($_REQUEST['page'])  && 'save' == $_REQUEST['action'] & 'controlpanel4.php' == $_REQUEST['page'] ) {
 
		foreach ($options4 as $value) {

				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

							//coklu secim 
							if($_REQUEST['rttheme_pdetail_side_pages']!=""){
								foreach($_REQUEST['rttheme_pdetail_side_pages']  as $slider_category) {
										$slider_category_final .= $slider_category .",";
								}
								update_option( "rttheme_pdetail_side_pages[]", $slider_category_final);
							}
							
		
			 header("Location:?page=".$_REQUEST['page'] ."&saved=true");

		die;
}

?>