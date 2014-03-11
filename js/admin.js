( function($){
$(document).ready( function(){
    PHC_S_Gallery_Responsive_Feedback= {
		selector: {},
        'default': function(data){
			console.log(data);
        },
        'alert': function(data){
			alert(data);
        },
    }
	
    PHC_S_Gallery_Responsive_Ajax= {
		'form': '',
        'type': "default",
		'extra': "default",
		container: '',
        send: function(url, data){
            PHC_S_Gallery_Responsive_AjaxObj= this;
            $.ajax({
				async: false,
                dataType: 'json',
                type: 'POST',
                url: url,
                data: data,
                beforeSend: function(){
					PHC_S_Gallery_Responsive_AjaxObj.blockUI();
                },
                complete: function(){
					PHC_S_Gallery_Responsive_AjaxObj.unBlock();
                },
                success: function(data){
                    type= PHC_S_Gallery_Responsive_AjaxObj.type;
                    PHC_S_Gallery_Responsive_Feedback[type](data);
                }
            });
        },
		loading: function(url, data){
			container= this.container;
			$(container).load(url + ' ' + container, data);
		},
		blockUI: function(){
			$.blockUI({ 
//				message: '<h1>Loading...</h1>'
				message: phc_s_gallery_responsive_admin_js_params.loading_text,
			});
		},
		unBlock: function(){
			$.unblockUI(); 
		},
	}

	PHC_S_Gallery_Responsive_Accordion= {
		setting_accordion: function($obj){
	    $obj
		.accordion({
		active: false,
		collapsible: true,
		header: "> div > h3",
		})
		.sortable({
		placeholder: "ui-state-highlight",
		handle: "h3.hndle",
		stop: function( event, ui ) {
		// IE doesn't register the blur when sorting
		// so trigger focusout handlers to remove .ui-state-focus
		ui.item.children("h3").triggerHandler("focusout");
		console.log(event);
		console.log(ui);
		PHC_S_Gallery_Responsive_Accordion.sorting("Image");
		}
		});
		},
		sorting: function(identifier){
			$s_gallery_responsive_accordion= $('#s-gallery-responsive-accordion');
			$('.widget', $s_gallery_responsive_accordion).each( function(key){
				id_row= key+1;
				$obj= $(this);
				$obj.attr({'data-image-number': id_row}).find('h3.hndle')
				.find('span:eq(1)').html(identifier + " " + id_row);
			})
		}
	}
	
	PHC_S_Gallery_Responsive_Accordion.setting_accordion($('#s-gallery-responsive-accordion'));
	$('#s-gallery-responsive-extras #btn-new-image').live('click', function(){
		$template_form= $('.template-s-gallery-responsive-form').clone();
		template_form_html= $template_form.html();
		$s_gallery_responsive_accordion= $('#s-gallery-responsive-accordion');
		number_of_section= $('.widget', $s_gallery_responsive_accordion).length;
		number_of_section++;
		// Replace {image_number}
		$template_form.html(template_form_html.replace(/{image_number}/g, number_of_section));
		// Add New Widget
		$template_form.attr({'data-image-number': number_of_section})
		.appendTo($s_gallery_responsive_accordion).removeClass('template-s-gallery-responsive-form')
		.find('input, select, textarea').removeAttr('disabled');
		$s_gallery_responsive_accordion.accordion('destroy');
		// Setting Accordion Again
		PHC_S_Gallery_Responsive_Accordion.setting_accordion($s_gallery_responsive_accordion);
	});
	
	$('#s-gallery-responsive-accordion .btn-remove-image').live('click', function(){
		$(this).parent().parent().remove();
		PHC_S_Gallery_Responsive_Accordion.sorting("Image");
	});
})
})(jQuery);

jQuery(document).ready( function($){
	// Uploading files
	var file_frame;
	
	$('#s-gallery-responsive-accordion .upload_image_button').live('click', function( event ){
		event.preventDefault();
		$obj= $(this);
		
		// If the media frame already exists, reopen it.
		if ( file_frame ) {
			file_frame.open();
			return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
			title: jQuery( this ).data( 'uploader_title' ),
			button: {
			text: jQuery( this ).data( 'uploader_button_text' ),
			},
			multiple: false  // Set to true to allow multiple files to be selected
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
			// We set multiple to false so only get one image from the uploader
			attachment = file_frame.state().get('selection').first().toJSON();
			// Do something with attachment.id and/or attachment.url here
			console.log(attachment);
			$obj.parent().find('input[name^="image_url"]').val(attachment.id);
			$obj.parent().parent().find('.s-gallery-responsive-image img').attr({'src': attachment.url})
		});

		// Finally, open the modal
		file_frame.open();
	});
})