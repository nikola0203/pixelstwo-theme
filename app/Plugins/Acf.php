<?php
/**
 * ACF PRO
 *
 * @link https://github.com/elliotcondon/acf
 *
 * @package s1ct
 */

namespace S1ct\Plugins;

class Acf
{
	/**
	 * Register default hooks and actions for WordPress.
	 *
	 * @return
	 */
	public function register()
	{
		add_filter( 'acf/settings/save_json', array( &$this, 's1ct_acf_json_save_point' ) );
		add_filter( 'acf/settings/load_json', array( &$this, 's1ct_acf_json_load_point' ) );
	}

	public function s1ct_acf_json_save_point( $path )
	{
		// Update path.
		$path = get_stylesheet_directory() . '/acf-json';

		return $path;
	}

	public function s1ct_acf_json_load_point( $paths )
	{
		// Remove original path (optional).
		unset( $paths[0] );

		// Append path.
		$paths[] = get_stylesheet_directory() . '/acf-json';

		return $paths;
	}
}
