=== Plugin Name ===
Contributors: bizevolv
Donate link: http://bizevolv.com
Tags: Timepayment, Gateway, Woocommerce, Financing, Payment Plans, Leasing
Requires at least: 3.0.1
Tested up to: 4.9.8
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin allows you to offer TimePayment financing to your customers during WooCommerce checkout. You must have a free TimePayment vendor account for this plugin to work. Your customer will be taken to TimePayment secure online financing application to finish their checkout. Your TimePayment vendor account code and the customer cart/order details will be posted to the TimePayment secure online application via POST method.

== Description ==

Increase sales by offering flexible customer-financing payment plans during checkout! This plugin uses your TimePayment vendor ID to submit customer checkout order data to the TimePayment API. This allows your customers to instantly and easily apply for financing during checkout on any purchase over $500. This plugin sends the customer's shipping and contact info, as well as the order details, to TimePayment's secure online financing application, tied to your TimePayment vendor account. 

== Installation ==

1. Upload the `woo-timepayment-gateway` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to WooCommerce -> Payment Gateways -> Activate Woo Timepayment Gateway

== Frequently Asked Questions ==

= When my customer clicks the TimePayment financing button during checkout what happens next? =

Once your customer clicks the TimePayment button during checkout,  they will be taken to the secure online financing application at TimePayment's website,  with your VENDOR ID and their WooCommerce order details already inserted.  They simply finish the quick application and submit it to TimePayment.  You will then be alerted of the approval or denial. Once the customer is approved, simply continue using TimePayment as you normally would (send lease docs to customer for digital signature, and ship product once you receive the funds.)

= Is it free to signup for a TimePayment vendor account? =

Yes, TimePayment vendors can signup free, there is no cost to be a vendor.

= What fees or discount rates does TimePayment charge? =

TimePayment does not charge a fee or discount rate for customer financing.  As the vendor, you are funded 100% of the financing amount.

= How does TimePayment fund the vendor on a customer financing purchase? =

TimePayment funds you, the vendor, by overnighting a FEDEX check for the full amount of the order, within 24 hours of the financing order being signed by the customer.

= I have more questions about TimePayment... =

TimePayment would be happy to answer any questions related to their vendor financing program, however all plugin-related questions should be directed to the Wordpress.org support forum or BizEvolv.com

== Screenshots ==

1. Plugin Settings
2. Button during checkout

== Changelog ==

= 1.0.0 =
* First version.
