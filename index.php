<?php
/*
Plugin Name: Tave Integration
Plugin URI: http://www.flauntbooks/tave
Description: Integrates your tave account with your blog, ProPhoto Blog & contact forms.  You can integrate your public contact form into any page or post.  You can also integrate your ProPhoto Blog 2 & 3 contact form with tave. Once activated: <a href="admin.php?page=tave-integration/admin.php">Configure Plugin Here >>></a>
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
	
	
// Setup Vars
$shootq_vars = get_option('fb_shootq');

// Short Code
function add_shootq($atts) {
	global $shootq_vars;
	//print_r($shootq_vars);
    extract(shortcode_atts(array(
			'type' => 'shootq',
            'url' => '',
            'id' => '', // RANDOM ID?
			'width' => $shootq_vars['shootq_width'],
            'height' => $shootq_vars['shootq_height'],
			'bgcolor' => '#FFFFFF',
			'x' => 0,
			'y' => 0,			
	), $atts));
	
	$shootqurl = 'https://app.shootq.com/public/'.$shootq_vars['shootq_brand'].'/contact';
	if($url){ 
		if(strpos($url, 'http') == false){
			$shootqurl = 'https://app.shootq.com/public/'.$url.'/contact';
		}else{
			$shootqurl = $url;
		}
	}
	if(!$width){ $width = "100%";}
	if(!$height){ $height = 950;}
    if (strpos($width, 'px') == false and strpos($width, '%') == false){ $width .= 'px'; }
    if (strpos($height, 'px') == false and strpos($height, '%') == false){ $height .= 'px'; }
	$shootqborder = $shootq_vars['shootq_border'];
	$shootqscrolling = $shootq_vars['shootq_scrolling'];
	
	if($shootqborder){ $shootqborder = "0";}
	if($shootqscrolling){ $$shootqscrolling = "off"; }
	   
    return	'<iframe src="' . $shootqurl . '" style="width:'.$width . '; height:'. $height.';" frameborder="'.$shootqborder.'" scrolling="'.$shootqscrolling.'"></iframe>';
}
add_shortcode('shootq', 'add_shootq');

// Theme Function
//<?php if(is_page('3124')){ if(function_exists('shootq_form')){ echo'shootq'; shootq_form(); }else{ echo 'no shootq func'; } } 
//<?php if(is_page('3124')){ if(function_exists('shootq')){ echo'shootq'; shootq('http://www.nike.com', 400, 500); }else{ echo 'no shootq func'; } } 

function shootq($url = NULL, $width = NULL, $height = NULL)
{
	global $shootq_vars;
	
	$shootqurl = 'https://app.shootq.com/public/'.$shootq_vars['shootq_brand'].'/contact';
	if($url){ 
		if(strpos($url, 'http') == false){
			$shootqurl = 'https://app.shootq.com/public/'.$url.'/contact';
		}else{
			$shootqurl = $url;
		}
	}
	if(!$width){ $width = "100%";}
	if(!$height){ $height = 950;}
    if (strpos($width, 'px') == false and strpos($width, '%') == false){ $width .= 'px'; }
    if (strpos($height, 'px') == false and strpos($height, '%') == false){ $height .= 'px'; }   
	$shootqborder = $shootq_vars['shootq_border'];
	$shootqscrolling = $shootq_vars['shootq_scrolling'];
	
	if($shootqborder){ $shootqborder = "0";}
	if($shootqscrolling){ $$shootqscrolling = "off"; }
	   
    echo	'<iframe src="' . $shootqurl . '" style="width:'.$width . '; height:'. $height.';" frameborder="'.$shootqborder.'" scrolling="'.$shootqscrolling.'"></iframe>';	
}


// Admin Menu's
$xfile =  str_replace("/index.php","",plugin_basename(__FILE__));
function shootq_menu() 
{
	global $xfile;
	if (function_exists('fb_theme_admin_menu')) { 
		add_submenu_page('flaunt_books_theme/admin.php',  __('ShootQ'), __('ShootQ'), 8, WP_PLUGIN_DIR.'/'.$xfile.'/admin.php'); 
	}
	add_submenu_page('options-general.php',  __('ShootQ'), __('ShootQ'), 8, WP_PLUGIN_DIR.'/'.$xfile.'/admin.php');
}
add_action('admin_menu', 'shootq_menu');

function ozh_shootq() { return plugins_url('/img/shootq_icon.png', __FILE__);} 
add_filter('ozh_adminmenu_icon_'.$xfile.'/admin.php', 'ozh_shootq');


// Add settings
function shootq_filter_plugin_actions($links) {
	global $xfile;
	$new_links = array();
	$new_links[] = '<a href="options-general.php?page='.$xfile.'/admin.php">' . __('Settings', 'shootq-integration') . '</a>';	
	return array_merge($new_links, $links);
}
add_action('plugin_action_links_' . plugin_basename(__FILE__), 'shootq_filter_plugin_actions');

// Add other links
function shootq_filter_plugin_links($links, $file)
{
	if ( $file == plugin_basename(__FILE__) )
	{
		$links[] = '<a href="http://www.flauntbooks.com">' . __('Other Plugins', 'shootq-integration') . '</a>';
	}	
	return $links;
}
add_filter('plugin_row_meta', 'shootq_filter_plugin_links', 10, 2);


// Activate / Deactivate
function shootq_activate()
{
	global $shootq_vars;
	$shootq_options = array(
		'shootq_debug' => "",
		'shootq_height' => "950",
		'shootq_width' => "100%",
		'shootq_page_url' => "",
		'shootq_scrolling' => "no",
		'shootq_border' => "0"
		//'shootq_brand' => "",
		//'shootq_api'=> "",
	);

	// Array Exists?  Data Entered?
	//$shootq_vars = get_option('fb_shootq');
    if(!$shootq_vars['shootq_brand']){
		add_option('fb_shootq', $shootq_options );
	}else{
		foreach ($shootq_options as $key => $val) {
   			//print "Key $key, Value $val\n";
			$shootq_vars[$key] = $val;
		}
		update_option('fb_shootq', $shootq_vars);
	}
}
function shootq_deactivate(){
	//delete_option('fb_shootq');
}
register_activation_hook( __FILE__,'shootq_activate');
register_deactivation_hook(__FILE__, 'shootq_deactivate');


// Pro Photo
function send_shootQ($content){
	// IF POSTED FORM w/ HIDDEN FIELD DO SHOOTQ
	if( isset($_POST['email']) ){  // or wpnonce_p3
		$fbs = get_option('fb_shootq');  // Get Settings
		
		// define the account specific variables for this ShootQ user 
		$api_key = $fbs['shootq_api'];
		$brand_abbreviation = $fbs['shootq_brand'];

		// create the URL to POST our data to 
		$url = "https://app.shootq.com/api/".$brand_abbreviation."/leads";
		
		$sq_type = ucwords(strtolower($_POST['custom-field1']));
		if(!$sq_type){$sq_type = "Wedding";}
		
		$sq_first = $_POST['firstname']; 
		if(!$sq_first){
			if(isset($_POST['lastname'])){
				$names = explode(" ", $_POST['lastname']);
				$sq_first = $names[0];
				$sq_last = $names[1];
				if($names[2]){
	    			$sq_last .= $names[2];
				}
			}else{
			$sq_first = "John";
			$sq_last = "Doe";
			}
		}else{
			$sq_last = $_POST['lastname']; 
		}

		$sq_phone = $_POST['phone'];
		$sq_email = $_POST['email'];
		$sq_date = $_POST['custom-field2'];
		if(strpos($sq_date, '/') === false){
			$sq_date = date('m/d/Y');
		}

		$sq_referred = $_POST['custom-field3'];
		$sq_comments = $_POST['message'];
		

		if($fbs['shootq_debug']){ // DEBUG Show Post Array
  			echo '<p>--- SHOOTQ DEBUG -----------------------------<br />(Turn this off in the wordpress admin under <strong>Settings > ShootQ</strong>)<br /><br /><strong>POST Array:</strong><br />';
  			print_r($_POST);
			echo $sq_date;
			echo $sq_type;
			echo $sq_first;
			echo $sq_last;
  			echo "<br /><br /><strong>Type of submission</strong>: ".$sq_type."<br /><br /></p>";
			//echo ucwords(strtolower($sq_type));
		}
        if($api_key != "" && $sq_first != "" && $sq_email != ""){
		$ctext = $text;
		$text .= "<p>";
		// create a data structure to send to ShootQ 
		$lead = array();
		$lead['api_key'] = $api_key;
		$lead['contact'] = array();
		$lead['contact']['first_name'] = $sq_first;
		$lead['contact']['last_name'] = $sq_last;
		$lead['contact']['phones'] = array();
		$lead['contact']['phones'][0] = array();
		$lead['contact']['phones'][0]['type'] = 'Home';
		$lead['contact']['phones'][0]['number'] = $sq_phone;
		$lead['contact']['emails'] = array();
		$lead['contact']['emails'][0] = array();
		$lead['contact']['emails'][0]['type'] = 'Home';
		$lead['contact']['emails'][0]['email'] = $sq_email;
		if(isset($_POST['shootq_field_custom_1'])){
			$lead['contact']['role'] = $_POST['shootq_field_custom_1'];
		}
		$lead['event'] = array();
		$lead['event']['type'] = $sq_type;
		//$lead['event']['type'] = 'Wedding';
		$lead['event']['date'] = $sq_date;
		$lead['event']['referred_by'] = $sq_referred;
		$lead['event']['remarks'] = $sq_comments;
		//$lead['event']['wedding'] = array();
		//$lead['event']['wedding']['ceremony_location'] = $_POST['cf3_field_4'];
		$lead['event']['extra'] = array();
		foreach ($_POST as $key => $val) {
    		//$key = str_replace("shootq_field_", "", $key);
			if($fbs['shootq_debug']){ // DEBUG Show Post Array
				echo "Key $key, Value $val<br />";
			}
			//$fsq[$key] = $val;
			$cff = substr($key, 0, 3);
			$cff2 = substr($key, 0, 10);
			if($cff != "cf_" && $cff2 != "sendbutton" && $key != "shootq" && $key != "first" && $key != "last" && $key != "firstname" && $key != "lastname" && $key != "name" && $key != "date" && $key != "comments" && $key != "phone"  && $key != "type"  && $key != "email" && $key != "submit"  && $key != "_wpnonce_p3" && $key != "anti-spam" && $key != "spam_question"/* && $key != "referpage"*/){
				$lead['event']['extra'][$key] = $val;
			}
		} // END foreach

		// encode this data structure as JSON 
		$lead_json = json_encode($lead);

		// send this data to ShootQ via the API 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $lead_json);

		// get the response from the ShootQ API 
		$response_json = curl_exec($ch);
		$response = json_decode($response_json);
		$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		// the HTTP code will be 200 if there is a success 
		if ($httpcode == 200) {
   		//echo "SUCCESS!\n";
   			if($fbs['shootq_debug']){ // DEBUG Show Output
   				$text .= "<strong>HTTPCode</strong>: ".$httpcode."<br />";
   				$text .= "<strong>JSON Response:</strong>".$response_json;
   				$text .= "<br /><br /> --- END DEBUG -----------------------------<br /><br /><br /><br /><br />";
   			}
			$text .= $fbs['shootq_success'];
		} else {
  			if($fsq['shootq_debug']){ // DEBUG Show Output
   				$text .= "There was a problem: ".$httpcode."\n\n";
   				$text .= $response_json;
   				$text .= "<br />No Data<br /><br /> --- END DEBUG -----------------------------<br /><br /><br /><br /><br />";
   			}
   			$text .= $fbs['shootq_fail'];
		}
		$text .= "</p>";
		if(!$fbs['shootq_location']){
			$text .= $ctext;
		}

		// close the connection 
		curl_close($ch);
		//$text .= "Post Found...".$_POST['type'];	
		} // END if fields
	} // END IF POST
	//exit;
	//echo $text;
	return $content;
} // END FUNCTION

// ProPhoto Hook - Added 04/29/10
add_action( 'p3_contact_pre_email', 'send_shootq' );

add_filter('the_content', 'send_shootQ', 30);

function shootq_action_links($links, $file) {
	$plugin_file = basename(__FILE__);
	if (basename($file) == $plugin_file) {
		$settings_link = '<a href="admin.php?page=tave-integration/admin.php">Settings</a>';
		array_unshift($links, $settings_link);
	}
	return $links;
}
add_filter('plugin_action_links', 'shootq_action_links', 10, 2);
?>