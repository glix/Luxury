<?php

if ( !class_exists('rt_custom_fields') ) {

	class rt_custom_fields {
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
                    "description"		=> "default is 1:4", 
				"options" =>  array(
                                    1 => "1:1 - Full Width",                          
                                    2 => "1:2",
                                    3 => "1:3",
                                    4 => "1:4",
                                    5 => "1:5",
                                ),
                    "scope"			=>	 array( "post" ), 
				"capability"	=> "edit_post",
				"type" => "select"),
          
			array(
				"name"			=> "portfolio_image",
				"title"			=> "Madia for portfolio posts",
				"description"	=> "You can put here your <b>image</b> or <b>video</b> links which, like youtube, vimeo etc. ",
				"type"			=> "rttheme_upload",
				"scope"			=>	array( "post" ),
				"capability"	=> "edit_post"
			),

			array(
				"name"			=> "portfolio_thumb_image",
				"title"			=> "Thumbnail image for portfolio posts",
				"description"	=> "Write url of an image if you want to use different thumbnail image for the portfolio item. If you are putting this post as image on porfolio item, you don't have to provide thumbnail link beacause it will create automaticly from link above.",
				"type"			=> "rttheme_upload",
				"scope"			=>	array( "post" ),
				"capability"	=> "edit_post"
			),

			array(
				"name"			=> "portfolio_desc",
				"title"			=> "Short description for portfolio posts",
				"description"	=> "",
				"type"			=> "textarea",
				"scope"			=>	array( "post" ),
				"capability"	=> "edit_post"
			),

			array(
				"name"			=> "portf_no_detail",
				"title"			=> "Remove links to post details",
				"description"	=> "",
				"type"			=> "checkbox",
				"scope"			=>	array( "post" ),
				"capability"	=> "edit_post"
			),               
		);
		/**
		* PHP 4 Compatible Constructor
		*/
		function rt_custom_fields() { $this->__construct(); }
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
				add_meta_box( 'rt_custom_fields', 'RT-Theme Portfolio Fields', array( &$this, 'displayCustomFields' ), 'portfolio', 'normal', 'high' );
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
				wp_nonce_field( 'rt_custom_fields', 'rt_custom_fields_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" || $post->post_type=="portfolio" )
									$output = true;
								break;
							}
							case "page": {
								// Output on any page screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="page-new.php" || $post->post_type=="page" || $post->post_type=="portfolio" )
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
					if ($output) { ?>
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
									if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . ( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									break;
								}
								case "rttheme_upload": {
									// rt-upload button
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>';
									echo '<input type="text" style="width:185px;" size="6" class="newtag form-input-tip" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . ( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" /><input type="button" style="width:45px;outline:none;padding:2px 0;" class="rttheme_upload_button '. $this->prefix . $customField[ 'name' ] .' button" value="upload" tabindex="3" />';
									break;
								}

                                        case "select":{
                                            echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
                                            if ( $customField[ 'description' ] ) echo '<p>' . htmlspecialchars($customField[ 'description' ]) . '</p>';
                                              $saved_value=get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true );
                                           ?>
                                            <select style="width:240px;" name="<?php echo $this->prefix . $customField[ 'name' ]; ?>" id="<?php echo $this->prefix . $customField[ 'name' ]; ?>">
                                            <option <?php if ( get_option( $value['id'] ) == 0) { echo ' selected="selected"'; } ?> value="0">Please Select</option>
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

						</div>
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
			if ( !wp_verify_nonce( $_POST[ 'rt_custom_fields_wpnonce' ], 'rt_custom_fields' ) )
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

$rt_custom_fields_var = new rt_custom_fields();
