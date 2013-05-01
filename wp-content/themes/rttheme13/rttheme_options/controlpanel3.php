<?php
$options3 = array (
		/*portfolio*/
		array(
				"name" => "Select Your Portfolio Page",
				"id" => $shortname."_portf_page",
				"options" => $rt_getpages,
				"type" => "select"),

		/*portfolio start category*/
		array(
				"name" => "Select Portfolio Start Category",
				"desc" => "If you don't select a category the product start page will display all products.",
				"id" => $shortname."_portf_start_cat",
				"options" => $rt_getportfterm,
				"type" => "select"), 

		array(  "name" => "Hide Portfolio Items on Start Page",
				"desc" => "Check this box if you don't want to show portfolio items when clicked your portfolio start page on navigation bar.",
				"id" => $shortname."_portf_first_page_hide",
				"type" => "checkbox",
				"std" => "false"),
 		
		array(
				"name" => "Hide Categories on Single Page's Sidebar",
				"id" => $shortname."_portfolio_hide_categories",
				"type" => "checkbox"),

		array(
				"name" => "Hide Category Buttons on List Pages",
				"id" => $shortname."_portfolio_hide_categories_list",
				"type" => "checkbox"), 
 
		
 		array(
				"name" => "How many portfolio item do you want to display per page?",
				"id" => $shortname."_portf_pager",
				"type" => "text"),

		array(
				"name" => "OrderBy Parameter",
				"desc" => "sort your portfolio by this parameter",
				"id" => $shortname."_portf_list_orderby",
				"options" => array('author'=>'Author','date'=>'Date','title'=>'Title','modified'=>'Modified','ID'=>'ID','rand'=>'Randomized'),
				"type" => "select"),

		array(
				"name" => "Order",
				"desc" => "Designates the ascending or descending order of the ORDERBY parameter",
				"id" => $shortname."_portf_list_order",
				"options" => array('ASC'=>'Ascending','DESC'=>'Descending'),
				"type" => "select"),

 
		
);

$this_file3="controlpanel3.php";
if (  isset($_REQUEST['action']) &&  isset($_REQUEST['page'])  && 'save' == $_REQUEST['action'] & 'controlpanel3.php' == $_REQUEST['page'] ) {
 
		foreach ($options3 as $value) {

				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

		
			 header("Location:?page=".$_REQUEST['page'] ."&saved=true");

		die;
}
?>