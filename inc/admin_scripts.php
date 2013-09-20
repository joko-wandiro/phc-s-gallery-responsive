<?php
add_action('admin_print_scripts', 'phc_s_gallery_responsive_admin_print_scripts');
function phc_s_gallery_responsive_admin_print_scripts(){
	wp_enqueue_style(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_admin_css', 
	PHC_S_GALLERY_RESPONSIVE_PATH_URL_CSS . "admin.css");
}

add_action('admin_print_scripts-edit.php', 'phc_s_gallery_responsive_admin_print_scripts_edit');
function phc_s_gallery_responsive_admin_print_scripts_edit(){
	wp_enqueue_style(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_edit_css', 
	PHC_S_GALLERY_RESPONSIVE_PATH_URL_CSS . "edit.css");
}
?>