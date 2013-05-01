<?php
if ( !class_exists('slider_custom_fields') ) {

	class slider_custom_fields {
		/**
		* @var  string  $prefix  The prefix for storing custom fields in the postmeta table
		*/
		var $prefix = 'rt_';
		/**
		* @var  array  $customFields  Defines the custom fields available
		*/
		var $customFields =	array(

			array(
				"name"			=> "second_title",
				"title"			=> "Secondary Title",
				"type"			=> "text",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),
               
			array(
				"name"			=> "slide_text",
				"title"			=> "Text",
				"type"			=> "textarea",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),
               
			array(
				"name"			=> "custom_link",
				"title"			=> "Custom Link",
				"type"			=> "text",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),

			array(
				"name"			=> "custom_link_text",
				"title"			=> "Custom Link Text",
                    "description"		=> "ex: read more",
				"type"			=> "text",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),

			array(
				"name"			=> "hide_titles",
				"title"			=> "Hide Title and Texts",
				"description"	=> "Check this box if you want to display only featured image for this slide",
				"type"			=> "checkbox",
				"scope"			=>	array( "post" ),
				"capability"	=> "edit_post"
			), 
			array(
 
				"name"			=> "cycle_slier",
				"title"			=> "Content Slider Related Features",
				"type"			=> "rttheme_info_before",
				"scope"			=>  array( "post" ), 
				"capability"	=> "edit_post"				
			),
                

          array(
                    "name" => "text_background",
                    "title" => "Slide Text Background",
				"options" =>  array(
                                    "light" => "Light (default)",
                                    "dark" => "Dark",
                                    "none" => "No Background",                            
                                ),
                    "scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post",
				"type" => "select"),

			array(
				"name"			=> "right_side_image",
				"title"			=> "Right Side Image",
                    "description"		=> "",
				"type"			=> "text",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),

			array(
				"name"			=> "right_side_video",
				"title"			=> "Right Side Video",
                    "description"	=> "Paste your emdeb code here. Please note: Multislides with videos are not recommended! Width of the video must be max 460px. If you've not changed the slider height video height can be 260px.",
				"type"			=> "textarea",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),
               
			array(
  
				"type"			=> "rttheme_info_after",
				"scope"			=>  array( "post" ), 
				"capability"	=> "edit_post"				
			),
               
		);
		/**
		* PHP 4 Compatible Constructor
		*/
		function slider_custom_fields() { $this->__construct(); }
		/**
		* PHP 5 Constructor
		*/
		function __construct() {
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ) );
			// Comment this line out if you want to keep default custom fields meta box
			//add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultCustomFields( $type, $context, $post ) {
			foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
				remove_meta_box( 'postcustom', 'post', $context );
				remove_meta_box( 'pagecustomdiv', 'page', $context );
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				add_meta_box( 'slider_custom_fields', 'Home Page Slider', array( &$this, 'displayCustomFields' ), 'slider', 'normal', 'high' );
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post;
			?>
			<div class="form-wrap">
				<?php
				wp_nonce_field( 'slider_custom_fields', 'slider_custom_fields_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					$customField[ 'description' ] = isset($customField[ 'description' ]) ? $customField[ 'description' ] : "";
					$customField[ 'id' ] = isset($customField[ 'id' ]) ? $customField[ 'id' ] : "";

					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" || $post->post_type=="slider" )
									$output = true;
								break;
							}
							case "page": {
								// Output on any page screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="page" || $post->post_type=="slider" )
									$output = true;
								break;
							}
						}
						if ( $output ) break;
					}
					// Check capability
					if ( !current_user_can( $customField['capability'], $post->ID ) )
						$output = false;
					// Output if allowed
					if ( $output ) { ?>
						<div class="inside">
						<div id="postcustomstuff">
						<div class="form-field form-required">
							<?php
							switch ( $customField[ 'type' ] ) {
								case "checkbox": {
									// Checkbox
									if ( $customField[ 'description' ] ) echo '' . $customField[ 'description' ] . '<br /><br />';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label><input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
										echo ' checked="checked"';
									echo '" style="width: auto;" />';
									break;
								}
								case "textarea": {
									// Text area
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									if ( $customField[ 'description' ] ) echo '<p>' . htmlspecialchars($customField[ 'description' ]) . '</p>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . ( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									break;
								}
								case "rttheme_upload": {
									// rt-upload button
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>';
									echo '<input type="text" style="width:185px;" size="6" class="newtag form-input-tip" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . ( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" /><input type="button" style="width:45px;outline:none;padding:2px 0;" class="rttheme_upload_button '. $this->prefix . $customField[ 'name' ] .' button tagadd" value="upload" tabindex="3" />';
									break;
								}

								case "rttheme_info_before":{
								
									echo '<table id="' . $this->prefix . $customField[ 'name' ] .'"><thead><tr><th>' . $customField[ 'title' ] .'</th></tr></thead><tbody><tr><td>';
									if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>';
									break;
								}
								
								case "rttheme_info_after":{
								
									echo "</td></tr></tbody></table>";
									
									break;
								}

                                        
                                        case "select":{
                                            echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                            if ( $customField[ 'description' ] ) echo '<p>' . htmlspecialchars($customField[ 'description' ]) . '</p>';
                                              $saved_value=get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true );
                                           ?>
                                            <select style="width:240px;" name="<?php echo $this->prefix . $customField[ 'name' ]; ?>" id="<?php echo $this->prefix . $customField[ 'name' ]; ?>">
                                            <option value="0">Please Select</option>
                                            <?php foreach ($customField[ 'options' ] as $op_val=>$option) { ?>
                                            <option <?php if ( $saved_value == $op_val) { echo ' selected="selected"'; }  ?> value="<?php echo $op_val; ?>"><?php echo $option; ?></option>
                                            <?php } ?>
                                            </select>
                                            <?php
                                            break;
                                            }
 
          								 
								
								default: {
									// Plain text field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . ( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									break;
								}
							}
							?>						
						</div></div></div>
					<?php
					}
				} ?>
			</div>
			<?php
		}

		/**
		* Save the new Custom Fields values
		*/
		function saveCustomFields( $post_id ) {
			global $post;
			if ( !wp_verify_nonce( $_POST[ 'slider_custom_fields_wpnonce' ], 'slider_custom_fields' ) )
				return $post_id;
			foreach ( $this->customFields as $customField ) {
				if ( current_user_can( $customField['capability'], $post_id ) ) {
					if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
						update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $_POST[ $this->prefix . $customField['name'] ] );
					} else {
						delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
					}
				}
			}
		}

	} // End Class

} // End if class exists statement

$slider_custom_fields_var = new slider_custom_fields();