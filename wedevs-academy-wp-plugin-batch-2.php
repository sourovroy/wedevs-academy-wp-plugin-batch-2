<?php
/**
 * Plugin Name: weDevs Academy WP Plugin Batch 2
 * Description: This is the plugin for learning purpose.
*/

class weDevs_Academy_WP_Plugin {

	private static $instance;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->require_classes();
	}

	private function require_classes() {
		require_once __DIR__ . '/includes/admin-menu.php';
		require_once __DIR__ . '/includes/post-column.php';
		require_once __DIR__ . '/includes/post-type.php';
		require_once __DIR__ . '/lib/CMB2/init.php';

		// new weDevs_Academy_WP_Plugin_Admin_Menu();
		// new weDevs_Academy_WP_Plugin_Post_column();
		new weDevs_Academy_WP_Plugin_Post_Type();
	}
}

weDevs_Academy_WP_Plugin::get_instance();
