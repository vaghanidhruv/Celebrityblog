<?php
/**
 * The template to display the Author bio
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0
 */
?>

<div class="author_info author vcard" itemprop="author" itemscope="itemscope" itemtype="<?php echo esc_attr( webbloger_get_protocol( true ) ); ?>//schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php
			$webbloger_mult = webbloger_get_retina_multiplier();
			echo get_avatar( get_the_author_meta( 'user_email' ), 120 * $webbloger_mult );
			?>
		</a>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<div class="author_label"><?php esc_html_e( 'Written by', 'webbloger' ); ?></div>
		<h6 class="author_title" itemprop="name">		
			<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><span class="fn"><?php the_author(); ?></span></a>
		</h6>
		<div class="author_bio" itemprop="description">
			<?php echo wp_kses( wpautop( get_the_author_meta( 'description' ) ), 'webbloger_kses_content' ); ?>
			<div class="author_links">
				<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
													<?php
													// Translators: Add the author's name in the <span>
													printf( esc_html__( 'View all posts by %s', 'webbloger' ), '<span class="author_name">' . esc_html( get_the_author() ) . '</span>' );
													?>
				</a>
				<?php do_action( 'webbloger_action_user_meta', 'author-bio' ); ?>
			</div>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
