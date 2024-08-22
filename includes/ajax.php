<?php

class weDevs_Academy_WP_Plugin_Ajax {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'wp_ajax_academy_ajax_get_posts', array( $this, 'academy_ajax_get_posts' ) );
		add_action( 'wp_ajax_nopriv_academy_ajax_get_posts', array( $this, 'academy_ajax_get_posts' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'Academy Ajax',
			'Ajax',
			'manage_options',
			'academy_wp_plugin_ajax',
			array( $this, 'academy_wp_plugin_ajax_callback' )
		);
	}

	public function academy_wp_plugin_ajax_callback() {
		echo '<button class="academy-wp-plugin-ajax-click" type="button">Click Here</button>';
		echo '<div class="academy-wp-plugin-ajax"></div>';
	}

	public function admin_enqueue_scripts( $hook ) {
		if ( 'toplevel_page_academy_wp_plugin_ajax' == $hook ) {
			wp_enqueue_script( 'ajax-learning', WEDEVS_ACADEMY_URL . 'assets/js/ajax.js', array( 'jquery' ) );

			wp_localize_script( 'ajax-learning', 'AcademyAjax', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce('academy'),
			) );
		}
	}

	public function academy_ajax_get_posts() {
		check_ajax_referer('academy');

		$per_page = isset( $_POST['per_page'] ) ? intval( $_POST['per_page'] ) : 10;

		$posts = get_posts(array(
			'post_type' => 'page',
			'posts_per_page' => $per_page,
		));

		wp_send_json( $posts );
	}
}
