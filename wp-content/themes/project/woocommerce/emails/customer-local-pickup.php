<?php
/**
 * Customer local pickup email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/customer-local-pickup.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates/Emails
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<?php /* translators: %s: Site title */ ?>
<p><?php printf( esc_html__( 'Your %s order is ready to be picked up at The Locals! ', 'woocommerce' ), esc_html( wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ) ) ); ?></p>
<p>
<strong><a href="https://www.google.ca/maps/place/141+Sherbrook+St,+Winnipeg,+MB+R3C+2B5/@49.8830224,-97.1611989,17z/data=!4m5!3m4!1s0x52ea73f779f4e629:0x739b6cc881e0343!8m2!3d49.883019!4d-97.1590049" target="_blank">141 Sherbrook Street, Winnipeg Manitoba</a><br>
Hours: Tuesday - Friday 11am - 7pm<br>
Saturday - Sunday: 12:30 - 5:00</strong>
</p>
<?php

/*
 * @hooked WC_Emails::order_details() Shows the order details table.
 * @hooked WC_Structured_Data::generate_order_data() Generates structured data.
 * @hooked WC_Structured_Data::output_structured_data() Outputs structured data.
 * @since 2.5.0
 */
do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::order_meta() Shows order meta data.
 */
do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email );

/*
 * @hooked WC_Emails::customer_details() Shows customer details
 * @hooked WC_Emails::email_address() Shows email address
 */


?>
<p>
<?php esc_html_e( 'Thanks for shopping with us.', 'woocommerce' ); ?>
</p>
<?php

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
