<?php
/**
 * The template to display single post
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */

// Full post loading
$full_post_loading          = webbloger_get_value_gp( 'action' ) == 'full_post_loading';

// Prev post loading
$prev_post_loading          = webbloger_get_value_gp( 'action' ) == 'prev_post_loading';
$prev_post_loading_type     = webbloger_get_theme_option( 'posts_navigation_scroll_which_block' );

// Position of the related posts
$webbloger_related_position   = webbloger_get_theme_option( 'related_position' );

// Type of the prev/next post navigation
$webbloger_posts_navigation   = webbloger_get_theme_option( 'posts_navigation' );
$webbloger_prev_post          = false;
$webbloger_prev_post_same_cat = webbloger_get_theme_option( 'posts_navigation_scroll_same_cat' );

// Rewrite style of the single post if current post loading via AJAX and featured image and title is not in the content
if ( ( $full_post_loading 
		|| 
		( $prev_post_loading && 'article' == $prev_post_loading_type )
	) 
	&& 
	! in_array( webbloger_get_theme_option( 'single_style' ), array( 'style-6' ) )
) {
	webbloger_storage_set_array( 'options_meta', 'single_style', 'style-6' );
}

do_action( 'webbloger_action_prev_post_loading', $prev_post_loading, $prev_post_loading_type );

get_header();

while ( have_posts() ) {

	the_post();

	// Type of the prev/next post navigation
	if ( 'scroll' == $webbloger_posts_navigation ) {
		$webbloger_prev_post = get_previous_post( $webbloger_prev_post_same_cat );  // Get post from same category
		if ( ! $webbloger_prev_post && $webbloger_prev_post_same_cat ) {
			$webbloger_prev_post = get_previous_post( false );                    // Get post from any category
		}
		if ( ! $webbloger_prev_post ) {
			$webbloger_posts_navigation = 'links';
		}
	}

	// Override some theme options to display featured image, title and post meta in the dynamic loaded posts
	if ( $full_post_loading || ( $prev_post_loading && $webbloger_prev_post ) ) {
		webbloger_sc_layouts_showed( 'featured', false );
		webbloger_sc_layouts_showed( 'title', false );
		webbloger_sc_layouts_showed( 'postmeta', false );
	}

	// If related posts should be inside the content
	if ( strpos( $webbloger_related_position, 'inside' ) === 0 ) {
		ob_start();
	}

	// Display post's content
	get_template_part( apply_filters( 'webbloger_filter_get_template_part', 'templates/content', 'single-' . webbloger_get_theme_option( 'single_style' ) ), 'single-' . webbloger_get_theme_option( 'single_style' ) );

	// If related posts should be inside the content
	if ( strpos( $webbloger_related_position, 'inside' ) === 0 ) {
		$webbloger_content = ob_get_contents();
		ob_end_clean();

		ob_start();
		do_action( 'webbloger_action_related_posts' );
		$webbloger_related_content = ob_get_contents();
		ob_end_clean();

		if ( ! empty( $webbloger_related_content ) ) {
			$webbloger_related_position_inside = max( 0, min( 9, webbloger_get_theme_option( 'related_position_inside' ) ) );
			if ( 0 == $webbloger_related_position_inside ) {
				$webbloger_related_position_inside = mt_rand( 1, 9 );
			}

			$webbloger_p_number         = 0;
			$webbloger_related_inserted = false;
			$webbloger_in_block         = false;
			$webbloger_content_start    = strpos( $webbloger_content, '<div class="post_content' );
			$webbloger_content_end      = strrpos( $webbloger_content, '</div>' );

			for ( $i = max( 0, $webbloger_content_start ); $i < min( strlen( $webbloger_content ) - 3, $webbloger_content_end ); $i++ ) {
				if ( $webbloger_content[ $i ] != '<' ) {
					continue;
				}
				if ( $webbloger_in_block ) {
					if ( strtolower( substr( $webbloger_content, $i + 1, 12 ) ) == '/blockquote>' ) {
						$webbloger_in_block = false;
						$i += 12;
					}
					continue;
				} else if ( strtolower( substr( $webbloger_content, $i + 1, 10 ) ) == 'blockquote' && in_array( $webbloger_content[ $i + 11 ], array( '>', ' ' ) ) ) {
					$webbloger_in_block = true;
					$i += 11;
					continue;
				} else if ( 'p' == $webbloger_content[ $i + 1 ] && in_array( $webbloger_content[ $i + 2 ], array( '>', ' ' ) ) ) {
					$webbloger_p_number++;
					if ( $webbloger_related_position_inside == $webbloger_p_number ) {
						$webbloger_related_inserted = true;
						$webbloger_content = ( $i > 0 ? substr( $webbloger_content, 0, $i ) : '' )
											. $webbloger_related_content
											. substr( $webbloger_content, $i );
					}
				}
			}
			if ( ! $webbloger_related_inserted ) {
				if ( $webbloger_content_end > 0 ) {
					$webbloger_content = substr( $webbloger_content, 0, $webbloger_content_end ) . $webbloger_related_content . substr( $webbloger_content, $webbloger_content_end );
				} else {
					$webbloger_content .= $webbloger_related_content;
				}
			}
		}

		webbloger_show_layout( $webbloger_content );
	}

	// Comments
	do_action( 'webbloger_action_before_comments' );
	comments_template();
	do_action( 'webbloger_action_after_comments' );

	// Related posts
	if ( 'below_content' == $webbloger_related_position
		&& ( 'scroll' != $webbloger_posts_navigation || webbloger_get_theme_option( 'posts_navigation_scroll_hide_related' ) == 0 )
		&& ( ! $full_post_loading || webbloger_get_theme_option( 'open_full_post_hide_related' ) == 0 )
	) {
		do_action( 'webbloger_action_related_posts' );
	}

	// Post navigation: type 'scroll'
	if ( 'scroll' == $webbloger_posts_navigation && ! $full_post_loading ) {
		?>
		<div class="nav-links-single-scroll"
			data-post-id="<?php echo esc_attr( get_the_ID( $webbloger_prev_post ) ); ?>"
			data-post-link="<?php echo esc_attr( get_permalink( $webbloger_prev_post ) ); ?>"
			data-post-title="<?php the_title_attribute( array( 'post' => $webbloger_prev_post ) ); ?>"
			<?php do_action( 'webbloger_action_nav_links_single_scroll_data', $webbloger_prev_post ); ?>
		></div>
		<?php
	}
}

get_footer();
