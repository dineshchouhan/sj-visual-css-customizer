<?php
/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'SJVccLoader' ) ) {
	
	/**
	* Responsible for setting up constants, classes and includes.
	*
	* @since 0.1
	*/
	final class SJVccLoader {
		
		/**
		 * Load the builder if it's not already loaded, otherwise
		 * show an admin notice.
		 *
		 * @since 0.1
		 * @return void
		 */ 
		static public function init() {
			if ( ! version_compare( PHP_VERSION, '5.4', '>=' ) ) {
				add_action('admin_notices',         __CLASS__ . '::php_required_admin_notice');
				add_action('network_admin_notices', __CLASS__ . '::php_required_admin_notice');
				return;
			} 
			
						
			self::define_constants();
			self::load_files();
		}

		/**
		 * Define addon constants.
		 *
		 * @since 0.1
		 * @return void
		 */ 
		static private function define_constants() {	
			define('SJ_VCC_VERSION', '0.1');
			define('SJ_VCC_FILE', trailingslashit(dirname(dirname(__FILE__))) . 'sj-visual-css-customizer.php');
			define('SJ_VCC_PLUGIN_BASE', plugin_basename( SJ_VCC_FILE ) );
			define('SJ_VCC_DIR', plugin_dir_path( SJ_VCC_FILE ) );
			define('SJ_VCC_URL', plugins_url( '/', SJ_VCC_FILE ) );
			define('SJ_VCC_FILE_ASSETS_URL', SJ_VCC_URL . 'assets/' );
		}

		/**
		 * Loads classes and includes.
		 *
		 * @since 0.1
		 * @return void
		 */ 
		static private function load_files()
		{
			/* Required Main File */
			require_once SJ_VCC_DIR . 'classes/class-sj-vcc-model.php';

			/* Includes */
		}
		/**
		 * Shows an admin notice if php version is not correct.
		 *
		 * @since 0.1
		 * @return void
		 */
		static public function php_required_admin_notice() {
			$message = esc_html__( 'SJ Visual CSS Customizer requires PHP version 5.4+, plugin is currently NOT ACTIVE.', 'sjvcc' );
			self::render_admin_notice( $message, 'error' );
		}

		/**
		 * Renders an admin notice.
		 *
		 * @since 0.1
		 * @access private
		 * @param string $message
		 * @param string $type
		 * @return void
		 */ 
		static private function render_admin_notice( $message, $type = 'update' ) {
			if ( ! is_admin() ) {
				return;
			}
			else if ( ! is_user_logged_in() ) {
				return;
			}
			else if ( ! current_user_can( 'update_core' ) ) {
				return;
			}
			
			echo '<div class="' . $type . '">';
			echo '<p>' . $message . '</p>';
			echo '</div>';
		}
	}

	SJVccLoader::init();
}

