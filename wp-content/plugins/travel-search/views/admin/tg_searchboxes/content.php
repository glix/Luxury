<?php
/**
 * main template/view for Admin pages (only)
 *
 * @package Travel-Search
 * @subpackage Admin Controller for Editorial Interface
 * @author Travelgrove Labs (http://labs.travelgrove.com/)
 * @since 1.0
 */
/*	no direct loading of this file	*/
if( !defined('TG_SEARCHBOXES_ABSPATH') )
	exit();
?>
Select a searchbox by the preferred size. You can choose to customize it and add it to your post.

<ul class="subsubsub measuresChooser" id="tgsb_measuresChooser">
	<li><a class="160x600" href="#">160x600</a> | </li>
	<li><a class="300x250" href="#">300x250</a> | </li>
	<li><a class="300x533" href="#">300x533</a> | </li>
	<li><a class="728x90" href="#">728x90</a>  | </li>
	<li><a class="dynamic current" href="#">dynamic</a></li>
</ul>

<br class="clear" />

<div class="tgsb sb160x600">
	<div style="float:left">
		<?php require_once TG_SEARCHBOXES_ABSPATH. 'views/admin/tg_searchboxes/160x600/content.php'; ?>
	</div>
	<div style="float:left;width:280px;padding-left:20px">
		<p style="font-style:italic;color:#666;margin:0px;text-align:center;font-weight:700;margin-top:120px">Customize this box</p>
		<p style="font-style:italic;color:#666;margin:0px">
			* select search type (click one of the tabs):<br />
			Flights, Hotels, Packages or Cars<br /><br />
			* enter departure/destination cities (optional)<br /><br />
			* select travel dates (optional)<br /><br />
			* select the number and type of travelers (optional)<br />
		</p>
		<p style="margin:0px;text-align:center">
			<input type="button" class="button-primary send_searchbox_to_editor" value="Insert Box">
		</p>
	</div>
</div>
<div class="tgsb sb300x250">
	<div style="float:left">
		<?php require_once TG_SEARCHBOXES_ABSPATH. 'views/admin/tg_searchboxes/300x250/content.php'; ?>
	</div>
	<div style="float:left;width:280px;padding-left:20px">
		<p style="font-style:italic;color:#666;margin:0px;text-align:center;font-weight:700">Customize this box</p>
		<p style="font-style:italic;color:#666;margin:0px">
			* select search type (click one of the tabs):<br />
			Flights, Hotels, Packages or Cars<br /><br />
			* enter departure/destination cities (optional)<br /><br />
			* select travel dates (optional)<br /><br />
			* select the number and type of travelers (optional)<br />
		</p>
		<p style="margin:0px;text-align:center">
			<input type="button" class="button-primary send_searchbox_to_editor" value="Insert Box">
		</p>
	</div>
</div>
<div class="tgsb sb300x533">
	<div style="float:left">
		<?php require_once TG_SEARCHBOXES_ABSPATH. 'views/admin/tg_searchboxes/300x533/content.php'; ?>
	</div>
	<div style="float:left;width:280px;padding-left:20px">
		<p style="font-style:italic;color:#666;margin:0px;text-align:center;font-weight:700">Customize this box</p>
		<p style="font-style:italic;color:#666;margin:0px">
			* select search type (click one of the tabs):<br />
			Flights, Hotels, Packages or Cars<br /><br />
			* enter departure/destination cities (optional)<br /><br />
			* select travel dates (optional)<br /><br />
			* select the number and type of travelers (optional)<br />
		</p>
		<p style="margin:0px;text-align:center">
			<input type="button" class="button-primary send_searchbox_to_editor" value="Insert Box">
		</p>
	</div>
</div>
<div class="tgsb sb728x90">
	<?php require_once TG_SEARCHBOXES_ABSPATH. 'views/admin/tg_searchboxes/728x90/content.php'; ?>
	<br /><br />
	<p style="font-style:italic;color:#666;margin:0px;text-align:center">
		<strong>Customize this box</strong><br /><br />
		* select search type (click one of the tabs):<br />
		Flights, Hotels, Packages or Cars<br /><br />
		* enter departure/destination cities (optional)<br /><br />
		* select travel dates (optional)<br /><br />
		* select the number and type of travelers (optional)<br />
		<input type="button" class="button-primary send_searchbox_to_editor" value="Insert Box">
	</p>
</div><br />
<div class="tgsb sbdynamic crnt">
	<?php require_once TG_SEARCHBOXES_ABSPATH. 'views/admin/tg_searchboxes/dynamic/content.php'; ?>
	<br /><br />
	<i>* The minimum width of the dynamic box is 300 pixels.</i>
	<br />
	<p style="font-style:italic;color:#666;margin:0px;text-align:center">
		<strong>Customize this box</strong><br /><br />
		* select search type (click one of the tabs):<br />
		Flights, Hotels, Packages or Cars<br /><br />
		* enter departure/destination cities (optional)<br /><br />
		* select travel dates (optional)<br /><br />
		* select the number and type of travelers (optional)<br />
		<input type="button" class="button-primary send_searchbox_to_editor" value="Insert Box">
	</p>
</div><br />
<?php /* <a href="#" class="getShortcode">Get Shortcode</a>
<a href="#" class="send_searchbox_to_editor">Insert</a> */ ?>
<br />
<div class="shortcodeContainer"></div>
<div class="defaultSettings">
<?php

/**	load the options, needed for shortcode insertion	*/
$options	= get_option('tg_searchboxes_options');
/**	t.stamp of dep. date, gen. by strtotime (like "+5 days")	*/
$depDateTimestamp		= strtotime('+'.$options['departure_date']);
$retDateTimestamp		= strtotime($options['return_date'], $depDateTimestamp);
$options['departure_date']	= date($options['date_format'], $depDateTimestamp);
$options['return_date']		= date($options['date_format'], $retDateTimestamp);
// unset($options['id_referral']);
unset($depDateTimestamp, $retDateTimestamp);
$optionsJSON	= json_encode($options);
/**	JS date format converted from PHP format used for datePickers	*/
$options['date_format_js']	= $options['date_format'] == 'd/m/Y' ? 'dd/mm/yy' : 'mm/dd/yy';
?>
</div>
<script type="text/javascript">
	var TG_Searchboxes_Variables	= {
		str_CalendarURL:	"<?php echo plugins_url('/images/tg_searchboxes/calendarnew.png', TG_SEARCHBOXES__FILE__); ?>",
		str_ASAjaxURL:		"<?php echo plugins_url('/ajax/autosuggestion.php', TG_SEARCHBOXES__FILE__); ?>",
		str_dateFormat:		"<?php echo $options['date_format_js']; ?>",
		<?php /**	default settings to compare w/ the current ones while generating the shortcode from JS	*/ ?>
		tgsbDefaultSettings:	<?php echo $optionsJSON; ?>,
		<?php /**	demo page URL used in the alert while clicking the compare button	*/ ?>
		demoPage:		"<?php echo admin_url().'admin.php?page=tg_searchboxes_demo'; ?>"
	}
</script>
<script type="text/javascript" src="<?php echo plugins_url('/js/tg_searchboxes_ajax.min.js', TG_SEARCHBOXES__FILE__); ?>"></script>
<link href="<?php echo plugins_url('/css/tg_searchboxes.min.css', TG_SEARCHBOXES__FILE__); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo plugins_url('/css/tg_searchboxes_color.css', TG_SEARCHBOXES__FILE__).'?'.$options['cssfiletimestamp']; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo plugins_url('/css/ui-lightness/datepicker.min.css', TG_SEARCHBOXES__FILE__); ?>" rel="stylesheet" type="text/css" />
<style type="text/css">
<?php /**	while loading via AJAX the calendar must have a higher z-index than the actual popup, otherwise it won't appear;
		also since the box has position fixed the autosuggestion should also have pos fixed.	*/ ?>
ul.asMargin{position:fixed}
#ui-datepicker-div{z-index:110 !important}
.tgsb{display:none}
.crnt{display:block}
ul.measuresChooser#tgsb_measuresChooser li a:link,ul.measuresChooser#tgsb_measuresChooser li a:visited{color:#21759B}
ul.measuresChooser#tgsb_measuresChooser li a:hover,ul.measuresChooser#tgsb_measuresChooser li a:active{color:#000}
</style>