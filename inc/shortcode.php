<?php
add_action('init', 'phc_s_gallery_responsive_add_image_size');
function phc_s_gallery_responsive_add_image_size(){
	if (function_exists('add_theme_support')) {
		$phc_s_gallery_responsive_settings_vars= get_option('phc_s_gallery_responsive_settings_vars');
	    add_theme_support('post-thumbnails');
		$default_image_size= array("post_small_width"=>"250", "post_small_height"=>"166", 
		"post_large_width"=>"736", "post_large_height"=>"490", "widget_small_width"=>"75", 
		"widget_small_height"=>"50", "widget_large_width"=>"50", "widget_large_height"=>"50");
		$phc_s_gallery_responsive_settings_vars= array_merge($default_image_size, 
		$phc_s_gallery_responsive_settings_vars);
		
		extract($phc_s_gallery_responsive_settings_vars);
		add_image_size('phc-s-gallery-responsive-post-small', $post_small_width, $post_small_height, 
		FALSE);
		add_image_size('phc-s-gallery-responsive-post-large', $post_large_width, $post_large_height, 
		FALSE);
		add_image_size('phc-s-gallery-responsive-widget-small', $widget_small_width, 
		$widget_small_height, FALSE);
		add_image_size('phc-s-gallery-responsive-widget-large', $widget_large_width, 
		$widget_large_height, FALSE);
	}
}

add_shortcode('phc_s_gallery_responsive', 'phc_s_gallery_responsive_display');
function phc_s_gallery_responsive_display($atts, $content=null){
	$default= array('id'=>"", 'type'=>"post");
	extract(shortcode_atts($default, $atts));
	$html= "";
	if( ! empty($id) ){
		$args= array();
		$args['post_id']= $id;
		$args['type']= $type;
		$s_gallery_responsive_obj= new PHC_S_Gallery_Responsive($args);
		$html= $s_gallery_responsive_obj->display();
	}
	
	return $html;
}

// Support Shortcode on Widget Text
add_filter('widget_text', 'do_shortcode');

// Enqueue the script, in the footer
add_action('wp', 'phc_s_gallery_responsive_frontend_js');
function phc_s_gallery_responsive_frontend_js() {
    global $post;
    $pattern= get_shortcode_regex();
    if( isset($post->post_content) && preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches )
        && array_key_exists( 2, $matches )
        && in_array( 'phc_s_gallery_responsive', $matches[2] ) ){
		
		// Enqueue the S Gallery Responsive Scripts and Styles
		wp_enqueue_style(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_styles_css', 
		PHC_S_GALLERY_RESPONSIVE_PATH_URL_CSS . "s-gallery-responsive/styles.css");
		wp_enqueue_script(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_plugins_js', 
		PHC_S_GALLERY_RESPONSIVE_PATH_URL_JS . "s-gallery-responsive/plugins.js", 
		array("jquery"), '', FALSE);
		wp_enqueue_script(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_scripts_js', 
		PHC_S_GALLERY_RESPONSIVE_PATH_URL_JS . "s-gallery-responsive/jquery.s-gallery-responsive.js", 
		array("jquery"), '', FALSE);
		
		// Hook Action to load javascripts and styles
		do_action('phc_s_gallery_responsive_load_scripts_and_styles');
    }
}

final class PHC_S_Gallery_Responsive {
	private $small_width;
	private $small_height;
	private $large_width;
	private $large_height;
	private $post_id;
	private $type;
	
	function __construct($args=array()){
		extract($args);
		foreach( $args as $key=>$item ){
			$this->$key= $item;
		}
	}
	
	function display(){
		ob_start();
		// Hook Action before init
		do_action('phc_s_gallery_responsive_before_init');
		
		$args= array(
		'post_type'=>PHC_S_GALLERY_RESPONSIVE_POST_TYPE,
		'p'=>$this->post_id
		);
		
		$query= new WP_Query($args);
		while( $query->have_posts() ){
			$query->the_post();
			$post= get_post();
			$custom= get_post_custom($post->ID);
			$meta_fields= array("image_url", "s_gallery_properties");
			$datas= array();
			foreach( $meta_fields as $field ){
				if( isset($custom[$field][0]) ){
				$$field= json_decode($custom[$field][0], TRUE);
				$datas[$field]= json_decode($custom[$field][0], TRUE);
				}
			}
			require(PHC_S_GALLERY_RESPONSIVE_INCLUDE_PATH . "/theme.php");
		}
		wp_reset_postdata();
		// Hook Action after init
		do_action('phc_s_gallery_responsive_after_init');
		$html = ob_get_contents();
		ob_clean();
		
		return $html;
	}
	
	function fetch_and_regenerate_image(){
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$args= array(
		'post_type'=>PHC_S_GALLERY_RESPONSIVE_POST_TYPE,
		'posts_per_page'=>-1
		);
		$query= new WP_Query($args);
		while( $query->have_posts() ){
			$query->the_post();
			$post= get_post();
			$custom= get_post_custom($post->ID);
			$meta_fields= array("image_url", "s_gallery_properties");
			$datas= array();
			foreach( $meta_fields as $field ){
				if( isset($custom[$field][0]) ){
				$$field= json_decode($custom[$field][0], TRUE);
				$datas[$field]= json_decode($custom[$field][0], TRUE);
				}
			}
			
			foreach( $image_url as $attachment_id ){
				$this->regenerate_image($attachment_id);
			}
		}
		wp_reset_postdata();
	}
	
	function regenerate_image($attachment_id=""){
		if( !empty($attachment_id ) ){
			$attachment_path= get_attached_file($attachment_id);
			$metadata_attachment= wp_generate_attachment_metadata($attachment_id, $attachment_path);
			$msg= wp_update_attachment_metadata($attachment_id, $metadata_attachment);
			return $msg;
		}		
	}
}
?>