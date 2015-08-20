=== Donation Button ===
Contributors: mbj-webdevelopment
Tags: donation, donation wp, paypal, paypal donation, button, donate, donation, payment, paypal, paypal donation, PayPal Donate, shortcode, paypal donation buttons,paypal donation button, multi currency, donation history, paypal donation widget, shortcode, sidebar, payment list, Paypal donation list, payment history, donation history, paypal button manager, paypal payment accept, paypal donation accept, mailchimp, subscribe, email, mailchimp, marketing, newsletter, plugin, signup, widget
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: trunk
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Easy to used PayPal Donation button with Auto Responder.
== Description ==
= Introduction =

This easy to use PayPal Donation Button allows you to place a PayPal donation button within your WordPress theme. Choose between 9 standard PayPal donation buttons or use your own custom button. Also PayPal Donation button used in Page, Post and Widget with a shortcode.

* Provide shortcode

= Shortcode =

Insert the button in your pages or posts with this shortcode

Shortcode For WordPress Editor: 

* Note: all the shortcode parameter are optional

`[paypal_donation_button]`

`[paypal_donation_button item_name="YOUR ITEM NAME" item_number="YOUR ITEM NUMBER OR ANY NUMBER"]`

`[paypal_donation_button item_name="YOUR ITEM NAME" item_number="YOUR ITEM NUMBER OR ANY NUMBER" currency_code="USD"]`


Shortcode For WordPress Template file: 

`<?php echo do_shortcode( '[paypal_donation_button]' ); ?>`



<input type="hidden" name="item_name" value="Friends of the Park">
    <input type="hidden" name="item_number" value="Fall Cleanup Campaign">

* Provide widget
* Provide custome button
* Provide PayPal IPN url ( paypal notify_url  ), instant payment notification
* Provide return url ( Thank you page)
* Provide provide multi currency support
* Provide credit cart payment system

= List of Donation with below field =
*	Transaction ID
*	Name / Company
*	Amount
*	Transaction Type
*	Payment status
*	Date
* 	All the field are available in detail view 

= Provide MultiLanguage support =

= Donation Confirmation Email =
* Admin ( store admin )
* Donor ( PayPal payer email)

= MailChimp API =
*	Automatically add email addresses to your MailChimp user list(s) when donation are processed on your PayPal account.


== Installation ==

= Automatic installation =

Automatic installation is the easiest option as WordPress handles the file transfers itself and you don't need to leave your web browser. To do an automatic install, log in to your WordPress dashboard, navigate to the Plugins menu and click Add New.

In the search field type "Donation Button" and click Search Plugins. Once you've found our plugin you can view details about it such as the the rating and description. Most importantly, of course, you can install it by simply clicking Install Now.

= Manual Installation =

1. Unzip the files and upload the folder into your plugins folder (/wp-content/plugins/) overwriting previous versions if they exist
2. Activate the plugin in your WordPress admin area.


= configuration =



Easy steps to install the plugin:

*	Upload "Donation Button" folder/directory to the /wp-content/plugins/ directory
*	Activate the plugin through the 'Plugins' menu in WordPress.
*	Go to Settings => Paypal Donation


== Frequently Asked Questions ==
= Where can I get support? =
*	Please visit the [Support Forum] (http://wordpress.org/support/plugin/paypal-donation-buttons) for questions, answers, support and feature requests.

= Does this plugin provide Donation list? =
*	Yes, this plugin provide donation list, without do any thing :)

= Does this plugin provide multi currency support? =
*	Yes, this plugin provide multi currency support.

= does this plugin provide widget support? =
*	Yes.

= does this plugin provide custom button option? =
*	Yes, this plugin provide custome button option, as well no. of button list.

= does this plugin provide monthly recurring option? =
*	Yes. 


== Changelog ==
= 1.0.0 =
*	Release Date - 9 Feb, 1015
*  	First Version


== Upgrade Notice ==
Easy to used PayPal Donation button with Auto Responder.