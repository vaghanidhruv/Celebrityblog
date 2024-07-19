<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

// Page (category, tag, archive, author) title

if ( webbloger_need_page_title() ) {
	webbloger_sc_layouts_showed( 'title', true );
	webbloger_sc_layouts_showed( 'postmeta', true );
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php
						// Post meta on the single post
						if ( is_single() ) {
							?>
							<div class="sc_layouts_title_meta">
							<?php
								webbloger_show_post_meta(
									apply_filters(
										'webbloger_filter_post_meta_args', array(
											'components' => join( ',', webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'meta_parts' ) ) ),
											'counters'   => join( ',', webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'counters' ) ) ),
											'seo'        => webbloger_is_on( webbloger_get_theme_option( 'seo_snippets' ) ),
										), 'header', 1
									)
								);
							?>
							</div>
							<?php
						}

						// Blog/Post title
						?>
						<div class="sc_layouts_title_title">
							<?php
							$webbloger_blog_title           = webbloger_get_blog_title();
							$webbloger_blog_title_text      = '';
							$webbloger_blog_title_class     = '';
							$webbloger_blog_title_link      = '';
							$webbloger_blog_title_link_text = '';
							if ( is_array( $webbloger_blog_title ) ) {
								$webbloger_blog_title_text      = $webbloger_blog_title['text'];
								$webbloger_blog_title_class     = ! empty( $webbloger_blog_title['class'] ) ? ' ' . $webbloger_blog_title['class'] : '';
								$webbloger_blog_title_link      = ! empty( $webbloger_blog_title['link'] ) ? $webbloger_blog_title['link'] : '';
								$webbloger_blog_title_link_text = ! empty( $webbloger_blog_title['link_text'] ) ? $webbloger_blog_title['link_text'] : '';
							} else {
								$webbloger_blog_title_text = $webbloger_blog_title;
							}
							?>
							<h1 itemprop="headline" class="sc_layouts_title_caption<?php echo esc_attr( $webbloger_blog_title_class ); ?>">
								<?php
								$webbloger_top_icon = webbloger_get_term_image_small();
								if ( ! empty( $webbloger_top_icon ) ) {
									$webbloger_attr = webbloger_getimagesize( $webbloger_top_icon );
									?>
									<img src="<?php echo esc_url( $webbloger_top_icon ); ?>" alt="<?php esc_attr_e( 'Site icon', 'webbloger' ); ?>"
										<?php
										if ( ! empty( $webbloger_attr[3] ) ) {
											webbloger_show_layout( $webbloger_attr[3] );
										}
										?>
									>
									<?php
								}
								echo wp_kses_data( $webbloger_blog_title_text );
								?>
							</h1>
							<?php
							if ( ! empty( $webbloger_blog_title_link ) && ! empty( $webbloger_blog_title_link_text ) ) {
								?>
								<a href="<?php echo esc_url( $webbloger_blog_title_link ); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html( $webbloger_blog_title_link_text ); ?></a>
								<?php
							}

							// Category/Tag description
							if ( ! is_paged() && ( is_category() || is_tag() || is_tax() ) ) {
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
							}

							?>
						</div>
						<?php

						// Breadcrumbs
						ob_start();
						do_action( 'webbloger_action_breadcrumbs' );
						$webbloger_breadcrumbs = ob_get_contents();
						ob_end_clean();
						webbloger_show_layout( $webbloger_breadcrumbs, '<div class="sc_layouts_title_breadcrumbs">', '</div>' );
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
