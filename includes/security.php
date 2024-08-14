<?php
/**
 * Learning of WP security.
 */

class weDevs_Academy_WP_Plugin_Security {

	private $errors;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	public function admin_menu() {
		add_menu_page(
			'Security',
			'Security',
			'manage_options',
			'academy_wp_security',
			array( $this, 'academy_wp_security_callback' )
		);
	}

	public function academy_wp_security_callback() {
		if ( isset( $_POST['ac_submit'], $_POST['ac_none'] ) ) {
			if ( wp_verify_nonce( $_POST['ac_none'], 'my-action' ) ) {
				$this->validate();

				if ( empty( $this->errors ) ) {
					$this->save_data();
				}
			} else {
				echo 'Looks like you are a robot.';
				return;
			}
		}
		?>
		<h1>WordPress Security</h1>
		<form action="<?php echo admin_url('admin.php?page=academy_wp_security') ?>" method="post">
			<input type="hidden" name="ac_none" value="<?php echo wp_create_nonce( 'my-action' ); ?>">

			<table class="form-table">
				<tbody>
					<tr>
						<td>Name</td>
						<td>
							<input type="text" name="ac_name" value="<?php echo isset( $_POST['ac_name'] ) ? esc_html($_POST['ac_name']) : ''; ?>">
							<?php if ( isset( $this->errors['ac_name'] ) ) : ?>
								<p><?php echo $this->errors['ac_name']; ?></p>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>
							<input type="text" name="ac_email" value="<?php echo isset( $_POST['ac_email'] ) ? $_POST['ac_email'] : ''; ?>">
							<?php if ( isset( $this->errors['ac_email'] ) ) : ?>
								<p><?php echo $this->errors['ac_email']; ?></p>
							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td>URL</td>
						<td>
							<input type="text" name="ac_url" value="<?php echo isset( $_POST['ac_url'] ) ? esc_url($_POST['ac_url']) : ''; ?>">
							<?php if ( isset( $this->errors['ac_url'] ) ) : ?>
								<p><?php echo $this->errors['ac_url']; ?></p>
							<?php endif; ?>
						</td>
					</tr>
				</tbody>
			</table>
			<button type="submit" class="button button-primary" name="ac_submit">Submit</button>
		</form>
		<?php
	}

	private function validate() {
		$this->errors = array();

		if ( empty( $_POST['ac_email'] ) ) {
			$this->errors['ac_email'] = 'Please enter email address.';
		} else {
			if ( ! filter_var( $_POST['ac_email'], FILTER_VALIDATE_EMAIL ) ) {
				$this->errors['ac_email'] = 'Please enter a valid email address.';
			}
		}

	}

	private function save_data() {
		$ac_name = wp_kses_post( $_POST['ac_name'] );
		$email = sanitize_email( $_POST['ac_email'] );
		// clean data.
		// Save to DB.
	}
}
