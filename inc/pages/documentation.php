<?php
add_action('admin_menu', 'phc_s_gallery_responsive_create_menu_documentation');
function phc_s_gallery_responsive_create_menu_documentation(){
	global $wp_scripts;
	
	$function= "phc_s_gallery_responsive_documentation_page";
	add_submenu_page('edit.php?post_type=' . PHC_S_GALLERY_RESPONSIVE_POST_TYPE, 
	PHC_S_GALLERY_RESPONSIVE_PAGE_TITLE_DOCUMENTATION, PHC_S_GALLERY_RESPONSIVE_MENU_TITLE_DOCUMENTATION, 
	PHC_S_GALLERY_RESPONSIVE_SUBMENU_CAPABILITY, PHC_S_GALLERY_RESPONSIVE_MENU_SLUG_DOCUMENTATION, $function);
}

function phc_s_gallery_responsive_documentation_page(){
	wp_enqueue_style(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_documentation_css', 
	PHC_S_GALLERY_RESPONSIVE_PATH_URL_CSS . "documentation.css");
	wp_enqueue_script(PHC_S_GALLERY_RESPONSIVE_ID_SCRIPT . '_documentation_js', 
	PHC_S_GALLERY_RESPONSIVE_PATH_URL . "js/documentation/documentation.js", array("jquery-ui-tabs"));
?>
	<div class="wrap" id="<?php echo PHC_S_GALLERY_RESPONSIVE_IDENTIFIER; ?>">
	<?php screen_icon('page'); ?>
	<h2><?php _e("Documentation", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></h2>
	
	<div id="container-donate-btn">
	<div class="form">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
	">
	<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	<img alt="" border="0" src="https://www.paypalobjects.com/id_ID/i/scr/pixel.gif" width="1" height="1">
	</form>
	</div>
	<div class="float-left">
	<?php _ex("Your donation keep me to maintain and make it free of bug.", 
	"donation text", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?>
	</div>
	</div>
	<div id="tabs">
	<ul>
	<li><a href="#tabs-how-to-use"><?php _ex("How to Use", "documentation tab", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></a></li>
	<li><a href="#tabs-settings-page"><?php _ex("Settings Page", "documentation tab", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></a></li>	
	<li><a href="#tabs-available-hooks"><?php _ex("Available Hooks", "documentation tab", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></a></li>
	<li><a href="#tabs-translation"><?php _ex("Translation", "documentation tab", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></a></li>
	</ul>
	<div id="tabs-how-to-use">
	<h2><?php _e("Add S Gallery Responsive into post/page.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></h2>
	<ul>
	<li>
	<p><?php _e("Goto S Gallery Responsive &gt; Add New Gallery.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><?php _e("Enter Title. Ex: S Gallery Responsive.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step1.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("Click New Image to add image for S Gallery Responsive.", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step2.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("Click Image 1 to display content. Click Select Image to show Media Uploader.", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step3.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("If you've already upload your images. Click on image then click select Button", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step4.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("Do step 3 - step 5 to add image for Gallery.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><?php _e("Set Properties for your Gallery.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step5.png"; ?>" 
	class="step5" />
	</p>
	</li>
	<li>
	<p><?php _e("Click Publish Button.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><?php _e("Goto S Gallery Responsive to view all of your Gallery. You can add it into your post or page, just copy shortcode syntax on Shortcode column. Then you will get your S Gallery Responsive on your post / page.", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step6.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("Goto Posts &gt; All Posts. Then click edit on specific post. You can create new post / page later, I use edit post just for example.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step7.png"; ?>" />
	</p>
	</li>	
	<li>
	<p><?php _e("Add S Gallery Responsive shortcode like the following image.", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step8.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("Click Update. Then click View Post button to check S Gallery Responsive is shown on your post. You should see your post like the following image.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step9.png"; ?>" />
	</p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step10.png"; ?>" />
	</p>	
	</li>
	</ul>
	<h2><?php _e("Add S Gallery Responsive into widget.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></h2>
	<ul>
	<li>
	<p><?php _e("Goto Appearance &gt; Widgets.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><?php _e("Use Widget Text. Enter Title. Ex: S Gallery Responsive Widget. Then add shortcode into content. You should add parameter type=&quot;widget&quot; into shortcode. See the following image.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p>
	<img src="<?php echo PHC_S_GALLERY_RESPONSIVE_IMG_DOCUMENTATION_BOW_TO_USE_URL . "step11.png"; ?>" />
	</p>
	</li>
	<li>
	<p><?php _e("Click Save Button.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>	
	</ul>
	<h2><?php _e("Add S Gallery Responsive into PHP file.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></h2>
	<ul>
	<li>
	<p><?php _e("You can do it with do_shortcode syntax.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p><code>&lt;?php echo do_shortcode('[phc_s_gallery_responsive id="110"]'); ?&gt;</code></p>
	</li>
	</ul>
	</div>
	<div id="tabs-settings-page">
	<ul>
	<li>
	<p><?php _e("Goto S Gallery Responsive &gt; Settings.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><?php _e("You can set image size for S Gallery Responsive on Post / Page and Widget. It make performance better. Set it with numeric value for small and large image.", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	</ul>
	</div>
	<div id="tabs-available-hooks">
	<h2><?php _e("Hooks Action", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></h2>
	<ul>
	<li>
	<p><code>phc_s_gallery_responsive_load_scripts_and_styles</code></p>
	<p><?php _e("You can use it load more javascripts and styles for S Gallery Responsive.", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><code>phc_s_gallery_responsive_before_init</code></p>
	<p><?php _e("You can use it to do any functionality before S Gallery Responsive sripts run", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	<li>
	<p><code>phc_s_gallery_responsive_after_init</code></p>
	<p><?php _e("You can use it to do any functionality after S Gallery Responsive sripts run", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	</ul>
	<h2><?php _e("Hooks Filter", PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></h2>
	<ul>
	<li>
	<p><code>phc_s_gallery_responsive_properties</code></p>
	<p><?php _e("You can use it to modify S Gallery Responsive Properties. Parameter contain S Gallery Responsive Properties", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	</ul>
	</div>
	<div id="tabs-translation">
	<ul>
	<li>
	<p><?php _e("Help me to Translate it. I provide POT file on languages folder. You can use translation application such as POEdit and translate it to your locale language and save it into PO file and MO file", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	<p><?php _e("You can contribute to make it bigger with your support guys !", 
	PHC_S_GALLERY_RESPONSIVE_IDENTIFIER); ?></p>
	</li>
	</ul>
	</div>	
	</div>
	</div>
<?php
}
?>