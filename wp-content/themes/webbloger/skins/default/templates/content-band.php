<?php
/**
 * 'Band' template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.71.0
 */

$webbloger_template_args = get_query_var( 'webbloger_template_args' );
if ( ! is_array( $webbloger_template_args ) ) {
	$webbloger_template_args = array(
								'type'    => 'band',
								'columns' => 1
								);
}

$webbloger_columns       = 1;

$webbloger_expanded      = ! webbloger_sidebar_present() && webbloger_get_theme_option( 'expand_content' ) == 'expand';

$webbloger_post_format   = get_post_format();
$webbloger_post_format   = empty( $webbloger_post_format ) ? 'standard' : str_replace( 'post-format-', '', $webbloger_post_format );

if ( is_array( $webbloger_template_args ) ) {
	$webbloger_columns    = empty( $webbloger_template_args['columns'] ) ? 1 : max( 1, $webbloger_template_args['columns'] );
	$webbloger_blog_style = array( $webbloger_template_args['type'], $webbloger_columns );
	if ( ! empty( $webbloger_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide"><?php
	} elseif ( $webbloger_columns > 1 ) {
		$webbloger_columns_class = webbloger_get_column_class( 1, $webbloger_columns, ! empty( $webbloger_template_args['columns_tablet']) ? $webbloger_template_args['columns_tablet'] : '', ! empty($webbloger_template_args['columns_mobile']) ? $webbloger_template_args['columns_mobile'] : '' );
		?><div class="<?php echo esc_attr( $webbloger_columns_class ); ?>"><?php
	}
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_band post_format_' . esc_attr( $webbloger_post_format ) );
	webbloger_add_blog_animation( $webbloger_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$webbloger_hover      = ! empty( $webbloger_template_args['hover'] ) && ! webbloger_is_inherit( $webbloger_template_args['hover'] )
							? $webbloger_template_args['hover']
							: webbloger_get_theme_option( 'image_hover' );
	$webbloger_components = ! empty( $webbloger_template_args['meta_parts'] )
							? ( is_array( $webbloger_template_args['meta_parts'] )
								? $webbloger_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $webbloger_template_args['meta_parts'] ) )
								)
							: webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'meta_parts' ) );

	$webbloger_show_title = get_the_title() != '';
	$webbloger_show_meta  = count( $webbloger_components ) > 0 && ! in_array( $webbloger_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	// Post date
	if ( $webbloger_show_meta && in_array( 'date', $webbloger_components ) ) {
		?>
		<div class="post_date_wrap">
			<div class="day"><?php echo esc_html(get_the_date('d')); ?></div>
			<?php			
			webbloger_show_post_meta( apply_filters(
												'webbloger_filter_post_meta_args',
												array(
													'components' => 'date',
													'date_format' => 'M Y',
													'seo'        => false,
													'echo'       => true,
													),
												'band', 0
												)
								);
			?>
		</div>
		<?php
		$webbloger_components = webbloger_array_delete_by_value( $webbloger_components, 'date' );
	}

	// Featured image
	webbloger_show_post_featured( apply_filters( 'webbloger_filter_args_featured', 
		array(
			'no_links'   => ! empty( $webbloger_template_args['no_links'] ),
			'hover'      => $webbloger_hover,
			'meta_parts' => $webbloger_components,
			'thumb_bg'   => true,
			'thumb_ratio' => $webbloger_post_format == 'image' ? '16:9' : '1:1',
			'thumb_size' => webbloger_get_thumb_size( 'big' )
		),
		'content-band',
		$webbloger_template_args
	) );

	?><div class="post_content_wrap"><?php
		// Title and post meta
		if ( $webbloger_show_title ) {
			?>
			<div class="post_header entry-header">
				<?php
				// Categories
				if ( apply_filters( 'webbloger_filter_show_blog_categories', $webbloger_show_meta && in_array( 'categories', $webbloger_components ), array( 'categories' ), 'band' ) ) {
					do_action( 'webbloger_action_before_post_category' );
					?>
					<div class="post_category">
						<?php
						webbloger_show_post_meta( apply_filters(
															'webbloger_filter_post_meta_args',
															array(
																'components' => 'categories',
																'seo'        => false,
																'echo'       => true,
																),
															'hover_' . $webbloger_hover, 1
															)
											);
						?>
					</div>
					<?php
					$webbloger_components = webbloger_array_delete_by_value( $webbloger_components, 'categories' );
					do_action( 'webbloger_action_after_post_category' );
				}
				// Post title
				if ( apply_filters( 'webbloger_filter_show_blog_title', true, 'band' ) ) {
					do_action( 'webbloger_action_before_post_title' );
					$webbloger_title_tag = $webbloger_post_format == 'image' && !is_archive() && !is_home() ? 'h3' : 'h4';
					if ( empty( $webbloger_template_args['no_links'] ) ) {
						the_title( sprintf( '<'.esc_html($webbloger_title_tag).' class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></'.esc_html($webbloger_title_tag).'>' );
					} else {
						the_title( '<'.esc_html($webbloger_title_tag).' class="post_title entry-title">', '</'.esc_html($webbloger_title_tag).'>' );
					}
					do_action( 'webbloger_action_after_post_title' );
				}
				?>
			</div><!-- .post_header -->
			<?php
		}

		// Post content
		if ( ! isset( $webbloger_template_args['excerpt_length'] ) && ! in_array( $webbloger_post_format, array( 'gallery', 'audio', 'video' ) ) ) {
			$webbloger_template_args['excerpt_length'] = 30;
		}
		if ( apply_filters( 'webbloger_filter_show_blog_excerpt', empty( $webbloger_template_args['hide_excerpt'] ) && webbloger_get_theme_option( 'excerpt_length' ) > 0, 'band' ) ) {
			?>
			<div class="post_content entry-content">
				<?php
				// Post content area
				webbloger_show_post_content( $webbloger_template_args, '<div class="post_content_inner">', '</div>' );
				?>
			</div><!-- .entry-content -->
			<?php
		}
		// Post meta
		if ( apply_filters( 'webbloger_filter_show_blog_meta', $webbloger_show_meta, $webbloger_components, 'band' ) ) {
			if ( count( $webbloger_components ) > 0 ) {
				do_action( 'webbloger_action_before_post_meta' );
				webbloger_show_post_meta(
					apply_filters(
						'webbloger_filter_post_meta_args', array(
							'components' => join( ',', $webbloger_components ),
							'seo'        => false,
							'echo'       => true,
						), 'band', 1
					)
				);
				do_action( 'webbloger_action_after_post_meta' );
			}
		}
		// More button
		if ( apply_filters( 'webbloger_filter_show_blog_readmore', true, 'band' ) ) {
			if ( empty( $webbloger_template_args['no_links'] ) ) {
				do_action( 'webbloger_action_before_post_readmore' ); ?>
				<a class="sc_button sc_button_simple color_style_1" href="<?php echo esc_url( get_permalink() ); ?>">
					<span class="icon"></span>
				</a><?php
				do_action( 'webbloger_action_after_post_readmore' );
			}
		}
		?>
	</div>
</article>
<?php

if ( is_array( $webbloger_template_args ) ) {
	if ( ! empty( $webbloger_template_args['slider'] ) || $webbloger_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
