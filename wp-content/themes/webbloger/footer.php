<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

							do_action( 'webbloger_action_page_content_end_text' );
							
							// Widgets area below the content
							webbloger_create_widgets_area( 'widgets_below_content' );
						
							do_action( 'webbloger_action_page_content_end' );
							?>
						</div>
						<?php
						
						do_action( 'webbloger_action_after_page_content' );

						// Show main sidebar
						get_sidebar();

						do_action( 'webbloger_action_content_wrap_end' );
						?>
					</div>
					<?php

					do_action( 'webbloger_action_after_content_wrap' );

					// Widgets area below the page and related posts below the page
					$webbloger_body_style = webbloger_get_theme_option( 'body_style' );
					$webbloger_widgets_name = webbloger_get_theme_option( 'widgets_below_page' );
					$webbloger_show_widgets = ! webbloger_is_off( $webbloger_widgets_name ) && is_active_sidebar( $webbloger_widgets_name );
					$webbloger_show_related = webbloger_is_single() && webbloger_get_theme_option( 'related_position' ) == 'below_page';
					if ( $webbloger_show_widgets || $webbloger_show_related ) {
						if ( 'fullscreen' != $webbloger_body_style ) {
							?>
							<div class="content_wrap">
							<?php
						}
						// Show related posts before footer
						if ( $webbloger_show_related ) {
							do_action( 'webbloger_action_related_posts' );
						}

						// Widgets area below page content
						if ( $webbloger_show_widgets ) {
							webbloger_create_widgets_area( 'widgets_below_page' );
						}
						if ( 'fullscreen' != $webbloger_body_style ) {
							?>
							</div>
							<?php
						}
					}
					do_action( 'webbloger_action_page_content_wrap_end' );
					?>
			</div>
			<?php
			do_action( 'webbloger_action_after_page_content_wrap' );

			// Don't display the footer elements while actions 'full_post_loading' and 'prev_post_loading'
			if ( ( ! webbloger_is_singular( 'post' ) && ! webbloger_is_singular( 'attachment' ) ) || ! in_array ( webbloger_get_value_gp( 'action' ), array( 'full_post_loading', 'prev_post_loading' ) ) ) {
				
				// Skip link anchor to fast access to the footer from keyboard
				?>
				<a id="footer_skip_link_anchor" class="webbloger_skip_link_anchor" href="#"></a>
				<?php

				do_action( 'webbloger_action_before_footer' );

				// Footer
				$webbloger_footer_type = webbloger_get_theme_option( 'footer_type' );
				if ( 'custom' == $webbloger_footer_type && ! webbloger_is_layouts_available() ) {
					$webbloger_footer_type = 'default';
				}
				get_template_part( apply_filters( 'webbloger_filter_get_template_part', "templates/footer-" . sanitize_file_name( $webbloger_footer_type ) ) );

				do_action( 'webbloger_action_after_footer' );

			}
			?>

			<?php do_action( 'webbloger_action_page_wrap_end' ); ?>

		</div>

		<?php do_action( 'webbloger_action_after_page_wrap' ); ?>

	</div>

	<?php do_action( 'webbloger_action_after_body' ); ?>

	<?php wp_footer(); ?>

</body>
</html>