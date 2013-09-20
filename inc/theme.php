<div id="s-gallery-responsive-<?php echo $post->ID; ?>" 
class="s-gallery-responsive-<?php echo $post->type; ?>">
<div class="gallery-container">
	<ul class="items--small">
<?php
foreach( $image_url as $item ){
	if( $this->type == "post" ){
		$image_src= wp_get_attachment_image_src($item, 'phc-s-gallery-responsive-post-small');
	}elseif( $this->type == "widget" ){
		$image_src= wp_get_attachment_image_src($item, 'phc-s-gallery-responsive-widget-small');
	}
	if( $image_src ){
?>	
	<li class="item"><a href="#">
	<img src="<?php echo $image_src[0]; ?>" alt="" />
	</a></li>
<?php
	}
}
?>
	</ul>
	    <ul class="items--big">
		<?php
		foreach( $image_url as $item ){
			if( $this->type == "post" ){
				$image_src= wp_get_attachment_image_src($item, 'phc-s-gallery-responsive-post-large');
			}elseif( $this->type == "widget" ){
				$image_src= wp_get_attachment_image_src($item, 'phc-s-gallery-responsive-widget-large');
			}
			if( $image_src ){
		?>	
			<li class="item--big"><a href="#">
			<img src="<?php echo $image_src[0]; ?>" alt="" />
			</a></li>
		<?php
			}
		}
		?>
	    </ul>
	    <div class="controls">
	      <span class="control icon-arrow-left" data-direction="previous"></span>
	      <span class="control icon-arrow-right" data-direction="next"></span> 
	      <span class="grid icon-grid"></span>
	      <span class="fs-toggle icon-fullscreen"></span>
	    </div>
	  </div>
</div>
	  <?php
	  // Add Hook Filter to modify Properties
	  $s_gallery_properties= apply_filters('phc_s_gallery_responsive_properties', $s_gallery_properties);
	  
	  $properties= "";
	  foreach( $s_gallery_properties as $key=>$item ){
	  	$properties.= "'" . $key . "': '" . $item . "',";
	  }
	  ?>
<script>
jQuery(document).ready(function($){
	$('#s-gallery-responsive-<?php echo $post->ID; ?> .gallery-container').sGallery({
	<?php echo $properties; ?>
	});
});
</script>	  