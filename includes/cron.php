<?php

class weDevs_Academy_WP_Plugin_Cron {

	public function __construct() {
		add_action( 'woocommerce_order_status_changed', array( $this, 'order_status_changed' ), 10, 4 );
		add_action( 'wedevs_send_customer_email', array( $this, 'wedevs_send_customer_email_callback' ), 10, 1 );
		add_action( 'send_user_count_to_admin', array( $this, 'send_user_count_to_admin' ) );

  		add_action('phpmailer_init', array( $this, 'mailtrap' ) );

		register_activation_hook( WEDEVS_ACADEMY__FILE__, array( $this, 'activation_callback' ) );
	}

	public function order_status_changed( $order_id, $status_from, $status_to, $order ) {

		if ( 'processing' !== $status_to ) {
			return;
		}

		$meta_data = $order->get_meta( 'wedevs_send_customer_email_meta' );

		if ( ! empty( $meta_data ) ) {
			return;
		}

		$order->update_meta_data( 'wedevs_send_customer_email_meta', 'pending' );

		$order->save();

		// Register the cron.
		wp_schedule_single_event(
			time() + ( 60 * 60 * 24 ),
			'wedevs_send_customer_email',
			array( $order_id )
		);
	}

	public function wedevs_send_customer_email_callback( $order_id ) {
		$order = wc_get_order( $order_id );

		$order->update_meta_data( 'wedevs_send_customer_email_meta', 'done' );

		$order->save();

		$user = get_user_by('id', $order->get_customer_id());

		$body = 'We are very happy to see your purchase.';

		wp_mail( $user->user_email, 'Thanks for your order', $body );
	}

	public function mailtrap($phpmailer) {
		$phpmailer->isSMTP();
		$phpmailer->Host = 'sandbox.smtp.mailtrap.io';
		$phpmailer->SMTPAuth = true;
		$phpmailer->Port = 2525;
		$phpmailer->Username = '9c71b49cfa23dd';
		$phpmailer->Password = '1ea378e958392c';
	}

	public function activation_callback() {
		if ( ! wp_next_scheduled ( 'send_user_count_to_admin') ) {
			wp_schedule_event( time(), 'weekly', 'send_user_count_to_admin' );
		}
	}

	public function send_user_count_to_admin() {
		$result = count_users();

		$body = 'Total user on your site is ' . $result['total_users'];

		wp_mail( get_bloginfo('admin_email'), 'Users Count', $body );
	}
}
