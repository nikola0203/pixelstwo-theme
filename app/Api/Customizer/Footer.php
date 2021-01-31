<?php
/**
 * Theme Customizer - Footer.
 *
 * @package s1ct
 */

namespace S1ct\Api\Customizer;

use WP_Customize_Control;
use WP_Customize_Color_Control;

use S1ct\Api\Customizer;

/**
 * Customizer class
 */
class Footer
{
	/**
	 * Register default hooks and actions for WordPress.
	 *
	 * @param object $wp_customize
	 * @return
	 */
	public function register( $wp_customize ) 
	{
		$wp_customize->add_section(
			's1ct_footer_section',
			array(
				'title'       => __( 'Footer', 's1ct' ),
				'description' => __( 'Customize the Footer' ),
				'priority'    => 162
			)
		); 

		$wp_customize->add_setting(
			's1ct_footer_background_color', array(
				'default'   => '#ffffff',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload.
			)
		);

		$wp_customize->add_setting(
			's1ct_footer_copy_text', array(
				'default'   => 'Proudly powered by S1ct',
				'transport' => 'postMessage', // or refresh if you want the entire page to reload.
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				's1ct_footer_background_color',
				array(
					'label'    => __( 'Background Color', 's1ct' ),
					'section'  => 's1ct_footer_section',
					'settings' => 's1ct_footer_background_color',
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				's1ct_footer_copy_text',
				array(
					'label'    => __( 'Copyright Text', 's1ct' ),
					'section'  => 's1ct_footer_section',
					'settings' => 's1ct_footer_copy_text',
				)
			)
		);

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				's1ct_footer_background_color',
				array(
					'selector'         => '#s1ct-footer-control',
					'render_callback'  => array( $this, 'outputCss' ),
					'fallback_refresh' => true
				)
			);

			$wp_customize->selective_refresh->add_partial(
				's1ct_footer_copy_text',
				array(
					'selector'         => '#s1ct-footer-copy-control',
					'render_callback'  => array( $this, 'outputText' ),
					'fallback_refresh' => true
				)
			);
		}
	}

	/**
	 * Generate inline CSS for customizer async reload.
	 *
	 * @return CSS
	 */
	public function outputCss()
	{
		echo '<style type="text/css">';
			echo Customizer::css( '.site-footer', 'background-color', 's1ct_footer_background_color' );
		echo '</style>';
	}

	/**
	 * Generate inline text for customizer async reload.
	 *
	 * @return
	 */
	public function outputText()
	{
		echo Customizer::text( 's1ct_footer_copy_text' );
	}
}