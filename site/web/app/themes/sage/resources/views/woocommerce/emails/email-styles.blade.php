<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg        = get_option( 'woocommerce_email_background_color' );
$body      = get_option( 'woocommerce_email_body_background_color' );
$base      = get_option( 'woocommerce_email_base_color' );
$base_text = wc_light_or_dark( $base, '#202020', '#ffffff' );
$text      = get_option( 'woocommerce_email_text_color' );
// $footer_img_url = 'Roots\asset('images/email-hole.png')';


// Pick a contrasting color for links.
// $link_color = wc_hex_is_light( $base ) ? $base : $base_text;

// if ( wc_hex_is_light( $body ) ) {
// 	$link_color = wc_hex_is_light( $base ) ? $base_text : $base;
// }

$link_color = '#0000ff';

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );
$text_lighter_40 = wc_hex_lighter( $text, 40 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
body {
	padding: 0;
}

#wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
	margin: 0;
	padding: 0;
	-webkit-text-size-adjust: none !important;
	width: 100%;
}

#template_container {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#template_header {
	background-color: <?php echo esc_attr( $base ); ?>;
	color: <?php echo esc_attr( $base_text ); ?>;
	border-bottom: 0;
	font-weight: bold;
	line-height: 100%;
	vertical-align: middle;
	font-family: "Arial, sans-serif;
}

#template_date {
	padding-top: 50px;
	text-align: right;
	letter-spacing: 0.4em;
}

#template_header h1,
#template_header h1 a {
	color: <?php echo esc_attr( $base_text ); ?>;
	background-color: inherit;
}

#template_header_image img {
	margin-left: 0;
	margin-right: 0;
}

#template_footer td {
	padding: 0;
}

#template_footer #credit p {
	margin: 0 0 16px;
}

#body_content {
	background-color: <?php echo esc_attr( $body ); ?>;
}

#body_content table td {
	padding: 48px 48px 32px;
}

#body_content table td td {
	padding: 12px;
}

#body_content table td th {
	padding: 12px;
}

#body_content td ul.wc-item-meta {
	font-size: small;
	margin: 1em 0 0;
	padding: 0;
	list-style: none;
}

#body_content td ul.wc-item-meta li {
	margin: 0.5em 0 0;
	padding: 0;
}

#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 16px;
}

#body_content_inner {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	font-family: "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif;
	font-size: 16px;
	line-height: 150%;
	letter-spacing: 0.05em;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

.td {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border-bottom: 1px solid #000000;
	border-top: none;
	border-left: none;
	border-right: none;
	vertical-align: middle;
}

.address {
	padding: 12px;
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border-top: 1px solid #000;
	border-bottom: 1px solid #000;
}

.text {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: Times, "Times New Roman", serif;
}

.link {
	color: <?php echo esc_attr( $link_color ); ?>;
}

#header_wrapper {
	padding: 64px 48px 15px;
	display: block;
}

h1 {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: Times, "Times New Roman", serif;
	font-size: 30px;
	font-weight: 400;
	line-height: 150%;
	margin: 0;
	text-align: center;
}

#body_content h2 {
	color: <?php echo esc_attr( $text ); ?>;
	display: block;
	font-family: Times, "Times New Roman", serif;
	font-size: 24px;
	font-weight: 400;
	line-height: 130%;
	margin: 50px 0 18px;
	text-align: center;
}

h3 {
	color: <?php echo esc_attr( $text ); ?>;
	display: block;
	font-family: Times, "Times New Roman", serif;
	font-size: 20px;
	font-weight: 400;
	line-height: 130%;
	margin: 16px 0 8px;
	text-align: center;
}

a {
	color: <?php echo esc_attr( $link_color ); ?>;
	font-weight: normal;
	text-decoration: none;
}

img {
	border: none;
	display: inline-block;
	font-size: 14px;
	font-weight: bold;
	height: auto;
	outline: none;
	text-decoration: none;
	text-transform: capitalize;
	vertical-align: middle;
	max-width: 100%;
	height: auto;
}

#footer-section-title {
	text-align: center;
}

#footer-section-title-end {
	text-align: center;
}

#footer-section-title h2 {
	font-size: 14px;
	font-weight: 400;
	padding-top: 30px;
	font-family: Times, "Times New Roman", serif;
	text-transform: uppercase;
	letter-spacing: 0.1em;
}

#footer-section-title-end h2 {
	font-size: 14px;
	font-weight: 400;
	padding-top: 10px;
	font-family: Times, "Times New Roman", serif;
	text-transform: uppercase;
	letter-spacing: 0.1em;
}

#footer-section-body {
	text-align: center;
	font-family: Times, "Times New Roman", serif;
}

#footer-section-body a {
	display: block;
}

#footer-section-img {
	text-align: center;
}
<?php
