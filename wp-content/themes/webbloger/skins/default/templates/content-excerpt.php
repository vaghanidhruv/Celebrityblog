<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_template_args = get_query_var( 'webbloger_template_args' );
$webbloger_columns = 1;
if ( is_array( $webbloger_template_args ) ) {
	$webbloger_columns    = empty( $webbloger_template_args['columns'] ) ? 1 : max( 1, $webbloger_template_args['columns'] );
	$webbloger_blog_style = array( $webbloger_template_args['type'], $webbloger_columns );
	if ( ! empty( $webbloger_template_args['slider'] ) ) {
		?><div class="slider-slide swiper-slide">
		<?php
	} elseif ( $webbloger_columns > 1 ) {
		$webbloger_columns_class = webbloger_get_column_class( 1, $webbloger_columns, ! empty( $webbloger_template_args['columns_tablet']) ? $webbloger_template_args['columns_tablet'] : '', ! empty($webbloger_template_args['columns_mobile']) ? $webbloger_template_args['columns_mobile'] : '' );
		?>
		<div class="<?php echo esc_attr( $webbloger_columns_class ); ?>">
		<?php
	}
} else {
	$webbloger_template_args = array();
}
$webbloger_expanded    = ! webbloger_sidebar_present() && webbloger_get_theme_option( 'expand_content' ) == 'expand';
$webbloger_post_format = get_post_format();
$webbloger_post_format = empty( $webbloger_post_format ) ? 'standard' : str_replace( 'post-format-', '', $webbloger_post_format );
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class( 'post_item post_item_container post_layout_excerpt post_format_' . esc_attr( $webbloger_post_format ) );
	webbloger_add_blog_animation( $webbloger_template_args );
	?>
>
	<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	$webbloger_hover      = ! empty( $webbloger_template_args['hover'] ) && ! webbloger_is_inherit( $webbloger_template_args['hover'] )
							? $webbloger_template_args['hover']
							: webbloger_get_theme_option( 'image_hover' );
	$webbloger_components = ! empty( $webbloger_template_args['meta_parts'] )
							? ( is_array( $webbloger_template_args['meta_parts'] )
								? $webbloger_template_args['meta_parts']
								: array_map( 'trim', explode( ',', $webbloger_template_args['meta_parts'] ) )
								)
							: webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'meta_parts' ) );
	webbloger_show_post_featured( apply_filters( 'webbloger_filter_args_featured',
		array(
			'no_links'   => ! empty( $webbloger_template_args['no_links'] ),
			'hover'      => $webbloger_hover,
			'meta_parts' => $webbloger_components,
			'thumb_size' => webbloger_get_thumb_size( strpos( webbloger_get_theme_option( 'body_style' ), 'full' ) !== false
								? 'full'
								: ( $webbloger_expanded 
									? 'huge' 
									: 'big' 
									)
								),
		),
		'content-excerpt',
		$webbloger_template_args
	) );

	// Title and post meta
	$webbloger_show_title = get_the_title() != '';
	$webbloger_show_meta  = count( $webbloger_components ) > 0 && ! in_array( $webbloger_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );

	if ( $webbloger_show_title ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Categories
			if ( apply_filters( 'webbloger_filter_show_blog_categories', $webbloger_show_meta && in_array( 'categories', $webbloger_components ), array( 'categories' ), 'excerpt' ) ) {
				do_action( 'webbloger_action_before_post_category' );
				?>
				<div class="post_category"><?php
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
				?></div>
				<?php
				$webbloger_components = webbloger_array_delete_by_value( $webbloger_components, 'categories' );
				do_action( 'webbloger_action_after_post_category' );
			}
			// Post title
			if ( apply_filters( 'webbloger_filter_show_blog_title', true, 'excerpt' ) ) {
				$post_title_tag = $webbloger_columns > 6 ? 'h6' : 'h' . $webbloger_columns;
				do_action( 'webbloger_action_before_post_title' );
				if ( empty( $webbloger_template_args['no_links'] ) ) {
					the_title( sprintf( '<'.esc_html($post_title_tag).' class="post_title entry-title'.($post_title_tag == 'h1' ? ' h1' : '').'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></'.esc_html($post_title_tag).'>' );
				} else {
					the_title( '<'.esc_html($post_title_tag).' class="post_title entry-title">', '</'.esc_html($post_title_tag).'>' );
				}
				do_action( 'webbloger_action_after_post_title' );
			}
			?>
		</div><!-- .post_header -->
		<?php
	}

	// Post content
	?><div class="post_content entry-content">
		<?php
		if ( apply_filters( 'webbloger_filter_show_blog_excerpt', empty( $webbloger_template_args['hide_excerpt'] ) && webbloger_get_theme_option( 'excerpt_length' ) > 0, 'excerpt' ) ) {
			if ( webbloger_get_theme_option( 'blog_content' ) == 'fullpost' ) {
				// Post content area
				?>
				<div class="post_content_inner">
					<?php
					do_action( 'webbloger_action_before_full_post_content' );
					the_content( '' );
					do_action( 'webbloger_action_after_full_post_content' );
					?>
				</div>
				<?php
				// Inner pages
				wp_link_pages(
					array(
						'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'webbloger' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'webbloger' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					)
				);
			} else {
				// Post content area
				webbloger_show_post_content( $webbloger_template_args, '<div class="post_content_inner">', '</div>' );
			}
		}

		// Post meta
		if ( apply_filters( 'webbloger_filter_show_blog_meta', $webbloger_show_meta, $webbloger_components, 'excerpt' ) ) {
			if ( count( $webbloger_components ) > 0 ) {
				do_action( 'webbloger_action_before_post_meta' );
				webbloger_show_post_meta(
					apply_filters(
						'webbloger_filter_post_meta_args', array(
							'components' => join( ',', $webbloger_components ),
							'seo'        => false,
							'echo'       => true,
						), 'excerpt', 1
					)
				);
				do_action( 'webbloger_action_after_post_meta' );
			}
		}

		// More button
		if ( apply_filters( 'webbloger_filter_show_blog_readmore', true, 'excerpt' ) ) {
			if ( empty( $webbloger_template_args['no_links'] ) ) {
				do_action( 'webbloger_action_before_post_readmore' );
				if ( webbloger_get_theme_option( 'blog_content' ) != 'fullpost' ) {
					webbloger_show_post_more_link( $webbloger_template_args, '<p>', '</p>' );
				} else {
					webbloger_show_post_comments_link( $webbloger_template_args, '<p>', '</p>' );
				}
				do_action( 'webbloger_action_after_post_readmore' );
			}
		}
		?>
	</div><!-- .entry-content -->
</article>
<?php

if ( is_array( $webbloger_template_args ) ) {
	if ( ! empty( $webbloger_template_args['slider'] ) || $webbloger_columns > 1 ) {
		?>
		</div>
		<?php
	}
}
