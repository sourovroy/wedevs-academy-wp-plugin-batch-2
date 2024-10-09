<?php

class weDevs_Academy_WP_Plugin_License {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );

		add_action( 'init', array( $this, 'plugin_updater' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'License',
			'License',
			'manage_options',
			'academy_wp_plugin_license',
			array( $this, 'academy_wp_plugin_license' )
		);
	}

	public function academy_wp_plugin_license() {
		if ( isset( $_POST['license_key'] ) ) {
			// Send API request.
			$license_key = sanitize_text_field( wp_unslash( $_POST['license_key'] ) );

			$url = 'http://sourov-training.site/?edd_action=activate_license&item_id=138&license=' . $license_key . '&url=' . home_url();

			$response = wp_remote_get( $url );

			$response_data = json_decode( $response['body'] );

			if ( $response_data && $response_data->success ) {
				// Save the license.

				update_option( 'my_plugin_license_key', $license_key );
			}
		}

		include __DIR__ . '/templates/license.php';
	}

	public function plugin_updater() {

		require_once WEDEVS_ACADEMY_PATH . 'lib/EDD_SL_Plugin_Updater.php';

		// To support auto-updates, this needs to run during the wp_version_check cron job for privileged users.
		$doing_cron = defined( 'DOING_CRON' ) && DOING_CRON;
		if ( ! current_user_can( 'manage_options' ) && ! $doing_cron ) {
			return;
		}

		// retrieve our license key from the DB
		$license_key = get_option( 'my_plugin_license_key', '' );

		// setup the updater
		$edd_updater = new EDD_SL_Plugin_Updater(
			'http://sourov-training.site',
			WEDEVS_ACADEMY__FILE__,
			array(
				'version' => WEDEVS_ACADEMY_VERSION,                    // current version number
				'license' => $license_key,             // license key (used get_option above to retrieve from DB)
				'item_id' => 138,       // ID of the product
				'author'  => 'Sourov', // author of this plugin
				'beta'    => false,
			)
		);

		// print_r($edd_updater->slug);
	}
}
