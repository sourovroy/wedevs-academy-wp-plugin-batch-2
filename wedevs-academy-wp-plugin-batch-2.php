<?php
/**
 * Plugin Name: weDevs Academy WP Plugin Batch 2
 * Description: This is the plugin for learning purpose.
*/

class weDevs_Academy_WP_Plugin {

	private $version = '1.0';

	private static $instance;

	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		/*if ( version_compare( phpversion(), '8.3', '<' ) ) {
			$this->show_php_required_notice();

			return;
		}

		if ( version_compare( get_bloginfo('version'), '6.5', '<' ) ) {
			$this->show_wp_required_notice();

			return;
		}*/

		$this->register_constants();
		$this->require_classes();
	}

	private function require_classes() {
		require_once __DIR__ . '/includes/admin-menu.php';
		require_once __DIR__ . '/includes/security.php';
		require_once __DIR__ . '/includes/post-column.php';
		require_once __DIR__ . '/includes/post-type.php';
		require_once __DIR__ . '/includes/ajax.php';
		require_once __DIR__ . '/lib/CMB2/init.php';
		require_once __DIR__ . '/includes/settings-menu.php';
		require_once __DIR__ . '/includes/admin-notice.php';
		require_once __DIR__ . '/includes/rewrite-rules.php';
		require_once __DIR__ . '/includes/cron.php';
		require_once __DIR__ . '/includes/license.php';

		// new weDevs_Academy_WP_Plugin_Admin_Menu();
		// new weDevs_Academy_WP_Plugin_Post_column();
		// new weDevs_Academy_WP_Plugin_Post_Type();
		// new weDevs_Academy_WP_Plugin_Security();
		// new weDevs_Academy_WP_Plugin_Ajax();
		// new weDevs_Academy_WP_Plugin_Settings_Menu();
		// new weDevs_Academy_WP_Plugin_Admin_Notice();
		new weDevs_Academy_WP_Plugin_License();
	}

	private function register_constants() {
		define( 'WEDEVS_ACADEMY_VERSION', $this->version );
		define( 'WEDEVS_ACADEMY_URL', plugin_dir_url( __FILE__ ) );
		define( 'WEDEVS_ACADEMY_PATH', plugin_dir_path( __FILE__ ) );
		define( 'WEDEVS_ACADEMY__FILE__', __FILE__ );
	}

	/**
	 * Show WordPress required notice.
	 */
	private function show_wp_required_notice() {
		add_action( 'admin_notices', function() {
			?>
			<div class="notice notice-success is-dismissible">
				<p>Require WordPress version is 6.7, Please update your WordPress version in order to use our plugin.</p>
			</div>
			<?php
		} );
	}

	/**
	 * Show PHP required notice.
	 */
	private function show_php_required_notice() {
		add_action( 'admin_notices', function() {
			?>
			<div class="notice notice-success is-dismissible">
				<p>Require WordPress version is 8.4, Please update your WordPress version in order to use our plugin.</p>
			</div>
			<?php
		} );
	}
}

weDevs_Academy_WP_Plugin::get_instance();
