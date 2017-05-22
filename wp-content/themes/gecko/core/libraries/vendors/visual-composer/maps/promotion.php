<?php
/**
 * Add element banner for VC.
 *
 * @since   1.4.4
 * @package Gecko
 */

function jas_gecko_vc_map_promotion() {
	vc_map(
		array(
			'name'     => esc_html__( 'Promotion Banner', 'gecko' ),
			'base'     => 'jas_promotion',
			'icon'     => 'pe-7s-cash',
			'category' => esc_html__( 'Content', 'gecko' ),
			'params'   => array(
				array(
					'param_name' => 'image',
					'heading'    => esc_html__( 'Image', 'gecko' ),
					'type'       => 'attach_image'
				),
				array(
					'param_name' => 'link',
					'heading'    => esc_html__( 'Link to', 'gecko' ),
					'type'       => 'vc_link'
				),
				array(
					'param_name' => 'v_align',
					'heading'    => esc_html__( 'Text vertical align', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'Top', 'gecko' )    => 'top',
						esc_html__( 'Middle', 'gecko' ) => 'middle',
						esc_html__( 'Bottom', 'gecko' ) => 'bottom'
					)
				),
				array(
					'param_name' => 'h_align',
					'heading'    => esc_html__( 'Text horizontal align', 'gecko' ),
					'type'       => 'dropdown',
					'value'      => array(
						esc_html__( 'Left', 'gecko' )   => 'left',
						esc_html__( 'Center', 'gecko' ) => 'center',
						esc_html__( 'Right', 'gecko' )  => 'right'
					)
				),
				vc_map_add_css_animation(),
				array(
					'param_name'  => 'class',
					'heading'     => esc_html__( 'Extra class name', 'gecko' ),
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'gecko' ),
					'type' 	      => 'textfield',
				),
				array(
					'param_name' => 'text_1',
					'heading'    => esc_html__( 'Text', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Text 1', 'gecko' )
				),
				array(
					'param_name'  => 'text_1_font_size',
					'heading'     => esc_html__( 'Font size', 'gecko' ),
					'type'        => 'textfield',
					'group'       => esc_html__( 'Text 1', 'gecko' ),
					'description' => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'gecko' ),
				),
				array(
					'param_name' => 'text_1_line_height',
					'heading'    => esc_html__( 'Line height', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Text 1', 'gecko' )
				),
				array(
					'param_name' => 'text_1_color',
					'heading'    => esc_html__( 'Color', 'gecko' ),
					'type'       => 'colorpicker',
					'group'      => esc_html__( 'Text 1', 'gecko' )
				),
				array(
					'param_name'  => 'text_1_margin',
					'heading'     => esc_html__( 'Margin bottom', 'gecko' ),
					'type'        => 'textfield',
					'group'       => esc_html__( 'Text 1', 'gecko' ),
					'description' => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'gecko' ),
				),
				array(
					'param_name' => 'text_2',
					'heading'    => esc_html__( 'Text', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Text 2', 'gecko' )
				),
				array(
					'param_name'  => 'text_2_font_size',
					'heading'     => esc_html__( 'Font size', 'gecko' ),
					'type'        => 'textfield',
					'group'       => esc_html__( 'Text 2', 'gecko' ),
					'description' => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'gecko' ),
				),
				array(
					'param_name' => 'text_2_line_height',
					'heading'    => esc_html__( 'Line height', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Text 2', 'gecko' )
				),
				array(
					'param_name' => 'text_2_color',
					'heading'    => esc_html__( 'Color', 'gecko' ),
					'type'       => 'colorpicker',
					'group'      => esc_html__( 'Text 2', 'gecko' )
				),
				array(
					'param_name'  => 'text_2_margin',
					'heading'     => esc_html__( 'Margin bottom', 'gecko' ),
					'type'        => 'textfield',
					'group'       => esc_html__( 'Text 2', 'gecko' ),
					'description' => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'gecko' ),
				),
				array(
					'param_name' => 'text_3',
					'heading'    => esc_html__( 'Text', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Text 3', 'gecko' )
				),
				array(
					'param_name'  => 'text_3_font_size',
					'heading'     => esc_html__( 'Font size', 'gecko' ),
					'type'        => 'textfield',
					'group'       => esc_html__( 'Text 3', 'gecko' ),
					'description' => esc_html__( 'Defined in pixels. Do not add the \'px\' unit.', 'gecko' ),
				),
				array(
					'param_name' => 'text_3_line_height',
					'heading'    => esc_html__( 'Line height', 'gecko' ),
					'type'       => 'textfield',
					'group'      => esc_html__( 'Text 3', 'gecko' )
				),
				array(
					'param_name' => 'text_3_color',
					'heading'    => esc_html__( 'Color', 'gecko' ),
					'type'       => 'colorpicker',
					'group'      => esc_html__( 'Text 3', 'gecko' )
				),
				array(
					'param_name' => 'text_3_button',
					'heading'    => esc_html__( 'Make it as button', 'gecko' ),
					'type'       => 'checkbox',
					'group'      => esc_html__( 'Text 3', 'gecko' )
				),
			)
		)
	);
}
add_action( 'vc_before_init', 'jas_gecko_vc_map_promotion' );