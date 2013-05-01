//rttheme multi select script
jQuery(document).ready(function() {
	jQuery("select[multiple]").asmSelect({
		addItemTarget: 'bottom',
		animate: true,
		highlight: true,
		sortable: true
	});
}); 


//rttheme media upload script
jQuery(document).ready(function() {
		jQuery('.rttheme_upload_button').live("click", function() {
			formfield = jQuery(this).attr('name');	 
			var classList =jQuery(this).attr('class').split(' ');
			var url_input = classList[1];
			tb_show('RT-Theme Media Upload', 'media-upload.php?type=image&amp;TB_iframe=true');
			jQuery('html').append("<meta name=\"rttheme_upload_button\" content=\""+url_input+"\" /> ");		
			window.custom_editor = true;
			return false;	
		});

		window.rttheme_upload_send_to_editor= window.send_to_editor;
		window.send_to_editor = function(html)
		{	
			var rttheme_upload_button= jQuery("meta[name=rttheme_upload_button]").attr('content');
			if (rttheme_upload_button) 
			{	
					imgurl = jQuery('img',html).attr('src');
					jQuery('#'+rttheme_upload_button).val(imgurl);
					tb_remove();
					jQuery("meta[name=rttheme_upload_button]").remove();
			}
			else 
			{
					window.rttheme_upload_send_to_editor(html);
			}
		};
});



 
//rttheme ud sidebars
jQuery(document).ready(function() {


	//empty sidebarname
	jQuery('.input_rttheme_sidebar_name').val('');
 
	
	//hide all hidden fields
	jQuery('.table_rttheme_ud_sidebars').hide();
	
	var sidebar_forms = jQuery('.sidebar_forms form');
	sidebar_forms.hide();

	jQuery('#sidebar_selector').change(function() {
	
			trs=jQuery("#sidebar_selector option:selected").val();
			jQuery("#"+trs).show(); //show just selected form
			

		
		//hide other forms
		sidebar_forms.each(function(){
			
			if(trs!=jQuery(this).attr('id')) jQuery(this).hide();			
		});	
	
	});
	
}); 
 
 
 
 
//rttheme slider widget
jQuery(document).ready(function() {
	jQuery('.manual_related, .post_related, .manual_rest').hide();
	//jQuery(".linkto").change(function () {
	jQuery(".linkto").live('change', function () {
 

		var which_widget = (jQuery(this).attr('id'));
		var sind =jQuery(this).val();
		if(sind == "post"){
			jQuery('.'+which_widget+' .post_related, .'+which_widget+' .manual_rest').show('200');
			jQuery('.'+which_widget+' .manual_related, .'+which_widget+' .page_related').hide();
		}
		if(sind == "page"){
			jQuery('.'+which_widget+' .page_related, .'+which_widget+' .manual_rest').show('200');
			jQuery('.'+which_widget+' .manual_related, .'+which_widget+' .post_related').hide();
		}
		if(sind == "manual"){
			jQuery('.'+which_widget+' .manual_related, .'+which_widget+' .manual_rest').show('200');
			jQuery('.'+which_widget+' .post_related, .'+which_widget+' .page_related').hide();
		}
	});
	jQuery('.show_true').show();

});
 