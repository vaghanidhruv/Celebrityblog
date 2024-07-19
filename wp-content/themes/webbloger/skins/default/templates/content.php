<?php
/**
 * The default template to display the content of the single post or attachment
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */
?>
<article id="post-<?php the_ID(); ?>"
	<?php
	post_class( 'post_item_single'
		. ' post_type_' . esc_attr( get_post_type() ) 
		. ' post_format_' . esc_attr( str_replace( 'post-format-', '', get_post_format() ) )
	);
	webbloger_add_seo_itemprops();
	?>
>
<?php

	do_action( 'webbloger_action_before_post_data' );
	webbloger_add_seo_snippets();
	do_action( 'webbloger_action_after_post_data' );

	do_action( 'webbloger_action_before_post_content' );

	// Post content
	$webbloger_content_single = webbloger_get_theme_option( 'expand_content' );
	$webbloger_sidebar_position = webbloger_get_theme_option( 'sidebar_position' );
	$webbloger_vertical_content = ( 'narrow' == $webbloger_content_single && 'hide' == $webbloger_sidebar_position ? webbloger_get_theme_option( 'post_vertical_content' ) : '');
	$webbloger_share_position = webbloger_array_get_keys_by_value( webbloger_get_theme_option( 'share_position' ) );
	?>
	<div class="post_content post_content_single entry-content<?php
		if ( in_array( 'left', $webbloger_share_position ) ) {
			echo ' post_info_vertical_present' . ( in_array( 'top', $webbloger_share_position ) ? ' post_info_vertical_hide_on_mobile' : '' );
		}
	?>" itemprop="mainEntityOfPage">
		<?php
		if ( in_array( 'left', $webbloger_share_position ) || !empty($webbloger_vertical_content) ) {
			?><div class="post_info_vertical"><?php
				if ( in_array( 'left', $webbloger_share_position ) && webbloger_exists_trx_addons() ) {
					?><div class="post_info_vertical_share"><?php
						echo '<h5 class="post_share_label">' . esc_html__('Share This Article', 'webbloger') . '</h5>';	
						webbloger_show_post_meta(
							apply_filters(
								'webbloger_filter_post_meta_args',
								array(
									'components'      => 'share',
									'class'           => 'post_share_horizontal',
									'share_type'      => 'block',
									'share_direction' => 'horizontal',
								),
								'single',
								1
							)
						); ?>
					</div><?php
				}
				if ( !empty($webbloger_vertical_content) ) {
					?><div class="post_info_vertical_content"><?php
						webbloger_show_layout($webbloger_vertical_content);
					?></div><?php
				}
			?></div><?php
		}
		the_content();
		?>
	</div><!-- .entry-content -->
	<?php

	do_action( 'webbloger_action_after_post_content' );
	
	// Post footer: Tags, likes, share, author, prev/next links and comments
	do_action( 'webbloger_action_before_post_footer' );
	?>
	<div class="post_footer post_footer_single entry-footer">
		<?php
		webbloger_show_post_pagination();
		if ( is_single() && ! is_attachment() ) {
			webbloger_show_post_footer();
		}
		?>
	</div>
	<?php
	do_action( 'webbloger_action_after_post_footer' );
	?>
</article>
