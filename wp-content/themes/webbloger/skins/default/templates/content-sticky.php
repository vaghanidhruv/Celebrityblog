<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

$webbloger_columns     = max( 1, min( 3, count( get_option( 'sticky_posts' ) ) ) );
$webbloger_post_format = get_post_format();
$webbloger_post_format = empty( $webbloger_post_format ) ? 'standard' : str_replace( 'post-format-', '', $webbloger_post_format );

?><div class="column-1_<?php echo esc_attr( $webbloger_columns ); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php
	post_class( 'post_item post_layout_sticky post_format_' . esc_attr( $webbloger_post_format ) );
	webbloger_add_blog_animation( $webbloger_template_args );
	?>
>

	<?php
	if ( is_sticky() && is_home() && ! is_paged() ) {
		?>
		<span class="post_label label_sticky"></span>
		<?php
	}

	// Featured image
	webbloger_show_post_featured(
		array(
			'thumb_size' => webbloger_get_thumb_size( 1 == $webbloger_columns ? 'big' : ( 2 == $webbloger_columns ? 'med' : 'avatar' ) ),
		)
	);

	if ( ! in_array( $webbloger_post_format, array( 'link', 'aside', 'status', 'quote' ) ) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			webbloger_show_post_meta( apply_filters( 'webbloger_filter_post_meta_args', array(), 'sticky', $webbloger_columns ) );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div><?php

// div.column-1_X is a inline-block and new lines and spaces after it are forbidden
