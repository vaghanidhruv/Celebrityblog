<?php
/**
 * The template 'Style 2' to displaying related posts
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_link        = get_permalink();
$webbloger_post_format = get_post_format();
$webbloger_post_format = empty( $webbloger_post_format ) ? 'standard' : str_replace( 'post-format-', '', $webbloger_post_format );
?><div id="post-<?php the_ID(); ?>" <?php post_class( 'related_item post_format_' . esc_attr( $webbloger_post_format ) ); ?> data-post-id="<?php the_ID(); ?>">
	<?php
	webbloger_show_post_featured(
		array(
			'thumb_size'    => apply_filters( 'webbloger_filter_related_thumb_size', webbloger_get_thumb_size( (int) webbloger_get_theme_option( 'related_posts' ) == 1 ? 'huge' : 'big' ) ),
		)
	);
	?>
	<div class="post_header entry-header">
		<?php
		if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
			?>
			<div class="post_meta">
				<a href="<?php echo esc_url( $webbloger_link ); ?>" class="post_meta_item post_date"><?php echo wp_kses_data( webbloger_get_date() ); ?></a>
			</div>
			<?php
		}
		?>
		<h6 class="post_title entry-title"><a href="<?php echo esc_url( $webbloger_link ); ?>"><?php
			if ( '' == get_the_title() ) {
				esc_html_e( '- No title -', 'webbloger' );
			} else {
				the_title();
			}
		?></a></h6>
	</div>
</div>
