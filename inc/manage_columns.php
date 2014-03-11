<?php
// Start Modification Columns
add_filter("manage_edit-" . PHC_S_GALLERY_RESPONSIVE_POST_TYPE . "_columns", 
"phc_s_gallery_responsives_edit_columns");
function phc_s_gallery_responsives_edit_columns($columns){
	$columns= array(
	"cb"=>"<input type=\"checkbox\" />",
	"title"=>_x("Title", "column", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
	"shortcode"=>_x("Shortcode", "column", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
	"gallery"=>_x("Gallery", "column", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
	"author"=>_x("Author", "column", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
	"date"=>_x("Date", "column", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
	);
	
	return $columns;
}

add_action("manage_" . PHC_S_GALLERY_RESPONSIVE_POST_TYPE . "_posts_custom_column", 
"phc_s_gallery_responsives_custom_columns");
function phc_s_gallery_responsives_custom_columns($columns){
	global $post;
	
	$custom= get_post_custom();
	switch( $columns ){
		case "gallery":
			$images= isset($custom['image_url'][0]) ? json_decode($custom['image_url'][0], TRUE) : "";
			if( !empty($images) ){
				foreach( $images as $item ){
					$image_src= wp_get_attachment_image_src($item, 'post-large');
					if( $image_src ){
					?>
					<img src="<?php echo $image_src[0]; ?>" alt="" />
					<?php
					}else{
					?>
					<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_URL . "no_image.jpg"; ?>" 
					alt="No Image" />
					<?php
					}
				}
			}
			break;
		case "shortcode":
			if( isset($post->ID) ){
				echo '<p>Shortcode for post / page: <code>[phc_s_gallery_responsive id="' . $post->ID . '"]</code></p>';
				echo '<p>Shortcode for widget: <code>[phc_s_gallery_responsive id="' . $post->ID . '" type="widget"]</code>';
			}
			break;
	}
}
// End Modification Columns
?>