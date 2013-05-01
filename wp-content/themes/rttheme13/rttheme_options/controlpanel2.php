<?php
$options2 = array (
		/*Home Page Slider*/
		
          
		array("name" => "Select Slider",
				"desc" => "Please select a slider for your home page. ",
				"id" => $shortname."_slider",
				"options" =>  array(
								"cycle"	=>	    "Standart Content Slider",
								"nivo"	=>	    "Nivo Slider",
								"accordion"	=>	    "Accordion Slider"
                                    ),

				"type" => "select"),

		array("name" => "Content Slider Effect Options",
				"desc" => "Please choose an effect for \"Standart Content Slider\"",
				"id" => $shortname."_effect_options",
				"options" =>  array(
								"blindX"	=>	    "blindX",
								"blindY"	=>	    "blindY",
								"blindZ"	=>	    "blindZ",
								"cover"	=>	    "cover",
								"fade"	=>	    "fade",
								"none"	=>	    "none",
								"scrollUp"	=>	    "scrollUp",
								"scrollDown"	=>	    "scrollDown",
								"scrollLeft"	=>	    "scrollLeft",
								"scrollRight"	=>	    "scrollRight",
								"scrollHorz"	=>	    "scrollHorz",
								"scrollVert"	=>	    "scrollVert",
								"slideX"	=>	    "slideX",
								"slideY"	=>	    "slideY",
								"turnUp"	=>	    "turnUp",
								"turnDown"	=>	    "turnDown",
								"turnLeft"	=>	    "turnLeft",
								"turnRight"	=>	    "turnRight",
											),

				"type" => "select"),


		array(
				"name" => "Slider Timeout (seconds)",
				"id" => $shortname."_slider_time_out",
				"type" => "text"),

		array(  "name" => "Slider Height",
				"id" => $shortname."_slider_height",
				"desc" => "set the home page slider height. default value is 300px",				
				"type" => "text"), 
		
		array(  "name" => "Remove slider from home page",
				"id" => $shortname."_remove_slider",
				"type" => "checkbox",
				"std" => "false"),
		

);

$this_file2="controlpanel2.php";
if (  isset($_REQUEST['action']) &&  isset($_REQUEST['page'])  && 'save' == $_REQUEST['action'] & 'controlpanel2.php' == $_REQUEST['page'] ) {
 
		foreach ($options2 as $value) {

				if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); } else { delete_option( $value['id'] ); } }

				 header("Location:?page=".$_REQUEST['page'] ."&saved=true");

		die;
}
?>