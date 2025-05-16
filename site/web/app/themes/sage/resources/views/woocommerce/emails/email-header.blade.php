@php
    use Automattic\WooCommerce\Utilities\FeaturesUtil;

    $img = get_option('woocommerce_email_header_image');

    if (apply_filters('woocommerce_is_email_preview', false)) {
        $img_preview = get_transient('woocommerce_email_header_image');
        $img = $img_preview !== false ? $img_preview : $img;
    }

    // Compatibilidad si el helper de “mejoras de email” no existe.
    $email_improvements_enabled = function_exists('Automattic\WooCommerce\Utilities\FeaturesUtil::feature_is_enabled')
        ? FeaturesUtil::feature_is_enabled('email_improvements')
        : false;
@endphp
<!DOCTYPE html>
<html {!! get_language_attributes() !!}>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset={{ get_bloginfo('charset') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ get_bloginfo('name', 'display') }}</title>
</head>

<body {{ is_rtl() ? 'rightmargin' : 'leftmargin' }}="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
    <table width="100%" id="outer_wrapper">
        <tr>
            <td></td>
            <td width="600">
                <div id="wrapper" dir="{{ is_rtl() ? 'rtl' : 'ltr' }}">
                    <table id="inner_wrapper" width="100%" cellpadding="0" cellspacing="0" border="0">
                        <tr>
                            <td align="center" valign="top">
                                {{-- Logo / texto --}}
                                @if ($email_improvements_enabled)
                                    <table width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td id="template_header_image">
                                                @if ($img)
                                                    <p style="margin-top:0"><img src="{{ esc_url($img) }}"
                                                            alt="{{ esc_attr(get_bloginfo('name', 'display')) }}" /></p>
                                                @else
                                                    <p class="email-logo-text">{{ get_bloginfo('name', 'display') }}</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <div id="template_header_image">
                                        @if ($img)
                                            <p style="margin-top:0"><img src="{{ esc_url($img) }}"
                                                    alt="{{ esc_attr(get_bloginfo('name', 'display')) }}" /></p>
                                        @endif
                                    </div>
                                @endif

                                {{-- Contenedor principal --}}
                                <table id="template_container" width="100%" cellpadding="0" cellspacing="0"
                                    border="0">
                                    <tr>
                                        <td align="center" valign="top">
                                            {{-- Fecha personalizada --}}
                                            <table id="template_date" width="100%">
                                                <tr>
                                                    <td>{{ date_i18n('Y-m-d') }}</td>
                                                </tr>
                                            </table>
                                            {{-- Encabezado --}}
                                            <table id="template_header" width="100%">
                                                <tr>
                                                    <td id="header_wrapper">
                                                        <h1>{{ esc_html($email_heading ?? '') }}</h1>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center" valign="top">
                                            {{-- ⬇️ WooCommerce insertará aquí el body (lo cierra el footer) --}}
                                            <table id="template_body" width="100%" cellpadding="0" cellspacing="0"
                                                border="0">
                                                <tr>
                                                    <td id="body_content" valign="top">
                                                        <table width="100%" cellpadding="20" cellspacing="0"
                                                            border="0">
                                                            <tr>
                                                                <td id="body_content_inner_cell" valign="top">
                                                                    <div id="body_content_inner">
