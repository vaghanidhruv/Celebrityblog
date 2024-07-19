<?php
/**
 * The template to display the user's avatar, bio and socials on the Author page
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.71.0
 */
?>

<div class="author_page author vcard" itemprop="author" itemscope="itemscope" itemtype="<?php echo esc_attr( webbloger_get_protocol( true ) ); ?>//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php
		$webbloger_mult = webbloger_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 410 * $webbloger_mult );
		?>
	</div><!-- .author_avatar -->

	<h4 class="author_title" itemprop="name"><span class="fn"><?php the_author(); ?></span></h4>

	<?php
	$webbloger_author_description = get_the_author_meta( 'description' );
	if ( ! empty( $webbloger_author_description ) ) {
		?>
		<div class="author_bio" itemprop="description"><?php echo wp_kses( wpautop( $webbloger_author_description ), 'webbloger_kses_content' ); ?></div>
		<?php
	}
	?>

	<div class="author_details">
		<span class="author_posts_total">
			<?php
			$webbloger_posts_total = count_user_posts( get_the_author_meta('ID'), 'post' );
			if ( $webbloger_posts_total > 0 ) {
				// Translators: Add the author's posts number to the message
				echo wp_kses( sprintf( _n( '%s article published', '%s articles published', $webbloger_posts_total, 'webbloger' ),
										'<span class="author_posts_total_value">' . number_format_i18n( $webbloger_posts_total ) . '</span>'
								 		),
							'webbloger_kses_content'
							);
			} else {
				esc_html_e( 'No posts published.', 'webbloger' );
			}
			?>
		</span><?php
			ob_start();
			do_action( 'webbloger_action_user_meta', 'author-page' );
			$webbloger_socials = ob_get_contents();
			ob_end_clean();
			webbloger_show_layout( $webbloger_socials,
				'<span class="author_socials"><span class="author_socials_caption">' . esc_html__( 'Follow:', 'webbloger' ) . '</span>',
				'</span>'
			);
		?>
	</div><!-- .author_details -->

</div><!-- .author_page -->
