<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
															</div>
														</td>
													</tr>
												</table>
												<!-- End Content -->
											</td>
										</tr>
									</table>
									<!-- End Body -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td align="center" valign="top">
						<!-- Footer -->
						<table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">
							<tr>
								<td valign="top">
									<table border="0" cellpadding="10" cellspacing="0" width="100%">
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
											<td id="footer-section-body">
												<a href="{{ home_url('/') }}">futurabasura.com</a>
												<a href="mailto:alwaysopen@futurabasura.com">alwaysopen@futurabasura.com</a>
												<a href="https://www.instagram.com/futurabasura/">@futurabasura</a>
											</td>
										</tr>
										<tr>
											<td id="footer-section-title">
												<h2><a href="{{ home_url('/newsletter') }}">FB Newsletter</a></h2>
											</td>
										</tr>
										<tr>
											<td id="footer-section-img">
												<img src="{{ home_url('/app/themes/fb/public/images/email-hole.png') }}" alt="hole-logo">

											</td>
										</tr>
										<tr>
											<td id="footer-section-title-end">
												<h2>Always Open</h2>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<!-- End Footer -->
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
