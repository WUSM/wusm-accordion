<?php
/*
Plugin Name: WUSM Accordion
Plugin URI: 
Description: Add accordions to WUSM sites
Author: Aaron Graham
Version: 14.02.19.1
Author URI: http://medicine.wustl.edu/
*/

add_action( 'init', 'github_plugin_updater_wusm_accordion_init' );
function github_plugin_updater_wusm_accordion_init() {

		if( ! class_exists( 'WP_GitHub_Updater' ) )
			include_once 'updater.php';

		if( ! defined( 'WP_GITHUB_FORCE_UPDATE' ) )
			define( 'WP_GITHUB_FORCE_UPDATE', true );

		if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin

				$config = array(
						'slug' => plugin_basename( __FILE__ ),
						'proper_folder_name' => 'wusm-accordion',
						'api_url' => 'https://api.github.com/repos/coderaaron/wusm-accordion',
						'raw_url' => 'https://raw.github.com/coderaaron/wusm-accordion/master',
						'github_url' => 'https://github.com/coderaaron/wusm-accordion',
						'zip_url' => 'https://github.com/coderaaron/wusm-accordion/archive/master.zip',
						'sslverify' => true,
						'requires' => '3.0',
						'tested' => '3.8',
						'readme' => 'README.md',
						'access_token' => '',
				);

				new WP_GitHub_Updater( $config );
		}

}

class wusm_accordion_plugin {
	public function __construct() {
		add_shortcode( 'wusm_expand_all', array( $this, 'accordion_shortcode' ) );
		add_filter( 'mce_buttons_2', array( $this, 'my_mce_buttons_2' ) );
		add_filter('tiny_mce_before_init', array( $this, 'customize_mce' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'accordion_shortcode_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'accordion_shortcode_admin_styles' ) );
	}

	public function accordion_shortcode( $atts, $content = null ) {
		return "<p class='expand-all'>Expand all</p>";
	}

	// Add style selector drop down on the second row of the Visual editor
	function my_mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	// Customize the MCE editor
	function customize_mce( $init ) {
		/* Register accordion styles */
		$style_formats = array(
			array(
				'title'    => 'Accordion Header',
                'block' => 'div',
				'classes'  => 'accordion-header',
                'wrapper' => 'true'
			),
			array(
				'title'   => 'Accordion Body Text',
				'block'   => 'div',
				'classes' => 'accordion-body-text',
				'wrapper' => true
			),
		);

		/* Only include your custom styles -- defined above -- in your style dropdown */
		$init['style_formats'] = json_encode( $style_formats );
		return $init;
	}

	/**
	 * Enqueue styles.
	 *
	 * @since 0.1.0
	 */
	function accordion_shortcode_styles() {
		wp_register_style( 'accordion-styles', plugins_url('css/wusm-accordion.css', __FILE__) );
		wp_enqueue_style( 'accordion-styles' );
		wp_enqueue_script( 'accordion-script', plugins_url('js/wusm-accordion.js', __FILE__), array( 'jquery' ) );
	}

	/**
	 * Enqueue styles.
	 *
	 * @since 0.1.0
	 */
	function accordion_shortcode_admin_styles() {
		add_editor_style( plugins_url('css/wusm-accordion-admin.css', __FILE__) );
	}
}
new wusm_accordion_plugin();