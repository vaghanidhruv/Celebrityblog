<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_template_args = get_query_var( 'webbloger_template_args' );
if ( is_array( $webbloger_template_args ) ) {
	$webbloger_columns    = empty( $webbloger_template_args['columns'] ) ? 2 : max( 1, $webbloger_template_args['columns'] );
	$webbloger_blog_style = array( $webbloger_template_args['type'], $webbloger_columns );
	$webbloger_columns_class = webbloger_get_column_class( 1, $webbloger_columns, ! empty( $webbloger_template_args['columns_tablet']) ? $webbloger_template_args['columns_tablet'] : '', ! empty($webbloger_template_args['columns_mobile']) ? $webbloger_template_args['columns_mobile'] : '' );
} else {
	$webbloger_template_args = array();
	$webbloger_blog_style = explode( '_', webbloger_get_theme_option( 'blog_style' ) );
	$webbloger_columns    = empty( $webbloger_blog_style[1] ) ? 2 : max( 1, $webbloger_blog_style[1] );
	$webbloger_columns_class = webbloger_get_column_class( 1, $webbloger_columns );
}

$webbloger_post_format = get_post_format();
$webbloger_post_format = empty( $webbloger_post_format ) ? 'standard' : str_replace( 'post-format-', '', $webbloger_post_format );

$webbloger_post_link = get_permalink();
$webbloger_post_info = '';

?><div class="<?php
if ( ! empty( $webbloger_template_args['slider'] ) ) {
	echo ' slider-slide swiper-slide';
} else {
	echo ( webbloger_is_blog_style_use_masonry( $webbloger_blog_style[0] )
			? 'masonry_item masonry_item-1_' . esc_attr( $webbloger_columns )
			: esc_attr( $webbloger_columns_class )
			);
}
?>"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class(
		'post_item post_item_container post_format_' . esc_attr( $webbloger_post_format )
		. ' post_layout_portfolio'
		. ' post_layout_portfolio_' . esc_attr( $webbloger_columns )
		. ( 'portfolio' != $webbloger_blog_style[0] ? ' ' . esc_attr( $webbloger_blog_style[0] )  . '_' . esc_attr( $webbloger_columns ) : '' )
	);
	webbloger_add_blog_animation( $webbloger_template_args );
	?>
>
<?php

	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$webbloger_hover   = ! empty( $webbloger_template_args['hover'] ) && ! webbloger_is_inherit( $webbloger_template_args['hover'] )
								? $webbloger_template_args['hover']
								: webbloger_get_theme_option( 'image_hover' );

	if ( 'dots' == $webbloger_hover ) {
		$webbloger_post_link = empty( $webbloger_template_args['no_links'] )
								? ( ! empty( $webbloger_template_args['link'] )
									? $webbloger_template_args['link']
									: get_permalink()
									)
								: '';
		$webbloger_target    = ! empty( $webbloger_post_link ) && false === strpos( $webbloger_post_link, home_url() )
								? ' target="_blank" rel="nofollow"'
								: '';
	}
	
	// Meta parts
	$webbloger_components = ! empty( $webbloger_template_args['meta_parts'] )
							? ( is_array( $webbloger_template_args['meta_parts'] )
								? $webbloger_template_args['meta_parts']
								: explode( ',', $webbloger_template_args['meta_parts'] )
								)
							: webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'meta_parts' ) );
	$webbloger_show_meta  = count( $webbloger_components ) > 0 && ! in_array( $webbloger_hover, array( 'border', 'pull', 'slide', 'fade', 'info' ) );


	ob_start();

	// Categories
	if ( apply_filters( 'webbloger_filter_show_blog_categories', $webbloger_show_meta && in_array( 'categories', $webbloger_components ), array( 'categories' ), 'portfolio' ) ) {
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
	if ( apply_filters( 'webbloger_filter_show_blog_title', true, 'portfolio' ) ) {
		do_action( 'webbloger_action_before_post_title' );
		if ( empty( $webbloger_template_args['no_links'] ) ) {
			the_title( sprintf( '<h5 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' );
		} else {
			the_title( '<h5 class="post_title entry-title">', '</h5>' );
		}
		do_action( 'webbloger_action_after_post_title' );
	}

	// Post meta
	if ( apply_filters( 'webbloger_filter_show_blog_meta', $webbloger_show_meta, $webbloger_components, 'portfolio' ) ) {
		if ( count( $webbloger_components ) > 0 ) {
			do_action( 'webbloger_action_before_post_meta' );
			webbloger_show_post_meta(
				apply_filters(
					'webbloger_filter_post_meta_args', array(
						'components' => join( ',', $webbloger_components ),
						'seo'        => false,
						'echo'       => true,
						'author_avatar'   => false,
					), $webbloger_blog_style[0], $webbloger_columns
				)
			);
			do_action( 'webbloger_action_after_post_meta' );
		}
	}

	$webbloger_post_info = ob_get_contents();
	ob_end_clean();
							
	// Featured image
	webbloger_show_post_featured( apply_filters( 'webbloger_filter_args_featured', 
		array(
			'hover'         => $webbloger_hover,
			'no_links'      => ! empty( $webbloger_template_args['no_links'] ),
			'thumb_size'    => webbloger_get_thumb_size(
									webbloger_is_blog_style_use_masonry( $webbloger_blog_style[0] )
										? (	strpos( webbloger_get_theme_option( 'body_style' ), 'full' ) !== false || $webbloger_columns < 3
											? 'masonry-big'
											: ( in_array($webbloger_post_format, array('gallery', 'audio', 'video')) ? 'med' : 'masonry')
											)
										: (	strpos( webbloger_get_theme_option( 'body_style' ), 'full' ) !== false || $webbloger_columns < 3
											? 'big'
											: 'med'
											)
								),
    		'thumb_ratio' 	=> $webbloger_post_format == 'gallery' ? '1:1' : '',
			'show_no_image' => true,
			'meta_parts'    => $webbloger_components,
			'class'         => 'dots' == $webbloger_hover ? 'hover_with_info' : '',
			'post_info'     => '<div class="post_info">' . $webbloger_post_info . '</div>',
		),
		'content-portfolio',
		$webbloger_template_args
	) );
	?>
</article></div><?php
// Need opening PHP-tag above, because <article> is a inline-block element (used as column)!