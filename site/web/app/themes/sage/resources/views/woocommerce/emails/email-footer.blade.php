@php
    // Texto editable desde Ajustes → Emails.
    $email_footer_text = get_option('woocommerce_email_footer_text');
    if (apply_filters('woocommerce_is_email_preview', false)) {
        $preview = get_transient('woocommerce_email_footer_text');
        $email_footer_text = $preview !== false ? $preview : $email_footer_text;
    }
    $email_footer_text = apply_filters('woocommerce_email_footer_text', $email_footer_text);
    // Ruta de la imagen usando asset() de Sage; elimina dependencia de email_asset().
    $hole_logo = asset('images/email-hole.png')->uri();
@endphp
</div>
</td>
</tr>
</table><!-- End Content -->
</td>
</tr>
</table><!-- End Body -->
</td>
</tr>
</table>
</td>
</tr>
{{-- Footer --}}
<tr>
    <td align="center" valign="top">
        <table id="template_footer" width="600" cellpadding="10" cellspacing="0" border="0">
            <tr>
                <td>
                    <table width="100%" cellpadding="10" cellspacing="0">
                        <tr>
                            <td id="footer-title">
                                <h1>Futura Basura</h1>
                            </td>
                        </tr>
                        <tr>
                            <td id="footer-section-title">
                                <h2>Poster Will Be Trash</h2>
                            </td>
                        </tr>
                        <tr>
                            <td id="footer-section-body" style="text-align:center;font-family:Times,serif;">
                                <a href="{{ home_url('/') }}">futurabasura.com</a><br>
                                <a href="mailto:alwaysopen@futurabasura.com">alwaysopen@futurabasura.com</a><br>
                                <a href="https://www.instagram.com/futurabasura/">@futurabasura</a>
                            </td>
                        </tr>
                        <tr>
                            <td id="footer-section-title">
                                <h2><a href="{{ home_url('/newsletter') }}">FB Newsletter</a></h2>
                            </td>
                        </tr>
                        <tr>
                            <td id="footer-section-img" style="text-align:center;">
                                <img src="{{ esc_url($hole_logo) }}" alt="hole logo">
                            </td>
                        </tr>
                        <tr>
                            <td id="footer-section-title-end">
                                <h2>Always Open</h2>
                            </td>
                        </tr>
                        <tr>
                            <td id="footer-default-text">{!! wpautop(wptexturize($email_footer_text)) !!}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table><!-- End Footer -->
    </td>
</tr>
</table> {{-- cierra #template_container --}}
</td>
</tr>
</table> {{-- cierra #inner_wrapper --}}
</div>
</td>
<td></td>
</tr>
</table>
</body>

</html>
