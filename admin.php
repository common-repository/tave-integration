<?php 
/*
Tave Contact Form Admin
http://www.flauntbooks/tave

Inserts your tave public contact form into any page or post.
Version: 1.1
Author: Flaunt Books
Author URI: http://www.flauntbooks.com
Licence: GNU
*/

/*  Copyright 2010  Flaunt Books  (email : info@flauntbooks.com)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

*/

// Compatability Setup
if ( !defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( !defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

$shootq_vars = get_option('fb_shootq');
$xfile =  str_replace("/admin.php","",plugin_basename(__FILE__));

$pluginURL = WP_CONTENT_URL . '/plugins/'.$xfile;
$pluginDIR = WP_CONTENT_DIR . '/plugins/'.$xfile;

//echo plugins_url('', __FILE__);
		
?>
<!-- COLOR CHOOSER -->
<script type="text/javascript" src="<?php echo $pluginURL; ?>/js/jscolor.js"></script>
<script type="text/javascript" src="<?php echo $pluginURL; ?>/js/swfobject.js"></script>
<link rel="stylesheet" href="<?php echo $pluginURL; ?>/css/fbadmin.css" TYPE="text/css" MEDIA="screen">
<link rel="stylesheet" href="<?php echo $pluginURL; ?>/css/960p.css" TYPE="text/css" MEDIA="screen">

<!-- UI -->
<link type="text/css" href="<?php echo $pluginURL; ?>/ui/css/ui.all.css" rel="stylesheet" />
<link type="text/css" href="<?php echo $pluginURL; ?>/ui/css/demos.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo $pluginURL; ?>/ui/ui.core.js"></script>
<script type="text/javascript" src="<?php echo $pluginURL; ?>/ui/ui.accordion.js"></script>
<script type="text/javascript" src="<?php echo $pluginURL; ?>/ui/ui.tabs.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $pluginURL; ?>/ui/jquery.scrollTo.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo $pluginURL; ?>/ui/jquery.localscroll.js"></script>

<script type="text/javascript" src="<?php echo $pluginURL; ?>/ui/qtip/jquery.qtip-1.0.0-rc3.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function($) {
		$(".accordion").accordion({
			autoHeight: false,
			collapsible:true
			//event: 'mouseover'
		});
		$(".faq").accordion({
			autoHeight: false,
			//collapsible:true
			event: 'mouseover'
		});
		
			
		$('#tabs').tabs({ fx: { height: 'toggle' } });
		
		var $tabs = $('#tabs').tabs(); // first tab selected
		$('.shootq-setup').click(function() { $tabs.tabs('select', 0); return false;});
		$('.shootq-instructions').click(function() { $tabs.tabs('select', 1); return false;});
		$('.shootq-prophoto').click(function() { $tabs.tabs('select', 2); return false;});
		
		if($("#tabs") && document.location.hash){
    		$.scrollTo("#tabs");
    	}
        $("#tabs ul").localScroll({ 
        	target:"#tabs",
        	duration:0,
    		hash:true
    	});
		
		$('.tab').click(function() {
           $tabs.tabs('select', $(this).attr("rel"));
           return false;
       });
	   
	   //Tool Tip - QTip Library
	   $(".qtip").qtip({ style: { name: 'light', tip: true } })
	   
		/*$('a[href$=#fragment-2], a[href$=#fragment-3]', 'div.ui-tabs-
panel').click(function() {
     		$('#example').tabs('select', this.hash);
     		return false;
    	});*/
});
</script>

<style>
	.faq .ui-state-default, .faq .ui-widget-content .ui-state-default {background:none; border:0px solid #E1DFDF;}
	.faq .ui-state-active, .faq .ui-widget-content .ui-state-active {background:none; border:0px solid #E9E9E9;}
	.faq .ui-widget-content  {border:0 solid #E9E9E9;}
</style>
<?php
include(WP_PLUGIN_DIR.'/'.$xfile.'/top.php'); 
?>
<div style="background: #015692; width:100%; height:50px; padding:5px 0px; color:#FFF; text-align:center; margin-bottom:20px;"><img src="<?php echo $pluginURL; ?>/img/logo.png" border="0" /></div>
<div class="clear"> &nbsp;</div>
<?php 
	//$fbm = get_option('fb_master');
	if( isset($_POST['sqV']) ) {
		$sq_new = $_POST['sqV'];
		//echo "size of array = ".sizeof($fb_new)."<br>";
		foreach ($sq_new as $key => $val) {
    		//print "Key $key, Value $val\n";
			$shootq_vars[$key] = $val;
			if($key == "shootq_scrolling"){
				if($val == "off"){
					$shootq_vars[$key] = "";
				}
			}
		}
	update_option('fb_shootq', $shootq_vars);
	echo '<div id="message" class="updated fade"><p><strong>' . __('ShootQ Settings saved.') . '</strong></p></div><div class="clear"> &nbsp;</div>';
	}
	
?>
<form method="post" action="">
<div class="container_12" style="min-width:700px; margin-top:30px;">
<div class="grid_11">

<div id="tabs" style="padding:0; margin:0; -moz-border-radius: 0; border:none;">
	<ul style="padding:0; margin:0; -moz-border-radius: 0; border:none;">
		<li><a href="#shootq-setup">shootQ Setup</a></li>
		<li><a href="#shootq-instructions">FAQ</a></li>
		<li><a href="#shootq-prophoto">ProPhoto Blogs</a></li>
		<li><a href="#shootq-cforms">Cforms II</a></li>
		<li><a href="#shootq-cf7">Contact Form 7</a></li>
		<li><a href="#shootq-help">Help</a></li>
	</ul>
	
	<div id="shootq-setup">





<div class="accordion">
	<h3><a href="#">shootQ API Key & Brand Abbreviation</a></h3>
	<div>
	<table class="fl"><caption></caption><tbody>
    	<tr><td style="width: 30%; text-align:right; font-weight:bold;">ShootQ API</td><td style="width: 70%;"><input name="sqV[shootq_api]" size="50" value="<?php echo $shootq_vars['shootq_api']; ?>" /> <a href="#" title="Enter your shootQ API key into the box on the left.  You'll find it under the Settings -> Public Access Area.  You may need to enable the API before you'll see the key." class="qtip">?</a></td></tr>
    	<tr><td style="width: 30%; text-align:right; font-weight:bold;">ShootQ Brand Abbreviation</td><td style="width: 70%;"><input name="sqV[shootq_brand]" size="50" value="<?php echo $shootq_vars['shootq_brand']; ?>" /> <a href="#" title="Enter your brand abbreviation into the box on the left.  Be sure there are no additional spaces as your brand abbreviation will look like the following: your-brand-abbrev." class="qtip">?</a></td></tr>
	</tbody></table>
	<p>Use the following shortcode on any post or page to show the contact form: [shootq]</p>
	</div>
	<h3><a href="#">Other Settings</a></h3>
	<div>
<table class="fl"><caption></caption><tbody>
    <tr><td style="width: 30%; text-align:right; font-weight:bold;">Width</td><td style="width: 70%;"><input name="sqV[shootq_width]" size="5" value="<?php echo $shootq_vars['shootq_width']; ?>" /></td></tr>
    <tr><td style="width: 30%; text-align:right; font-weight:bold;">Height</td><td style="width: 70%;"><input name="sqV[shootq_height]" size="5" value="<?php echo $shootq_vars['shootq_height']; ?>" /></td></tr>
    <!--<tr><td style="width: 30%; text-align:right; font-weight:bold;">Border</td><td style="width: 70%;">
			<input type="radio" name="sqV[shootq_border]" value="0" <?php if($shootq_vars['shootq_border'] == "" || $shootq_vars['shootq_border'] == "0"){ echo 'checked'; }?> > Off 
			<input type="radio" name="sqV[shootq_border]" value="1" <?php if($shootq_vars['shootq_border'] == "1"){ echo 'checked'; }?> > On </td></tr>
    <tr><td style="width: 30%; text-align:right; font-weight:bold;">Scrolling</td><td style="width: 70%;">
			<input type="radio" name="sqV[shootq_scrolling]" value="off" <?php if($shootq_vars['shootq_scrolling'] == "" || $shootq_vars['shootq_scrolling'] == "off"){ echo 'checked'; }?> > Off 
			<input type="radio" name="sqV[shootq_scrolling]" value="on" <?php if( $shootq_vars['shootq_scrolling'] == "on"){ echo 'checked'; }?>> On
			<input type="radio" name="sqV[shootq_scrolling]" value="auto" <?php if( $shootq_vars['shootq_scrolling'] == "auto"){ echo 'checked'; }?>> Auto<br>
	</td></tr>-->
</tbody></table>
	</div>
	<h3><a href="#">Debug</a></h3>
	<div>
	    <table class="fl"><caption></caption><tbody>
    <tr><td style="width: 30%; text-align:right; font-weight:bold;">Debug</td><td style="width: 70%;">
	<select name="sqV[shootq_debug]" value="<?php echo $shootq_vars['shootq_debug']; ?>" style="width:100px;">
				<option value=""<?php if($shootq_vars['shootq_debug'] == "") { echo ' selected'; } ?>>Off</option>
				<option value="On"<?php if($shootq_vars['shootq_debug'] == "On") { echo ' selected'; } ?>>On</option>
			</select><span class="help" title="This will show the form data and any errors in a debug area for troubleshooting.  Leave this OFF unless you are testing and troubleshooting."> &nbsp; </span>
	</td></tr>
		</tbody></table>
	</div>
	
</div>
<div class="clear"> &nbsp;</div>
	

	</div>
	<div id="shootq-instructions">
	
<div class="faq">
<h3><a href="#">How do I use it?</a></h3>
<div>Paste [shootq] with the brackets into any post or page and your shootQ contact form will be displayed.  You can style the colors and more in your shootQ admin under the Settings -> Public Access Area.  You can also use the function shootq(); in any of your theme files.
</div>
	<h3><a href="#">Where Do I Find My ShootQ API & Brand Abbreviation?</a></h3>
	<div>
			<ol>
			  <li>Click Settings ->  Then Click Integrations in the left column.  </li>
		      <li>Enable Public API Access and save changes if necessary.  </li>
		      <li>Copy & paste the API & Brand abbreviation into the fields aboe.</li>
	      </ol>
	</div>
	<h3><a href="#">Can it process my ProPhoto Contact Form?</a></h3>
	<div>
	 <p><strong>Yes!</strong>  Just enter your shootQ information and it's ready to go as long as you are running ProPhoto 3 with a build number of #664 or higher for the plugin to work instantly without the need to modify any theme files.  
If you aren't, contact ProPhoto here: <a href="http://www.prophotoblogs.com/support/contact/" target="_blank">http://www.prophotoblogs.com/support/contact/</a> for an update.</p> 
	</div>
	<h3><a href="#">Can I use this in my theme files?</a></h3>
	<div>
	 <p><strong>Yes!</strong> You can use shootq(); as a function in your theme files.</p> 
	</div>
	<h3><a href="#">What do the width & height control?</a></h3>
	<div>
	 <p><strong>Yes!</strong> Your form will be displayed within a frame on the page and the frame needs to have a width & height property defined.  The default width is 100% which will fill the available width of the page.  The default height is 950 (pixels) which allows the form to be displayed with enough vertical space to show all the fields without a scroll bar.</p> 
	</div>
</div>

</div>
	
		<div id="shootq-prophoto">
			<span class="fbtitle">ProPhoto Blog Instructions</span>
			<p>Just enable the plugin and it's ready to go as long as you are running ProPhoto 3 with a build number of #664 or higher for the plugin to work instantly without the need to modify any theme files.  
If you aren't, contact ProPhoto here: <a href="http://www.prophotoblogs.com/support/contact/" target="_blank">http://www.prophotoblogs.com/support/contact/</a> for an update.</p> </p>
		</div>
		
		<div id="shootq-cforms">
			<span class="fbtitle">CForms II Instructions</span>
			<p>More instructions coming soon...</p>
		</div>
		
		<div id="shootq-cf7">
			<span class="fbtitle">Contact Forms 7 Instructions</span>
			<p>More instructions coming soon...</p>
		</div>
		
		<div id="shootq-help">
			<span class="fbtitle">Help & Customization</span>
			<p><a href="http://www.flauntbooks.com/photographer-websites/contact/" target="_blank" class="fblink">Contact Flaunt Books</a> if you would like assistance to integrate this plugin.  We've installed and customized this in a variety of ways from Photography Workshop registrations, multiple forms, contests and more.  We can help you achieve seamless integration with your shootQ account.  Just contact us for a consultation and/or quote.</p>
		</div>
</div><!-- end tabs -->	
<div class="clear"> &nbsp;</div>
<div style="text-align:left; padding:10px; float:left; width:200px;" class="grid_12"><input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" /></div>
<div style="text-align:right; padding:0px 10px; float:right; width: 300px;">
<a class="fblink" href="http://twitter.com/home/?status=Free plugin that integrates Wordpress and Prophoto blogs with shootQ - http://bit.ly/9EScHj" target="_blank">Tweet This</a> | <a href="http://www.flauntbooks.com/photographer-websites/contact/" target="_blank" class="fblink">Contact Flaunt Books</a>
</div>

</div>

</div>
</form>