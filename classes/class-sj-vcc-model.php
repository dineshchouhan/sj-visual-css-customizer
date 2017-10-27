<?php 
/**
 * If this file is called directly, abort.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'SJVccModel' ) ) {
	
	/**
	* Responsible for include modules.
	*
	* @since 0.1
	*/
	final class SJVccModel {
		/**
		 * Initialize hooks.
		 *
		 * @since 0.1 
		 * @return void
		 */
		static public function init() {
			
			
		}

	}

	SJVccModel::init();
}
