<?php
add_action('init', 'phc_s_gallery_responsive_post_type');
// Registers post types. 
function phc_s_gallery_responsive_post_type(){
	// Set Up Arguments
	$args= array(
	'public'=>TRUE,
	'exclude_from_search'=>FALSE,
	'publicly_queryable'=>FALSE,
	'show_ui'=>TRUE,
	'query_var'=>PHC_S_GALLERY_RESPONSIVE_POST_TYPE,
	'rewrite'=>array(
		'slug'=>PHC_S_GALLERY_RESPONSIVE_POST_TYPE,
		'with_front'=>false,
	),
	'supports'=>array(
		'title',
	),
	'menu_icon'=>PHC_S_GALLERY_RESPONSIVE_IMG_URL . "icon_menu.png",
	'labels'=>array(
		'name'=>__('S Gallery Responsive', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'singular_name'=>__('S Gallery Responsive', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'add_new'=>__('Add New Gallery', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'add_new_item'=>__('Add New Gallery', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'edit_item'=>__('Edit Gallery', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'new_item'=>__('New Gallery', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'view_item'=>__('View Gallery', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'search_items'=>__('Search Gallery', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'not_found'=>__('No Gallery Found', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER),
		'not_found_in_trash'=>__('No Gallery Found In Trash', PHC_S_GALLERY_RESPONSIVE_IDENTIFIER)
	),
	);
	
	// Register It
	register_post_type(PHC_S_GALLERY_RESPONSIVE_POST_TYPE, $args);
}
?>