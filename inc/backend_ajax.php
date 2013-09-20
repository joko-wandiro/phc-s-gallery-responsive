<?php
// Enqueue the script, in the footer
add_action('admin_print_scripts-post.php', 'phc_s_gallery_responsive_js');
add_action('admin_print_scripts-post-new.php', 'phc_s_gallery_responsive_js');
function phc_s_gallery_responsive_js() {
    global $post;
	wp_enqueue_media();
	wp_enqueue_script(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_admin_js', 
	PHC_S_GALLERY_RESPONSIVE_PATH_URL . "js/admin.js", array("jquery-ui-core", "jquery-ui-accordion", 
	"jquery-ui-sortable"));
	
	// Get current page protocol
	$protocol = isset( $_SERVER['HTTPS']) ? 'https://' : 'http://';
	// Output admin-ajax.php URL with same protocol as current page
	$params = array(
	'ajaxurl'=>admin_url('admin-ajax.php', $protocol),
	'loading_text'=>'<h1>Loading...</h1>',
	'theme_url'=>PHC_S_GALLERY_RESPONSIVE_THEME_URL,
	);
	wp_localize_script(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_admin_js', 
	PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_admin_js_params', $params);
}
?>