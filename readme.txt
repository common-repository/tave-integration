=== Tave Integration ===
Contributors: skooks
Donate link: http://www.flauntbooks.com/tave/
Tags: tave, tave integration, tave form, prophoto, pro photo, flaunt books
Requires at least: 2.5.0
Tested up to: 3.0.1
Stable tag: 1.1

Integrates your tave account with your blog.  Display your public contact form and/or process your ProPhoto Blog 2 & 3 contact form into shootQ.

== Description ==

Integrates your tave account with your blog.  You can integrate your public contact form into any page or post.  You can also integrate your ProPhoto Blog 2 & 3 contact form with tave. You can also use Contact Form 7, CformsII and custom forms to send data directly to shootQ.  This plugin is provided free by Flaunt Books.

== Installation ==

**Step One:**
Download the attached plugin.  

1. Upload the `tave-integration` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

**Step Two:**
Login to your Wordpress Blog
  -  Click on Plugins > Add New > Upload
  -  Browse and find attached .zip file
  -  Click Upload
  -  Activate The Plugin

**Step Three:**
In your Wordpress admin under the Settings option click on ShootQ.

Login to Tave -> Click Settings -> Click Integrations on the left column >
  -  Enable Public API Access if necessary.
  -  Copy / Paste API Key & Brand Abbreviation into the fields on the tave settings page.

**Step Four:**
Create or edit a page / post and insert the following shortcode:
> [tave]

You can add the form to your theme using this in your theme:
'<?php code(); // goes in backticks ?>'


**Step Five:**
Submit a form submission test. 

You can then style your contact form further inside of the tave Public Area. 
To access the public area click on Settings -> Click on Public Area on the left column ->
Style setting and options are available for further customization.

**Pro Photo 2 & 3 Integrated!**
This Free version includes the function hook so your Pro Photo contact forms send their data directly into tave.  Just activate it and it's ready to go. Is that cool or what!

Notice: You'll need to be using ProPhoto 3 with a build number of #664 or higher for the plugin to work instantly without the need to modify any theme files.  
If you aren't, contact ProPhoto here: http://www.prophotoblogs.com/support/contact/ for an update.



== Frequently Asked Questions ==

= How easy is this to install? =

It can be installed, activated & integrated within 2 minutes.

= After activating, how do I display my contact form? =

Create or edit a page / post and insert the following shortcode:
> [tave]

You can add the form to your theme using this in your theme:
'<?php code(); // goes in backticks ?>' 

= Can it process my ProPhoto Contact Form? =
You'll need to be using ProPhoto 3 with a build number of #664 or higher for the plugin to work instantly without the need to modify any theme files.  
If you aren't, contact ProPhoto here: http://www.prophotoblogs.com/support/contact/ for an update.


= The plugin is being unzipped when I download it and I'm using a Mac.  How do I fix that? =

If you are using a Mac please be sure that your browser does not unzip or decompress the attachment.  It needs to remain intact as tave.zip. There are settings for both Safari & Firefox which allow you control over whether downloads and attachments are automatically unzipped / decompressed. If you can't solve this you'll need to upload (FTP) the unzipped tave folder into your wordpress plugins directory.  The folder name should be "tave" and it should contain 3 php files and 2 folders.
You can then visit your plugins page in Wordpress and activate the Plugin.  Skip to Step Three.

== Screenshots ==

1. Coming soon...


== Changelog ==

= 1.1 =
* First stable release


== Upgrade Notice ==

= 1.1 =
Styling fixes for plugin settings.