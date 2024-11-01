<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://bizevolv.com
 * @since      1.0.0
 *
 * @package    Woo_Timepayment_Gateway
 * @subpackage Woo_Timepayment_Gateway/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woo_Timepayment_Gateway
 * @subpackage Woo_Timepayment_Gateway/admin
 * @author     Jason@BizEvolv.com <jason@bizevolv.com>
 */
class Woo_Timepayment_Gateway_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Timepayment_Gateway_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Timepayment_Gateway_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/timepayment-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Timepayment_Gateway_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Timepayment_Gateway_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/timepayment-woocommerce-admin.js', array( 'jquery' ), $this->version, false );

	}
	
}
	


/**
 * Add the gateway to WC Available Gateways
 * 
 * @since 1.0.0
 * @param array $gateways all available WC gateways
 * @return array $gateways all WC gateways + offline gateway
 */
function wc_timepayment_add_to_gateways( $gateways ) {
	$gateways[] = 'WC_Gateway_TimePayment';
	return $gateways;
}
add_filter( 'woocommerce_payment_gateways', 'wc_timepayment_add_to_gateways' );


/**
 * Adds plugin page links
 * 
 * @since 1.0.0
 * @param array $links all plugin links
 * @return array $links all plugin links + our custom links (i.e., "Settings")
 */
function wc_timepayment_gateway_plugin_links( $links ) {

	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=timepayment_gateway' ) . '">' . __( 'Configure', 'wc-gateway-timepayment' ) . '</a>'
	);

	return array_merge( $plugin_links, $links );
}
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wc_timepayment_gateway_plugin_links' );


/**
 * TimePayment Gateway
 *
 * Provides an TimePayment Gateway; mainly for testing purposes.
 * We load it later to ensure WC is loaded first since we're extending it.
 *
 * @class 		WC_Gateway_TimePayment
 * @extends		WC_Payment_Gateway
 * @version		1.0.0
 * @package		WooCommerce/Classes/Payment
 * @author 		BizEvolv
 */
add_action( 'plugins_loaded', 'wc_timepayment_gateway_init', 11 );

function wc_timepayment_gateway_init() {

	class WC_Gateway_TimePayment extends WC_Payment_Gateway {

		/**
		 * Constructor for the gateway.
		 */
		public function __construct() {
	  
			$this->id                 = 'timepayment_gateway';
			//$this->icon               = apply_filters('woocommerce_timepayment_icon', '');
			$this->icon              = plugins_url('/assets/timepayment-button.png', __DIR__);
			$this->has_fields         = false;
			$this->method_title       = __( 'TimePayment Gateway for WooCommerce', 'wc-gateway-timepayment' );
			$this->method_description = __( 'This plugin allows your customers to apply for financing through your <a href="http://timepayment.com" target="_blank">TimePayment vendor account - apply here its free</a>. TimePayment provides instant approvals, easy e-signatures, and overnights you a check for the full funding amount the next day after a deal is signed. (Great company, we love them!!)  Everything in the customers cart will be entered in the financing application automatically. During checkout, customers are redirected to your secure vendor application tied to your TimePayment vendor account. Customer orders are marked as "on-hold" when received and show up in your TimePayment dashboard. All orders must be approved and funded by TimePayment before you can ship them. Do not ship or deliver the order until funding is received via TimePayment.', 'wc-gateway-timepayment' );
		  
		$this->enabled       = $this->get_option('enabled');
        $this->environment       = $this->get_option('environment');
        $this->merchant_id       = $this->get_option('merchant_id');
        //$this->redirectok        = $this->get_option('redirectok');
        //$this->redirectko        = $this->get_option('redirectko');
        $this->gateway_url_prod  = "https://timepayment.com";
        $this->gateway_url_stage = "https://api-test.timepayment.com";
        $this->min_order_amount  = 1;
        $this->max_order_amount  = 100000;
			
			// Load the settings.
			$this->init_form_fields();
			$this->init_settings();
		  
			// Define user set variables
			$this->title        = $this->get_option( 'title' );
			$this->description  = $this->get_option( 'description' );
			$this->instructions = $this->get_option( 'instructions', $this->description );
		  
			// Actions
			add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'process_admin_options' ) );
			add_action( 'woocommerce_thankyou_' . $this->id, array( $this, 'thankyou_page' ) );
		  
			// Customer Emails
			add_action( 'woocommerce_email_before_order_table', array( $this, 'email_instructions' ), 10, 3 );
		}
	
	
		 /**
     * Check if this gateway is enabled
     */
    public function is_available()
    {
        if ('yes' != $this->enabled) {
            return false;
        }

        return true;
    }

		
		/**
		 * Initialize Gateway Settings Form Fields
		 */
		 public function init_form_fields()
    {
			$this->form_fields = array(
				
			 'enabled' => array(
					'title'   => __( 'Enable/Disable', 'wc-gateway-timepayment' ),
					'type'    => 'checkbox',
					'label'   => __( 'Enable TimePayment', 'wc-gateway-timepayment' ),
					'default' => 'yes'
				),
				
			 'title' => array(
					'title'       => __( 'Title', 'wc-gateway-timepayment' ),
					'type'        => 'text',
					'description' => __( 'This controls the title for the payment method the customer sees during checkout.', 'wc-gateway-timepayment' ),
					'default'     => __( 'TimePayment', 'wc-gateway-timepayment' ),
					'desc_tip'    => true,
				),
				
			 'description' => array(
					'title'       => __( 'Description', 'wc-gateway-timepayment' ),
					'type'        => 'textarea',
					'description' => __( 'This controls the description which the user sees during checkout.', 'wc-gateway-timepayment' ),
					'default'     => __( 'TimePayment - Apply for a lease-to-own payment plan, with zero interest (same as cash) available up to 12 months. Your items in the cart will automatically be included in the application.', 'wc-gateway-timepayment' ),
					'desc_tip'    => true,
				),
				
			 'instructions' => array(
					'title'       => __( 'Instructions', 'wc-gateway-timepayment' ),
					'type'        => 'textarea',
					'description' => __( 'These instructions will show to the user once they have clicked checkout and completed the financing application process.', 'wc-gateway-timepayment' ),
					'default'     => 'We are now processing your application and will alert you when it is approved. If you are approved, we will contact you as soon as possible to discuss your payment plan options.',
					'desc_tip'    => true,
				),
				
			 'environment' => array(
                'title'       => __('Environment', 'wc-gateway-timepayment'),
                'label'       => __('Choose the Environment', 'wc-gateway-timepayment'),
                'type'        => 'select',
                'class'       => 'wc-enhanced-select',
                'default'     => 'stage',
                'options'     => array(
                    'test'          => __('Test', 'wc-gateway-timepayment'),
                    'production'     => __('Production', 'wc-gateway-timepayment')
                )
            ),
            'merchant_id' => array(
                'title'       => __('Merchant ID', 'wc-gateway-timepayment'),
                'type'        => 'text',
                'description' => __('The merchant ID TimePayment provided to you.', 'wc-gateway-timepayment'),
                'default'     => '',
                'desc_tip'    => true
            ),
           /**  'username' => array(
                'title'       => __('TimePayment Username', 'wc-gateway-timepayment'),
                'type'        => 'text',
                'description' => __('The username TimePayment provided to you.', 'wc-gateway-timepayment'),
                'default'     => '',
                'desc_tip'    => true
            ),
            'password' => array(
                'title'       => __('TimePayment Password', 'wc-gateway-timepayment'),
                'type'        => 'password',
                'description' => __('The password TimePayment provided to you.', 'wc-gateway-timepayment'),
                'default'     => '',
                'desc_tip'    => true
            ),**/
          
				
			);
			   
		}
	
	
	

    /**
     *  
     *
     *  
      NOT NEEDED FOR TIMEPAYMENT
    public function timepayment_js_lib()
    {
        if (! is_checkout() || ! $this->is_available()) {
            return;
        }
        wp_enqueue_script();
    }
		**/
    public function getAddDisplayDetails ($product) {
        $productDetails = '';
        foreach ($product as $v) {
            $key = substr($v->key, 0, 3);
            if ($key == 'pa_') {
                $productDetails.=($productDetails!='')?', ':'';
                $productDetails.= substr ($v->key, 3).': '.$v->value;
            }
        }
        return $productDetails;
    }
		
		
		
	    /**
     * Process the payment & redirect user to vendor's Timepayment Cart Apply link
     *
     * @param integer $order_id
     */
    public function process_payment($order_id)
    {
        global $wpdb;
        $order = new WC_Order($order_id);

        // fill in the product cart inside the product_info parameter
        $products = $order->get_items();
        $product_info = "";
    $cart_items = array();
        foreach ($products as $product)
        { 
            $displayName = $product['name'];
            $productOptions =  $this->getAddDisplayDetails($product['item_meta_array']);
            $displayName.= ($productOptions!='')?' ('. $productOptions.')':'';
            $objProd = new WC_Product($product['product_id']);
            $SKU = $objProd->get_sku();
            if (trim($SKU) == '') {
                $SKU = $product['name'];
            } 
			
			
			$cart_items[]=array('sku' => $SKU,
                                'display_name' => $displayName,
                                'unit_price' => (str_replace(",","",number_format($product['line_total']/$product['qty'], 2)) + $product['line_tax'])*$product['qty'],
                                'quantity' => $product['qty'],
                                'unit_tax' => $product['line_tax']
                                );

            //$product_info = $SKU . ' ' . $displayName . ' ' . $product_info.$product['name'].",";
			 
			//$addondetails = "";
			

		}
		
		$cart_item_text = "";
			$count = 1;
			
			    foreach ($cart_items as $cart_item)
        		{ 
				 
				 $cart_item_text .= 'LINE: ' . $count . ' - QTY:' . $cart_item['quantity'] . ' - ' . $cart_item['display_name'] . ' TOTAL: $' .  $cart_item['unit_price'] . ' - - - - ';
				 $count = $count + 1;
				}
		
		
        //$this->ok_url = $this->get_return_url($order);
    $wcCart = new WC_Cart();
        //$this->ko_url = htmlspecialchars_decode($wcCart->get_checkout_url());
        //$this->callback_url =  esc_url(get_site_url() .'/index.php/wc-api/WC_GetFinancing/');


        global $woocommerce;
        $order = new WC_Order($order_id);
		
		$cart_item_text .= ' SHIPPING: ' . $order->get_total_shipping() . ' ORDER TOTAL WITH TAX AND SHIPPING: ' . $order->order_total . ' -- END ORDER  --'; 
			
			
      
        if (trim($order->shipping_state)!='') {
            $gf_data['shipping_address'] = array(
                'street1'  => $order->shipping_address_1 . " " . $order->shipping_address_2,
                'city'    => $order->shipping_city,
                'state'   => $order->shipping_state,
                'zipcode' => $order->billing_postcode);
        }
		
		/** REMOTE POST EXAMPLE FROM GF COMMENTED OUT, NOT NEEDED UNTIL TP CREATES API ... 

        $body_json_data = json_encode($gf_data);
        $header_auth = base64_encode($this->username . ":" . $this->password);
			
			**/
		/**
        if ($this->environment == "test") {
            $url_to_post = $this->gateway_url_stage;
        } else {
            $url_to_post = $this->gateway_url_prod;
        }
			
		 
        $url_to_post .= '/merchant/' . $this->merchant_id  . '/requests';

        $post_args = array(
            'body' => $body_json_data,
            'timeout' => 60,     // 60 seconds
            'blocking' => true,  // Forces PHP wait until get a response
            'sslverify' => false,
            'headers' => array(
              'Content-Type' => 'application/json',
              'Authorization' => 'Basic ' . $header_auth,
              'Accept' => 'application/json'
            )
        );

        //echo '<pre>' . print_r($post_args, true) . '</pre>';

        //$gf_response = wp_remote_post($url_to_post, $post_args);

        //echo '<br><br><pre>' . print_r($gf_response, true) . '</pre>';
        //die();

        if (is_wp_error($gf_response)) {
            wc_add_notice('TimePayment cannot process your order. Please try again or select a different payment method.', 'error');
            return array('result' => 'fail', 'redirect' => '');
        }

        if (isset($gf_response['body'])) {
            $response_body = json_decode($gf_response['body']);
        } else {
            wc_add_notice('TimePayment cannot process your order. Please try again or select a different payment method.', 'error');
            return array('result' => 'fail', 'redirect' => '');
        }

        if ((isset($response_body->href) == false) || (empty($response_body->href) == true)) {
            wc_add_notice('TimePayment cannot process your order. Please try again or select a different payment method.', 'error');
            return array('result' => 'fail', 'redirect' => '');
        }
		**/

        // If we are here that means that the gateway give us a "created" status.
        // then we can create the order in hold status.
	
		
		
		// order is 'pending' by default
        // we add a note to the order
        $order->add_order_note('Waiting to finish TimePayment process!');
		
	 
 if ($this->environment == "test") {
             
			$redirect = 'https://timepaymentcorp.biz/LDAWeb/ConsumerApplication.aspx?dealercode=';
				
        } else {
            
			$redirect  = 'https://timepaymentcorp.biz/LDAWeb/ConsumerApplication.aspx?dealercode=' . $this->merchant_id;
				
        }
		
 
			
		$redirect  .=  '&apptype=C&program=';
		
		$redirect  .=  '&eqpamt=';
		
		$redirect  .= $order->order_total;
		
		$redirect  .=  '&equip=';
		
		$redirect  .=  $cart_item_text;
		
		return array(
            
			'result'    => 'success',
                
			//replace default checkout url with TimePayment's 
			//'redirect'  => $order->get_checkout_payment_url(true)
			
		 	'redirect'  => $redirect,
			
			 
			 
			/** PHP CARTS USE THIS TIMEPAYMENT CART LINK
			<a target="_blank" href='&apptype=C&program=&eqpamt=<?php  $a = number_format(($cartTotal),2); $fixedprice = str_replace(",", "",$a); echo $fixedprice + $shipping; ?>&ref=&equip=King%20Cobra%20of%20Florida-%20<?php echo strip_tags(str_replace("&", "", $timepaymentoptions)); ?>%20'><img src="//timepayment.com/wp-content/uploads/2016/05/TimePayment-Button_Same-as-Cash-Financing-Available_citrus-on-green.png" style="width: 200px;"></a>
			**/
			
        );

    }
		
	 
 
		/**
		 * Add content to the WC emails.
		 *
		 * @access public
		 * @param WC_Order $order
		 * @param bool $sent_to_admin
		 * @param bool $plain_text
		 */
		public function email_instructions( $order, $sent_to_admin, $plain_text = false ) {
		
			if ( $this->instructions && ! $sent_to_admin && $this->id === $order->payment_method && $order->has_status( 'on-hold' ) ) {
				echo wpautop( wptexturize( $this->instructions ) ) . PHP_EOL;
			}
		}
	
		
		
		
		
  } // end \WC_Gateway_TimePayment class
}
