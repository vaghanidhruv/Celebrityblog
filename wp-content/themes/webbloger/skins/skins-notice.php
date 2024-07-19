<?php
/**
 * The template to display Admin notices
 *
 * @package WEBBLOGER
 * @since WEBBLOGER 1.0.64
 */

$webbloger_skins_url  = get_admin_url( null, 'admin.php?page=trx_addons_theme_panel#trx_addons_theme_panel_section_skins' );
$webbloger_skins_args = get_query_var( 'webbloger_skins_notice_args' );
?>
<div class="webbloger_admin_notice webbloger_skins_notice notice notice-info is-dismissible" data-notice="skins">
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
		<?php esc_html_e( 'New skins available', 'webbloger' ); ?>
	</h3>
	<?php

	// Description
	$webbloger_total      = $webbloger_skins_args['update'];	// Store value to the separate variable to avoid warnings from ThemeCheck plugin!
	$webbloger_skins_msg  = $webbloger_total > 0
							// Translators: Add new skins number
							? '<strong>' . sprintf( _n( '%d new version', '%d new versions', $webbloger_total, 'webbloger' ), $webbloger_total ) . '</strong>'
							: '';
	$webbloger_total      = $webbloger_skins_args['free'];
	$webbloger_skins_msg .= $webbloger_total > 0
							? ( ! empty( $webbloger_skins_msg ) ? ' ' . esc_html__( 'and', 'webbloger' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d free skin', '%d free skins', $webbloger_total, 'webbloger' ), $webbloger_total ) . '</strong>'
							: '';
	$webbloger_total      = $webbloger_skins_args['pay'];
	$webbloger_skins_msg .= $webbloger_skins_args['pay'] > 0
							? ( ! empty( $webbloger_skins_msg ) ? ' ' . esc_html__( 'and', 'webbloger' ) . ' ' : '' )
								// Translators: Add new skins number
								. '<strong>' . sprintf( _n( '%d paid skin', '%d paid skins', $webbloger_total, 'webbloger' ), $webbloger_total ) . '</strong>'
							: '';
	?>
	<div class="webbloger_notice_text">
		<p>
			<?php
			// Translators: Add new skins info
			echo wp_kses_data( sprintf( __( "We are pleased to announce that %s are available for your theme", 'webbloger' ), $webbloger_skins_msg ) );
			?>
		</p>
	</div>
	<?php

	// Buttons
	?>
	<div class="webbloger_notice_buttons">
		<?php
		// Link to the theme dashboard page
		?>
		<a href="<?php echo esc_url( $webbloger_skins_url ); ?>" class="button button-primary"><i class="dashicons dashicons-update"></i> 
			<?php
			// Translators: Add theme name
			esc_html_e( 'Go to Skins manager', 'webbloger' );
			?>
		</a>
	</div>
</div>
