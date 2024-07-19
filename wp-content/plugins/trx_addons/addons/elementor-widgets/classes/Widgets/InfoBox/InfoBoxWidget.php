<?php
/**
 * Info Box Widget
 *
 * @package ThemeREX Addons
 * @since v2.30.0
 */

namespace TrxAddons\ElementorWidgets\Widgets\InfoBox;

use TrxAddons\ElementorWidgets\BaseWidget;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Info Box Widget
 */
class InfoBoxWidget extends BaseWidget {

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls() {
		/* Content Tab */
		$this->register_content_icon_controls();
		$this->register_content_content_controls();
		$this->register_content_link_controls();
		$this->register_content_help_docs_controls();

		/* Style Tab */
		$this->register_style_info_box_controls();
		$this->register_style_icon_controls();
		$this->register_style_content_controls();
		$this->register_style_button_controls();
	}

	/**
	 * Register Icon Controls in Content tab
	 *
	 * @return void
	 */
	protected function register_content_icon_controls() {
		/**
		 * Content Tab: Icon
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_icon',
			array(
				'label' => __( 'Icon', 'trx_addons' ),
			)
		);

		$this->add_control(
			'icon_type',
			array(
				'label'       => esc_html__( 'Type', 'trx_addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'none'  => array(
						'title' => esc_html__( 'None', 'trx_addons' ),
						'icon'  => 'eicon-ban',
					),
					'icon'  => array(
						'title' => esc_html__( 'Icon', 'trx_addons' ),
						'icon'  => 'eicon-star',
					),
					'image' => array(
						'title' => esc_html__( 'Image', 'trx_addons' ),
						'icon'  => 'eicon-image-bold',
					),
					'text'  => array(
						'title' => esc_html__( 'Text', 'trx_addons' ),
						'icon'  => 'eicon-font',
					),
				),
				'default'     => 'icon',
			)
		);

		$this->add_control(
			'selected_icon',
			array(
				'label'            => __( 'Icon', 'trx_addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				),
				'condition'        => array(
					'icon_type' => 'icon',
				),
			)
		);

		$this->add_control(
			'icon_text',
			array(
				'label'     => __( 'Icon Text', 'trx_addons' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => '1',
				'condition' => array(
					'icon_type' => 'text',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'trx_addons' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default'   => 'full',
				'separator' => 'none',
				'condition' => array(
					'icon_type' => 'image',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'      => __( 'Size', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 30,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 5,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em', 'rem' ),
				'condition'  => array(
					'icon_type' => 'icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'icon_rotation',
			array(
				'label'      => __( 'Rotate', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 360,
						'step' => 1,
					),
				),
				'size_units' => '',
				'condition'  => array(
					'icon_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-icon' => 'transform: rotate( {{SIZE}}deg );',
				),
			)
		);

		$this->add_responsive_control(
			'icon_img_width',
			array(
				'label'      => __( 'Width', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => '',
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 25,
						'max'  => 600,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 25,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em', 'rem', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}.trx-addons-info-box-top .trx-addons-info-box-icon img, {{WRAPPER}}.trx-addons-info-box-left .trx-addons-info-box-icon-wrap, {{WRAPPER}}.trx-addons-info-box-right .trx-addons-info-box-icon-wrap' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'icon_type' => 'image',
				),
			)
		);

		$this->add_responsive_control(
			'icon_position',
			array(
				'label'              => __( 'Icon Position', 'trx_addons' ),
				'type'               => Controls_Manager::CHOOSE,
				'default'            => 'top',
				'options'            => array(
					'left'  => array(
						'title' => __( 'Icon on Left', 'trx_addons' ),
						'icon'  => 'eicon-h-align-left',
					),
					'top'   => array(
						'title' => __( 'Icon on Top', 'trx_addons' ),
						'icon'  => 'eicon-v-align-top',
					),
					'right' => array(
						'title' => __( 'Icon on Right', 'trx_addons' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'condition'          => array(
					'icon_type!' => 'none',
				),
				'prefix_class'       => 'trx-addons-info-box%s-',
				'frontend_available' => true,
			)
		);

		$this->add_responsive_control(
			'icon_vertical_position',
			array(
				'label'                => __( 'Vertical Align', 'trx_addons' ),
				'description'          => __( 'Works in case of left and right icon position', 'trx_addons' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => 'top',
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'trx_addons' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'trx_addons' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'trx_addons' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors'            => array(
					'(desktop){{WRAPPER}}.trx-addons-info-box-left .trx-addons-info-box'        => 'align-items: {{VALUE}};',
					'(desktop){{WRAPPER}}.trx-addons-info-box-right .trx-addons-info-box'       => 'align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.trx-addons-info-box-tablet-left .trx-addons-info-box'  => 'align-items: {{VALUE}};',
					'(tablet){{WRAPPER}}.trx-addons-info-box-tablet-right .trx-addons-info-box' => 'align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.trx-addons-info-box-mobile-left .trx-addons-info-box'  => 'align-items: {{VALUE}};',
					'(mobile){{WRAPPER}}.trx-addons-info-box-mobile-right .trx-addons-info-box' => 'align-items: {{VALUE}};',
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'condition'            => array(
					'icon_type' => array( 'icon', 'image', 'text' ),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Info Box Content Controls in Content tab
	 *
	 * @return void
	 */
	protected function register_content_content_controls() {
		/**
		 * Content Tab: Content
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'trx_addons' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Title', 'trx_addons' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Title', 'trx_addons' ),
			)
		);

		$this->add_control(
			'sub_heading',
			array(
				'label'   => __( 'Subtitle', 'trx_addons' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Subtitle', 'trx_addons' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'trx_addons' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Enter info box description', 'trx_addons' ),
			)
		);

		$this->add_control(
			'divider_title_switch',
			array(
				'label'        => __( 'Title Separator', 'trx_addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'On', 'trx_addons' ),
				'label_off'    => __( 'Off', 'trx_addons' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'trx_addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => array(
					'h1'   => __( 'H1', 'trx_addons' ),
					'h2'   => __( 'H2', 'trx_addons' ),
					'h3'   => __( 'H3', 'trx_addons' ),
					'h4'   => __( 'H4', 'trx_addons' ),
					'h5'   => __( 'H5', 'trx_addons' ),
					'h6'   => __( 'H6', 'trx_addons' ),
					'div'  => __( 'div', 'trx_addons' ),
					'span' => __( 'span', 'trx_addons' ),
					'p'    => __( 'p', 'trx_addons' ),
				),
			)
		);

		$this->add_control(
			'sub_title_html_tag',
			array(
				'label'     => __( 'Subtitle HTML Tag', 'trx_addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h5',
				'options'   => array(
					'h1'   => __( 'H1', 'trx_addons' ),
					'h2'   => __( 'H2', 'trx_addons' ),
					'h3'   => __( 'H3', 'trx_addons' ),
					'h4'   => __( 'H4', 'trx_addons' ),
					'h5'   => __( 'H5', 'trx_addons' ),
					'h6'   => __( 'H6', 'trx_addons' ),
					'div'  => __( 'div', 'trx_addons' ),
					'span' => __( 'span', 'trx_addons' ),
					'p'    => __( 'p', 'trx_addons' ),
				),
				'condition' => array(
					'sub_heading!' => '',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Link Controls in Content tab
	 *
	 * @return void
	 */
	protected function register_content_link_controls() {
		/**
		 * Content Tab: Link
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_link',
			array(
				'label' => __( 'Link', 'trx_addons' ),
			)
		);

		$this->add_control(
			'link_type',
			array(
				'label'   => __( 'Link Type', 'trx_addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'   => __( 'None', 'trx_addons' ),
					'box'    => __( 'Box', 'trx_addons' ),
					'icon'   => __( 'Image/Icon', 'trx_addons' ),
					'title'  => __( 'Title', 'trx_addons' ),
					'button' => __( 'Button', 'trx_addons' ),
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'trx_addons' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array(
					'active'     => true,
					'categories' => array(
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					),
				),
				'default'     => array(
					'url' => '#',
				),
				'condition'   => array(
					'link_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'button_visible',
			array(
				'label'        => __( 'Show Button', 'trx_addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'trx_addons' ),
				'label_off'    => __( 'No', 'trx_addons' ),
				'return_value' => 'yes',
				'condition'    => array(
					'link_type' => 'box',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'      => __( 'Button', 'trx_addons' ) . ' ' . __( 'Text', 'trx_addons' ),
				'type'       => Controls_Manager::TEXT,
				'dynamic'    => array(
					'active' => true,
				),
				'default'    => __( 'Get Started', 'trx_addons' ),
				'conditions' => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'link_type',
							'operator' => '==',
							'value'    => 'button',
						),
						array(
							'relation' => 'and',
							'terms' => array(
								array(
									'name'     => 'link_type',
									'operator' => '==',
									'value'    => 'box',
								),
								array(
									'name'     => 'button_visible',
									'operator' => '==',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);

		$this->add_control(
			'select_button_icon',
			array(
				'label'            => __( 'Button', 'trx_addons' ) . ' ' . __( 'Icon', 'trx_addons' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'button_icon',
				'conditions'       => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'name'     => 'link_type',
							'operator' => '==',
							'value'    => 'button',
						),
						array(
							'relation' => 'and',
							'terms' => array(
								array(
									'name'     => 'link_type',
									'operator' => '==',
									'value'    => 'box',
								),
								array(
									'name'     => 'button_visible',
									'operator' => '==',
									'value'    => 'yes',
								),
							),
						),
					),
				),
			)
		);

		$this->add_control(
			'button_icon_position',
			array(
				'label'     => __( 'Icon Position', 'trx_addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'after',
				'options'   => array(
					'after'  => __( 'After', 'trx_addons' ),
					'before' => __( 'Before', 'trx_addons' ),
				),
				'conditions'       => array(
					'relation' => 'or',
					'terms' => array(
						array(
							'relation' => 'and',
							'terms' => array(
								array(
									'name'     => 'link_type',
									'operator' => '==',
									'value'    => 'button',
								),
								array(
									'name'     => 'select_button_icon[value]',
									'operator' => '!=',
									'value'    => '',
								),
							),
						),
						array(
							'relation' => 'and',
							'terms' => array(
								array(
									'name'     => 'link_type',
									'operator' => '==',
									'value'    => 'box',
								),
								array(
									'name'     => 'button_visible',
									'operator' => '==',
									'value'    => 'yes',
								),
								array(
									'name'     => 'select_button_icon[value]',
									'operator' => '!=',
									'value'    => '',
								),
							),
						),
					),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Info Box Controls in Style tab
	 *
	 * @return void
	 */
	protected function register_style_info_box_controls() {
		/**
		 * Style Tab: Info Box
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_info_box_style',
			array(
				'label' => __( 'Box', 'trx_addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'info_box_min_height',
			array(
				'label'      => __( 'Min Height', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 50,
						'max'  => 1000,
						'step' => 1,
					),
					'vh' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'vh' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-container' => 'min-height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'info_box_padding',
			array(
				'label'      => __( 'Padding', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_info_box_style' );

		$this->start_controls_tab(
			'tab_info_box_normal',
			array(
				'label' => __( 'Normal', 'trx_addons' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'info_box_bg',
				'label'    => __( 'Background', 'trx_addons' ),
				'types'    => array( 'none', 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .trx-addons-info-box-container',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'info_box_border',
				'label'       => __( 'Border', 'trx_addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .trx-addons-info-box-container',
			)
		);

		$this->add_control(
			'info_box_border_radius',
			array(
				'label'      => __( 'Border Radius', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'info_box_shadow',
				'selector' => '{{WRAPPER}} .trx-addons-info-box-container',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_info_box_hover',
			array(
				'label' => __( 'Hover', 'trx_addons' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'info_box_bg_hover',
				'label'    => __( 'Background', 'trx_addons' ),
				'types'    => array( 'none', 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .trx-addons-info-box-container:hover',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'info_box_border_hover',
				'label'       => __( 'Border', 'trx_addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .trx-addons-info-box-container:hover',
			)
		);

		$this->add_control(
			'info_box_border_radius_hover',
			array(
				'label'      => __( 'Border Radius', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-container:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'info_box_shadow_hover',
				'selector' => '{{WRAPPER}} .trx-addons-info-box-container:hover',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Icon Controls in Style tab
	 *
	 * @return void
	 */
	protected function register_style_icon_controls() {
		/**
		 * Style Tab: Icon
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_info_box_icon_style',
			array(
				'label'     => __( 'Icon', 'trx_addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'icon_type!' => 'none',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'icon_typography',
				'label'     => __( 'Typography', 'trx_addons' ),
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'condition' => array(
					'icon_type' => 'text',
				),
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-icon',
			)
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			array(
				'label' => __( 'Normal', 'trx_addons' ),
			)
		);

		$this->add_control(
			'icon_color_normal',
			array(
				'label'     => __( 'Icon Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .trx-addons-info-box-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'icon_type!' => 'image',
				),
			)
		);

		$this->add_control(
			'icon_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-icon' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'icon_border',
				'label'       => __( 'Border', 'trx_addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'condition'   => array(
					'icon_type!' => 'none',
				),
				'selector'    => '{{WRAPPER}} .trx-addons-info-box-icon',
			)
		);

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'condition'  => array(
					'icon_type!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-icon, {{WRAPPER}} .trx-addons-info-box-icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_margin',
			array(
				'label'       => __( 'Margin', 'trx_addons' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'selectors'   => array(
					'{{WRAPPER}} .trx-addons-info-box-icon-wrap' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_padding',
			array(
				'label'      => __( 'Padding', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			array(
				'label' => __( 'Hover', 'trx_addons' ),
			)
		);

		$this->add_control(
			'icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trx-addons-info-box-icon:hover svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'icon_type!' => 'image',
				),
			)
		);

		$this->add_control(
			'icon_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'icon_type!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-icon:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icon_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'condition' => array(
					'icon_type!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-icon:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'hover_animation_icon',
			array(
				'label' => __( 'Icon Animation', 'trx_addons' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Title Controls in Style tab
	 *
	 * @return void
	 */
	protected function register_style_content_controls() {
		/**
		 * Style Tab: Title
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_info_box_content_style',
			array(
				'label' => __( 'Content', 'trx_addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'     => __( 'Alignment', 'trx_addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'trx_addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'trx_addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'trx_addons' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'trx_addons' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-container' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'title_style_heading',
			array(
				'label'     => __( 'Title', 'trx_addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'heading!' => '',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'heading!' => '',
				),
			)
		);

		$this->add_control(
			'title_color_hover',
			array(
				'label'     => __( 'Hover Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-container:hover .trx-addons-info-box-title' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'heading!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'title_typography',
				'label'     => __( 'Typography', 'trx_addons' ),
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-title',
				'condition' => array(
					'heading!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'      => 'title_text_stroke',
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-title',
				'condition' => array(
					'heading!' => '',
				),
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'title_text_shadow',
				'label'     => __( 'Text Shadow', 'trx_addons' ),
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-title',
				'condition' => array(
					'heading!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Spacing', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'condition' => array(
					'heading!' => '',
				),
			)
		);

		$this->add_control(
			'subtitle_heading',
			array(
				'label'     => __( 'Sub Title', 'trx_addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'sub_heading!' => '',
				),
			)
		);

		$this->add_control(
			'subtitle_color',
			array(
				'label'     => __( 'Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_SECONDARY,
				],
				'default'   => '',
				'condition' => array(
					'sub_heading!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-subtitle' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'subtitle_color_hover',
			array(
				'label'     => __( 'Hover Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-container:hover .trx-addons-info-box-subtitle' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'sub_heading!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'subtitle_typography',
				'label'     => __( 'Typography', 'trx_addons' ),
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
				],
				'condition' => array(
					'sub_heading!' => '',
				),
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-subtitle',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name'      => 'subtitle_text_stroke',
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-subtitle',
				'condition' => array(
					'sub_heading!' => '',
				),
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'subtitle_text_shadow',
				'label'     => __( 'Text Shadow', 'trx_addons' ),
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-subtitle',
				'condition' => array(
					'sub_heading!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'subtitle_margin',
			array(
				'label'      => __( 'Spacing', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'condition'  => array(
					'sub_heading!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'divider_title_style_heading',
			array(
				'label'     => __( 'Title Separator', 'trx_addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'divider_title_switch' => 'yes',
				),
			)
		);

		$this->add_control(
			'divider_title_border_type',
			array(
				'label'     => __( 'Border Type', 'trx_addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => __( 'None', 'trx_addons' ),
					'solid'  => __( 'Solid', 'trx_addons' ),
					'double' => __( 'Double', 'trx_addons' ),
					'dotted' => __( 'Dotted', 'trx_addons' ),
					'dashed' => __( 'Dashed', 'trx_addons' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-divider' => 'border-bottom-style: {{VALUE}}',
				),
				'condition' => array(
					'divider_title_switch' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_width',
			array(
				'label'      => __( 'Border Width', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 30,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 1000,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-divider' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'divider_title_switch' => 'yes',
					'divider_title_border_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_border_height',
			array(
				'label'      => __( 'Border Height', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 2,
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 20,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-divider' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'divider_title_switch' => 'yes',
					'divider_title_border_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'divider_title_border_color',
			array(
				'label'     => __( 'Border Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-divider' => 'border-bottom-color: {{VALUE}}',
				),
				'condition' => array(
					'divider_title_switch' => 'yes',
					'divider_title_border_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_align',
			array(
				'label'     => __( 'Alignment', 'trx_addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Left', 'trx_addons' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => __( 'Center', 'trx_addons' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => __( 'Right', 'trx_addons' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-divider-wrap'   => 'display: flex; justify-content: {{VALUE}};',
				),
				'condition' => array(
					'divider_title_switch' => 'yes',
					'divider_title_border_type!' => 'none',
				),
			)
		);

		$this->add_responsive_control(
			'divider_title_margin',
			array(
				'label'      => __( 'Spacing', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-divider-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'divider_title_switch' => 'yes',
					'divider_title_border_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'description_style_heading',
			array(
				'label'     => __( 'Description', 'trx_addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-description' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_control(
			'description_color_hover',
			array(
				'label'     => __( 'Hover Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-container:hover .trx-addons-info-box-description' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => __( 'Typography', 'trx_addons' ),
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-description',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'description_text_shadow',
				'label'     => __( 'Text Shadow', 'trx_addons' ),
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-description',
				'condition' => array(
					'description!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Spacing', 'trx_addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 20,
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
					'%'  => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'description!' => '',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Button Controls in Style tab
	 *
	 * @return void
	 */
	protected function register_style_button_controls() {
		/**
		 * Style Tab: Button
		 * -------------------------------------------------
		 */
		$this->start_controls_section(
			'section_info_box_button_style',
			array(
				'label'     => __( 'Button', 'trx_addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => __( 'Normal', 'trx_addons' ),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-button' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trx-addons-info-box-button .trx-addons-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_bg_color_normal',
			array(
				'label'     => __( 'Background Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_ACCENT,
				],
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-button' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'button_border_normal',
				'label'       => __( 'Border', 'trx_addons' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .trx-addons-info-box-button',
				'condition'   => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'label'     => __( 'Typography', 'trx_addons' ),
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-button',
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'trx_addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .trx-addons-info-box-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_box_shadow',
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-button',
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'info_box_button_icon_heading',
			array(
				'label'     => __( 'Button Icon', 'trx_addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'link_type'                  => 'button',
					'select_button_icon[value]!' => '',
				),
			)
		);

		$this->add_responsive_control(
			'button_icon_margin',
			array(
				'label'       => __( 'Margin', 'trx_addons' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'placeholder' => array(
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
				),
				'condition'   => array(
					'link_type'                  => 'button',
					'select_button_icon[value]!' => '',
				),
				'selectors'   => array(
					'{{WRAPPER}} .trx-addons-info-box .trx-addons-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => __( 'Hover', 'trx_addons' ),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-button:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .trx-addons-info-box-button:hover .trx-addons-icon svg' => 'fill: {{VALUE}}',
				),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-button:hover' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'trx_addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .trx-addons-info-box-button:hover' => 'border-color: {{VALUE}}',
				),
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_animation',
			array(
				'label'     => __( 'Animation', 'trx_addons' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_box_shadow_hover',
				'selector'  => '{{WRAPPER}} .trx-addons-info-box-button:hover',
				'condition' => array(
					'link_type' => 'button',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render info box icon output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render_infobox_icon() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'icon_text', 'none' );
		$this->add_render_attribute( 'icon_text', 'class', 'trx-addons-icon-text' );

		$this->add_render_attribute( 'icon', 'class', array( 'trx-addons-info-box-icon', 'trx-addons-icon' ) );

		if ( $settings['hover_animation_icon'] ) {
			$this->add_render_attribute( 'icon', 'class', 'elementor-animation-' . $settings['hover_animation_icon'] );
		}

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default.
			$settings['icon'] = 'fa fa-star';
		}

		$has_icon = ! empty( $settings['icon'] );

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new   = ! isset( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
		?>
		<span <?php $this->print_render_attribute_string( 'icon' ); ?>>
			<?php if ( 'icon' === $settings['icon_type'] && $has_icon ) { ?>
				<?php
				if ( $is_new || $migrated ) {
					Icons_Manager::render_icon( $settings['selected_icon'], array( 'aria-hidden' => 'true' ) );
				} else if ( ! empty( $settings['icon'] ) ) {
					?>
					<i <?php $this->print_render_attribute_string( 'i' ); ?>></i>
					<?php
				}
				?>
				<?php
			} else if ( 'image' === $settings['icon_type'] ) {

				if ( ! empty( $settings['image']['url'] ) ) {
					echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'image', 'image' ) );
				}
			} else if ( 'text' === $settings['icon_type'] ) {
				?>
				<span class="trx-addons-icon-text">
					<?php echo wp_kses_post( $settings['icon_text'] ); ?>
				</span>
			<?php } ?>
		</span>
		<?php
	}

	/**
	 * Render info box button output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render_infobox_button() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'button_text', 'none' );
		$this->add_render_attribute( 'button_text', 'class', 'trx-addons-button-text' );

		$this->add_render_attribute(
			'info-box-button',
			'class',
			array(
				'trx-addons-info-box-button',
				'elementor-button',
			)
		);

		if ( 'button' === $settings['link_type'] ) {
			$button_html_tag = ( 'button' === $settings['link_type'] ) ? 'a' : 'div';
		} else if ( 'box' === $settings['link_type'] && 'yes' === $settings['button_visible'] ) {
			$button_html_tag = ( 'button' === $settings['link_type'] ) ? 'div' : 'div';
		}

		if ( $settings['button_animation'] ) {
			$this->add_render_attribute( 'info-box-button', 'class', 'elementor-animation-' . $settings['button_animation'] );
		}

		if ( ! isset( $settings['button_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default.
			$settings['button_icon'] = '';
		}

		$has_icon = ! empty( $settings['button_icon'] );

		if ( $has_icon ) {
			$this->add_render_attribute( 'button-icon', 'class', $settings['button_icon'] );
			$this->add_render_attribute( 'button-icon', 'aria-hidden', 'true' );
		}

		if ( ! $has_icon && ! empty( $settings['select_button_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['select_button_icon'] );
		$is_new   = ! isset( $settings['button_icon'] ) && Icons_Manager::is_migration_allowed();

		if ( 'button' === $settings['link_type'] || ( 'box' === $settings['link_type'] && 'yes' === $settings['button_visible'] ) ) {
			?>
			<?php if ( '' !== $settings['button_text'] || $has_icon ) { ?>
				<div class="trx-addons-info-box-footer">
					<<?php echo $button_html_tag; ?> <?php $this->print_render_attribute_string( 'info-box-button' ) ?>>
						<?php if ( 'before' === $settings['button_icon_position'] && $has_icon ) { ?>
							<span class='trx-addons-button-icon trx-addons-icon'>
								<?php
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $settings['select_button_icon'], array( 'aria-hidden' => 'true' ) );
								} else if ( ! empty( $settings['button_icon'] ) ) {
									?>
									<i <?php $this->print_render_attribute_string( 'button-icon' ); ?>></i>
									<?php
								}
								?>
							</span>
						<?php } ?>
						<?php if ( ! empty( $settings['button_text'] ) ) { ?>
							<span <?php $this->print_render_attribute_string( 'button_text' ); ?>>
								<?php echo wp_kses_post( $settings['button_text'] ); ?>
							</span>
						<?php } ?>
						<?php if ( 'after' === $settings['button_icon_position'] && $has_icon ) { ?>
							<span class='trx-addons-button-icon trx-addons-icon'>
								<?php
								if ( $is_new || $migrated ) {
									Icons_Manager::render_icon( $settings['select_button_icon'], array( 'aria-hidden' => 'true' ) );
								} else if ( ! empty( $settings['button_icon'] ) ) {
									?>
									<i <?php $this->print_render_attribute_string( 'button-icon' ); ?>></i>
									<?php
								}
								?>
							</span>
						<?php } ?>
					</<?php echo $button_html_tag; ?>>
				</div>
			<?php } ?>
			<?php
		}
	}

	/**
	 * Render info box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute(
			array(
				'info-box'           => array(
					'class' => 'trx-addons-info-box',
				),
				'info-box-container' => array(
					'class' => 'trx-addons-info-box-container',
				),
				'title-container'    => array(
					'class' => 'trx-addons-info-box-title-container',
				),
				'heading'            => array(
					'class' => 'trx-addons-info-box-title',
				),
				'sub_heading'        => array(
					'class' => 'trx-addons-info-box-subtitle',
				),
				'description'        => array(
					'class' => 'trx-addons-info-box-description',
				),
			)
		);

		$if_html_tag = 'div';
		$title_container_tag = 'div';

		$this->add_inline_editing_attributes( 'heading', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'description', 'basic' );

		if ( 'none' !== $settings['link_type'] ) {
			if ( ! empty( $settings['link']['url'] ) ) {
				if ( 'box' === $settings['link_type'] ) {
					$if_html_tag = 'a';
					$this->add_link_attributes( 'info-box-container', $settings['link'] );
				} else if ( 'icon' === $settings['link_type'] ) {
					$this->add_link_attributes( 'link', $settings['link'] );
				} else if ( 'title' === $settings['link_type'] ) {
					$title_container_tag = 'a';
					$this->add_link_attributes( 'title-container', $settings['link'] );
				} else if ( 'button' === $settings['link_type'] ) {
					$this->add_link_attributes( 'info-box-button', $settings['link'] );
				}
			}
		}
		?>
		<<?php echo $if_html_tag; ?> <?php $this->print_render_attribute_string( 'info-box-container' ); ?>>
			<div <?php $this->print_render_attribute_string( 'info-box' ); ?>>
				<?php if ( 'none' !== $settings['icon_type'] ) { ?>
					<div class="trx-addons-info-box-icon-wrap">
						<?php if ( 'icon' === $settings['link_type'] ) { ?>
							<a <?php $this->print_render_attribute_string( 'link' ); ?>>
						<?php } ?>
						<?php
							// Icon.
							$this->render_infobox_icon();
						?>
						<?php if ( 'icon' === $settings['link_type'] ) { ?>
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="trx-addons-info-box-content">
					<div class="trx-addons-info-box-title-wrap">
						<?php
						if ( ! empty( $settings['heading'] ) ) {
							$title_tag = $settings['title_html_tag'];
							?>
							<<?php echo $title_container_tag; ?> <?php $this->print_render_attribute_string( 'title-container' ); ?>>
								<<?php echo $title_tag; ?> <?php $this->print_render_attribute_string( 'heading' ); ?>>
									<?php echo wp_kses_post( $settings['heading'] ); ?>
								</<?php echo $title_tag; ?>>
							</<?php echo $title_container_tag; ?>>
							<?php
						}

						if ( '' !== $settings['sub_heading'] ) {
							$subtitle_tag = $settings['sub_title_html_tag'];
							?>
							<<?php echo $subtitle_tag; ?> <?php $this->print_render_attribute_string( 'sub_heading' ); ?>>
								<?php echo wp_kses_post( $settings['sub_heading'] ); ?>
							</<?php echo $subtitle_tag; ?>>
							<?php
						}
						?>
					</div>

					<?php if ( 'yes' === $settings['divider_title_switch'] ) { ?>
						<div class="trx-addons-info-box-divider-wrap">
							<div class="trx-addons-info-box-divider"></div>
						</div>
					<?php } ?>

					<?php if ( ! empty( $settings['description'] ) ) { ?>
						<div <?php $this->print_render_attribute_string( 'description' ); ?>>
							<?php echo $this->parse_text_editor( $settings['description'] ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php } ?>
					<?php
						// Button.
						$this->render_infobox_button();
					?>
				</div>
			</div>
		</<?php echo $if_html_tag; ?>>
		<?php
	}

	/**
	 * Render info box widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			var trx_addons_if_html_tag = 'div',
				trx_addons_title_html_tag = 'div',
				trx_addons_button_html_tag = 'div',
				iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' ),
				migrated = elementor.helpers.isIconMigrated( settings, 'selected_icon' ),
				buttonIconHTML = elementor.helpers.renderIcon( view, settings.select_button_icon, { 'aria-hidden': true }, 'i' , 'object' ),
				buttonMigrated = elementor.helpers.isIconMigrated( settings, 'select_button_icon' );

			if ( settings.link.url != '' ) {
				if ( settings.link_type == 'box' ) {
					var trx_addons_if_html_tag = 'a';
				}
				else if ( settings.link_type == 'title' ) {
					var trx_addons_title_html_tag = 'a';
				}
				else if ( settings.link_type == 'button' ) {
					var trx_addons_button_html_tag = 'a';
				}
			}
		#>
		<{{{trx_addons_if_html_tag}}} class="trx-addons-info-box-container" href="{{settings.link.url}}">
			<div class="trx-addons-info-box trx-addons-info-box-{{ settings.icon_position }}">
				<# if ( settings.icon_type != 'none' ) { #>
					<div class="trx-addons-info-box-icon-wrap">
						<# if ( settings.link_type == 'icon' ) { #>
							<a href="{{ _.escape( settings.link.url ) }}">
						<# } #>
						<span class="trx-addons-info-box-icon trx-addons-icon elementor-animation-{{ settings.hover_animation_icon }}">
							<# if ( settings.icon_type == 'icon' ) { #>
								<# if ( settings.icon || settings.selected_icon ) { #>
								<# if ( iconHTML && iconHTML.rendered && ( ! settings.icon || migrated ) ) { #>
								{{{ iconHTML.value }}}
								<# } else { #>
									<i class="{{ settings.icon }}" aria-hidden="true"></i>
								<# } #>
								<# } #>
							<# } else if ( settings.icon_type == 'image' ) { #>
								<#
								var image = {
									id: settings.image.id,
									url: settings.image.url,
									size: settings.image_size,
									dimension: settings.image_custom_dimension,
									model: view.getEditModel()
								};
								var image_url = elementor.imagesManager.getImageUrl( image );
								#>
								<img src="{{ _.escape( image_url ) }}" />
							<# } else if ( settings.icon_type == 'text' ) { #>
								<span class="trx-addons-icon-text elementor-inline-editing" data-elementor-setting-key="icon_text" data-elementor-inline-editing-toolbar="none">
									{{{ settings.icon_text }}}
								</span>
							<# } #>
						</span>
						<# if ( settings.link_type == 'icon' ) { #>
							</a>
						<# } #>
					</div>
				<# } #>
				<div class="trx-addons-info-box-content">
					<div class="trx-addons-info-box-title-wrap">
						<#
						var titleHTMLTag = elementor.helpers.validateHTMLTag( settings.title_html_tag ),
							subtitleHTMLTag = elementor.helpers.validateHTMLTag( settings.sub_title_html_tag );
						#>
						<# if ( settings.heading ) { #>
							<{{trx_addons_title_html_tag}} class="trx-addons-info-box-title-container" href="{{settings.link.url}}">
								<{{{ titleHTMLTag }}} class="trx-addons-info-box-title elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="none">
									{{{ settings.heading }}}
								</{{{ titleHTMLTag }}}>
							</{{trx_addons_title_html_tag}}>
						<# } #>
						<# if ( settings.sub_heading ) { #>
							<{{{ subtitleHTMLTag }}} class="trx-addons-info-box-subtitle elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="none">
								{{{ settings.sub_heading }}}
							</{{{ subtitleHTMLTag }}}>
						<# } #>
					</div>

					<# if ( settings.divider_title_switch == 'yes' ) { #>
						<div class="trx-addons-info-box-divider-wrap">
							<div class="trx-addons-info-box-divider"></div>
						</div>
					<# } #>

					<# if ( settings.description ) { #>
						<div class="trx-addons-info-box-description elementor-inline-editing" data-elementor-setting-key="description" data-elementor-inline-editing-toolbar="basic">
							{{{ settings.description }}}
						</div>
					<# } #>
					<# if ( settings.link_type == 'button' || ( settings.link_type == 'box' && settings.button_visible == 'yes' ) ) { #>
						<# if ( settings.button_text != '' || settings.button_icon != '' ) { #>
							<div class="trx-addons-info-box-footer">
								<{{trx_addons_button_html_tag}} href="{{ settings.link.url }}" class="trx-addons-info-box-button elementor-button elementor-animation-{{ settings.button_animation }}">
									<# if ( settings.button_icon_position == 'before' ) { #>
										<# if ( settings.button_icon || settings.select_button_icon.value ) { #>
											<span class="trx-addons-button-icon trx-addons-icon">
												<# if ( buttonIconHTML && buttonIconHTML.rendered && ( ! settings.button_icon || buttonMigrated ) ) { #>
												{{{ buttonIconHTML.value }}}
												<# } else { #>
													<i class="{{ settings.button_icon }}" aria-hidden="true"></i>
												<# } #>
											</span>
										<# } #>
									<# } #>
									<# if ( settings.button_text ) { #>
										<span class="trx-addons-button-text elementor-inline-editing" data-elementor-setting-key="button_text" data-elementor-inline-editing-toolbar="none">
											{{{ settings.button_text }}}
										</span>
									<# } #>
									<# if ( settings.button_icon_position == 'after' ) { #>
										<# if ( settings.button_icon || settings.select_button_icon.value ) { #>
											<span class="trx-addons-button-icon trx-addons-icon">
												<# if ( buttonIconHTML && buttonIconHTML.rendered && ( ! settings.button_icon || buttonMigrated ) ) { #>
													{{{ buttonIconHTML.value }}}
												<# } else { #>
													<i class="{{ settings.button_icon }}" aria-hidden="true"></i>
												<# } #>
											</span>
										<# } #>
									<# } #>
								</{{trx_addons_button_html_tag}}>
							</div>
						<# } #>
					<# } #>
				</div>
			</div>
		</{{{trx_addons_if_html_tag}}}>
		<?php
	}
}
