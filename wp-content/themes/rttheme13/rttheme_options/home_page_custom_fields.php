<?php
if ( !class_exists('home_page_custom_fields') ) {

	class home_page_custom_fields {
		/**
		* @var  string  $prefix  The prefix for storing custom fields in the postmeta table
		*/
		var $prefix = 'rt_';
		/**
		* @var  array  $customFields  Defines the custom fields available
		*/
		var $customFields =	array(
		
          
          array(
                    "name" => "layout_options",
                    "title" => "Layout Options",
                    "description"		=> "ex: read more", 
				"options" =>  array(
                                    2 => "1:2",
                                    3 => "1:3",
                                    4 => "1:4",
                                    5 => "1:5",
                                    7 => "2:3",
                                    8 => "3:4",
                                    9 => "4:5",
                                    6 => "1:1 - Full Width",                             
                                ),
                    "scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post",
				"type" => "select"), 
               
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
				"name"			=> "second_row",
				"title"			=> "Publish in second row (colored one)",
                    "description"		=> "check this box if you want to publish this content in second row. ",
				"type"			=> "checkbox",
				"scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post"
			),

          array(
                    "name" => "image_align",
                    "title" => "Featured Image Align",
                    "description"		=> "Select a custom alignment for the featured image if you've set any. Default is Left Align", 
				"options" =>  array(
                                    "alignleft" => "Left Align",
                                    "alignright" => "Right Align",
                                    "aligncenter" => "Center Align"
                                ),
                    "scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post",
				"type" => "select"),                

		);
		/**
		* PHP 4 Compatible Constructor
		*/
		function home_page_custom_fields() { $this->__construct(); }
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
				add_meta_box( 'home_page_custom_fields', 'Box Properties', array( &$this, 'displayCustomFields' ), 'home_page', 'normal', 'high' );
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
				wp_nonce_field( 'home_page_custom_fields', 'home_page_custom_fields_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					
					$customField[ 'description' ] = isset($customField[ 'description' ]) ? $customField[ 'description' ] : "";

					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" || $post->post_type=="home_page" )
									$output = true;
								break;
							}
							case "page": {
								// Output on any page screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="page" || $post->post_type=="home_page" )
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
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>';
									echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
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
			if ( !wp_verify_nonce( $_POST[ 'home_page_custom_fields_wpnonce' ], 'home_page_custom_fields' ) )
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

$home_page_custom_fields_var = new home_page_custom_fields();