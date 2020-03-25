<?php

/*
 * Theme Setup
 */ 

// ----------------------------------------------------------------------------------------
// Remove extra stuff from <head>
// http://wpcanyon.com/tipsandtricks/removing-junk-from-wordpress-header/
// ----------------------------------------------------------------------------------------

remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
//remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
//remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

function remove_comments_rss( $for_comments ) {
   return;
}
add_filter('post_comments_feed_link','remove_comments_rss');

function remove_recent_comments_style() {
   global $wp_widget_factory;
   remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

/**
 * Remove auto formatting from shortcodes. Ha.
 */
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

/**
 * Featured image support
 **/
add_theme_support( 'post-thumbnails' ); 

/**
 * Image sizes
 **/
//add_image_size( 'case_studies', 1054 , 774, true);

if(function_exists('register_sidebar'))
 {

    register_sidebar ( array (
            'name' => 'Widget Area 1',
            'id' => 'widget-1',
            'description' => 'Widget Area 2.',
            'before_widget' => '<div id="%2$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>' ,
    ) );
}

// ----------------------------------------------------------------------------------------
// Enqueue scripts and styles for the front end.
// ----------------------------------------------------------------------------------------

function enqueue_my_scripts() {
  // Load our main stylesheet.
  wp_enqueue_style( 'screen-style', get_template_directory_uri() . '/css/screen.css' );

  // Always load jQuery on the front end
  if(!is_admin()) {
    wp_enqueue_script( 'jquery' );
    wp_register_script(
      'scrollReveal',
      get_template_directory_uri() . '/js/scrollreveal.min.js',
      '',
      '1',
      false
    );
    wp_register_script(
      'scrollMagic',
      get_template_directory_uri() . '/js/scrollmagic.min.js',
      '',
      '1',
      true
    );
    wp_register_script(
      'indicators',
      get_template_directory_uri() . '/js/debug.addIndicators.min.js',
      '',
      '1',
      true
    );
    wp_register_script(
      'cookie',
      get_template_directory_uri() . '/js/js.cookie.min.js',
      '',
      '1',
      false
    );
    wp_register_script(
      'px_general',
      get_template_directory_uri() . '/js/general.js',
      array('jquery', 'cookie', 'scrollReveal', 'scrollMagic', 'indicators'),
      '1',
      true
    );
    wp_enqueue_script( 'px_general' );
  }

}
add_action( 'wp_enqueue_scripts', 'enqueue_my_scripts' );

// ----------------------------------------------------------------------------------------
// Nav menus
// ----------------------------------------------------------------------------------------

add_action( 'init', 'register_my_menu' );
  function register_my_menu() {
    register_nav_menus( array(
    'main_menu' => 'Main Menu',
    'mobile_menu' => 'Mobile Menu',
  ) );
}

// ----------------------------------------------------
// Featured Image support
// ----------------------------------------------------

add_theme_support( 'post-thumbnails' ); 


// ----------------------------------------------------
// Advanced Custom Fields
// ----------------------------------------------------

if( function_exists('acf_add_options_page') ) {
  acf_add_options_page();
}

// (Optional) Hide the ACF admin menu item.
/*add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return false;
}
*/

// ----------------------------------------------------
// Read More
// ----------------------------------------------------

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
  return '...<br><a class="button more-tag" href="'. get_permalink($post->ID) . '"> Read more</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// ----------------------------------------------------------------------------------------
// Other Functions
// ----------------------------------------------------------------------------------------
/*
 * Print the <title> text based on what is being viewed.
 */
function px_custom_title() {

	global $page, $paged;

	wp_title( '-', true, 'right' );

	// Add the blog name.

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " - $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' - ' . sprintf( __( 'Page %s', 'px' ), max( $paged, $page ) );

}




// ----------------------------------------------------------------------------------------
// Woocommerce
// ----------------------------------------------------------------------------------------
add_theme_support( 'woocommerce' );

//Remove default WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

//SHOP -- archive page
//Remove link
remove_action( 'woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open', 10); 

//Remove single page
add_filter( 'woocommerce_register_post_type_product','hide_product_page',12,1);
function hide_product_page($args){
    $args["publicly_queryable"]=false;
    $args["public"]=false;
    return $args;
}


//Move store notice above header so it can be positioned relatively
remove_action( 'wp_footer','woocommerce_demo_store'); 

/*function body_begin() {
    if ( ! is_store_notice_showing() ) {
        return;
    }

    $notice = get_option( 'woocommerce_demo_store_notice' );

    if ( empty( $notice ) ) {
        $notice = __( 'This is a demo store for testing purposes &mdash; no orders shall be fulfilled.', 'woocommerce' );
    }

    echo apply_filters( 'woocommerce_demo_store', '<p class="woocommerce-store-notice demo_store">' . wp_kses_post( $notice ) . ' <a href="#" class="woocommerce-store-notice__dismiss-link">' . esc_html__( 'Dismiss', 'woocommerce' ) . '</a></p>', $notice ); // WPCS: XSS ok     
        
}*/

//Remove the notice that shows the number of results.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
//Remove the notice that shows dropdown ordering.
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering',30 );


//New badge  
/*add_action( 'woocommerce_before_shop_loop_item_title', function() {
	$postdate      = get_the_time( 'Y-m-d' ); // Post date
	$postdatestamp = strtotime( $postdate );  // Timestamped post date
	$newness       = 7;                      // Newness in days
	if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
		echo '<div class="new-badge"><span>' . esc_html__( 'New', 'total' ) . '</span></div>';
	}
}, 20 );
*/

// display an 'Out of Stock' label on archive pages
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_stock', 10 );
function woocommerce_template_loop_stock() {
    global $product;
    if ( (! $product->managing_stock() && ! $product->is_in_stock()) || ($product->managing_stock() && ! $product->is_in_stock()))
        echo '<p class="stock out-of-stock">Out of Stock</p>';
}

add_action('the_content','ravs_content_div');
function ravs_content_div( $content ){
	return '<div class="small-content-box">'.$content.'</div>';
}
 
add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_text', 10, 3);

function woocommerce_custom_sale_text($text, $post, $_product)
{
   return '<span class="onsale">Sale</span>';
}

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '<span class="breadcrumb-slash"> / </span>';
	return $defaults;
}


/**
 * Change Added to cart message.
 */
function ace_add_to_cart_message_html( $message, $products ) {
	$count = 0;
	$titles = array();
	foreach ( $products as $product_id => $qty ) {
		$titles[] = ( $qty > 1 ? absint( $qty ) . ' &times; ' : '' ) . sprintf( _x( '%s', 'Item name', 'woocommerce' ), strip_tags( get_the_title( $product_id ) ) );
		$count += $qty;
	}

	$titles     = array_filter( $titles );
	$added_text = sprintf( _n(
		'<strong>%s</strong> has been added to your cart.', // Singular
		'<strong>%s</strong> have been added to your cart. ', // Plural
		$count, // Number of products added
		'woocommerce' // Textdomain
	), wc_format_list_of_items( $titles ) );
	$message    = sprintf( $added_text . ' <a href="%s#cart" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View cart', 'woocommerce' ), esc_html( '', 'woocommerce') );
	return $message;
}
add_filter( 'wc_add_to_cart_message_html', 'ace_add_to_cart_message_html', 10, 2 );


/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

//CART

//TRANSLATIONS


function my_text_strings( $translated_text, $text, $domain ) {
    switch ( $translated_text ) {
        case 'Coupon code' :
            $translated_text = __( 'Promo code', 'woocommerce' );
            break;
        case 'Apply coupon' :
            $translated_text = __( 'Apply code', 'woocommerce' );
            break;
        case 'Proceed to checkout' :
            $translated_text = __( 'Checkout', 'woocommerce' );
            break;
        case 'Ship to a different address?' :
            $translated_text = __( 'Ship to a different address', 'woocommerce' );
            break;
    }
    return $translated_text;
  
}
add_filter( 'gettext', 'my_text_strings', 20, 3 );



//BILLING

// remove Order Notes from checkout field in Woocommerce
add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
function alter_woocommerce_checkout_fields( $fields ) {
     unset($fields['order']['order_comments']);
     return $fields;
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);


function sv_remove_cart_product_link( $product_link, $cart_item, $cart_item_key ) {
    $product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
    return $product->get_title();
}
add_filter( 'woocommerce_cart_item_name', 'sv_remove_cart_product_link', 10, 3 );

function namespace_force_individual_cart_items( $cart_item_data, $product_id ) {
  $unique_cart_item_key = md5( microtime() . rand() );
  $cart_item_data['unique_key'] = $unique_cart_item_key;

  return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'namespace_force_individual_cart_items', 10, 2 );



add_action( 'woocommerce_order_status_completed', 'add_unique_id' );

function add_unique_id($order_id) {
	$order = new WC_Order( $order_id );
	$items = $order->get_items(); 
	$prefix = "CAP";
	foreach ($items as $item_id => $product ) {
    $unique = mt_rand();
    $unique = substr($unique, 0, 8);
    $unique = $prefix . $unique;
		wc_add_order_item_meta($item_id, 'Gift Certificate Number', $unique);
	}
}


add_action('woocommerce_order_item_meta_end', 'email_confirmation_display_order_items', 10, 4);

function email_confirmation_display_order_items($item_id) {

    // Only on emails notifications
    if( ! (is_admin() || is_wc_endpoint_url() )) {
        echo '<div>Gift Certificate Number: '. wc_get_order_item_meta( $item_id, 'Gift Certificate Number') .'</div>';
    }
}



add_action( 'woocommerce_before_shop_loop', 'handsome_bearded_guy_select_variations' );

function handsome_bearded_guy_select_variations() {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_add_to_cart', 30 );
}

function custom_remove_all_quantity_fields( $return, $product ) {return true;}
add_filter( 'woocommerce_is_sold_individually','custom_remove_all_quantity_fields', 10, 2 );


/* update vendor sold by text */
add_filter( 'wcpv_sold_by_text', 'sold_by_text' );
function sold_by_text() {
  return 'at ';
}


/* update vendor  */
add_action( 'add_sold_by_order_details', 'add_no_link_sold_by_order_details' );

function add_no_link_sold_by_order_details($sold_by) {
	$sold_by = get_option( 'wcpv_vendor_settings_display_show_by', 'yes' );

	if ( 'yes' === $sold_by ) {

		$sold_by = WC_Product_Vendors_Utils::get_sold_by_link( $item['product_id'] );

		echo '<br /><em class="wcpv-sold-by-order-details">test' . apply_filters( 'wcpv_sold_by_text', esc_html__( 'Sold By:', 'woocommerce-product-vendors' ) ) . ' title="' . esc_attr( $sold_by['name'] ) . '">' . $sold_by['name'] . '</em>';
	}

	return true;
}

remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

function my_woocommerce_widget_shopping_cart_proceed_to_checkout() {
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button btn-default">' . esc_html__( 'Continue to Checkout', 'woocommerce' ) . '</a>';
}

add_action( 'woocommerce_widget_shopping_cart_buttons', 'my_woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );


/**
Support savings
*/
 
function support_savings() {
 
    global $woocommerce;
      
    $discount_total = 0;
    $regular_price_total = 0;
      
    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values) {
          
    $_product = $values['data'];
  
        if ( $_product->is_on_sale() ) {
	        $regular_price = $_product->get_regular_price();
	        $sale_price = $_product->get_sale_price();
	        $discount = ($regular_price - $sale_price) * $values['quantity'];
	        $discount_total += $discount;
        }
        
        $regular_price = $_product->get_regular_price();
        $regular_price_total += $regular_price * $values['quantity'];
  
    }
    
		echo '<tr class="spacer"><th></th></tr> 
		<tr class="cart-subtotal"><th>' . esc_html__( 'Subtotal', 'woocommerce' ) . '</th> <td class="woocommerce-Price-amount">$' . number_format($regular_price_total, 2, '.', '') . '</td></tr>';
            
    if ( $discount_total > 0 ) {
	    echo '<tr class="cart-discount support-savings-total">
	    <th>'. __( 'Support Savings', 'woocommerce' ) .'</th>
	    <td data-title=" '. __( 'Support Savings', 'woocommerce' ) .' "><span class="minus-sign">-</span>'
	    . wc_price( $discount_total + $woocommerce->cart->discount_cart ) .'</td>
	    </tr><tr class="spacer"><th></th></tr>';
    }
 
}
 
// Hook our values to the Checkout pages
 
add_action( 'woocommerce_review_order_before_order_total', 'support_savings', 99);

remove_action( 'woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10);

function wc_before_savings_subtotal() {
 
    global $woocommerce;
      
    $discount_total = 0;
    $regular_price_total = 0;
    
    foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values) {
          
    	$_product = $values['data'];
  
        if ( $_product->is_on_sale() ) {
	        $regular_price = $_product->get_regular_price();
	        $sale_price = $_product->get_sale_price();
	        $discount = ($regular_price - $sale_price) * $values['quantity'];
	        $discount_total += $discount;
        }
        
        $regular_price = $_product->get_regular_price();
        $regular_price_total += $regular_price * $values['quantity'];
  
    }
    
	echo '<span class="total-title">' . esc_html__( 'Subtotal', 'woocommerce' ) . '</span> <span class="woocommerce-Price-amount">$' . number_format($regular_price_total, 2, '.', '') . '</span>';
	
    if ( $discount_total > 0 ) {
	    echo '<p class="woocommerce-mini-cart__total support-savings-total">
	    <span class="total-title">'. __( 'Support Savings', 'woocommerce' ) .'</span>
	    <span class="woocommerce-Price-amount amount" data-title=" '. __( 'Support Savings', 'woocommerce' ) .' ">-'
	    . wc_price( $discount_total + $woocommerce->cart->discount_cart ) .'</span>
	    </p>';
    }

}

add_action( 'woocommerce_widget_shopping_cart_total', 'wc_before_savings_subtotal', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50 );


/**
 * Add text to the thank you page
 */
 
add_action( 'woocommerce_thankyou_order_received_text', 'add_content_thankyou', 20 );
 
function add_content_thankyou() {
	echo 'Thanks for your payment! Your transaction has been completed, and a receipt for your purchase with your gift certificate(s) has been emailed to you. Please print or save the gift certificate number given in the email and present it to the vendor when you wish to redeem. Log into your PayPal account to view transaction details.';
}