/* Adapted from http://brettterpstra.com/adding-a-tinymce-button/ */

(function() {
	tinymce.create('tinymce.plugins.rt_theme_shortcodes', {
		init : function(ed, url) {
			ed.addButton('rt_themeshortcode', {
				title : 'RT-Theme Shortcodes',
				image : url+'/shortcode.png', 
				onclick : function() {
					ed.windowManager.open({
						file : url + '/rt_shortcodes_popup.php',
						width : 720,
						height : 400,
                              title: 'RT-Theme Shortcodes',
						inline : 1
					});
				}

			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Shortcodes",
				author : 'RTTheme',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('rt_themeshortcode', tinymce.plugins.rt_theme_shortcodes);
})();