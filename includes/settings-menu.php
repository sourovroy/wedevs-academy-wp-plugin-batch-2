<?php

class weDevs_Academy_WP_Plugin_Settings_Menu {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'Academy Settings',
			'Academy Settings',
			'manage_options',
			'academy_settings',
			array( $this, 'academy_settings' ),
			'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA0NDggNTEyIj48IS0tIUZvbnQgQXdlc29tZSBGcmVlIDYuNi4wIGJ5IEBmb250YXdlc29tZSAtIGh0dHBzOi8vZm9udGF3ZXNvbWUuY29tIExpY2Vuc2UgLSBodHRwczovL2ZvbnRhd2Vzb21lLmNvbS9saWNlbnNlL2ZyZWUgQ29weXJpZ2h0IDIwMjQgRm9udGljb25zLCBJbmMuLS0+PHBhdGggZD0iTTAgOTZDMCA3OC4zIDE0LjMgNjQgMzIgNjRsMzg0IDBjMTcuNyAwIDMyIDE0LjMgMzIgMzJzLTE0LjMgMzItMzIgMzJMMzIgMTI4QzE0LjMgMTI4IDAgMTEzLjcgMCA5NnpNMCAyNTZjMC0xNy43IDE0LjMtMzIgMzItMzJsMzg0IDBjMTcuNyAwIDMyIDE0LjMgMzIgMzJzLTE0LjMgMzItMzIgMzJMMzIgMjg4Yy0xNy43IDAtMzItMTQuMy0zMi0zMnpNNDQ4IDQxNmMwIDE3LjctMTQuMyAzMi0zMiAzMkwzMiA0NDhjLTE3LjcgMC0zMi0xNC4zLTMyLTMyczE0LjMtMzIgMzItMzJsMzg0IDBjMTcuNyAwIDMyIDE0LjMgMzIgMzJ6Ii8+PC9zdmc+',
			64
		);

		add_submenu_page(
			'academy_settings',
			'QR Code Settings',
			'QR Code Settings',
			'manage_options',
			'academy_qr_code_settings',
			array( $this, 'academy_settings' )
		);
	}

	public function academy_settings() {
		echo '<div id="academy-settings-app"></div>';
	}

	public function admin_enqueue_scripts() {
		$main_asset = require WEDEVS_ACADEMY_PATH . 'assets/js/settings/main.asset.php';

		wp_enqueue_script('academy-settings', WEDEVS_ACADEMY_URL . 'assets/js/settings/main.js', $main_asset['dependencies'], $main_asset['version'], array(
			'in_footer' => true
		) );
	}
}
