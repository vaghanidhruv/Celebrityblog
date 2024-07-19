<?php
/**
 * The template to display Admin notices
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.1
 */

$webbloger_theme_slug = get_option( 'template' );
$webbloger_theme_obj  = wp_get_theme( $webbloger_theme_slug );
?>
<div class="webbloger_admin_notice webbloger_welcome_notice notice notice-info is-dismissible" data-notice="admin">
	<?php
	// Theme image
	$webbloger_theme_img = webbloger_get_file_url( 'screenshot.jpg' );
	if ( '' != $webbloger_theme_img ) {
		?>
		<div class="webbloger_notice_image"><img src="<?php echo esc_url( $webbloger_theme_img ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'webbloger' ); ?>"></div>
		<?php
	}

	// Title
	?>
	<h3 class="webbloger_notice_title">
		<?php
		echo esc_html(
			sprintf(
				// Translators: Add theme name and version to the 'Welcome' message
				__( 'Welcome to %1$s v.%2$s', 'webbloger' ),
				$webbloger_theme_obj->get( 'Name' ) . ( WEBBLOGER_THEME_FREE ? ' ' . __( 'Free', 'webbloger' ) : '' ),
				$webbloger_theme_obj->get( 'Version' )
			)
		);
		?>
	</h3>
	<?php

	// Description
	?>
	<div class="webbloger_notice_text">
		<p class="webbloger_notice_text_description">
			<?php
			echo str_replace( '. ', '.<br>', wp_kses_data( $webbloger_theme_obj->description ) );
			?>
		</p>
		<p class="webbloger_notice_text_info">
			<?php
			echo wp_kses_data( __( 'Attention! Plugin "ThemeREX Addons" is required! Please, install and activate it!', 'webbloger' ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="webbloger_notice_buttons">
		<?php
		// Link to the page 'About Theme'
		?>
		<a href="<?php echo esc_url( admin_url() . 'themes.php?page=webbloger_about' ); ?>" class="button button-primary"><i class="dashicons dashicons-nametag"></i> 
			<?php
			echo esc_html__( 'Install plugin "ThemeREX Addons"', 'webbloger' );
			?>
		</a>
	</div>
</div>
