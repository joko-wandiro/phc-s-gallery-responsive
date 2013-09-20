<?php
// Start Add Meta Box
add_action("do_meta_boxes", "phc_s_gallery_responsive_add_meta");
function phc_s_gallery_responsive_add_meta(){
	global $wp_meta_boxes;
	add_meta_box(PHC_S_GALLERY_RESPONSIVE_IDENTIFIER . "meta", 
	PHC_S_GALLERY_RESPONSIVE_NAME . " Settings", "phc_s_gallery_responsive_meta_options", 
	PHC_S_GALLERY_RESPONSIVE_POST_TYPE, "normal", "high");
	
	add_meta_box(PHC_S_GALLERY_RESPONSIVE_IDENTIFIER . "side", 
	PHC_S_GALLERY_RESPONSIVE_NAME . " Properties", "phc_s_gallery_responsive_side_options", 
	PHC_S_GALLERY_RESPONSIVE_POST_TYPE, "side", "low");
}

function phc_s_gallery_responsive_meta_options($post, $metabox){
	global $post, $wp_scripts, $wp_meta_boxes, $hook_suffix;
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}
	
	$custom= get_post_custom($post->ID);
	$meta_fields= array("image_url");
	$datas= array();
	foreach( $meta_fields as $field ){
		if( isset($custom[$field][0]) ){
		$$field= json_decode($custom[$field][0], TRUE);
		$datas[$field]= json_decode($custom[$field][0], TRUE);
		}
	}
	
	$num_section= isset($image_url) ? count($image_url) : "";
	wp_enqueue_style(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_post_css', 
	PHC_S_GALLERY_RESPONSIVE_PATH_URL_CSS . "post.css");
?>
<div id="s-gallery-responsive-extras" class="meta-box-wrapper" data-post-id="<?php echo $post->ID; ?>">
	<div>
	<button type="button" id="btn-new-image" class="button-primary">
	<?php _e("New Image", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></button>
	</div>
	<!-- Start S Gallery Responsive Element -->
	<div class="group widget template-s-gallery-responsive-form">
	<div class="btn-icon-header phc-icon-delete" 
	title="<?php _e("Delete", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?>">
	<button class="button-secondary btn-remove-image" type="button">
	<?php _e("Remove", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></button>
	</div>
	<h3 class="hndle">
	<span><?php _e("Image", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?> {image_number}</span>
	</h3>
	<div class="s-gallery-responsive-section">
		<div class="s-gallery-responsive-image">
		<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_URL . "no_image.jpg"; ?>" alt="No Image" />
		</div>	
		<div>
		<input type="hidden" name="image_url[]" value="" disabled="" />
		<input type="button" 
		value="<?php esc_attr_e("Select Image", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?>" 
		class="upload_image_button button-secondary" disabled="" />
		</div>
	</div>
	</div>
	<!-- End S Gallery Responsive Element -->
	
	<div id="s-gallery-responsive-accordion">
	<?php
	if( !empty($num_section) ){
	for( $ct=0; $ct<$num_section; $ct++ ){
		$image_number= $ct+1;
		
	?>
		<div class="group widget" data-image-number="<?php echo $image_number; ?>">
		<div class="btn-icon-header phc-icon-delete" 
		title="<?php _e("Delete", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?>">
		<button class="button-secondary btn-remove-image" type="button">
		<?php _e("Remove", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></button>
		</div>
		<h3 class="hndle">
		<span><?php _e("Image", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?> 
		<?php echo $image_number; ?></span>
		</h3>
		<div class="s-gallery-responsive-section">
			<div class="s-gallery-responsive-image">
			<?php
			$image_src= wp_get_attachment_image_src($image_url[$ct], 'post-large');
			if( $image_src ){
			?>
			<img src="<?php echo $image_src[0]; ?>" alt="" />
			<?php
			}else{
			?>
			<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_URL . "no_image.jpg"; ?>" alt="No Image" />
			<?php
			}
			?>
			</div>	
			<div>
			<input type="hidden" name="image_url[]" value="<?php echo $image_url[$ct]; ?>" />
			<input type="button" 
			value="<?php esc_attr_e("Select Image", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?>" 
			class="upload_image_button button-secondary" />
			</div>
		</div>
		</div>
	<?php
	}
	}
	?>
	</div>
</div>
<?php
}
// End Add Meta Box

// Start Save Post S Gallery Responsive Meta Options
add_action('save_post', 'phc_s_gallery_responsive_meta_save_extras');
function phc_s_gallery_responsive_meta_save_extras(){
	global $post;
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}
	else{
		$meta_fields= array("image_url");
		// Validate Data
		
		// Save Data
		foreach( $meta_fields as $field ){
			if( isset($_POST[$field]) ){
				$s_gallery_responsive_obj= new PHC_S_Gallery_Responsive();
				foreach( $_POST[$field] as $key=>$item ){
					$_POST[$field][$key]= sanitize_text_field($item);
					$s_gallery_responsive_obj->regenerate_image($item);
				}
				update_post_meta($post->ID, $field, json_encode($_POST[$field]));
			}
		}
	}
}
// End Save Post S Gallery Responsive Meta Options

// Start Add S Gallery Responsive Side Meta Box
function phc_s_gallery_responsive_side_options($post, $metabox){
	global $post, $wp_scripts, $wp_meta_boxes, $hook_suffix;
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}
	
	$custom= get_post_custom($post->ID);
	$meta_fields= array("s_gallery_properties");
	$properties= array("fullScreenEnabled");
	
	$datas= array();
	foreach( $meta_fields as $field ){
		if( isset($custom[$field]) ){
		$$field= json_decode($custom[$field][0], TRUE);
		$datas[$field]= json_decode($custom[$field][0], TRUE);
		}
	}
	
	foreach( $properties as $item ){
		if( isset($s_gallery_properties[$item]) ){
			$$item= $s_gallery_properties[$item];
		}
	}
	extract($datas);
?>
	<div id="s-gallery-responsive-extras" class="meta-box-side-wrapper" 
	data-post-id="<?php echo $post->ID; ?>">
		<?php
		$fullScreenEnabled_stat= "";
		if( isset($fullScreenEnabled) ){
			$fullScreenEnabled_stat= " checked=\"checked\"";
		}
		?>
		<div>
		<label for="s_gallery_properties[fullScreenEnabled]">
		<?php _e("fullScreenEnabled", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?>:</label>
		<input type="checkbox" name="s_gallery_properties[fullScreenEnabled]" 
		id="s_gallery_properties[fullScreenEnabled]" value="1"<?php echo $fullScreenEnabled_stat; ?> />
		</div>
	</div>
<?php
}
// End Add S Gallery Responsive Side Meta Box

// Start Save Post S Gallery Responsive Side Options
add_action('save_post', 'phc_s_gallery_responsive_side_save_extras');
function phc_s_gallery_responsive_side_save_extras(){
	global $post;
	
	if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ){
		return $post_id;
	}
	else{
		// Validate Data
		
		// Save Data
		$properties= array("fullScreenEnabled");
		foreach( $properties as $item ){
			if( isset($_POST['s_gallery_properties']) ){
				$_POST['s_gallery_properties'][$item]= sanitize_text_field($_POST['s_gallery_properties'][$item]);
			}else{
				$_POST['s_gallery_properties'][$item]= 0;
			}
			
			if( isset($post->ID) ){
				update_post_meta($post->ID, 's_gallery_properties', 
				json_encode($_POST['s_gallery_properties']));
			}
		}
	}
}
// End Save Post S Gallery Responsive Side Options
?>