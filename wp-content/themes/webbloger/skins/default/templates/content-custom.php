<?php
/**
 * The custom template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.50
 */

$webbloger_template_args = get_query_var( 'webbloger_template_args' );
if ( is_array( $webbloger_template_args ) ) {
	$webbloger_columns       = empty( $webbloger_template_args['columns'] ) ? 2 : max( 1, $webbloger_template_args['columns'] );
	$webbloger_blog_style    = array( $webbloger_template_args['type'], $webbloger_columns );
	$webbloger_columns_class = webbloger_get_column_class( 1, $webbloger_columns, ! empty( $webbloger_template_args['columns_tablet']) ? $webbloger_template_args['columns_tablet'] : '', ! empty($webbloger_template_args['columns_mobile']) ? $webbloger_template_args['columns_mobile'] : '' );
} else {
	$webbloger_template_args = array();
	$webbloger_blog_style    = explode( '_', webbloger_get_theme_option( 'blog_style' ) );
	$webbloger_columns       = empty( $webbloger_blog_style[1] ) ? 2 : max( 1, $webbloger_blog_style[1] );
	$webbloger_columns_class = webbloger_get_column_class( 1, $webbloger_columns );
}
$webbloger_blog_id       = webbloger_get_custom_blog_id( join( '_', $webbloger_blog_style ) );
$webbloger_blog_style[0] = str_replace( 'blog-custom-', '', $webbloger_blog_style[0] );
$webbloger_expanded      = ! webbloger_sidebar_present() && webbloger_get_theme_option( 'expand_content' ) == 'expand';
$webbloger_components    = ! empty( $webbloger_template_args['meta_parts'] )
							? ( is_array( $webbloger_template_args['meta_parts'] )
								? join( ',', $webbloger_template_args['meta_parts'] )
								: $webbloger_template_args['meta_parts']
								)
							: webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'meta_parts' ) );
$webbloger_post_format   = get_post_format();
$webbloger_post_format   = empty( $webbloger_post_format ) ? 'standard' : str_replace( 'post-format-', '', $webbloger_post_format );

$webbloger_blog_meta     = webbloger_get_custom_layout_meta( $webbloger_blog_id );
$webbloger_custom_style  = ! empty( $webbloger_blog_meta['scripts_required'] ) ? $webbloger_blog_meta['scripts_required'] : 'none';

if ( ! empty( $webbloger_template_args['slider'] ) || $webbloger_columns > 1 || ! webbloger_is_off( $webbloger_custom_style ) ) {
	?><div class="<?php
		if ( ! empty( $webbloger_template_args['slider'] ) ) {
			echo 'slider-slide swiper-slide';
		} else {
			echo esc_attr( webbloger_is_off( $webbloger_custom_style )
							? $webbloger_columns_class
							: sprintf( '%1$s_item %1$s_item-1_%2$d', $webbloger_custom_style, $webbloger_columns )
							);
		}
	?>">
	<?php
}
?>
<article id="post-<?php the_ID(); ?>" data-post-id="<?php the_ID(); ?>"
	<?php
	post_class(
			'post_item post_item_container post_format_' . esc_attr( $webbloger_post_format )
					. ' post_layout_custom post_layout_custom_' . esc_attr( $webbloger_columns )
					. ' post_layout_' . esc_attr( $webbloger_blog_style[0] )
					. ' post_layout_' . esc_attr( $webbloger_blog_style[0] ) . '_' . esc_attr( $webbloger_columns )
					. ( ! webbloger_is_off( $webbloger_custom_style )
						? ' post_layout_' . esc_attr( $webbloger_custom_style )
							. ' post_layout_' . esc_attr( $webbloger_custom_style ) . '_' . esc_attr( $webbloger_columns )
						: ''
						)
		);
	webbloger_add_blog_animation( $webbloger_template_args );
	?>
>
	<?php
	// Sticky label
	if ( is_sticky() && ! is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}
	// Custom layout
	do_action( 'webbloger_action_show_layout', $webbloger_blog_id, get_the_ID() );
	?>
</article><?php
if ( ! empty( $webbloger_template_args['slider'] ) || $webbloger_columns > 1 || ! webbloger_is_off( $webbloger_custom_style ) ) {
	?></div><?php
	// Need opening PHP-tag above just after </div>, because <div> is a inline-block element (used as column)!
}
