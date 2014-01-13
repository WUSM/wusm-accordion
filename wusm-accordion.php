<?php
/*
Plugin Name: WUSM accordion
Plugin URI: 
Description: Add accordions to WUSM sites
Author: Aaron Graham
Version: 0.1
Author URI: 
*/

add_action( 'init', 'github_plugin_updater_test_init' );
function github_plugin_updater_test_init() {

        include_once 'updater.php';

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
	private $accordion_text;

	/**
	 *
	 */
	public function __construct() {
		add_filter( 'mce_buttons_2', array( $this, 'my_mce_buttons_2' ) );
		add_filter('tiny_mce_before_init', array( $this, 'aah_customize_mce' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'accordion_shortcode_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'accordion_shortcode_admin_styles' ) );
	}

	// add style selector drop down 
	function my_mce_buttons_2( $buttons ) {
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	// customize the MCE editor
	function aah_customize_mce( $init ) {
		/* Only include these tags */
		$init['theme_advanced_blockformats'] = 'h2,h3,h4,p';
		/* Remove these buttons */
		/*$init['theme_advanced_disable'] = 'forecolor, underline, justifyfull, indent, outdent';*/

		/* Set up your custom style classes */
		$style_formats = array(
			/*array(
				'title' => 'Intro Paragraph',
				'selector' => 'p',
				'classes' => 'lead'
			),*/
			array(
				'title'    => 'Accordion header',
				'selector' => '*',
				'classes'  => 'question'
			),
			array(
				'title'   => 'Accordion body text',
				'block'   => 'div',
				'classes' => 'answer',
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