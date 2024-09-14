<?php

class weDevs_Academy_WP_Plugin_Admin_Notice {

	public function __construct() {
		add_action( 'admin_notices', array( $this, 'custom_notice' ) );

		add_action( 'wp_ajax_remove_custom_notice', array( $this, 'remove_custom_notice' ) );
	}

	public function custom_notice() {
		$remove = get_option('wedevs_wp_b2_remove_custom_notice', false);

		if ( $remove === 'true' ) {
			return;
		}

		$url = admin_url('admin-ajax.php');
		$wpnonce = wp_create_nonce('custom');
		?>
		<style>
			.notice.wedevs-custom-notice {
				border: 2px solid #FBF9EA;
				border-radius: 3px;
				padding: 10px 20px 20px 20px;
			}
			p.wedevs-custom-notice-heading {
				font-size: 22px;
				font-weight: 700;
				margin-top: 0;
			}
			.wedevs-custom-notice-learn-more {
				background-color: green;
				color: #fff;
				text-decoration: none;
				margin-right: 10px;
				display: inline-block;
				padding: 10px;
				border-radius: 3px;
			}
			.wedevs-custom-notice-learn-cancel {
				border: 1px solid #ccc;
				color: #ccc;
				text-decoration: none;
				border-radius: 3px;
				padding: 10px;
			}
		</style>
		<div class="notice wedevs-custom-notice">
			<p class="wedevs-custom-notice-heading">Lorem, ipsum dolor.</p>
			<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam, cumque!</p>
			<div>
				<a href="#" class="wedevs-custom-notice-learn-more">Learn More</a>
				<a href="<?php echo esc_url($url); ?>?action=remove_custom_notice&_wpnonce=<?php echo esc_attr($wpnonce); ?>" class="wedevs-custom-notice-learn-cancel">
					Cancel
				</a>
			</div>
		</div>

		<?php
	}

	public function remove_custom_notice() {
		check_ajax_referer( 'custom' );

		update_option('wedevs_wp_b2_remove_custom_notice', 'true', true);

		wp_safe_redirect( $_SERVER['HTTP_REFERER'] );
		exit;
	}
}
