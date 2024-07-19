<?php
/**
 * The template to display the category's image, description on the Category page
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.71.0
 */
?>

<div class="category_page category"><?php
	
	$webbloger_cat = get_queried_object();
	$webbloger_cat_img = webbloger_get_term_image_small($webbloger_cat->term_id, $webbloger_cat->taxonomy);
	$webbloger_cat_icon = '';
	if ( empty($webbloger_cat_img) && function_exists('trx_addons_get_term_icon') ) {
		$webbloger_cat_icon = trx_addons_get_term_icon($webbloger_cat->term_id, $webbloger_cat->taxonomy);
		if ( empty($webbloger_cat_icon) || webbloger_is_off($webbloger_cat_icon) ) {
			$webbloger_cat_img = webbloger_get_term_image($webbloger_cat->term_id, $webbloger_cat->taxonomy);
		}
	}
	?><div class="category_image"><?php
		if ( !empty($webbloger_cat_icon) && !webbloger_is_off($webbloger_cat_icon) ) {
			?><span class="category_icon <?php echo esc_attr($webbloger_cat_icon); ?>"></span><?php
		} else {
			$src = empty($webbloger_cat_img)
						? webbloger_get_no_image() 
						: webbloger_add_thumb_size( $webbloger_cat_img, webbloger_get_thumb_size('masonry') );
			if ( $src ) {				
				$attr = webbloger_getimagesize($src);
				?><img src="<?php echo esc_url($src); ?>" <?php if (!empty($attr[3])) webbloger_show_layout($attr[3]); ?> alt="<?php esc_attr_e('Category image', 'webbloger'); ?>"><?php
			}
		}
	?></div><!-- .category_image -->

	<h4 class="category_title"><span class="fn"><?php echo esc_html($webbloger_cat->name); ?></span></h4>

	<?php
	$webbloger_cat_desc = $webbloger_cat->description;
	if ( ! empty( $webbloger_cat_desc ) ) {
		?>
		<div class="category_desc"><?php echo wp_kses( wpautop( $webbloger_cat_desc ), 'webbloger_kses_content' ); ?></div>
		<?php
	}
	?>

</div><!-- .category_page -->
